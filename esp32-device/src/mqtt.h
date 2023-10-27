#ifndef __BOONDOCK_MQTT__
#define __BOONDOCK_MQTT__

#include "Arduino.h"
#include <WiFi.h>
#include "time.h"
#include <PubSubClient.h>
#include <ArduinoJson.h>
#include "config.h"
#include <HTTPClient.h>
#include "AudioKitHAL.h"

void boondock_say(String playFilename, bool forcePlay, bool typeGood);
void updateSpeaker(bool speakerState);
struct AudioPlaybackQueue
{
    String filename;
    bool played = false;
    bool isEmpty = true;
    bool local = false;
    bool mono = true;
    bool transmit = false;
};

AudioPlaybackQueue my_playback_queue[PLAYBACK_QUEUE];

WiFiClient mqttWifiClient;
PubSubClient mqttClient(mqttWifiClient);


#endif
