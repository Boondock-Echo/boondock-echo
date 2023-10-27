
#ifndef __BOONDOCK_COMMON__
#define __BOONDOCK_COMMON__

#include "Arduino.h"

#define STATE_INIT 0
#define STATE_WAITING 1
#define STATE_MIC_RECORDING 2
#define STATE_REMOTE_RECORDING 3
#define STATE_AUTO_RECORDING 4
#define STATE_NETWORK_SENDING 5
#define STATE_ERROR 6
#define STATE_FATAL_ERROR 7
#define STATE_NETWORK_RECEIVING 8
#define STATE_OTA 13
#define STATE_PLAYBACK 14
#define STATE_PTT_TRANSMITTING 15
#define STATE_CLOUD_TRANSMITTING 16

#define STATE_CONFIG_LOW 17
#define STATE_CONFIG_HIGH 18
#define STATE_CONFIG_MUTE 19
#define STATE_CONFIG_RECORDING 20

int boondock_application_state = STATE_INIT;
int boondock_recorder_state = STATE_INIT;
int boondock_network_state = STATE_INIT;

#define DEFAULT_CLEANUP_FILE_SYSTEM false // Cleanup files on intialize
// Initialize variables for the availability of WiFi, WiFi credentials, and SD card
bool wifi_available = false;
bool wifi_credentials_available = false;
bool sd_card_available = false;
bool mode_offline = false;

long previous_mqtt_millis_live = 0;
long previous_mqtt_millis_long = 0;
long previous_sd_millis_long = 0;

// Initialize variables for recording settings
bool auto_record = true;
bool ptt_pressed = false;
bool ptt_live_enabled = true;
bool record_on_button = false;

bool remote_line_recording = false;
bool remote_mic_recording = false;

// Store counters

float min_mic_db = 0;
float max_mic_db = 0;
float min_line_in_db = 0;
float max_line_in_db = 0;
float line_in_dB = 0;
float line_dB = 0;

int total_recordings = 0;
int total_uploads = 0;
int total_ptt_trigger = 0;
int total_db_trigger = 0;
int total_mqtt_errors = 0;
int total_upload_errors = 0;
int total_small_file_errors = 0;
int file_counter = 10000;
int total_cached = 0;
int total_downloads = 0;
int total_playback = 0;
int total_tx = 0;

long stack_network = 0;
long stack_recorder = 1;
long stack_led = 0;
long stack_keypad = 0;


// Buffers for output
static byte output_8BitArray[DEFAULT_BUFFER_SIZE];
uint16_t output16BitArray[DEFAULT_BUFFER_SIZE];
int16_t stereo_output_buffer[DEFAULT_BUFFER_SIZE];
int16_t stereo_input_buffer[DEFAULT_BUFFER_SIZE];

int16_t line_input_buffer[DEFAULT_BUFFER_SIZE / 2];
int16_t mic_input_buffer[DEFAULT_BUFFER_SIZE / 2];

bool notify_all_settings = false;
bool should_save_config = false;
bool should_update_codec = false;
bool should_reboot = false;
bool cdn_refresh_files = false;
bool codec_updated = false;
bool speaker_settings_updated = false;

bool user_interrupt = false; // used to stop recording on user interruption

struct AudioQueue
{
    int state; // 0= Clean, 1=File created, 2=Recording in progress, 3 = Recording complete
    String timeStamp;
    String filename;
    long dateOfBirth;
    long duration;
    long filesize;
    float audioLevel;
    int recordingType; // 0 for Line in, 1 for PTT, 2 for Remote Recording, 3 for Remote PTT
    String endReason;
};

AudioQueue AudioRecordingA;
AudioQueue AudioRecordingB;

#include "AudioKitHAL.h"
#include "SD_MMC.h"
#include <WiFi.h>
#include <Adafruit_NeoPixel.h>
#include "SineWaveGenerator.h"
#include <PinButton.h>

#include <NTPClient.h>
#include <WiFiUdp.h>

#include "movingAvg.h"
#include <EEPROM.h>

movingAvg average_line_in_decibel(100);

WiFiClient client;

// Define NTP Client to get time
WiFiUDP ntpUDP;
NTPClient timeClient(ntpUDP);

// Variables to save date and time
String formattedDate;
String dayStamp;
String timeStamp;

// Define functions that are shared

void beep(int beepLength, int beepDelay, int beepCount, int beepGood);
void download_cdn_audio_files(bool forceDelete);

#include "mqtt.h"
#include "sd_card_io.h"
#include "rgb_led.h"
#include "recorder.h"
#include "keypad.h"
#include "ota.h"

bool sd_check()
{

    if (millis() - previous_sd_millis_long >= DEFAULT_SD_STATUS_FREQUENCY)
    {
        previous_sd_millis_long = millis();

        // Check SD Card
        File root = SD_MMC.open("/");
        if (root)
        {
            root.close();
            sd_card_available = true;
        }
        else
        {
            SD_MMC.begin("/sdcard", true);
            sd_card_available = false;
        }
    }

    if (!sd_card_available)
    {
        Serial.println("SD card unavailable");
        return false;
    }
    else
        return true;
}

/***************************************************
 * split_audio_to_line_and_mic
 * Splits input buffer to left & right channels
 ****************************************************/
