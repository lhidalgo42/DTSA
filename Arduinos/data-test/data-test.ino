#include <OneWire.h>
#include <DallasTemperature.h>

#define ONE_WIRE_BUS 10
OneWire ourWire(ONE_WIRE_BUS);
DallasTemperature sensors(&ourWire);
int signo;
int temp_int;
int temp_dec;

void sendData(int signo,int temp_int,int temp_dec)
{
  unsigned char checksum = 0;
    
    Serial.write(0x7E); // Start delimiter

    Serial.write(0x00); // Length
    Serial.write(0x11); // Length

    Serial.write(0x10); // Frame type
    checksum +=0x10;
    Serial.write(0x01); // Frame ID
    checksum +=0x01;

    Serial.write(0x00); // 64-bit destino Address
    checksum +=0x00;
    Serial.write(0x13);
    checksum +=0x13;
    Serial.write(0xA2);
    checksum +=0xA2;
    Serial.write(0x00);
    checksum +=0x00;
    Serial.write(0x40);
    checksum +=0x40;
    Serial.write(0xAA);
    checksum +=0xAA;
    Serial.write(0x51);
    checksum +=0x51;
    Serial.write(0xAE);
    checksum +=0xAE;
    
    Serial.write(0x00); // 16-bit destino Address
    checksum +=0x00;
    Serial.write(0x00);
    checksum +=0x00;

    Serial.write(0x00); // Broadcast radius
    checksum +=0x00;
    Serial.write(0x00); // options
    checksum +=0x00;
    
    //data start  

    Serial.write(lowByte(signo)+highByte(signo)); 
    checksum +=lowByte(signo)+highByte(signo);
    
    Serial.write(lowByte(temp_int)+highByte(temp_int));  
    checksum +=lowByte(temp_int)+highByte(temp_int);
    
    Serial.write(lowByte(temp_dec)+highByte(temp_dec));  
    checksum +=lowByte(temp_dec)+highByte(temp_dec);
    
    // End data
    char checksumFinal = 0xFF -checksum;
    Serial.write(checksumFinal); // CheckSum TODO

    delay(10);

}

void setup()
{
    Serial.begin(9600);
    sensors.begin();
}

void loop()
{
    sensors.requestTemperatures();
    float data = sensors.getTempCByIndex(0); 
      if(sensors.getTempCByIndex(0)<0)
    {
    data = (-1)*data;
    signo = 1;
    temp_int = ceil(data);
    temp_dec = 100*(data-temp_int);
    }
    else
    {
    signo = 0;
    temp_int = floor(data);
    temp_dec = 100*(data-temp_int);
    } 

    sendData(signo,temp_int,temp_dec);
    delay(1000);
}
//7E 00 16 10 01 00 7D 33 A2 00 40 AA 51 AE 00 00 00 00 54 78 44 61 74 61 30 41 99 Example


