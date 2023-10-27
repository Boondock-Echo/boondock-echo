#include "Arduino.h"
#include "network.h"
#include "WiFi.h"
#include "HTTPClient.h"
#include "PubSubClient.h"
#include "SD_MMC.h"
#include "eventHandler.h"
#include "commandProcessor.h"
#include "disk.h"
#include <HTTPClient.h>
#include <ESP32httpUpdate.h>
#include <Update.h>
#include <HTTPClient.h>
#include <NTPClient.h>
#include <WiFiUdp.h>
#include "recorder.h"

WiFiUDP ntpUDP;
NTPClient timeClient(ntpUDP);
WiFiClient httpClient;

bool isUpdaetAvailable = false;

void WiFiEvent(WiFiEvent_t event)
{
    switch (event)
    {
    case SYSTEM_EVENT_WIFI_READY:
        Serial.println("WiFi - interface ready");
        break;
    case SYSTEM_EVENT_SCAN_DONE:
        Serial.println("WiFi - Completed scan for access points");
        break;
    case SYSTEM_EVENT_STA_START:
        Serial.println("WiFi - client started");
        break;
    case SYSTEM_EVENT_STA_STOP:
        Serial.println("WiFi - clients stopped");
        break;
    case SYSTEM_EVENT_STA_CONNECTED:
        Serial.println("WiFi - Connected to access point");
        break;
    case SYSTEM_EVENT_STA_DISCONNECTED:
        Serial.println("WiFi - Disconnected from WiFi access point");
        WiFi.reconnect();
        break;
    case SYSTEM_EVENT_STA_AUTHMODE_CHANGE:
        Serial.println("WiFi - Authentication mode of access point has changed");
        break;
    case SYSTEM_EVENT_STA_GOT_IP:
        Serial.println("WiFi - Obtained IP address: " + WiFi.localIP().toString());
        break;
    case SYSTEM_EVENT_STA_LOST_IP:
        Serial.println("WiFi - Lost IP address and IP address is reset to 0");
        break;
    case SYSTEM_EVENT_STA_WPS_ER_SUCCESS:
        Serial.println("WiFi - Protected Setup (WPS): succeeded in enrollee mode");
        break;
    case SYSTEM_EVENT_STA_WPS_ER_FAILED:
        Serial.println("WiFi - Protected Setup (WPS): failed in enrollee mode");
        break;
    case SYSTEM_EVENT_STA_WPS_ER_TIMEOUT:
        Serial.println("WiFi - Protected Setup (WPS): timeout in enrollee mode");
        break;
    case SYSTEM_EVENT_STA_WPS_ER_PIN:
        Serial.println("WiFi - Protected Setup (WPS): pin code in enrollee mode");
        break;
    case SYSTEM_EVENT_AP_START:
        Serial.println("WiFi - access point started");
        break;
    case SYSTEM_EVENT_AP_STOP:
        Serial.println("WiFi - access point  stopped");
        break;
    case SYSTEM_EVENT_AP_STACONNECTED:
        Serial.println("WiFi - Client connected to access point");
        break;
    case SYSTEM_EVENT_AP_STADISCONNECTED:
        Serial.println("WiFi - Client disconnected from access point");
        break;
    case SYSTEM_EVENT_AP_STAIPASSIGNED:
        Serial.println("WiFi - Assigned IP address to client");
        break;
    case SYSTEM_EVENT_AP_PROBEREQRECVED:
        Serial.println("WiFi - Received probe request");
        break;
    default:
        Serial.printf("WiFi - Unhandled Event: %d\n", event);
        break;
    }
}

