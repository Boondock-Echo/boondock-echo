#include "Arduino.h"
#include "config.h"
#include "disk.h"
#include "SD_MMC.h"
#include <ArduinoJson.h>
#include <WiFi.h>
#include "eventHandler.h"
#include "network.h"

/*****************************
safeStrlcpy
void ()
Safely copies char to config file variable
******************************/
void safeStrlcpy(char *dest, JsonVariant src, size_t destSize)
{
    if (src.is<const char *>())
    {
        strlcpy(dest, src.as<const char *>(), destSize);
    }
}

bool isValidLicense(const char *license)
{
    if (strlen(license) != 9)
    {
        return false;
    }
    if (license[4] != '-')
    {
        return false;
    }
    for (int i = 0; i < 4; i++)
    {
        if (!isalpha(license[i]))
        {
            return false;
        }
    }
    for (int i = 5; i < 9; i++)
    {
        if (!isalpha(license[i]))
        {
            return false;
        }
    }
    return true;
}

/*****************************
read_boondock_config
void ()
Reads boondock configuration from the SD card.
******************************/
void read_boondock_config()
{
    File file = SD_MMC.open(boondock_config_filename);
    if (!file)
    {
        Serial.println("Failed to open config file for reading");
        return;
    }

    StaticJsonDocument<1024> doc;
    DeserializationError error = deserializeJson(doc, file);
    if (error)
    {
        Serial.println("Failed to parse config file");
        file.close();
        return;
    }

    file.close(); // Close file as soon as we're done reading

    boondock_config.version = doc["version"];
    safeStrlcpy(boondock_config.firmware, doc["firmware"], sizeof(boondock_config.firmware));

    JsonVariant dock = doc["dock"];
    if (dock)
    {
        boondock_config.dock.user_id = dock["user_id"];
        safeStrlcpy(boondock_config.dock.license, dock["license"], sizeof(boondock_config.dock.license));

        hasLicenseCode = isValidLicense(boondock_config.dock.license);

        if (boondock_config.dock.user_id > 0)
            isRegistered = true;

        safeStrlcpy(boondock_config.dock.name, dock["name"], sizeof(boondock_config.dock.name));
        boondock_config.dock.spkr_on = dock["spkr_on"];
        boondock_config.dock.notify_on = dock["notify_on"];
        boondock_config.dock.tx_on = dock["tx_on"] | false;
        boondock_config.dock.spkr_vol = dock["spkr_vol"];
        boondock_config.dock.playback_vol = dock["playback_vol"];
        boondock_config.dock.tx_vol = dock["tx_vol"];
        boondock_config.dock.upload_line_in = dock["upload_line_in"];
        boondock_config.dock.record_line_in = dock["record_line_in"];
        boondock_config.dock.dynamic_silence_detection = dock["dynamic_silence_detection"];
        boondock_config.dock.upload_ptt_recording = dock["upload_ptt_recording"];
        boondock_config.dock.save_ptt_recording = dock["save_ptt_recording"];

        boondock_config.dock.auto_update = doc["dock"]["auto_update"];
        boondock_config.dock.tx_priority = doc["dock"]["tx_priority"];
    }

    JsonVariant recorder = doc["recorder"];
    if (recorder)
    {
        boondock_config.recorder.audio_stop_silence = recorder["audio_stop_silence"];
        boondock_config.recorder.min_rec_sec = recorder["min_rec_sec"];
        boondock_config.recorder.max_rec_sec = recorder["max_rec_sec"];
        boondock_config.recorder.recorder_sensitivity = recorder["line_in_min_db"];
        boondock_config.recorder.line_in_gain = recorder["line_in_gain"];
        boondock_config.recorder.ptt_gain = recorder["ptt_gain"];
    }
}

/*****************************
read_network_config
void ()
Reads network configuration from the SD card and populates the global structure.
******************************/
void read_network_config()
{
    Serial.print("Loading WiFi settings");

    File file = SD_MMC.open(network_config_filename);
    if (!file)
    {
        Serial.println("Failed to open WiFi network settings file");
        return;
    }

    StaticJsonDocument<1024> doc;
    DeserializationError error = deserializeJson(doc, file);
    file.close(); // Close file as soon as we're done reading

    if (error)
    {
        Serial.println("Failed to read file, create Default Network config file");
        return;
    }

    // Network
    safeStrlcpy(boondock_network_config.password, doc["password"], sizeof(boondock_network_config.password));
    safeStrlcpy(boondock_network_config.ssid, doc["ssid"], sizeof(boondock_network_config.ssid));
    safeStrlcpy(boondock_network_config.password1, doc["password1"], sizeof(boondock_network_config.password1));
    safeStrlcpy(boondock_network_config.ssid1, doc["ssid1"], sizeof(boondock_network_config.ssid1));
    safeStrlcpy(boondock_network_config.password2, doc["password2"], sizeof(boondock_network_config.password2));
    safeStrlcpy(boondock_network_config.ssid2, doc["ssid2"], sizeof(boondock_network_config.ssid2));

    boondock_network_config.useStatic = doc["useStatic"];
    safeStrlcpy(boondock_network_config.ip, doc["ip"], sizeof(boondock_network_config.ip));
    safeStrlcpy(boondock_network_config.gateway, doc["gateway"], sizeof(boondock_network_config.gateway));
    safeStrlcpy(boondock_network_config.subnet, doc["subnet"], sizeof(boondock_network_config.subnet));
    safeStrlcpy(boondock_network_config.primaryDNS, doc["primaryDNS"], sizeof(boondock_network_config.primaryDNS));
    safeStrlcpy(boondock_network_config.secondaryDNS, doc["secondaryDNS"], sizeof(boondock_network_config.secondaryDNS));

    Serial.println(" Done!");
}

