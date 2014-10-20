int rele = 8;

void setup()
{
    pinMode(rele, INPUT);
    Serial.begin(9600);
}

void loop()
{
    if (digitalRead(rele) == HIGH)
    {
        sendData();
    }
    delay(1000);
}
//7E 00 16 10 01 00 7D 33 A2 00 40 AA 51 AE 00 00 00 00 54 78 44 61 74 61 30 41 99 Example
void sendData()
{

  unsigned char checksum = 0;
    
    Serial.write(0x7E); // Start delimiter

    Serial.write(0x00); // Length
    Serial.write(0x16); // Length

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
    Serial.write(0x54);
    checksum +=0x54;
    Serial.write(0x78);
    checksum +=0x78;
    Serial.write(0x44);
    checksum +=0x44;
    Serial.write(0x61);
    checksum +=0x61;
    Serial.write(0x74);
    checksum +=0x74;
    Serial.write(0x61);
    checksum +=0x61;
    Serial.write(0x30);
    checksum +=0x30;
    Serial.write(0x41);
    checksum +=0x41;
    // End data
    
    char checksumFinal = 0xFF -checksum;
    Serial.write(checksumFinal); // CheckSum TODO

    delay(10);

}
