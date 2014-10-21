#! /usr/bin/python

from xbee import DigiMesh
import serial
import time
import pycurl
import cStringIO
import struct

 # EL PROTOCOLO DE ENVIO ES (MAC)XXXXXXXX:(TIPO)XX:(SIGNO)XX:(DATA)XX:XX

ser = serial.Serial('COM12', 9600)
xbee = DigiMesh(ser, escaped=True)

def HexToByte( hexStr ):
    bytes = []
    hexStr = ''.join( hexStr.split(" ") )

    for i in range(0, len(hexStr), 2):
        bytes.append( chr( int (hexStr[i:i+2], 16 ) ) )

    return ''.join( bytes )

def serverpush(data):
     buf = cStringIO.StringIO()
     c = pycurl.Curl()
     c.setopt(c.URL, 'localhost:8000/update/'+data)
     c.setopt(c.WRITEFUNCTION, buf.write)
     c.perform()
     print buf.getvalue()
     buf.close()

def updatesensor(dispositivo):
            xbee.tx(
                frame_id='\x01',
                dest_addr=dispositivo,
                options='\x00',
                data='\x01')

            xbee.wait_read_frame(3)
            response = xbee.wait_read_frame(3)
            mac = response['source_addr']
            mac = '00'+''.join("{:02X}".format(ord(c)) for c in mac)
            data = response['data']
            data = ':'.join("{:02X}".format(ord(c)) for c in data)
            serverpush(mac+"/"+"01/"+data)
            print mac+"/"+"01/"+data


while True:
    updatesensor('\x00\x13\xA2\x00\x40\xAA\x54\x9F')


