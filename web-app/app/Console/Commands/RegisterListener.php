<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\Client\WebSocket;
use Ratchet\Client\Connector;
use App\Models\MqttMessage;
use App\Models\Dock; // Import the Dock model
use App\Models\Devicecodes; // Import the Devicecodes model
use MQTT;

class RegisterListener extends Command
{
    protected $signature = 'register:listener';

    protected $description = 'WebSocket Listener for MQTT messages registration';

    public function handle()
    {
        $global_topic = config('app.global_mqtt_topic'); // Get the global MQTT topic prefix

        $websocketUrl = config('app.websocket_url');

        if (!$websocketUrl) {
            $this->error('WebSocket URL is not defined in configuration.');
            return;
        }
        $connector = new Connector();

        $connector($websocketUrl)->then(function (WebSocket $conn) use ($global_topic) {
            $conn->on('message', function ($msg) use ($global_topic) {
                // Handle the received WebSocket message and check if it's from the desired topic hierarchy
                $this->registerFromTopic($msg, $global_topic . '/register/');
            });

            $conn->on('close', function ($code = null, $reason = null) {
                $this->info("Connection closed ({$code} - {$reason})");
            });
        }, function (\Exception $e) {
            $this->error("Could not connect: {$e->getMessage()}");
        });
    }

    private function registerFromTopic($message, $desiredTopicPrefix)
    {
        $global_topic = config('app.global_mqtt_topic'); 
        $messageData = json_decode($message, true);

        if (json_last_error() === JSON_ERROR_NONE && isset($messageData['topic']) && isset($messageData['message'])) {
            $receivedTopic = $messageData['topic'];
            $messageContent = $messageData['message'];

            if (strpos($receivedTopic, $desiredTopicPrefix) === 0) {
                // Extract the MAC address from the received topic
                $macAddress = substr($receivedTopic, strlen($desiredTopicPrefix));

                // Check if the dock with the given MAC address exists in the database
                $dock = Dock::where('mac', $macAddress)->first();

                if ($dock) {
                    if (empty($dock->code)) {
                        // Automatically assign a code to the dock
                        $code = Devicecodes::where('status', 0)->first();

                        if ($code) {
                            $dock->code = $code->code;
                            $dock->save();

                            // Update the dock_id in Devicecodes table
                            $code->dock_id = $dock->id;
                            if ($dock->owner) {
                                $code->user_id = $dock->owner;
                            }
                            $code->status = 1; // Set status to 1
                            $code->save();
                            $mqtt = MQTT::connection();

                            $topic =$global_topic .'/'. $macAddress . '/set/license';
                            // $topic2 = $global_topic .'/'. $macAddress . '/set/save';
                            // $topic3 = $global_topic .'/'.$macAddress . '/set/reboot';
                            $message = $dock->code;

                            if (!empty($message)) {
                                $mqtt->publish($topic, $message, 0, false);
                                // $mqtt->publish($topic2, "", 0, false);
                                // $mqtt->publish($topic3, "", 0, false);
                            } else {
                                $mqtt->publish($topic, "", 0, false);
                            }
                            $code = Devicecodes::where('code', $dock->code)->first();

                            if ($code->user_id) {

                                $topic1 =$global_topic .'/'. $macAddress . '/set/user_id';
                                $message1 = $code->user_id;
                                if (!empty($message)) {
                                    $mqtt->publish($topic1, $message1, 0, false);
                                } else {
                                    $mqtt->publish($topic1, "", 0, false);
                                }
                            }

                            $mqtt->disconnect();
                            $this->info("Assigned code '{$code->code}' to dock with MAC '{$macAddress}'");
                        } else {
                            $this->error("No available codes to assign to dock with MAC '{$macAddress}'");
                        }
                    } else {
                        $mqtt = MQTT::connection();

                        $topic = $global_topic .'/'.$macAddress . '/set/license';
                        // $topic2 = $global_topic .'/'.$macAddress . '/set/save';
                        // $topic3 = $global_topic .'/'.$macAddress . '/set/reboot';
                        $message = $dock->code;

                        if (!empty($message)) {
                            $mqtt->publish($topic, $message, 0, false);
                            // $mqtt->publish($topic2, "1", 0, false);
                            // $mqtt->publish($topic3, "1", 0, false);
                        } else {
                            $mqtt->publish($topic, "", 0, false);
                        }

                        $code = Devicecodes::where('code', $dock->code)->first();

                        if ($dock->owner) {
                            $code->user_id = $dock->owner;
                            $code->save();
                        }

                        if ($code->user_id) {

                            $topic1 = $global_topic .'/'.$macAddress . '/set/user_id';
                            $message1 = $code->user_id;
                            if (!empty($message)) {
                                $mqtt->publish($topic1, $message1, 0, false);
                            } else {
                                $mqtt->publish($topic1, "", 0, false);
                            }
                        }

                        $mqtt->disconnect();
                        $this->info("Received message from dock with Name '{$dock->name}' code already set: {$dock->code}");
                    }
                } else {
                    // Dock not found, create a new dock with the given MAC address
                    $newDock = new Dock();
                    $newDock->mac = $macAddress;

                    $code = Devicecodes::where('status', 0)->first();

                    $newDock->code = $code->code;
                    $newDock->save();

                    // Update the dock_id in Devicecodes table
                    $code->dock_id = $newDock->id;
                    $code->status = 1; // Set status to 1
                    $code->save();

                    $mqtt = MQTT::connection();

                    $topic = $global_topic .'/'.$macAddress . '/set/license';
                    $message = $newDock->code;

                    if (!empty($message)) {
                        $mqtt->publish($topic, $message, 0, false);
                    } else {
                        $mqtt->publish($topic, "", 0, false);
                    }

                    $mqtt->disconnect();

                    $this->info("Created new dock with MAC '{$macAddress}' and assigned code '{$code->code}'");
                }
            }
        }
    }
}