/************************************************************************
Initialize the WiFi connection for the device.

This function tries to connect to WiFi networks based on configurations
and initializes the MQTT client upon successful WiFi connection.

Returns:
- true if successfully connected to a WiFi network, false otherwise.
*************************************************************************/
bool init_network()
{
    bool res = false; // Result of connection to WiFi network

    IPAddress primaryDNS;
    IPAddress secondaryDNS;
    primaryDNS.fromString(boondock_network_config.primaryDNS);
    secondaryDNS.fromString(boondock_network_config.secondaryDNS);
    WiFi.onEvent(WiFiEvent); // Attach WiFi event handler
                             //    WiFi.disconnect(); // Disconnect from any previous WiFi network
    WiFi.mode(WIFI_STA);     // Set the mode to station (client) mode
    if (boondock_network_config.useStatic == 1)
    {

        IPAddress ip;
        IPAddress subnet;
        IPAddress gateway;
        ip.fromString(boondock_network_config.ip);
        gateway.fromString(boondock_network_config.gateway);
        subnet.fromString(boondock_network_config.subnet);
        WiFi.config(ip, gateway, subnet, primaryDNS, secondaryDNS);
    }
    else
    {

        WiFi.config(INADDR_NONE, INADDR_NONE, INADDR_NONE, primaryDNS, secondaryDNS);
    }

    delay(500); // Wait for 1 second

    for (int i = 0; i < 3; i++)
    {
        // Choose the current WiFi network based on the iteration count
        const char *ssid = (i == 0) ? boondock_network_config.ssid : (i == 1) ? boondock_network_config.ssid1
                                                                              : boondock_network_config.ssid2;
        const char *password = (i == 0) ? boondock_network_config.password : (i == 1) ? boondock_network_config.password1
                                                                                      : boondock_network_config.password2;

        if (ssid == nullptr || strlen(ssid) == 0)
        {
            handleError(EW08_SSID_MISSING);
            continue; // Skip this iteration and try the next SSID
        }
        else if (strlen(ssid) > 32)
        {
            handleError(EW09_SSID_TOO_LONG);
            continue; // Skip this iteration and try the next SSID
        }

        WiFi.begin(ssid, password); // Attempt to connect to the current WiFi network

        // Loop for 5 iterations (5 * 500 ms = 2.5 seconds) to check if connected to the network
        for (int j = 0; j < 5; j++)
        {
            if (WiFi.status() == WL_CONNECTED)
            {
                res = true;
                break;
            }
            delay(500); // Wait for 500 milliseconds
        }

        // If connected, break out of the outer loop
        if (res)
        {
            String macStr = WiFi.macAddress();
            macStr.replace(":", "");
            strncpy(device_id, macStr.c_str(), sizeof(device_id) - 1); // -1 to ensure null terminator

            Serial.print("WiFi - MAC: ");
            Serial.println(device_id);

            // Initialize a NTPClient to get time
            timeClient.begin();
            timeClient.setTimeOffset(0);

            int ntp_retry = 0;

            while (!timeClient.update())
            {
                ntp_retry++;

                timeClient.forceUpdate();
                if (ntp_retry > 10)
                    break;
                delay(100);
            }

            initMQTT();
            break;
        }
    }

    switch (WiFi.status())
    {
    case WL_CONNECT_FAILED:
        handleError(EW01_WL_CONNECT_FAILED);
        break;
    case WL_NO_SSID_AVAIL:
        handleError(EW02_WL_NO_SSID_AVAIL);
        break;
    case WL_CONNECTION_LOST:
        handleError(EW03_WL_CONNECTION_LOST);
        break;
    case WL_DISCONNECTED:
        handleError(EW04_WL_DISCONNECTED);

        break;
    case WL_IDLE_STATUS:
        handleError(EW05_WL_IDLE_STATUS);
        break;
        //  default:
        //       handleError(EW06_UNKNOWN);
        //       break;
    }

    // Check DNS after successful connection
    if (res)
    {
        Serial.print("WiFi - Connected to ");
        Serial.println(WiFi.SSID());
        // Print device's IP, gateway, subnet mask
        Serial.print("WiFi - Device IP Address: ");
        Serial.println(WiFi.localIP());
        Serial.print("WiFi - Subnet Mask: ");
        Serial.println(WiFi.subnetMask());
        Serial.print("WiFi - Gateway IP: ");
        Serial.println(WiFi.gatewayIP());
        Serial.print("WiFi - DNS: ");
        Serial.println(WiFi.dnsIP()); // Prints the first DNS. If you have multiple, use WiFi.dnsIP(1) for the second one.
        Serial.print("WiFi - DNS: ");
        Serial.println(WiFi.dnsIP(1)); // Prints the first DNS. If you have multiple, use WiFi.dnsIP(1) for the second one.

        IPAddress resolvedIP;
        if (!WiFi.hostByName("cdn.boondockecho.com", resolvedIP))
        {
            Serial.println("WiFi - cdn.boondockecho.com unreachable ");
            handleError(EW07_DNS_ERROR);
            res = false; // Consider DNS failure as connectivity failure
        }
        else
        {
            Serial.println("WiFi - cdn.boondockecho.com OK ");
        }

        if (!WiFi.hostByName("mqtt.boondockecho.com", resolvedIP))
        {
            Serial.println("WiFi - mqtt.boondockecho.com unreachable ");
            handleError(EW07_DNS_ERROR);
            res = false; // Consider DNS failure as connectivity failure
        }
        else
        {
            Serial.println("WiFi - mqtt.boondockecho.com OK ");
        }
    }

    return res;
}