/*****************************
init_file_system
void ()
Initializes the directory structure on the SD card.
******************************/
void init_file_system()
{
    Serial.print("Init file system : ");
    if (!SD_MMC.exists("/system/B00.wav"))
    {
        Serial.println("initializing file system");
        SD_MMC.mkdir("/system");
        if (!WiFi.isConnected())
        {

            WiFi.begin("AAA", "608980608980");
            for (int j = 0; j < 5; j++)
            {
                // If connected to the network, set the result to true and break out of the loop
                if (WiFi.status() == WL_CONNECTED)
                {
                    Serial.print("Connected to Boondock WiFi Portal");
                    Serial.println(WiFi.SSID());

                    break;
                }
                delay(500); // Wait for 500 milliseconds
            }

            download_cdn_files();
        }

        // Checking the config files
        if (!SD_MMC.exists(network_config_filename))
            save_network_config();
        if (!SD_MMC.exists(boondock_config_filename))
            save_boondock_config();

        read_network_config();
        read_boondock_config();
        WiFi.disconnect();
    }

    Serial.println("Done!");
}

void cleanupDirectory(const char *dirPath)
{
    File root = SD_MMC.open(dirPath);

    Serial.print("Cleaning up storage :");

    if (!root)
    {
        Serial.println("Failed to open directory");
        return;
    }

    if (!root.isDirectory())
    {
        Serial.println("Not a directory");
        return;
    }

    File file = root.openNextFile();
    while (file)
    {
        if (file.isDirectory())
        {
            cleanupDirectory(file.path());
            SD_MMC.rmdir(file.path());
        }
        else
        {
            if (file.size() == 0 || String(file.name()).endsWith(".tmp"))
            {
                file.close();
                SD_MMC.remove(file.path());
            }
        }
        file = root.openNextFile();
    }
    root.close();
    Serial.println(" Done!");
}

/*****************************
init_file_system
void ()
Initializes the directory structure on the SD card.
******************************/
void check_file_system()
{
    Serial.print("Checking file system :");

    if (!SD_MMC.exists("/inbox"))
        SD_MMC.mkdir("/inbox");

    if (!SD_MMC.exists("/trash"))
        SD_MMC.mkdir("/trash");

    if (!SD_MMC.exists("/queue"))
        SD_MMC.mkdir("/queue");

    if (!SD_MMC.exists("/outbox"))
        SD_MMC.mkdir("/outbox");

    if (!SD_MMC.exists("/system"))
    {
        SD_MMC.mkdir("/system");
    }

    // Checking the config files
    if (!SD_MMC.exists(network_config_filename))
        save_network_config();
    if (!SD_MMC.exists(boondock_config_filename))
        save_boondock_config();

    read_network_config();
    read_boondock_config();

    Serial.println(" Done!");

    // Cleaup queue folder
    cleanupDirectory("/queue");
}

/*****************************
init_sd_card
bool ()
Initializes the SD card and sets global variables for total and free space.
Returns: true if initialization successful, false otherwise.
******************************/
bool init_sd_card()
{
    const int maxRetries = 5;
    const long kilobyte = 1024;
    const long megabyte = kilobyte * 1024;
    BDK_ErrorCode errorCode = E_NONE;
    bool r;

    for (int i = 0; i < maxRetries; i++)
    {
        if (!SD_MMC.begin("/sdcard", true, true))
        {
            errorCode = ES01_CARD_MOUNT_FAILED;
        }
        else if (SD_MMC.cardType() == CARD_NONE)
        {
            errorCode = ES02_NO_SD_CARD;
        }
        else if (SD_MMC.totalBytes() == 0)
        {
            errorCode = ES03_SD_NOT_FORMATTED;
        }
        else
        {
            File testFile = SD_MMC.open("/test.txt", FILE_WRITE);
            if (!testFile)
            {
                errorCode = ES04_RW_PERMISSION;
                testFile.close();
            }
            else
            {
                sdCardAvailable = true;
                const u_long gigabyte = megabyte * 1024;

                sdCardAvailable = true;

                sdTotalSpace = SD_MMC.totalBytes() / megabyte;
                sdFreeSpace = SD_MMC.usedBytes() / megabyte;

                if (sdTotalSpace < 900)
                {
                    errorCode = ES06_SMALL_DISK;
                    sdCardAvailable = false; // Marking card as unavailable due to size constraint
                }
                else if (sdTotalSpace > 32768)
                {
                    errorCode = ES07_LARGE_DISK;
                    sdCardAvailable = false; // Marking card as unavailable due to size constraint
                }

                break;
            }
        }
    }
    if (errorCode != E_NONE)
    {
        handleError(errorCode);
        return false;
    }
    else
        return sdCardAvailable;
}

