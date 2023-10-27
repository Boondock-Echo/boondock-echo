

/*
- Complete the User onboarding process
- Impliment all MQTT commands
- Impliment OTA
- Impliment AP method
- Impliment Serial port config
- Impliment JSON based configurations
- Impliment reocrder audio upload


*/

#include "Arduino.h"
#include "config.h"
#include "disk.h"
#include "network.h"
#include "keyboard_led.h"
#include "recorder.h"

void setup()
{
    Serial.begin(115200);
    Serial.println("Hello Boondock Echo " + String(SW_VERSION));

    applicationState = APP_STATE_INIT;
    radioState = RADIO_STATE_INIT;
    networkState = NETWORK_STATE_INIT;

    // Initialize the LED display & Keypad
    xTaskCreatePinnedToCore(led_keypad_task_execute, "Task_LED_KEY", 2048, NULL, 1, NULL, 0);
    delay(100);

    sdCardAvailable = init_sd_card(); // Initialize SD Card
    if (sdCardAvailable)
    {
        init_file_system(); // Initializes using default Wifi & downloads CDN files
        check_file_system();
    }

    String myMac = WiFi.macAddress();
    myMac.replace(":","");
    Serial.println("MAC : " + myMac);

    xTaskCreatePinnedToCore(recorder_task_execute, "Task_Recorder", 20048, NULL, 1, NULL, 1);
    delay(3000);


 
    if (sdCardAvailable)
        xTaskCreatePinnedToCore(network_task_execute, "Task_Network", 20240, NULL, 1, NULL, 0);
    delay(1000);


    if (sdCardAvailable)
    {
        beep(1000, 1000, 1, true);
        vTaskDelay(2000);
    }
    else
    {
        for (int i = 0; i < 3; i++)
        {
            applicationState = APP_STATE_INIT_SD_ERROR;
            beep(1000, 1000, 3, false);
            vTaskDelay(5000);
        }

        vTaskDelay(30000);
        shutDownAudioKit(true);
    }

    // Ask user to setup Wifi only when it is not registered
    if (strcmp(boondock_network_config.ssid, "") == 0 && strcmp(boondock_config.dock.license, "0000-0000") != 0)
    {
        for (int i = 0; i < 3; i++)
        {
            playAudio("/system/B00.wav", DEFAULT_AUDIO_ALERTS_VOLUME);
            delay(30000);
        }
        shutDownAudioKit(true);
    }

    // Check if Boondock echo is registered
    if (boondock_config.dock.user_id == 0 && strcmp(boondock_config.dock.license, "0000-0000") != 0)
    {
        isRegistered = (boondock_config.dock.user_id != 0);
        playAudio("/system/B01.wav", DEFAULT_AUDIO_ALERTS_VOLUME);
        delay(1000);
        for (int i = 0; i < 2; i++)
        {
            isRegistered = (boondock_config.dock.user_id != 0);
            if (isRegistered)
                break;
            playAudio("/system/B02.wav", DEFAULT_AUDIO_ALERTS_VOLUME);
            vTaskDelay(1000);
            playAudio("/system/B04.wav", DEFAULT_AUDIO_ALERTS_VOLUME);

            String code = boondock_config.dock.license;
            playLicenseCode(code);
            vTaskDelay(1000);
            playAudio("/system/B04B.wav", DEFAULT_AUDIO_ALERTS_VOLUME);
            playLicenseCode(code);
            playAudio("/system/B04C.wav", DEFAULT_AUDIO_ALERTS_VOLUME);
            playLicenseCode(code);
            // Loop to check if it is registered
            for (int j = 0; j < 30; j++)
            {
                isRegistered = (boondock_config.dock.user_id != 0);

                if (isRegistered)
                {
                    playAudio("/system/B03.wav", DEFAULT_AUDIO_ALERTS_VOLUME);
                    save_boondock_config();
                    break;
                    vTaskDelay(1000);
                }
                else
                {
                    vTaskDelay(1000);
                    beep(250, 250, 1, true);
                }
            }
        }
        shutDownAudioKit(true);
    }

    if (String(SW_VERSION) == "0.0.0")
    {
        playAudio("/system/B05.wav", DEFAULT_AUDIO_ALERTS_VOLUME);
    }

    // Wait 10 seconds for network to be available
    for(int i=0; i < 10; i++)
    {
        if (!networkAvailable)
        vTaskDelay(1000);
    }

    if (networkAvailable)
    {
        String ota = isNewFirmwareAvailable(SW_VERSION);
        Serial.println("New firmware available");
         
        if (ota != "")
        {
            playAudio("/system/B06.wav", DEFAULT_AUDIO_ALERTS_VOLUME);
            Serial.println("Updating your fimrware");
            updateFirmware(ota);
        }
    }
    // Ask user to register

    applicationState = APP_STATE_WAITING;
    radioState = RADIO_STATE_IDLE;
    networkState = NETWORK_STATE_WAITING;
    Serial.println("Boondock Echo is ready to go!");
}
void loop()
{

    vTaskDelay(1000);
}