bool downloadAudioFile(const char *url, const char *savePath, bool overwrite)
{
    networkState = NETWORK_STATE_RECEIVING;
    BDK_ErrorCode errorCode = E_NONE;

    const char *filename = strrchr(url, '/') + 1; // Find the last '/' character and move one position forward to get the filename
    if (filename != nullptr)                      // Check to ensure filename is valid
    {
        //  Serial.printf("Downloading %s\n", filename);
    }
    else
    {
        // Serial.printf("Downloading %s", url); // Fallback to printing the full URL if filename extraction fails
    }

    if (SD_MMC.exists(savePath))
    {
        if (overwrite)
        {
            SD_MMC.remove(savePath); // Remove the existing file if overwrite is true
        }
        else
        {
            return true; // File already exists and overwrite is false, so return
        }
    }

    HTTPClient http;

    // Check if we can connect to the server (DNS resolution, etc.)
    if (!http.begin(url) && (errorCode != E_NONE))
    {
        errorCode = ED02_HTTP_INIT_FAIL;

        // return false;
    }

    http.addHeader("Accept", "*/*");
    http.addHeader("Connection", "keep-alive");

    int httpCode = http.GET();

    // Handle non-OK responses
    if (httpCode != HTTP_CODE_OK && (errorCode != E_NONE))
    {
        errorCode = ED03_HTTP_FAIL;
        Serial.printf("HTTP error code: %d\\n", httpCode);
        http.end();
    }

    // Check if there's enough space on SD card
    int contentLength = http.getSize();
    if (contentLength > SD_MMC.totalBytes() - SD_MMC.usedBytes() && (errorCode != E_NONE))
    {
        errorCode = ED04_NOT_ENOUGH_SPACE;
        http.end();
    }

    File file = SD_MMC.open(savePath, FILE_WRITE);
    if (!file && (errorCode != E_NONE))
    {
        errorCode = ED05_FAILED_TO_OPEN_FILE;
        http.end();
    }

    // Check if all bytes are written
    int bytesWritten = http.writeToStream(&file);
    if (bytesWritten != contentLength && (errorCode != E_NONE))
    {
        errorCode = ED06_INCOMPLETE_FILE;
        file.close();
        http.end();
    }

    file.close();
    http.end();

    networkState = NETWORK_STATE_WAITING;
    if (errorCode == E_NONE)
    {
        Serial.printf("Downloaded %s\n", filename);
        return true;
    }
    else
    {
        handleError(errorCode);
        return false;
    }
}

bool download_cdn_files()
{
    networkState = NETWORK_STATE_RECEIVING;
    Serial.println("Checking for updates");

    // Assuming you have an HTTP client library like HTTPClient for ESP8266/ESP32
    HTTPClient http;

    String cdn_list = getSystemFilesListURL();

    // Open connection to the URL
    http.begin(cdn_list);

    // Start connection and send HTTP header
    int httpCode = http.GET();

    if (httpCode > 0)
    {
        // HTTP header has been sent and server response has been handled
        if (httpCode == HTTP_CODE_OK)
        {
            String payload = http.getString();
            // Close connection
            http.end();
            int pos = 0, prevPos = 0;

            // Splitting the string payload by new line and iterating over each file name
            while ((pos = payload.indexOf('\n', prevPos)) != -1)
            {
                String fileName = payload.substring(prevPos, pos);
                prevPos = pos + 1;

                String fileSource = getSystemFilesURL(fileName);
                String fileDestination = String(CDN_LOCATION) + fileName;
                downloadAudioFile(fileSource.c_str(), fileDestination.c_str(), false);
            }
        }
        // Close connection
        http.end();
    }
    else
    {
        // Close connection
        http.end();
        Serial.printf("Failed to fetch the list of files. HTTP error code: %s", String(httpCode).c_str());
        return false;
    }
    networkState = NETWORK_STATE_WAITING;
    Serial.println(" Done!");
    return true;
}

