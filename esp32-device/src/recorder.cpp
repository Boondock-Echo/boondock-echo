
#include "Arduino.h"
#include "recorder.h"
#include "config.h"
#include "AudioKitHAL.h"
#include "AudioTools.h"
#include "SD_MMC.h"
#include "FS.h"
#include "network.h"
#include "SineWaveGenerator.h"
#include "eventHandler.h"

AudioKit kit;
class CircularBuffer
{
private:
    int16_t *buffer;
    size_t capacity; // total buffer size
    size_t count;    // number of elements currently in buffer
    size_t head;     // head index
    size_t tail;     // tail index

public:
    CircularBuffer(size_t size) : capacity(size), count(0), head(0), tail(0)
    {
        buffer = new int16_t[size];
    }

    ~CircularBuffer()
    {
        delete[] buffer;
    }

    void push(int16_t value)
    {
        buffer[head] = value;
        if (++head == capacity)
        {
            head = 0;
        }
        if (count == capacity)
        {
            if (++tail == capacity)
            {
                tail = 0;
            }
        }
        else
        {
            ++count;
        }
    }

    void pushArray(int16_t *data, size_t len)
    {
        for (size_t i = 0; i < len; i++)
        {
            push(data[i]);
        }
    }

    // To extract last 500ms of audio, the size should be equivalent to 500ms of audio samples
    void extractLast(int16_t *dest, size_t size)
    {
        if (size > count)
            size = count; // don't extract more than what we have
        size_t idx = count - size + tail;
        for (size_t i = 0; i < size; i++)
        {
            dest[i] = buffer[(idx + i) % capacity];
        }
    }

    void clear()
    {
        count = 0;
        head = 0;
        tail = 0;
    }
};

float measureAudioLevel(int16_t *samples, size_t sample_count)
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
void splitAudioBuffer(int readBytes)
{
    // Split audio data into right & left channels
    for (int i = 0; i < readBytes; i += 2)
    {
        micBuffer[i / 2] = stereoInputBuffer[i];
        lineBuffer[i / 2] = stereoInputBuffer[i + 1];
    }
}

WaveHeader makeWaveHeader(int byteCount)
{
    WaveHeader myHeader;

    memcpy(myHeader.RIFF, "RIFF", 4);
    myHeader.chunkSize = byteCount + sizeof(WaveHeader) - 8;
    memcpy(myHeader.WAVE, "WAVE", 4);
    memcpy(myHeader.fmt, "fmt ", 4);
    myHeader.subchunk1Size = 16;
    myHeader.audioFormat = 1; // PCM
    myHeader.numChannels = 1; // Mono
    myHeader.sampleRate = DEFAULT_SAMPLING_RATE;
    myHeader.byteRate = DEFAULT_SAMPLING_RATE * 1 * 16 / 8; // sampleRate * numChannels * bitsPerSample/8
    myHeader.blockAlign = 1 * 16 / 8;                       // numChannels * bitsPerSample/8
    myHeader.bitsPerSample = 16;                            // 16 bits per sample
    memcpy(myHeader.subchunk2ID, "data", 4);
    myHeader.subchunk2Size = byteCount;
    return myHeader;
}