void split_audio_to_line_and_mic()
{
    // Split audio data into right & left channels
    for (int i = 0; i < DEFAULT_BUFFER_SIZE; i += 2)
    {
        mic_input_buffer[i / 2] = stereo_input_buffer[i];
        line_input_buffer[i / 2] = stereo_input_buffer[i + 1];
    }
}

/***************************************************
connect_wifi()

Connects to a WiFi network.
Tries to connect to three different WiFi networks in order.

Returns:

true: If connected to any WiFi network successfully.

false: If not connected to any WiFi network.
****************************************************/
bool connect_wifi()
{
    bool res = false; // Result of connection to WiFi network
    IPAddress primaryDNS;
    IPAddress secondaryDNS;
    primaryDNS.fromString(boondock_network_config.primaryDNS);
    secondaryDNS.fromString(boondock_network_config.secondaryDNS);

    WiFi.disconnect(); // Disconnect from any previous WiFi network

    WiFi.mode(WIFI_STA); // Set the mode to station (client) mode

    if (boondock_network_config.useStatic == 1)
    {
        //  Serial.println("Using Static IP");
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
        // Serial.println("Using Dynamic DHCP");
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
        WiFi.begin(ssid, password); // Attempt to connect to the current WiFi network

        // Loop for 5 iterations (5 * 500 ms = 2.5 seconds) to check if connected to the network
        for (int j = 0; j < 5; j++)
        {
            // If connected to the network, set the result to true and break out of the loop
            if (WiFi.status() == WL_CONNECTED)
            {
                res = true;
                break;
            }
            delay(500); // Wait for 500 milliseconds
        }

        // If connected, break out of the outer loop
        if (res)
            break;
    }

    // If not connected to any WiFi network, log a message
    if (!res)
    {
        KIT_LOGB("WiFi connectivity error");
    }

    return res;
}

bool connect_wifi_from_EEPROM(String mySSID, String myPass)
{
    bool res = false; // Result of connection to WiFi network

    WiFi.mode(WIFI_STA); // Set the mode to station (client) mode

    // Get MAC address and extract the last 6 digits

    String last6Digits = boondockMacAddress.substring(boondockMacAddress.length() - 8); // Considering ":" separators
    last6Digits.replace(":", "");                                                       // Remove the ":" separators

    // Construct the hostname
    String hostname = "Boondock_Echo" + last6Digits;
    WiFi.setHostname(hostname.c_str());

    WiFi.disconnect(); // Disconnect from any previous WiFi network
    delay(500);        // Wait for 1 second

    WiFi.begin(mySSID.c_str(), myPass.c_str()); // Attempt to connect to the current WiFi network

    // Loop for 5 iterations (5 * 500 ms = 2.5 seconds) to check if connected to the network
    for (int j = 0; j < 5; j++)
    {
        // If connected to the network, set the result to true and break out of the loop
        if (WiFi.status() == WL_CONNECTED)
        {
            res = true;

            break;
        }
        delay(500); // Wait for 500 milliseconds
    }

    return res;
}

void download_file_from_cloud(String wavFileName)
{
    if (!sd_check())
        return;
    send_mqtt_event("I46", wavFileName);
    // send_mqtt_state("Downloading audio");

    String file_location = "http://" + String(CDN_HOSTNAME) + "/uploads/" + wavFileName;
    String local_directory = SD_CARD_OUTBOX_LOCATION + wavFileName.substring(0, 12);
    String local_file_name = SD_CARD_OUTBOX_LOCATION + wavFileName;

    uint8_t readBuffer[512];
    size_t bytesRead = 0;

    if (!client.connect(CDN_HOSTNAME, 80))
    {
        send_mqtt_event("E16", wavFileName);
        return;
    }

    client.print(String("GET ") + file_location + " HTTP/1.1\r\n" +
                 "Host: " + CDN_HOSTNAME + "\r\n" +
                 "Connection: close\r\n\r\n");

    int content_length = -1;
    // Read the HTTP response headers from the server and discard them
    while (client.connected())
    {
        String line = client.readStringUntil('\n');

        if (line.startsWith("Content-Length: "))
        {
            content_length = line.substring(16).toInt();
        }

        if (line == "\r")
        {

            break;
        }
    }

    File file = SD_MMC.open(local_file_name, FILE_WRITE);

    // Check for errors when creating the file
    if (!file)
    {
        // Serial.println("Failed to create file!");
        return;
    }

    size_t total_bytes_read = 0;

    while (client.connected())
    {
        size_t bytes_to_read = min(sizeof(readBuffer), content_length - total_bytes_read);
        size_t bytes_read_now = client.readBytes(readBuffer, bytes_to_read);

        if (bytes_read_now > 0)
        {
            file.write(readBuffer, bytes_read_now);
            total_bytes_read += bytes_read_now;
        }
        else if (total_bytes_read == content_length)
        {
            break;
        }
        else
        {
            vTaskDelay(10);
        }
    }

    file.close();
    total_downloads++;

    send_mqtt_event("I50", wavFileName);
}

bool isWavFile(const char *filename)
{
    String fname = String(filename);
    return fname.endsWith(".wav") || fname.endsWith(".WAV");
}

bool moveFile(String sourcePath, String destPath)
{
    // Copy the file to the new location
    if (SD_MMC.rename(sourcePath.c_str(), destPath.c_str()))
    {
        // Serial.println("File moved successfully!");
        return true;
    }
    else
    {
        //  Serial.println("Failed to move file!");
        return false;
    }
}