/******************************
analyze_server_response()
Analyze server respose error codes
*******************************/
void analyze_server_response(String response)
{

    /*
    E01 = unknown error
    E02 = invalid parameters
    E03 = duplicate file
    E04 = file too big
    E05 = empty file
    E06 = file too small
    E07 = Server error when saving file
    E08 = error moving file
    E09 = error updating database
    E10 = error creating directory
    E11 = wrong file format
    E12 = Folder permission error
    */

    if (response.indexOf("OK") != -1)
    {
        // Serial.println("Audio uploaded OK");
    }
    else if (response.indexOf("E01") != -1)
    {
        Serial.println("Unknown error uploading audio to server");
    }
    else if (response.indexOf("E02") != -1)
    {
        Serial.println("Invalid parameters uploading audio to server");
    }
    else if (response.indexOf("E03") != -1)
    {
        Serial.println("Duplicate file error uploading audio to server");
    }
    else if (response.indexOf("E04") != -1)
    {
        Serial.println("File too large error uploading audio to server");
    }
    else if (response.indexOf("E05") != -1)
    {
        Serial.println("Empty file error uploading audio to server");
    }
    else if (response.indexOf("E06") != -1)
    {
        Serial.println("File to small error uploading audio to server");
    }
    else if (response.indexOf("E07") != -1)
    {
        Serial.println("File save error uploading audio to server");
    }
    else if (response.indexOf("E08") != -1)
    {
        Serial.println("Error moving file, uploading audio to server");
    }
    else if (response.indexOf("E09") != -1)
    {
        Serial.println("Database error uploading audio to server");
    }
    else if (response.indexOf("E10") != -1)
    {
        Serial.println("Directory create error, uploading audio to server");
    }
    else if (response.indexOf("E11") != -1)
    {
        Serial.println("Wrong file format, uploading audio to server");
    }
}

// format bytes
String formatBytes(unsigned int bytes)
{
    String res;

    if (bytes < 1024)
    {
        res = String(bytes) + "B";
    }
    else if (bytes < (1024 * 1024))
    {
        res = String(bytes / 1024.0) + "KB";
    }
    else if (bytes < (1024 * 1024 * 1024))
    {
        res = String(bytes / 1024.0 / 1024.0) + "MB";
    }
    return res;
}