bool recordAudioStart(String filename, int16_t *preAudio, size_t preAudioSize)
{
    if (applicationState == APP_STATE_INIT) // If application is initalizing then dont record
        return false;

    if (!sdCardAvailable)
    {
        handleError(ER01_SD_UNAVAILABLE);
        return false;
    }

    radioState = RADIO_STATE_LINE_RECORDING;
    CANCEL_RECORDING = false;
    bool res = false;

    String tmpFilename = filename + ".tmp"; // Temporary filename
    File audioFile = SD_MMC.open(tmpFilename.c_str(), FILE_WRITE);

    if (!audioFile)
    {
        handleError(ER02_FILE_OPEN_FAIL);
        return res;
    }

    radioState = RADIO_STATE_LINE_RECORDING;

    WaveHeader header = makeWaveHeader(0); // Placeholder header
    audioFile.write((byte *)&header, sizeof(header));

    // Serial.print("REC Start ");

    int totalBytes = 0;
    int maxBytes = boondock_config.recorder.max_rec_sec * 16 * sizeof(short);         // Assuming 16-bit audio, so 2 bytes per sample
    int silenceBytes = 0;                                                             // To keep track of sustained silence
    int silenceThreshold = boondock_config.recorder.min_rec_sec * 16 * sizeof(short); // Equivalent to 3 seconds of audio
    String endReason = "REC Stop - Max Buffers";

    // Write the pre-audio data first before starting the loop
    audioFile.write((byte *)preAudio, preAudioSize);

    for (int i = 0; i < MAX_AUDIO_BUFFERS; i++)
    {
        size_t bytes_read = kit.read(stereoInputBuffer, DEFAULT_BUFFER_SIZE, portMAX_DELAY);

        // Split buffer to lineBuffer and micBuffer
        splitAudioBuffer(bytes_read); // Assuming this extracts the desired channel's data into stereoInputBuffer
        totalBytes += bytes_read / 2;

        // Measure the audio level in the input buffer
        lineDB = measureAudioLevel(lineBuffer, bytes_read / 4);
        int lineDBInt = lineDB * 100;

        bool hasSound = lineDBInt > (100 - boondock_config.recorder.recorder_sensitivity);

        if (hasSound)
            silenceBytes = 0;
        else
            silenceBytes += bytes_read;

        if (silenceBytes >= silenceThreshold || totalBytes >= maxBytes || CANCEL_RECORDING)
        {
            if (silenceBytes >= silenceThreshold)
                endReason = "REC Stop - No Sound";
            else if (totalBytes >= maxBytes)
                endReason = "REC stop - Max Size";
            else
                endReason = "REC stop - user Cancel";
            break;
        }

        for (int j = 0; j < bytes_read / 2; j++)
        {
            stereoOutputBuffer[j * 2] = stereoInputBuffer[j];
            stereoOutputBuffer[j * 2 + 1] = 0;
        }

        //  if (boondock_config.dock.spkr_on)
        //      kit.write(stereoOutputBuffer, bytes_read);

        audioFile.write((byte *)&lineBuffer, bytes_read / 2);
    }

    // Serial.println("\nRecording complete: " + filename);
    //Serial.print(endReason); // Print out the reason the recording ended
    float seconds = totalBytes / (8000*2); 

    Serial.printf("Audio recorded [%.1f sec]\n", seconds);
    // Seek to the start of the file and update the header with correct size
    audioFile.seek(0);
    header = makeWaveHeader(totalBytes);
    audioFile.write((byte *)&header, sizeof(header));
    audioFile.close();

    // Rename .tmp file to .wav
    if (!SD_MMC.rename(tmpFilename.c_str(), filename.c_str()))
    {
        handleError(ER03_FILE_RENAME_FAIL);
    }

    res = true;
    radioState = RADIO_STATE_IDLE;
    return res;
}

void shutDownAudioKit(bool reboot)
{
    beep(1000, 500, 2, false);

    kit.setMute(true);

    kit.end();
    vTaskDelay(100);
}

void recorder_task_execute(void *parameter)
{
    auto cfg = kit.defaultConfig(AudioInputOutput);
    cfg.adc_input = AUDIO_HAL_ADC_INPUT_LINE1; // microphone
    cfg.sample_rate = AUDIO_HAL_08K_SAMPLES;
    cfg.sd_active = false;
    kit.begin(cfg);
    kit.setVolume(boondock_config.dock.spkr_vol);

    applicationState = APP_STATE_INIT;

    // Create a circular buffer for 500ms of audio data
    size_t bufferSize = 0.5 * DEFAULT_SAMPLING_RATE * sizeof(short); // Assuming 16kHz sample rate
    CircularBuffer audioBuffer(bufferSize);

    while (true)
    {
        // Code to wait untill application is ready
        if (applicationState == APP_STATE_INIT || networkState == NETWORK_STATE_INIT)
        {
            vTaskDelay(100);
            continue;
        }

        // Read audio buffer
        size_t len = kit.read(stereoInputBuffer, AUDIO_INPUT_BUFFER_SIZE, portMAX_DELAY);

        // Split audio to line & mic buffer
        splitAudioBuffer(len);
        lineDB = measureAudioLevel(lineBuffer, len / 4);
        int lineDBInt = lineDB * 100;

        // Rearrange to Output buffer for Kit
        for (int i = 0; i < AUDIO_INPUT_BUFFER_SIZE / 2; i++)
        {
            stereoOutputBuffer[i * 2] = lineBuffer[i]; // // Rout Onboard Speaker
            stereoOutputBuffer[i * 2 + 1] = 0;         // LOut - PTT
        }

        // Always add audio samples to the circular buffer
        audioBuffer.pushArray(lineBuffer, len / 2);

        bool hasSound;
        if (lineDBInt > (100 - boondock_config.recorder.recorder_sensitivity))
            hasSound = true;
        else
            hasSound = false;

        if (boondock_config.dock.spkr_on)
            kit.write(stereoOutputBuffer, len);
        vTaskDelay(10 / portTICK_PERIOD_MS);

        if (hasSound)
        {

            String formattedDate = timeClient.getFormattedDate();
            formattedDate.replace(":", "-");
            formattedDate = String(SD_CARD_QUEUE_LOCATION) + formattedDate + ".wav";

            // Get the past 500ms of audio from the buffer
            int16_t pastAudio[bufferSize];
            audioBuffer.extractLast(pastAudio, bufferSize);

            // Start recording and first write the past 500ms of audio
            if (recordAudioStart(formattedDate, pastAudio, bufferSize))
            {
                audioBuffer.clear(); // Clear the buffer once recording is done
            }
        }
    }
}

