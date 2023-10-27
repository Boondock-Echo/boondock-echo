#ifndef __BOONDOCK_CONFIG__
#define __BOONDOCK_CONFIG__


#include <Arduino.h>

#define SW_VERSION "1.0.0"

 
#define   MAX_WIFI_RETRIES  3
#define   MAX_MQTT_RETRIES 10
#define   MQTT_RETRY_DELAY_MS  1000
#define   WIFI_RETRY_DELAY_MS  500

#define MAX_AUDIO_BUFFERS 2048 // Maximum audio buffers for recording

#define MQTT_PORT 1883
#define MQTT_RECONNECT_RETRY_DELAY 500
#define MQTT_TICKER_LOOP 1000

#define MQTT_TOPIC_DEFAULT_LENGTH 50
#define MQTT_MESSAGE_DEFAULT_LENGTH 100
#define MQTT_MESSAGE_JSON_DEFAULT_LENGTH 1024

#define APP_STATE_INIT 0
#define APP_STATE_WAITING 1
#define APP_STATE_ERROR 3
#define APP_STATE_INIT_SD_ERROR 4
#define APP_STATE_INIT_WIFI_ERROR 5

#define RADIO_STATE_INIT 0
#define RADIO_STATE_IDLE 1
#define RADIO_STATE_LINE_RECORDING 2
#define RADIO_STATE_MIC_RECORDING 3
#define RADIO_STATE_MIC_TX 4
#define RADIO_STATE_PLAYBACK 5

#define DEFAULT_AUDIO_ALERTS_VOLUME 50
#define DEFAULT_PLAYER_VOLUME 50
#define DEFAULT_TX_VOLUME 50

#define DEFAULT_SAMPLING_RATE 8000
#define BEEP_BUFFER_SIZE 2048

#define NETWORK_STATE_INIT 0
#define NETWORK_STATE_WAITING 1
#define NETWORK_STATE_SENDING 2
#define NETWORK_STATE_RECEIVING 3
#define NETWORK_STATE_LIVE_UPDATE 4

#define NUMPIXELS 3 // Number of Pixels connected
#define LED_NETWORK 0
#define LED_RADIO 1
#define LED_APP 2

#define READ_UPLOAD_RESPONSE true 

#define DEFAULT_LED_BRIGHTNESS 50

extern char SD_CARD_DISCARD_LOCATION[10];
extern char SD_CARD_QUEUE_LOCATION[10];
extern char SD_CARD_INBOX_LOCATION[10];
extern char SD_CARD_CDN_LOCATION[10];
extern char SD_CARD_OUTBOX_LOCATION[10];

extern char device_id[13]; // MAC address without colons is 12 characters + null terminator

extern bool config_mode;
extern bool shouldReboot;
extern bool shouldsaveConfig;

extern bool hasLicenseCode;
extern bool isRegistered;

const bool SD_INIT_MAX_RETRY = 5;
extern bool sdCardAvailable;
extern bool networkAvailable;

// LED Color hex values
#define OFF 0x000000
#define GREEN 0x00FF00  // Shows everything is okay
#define RED 0xFF0000    // Shows errors
#define BLUE 0x0000FF   // Shows device is online
#define WHITE 0xFFFFFF  // Initializing state
#define WHITE 0xFFFFFF  // Initializing state
#define ORANGE 0xFFA500 // Rx Color
#define PURPLE 0xDDA0DD //

#define AUDIO_INPUT_BUFFER_SIZE 1024

struct nConfig
{
    char ssid[32];     // = "boondockecho";
    char password[32]; // = "BoonHackMyDock";
    char ssid1[32];
    char password1[32];
    char ssid2[32];
    char password2[32];
    int useStatic = 0;
    // Static IP settings
    char ip[16];                       // default static IP
    char gateway[16];                  // default gateway
    char subnet[16];                   // default subnet mask
    char primaryDNS[16] = "8.8.8.8";   // default primary DNS
    char secondaryDNS[16] = "8.8.4.4"; // default secondary DNS
};

struct rConfig
{
    int16_t max_rec_sec = 30000;       // Maximum Recording size
    int16_t min_rec_sec = 1000;        // Minimum Recording size
    int16_t audio_stop_silence = 5000; // Silence detection based recording
    int16_t ptt_gain = 3;
    int16_t recorder_sensitivity = 90;
    int16_t line_in_gain = 3;
};
struct dConfig
{
    char name[64] = "My New Boondock";
    int32_t user_id = 0;
    char license[10] = "0000-0000";
    int8_t auto_update = true;
    int8_t spkr_on = true;
    int8_t notify_on = true;

    byte save_ptt_recording = 1;        // Save PTT recordings to SD Card
    byte upload_ptt_recording = 1;      // Upload PTT recordings to cloud
    byte record_line_in = 1;            // Should record Line in Audio
    byte upload_line_in = 1;            // Upload PTT recordings to cloud
    byte dynamic_silence_detection = 0; // Dynamically Detect sound. In this mode, there is no maximum recording & Minimum recording file size
    int8_t spkr_vol = DEFAULT_PLAYER_VOLUME;
    int8_t playback_vol = DEFAULT_PLAYER_VOLUME;
    int8_t alerts_vol = DEFAULT_AUDIO_ALERTS_VOLUME;
    int8_t tx_vol = 50;
    int8_t tx_on = false;
    int8_t tx_priority = 0;
};