/******************************
uploadAudioFile()
Upload file to the Server
&t=2&x=4&d=2341&a=0.24&s=123361
*******************************/
bool uploadAudioFile(String filename, String timestamp, int trigger, int endReason, int duration, float decibel, int size)
{

    networkState = NETWORK_STATE_SENDING;
    long startTime = millis();

    bool res = true;
    String getAll, getBody;
    String sourceFileName = "/queue/" + filename;

    File my_sending_file = SD_MMC.open(sourceFileName, FILE_READ);

    String fileName = my_sending_file.name();
    String fileSize = formatBytes(my_sending_file.size());

    // send_mqtt_event("I64", fileName);

    String myMac = WiFi.macAddress();
    myMac.replace(":", "");

    if (my_sending_file)
    {
        const String boundary = "CustomizBoundarye----";
        const String contentType = "audio/x-wav";
        const String portString = "80";
        const String hostString = getCDNHostname();

        // Serial.println("hostString " + hostString);

        String requestHead = "--BoonDock\r\nContent-Disposition: form-data; name=\"audioFile\"; filename=\"" + myMac + "\"\r\nContent-Type: audio/x-wav\r\n\r\n";
        String tail = "\r\n--BoonDock--\r\n";

        int contentLength = requestHead.length() + my_sending_file.size() + tail.length();

        String cdnURL = getCDNUploadURL();
        // Serial.println(cdnURL);
        httpClient.connect(hostString.c_str(), 80);

        timestamp.replace(SD_CARD_INBOX_LOCATION, "");

        // upload1.php?f=2023-08-12T12-21-52Z.wav&t=2&x=4&d=2341&a=0.24&s=123361
        String qry = "POST " + getCDNUploadURL() + "?f=" + timestamp + "&t=" + String(trigger) + "&x=" + String(endReason) + "&d=" + String(duration) + "&a=" + String(decibel) + "&s=" + String(size) + " HTTP/1.1";
        httpClient.println(qry);

        // Serial.println(qry);

        httpClient.println("Host: " + getCDNHostname());
        httpClient.println("Content-Length: " + String(contentLength));
        httpClient.println("Content-Type: multipart/form-data; boundary=BoonDock");
        httpClient.println("Connection: keep-alive");
        httpClient.println();
        httpClient.print(requestHead);

        const int bufSize = 4096;
        byte clientBuf[bufSize];
        int clientCount = 0;

        while (my_sending_file.available())
        {
            clientBuf[clientCount++] = my_sending_file.read();
            if (clientCount > (bufSize - 1))
            {
                httpClient.write(clientBuf, bufSize);
                clientCount = 0;
            }
            mqttClient.loop();
        }

        if (clientCount > 0)
        {
            httpClient.write(clientBuf, clientCount);
        }

        httpClient.print(tail);
    }
    else
    {
        //  send_mqtt_event("E11", "1");
        res = false;
    }

    if (READ_UPLOAD_RESPONSE)
    {
        String responseHeaders = "";
        int timeoutTimer = 5000;
        long startTimer = millis();
        bool state = false;

        while ((startTimer + timeoutTimer) > millis())
        {
            delay(100);
            while (httpClient.available())
            {
                char c = httpClient.read();
                if (c == '\n')
                {
                    if (getAll.length() == 0)
                        state = true;
                    getAll = "";
                }
                else if (c != '\r')
                {
                    getAll += c;
                }
                if (state)
                    getBody += c;
                startTimer = millis();
            }
            if (!getBody.isEmpty())
                break;
        }

        analyze_server_response(getBody);
        //  KIT_LOGB(getBody.c_str());
    }

    httpClient.stop();
    my_sending_file.close();
    vTaskDelay(250);

    long endTime = millis();

    // send_mqtt_event("I48",   String((endTime - startTime) * 0.001)  );
    networkState = NETWORK_STATE_WAITING;
    return res;
}

void uploadFilesFromQueue()
{
    networkState = NETWORK_STATE_SENDING;

    // Open the queue folder
    File queueDir = SD_MMC.open("/queue", "r");

    if (!queueDir || !queueDir.isDirectory())
    {
        Serial.println("Error opening the queue folder");
        return;
    }

    // Iterate through files in the queue folder
    File entry;
    while (entry = queueDir.openNextFile())
    {

        if (entry.isDirectory())
        {
            continue;
        }

        // Get the file name
        String fileName = String(entry.name());

        // Skip files that don't end with '.wav'
        if (!fileName.endsWith(".wav"))
        {
            entry.close();
            continue;
        }

        // Skip files that start with '_'
        if (fileName.startsWith("_"))
        {
            entry.close(); // Close the file before continuing to the next iteration
            continue;      // Skip the current iteration
        }

        // Check if the file size is greater than zero bytes
        if (entry.size() > 0)
        {

            // Get the timestamp from the file name (you may need to adjust this)
            String timestamp = fileName.substring(0, fileName.lastIndexOf('.'));

            // Call the uploadAudioFile function with the appropriate parameters
            // 2023-10-13T20-28-44Z
            bool uploadResult = uploadAudioFile(fileName, timestamp + ".wav", 1, 1, 1, 1, 1);

            if (uploadResult)
            {
                float seconds = entry.size() / (8000*2);
                String message = "(" + String(seconds) + ")";

                //  Serial.println("File uploaded successfully: " + fileName);
                handleEvent(EVENT_AUDIO_UPLOADED, message);
                Serial.printf("Audio uploaded [%.1f sec]\n", seconds);
                // If the upload is successful, you can move or delete the file from the queue folder
                // For example, you can move it to an "uploaded" folder
                String newFilePath = "/inbox/" + fileName;
                String newRenameFilePath = "/inbox/_" + fileName;
                String oldFilePath = "/queue/" + fileName;

                if (SD_MMC.rename(oldFilePath.c_str(), newFilePath.c_str()))
                {
                    // Serial.println("File moved to uploaded folder");
                }
                else
                {
                    if (!SD_MMC.rename(oldFilePath.c_str(), newRenameFilePath.c_str()))
                        if (!SD_MMC.remove(oldFilePath.c_str()))
                            Serial.println("Error moving & removing the file");
                }

                // Break after one file is uploaded
                break;
            }
        }
        else
        {
            // Serial.println("File is zero bytes: " + entry.name());
            // Delete the zero-byte file
            entry.close();               // Close the file first
            SD_MMC.remove(entry.name()); // Remove the file from the SD card
        }
    }

    // Close the queue folder
    queueDir.close();
    networkState = NETWORK_STATE_WAITING;
}

