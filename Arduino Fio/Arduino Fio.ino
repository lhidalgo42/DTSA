#include <XBee.h>
#include <SHT1x.h>

XBee xbee = XBee();
uint8_t payload[] = {0, 0, 0, 0, 0, 0};
XBeeAddress64 addr64 = XBeeAddress64(0x0013A200,0x40BE5622);
DMTxRequest tx = DMTxRequest(addr64, payload, sizeof(payload));
XBeeResponse response = XBeeResponse();
DMRxResponse rx64 = DMRxResponse();

#define dataPin  12
#define clockPin 13
SHT1x sht1x(dataPin, clockPin);

uint8_t option = 0;
uint8_t data = 0;

float temp_c;
unsigned int humidity;

void setup() {

  xbee.begin(9600);
  Serial.begin(9600);
}

void loop() {
  
  delay(1000);
  temp_c = sht1x.readTemperatureC();
  Serial.print(temp_c);
  
  
  unsigned int entero=temp_c;
  unsigned int decimal;
  
  
  if(temp_c<=0)
  {
  payload[0]=1;
  payload[1]=entero;
  payload[2]=255-((temp_c-entero)*100);
  }
  else
  {
  payload[0]=0;
  payload[1]=entero;
  payload[2]=(temp_c-entero)*100;
  }
  
  humidity = sht1x.readHumidity();
  
  payload[3]=0;
  payload[4]=humidity;
  payload[5]=0;
  
    xbee.readPacket();
    
    if (xbee.getResponse().isAvailable()) {
      
      if (xbee.getResponse().getApiId() == DM_RX_RESPONSE) 
        {
                xbee.getResponse().getDMRxResponse(rx64);
        	option = rx64.getOption();
        	data = rx64.getData(0);
            
            if (data==1)
          {
                xbee.send(tx); 
          }
        }
      }  
}
