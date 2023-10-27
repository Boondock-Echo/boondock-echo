<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use Illuminate\Support\Facades\Cache;
use App\Models\MqttMessage;

class MqttSubscriptionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mqttTopic;
    protected $messageCount = 0;
    protected $userId;
    public function __construct($mqttTopic, $userId)
    {
        $this->mqttTopic = $mqttTopic;
        $this->userId = $userId;
    }

    public function handle()
    {
       
            // Check if the user has logged out and delete the job if necessary
            if ($this->shouldStopJob()) {
                $this->delete();
              
            }
       

        $server = '43.205.51.194';
        $port = 1883;
        $clientId = rand(5, 15);
        $username = 'blueman';
        $password = 'TYgu6fPhoofJ';
        $clean_session = false;
        $mqtt_version = MqttClient::MQTT_3_1_1;

        $connectionSettings = (new ConnectionSettings)
            ->setUsername($username)
            ->setPassword($password)
            ->setKeepAliveInterval(60)
            ->setLastWillTopic('emqx/test/last-will')
            ->setLastWillMessage('client disconnect')
            ->setLastWillQualityOfService(1);
           
            $startTime = time();
            $endTime = $startTime + (1 * 20); // 5 minutes (5 * 60 seconds)
    
    while (time() < $endTime)
     {     
                  $mqtt = new MqttClient($server, $port, $clientId, $mqtt_version);
        
                $mqtt->connect($connectionSettings, $clean_session);
                printf("Client connected\n");
                fflush(STDOUT); // Flush the output buffer to immediately display the message

                $mqtt->subscribe($this->mqttTopic, function ($topic, $message) use ($mqtt) {
                    printf("Received message on topic [%s]: %s\n", $topic, $message);
                    fflush(STDOUT); // Flush the output buffer to immediately display the message

                    // Create a new MqttMessage model instance and store the received message in the database
                    MqttMessage::create([
                        'topic' => $topic,
                        'payload' => $message,
                    ]);
                    $client->interrupt();
                    // Unsubscribe from the topic and disconnect the client
                    // $mqtt->unsubscribe($this->mqttTopic);
                    // $mqtt->disconnect();

                    // printf("Job completed. Unsubscribed and disconnected.\n");
                    // fflush(STDOUT); // Flush the output buffer to immediately display the message
                    // dispatch(new MqttSubscriptionJob($this->mqttTopic));
                    // The job will be automatically removed from the queue.
                    // $this->delete();
                }, 0);

                // Sleep for 30 seconds (adjust the sleep duration as needed)
            
                    $mqtt->loop(true);
                    
            }  
                printf("Job completed. Unsubscribed and disconnected.\n");
            $this->delete();
    }

    private function shouldStopJob()
    {
        $logoutCacheKey = 'user_logout_' . $this->userId;
        return Cache::has($logoutCacheKey);
    }

}