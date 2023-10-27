#include "Arduino.h"
#include  "eventHandler.h"
#include "esp_log.h"
#include "recorder.h"
#include "network.h"
#include "config.h"
#include "commandProcessor.h"
#include "disk.h"


// Initialize MQTT client with WiFi client
WiFiClient mywiFiClient;
PubSubClient mqttClient(httpClient);

String get_status_topic(String topic)
{
    return  "boondock/" + String(boondock_config.dock.user_id) + "/" + String(device_id) + "/" + topic;
}

/******************************

*******************************/
void mqtt_send_ticker()
{
    char buffer[1024]; // Adjust the size as needed to accommodate the full JSON string.

    // RAM usage statistics
    int freeRAM = esp_get_free_heap_size() / 1024; // free heap size in KB

    int64_t total_seconds = esp_timer_get_time() / 1000000;
    int64_t hours = total_seconds / 3600;          // 3600 seconds in an hour
    int64_t minutes = (total_seconds % 3600) / 60; // remainder when divided by 3600 gives minutes when divided by 60
    int64_t seconds = total_seconds % 60;          // remainder when divided by 60 gives seconds

    snprintf(buffer, sizeof(buffer),
             "{"
             "\"ram\":%d,"
             "\"reco\":%d,"
             "\"uplo\":%d,"
             "\"pttt\":%d,"
             "\"linet\":%d,"
             "\"cach\":%d,"
             "\"down\":%d,"
             "\"play\":%d,"
             "\"trans\":%d,"
             "\"uptime\":{\"h\":%lld,\"m\":%lld,\"s\":%lld}"
             "}",
             freeRAM, total_recordings, total_uploads, total_ptt_trigger, total_db_trigger, total_cached, total_downloads, total_playback, total_tx, hours, minutes, seconds);

    mqttClient.publish(get_status_topic("system_info").c_str(), buffer);
    mqttClient.publish(get_status_topic("status").c_str(), "online");
}


void sendMQTTEvent(String eventID, String value)
{
    bool res = false;

    if (!WiFi.isConnected())
        return;
    if (!mqttClient.connected())
        return;

    String topic = "boondock/" + String(boondock_config.dock.user_id) + "/" + String(device_id) + "/event/" + eventID;

    if (mqttClient.connected())
    {
        if (!mqttClient.publish(topic.c_str(), value.c_str(), false))
            total_mqtt_errors++;
    }
}

void handleError(BDK_ErrorCode errorCode)
{
    Serial.println( BDK_ErrorMessages[errorCode]);
    String audioFile = "/system/" + String(BDK_ErrorMessages[errorCode]).substring(0,4) + ".wav" ;
    playAudio( audioFile, DEFAULT_AUDIO_ALERTS_VOLUME);
}

void handleEvent(BDK_EventCode eventID, String message)
{
   //  Serial.println( BDK_EventMessages[eventID]);
     sendMQTTEvent(BDK_EventMessages[eventID], message);
}


/************************************************************************
Callback function to handle incoming MQTT messages.

Function Parameters:
- topic: The MQTT topic to which the message has been published.
- message: The received message in the form of a byte array.
- length: The length of the received message.
*************************************************************************/
void MQTTCallBack(char *topic, byte *message, unsigned int length)
{
    // Create a temporary String to hold the incoming message
    String value;

    // Convert byte array to string
    for (int i = 0; i < length; i++)
    {
        value += (char)message[i];
    }

    // Extract command from topic
    String cmd = String(topic).substring(26);
    processCommand(cmd, value);

    // Note: Validation and command processing logic are expected to be added here
}

/************************************************************************
Subscribe to the relevant topic for the device on the MQTT broker.
*************************************************************************/
void subscribe_to_topic()
{
    String substopic = "boondock/" + String(device_id) + "/set/#";
    char tempStringSubsTopic[MQTT_TOPIC_DEFAULT_LENGTH];
    substopic.toCharArray(tempStringSubsTopic, substopic.length() + 1);

    mqttClient.subscribe(tempStringSubsTopic);
}



/************************************************************************
Initialize the MQTT client and connect to the broker.
This function tries to connect to the MQTT broker repeatedly until it succeeds.
*************************************************************************/
void initMQTT()
{
    mqttClient.setServer(mqtt_server, MQTT_PORT);
    mqttClient.setCallback(MQTTCallBack);

    int retries = 0;
    while (!mqttClient.connected() && retries < MAX_MQTT_RETRIES)
    {
       // Serial.println("Connecting to boondock server...");

        String statusTopic = "boondock/" + String(boondock_config.dock.user_id) + "/" + device_id + "/status";
        if (mqttClient.connect(mqttClientID, mqttUser, mqttPassword, statusTopic.c_str(), 0, true, "offline"))
        {
            // mqttClient.publish(get_status_topic("system_info").c_str(), buffer);
            mqttClient.publish(get_status_topic("status").c_str(), "online");
            subscribe_to_topic();
            handleEvent(EVENT_INIT_OK, "Build-" + String(SW_VERSION));
            break; // Exit loop if connected
        }
        else
        {
            delay(MQTT_RETRY_DELAY_MS);
            retries++;
        }
    }
}