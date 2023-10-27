#include "Arduino.h"
#include "config.h"

char device_id[13]; 

char network_config_filename[] = "/network.json";
char boondock_config_filename[] = "/config.json";

char SD_CARD_DISCARD_LOCATION[] = "/trash/";
char SD_CARD_QUEUE_LOCATION[] = "/queue/";
char SD_CARD_INBOX_LOCATION[] = "/inbox/";
char SD_CARD_CDN_LOCATION[] = "/system/";
char SD_CARD_OUTBOX_LOCATION[] = "/outbox/";
// char dirs[] = {"/inbox", "/trash", "/queue", "/outbox", "/system"};

BoondockConfig boondock_config;
nConfig boondock_network_config;

bool mode_offline = false;
bool sdCardAvailable = false;
bool networkAvailable = false;

 
char mqtt_server[] = "yourmqttserver.com";
char mqttUser[] = "mqttuser";
char mqttPassword[] = "mqttpassword";
char mqttClientID[30];

char BOONDOCK_DOMAIN[] = "website.com";
char MQTT_SUB_DOMAIN[] = "mqtt.";
char CDN_SUB_DOMAIN[] = "cdn.";
char WEB_SUB_DOMAIN[] = "www.";
// URL's
char FIRMWARE_URL[] = "/fw/u_";
char CDN_LOCATION[] = "/system/";
char CDN_SYSTEM_URL[] = "/system/systemfiles.txt";

char UPLOAD_URL[] = "/upload.php";

bool config_mode = false;
bool shouldReboot = false;
bool shouldsaveConfig = false;
bool hasLicenseCode = false;
bool isRegistered = false;

long sdTotalSpace = 0; // Space in MB
long sdFreeSpace = 0;  // Space ion MB

byte applicationState = APP_STATE_INIT;
byte radioState = RADIO_STATE_INIT;
byte networkState = RADIO_STATE_INIT;

int16_t stereoInputBuffer[AUDIO_INPUT_BUFFER_SIZE];
int16_t stereoOutputBuffer[AUDIO_INPUT_BUFFER_SIZE];
int16_t lineBuffer[AUDIO_INPUT_BUFFER_SIZE / 2];
int16_t micBuffer[AUDIO_INPUT_BUFFER_SIZE / 2];
float lineDB = 0;

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
bool CANCEL_RECORDING = false;

const char *BDK_ErrorMessages[] = {
    "None",                                                   // E_NONE
    "SD card mount failed",                                   // ES01
    "No SD card attached",                                    // ES02
    "SD card not formatted correctly",                        // ES03
    "Failed to open file for writing",                        // ES04
    "Unknown error occurred while initializing SD card",      // ES05
    "Disk is too small",                                      // ES06
    "Disk is too large. only 32 GB and less is supported",    // ES07
    "Invalid file system",                                    // ES08
    "SD",                                                     // ES09
    "SD",                                                     // ES10
    "EW01 Connection failed due to incorrect password",       // EW01
    "EW02 WiFi router unreachable",                           // EW02
    "EW03 Connection lost",                                   // EW03
    "EW04 WiFi Disconnected",                                 // EW04
    "EW05 Wifi module is idle",                               // EW05
    "EW06 Unknown WiFi Error",                                // EW06
    "EW07 DNS Error. Unable to reach Boondock Servers",       // EW07
    "EW08 WiFi SSID is missing",                              // EW08
    "EW09 Invalid SSID. WiFi SSID too long",                  // EW09
    "EW10  WiFi",                                             // EW10
    "EU01 Upload",                                            // EU01
    "EU02 Upload",                                            // EU02
    "EU03 Upload",                                            // EU03
    "EU04 Upload",                                            // EU04
    "EU05 Upload",                                            // EU05
    "EU06 Upload",                                            // EU06
    "EU07 Upload",                                            // EU07
    "EU08 Upload",                                            // EU08
    "EU09 Upload",                                            // EU09
    "EU10 Upload",                                            // EU10
    "SD Card initialization failed when downloading file",    // ED01
    "HTTPClient initialization failed when downloading file", // ED02
    "HTTP Error",                                             // ED03
    "Not enough space to store file",                         // ED04
    "Failed to open file for writing",                        // ED05
    "Failed to completely download file",                     // ED06
    "ED07",                                                   // ED07
    "ED08",                                                   // ED08
    "ED09",                                                   // ED09
    "ED10",                                                   // ED10
    "EX01",                                                // EX01
    "EX02",                                                // EX02
    "EX03",                                                // EX03
    "EX04",                                                // EX04
    "EX05",                                                // EX05
    "EX06",                                                // EX06
    "EX07",                                                // EX07
    "EX08",                                                // EX08
    "EX09",                                                // EX09
    "EX10",                                                // EX10
    "ER01 Sd Card unavailable when recording audio",                                                // ER01
    "ER02 Unable to open audio file when recording audio",                                                // ER02
    "ER03 Unable to rename tmp to wav",                                                // ER03
    "ER04",                                                // ER04
    "ER05",                                                // ER05
    "ER06",                                                // ER06
    "ER07",                                                // ER07
    "ER08",                                                // ER08
    "ER09",                                                // ER09
    "ER10"                                                 // ER10
};

const char *BDK_EventMessages[] = {
    "None",                                                   // E_NONE
    "EV00",                                   // EV00
    "I01",                                   // EV01
    "I37",                                    // EV02
    "EV03",                                   // EV03
    "EV04",                                   // EV04
    "EV05",                                   // EV05
    "EV06",                                   // EV06
    "EV07",                                   // EV07
    "EV08",                                   // EV08
    "EV08",                                   // EV09
    "EV10"                                // EV10
};

String constructURL(String endpoint)
{
    return "http://" + String(CDN_SUB_DOMAIN) + String(BOONDOCK_DOMAIN) + endpoint;
}

String getCDNHostname()
{
    return String(CDN_SUB_DOMAIN) + String(BOONDOCK_DOMAIN);
}

String getCDNUploadURL()
{
    return constructURL(UPLOAD_URL);
}

String getSystemFilesListURL()
{
    return constructURL(String(CDN_SYSTEM_URL));
}

String getSystemFilesURL(String fileName)
{
    return constructURL(String(CDN_LOCATION) + fileName);
}

String getFirmwareURL(String swVersion)
{
    return constructURL(String(FIRMWARE_URL) + swVersion + ".bin");
}

String getFileUploadURL()
{
    return constructURL(String(UPLOAD_URL));
}
