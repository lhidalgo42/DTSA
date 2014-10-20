__author__ = 'Enzo'
#! /usr/bin/python



from xbee import XBee
import serial
import pycurl
import cStringIO
import time

ser = serial.Serial('com16', 9600)
xbee = XBee(ser)

def server(data):
     buf = cStringIO.StringIO()
     c = pycurl.Curl()
     c.setopt(c.URL, 'mbox.caaciv.com/decode.php?data='+data)
     c.setopt(c.WRITEFUNCTION, buf.write)
     c.perform()
     print buf.getvalue()
     buf.close()


def updatesensor(tipo,dispositivo):
            xbee.tx_long_addr(
                frame_id='\x01',
                dest_addr=dispositivo,
                options='\x00',
                data='\x01')

            xbee.wait_read_frame()
            response = xbee.wait_read_frame()
            mac = response['source_addr']
            mac = ''.join("{:02X}".format(ord(c)) for c in mac)
            data = response['rf_data']
            data = ':'.join("{:02X}".format(ord(c)) for c in data)
            data = mac+":"+tipo+":"+data
            print data
            server(data)


# INGRESO HEX(Dispositivo(MAC))
# OUT

def updatecontrol(dispositivo):
            xbee.remote_at(
                frame_id='\x01',
                command='\x49\x53',
                dest_addr_long=dispositivo)

            response = xbee.wait_read_frame()
            mac = response['source_addr_long']
            mac = ''.join("{:02X}".format(ord(c)) for c in mac)
            data = response['parameter']
            data = mac+":"+"02"+":"+data
            print data
            print response

def on_control(sensor):
            xbee.remote_at(
                frame_id='\x01',
                command='\x44\x37',
                parameter='\x05',
                dest_addr=sensor)

            response = xbee.wait_read_frame()
            #print response
            time.sleep(2)


def off_control(sensor):
            xbee.remote_at(
                frame_id='\x01',
                command='\x44\x37',
                parameter='\x04',
                dest_addr=sensor)

            response = xbee.wait_read_frame()
            #print response
            time.sleep(2)

while True:
        updatesensor('01','\x00\x13\xA2\x00\x40\xAA\x51\xC4')
        updatecontrol('\x00\x13\xA2\x00\x40\xBB\x60\xFE')
        #on_control('\x00\x02')
        #off_control('\x00\x02')
ser.close()