void check_queue_and_upload()
{
    if (!sd_check())
        return;

    File root = SD_MMC.open("/queue");
    if (!root)
    {
        // Serial.println("Failed to open inbox directory!");
        send_mqtt_event("E24", "1");
        vTaskDelay(1000);
        return;
    }

    // List all files in the directory
    File entry = root.openNextFile();
    while (entry)
    {
        // if its current recordinf ile then...
        if (strcmp(entry.name(), my_recording_fileA.name()) == 0 || strcmp(entry.name(), my_recording_fileB.name()) == 0)
        {
            // Serial.print("Current recording files");
        }
        // If it's a WAV file
        else if (isWavFile(entry.name()))
        {

            // Check for the associated .txt file
            String txtFileName = SD_CARD_INBOX_LOCATION + String(entry.name()) + ".txt";
            // Read through the lines of the .txt file looking for "Timestamp:"
            String timestamp;
            int trigger;
            int duration;
            float decibel;
            int fileSize;
            if (SD_MMC.exists(txtFileName))
            {
                File txtFile = SD_MMC.open(txtFileName);
                if (txtFile)
                {

                    while (txtFile.available())
                    {
                        String line = txtFile.readStringUntil('\n');
                        if (line.startsWith("Timestamp:"))
                            timestamp = line.substring(11, line.length() - 1);

                        if (line.startsWith("Trigger:"))
                            trigger = line.substring(9, line.length() - 1).toInt();

                        if (line.startsWith("Duration:"))
                            duration = line.substring(10, line.length() - 1).toInt();
                        if (line.startsWith("Audio Level:"))
                            decibel = line.substring(13, line.length() - 1).toFloat();

                        if (line.startsWith("File Size:"))
                            fileSize = line.substring(11, line.length() - 1).toInt();
                    }

                    txtFile.close();
                }
                else
                {
                    send_mqtt_event("E20", "1");

                    // timestamp = line.substring(11, line.length() - 1);
                    trigger = 0;
                    duration = 0;
                    decibel = 0;
                    fileSize = 0;
                }

                if (timestamp.length() > 0 && entry.size() > 0)
                {
                    if (!upload_file_queue(SD_CARD_QUEUE_LOCATION + String(entry.name()), timestamp + ".wav", trigger, 1, duration, decibel, fileSize))
                        send_mqtt_event("E19", "1");

                    // Move the file from inbox to outbox
                    if (!moveFile(SD_CARD_QUEUE_LOCATION + String(entry.name()), SD_CARD_INBOX_LOCATION + timestamp + ".wav"))
                        send_mqtt_event("E25", "1");
                }
                else
                {
                    if (!moveFile(SD_CARD_QUEUE_LOCATION + String(entry.name()), SD_CARD_DISCARD_LOCATION + String(entry.name())))
                    {
                        KIT_LOGB("ERROR moving file %s%s", SD_CARD_QUEUE_LOCATION.c_str(), String(entry.name()).c_str());
                        SD_MMC.remove(SD_CARD_QUEUE_LOCATION + String(entry.name()));
                    }
                }
            }
        }
        entry.close();
        entry = root.openNextFile();
    }

    root.close();
}

/***************************************
****************************************/
void clean_up_queue_folder()
{
    if (!sd_check())
        return;

    File root = SD_MMC.open("/queue");
    if (!root)
    {
        // Serial.println("Failed to open inbox directory!");
        send_mqtt_event("E24", "1");
        vTaskDelay(1000);
        return;
    }

    // List all files in the directory
    File entry = root.openNextFile();
    while (entry)
    {

        if (!SD_MMC.remove(SD_CARD_QUEUE_LOCATION + String(entry.name())))
            send_mqtt_event("E26", "1");

        entry.close();
        entry = root.openNextFile();
    }

    root.close();
}

/***************************************
****************************************/
void task_network_execute(void *parameter)
{
    int completed_file_index;

    // Sending the config values once
    int totalmb = SD_MMC.totalBytes() / (1024 * 1024);
    int usedmb = SD_MMC.usedBytes() / (1024 * 1024);

    while (true)
    {

        stack_network = uxTaskGetStackHighWaterMark(NULL);

        mqttClient.loop();
        if (boondock_application_state == STATE_INIT)
        {
            vTaskDelay(100);
            continue;
        }

        if (cdn_refresh_files)
        {
            cdn_refresh_files = false;
            send_mqtt_event("I45", "1");
            download_cdn_audio_files(true);
        }

        // Looking for Audio playback Queue
        for (int i = 0; i < PLAYBACK_QUEUE; i++)
        {
            if (!my_playback_queue[i].local && !my_playback_queue[i].isEmpty && !my_playback_queue[i].played)
            {
                download_file_from_cloud(String(my_playback_queue[i].filename));
                my_playback_queue[i].filename = SD_CARD_OUTBOX_LOCATION + my_playback_queue[i].filename;
                my_playback_queue[i].mono = true;
                my_playback_queue[i].local = true;
            }
        }

        // check if there is any file available for renaming
        // completed_file_index = get_completed_queue_file();
        unsigned long currentMillis = millis();

        if (boondock_config.dock.upload_line_in)
            check_queue_and_upload();

        vTaskDelay(100);

        // if there is no file available for uploading or currently recording
        if (completed_file_index == -1)
        {
            // When not uplaoding, send the application state data
            if (currentMillis - previous_mqtt_millis_live >= DEFAULT_MQTT_LIVE_FREQUENCY)
            {
                previous_mqtt_millis_live = currentMillis;
                if (WiFi.status() != WL_CONNECTED)
                    wifi_available = false;
                else
                {
                    wifi_available = true;
 
                }
            }

            else
                vTaskDelay(100);
            boondock_network_state = STATE_WAITING;
        }
        else
        {
            boondock_network_state = STATE_NETWORK_SENDING;
            long int t1 = millis();

            boondock_network_state = STATE_WAITING;
        }
    }
}