struct BoondockConfig
{
    dConfig dock;
    rConfig recorder;
    int8_t version = 1;
    char firmware[8] = "0.0.0";
};

extern char boondock_config_filename[20];
extern char network_config_filename[20];
extern BoondockConfig boondock_config;
extern nConfig boondock_network_config;
extern bool mode_offline;

extern char mqtt_server[64];
extern char mqttUser[32];
extern char mqttPassword[32];
extern char mqttClientID[30];

extern int16_t stereoInputBuffer[AUDIO_INPUT_BUFFER_SIZE];
extern int16_t stereoOutputBuffer[AUDIO_INPUT_BUFFER_SIZE];
extern int16_t lineBuffer[AUDIO_INPUT_BUFFER_SIZE / 2];
extern int16_t micBuffer[AUDIO_INPUT_BUFFER_SIZE / 2];
extern float lineDB;

extern char BOONDOCK_DOMAIN[24];
extern char MQTT_SUB_DOMAIN[8] ;
extern char CDN_SUB_DOMAIN[8] ;
extern char WEB_SUB_DOMAIN[8] ;
extern char FIRMWARE_URL[12] ;
extern char CDN_LOCATION[18] ;
extern char UPLOAD_URL[18];
extern char CDN_SYSTEM_URL[32] ;

extern const char *BDK_ErrorMessages[];
extern const char *BDK_EventMessages[];

extern long sdTotalSpace;
extern long sdFreeSpace;
extern byte applicationState;
extern byte radioState;
extern byte networkState;

extern int total_recordings;
extern int total_uploads;
extern int total_ptt_trigger;
extern int total_db_trigger;
extern int total_mqtt_errors;
extern int total_upload_errors;
extern int total_small_file_errors;
extern int file_counter;
extern int total_cached;
extern int total_downloads;
extern int total_playback;
extern int total_tx;

extern bool CANCEL_RECORDING;

enum Record_Source
{
    SOURCE_LINE,
    SOURCE_PTT,
    SOURCE_MANUAL_LINE,
    SOURCE_MANUAL_PTT,
    SOURCE_STREAM,
    SOURCE_REMOTE
};

enum BDK_ErrorCode
{
    E_NONE,
    ES01_CARD_MOUNT_FAILED,
    ES02_NO_SD_CARD,
    ES03_SD_NOT_FORMATTED,
    ES04_RW_PERMISSION,
    ES05_UNKNOWN_SD_CARD_ERROR,
    ES06_SMALL_DISK,
    ES07_LARGE_DISK,
    ES08_INVALID_FILE_SYSTEM,
    ES09_UNDEFINED,
    ES10_UNDEFINED,
    EW01_WL_CONNECT_FAILED,
    EW02_WL_NO_SSID_AVAIL,
    EW03_WL_CONNECTION_LOST,
    EW04_WL_DISCONNECTED,
    EW05_WL_IDLE_STATUS,
    EW06_UNKNOWN,
    EW07_DNS_ERROR,
    EW08_SSID_MISSING,
    EW09_SSID_TOO_LONG,
    EW10_UNDEFINED,
    EU01_DNS_ERROR, // DNS Error when uploading
    EU02_UNDEFINED,
    EU03_UNDEFINED,
    EU04_UNDEFINED,
    EU05_UNDEFINED,
    EU06_UNDEFINED,
    EU07_UNDEFINED,
    EU08_UNDEFINED,
    EU09_UNDEFINED,
    EU10_UNDEFINED,
    ED01_SD_INIT_FAIL, // Error intializing SD Card
    ED02_HTTP_INIT_FAIL,
    ED03_HTTP_FAIL,
    ED04_NOT_ENOUGH_SPACE,
    ED05_FAILED_TO_OPEN_FILE,
    ED06_INCOMPLETE_FILE,
    ED07_UNDEFINED,
    ED08_UNDEFINED,
    ED09_UNDEFINED,
    ED10_UNDEFINED,
    EX01_UNDEFINED,
    EX02_UNDEFINED,
    EX03_UNDEFINED,
    EX04_UNDEFINED,
    EX05_UNDEFINED,
    EX06_UNDEFINED,
    EX07_UNDEFINED,
    EX08_UNDEFINED,
    EX09_UNDEFINED,
    EX10_UNDEFINED,
    ER01_SD_UNAVAILABLE,
    ER02_FILE_OPEN_FAIL,
    ER03_FILE_RENAME_FAIL,
    ER04_UNDEFINED,
    ER05_UNDEFINED,
    ER06_UNDEFINED,
    ER07_UNDEFINED,
    ER08_UNDEFINED,
    ER09_UNDEFINED,
    ER10_UNDEFINED
};

enum BDK_EventCode
{
    EV_NONE,
    EV00,
    EVENT_INIT_OK,
    EVENT_AUDIO_UPLOADED,
    EV03,
    EV04,
    EV05,
    EV06,
    EV07,
    EV08,
    EV09,
    EV10,
};


String getSystemFilesURL(String fileName); //Returns the Full path of the wav file name in CDN Server
String getFirmwareURL(String swVersion); //Returns the Full path of the wav file name in CDN Server
String getSystemFilesListURL(); // Returns path where systemfiles list from CDN Server 

String getFileUploadURL();  
String getCDNUploadURL();
String getCDNHostname();

#endif