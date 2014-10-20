int LED = 10;

void setup()
{
    pinMode(LED, OUTPUT);
    Serial.begin(9600);
}
//7E 00 16 10 01 00 7D 33 A2 00 40 AA 51 DC 00 00 00 00 54 78 44 61 74 61 30 41 6B Example
void loop()
{

    if(Serial.available() >= 25)
    {
        if(Serial.read() == 0x7E)
        {
            for(int i=0;i<24;i++)
            {
                if(Serial.read() == 0x54)
                {
                    digitalWrite(LED, HIGH); 
                }
            }
        }
    }
}
