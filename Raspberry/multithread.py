import threading
from xbee import DigiMesh
import serial
import time
import pycurl
import cStringIO
import sys;

global ip
ip = "181.75.175.4/"
global tim
tim=3

while True:
    try:
        port="COM1"
        ser = serial.Serial('COM1', 9600,timeout=tim)
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

def controlon(relay, dispositivo):
    dispositivo=HexToByte(dispositivo)
    xbee.remote_at(
            frame_id = '\x01',
            command = 'D'+relay,
            dest_addr_long = dispositivo,
            parameter = '\x05'
            )
    try:
        response=xbee.wait_read_frame(3)
        xbee.halt()
    except Exception,e:
        print e

def controloff(relay, dispositivo):
    dispositivo = HexToByte(dispositivo)
    xbee.remote_at(
            frame_id = '\x01',
            command = 'D'+relay,
            dest_addr_long = dispositivo,
            parameter = '\x04'
            )
    try:
        response=xbee.wait_read_frame(3)
        xbee.halt()
    except Exception,e:
        print e

def updatecontrol(dispositivo):
    dispositivo = HexToByte(dispositivo)
    xbee.remote_at(
            frame_id = '\x01' ,
            command = "IS",
            dest_addr_long = dispositivo,
            )
    try:
        response = xbee.wait_read_frame(3)
        xbee.halt()
        mac = response['source_addr']
        mac = ''.join("{:02X}".format(ord(c)) for c in mac)
        response = response['parameter'][0]

        if response['dio-0']:
            D0 = 1
            D0 = D0.__str__()+':'
        else:
            D0 = 0
            D0 = D0.__str__()+':'

        if response['dio-1']:
            D1 = 1
            D1 = D1.__str__()+':'
        else:
            D1 = 0
            D1 = D1.__str__()+':'

        if response['dio-2']:
            D2 = 1
            D2 = D2.__str__()+':'
        else:
            D2 = 0
            D2 = D2.__str__()+':'

        if response['dio-3']:
            D3 = 1
            D3 = D3.__str__()+':'
        else:
            D3 = 0
            D3 = D3.__str__()+':'

        if response['dio-4']:
            D4 = 1
            D4 = D4.__str__()+':'
        else:
            D4 = 0
            D4 = D4.__str__()+':'

        if response['dio-5']:
            D5 = 1
            D5 = D5.__str__()+':'
        else:
            D5 = 0
            D5 = D5.__str__()+':'

        if response['dio-6']:
            D6 = 1
            D6 = D6.__str__()+':'
        else:
            D6 = 0
            D6 = D6.__str__()+':'

        if response['dio-0']:
            D7 = 1
            D7 = D7.__str__()
        else:
            D7 = 0
            D7 = D7.__str__()

        serverpush(mac+'/'+'01/'+D0+D1+D2+D3+D4+D5+D6+D7)
        print mac+'/'+'01/'+D0+D1+D2+D3+D4+D5+D6+D7
    except Exception,e:
        print e


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
                        updatecontrol("0013A20040AA51C4")
                        updatesensor("0013A20040BB60FE")

class LecturaCambios(threading.Thread):
           def run(self):
                   while True:
                         time.sleep(2)
                         buf = cStringIO.StringIO()
                         c = pycurl.Curl()
                         c.setopt(c.URL, ip+'control')
                         c.setopt(c.WRITEFUNCTION, buf.write)
                         c.setopt(c.TIMEOUT, 10)

                         try:
                             c.perform()
                             respuesta = buf.getvalue()
                             buf.close()
                             if respuesta != "0":
                                 respuesta = respuesta.split(':')
                                 mac = respuesta[0]
                                 tipo = respuesta[1]
                                 cambio = respuesta[2]
                                 cambio = cambio.split(',')
                                 if cambio[1]=="1":
                                    controlon(cambio[0], mac)
                                 if cambio[1]=="0":
                                    controloff(cambio[0], mac)
                         except Exception, e:
                             print e

EscrituraValores = EscrituraValores()
LecturaCambios = LecturaCambios()
EscrituraValores.start()
LecturaCambios.start()