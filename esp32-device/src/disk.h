/*
SD Card related
*/

#include "gpio.h"

#ifndef __BOONDOCK_SD_CARD__
#define __BOONDOCK_SD_CARD__

bool init_sd_card(); //Initialize the SD card
void init_file_system(); // Initialize file system folders 
void check_file_system();// Checks filesystem

void save_boondock_config(); // saves configuration Files
void save_network_config(); // saves configuration Files

void read_boondock_config(); //Initailize the Configuration structure fomr SD Car file
void read_network_config(); //Inialize the wifi configuration

void file_system_cleanup(); // Performs file system cleanup
void move_from_queue(); // Moves audio file from queue to Inbox

bool isValidLicense(const char *license); //Checks if a license code is valid

#endif