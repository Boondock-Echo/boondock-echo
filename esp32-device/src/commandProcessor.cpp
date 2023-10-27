#include "Arduino.h"
#include "config.h"
#include "disk.h"
#include "SD_MMC.h"
#include <ArduinoJson.h>
#include <WiFi.h>
#include "commandProcessor.h"

void processCommand(String cmd, String param)
{
    Serial.println("Received " + cmd + "  " + param);

    if (cmd == "config_mode")
    {
        if (param.toInt() == 1)
            config_mode = true;
        else
            config_mode = false;
    }
    else if (cmd == "record_line_in")
    {
        if (param.toInt() == 1)
        {
            boondock_config.dock.record_line_in = true;
            // sendMQTTEvent("I07", "1");
        }
        else
        {
            boondock_config.dock.record_line_in = false;
            // sendMQTTEvent("I08", "1");
        }
    }
    else if (cmd == "upload_line_in")
    {
        if (param.toInt() == 1)
        {
            boondock_config.dock.upload_line_in = true;
            //  sendMQTTEvent("I51", "1");
        }
        else
        {
            boondock_config.dock.record_line_in = false;
            //   sendMQTTEvent("I52", "1");
        }
    }
    else if (cmd == "upload_ptt_recording")
    {
        if (param.toInt() == 1)
        {
            boondock_config.dock.upload_ptt_recording = true;
            //  sendMQTTEvent("I55", "1");
        }
        else
        {
            boondock_config.dock.record_line_in = false;
            /// sendMQTTEvent("I56", "1");
        }
    }
    else if (cmd == "clean")
    {
        if (param.toInt() == 0)
        {
            SD_MMC.remove(boondock_config_filename);
            //  sendMQTTEvent("I55", "1");
            shouldReboot = true;
        }
        else if (param.toInt() == 1)
        {
            SD_MMC.remove(network_config_filename);
            shouldReboot = true;
            //  sendMQTTEvent("I56", "1");
        }
    }
    else if (cmd == "record_ptt" || cmd == "save_ptt_recording")
    {
        if (param.toInt() == 1)
        {
            boondock_config.dock.save_ptt_recording = true;
            // sendMQTTEvent("I11", "1");
        }
        else
        {
            boondock_config.dock.save_ptt_recording = false;
            // sendMQTTEvent("I12", "1");
        }
    }

    else if (cmd == "tx_on")
    {
        if (param.toInt() == 1)
        {
            boondock_config.dock.tx_on = true;
            //  sendMQTTEvent("I15", "Tx is enabled");
        }
        else
        {
            boondock_config.dock.tx_on = false;
            //   sendMQTTEvent("I16", "1");
        }
        shouldsaveConfig = true;
    }
    else if (cmd == "line_min_db" || cmd == "line_in_min_db")
    {
        boondock_config.recorder.recorder_sensitivity = (101 - param.toInt()) * 0.01;
        // sendMQTTEvent("I17", String(boondock_config.recorder.recorder_sensitivity));
        //  codec_updated = true;
        //  user_interrupt = true;
    }
    else if (cmd == "line_in_gain")
    {
        boondock_config.recorder.line_in_gain = param.toInt();
        // sendMQTTEvent("I18", String(boondock_config.recorder.line_in_gain));
        // codec_updated = true;
    }
    else if (cmd == "play_system")
    {
        //  add_playback_queue(param, false);
        // sendMQTTEvent("I19", param);
    }
    else if (cmd == "cache_only") // Download an audio file
    {
        // add_cache_queue(param, false);
        // sendMQTTEvent("I58", param);
    }
    else if (cmd == "cache_and_play") // Download an audio file and playback
    {
        //  add_cache_queue(param, true);
        //  sendMQTTEvent("I59", param);
    }

    else if (cmd == "play_cloud" || cmd == "play_sd") // Play a file from Cloud
    {
        // add_playback_queue(param, false);
        // sendMQTTEvent("I20", param);
    }
    else if (cmd == "transmit_cloud" || cmd == "play_transmit" || cmd == "transmit_sd") // Transmit a file from Cloud
    {
        // add_playback_queue(param, true);
        // sendMQTTEvent("I21", param);
    }
    else if (cmd == "max_rec_sec")
    {
        boondock_config.recorder.max_rec_sec = param.toInt();
        //  sendMQTTEvent("I24", param);
        //  codec_updated = true;
    }
    else if (cmd == "audio_stop_silence")
    {
        boondock_config.recorder.audio_stop_silence = param.toInt();
        // sendMQTTEvent("I23", param);
        //  codec_updated = true;
    }
    else if (cmd == "min_rec_sec")
    {
        boondock_config.recorder.min_rec_sec = param.toInt();
        // sendMQTTEvent("I22", param);
        // codec_updated = true;
    }

    else if (cmd == "spkr_on")
    {
        //  if (param.toInt() == 1)
        //      updateSpeaker(true);
        //  else
        //      updateSpeaker(false);
        //  speaker_settings_updated = true;
    }
    else if (cmd == "notify_on")
    {
        boondock_config.dock.notify_on = param.toInt();
        //  codec_updated = true;
    }

    else if (cmd == "spkr_vol")
    {
        boondock_config.dock.spkr_vol = param.toInt();
        // sendMQTTEvent("I25", param);
        // speaker_settings_updated = true;
    }
    else if (cmd == "playback_vol")
    {
        boondock_config.dock.playback_vol = param.toInt();
        // sendMQTTEvent("I28", param);
        // speaker_settings_updated = true;
        shouldsaveConfig = true;
    }

    else if (cmd == "auto_update")
    {
        boondock_config.dock.auto_update = param.toInt();
    }
    else if (cmd == "tx_vol")
    {
        // sendMQTTEvent("I30", param);
        boondock_config.dock.tx_vol = param.toInt();
        //  speaker_settings_updated = true;
    }
    else if (cmd == "start_rec_king")
    {
        // remote_line_recording = true;
        // sendMQTTEvent("I31", "1");
    }
    else if (cmd == "stop_rec_king")
    {
        // remote_line_recording = false;
        // sendMQTTEvent("I32", "1");
    }

    else if (cmd == "start_rec_queen")
    {
        //  remote_mic_recording = true;
        // sendMQTTEvent("I53", "1");
    }
    else if (cmd == "stop_rec_queen")
    {
        //  remote_mic_recording = false;
        //  sendMQTTEvent("I54", "1");
    }

    else if (cmd == "beep")
    {
        //  beep(250, 250, param.toInt(), true);
    }
    else if (cmd == "restart" || cmd == "reboot")
    {
        //  sendMQTTEvent("I33", "1");
        if (param == "save" || param == "yes" || param == "1" || param == "true")
            shouldsaveConfig = true;
        shouldReboot = true;
    }
    else if (cmd == "save")
    {
        // sendMQTTEvent("I34", "1");
        shouldsaveConfig = true;
    }
    else if (cmd == "notify_all_settings")
    {
        //  sendMQTTEvent("I57", "1");
        //  notify_all_settings = true;
    }
    else if (cmd == "cdn_refresh")
    {
        // sendMQTTEvent("I45", "1");
    }
    else if (cmd == "factory_reset")
    {
        BoondockConfig new_config;
        //   sendMQTTEvent("I35", "1");
        boondock_config = new_config;
        shouldsaveConfig = true;
        shouldReboot = true;
    }

    else if (cmd == "set_default")
    {
        //  sendMQTTEvent("I36", "1");
        BoondockConfig new_config;
        boondock_config = new_config;
        shouldsaveConfig = true;
        shouldReboot = true;
    }

    else if (cmd == "user_id")
    {
        if(boondock_config.dock.user_id != param.toInt())
        {
            boondock_config.dock.user_id = param.toInt();
            Serial.print("Received a new user ID " + String(param));
            save_boondock_config();
            esp_restart();
        }
    }
    else if (cmd == "license")
    {
        if (param.length() < sizeof(boondock_config.dock.license))
        {
            if (strcmp(boondock_config.dock.license, param.c_str()) != 0)
            {
                strlcpy(boondock_config.dock.license, param.c_str(), sizeof(boondock_config.dock.license));
                Serial.println("Received new license Code " + String(param));
                save_boondock_config();
            }
        }
    }
    else if (cmd == "dock_name" || cmd == "name")
    {
        strlcpy(boondock_config.dock.name, param.c_str(), param.length());
        //   sendMQTTEvent("I27", String(boondock_config.dock.name));
        shouldsaveConfig = true;
    }
    else if (cmd == "wifi_ssid")
    {
        strlcpy(boondock_network_config.ssid, param.c_str(), param.length());
    }
    else if (cmd == "wifi_password")
    {
        strlcpy(boondock_network_config.password, param.c_str(), param.length());
    }
    else if (cmd == "wifi1_ssid")
    {
        strlcpy(boondock_network_config.ssid1, param.c_str(), param.length());
    }
    else if (cmd == "wifi1_password")
    {
        strlcpy(boondock_network_config.password1, param.c_str(), param.length());
    }
    else if (cmd == "wifi2_ssid")
    {
        strlcpy(boondock_network_config.ssid2, param.c_str(), param.length());
    }
    else if (cmd == "wifi2_password")
    {
        strlcpy(boondock_network_config.password2, param.c_str(), param.length());
    }
    else if (cmd == "useStatic")
    {
        boondock_network_config.useStatic = param.toInt();
    }
    else if (cmd == "ip")
    {
        strlcpy(boondock_network_config.ip, param.c_str(), param.length());
    }
    else if (cmd == "gateway")
    {
        strlcpy(boondock_network_config.gateway, param.c_str(), param.length());
    }
    else if (cmd == "subnet")
    {
        strlcpy(boondock_network_config.subnet, param.c_str(), param.length());
    }
    else if (cmd == "primaryDNS")
    {
        strlcpy(boondock_network_config.primaryDNS, param.c_str(), param.length());
    }
    else if (cmd == "secondaryDNS")
    {
        strlcpy(boondock_network_config.secondaryDNS, param.c_str(), param.length());
    }
    else
    {
        // sendMQTTEvent("E00", cmd + "=" + param);
    }
}