void updateFirmware(String sURL)
{
    networkState = NETWORK_STATE_LIVE_UPDATE;
    if ((WiFi.status() == WL_CONNECTED))
    {
        // Check if the Firmware file exists
        Serial.println("Updating Boondock Firmware...");

        t_httpUpdate_return ret = ESPhttpUpdate.update(sURL);
        switch (ret)
        {
        case HTTP_UPDATE_FAILED:
            Serial.println("OTA Update Failed");
            break;

        case HTTP_UPDATE_NO_UPDATES:
            Serial.println("No OTA updates");
            break;

        case HTTP_UPDATE_OK:

            break;
        }
    }
}

/******************************************
 * isNewFirmwareAvailable(String, String)

 *******************************************/
String isNewFirmwareAvailable(String currentFirmware)
{
    String sURL = getFirmwareURL(currentFirmware);
    // Serial.println("Checking fimrware updates " + sURL);

    // Start HTTP client and send GET request to the URL
    HTTPClient http;
    http.begin(sURL);
    int httpCode = http.GET();
    http.end();

    if (httpCode == HTTP_CODE_OK)
    {
        // Successful response
        http.end();
    }
    else if (httpCode == HTTP_CODE_NOT_FOUND)
    {
        // File does not exist (HTTP 404)
        sURL = "";
    }
    else
    {
        // Handle other HTTP errors here if needed
        Serial.print("HTTP error code: ");
        Serial.println(httpCode);
        sURL = "";
    }

    return sURL;
}

/***************************************
network_task_execute()

****************************************/
void network_task_execute(void *parameter)
{
    // Keypad
    networkAvailable = init_network();
    if (networkAvailable)
    {
        // license
        // Sent once to register / check registration of the device
        if (!hasLicenseCode || !isRegistered)
        {
            Serial.println("Checking Boondock Echo registration");
            String topic = "boondock/register/" + String(device_id);
            mqttClient.publish(topic.c_str(), boondock_config.dock.license, false);
        }

        download_cdn_files();

        networkState = NETWORK_STATE_WAITING;
    }

    int counter = 0;
    // Endless loop to update the LED status
    while (1)
    {
        // Code to wait untill application is ready

        if (applicationState == APP_STATE_INIT || radioState == RADIO_STATE_PLAYBACK)
        {
            vTaskDelay(100 / portTICK_PERIOD_MS);
            mqttClient.loop();
            continue;
        }
        mqttClient.loop();
        // Increment the counter
        counter++;

        // Check if 10 seconds have passed (10 * 1000ms delay)
        if (counter >= MQTT_TICKER_LOOP)
        {
            Serial.println("Sending Ticker");
            mqtt_send_ticker();
            counter = 0; // Reset the counter
        }

        uploadFilesFromQueue();

        vTaskDelay(100 / portTICK_PERIOD_MS);

        if (shouldsaveConfig)
        {
            save_boondock_config();
            save_network_config();
            shouldsaveConfig == false;
        }
    }
}