void download_file(String wavFileName, String storeLocation, bool overwriteFile)
{
    if (!sd_check())
        return;

    String file_location = "http://" + String(CDN_HOSTNAME) + storeLocation + wavFileName;
    String local_file_name = storeLocation + wavFileName;

    if (SD_MMC.exists(local_file_name))
    {
        if (overwriteFile)
        {

            SD_MMC.remove(local_file_name);
            vTaskDelay(FS_DEFAULT_DELAY);
        }
        else
        {

            return;
        }
    }

    KIT_LOGB("Attempting download from %s", file_location.c_str());

    if (!client.connect(CDN_HOSTNAME, 80))
    {
        KIT_LOGE("Connection to server failed!");
        return;
    }

    // Send GET request
    client.print(String("GET ") + file_location + " HTTP/1.1\r\n" +
                 "Host: " + CDN_HOSTNAME + "\r\n" +
                 "Connection: close\r\n\r\n");

    int content_length = -1;

    // Read the HTTP response headers from the server and parse the Content-Length
    while (client.connected())
    {
        String line = client.readStringUntil('\n');
        if (line.startsWith("Content-Length: "))
        {
            content_length = line.substring(16).toInt();
            KIT_LOGB("Content-Length: %d", content_length);
        }
        // Check for the end of the headers
        if (line == "\r" || line == "\n" || line == "\r\n")
        {
            break;
        }
    }

    if (content_length <= 0)
    {
        KIT_LOGE("Invalid Content-Length or header not found!");
        return;
    }

    File file = SD_MMC.open(local_file_name, FILE_WRITE);

    if (!file)
    {
        KIT_LOGE("Failed to create file %s", local_file_name.c_str());
        return;
    }

    size_t total_bytes_read = 0;
    uint8_t readBuffer[512];

    while (total_bytes_read < content_length && client.connected())
    {
        size_t bytes_to_read = min(sizeof(readBuffer), content_length - total_bytes_read);
        size_t bytes_read_now = client.readBytes(readBuffer, bytes_to_read);

        if (bytes_read_now > 0)
        {
            file.write(readBuffer, bytes_read_now);
            total_bytes_read += bytes_read_now;
            KIT_LOGD("Read %d bytes, total %d/%d", bytes_read_now, total_bytes_read, content_length);
        }
    }

    file.close();

    if (total_bytes_read != content_length)
    {
        KIT_LOGB("Unexpected file size %d, expected %d", total_bytes_read, content_length);
        SD_MMC.remove(local_file_name); // Consider removing the file if it's incomplete
    }
    else
    {
        KIT_LOGB("File downloaded successfully %s", local_file_name.c_str());
    }
}

void download_cdn_audio_files(bool forceDelete = false)
{
    return;
    KIT_LOGB("Downloading CDN Files");

    // Assuming you have an HTTP client library like HTTPClient for ESP8266/ESP32
    HTTPClient http;

    // Open connection to the URL
    http.begin(CDN_SYSTEM_FILES);

    // Start connection and send HTTP header
    int httpCode = http.GET();

    if (httpCode > 0)
    {
        // HTTP header has been sent and server response has been handled
        if (httpCode == HTTP_CODE_OK)
        {
            String payload = http.getString();
            int pos = 0, prevPos = 0;

            // Splitting the string payload by new line and iterating over each file name
            while ((pos = payload.indexOf('\n', prevPos)) != -1)
            {
                String fileName = payload.substring(prevPos, pos);
                prevPos = pos + 1;

                // Check if file exists on SD card
                if (!SD_MMC.exists(SD_CARD_CDN_LOCATION + fileName))
                {
                    download_file(fileName, SD_CARD_CDN_LOCATION, true);
                }
            }

            // Handle the last file name if there's no newline after it
            if (prevPos < payload.length())
            {
                String fileName = payload.substring(prevPos);
                if (!SD_MMC.exists(SD_CARD_CDN_LOCATION + fileName))
                {
                    download_file(fileName, SD_CARD_CDN_LOCATION, true);
                }
            }
        }
    }
    else
    {
        KIT_LOGI("Failed to fetch the list of files. HTTP error code: %s", String(httpCode).c_str());
    }

    // Close connection
    http.end();

    KIT_LOGI("Downloading CDN Files. Complete");
}

void updateSpeaker(bool speakerState)
{
    if (boondock_config.dock.spkr_on && !speakerState)
    {
        send_mqtt_event("I05", "1");
        kit.setMute(true);
        boondock_config.dock.spkr_on = false;
    }
    else if (!boondock_config.dock.spkr_on && speakerState)
    {
        send_mqtt_event("I06", "1");
        kit.setMute(false);
        boondock_config.dock.spkr_on = true;
    }
    speaker_settings_updated = false;
}

