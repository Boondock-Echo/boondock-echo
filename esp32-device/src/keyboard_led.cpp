#include "Arduino.h"
#include "keyboard_led.h"
#include <Adafruit_NeoPixel.h>
#include "PinButton.h"
#include "config.h"

/*
LED Language

* When initializing, LED's fast blink
* When

Fast blink = Initializing
Solid = Performing that action
Flash every 2 seconds = Waiting mode
Red = Something wrong with the funciton


*/

Adafruit_NeoPixel pixels = Adafruit_NeoPixel(NUMPIXELS, NEOPIXEL_PIN, NEO_GRB + NEO_KHZ800);
PinButton button_next(GPIO_KEY_PREV);
PinButton button_prev(GPIO_KEY_NEXT);
PinButton button_ptt(GPIO_KEY_PTT);
PinButton button_mode(GPIO_KEY_MODE);
PinButton button_vol(GPIO_KEY_VOL);

/***************************************
Update Pixel states based on status
This function only updates the color of LED
Does not apply the changes
****************************************/
unsigned long lastBlinkTime = 0; // to keep track of the last time we changed the LED state
bool isRedLedOn = false;         // to keep track of the current state of the RED LED
void update_pixel()
{
    unsigned long currentMillis = millis();
    if (networkState == NETWORK_STATE_LIVE_UPDATE)
    {
        // Calculate brightness based on a faster sine wave for green color
        int brightness = 28 + (int)(sin(currentMillis * 0.01) * 28); // Adjust the frequency as needed
        pixels.setPixelColor(LED_APP, pixels.Color(brightness, 0, 0));
        pixels.setPixelColor(LED_RADIO, pixels.Color(brightness, 0, 0));
        pixels.setPixelColor(LED_NETWORK, pixels.Color(brightness, 0, 0));
        pixels.show();
        return;
    }

    if (applicationState == APP_STATE_INIT_SD_ERROR)
    {
        if (currentMillis - lastBlinkTime >= 500) // Blink every 500 milliseconds
        {
            isRedLedOn = !isRedLedOn; // Toggle LED state
            lastBlinkTime = currentMillis;

            if (isRedLedOn)
            {
                pixels.setPixelColor(LED_APP, RED);
                pixels.setPixelColor(LED_RADIO, RED);
                pixels.setPixelColor(LED_NETWORK, RED);
            }
            else
            {
                pixels.setPixelColor(LED_APP, OFF);
                pixels.setPixelColor(LED_RADIO, OFF);
                pixels.setPixelColor(LED_NETWORK, OFF);
            }

            pixels.show();
        }
        return;
    }

    // Update the Network Status LED
    switch (applicationState)
    {
    case APP_STATE_INIT:
        pixels.setPixelColor(LED_APP, BLUE);
        break;
    case APP_STATE_WAITING:
        pixels.setPixelColor(LED_APP, GREEN);
        break;
    case APP_STATE_ERROR:
        pixels.setPixelColor(LED_APP, RED);
        break;
    default:
        pixels.setPixelColor(LED_APP, pixels.Color(0, 50, 0));
        break;
    }

    long db_led = lineDB * 1000;

    // Handle the state-specific LED behavior
    switch (radioState)
    {
    case RADIO_STATE_INIT: // Fast Blink white LED
        pixels.setPixelColor(LED_RADIO, BLUE);
        break;
    case RADIO_STATE_LINE_RECORDING:
        pixels.setPixelColor(LED_RADIO, pixels.Color(map(db_led, 0, 500, 0, 255), 0, 0));
        break;
    case RADIO_STATE_MIC_TX:
        pixels.setPixelColor(LED_RADIO, pixels.Color(0, 100, 0));
        break;
    default:
        pixels.setPixelColor(LED_RADIO, OFF);
        break;
    }

    switch (networkState)
    {
    case NETWORK_STATE_INIT:
        pixels.setPixelColor(LED_NETWORK, BLUE);
        break;
    case NETWORK_STATE_SENDING:
        pixels.setPixelColor(LED_NETWORK, GREEN);
        break;
    case NETWORK_STATE_RECEIVING:
        pixels.setPixelColor(LED_NETWORK, RED);
        break;
    default:
        pixels.setPixelColor(LED_NETWORK, OFF);
        break;
    }

    // Update the LED
    pixels.show();
}

void process_buttons()
{

    if (button_ptt.isSingleClick())
    {
        CANCEL_RECORDING = true;
    }
    // Play the newest audio file when the next button is clicked
    if (button_next.isSingleClick())
    {
        Serial.println("Next Single Click");
    }

    // Log the intention to play the previous file when the previous button is clicked
    if (button_prev.isSingleClick())
    {
        Serial.println("Next Single Click");
    }

    if (button_next.isLongClick())
    {
        Serial.println("next Long click");
    }

    if (button_prev.isLongClick())
    {
        Serial.println("Prev Long press");
    }

    // Adjust speaker volume when the volume button is clicked
    if (button_vol.isSingleClick())
    {
        Serial.println("Vol Single Click");
    }
    // Toggle mute when the volume button is long clicked
    else if (button_vol.isLongClick())
    {
        Serial.println("Vol Long press");
    }
}

/***************************************
led_task_execute()
Task to control the LED.
****************************************/
void led_keypad_task_execute(void *parameter)
{
    // Keypad

    pinMode(GPIO_KEY_PREV, INPUT_PULLUP);
    pinMode(GPIO_KEY_NEXT, INPUT_PULLUP);
    pinMode(GPIO_KEY_VOL, INPUT_PULLUP);
    pinMode(GPIO_KEY_MODE, INPUT_PULLUP);
    pinMode(GPIO_KEY_PTT, INPUT_PULLUP);

    // Initialize the NeoPixel library and set the brightness
    pixels.begin();
    pixels.setBrightness(DEFAULT_LED_BRIGHTNESS);

    // Turn off all LEDs and update the LEDs
    pixels.fill(pixels.Color(0, 0, 0));
    pixels.show();

    // Endless loop to update the LED status
    while (1)
    {

        update_pixel();

        button_next.update();
        button_prev.update();
        button_ptt.update();
        button_vol.update();
        button_mode.update();
        process_buttons();

        vTaskDelay(pdMS_TO_TICKS(1000)); // Delay for 1000 ms
    }
}