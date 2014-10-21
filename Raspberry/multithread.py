import threading
from xbee import DigiMesh
import serial
import time
import pycurl
import cStringIO
import sys;

global ip
ip = "localhost:8000"
global tim
tim=3

while True:
    try:
        port="COM12"
        ser = serial.Serial('COM12', 9600,timeout=tim)
        xbee = DigiMesh(ser, escaped=True)
        break
    except:
        print "Puerto "+port+" no disponible."
        sys.exit()

def HexToByte( hexStr ):
    bytes = []
    hexStr = ''.join( hexStr.split(" ") )

    for i in range(0, len(hexStr), 2):
        bytes.append( chr( int (hexStr[i:i+2], 16 ) ) )

    return ''.join( bytes )

def serverpush(data):
    buf = cStringIO.StringIO()
    c = pycurl.Curl()
    c.setopt(c.URL, ip+'update/'+data)
    c.setopt(c.WRITEFUNCTION, buf.write)
    c.setopt(c.TIMEOUT,10)
    try:
        c.perform()
        buf.close()
    except Exception, e:
        print e
    time.sleep(2)


def updatesensor(dispositivo):
            dispositivo = HexToByte(dispositivo)

            xbee.tx(
                frame_id='\x01',
                dest_addr=dispositivo,
                options='\x00',
                data='\x01')

            try:
                xbee.wait_read_frame(3)
                response = xbee.wait_read_frame(3)
                valid=response['id']
                if valid=='rx':
                    mac = response['source_addr']
                    mac = '00'+''.join("{:02X}".format(ord(c)) for c in mac)
                    data = response['data']
                    data = ':'.join("{:02X}".format(ord(c)) for c in data)
                    serverpush(mac+"/"+"02/"+data)
                    print mac+"/"+"02/"+data
            except Exception, e:
                print e

class EscrituraValores(threading.Thread):
             def run(self):
                    while True:
                        updatesensor("0013A20040BB60FE")


EscrituraValores = EscrituraValores()
EscrituraValores.start()