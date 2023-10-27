
#ifndef __BOONDOCK_ERROR__
#define __BOONDOCK_ERROR__

#include "Arduino.h"
#include "config.h"
#include <HTTPClient.h>
#include <ESP32httpUpdate.h>
#include <Update.h>
#include <HTTPClient.h>
#include "WiFi.h"
#include "HTTPClient.h"
#include "PubSubClient.h"

extern WiFiClient mywiFiClient;
extern PubSubClient mqttClient; 

void handleError(BDK_ErrorCode errorCode);
void handleEvent(BDK_EventCode eventID, String message);
void sendMQTTEvent(String eventID, String value);
void mqtt_send_ticker();
void initMQTT();


#endif