void update_codec_params()
{
    codec_updated = false;

    kit.setVolume(boondock_config.dock.spkr_vol);
    updateSpeaker(boondock_config.dock.spkr_on);

    switch (boondock_config.recorder.line_in_gain)
    {

    case -1:
        es8388_set_mic_gain(MIC_GAIN_MIN);
        break;
    case 0:
        es8388_set_mic_gain(MIC_GAIN_0DB);
        break;
    case 3:
        es8388_set_mic_gain(MIC_GAIN_3DB);
        break;
    case 6:
        es8388_set_mic_gain(MIC_GAIN_6DB);
        break;
    case 9:
        es8388_set_mic_gain(MIC_GAIN_9DB);
        break;
    case 12:
        es8388_set_mic_gain(MIC_GAIN_12DB);
        break;
    case 15:
        es8388_set_mic_gain(MIC_GAIN_15DB);
        break;
    case 18:
        es8388_set_mic_gain(MIC_GAIN_18DB);
        break;
    case 21:
        es8388_set_mic_gain(MIC_GAIN_21DB);
        break;
    case 24:
        es8388_set_mic_gain(MIC_GAIN_24DB);
        break;
    default:
        KIT_LOGB("Invalid Gain value %s", boondock_config.recorder.line_in_gain);
        break;
    }
}

bool ValidWavData(WavHeader_Struct *Wav)
{

    if (memcmp(Wav->RIFFSectionID, "RIFF", 4) != 0)
    {

        return false;
    }
    if (memcmp(Wav->RiffFormat, "WAVE", 4) != 0)
    {

        return false;
    }
    if (memcmp(Wav->FormatSectionID, "fmt", 3) != 0)
    {

        return false;
    }
    if (memcmp(Wav->DataSectionID, "data", 4) != 0)
    {

        return false;
    }
    if (Wav->FormatID != 1)
    {

        return false;
    }
    if (Wav->FormatSize != 16)
    {

        return false;
    }
    if ((Wav->NumChannels != 1) & (Wav->NumChannels != 2))
    {

        return false;
    }
    if (Wav->SampleRate > 48000)
    {

        return false;
    }
    if ((Wav->BitsPerSample != 8) & (Wav->BitsPerSample != 16))
    {

        return false;
    }
    return true;
}

void PrintData(const char *Data, uint8_t NumBytes)
{
    for (uint8_t i = 0; i < NumBytes; i++)
        Serial.print(Data[i]);
    Serial.println();
}

void DumpWAVHeader(WavHeader_Struct *Wav)
{
    if (memcmp(Wav->RIFFSectionID, "RIFF", 4) != 0)
    {
        return;
    }
    if (memcmp(Wav->RiffFormat, "WAVE", 4) != 0)
    {

        return;
    }
    if (memcmp(Wav->FormatSectionID, "fmt", 3) != 0)
    {

        return;
    }
    if (memcmp(Wav->DataSectionID, "data", 4) != 0)
    {

        return;
    }
}

void play_wav_file_from_sd_card(String playFilename, bool singleChannel, int playback_vol, bool transmit)
{
    if (!sd_check())
        return;

    bool can_playback = false;

    // Wait for 30 seconds if its recording an audio
    for (int i = 0; i < 30; i++)
    {
        if (boondock_recorder_state == STATE_AUTO_RECORDING)
            vTaskDelay(1000);
        else
        {
            can_playback = true;
            break;
        }
    }

    boondock_application_state = STATE_PLAYBACK;
    KIT_LOGB("Play SD card file %s", playFilename.c_str());

    if (!SD_MMC.exists(playFilename))
    {
        KIT_LOGB("File not found %s ", playFilename.c_str());
        boondock_application_state = STATE_WAITING;
        return;
    }

    WavFile = SD_MMC.open(playFilename.c_str()); // Open the wav file
    if (WavFile == false)
        Serial.println("Could not open " + playFilename);
    else
    {
        WavFile.read((byte *)&WavHeader, 44);
        DumpWAVHeader(&WavHeader);
    }

    if (transmit)
    {
        //  send_mqtt_state("Transmit Start");
        total_tx++;
        digitalWrite(GPIO_PTT_OUT, HIGH); // Make it High to send PTT signal to radio
    }

    if (WavFile)
    {
        kit.setVolume(boondock_config.dock.tx_vol);
        updateSpeaker(true);

        //        KIT_LOGB("Playing %s", WavFile.size()); //Commented as it was causing kernal panic
        static bool ReadingFile = true;

        // uint16_t stereo_16BitArray[DEFAULT_BUFFER_SIZE * 2];

        while (true)
        {
            int BytesRead = WavFile.read(output_8BitArray, DEFAULT_BUFFER_SIZE); // Read in the bytes from the file

            // Copy the 8 bit data to 16 bit
            memcpy(output16BitArray, output_8BitArray, sizeof(output_8BitArray));

            // Loop through each sample in the mono buffer and copy it to both channels in the stereo buffer
            for (int i = 0; i < DEFAULT_BUFFER_SIZE / 2; i++)
            {
                if (boondock_config.dock.spkr_on && !transmit)
                    stereo_output_buffer[i * 2] = output16BitArray[i]; // Connected to Speaker
                else
                    stereo_output_buffer[i * 2] = 0; // Connected to Speaker

                stereo_output_buffer[i * 2 + 1] = output16BitArray[i]; // Connected to PTT Out
            }
            kit.write(stereo_output_buffer, BytesRead * 2);

            total_playback++;
            if (BytesRead == 0)
                break;
        }

        // Set the volume back
        kit.setVolume(boondock_config.dock.spkr_vol);
        updateSpeaker(boondock_config.dock.spkr_on);
    }

    if (transmit)
        digitalWrite(GPIO_PTT_OUT, LOW); // Make it low

    vTaskDelay(500);

    KIT_LOGB("Playback complete");
    boondock_application_state = STATE_WAITING;
}