void playAudio(String filename, int8_t volume)
{
    radioState = RADIO_STATE_PLAYBACK;
    // Serial.println(filename);
    if (!sdCardAvailable)
    {
        beep(100, 100, 2, false);
        return;
    }
    else if (!SD_MMC.exists(filename))
    {
        // beep(100,100,2,false);
        return;
    }

    // Open the audio file for reading

    kit.setVolume(volume);

    File audioFile = SD_MMC.open(filename.c_str(), FILE_READ);

    if (!audioFile)
    {
        Serial.println("Failed to open the file for playback");
        return;
    }

    // Skip the WAV header (assuming the audio file is in WAV format)
    audioFile.seek(sizeof(WaveHeader), SeekSet);

    // Buffer to hold mono audio data
    int16_t monoBuffer[AUDIO_INPUT_BUFFER_SIZE / 2];
    // Buffer to hold stereo audio data
    int16_t stereoBuffer[AUDIO_INPUT_BUFFER_SIZE];

    // Serial.println("Playing audio: " + filename);

    while (audioFile.available())
    {
        // Read mono audio data
        size_t bytesRead = audioFile.read((byte *)monoBuffer, sizeof(monoBuffer));

        // Convert mono to stereo
        for (int i = 0, j = 0; i < bytesRead / sizeof(int16_t); i++, j += 2)
        {
            stereoBuffer[j] = monoBuffer[i];     // Left channel
            stereoBuffer[j + 1] = monoBuffer[i]; // Right channel
        }

        // Play the stereo buffer using the kit
        kit.write(stereoBuffer, bytesRead * 2, portMAX_DELAY);
    }

    audioFile.close();

    // Serial.println("Playback finished");
    radioState = RADIO_STATE_IDLE;
}

void playLicenseCode(const String &code)
{
    Serial.println("Registration Code : " + String(code));
    radioState = RADIO_STATE_PLAYBACK;
    if (!sdCardAvailable)
        return;

    for (int i = 0; i < code.length(); i++)
    {
        char c = code[i];

        // Skip the '-' character
        if (c == '-')
            continue;

        // Construct the path to the audio file
        String audioPath = "/system/" + String(c) + ".wav";

        // Play the audio
        playAudio(audioPath.c_str(), DEFAULT_AUDIO_ALERTS_VOLUME);
        delay(500);
    }
    radioState = RADIO_STATE_IDLE;
}

/***************************************
****************************************/
void playBeep(int beepLength, int beepDelay, int beepCount, int beepGood = true)
{
    radioState = RADIO_STATE_PLAYBACK;
    MySineWaveGenerator wave_good;
    MySineWaveGenerator wave_bad;
    uint8_t beep_buffer[BEEP_BUFFER_SIZE];
    const int fadeOutDuration = 10; // duration in milliseconds

    // Set the frequency of the wave to 700 Hz
    wave_good.setFrequency(700);
    wave_bad.setFrequency(2000);
    // Set the sample rate of the wave to the sample rate of the kit
    wave_good.setSampleRate(DEFAULT_SAMPLING_RATE);
    wave_bad.setSampleRate(DEFAULT_SAMPLING_RATE);

    kit.setVolume(boondock_config.dock.alerts_vol);
    MySineWaveGenerator *activeWave = beepGood ? &wave_good : &wave_bad;

    for (int j = 0; j < beepCount; j++)
    {

        size_t len = activeWave->read(beep_buffer, BEEP_BUFFER_SIZE);
        if (boondock_config.dock.spkr_on)
            kit.write(beep_buffer, len, portMAX_DELAY);

        if (beepCount > 1)
            vTaskDelay(beepDelay);
    }

    kit.setVolume(boondock_config.dock.spkr_vol);
    radioState = RADIO_STATE_IDLE;
}

void beep(int beepLength = 100, int beepDelay = 100, int beepCount = 1, int beepGood = true)
{
    playBeep(beepLength, beepDelay, beepCount, beepGood);
}