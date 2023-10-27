<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\Client\WebSocket;
use Ratchet\Client\Connector;
use App\Models\MqttMessage;


class WebSocketClient extends Command
{
    protected $signature = 'websocket:client';

    protected $description = 'WebSocket Client to subscribe and store messages in the database';

    public function handle()
    {
        $global_topic = config('app.global_mqtt_topic'); // Get the global MQTT topic prefix

        $websocketUrl = config('app.websocket_url');

        if (!$websocketUrl) {
            $this->error('WebSocket URL is not defined in configuration.');
            return;
        }
        $connector = new Connector();

        $connector($websocketUrl)->then(function (WebSocket $conn) {
            $conn->on('message', function ($msg) use ($conn) {
                // Handle the received WebSocket message and store it in the database
                $this->storeMessage($msg);
            });
            
            $conn->on('close', function ($code = null, $reason = null) {
                $this->info("Connection closed ({$code} - {$reason})");
            });
        }, function (\Exception $e) {
            $this->error("Could not connect: {$e->getMessage()}");
        });
    }

    private function storeMessage($message)
    {
        $messageData = json_decode($message, true); // Assuming the received message is in JSON format
        $globalTopic = config('app.global_mqtt_topic');
        $eventKeyword = '/event/';
    
        if (isset($messageData['topic']) && 
            strpos($messageData['topic'], $globalTopic) !== false &&
            strpos($messageData['topic'], $eventKeyword) !== false) {
            // Store the message in the database using the MqttMessage model
            MqttMessage::create([
                'topic' => $messageData['topic'],
                'payload' => $messageData['message'],
            ]);
    
            $this->info('Message stored successfully with topic '.$messageData['topic'].' and message '.$messageData['message']);
        } else {
            $this->info('Message topic does not contain the global topic prefix and "/event/". Skipping storage.');
        }
    }
    
}