/***********************************************************

**********************************************************/

void boondock_say(String playFilename, bool forcePlay, bool typeGood)
{
    if (!sd_check())
        return;
    updateSpeaker(true);

    playFilename = SD_CARD_CDN_LOCATION + playFilename;

    boondock_application_state = STATE_PLAYBACK;

    if (!boondock_config.dock.notify_on)
        if (!forcePlay)
        {
            kit.setVolume(boondock_config.dock.spkr_vol);
            if (typeGood)
                beep(200, 200, 1, true);
            else
                beep(200, 200, 1, false);

            boondock_application_state = STATE_WAITING;
            return;
        }

    if (!SD_MMC.exists(playFilename))
    {
        KIT_LOGB("File not found %s ", playFilename.c_str());
        boondock_application_state = STATE_WAITING;
        return;
    }

    WavFile = SD_MMC.open(playFilename.c_str()); // Open the wav file
    if (WavFile == false)
        Serial.println("Could not open " + playFilename);
    else
    {
        WavFile.read((byte *)&WavHeader, 44);
        DumpWAVHeader(&WavHeader);
    }

    if (WavFile)
    {
        kit.setVolume(boondock_config.dock.playback_vol);

        KIT_LOGB("Playing %s", WavFile.size());
        static bool ReadingFile = true;

        // uint16_t stereo_16BitArray[DEFAULT_BUFFER_SIZE * 2];

        while (true)
        {
            int BytesRead = WavFile.read(output_8BitArray, DEFAULT_BUFFER_SIZE); // Read in the bytes from the file

            // Copy the 8 bit data to 16 bit
            memcpy(output16BitArray, output_8BitArray, sizeof(output_8BitArray));

            if (true)
            {

                // Loop through each sample in the mono buffer and copy it to both channels in the stereo buffer
                for (int i = 0; i < DEFAULT_BUFFER_SIZE / 2; i++)
                {
                    stereo_output_buffer[i * 2] = output16BitArray[i]; // Onboard LOut Speaker
                    stereo_output_buffer[i * 2 + 1] = 0;               // PTT Out
                }
                if (boondock_config.dock.spkr_on)
                    kit.write(stereo_output_buffer, BytesRead * 2);
            }
            else
            {
                if (boondock_config.dock.spkr_on)
                    kit.write(output16BitArray, BytesRead);
            }

            if (BytesRead == 0)
                break;
        }

        // Set the volume back
        kit.setVolume(boondock_config.dock.spkr_vol);
    }

    KIT_LOGB("Playback Done!");
    boondock_application_state = STATE_WAITING;
}

/***********************************************

**********************************************/
void play_notification(String playFilename)
{

    if (!sd_check())
        return;
    // if (!boondock_config.dock.notify_on)
    //    return;

    bool singleChannel = false;
    int playback_vol = boondock_config.dock.playback_vol;
    bool transmit = false;

    int vol = kit.volume();

    boondock_application_state = STATE_PLAYBACK;

    if (!SD_MMC.exists(playFilename))
    {
        KIT_LOGI("File not found %s ", playFilename.c_str());
        boondock_application_state = STATE_WAITING;
        return;
    }

    WavFile = SD_MMC.open(playFilename.c_str()); // Open the wav file
    if (WavFile == false)
        Serial.println("Could not open " + playFilename);
    else
    {
        WavFile.read((byte *)&WavHeader, 44);
        DumpWAVHeader(&WavHeader);
    }

    KIT_LOGI("File size %d", WavFile.size());
    if (WavFile)
    {
        kit.setVolume(boondock_config.dock.playback_vol);

        KIT_LOGD("Playing %s", WavFile.size());
        static bool ReadingFile = true;

        while (true)
        {
            int BytesRead = WavFile.read(output_8BitArray, DEFAULT_BUFFER_SIZE); // Read in the bytes from the file
            memcpy(output16BitArray, output_8BitArray, sizeof(output_8BitArray));

            // Loop through each sample in the mono buffer and copy it to both channels in the stereo buffer
            for (int i = 0; i < DEFAULT_BUFFER_SIZE / 2; i++)
            {
                stereo_output_buffer[i * 2] = output16BitArray[i];     // Onboard LOut Speaker
                stereo_output_buffer[i * 2 + 1] = output16BitArray[i]; // PTT Out
            }

            if (boondock_config.dock.spkr_on)
                kit.write(stereo_output_buffer, BytesRead * 2);

            if (BytesRead == 0)
                break;
        }

        // Set the volume back
        kit.setVolume(boondock_config.dock.spkr_vol);
    }

    KIT_LOGD("Playback Done!");
    boondock_application_state = STATE_WAITING;
}

