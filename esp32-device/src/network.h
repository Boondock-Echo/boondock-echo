/*
SD Card related
*/

#include "gpio.h"
#include "config.h"
#include "WiFi.h"
#include "WiFiUdp.h"
#include "NTPClient.h"
#include "eventHandler.h"

#ifndef __BOONDOCK_NETWORK__
#define __BOONDOCK_NETWORK__


void network_task_execute(void *parameter); // Main task
bool uploadAudioFile(); // Uploads audio file to server
bool downloadAudioFile(const char *url, const char *savePath, bool overwrite); // Downloads an audio file to SD Card
bool download_cdn_files();
void updateFirmware(String sURL);

String isNewFirmwareAvailable(String currentFirmware);

// Define NTP Client to get time
extern WiFiUDP ntpUDP;
extern NTPClient timeClient;
extern bool isUpdaetAvailable;
extern WiFiClient httpClient;

#endif