
#include "gpio.h"
#include "config.h"
#include "network.h"
#include "SineWaveGenerator.h"

#ifndef __BOONDOCK_RECORDER__
#define __BOONDOCK_RECORDER__

typedef struct
{
    char RIFF[4];
    int32_t chunkSize;
    char WAVE[4];
    char fmt[4];
    int32_t subchunk1Size;
    int16_t audioFormat;
    int16_t numChannels;
    int32_t sampleRate;
    int32_t byteRate;
    int16_t blockAlign;
    int16_t bitsPerSample;
    char subchunk2ID[4];
    int32_t subchunk2Size;
} WaveHeader;

void recorder_task_execute(void *parameter); // Main task
void playAudio(String filename, int8_t volume);
void playLicenseCode(const String &code);
void beep(int beepLength, int beepDelay, int beepCount, int beepGood);
void shutDownAudioKit(bool reboot);

#endif