/***************************************************************************
 * Function Name: calculate_dB
Inputs: uint16_t *samples - pointer to an array of 16-bit samples
size_t sample_count - number of samples in the array
Output: float - calculated dB value
Description: This function calculates the dB value from the given samples.
It first calculates the root mean square (RMS) of the samples,
and then converts it to dB using the formula 20 * log10(RMS / 32767).
32767 is the maximum value that can be stored in a 16-bit unsigned integer.
*****************************************************************************/
float calculate_dB(int16_t *samples, size_t sample_count)
{
    // Initialize the root mean square (RMS) value to 0
    float rms = 0.0;
    float DB_constant = 32767.0; // 32767.0;
    // Loop through the samples
    for (int i = 0; i < sample_count; i++)
    {
        // Calculate the current sample value
        float sample = (float)samples[i] - DB_constant;
        // Add the square of the current sample value to the RMS value
        rms += sample * sample;
    }
    // Divide the RMS value by the number of samples
    rms /= sample_count;
    // Take the square root of the RMS value
    rms = sqrt(rms);
    // Return the dB value, calculated as 20 times the log10 of the RMS value divided by 32767
    return abs(20.0 * log10(rms / DB_constant));
}

/***************************************
 void create_empty_recording_file()
 Checks available file slots and creates a new file
****************************************/
void create_empty_recording_file(int idx)
{
    if (!sd_check())
        return;
    formattedDate = timeClient.getFormattedDate();
    formattedDate.replace(":", "-");

    if (idx == 0)
    {
        if (AudioRecordingA.state == 3)
        {
            // Create Log file
            String logFileName = SD_CARD_INBOX_LOCATION + String(AudioRecordingA.filename) + ".txt";
            // Write the structure to the file
            File dataFile = SD_MMC.open(logFileName, FILE_WRITE);
            if (dataFile)
            {
                dataFile.println("Timestamp: " + AudioRecordingA.timeStamp);
                dataFile.println("Filename: " + AudioRecordingA.filename);
                dataFile.println("Duration: " + String(AudioRecordingA.duration));
                dataFile.println("File Size: " + String(AudioRecordingA.filesize));
                dataFile.println("Audio Level: " + String(AudioRecordingA.audioLevel));
                dataFile.println("End Reason: " + String(AudioRecordingA.endReason));
                dataFile.println("Type: " + String(AudioRecordingA.recordingType));
                dataFile.close();
                vTaskDelay(100);
            }
            else
            {
                //  Serial.println("Error opening data file");
            }

            my_recording_fileA.close();
            // vTaskDelay(100);

            AudioRecordingA.state = 0;
        }

        file_counter++;

        String filename = formattedDate + "_" + String(file_counter) + "_A.wav";
        AudioRecordingA.filename = filename;

        // Serial.println("Create empty file " + filename);

        // snprintf(filename, sizeof(filename), "%s", AudioRecordingA.filename.c_str());

        for (int r = 0; r < MAX_FILE_CREATE_RETRIES; ++r)
        {
            my_recording_fileA = SD_MMC.open(SD_CARD_QUEUE_LOCATION + filename, FILE_WRITE);
            if (my_recording_fileA)
            {
                // KIT_LOGB("New slot A  - %s", AudioRecordingA.filename.c_str());
                empty_audio_fileA_created = true;
                AudioRecordingA.state = 1;
                break;
            }
            else if (r == MAX_FILE_CREATE_RETRIES - 1)
            {
                KIT_LOGI("Error A creating file %s", filename);
            }
        }
    }
    else if (idx == 1)
    {
        if (AudioRecordingB.state == 1 || AudioRecordingB.state == 2)
            return;

        if (AudioRecordingB.state == 3)
        {
            // Create Log file
            String logFileName = SD_CARD_INBOX_LOCATION + String(AudioRecordingB.filename) + ".txt";
            // Write the structure to the file
            File dataFile = SD_MMC.open(logFileName, FILE_WRITE);
            if (dataFile)
            {
                dataFile.println("Timestamp: " + AudioRecordingB.timeStamp);
                dataFile.println("Filename: " + AudioRecordingB.filename);
                dataFile.println("Duration: " + String(AudioRecordingB.duration));
                dataFile.println("File Size: " + String(AudioRecordingB.filesize));
                dataFile.println("Audio Level: " + String(AudioRecordingB.audioLevel));
                dataFile.println("End Reason: " + String(AudioRecordingB.endReason));
                dataFile.println("Type: " + String(AudioRecordingB.recordingType));
                dataFile.close();
                vTaskDelay(100);
            }
            else
            {
                //  Serial.println("Error opening data file");
            }

            KIT_LOGB("Close File B %s", AudioRecordingB.filename.c_str());
            my_recording_fileB.close();
            // vTaskDelay(100);

            AudioRecordingB.state = 0;
        }

        file_counter++;
        String filename = formattedDate + "_" + String(file_counter) + "_A.wav";

        AudioRecordingB.filename = filename;

        //  Serial.println("Create empty file " + filename);

        for (int r = 0; r < MAX_FILE_CREATE_RETRIES; ++r)
        {
            my_recording_fileB = SD_MMC.open(SD_CARD_QUEUE_LOCATION + filename, FILE_WRITE);
            if (my_recording_fileB)
            {
                //  KIT_LOGB("New slot B  - %s", AudioRecordingB.filename.c_str());
                empty_audio_fileB_created = true;
                AudioRecordingB.state = 1;
                break;
            }
            else if (r == MAX_FILE_CREATE_RETRIES - 1)
            {
                KIT_LOGI("Error B creating file %s", filename);
            }
        }
    }
}