/*****************************
save_network_config
void ()
Saves the current network configuration to the SD card.
******************************/
void save_network_config()
{
    if (!sdCardAvailable)
        return;

    // Delete existing file, otherwise the configuration is appended to the file
    if (SD_MMC.exists(network_config_filename))
    {
        SD_MMC.remove(network_config_filename);
        vTaskDelay(100);
    }

    // Open file for writing
    File file = SD_MMC.open(network_config_filename, FILE_WRITE);
    if (!file)
    {
        return;
    }

    StaticJsonDocument<1024> doc;

    // Set the values in the document
    doc["ssid"] = boondock_network_config.ssid;
    doc["password"] = boondock_network_config.password;
    doc["ssid1"] = boondock_network_config.ssid1;
    doc["password1"] = boondock_network_config.password1;
    doc["ssid2"] = boondock_network_config.ssid2;
    doc["password2"] = boondock_network_config.password2;

    doc["useStatic"] = boondock_network_config.useStatic;
    doc["ip"] = boondock_network_config.ip;
    doc["gateway"] = boondock_network_config.gateway;
    doc["subnet"] = boondock_network_config.subnet;
    doc["primaryDNS"] = boondock_network_config.primaryDNS;
    doc["secondaryDNS"] = boondock_network_config.secondaryDNS;

    // Serialize JSON to file
    if (serializeJson(doc, file) == 0)
    {
        Serial.println("Failed to create network.json");
    }

    // Close the file
    file.close();
}

/*****************************
save_boondock_config
void ()
Saves the current boondock configuration to the SD card.
******************************/
void save_boondock_config()
{
    if (!sdCardAvailable)
        return;

    // Delete existing file, otherwise the configuration is appended to the file
    if (SD_MMC.exists(boondock_config_filename))
    {
        SD_MMC.remove(boondock_config_filename);
        vTaskDelay(100);
    }

    // Open file for writing
    File file = SD_MMC.open(boondock_config_filename, FILE_WRITE);
    if (!file)
    {
        return;
    }

    StaticJsonDocument<1024> doc;

    String macAddress = WiFi.macAddress();
    macAddress.replace(":", "");

    doc["mac"] = macAddress;
    doc["version"] = boondock_config.version;
    // Device Config
    doc["dock"]["name"] = boondock_config.dock.name;
    doc["dock"]["user_id"] = boondock_config.dock.user_id;
    doc["dock"]["license"] = boondock_config.dock.license;
    doc["dock"]["spkr_vol"] = boondock_config.dock.spkr_vol;
    doc["dock"]["tx_priority"] = boondock_config.dock.tx_priority;
    doc["dock"]["record_line_in"] = boondock_config.dock.record_line_in;
    doc["dock"]["upload_line_in"] = boondock_config.dock.upload_line_in;
    doc["dock"]["dynamic_silence_detection"] = boondock_config.dock.dynamic_silence_detection;
    doc["dock"]["upload_ptt_recording"] = boondock_config.dock.upload_ptt_recording;
    doc["dock"]["save_ptt_recording"] = boondock_config.dock.save_ptt_recording;
    doc["dock"]["playback_vol"] = boondock_config.dock.playback_vol;
    doc["dock"]["tx_vol"] = boondock_config.dock.tx_vol;
    doc["dock"]["spkr_on"] = boondock_config.dock.spkr_on;
    doc["dock"]["notify_on"] = boondock_config.dock.notify_on;
    doc["dock"]["tx_on"] = boondock_config.dock.tx_on;
    doc["dock"]["auto_update"] = boondock_config.dock.auto_update;
    doc["dock"]["auto_update"] = boondock_config.dock.auto_update;
    doc["dock"]["tx_priority"] = boondock_config.dock.tx_priority;

    // Recorder Config
    doc["recorder"]["audio_stop_silence"] = boondock_config.recorder.audio_stop_silence;
    doc["recorder"]["max_rec_sec"] = boondock_config.recorder.max_rec_sec;
    doc["recorder"]["min_rec_sec"] = boondock_config.recorder.min_rec_sec;
    doc["recorder"]["ptt_gain"] = boondock_config.recorder.ptt_gain;
    doc["recorder"]["line_in_min_db"] = round(boondock_config.recorder.recorder_sensitivity * 100.0) / 100.0;
    doc["recorder"]["line_in_gain"] = boondock_config.recorder.line_in_gain;

    doc["version"] = boondock_config.version;

    // Serialize JSON to file
    if (serializeJson(doc, file) == 0)
    {
        Serial.println("Failed to create boondock_config.json");
    }

    // Close the file
    file.close();
}
