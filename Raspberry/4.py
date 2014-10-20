__author__ = 'Enzo'
#! /usr/bin/python

from xbee import XBee
import serial
import pycurl
import cStringIO

ser = serial.Serial('com16', 9600)
xbee = XBee(ser)

def update(sensor):
            xbee.tx(
                id='\x01',
                frame_id='\x01',
                dest_addr=sensor,
                options='\x00',
                data='\x01')

            xbee.wait_read_frame()
            response = xbee.wait_read_frame()

            if response['id'] == 'rx':
                device = response['source_addr']
                device = device.encode("hex")
                response = response['rf_data']
                response = ':'.join("{:02X}".format(ord(c)) for c in response)
                data = device + ":" + response
                print data
                buf = cStringIO.StringIO()
                c = pycurl.Curl()
                c.setopt(c.URL, 'mbox.caaciv.com/decode.php?data='+data+'&lugar=8')
                c.setopt(c.WRITEFUNCTION, buf.write)
                c.perform()
                print buf.getvalue()
                buf.close()

while(True):
    update('\x56\x78')

ser.close()