void update_codec()
{
}

void init_recording_variables()
{
    is_recording = true;
    rec_start_time = millis();
    rec_silence_time = millis();
}

bool is_minimum_recording()
{
    if ((millis() - rec_start_time) > boondock_config.recorder.min_rec_sec)
        return true;
    else
    {
        rec_silence_time = millis();
        return false;
    }
}

bool is_maximum_recording()
{
    if ((millis() - rec_start_time) > boondock_config.recorder.max_rec_sec)
        return true;
    else
        return false;
}

bool is_silent(float dbLevel)
{
    if (dbLevel > boondock_config.recorder.line_in_min_db)
    {
        rec_silence_time = millis();
        return false;
    }
    else if ((millis() - rec_silence_time) > boondock_config.recorder.audio_stop_silence)
        return true;
    else
        return false;
}

void end_recording_variables()
{
    is_recording = false;
}

/***************************************
****************************************/
void beep(int beepLength, int beepDelay, int beepCount, int beepGood = true)
{
    kit.setVolume(20);
    if (beepGood)
    {
        for (int j = 0; j < beepCount; j++)
        {
            for (int i = 0; i < beepLength / 25; i++)
            {
                size_t len = wave_good.read(beep_buffer, 1024);
                if (boondock_config.dock.spkr_on)
                    kit.write(beep_buffer, len, portMAX_DELAY);
            }
            if (beepCount > 1)
                delay(beepDelay);
        }
    }
    else
    {
        for (int j = 0; j < beepCount; j++)
        {
            for (int i = 0; i < beepLength / 25; i++)
            {
                size_t len = wave_bad.read(beep_buffer, 1024);
                if (boondock_config.dock.spkr_on)
                    kit.write(beep_buffer, len, portMAX_DELAY);
            }
            if (beepCount > 1)
                delay(beepDelay);
        }
    }

    kit.setSpeakerActive(false);
    delay(300);
    kit.setSpeakerActive(true);

    kit.setVolume(boondock_config.dock.spkr_vol);
}

void init_mic_and_speaker()
{

    // Get the default configuration for AudioInputOutput
    auto cfg = kit.defaultConfig(AudioInputOutput);
    // Disable the SD card
    cfg.sd_active = false;
    // Set the ADC input to microphone
    cfg.adc_input = DEFAULT_INPUT;
    cfg.dac_output = DEFAULT_OUTPUT;

    // cfg.dac_output =
    // Set the sample rate to 16 kHz
    cfg.sample_rate = DEFAULT_AUDIO_SAMPLE_RATE;

    // Set the frequency of the wave to 700 Hz
    wave_good.setFrequency(700);
    wave_bad.setFrequency(2000);

    // Set the sample rate of the wave to the sample rate of the kit
    wave_good.setSampleRate(cfg.sampleRate());
    wave_bad.setSampleRate(cfg.sampleRate());

    // Initialize the kit with the configuration
    kit.begin(cfg);

    codec_updated = true;

    KIT_LOGD("I2S Config : Sample rate %d ", cfg.i2sConfig().sample_rate);
    KIT_LOGD("I2S Config : BPS %d ", cfg.i2sConfig().bits_per_sample);

    switch (cfg.i2sConfig().mode)
    {
    case I2S_MODE_MASTER:

        break;
    case I2S_MODE_SLAVE:

        break;
    default:

        break;
    }

    switch (cfg.i2sConfig().communication_format)
    {
    case I2S_COMM_FORMAT_STAND_I2S:
        KIT_LOGD("I2S Config : comm format I2S Philips");
        break;
    case I2S_COMM_FORMAT_STAND_MSB:
        KIT_LOGD("I2S Config : comm format MSB");
        break;
    case I2S_COMM_FORMAT_STAND_PCM_SHORT:
        KIT_LOGD("I2S Config : comm format PCM Short");
        break;
    case I2S_COMM_FORMAT_STAND_PCM_LONG:
        KIT_LOGD("I2S Config : comm format PSM Long");
        break;
    case I2S_COMM_FORMAT_STAND_MAX:
        KIT_LOGD("I2S Config : comm format Standard Max");
        break;
    default:
        KIT_LOGD("I2S Config : comm format Unknown");
        break;
    }

    switch (cfg.i2sConfig().channel_format)
    {
    case I2S_CHANNEL_FMT_ONLY_LEFT:
        KIT_LOGD("I2S Config : Channel Left");
        break;
    case I2S_CHANNEL_FMT_ONLY_RIGHT:
        KIT_LOGD("I2S Config : Channel Right");
        break;
    case I2S_CHANNEL_FMT_RIGHT_LEFT:
        KIT_LOGD("I2S Config : Channel Both");
        break;
    default:
        KIT_LOGD("I2S Config : Channel Unknown");
        break;
    }
}



#endif
