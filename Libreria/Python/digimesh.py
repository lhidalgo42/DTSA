"""
digimesh.py

By Matteo Lucchesi, 2011
Inspired by code written by Amit Synderman, Marco Sangalli and Paul Malmsten
matteo@luccalug.it http://matteo.luccalug.it

This module provides an XBee (Digimesh) API library.

Updated by Thom Nichols http://blog.thomnichols.org
"""
import struct
from xbee.base import XBeeBase
from xbee.python2to3 import byteToInt, intToByte

class DigiMesh(XBeeBase):
    """
    Provides an implementation of the XBee API for Digimesh modules
    with recent firmware.
    
    Commands may be sent to a device by instansiating this class with
    a serial port object (see PySerial) and then calling the send
    method with the proper information specified by the API. Data may
    be read from a device syncronously by calling wait_read_frame. For
    asynchronous reads, see the definition of XBeeBase.
    """
    # Packets which can be sent to an XBee
    
    # Format: 
    #        {name of command:
    #           [{name:field name, len:field length, default: default value sent}
    #            ...
    #            ]
    #         ...
    #         }
    api_commands = {"at":
                        [{'name':'id',        'len':1,      'default':'\x08'},
                         {'name':'frame_id',  'len':1,      'default':'\x00'},
                         {'name':'command',   'len':2,      'default':None},
                         {'name':'parameter', 'len':None,   'default':None}],
                    "queued_at":
                        [{'name':'id',        'len':1,      'default':'\x09'},
                         {'name':'frame_id',  'len':1,      'default':'\x00'},
                         {'name':'command',   'len':2,      'default':None},
                         {'name':'parameter', 'len':None,   'default':None}],
                    #explicit adrresing command frame - to do!
                    "remote_at":
                        [{'name':'id',              'len':1,        'default':'\x17'},
                         {'name':'frame_id',        'len':1,        'default':'\x00'},
                         {'name':'dest_addr_long',  'len':8,        'default':None},
                         {'name':'reserved',        'len':2,        'default':'\xFF\xFE'},
                         {'name':'options',         'len':1,        'default':'\x02'},
                         {'name':'command',         'len':2,        'default':None},
                         {'name':'parameter',       'len':None}],                            
                    "tx":
                        [{'name':'id',              'len':1,        'default':'\x10'},
                         {'name':'frame_id',        'len':1,        'default':'\x00'},
                         {'name':'dest_addr',       'len':8,        'default':None},
                         {'name':'reserved',        'len':2,         'default':'\xFF\xFE'},
                         {'name':'broadcast_radius', 'len':1,         'default':'\x00'},
                         {'name':'options',         'len':1,        'default':'\x00'},
                         {'name':'data',            'len':None,     'default':None}],

                    }
    
    # Packets which can be received from an XBee
    
    # Format: 
    #        {id byte received from XBee:
    #           {name: name of response
    #            structure:
    #                [ {'name': name of field, 'len':length of field}
    #                  ...
    #                  ]
    #            parse_as_io_samples:name of field to parse as io
    #           }
    #           ...
    #        }
    #
    api_responses = {b"\x88":
                        {'name':'at_response',
                         'structure':
                            [{'name':'frame_id',    'len':1},
                             {'name':'command',     'len':2},
                             {'name':'status',      'len':1},
                             {'name':'parameter',   'len':None}]},
                     b"\x8a":
                        {'name':'status',
                         'structure':
                            [{'name':'status',      'len':1}]},
                     b"\x8b":
                        {'name':'tx_status',
                         'structure':
                            [{'name':'frame_id',        'len':1},
                             {'name':'reserved',        'len':2, 'default':'\xFF\xFE'},
                             {'name':'retries',         'len':1},
                             {'name':'deliver_status',  'len':1},
                             {'name':'discover_status', 'len':1}]},
                     b"\x90":
                        {'name':'rx',
                         'structure':
                            [{'name':'frame_id',    'len':1},
                             {'name':'source_addr', 'len':7},
                             {'name':'reserved',    'len':2},
                             {'name':'options',     'len':1},
                             {'name':'data',        'len':None}]},
                    # b"\x91": to do!
                    #    {'name':'explicit_rx_indicator',
                    #     'structure':
                    #        [{'name':'source_addr', 'len':2},
                    #         {'name':'rssi',        'len':1},
                    #         {'name':'options',     'len':1},
                    #         {'name':'rf_data',     'len':None}]},
                    # b"\x92": data sample rx indicator {}
                     b"\x95":
                        {'name':'node_id',
                         'structure':
                            [{'name':'source_addr_long',  'len':8},
                             {'name':'network_addr',      'len':2},
                             {'name':'options',           'len':1},
                             {'name':'source_addr',       'len':2},
                             {'name':'network_addr_long', 'len':8},
                             {'name':'node_id',           'len':'null_terminated'},
                             {'name':'parent',            'len':2},
                             {'name':'unknown',           'len':None}]},

                     b"\x97":
                        {'name':'remote_at_response',
                         'structure':
                            [{'name':'frame_id',        'len':1},
                             {'name':'source_addr',     'len':8},
                             {'name':'reserved',        'len':2},
                             {'name':'command',         'len':2},
                             {'name':'status',          'len':1},
                             {'name':'parameter',       'len':None}],
                          'parsing': [('parameter',
                                       lambda self, original: self._parse_IS_at_response(original))]
                        }}

    

    def _parse_IS_at_response(self, packet_info):
        """
        If the given packet is a successful remote AT response for an IS
        command, parse the parameter field as IO data.
        """
        if packet_info['id'] in ('at_response','remote_at_response') and packet_info['command'].lower() == 'is' and packet_info['status'] == b'\x00':
               return self._parse_samples(packet_info['parameter'])
        else:
            return packet_info['parameter']



    def __init__(self, *args, **kwargs):
        # Call the super class constructor to save the serial port
        super(DigiMesh, self).__init__(*args, **kwargs)
        

    def _parse_samples_header(self, io_bytes):
        """
        _parse_samples_header: binary data in XBee ZB IO data format ->
                        (int, [int ...], [int ...], int, int)
                        
        _parse_samples_header will read the first three bytes of the 
        binary data given and will return the number of samples which
        follow, a list of enabled digital inputs, a list of enabled
        analog inputs, the dio_mask, and the size of the header in bytes

        _parse_samples_header is overloaded here to support the additional
        IO lines offered by the XBee ZB
        """
        header_size = 4

        # number of samples (always 1?) is the first byte
        sample_count = byteToInt(io_bytes[0])
        
        # bytes 1 and 2 are the DIO mask; bits 9 and 8 aren't used
        dio_mask = (byteToInt(io_bytes[1]) << 8 | byteToInt(io_bytes[2])) & 0x0E7F
        
        # byte 3 is the AIO mask
        aio_mask = byteToInt(io_bytes[3])
        
        # sorted lists of enabled channels; value is position of bit in mask
        dio_chans = []
        aio_chans = []
        
        for i in range(0,13):
            if dio_mask & (1 << i):
                dio_chans.append(i)
        
        dio_chans.sort()
        
        for i in range(0,8):
            if aio_mask & (1 << i):
                aio_chans.append(i)
        
        aio_chans.sort()
        
        return (sample_count, dio_chans, aio_chans, dio_mask, header_size)
