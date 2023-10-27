# Boondock Echo ESP32 

### Description
This project is designed to run on an ESP32 development board and uses a variety of libraries for audio handling and other functionalities.

### Prerequisites
Before you begin, ensure you have installed the following:

### PlatformIO IDE or PlatformIO CLI
ESP32 development board
Hardware Setup
Connect your ESP32 development board to your computer.
Make sure to install the necessary drivers if you are using Windows.

### Software Setup
PlatformIO
Install PlatformIO IDE or use the PlatformIO CLI tool.
Clone this project repository.
Open the project folder with PlatformIO.

### Libraries
This project uses the following libraries:

SPIFFS
arduino-audiokit-hal
arduino-audio-tools
arduino-libhelix
SdFat
SPI
Wire
Adafruit NeoPixel
PubSubClient
ArduinoJson
ESP32httpUpdate
These should be automatically downloaded and installed by PlatformIO when you build the project, as specified in the platformio.ini file.

### Build Flags
The project uses specific build flags which are already set in your platformio.ini file. You don't need to add them manually.

### How to Use
Open the project in PlatformIO.
Build the project by clicking on the "Build" button.
Upload the project to your ESP32 by clicking on the "Upload" button.
Open the Serial Monitor to view any debug output.


### Troubleshooting
If you run into issues with libraries, make sure the platformio.ini file is properly configured.
For serial monitor issues, make sure the baud rate is set to 115200 as specified in the platformio.ini file.