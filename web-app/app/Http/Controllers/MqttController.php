<?php

namespace App\Http\Controllers;

use App\Models\Dock;
// use PhpMqtt\Client\Shared\SimpleLogger;
use Psr\Log\LogLevel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use MQTT;
use PhpMqtt\Client\MqttClient;
use PhpMqtt\Client\ConnectionSettings;
use PhpMqtt\Client\Exceptions\MqttClientException;
use Bluerhinos\phpMQTT;
use Illuminate\Support\Facades\Log;
use App\Jobs\MqttSubscriptionJob;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\MqttMessage;


class MqttController extends Controller
{

            public function publishMessage(Request $request)
                {
                    $mqtt = MQTT::connection();
                    $global_topic = config('app.global_mqtt_topic');
                    $topic_web = $request->input('topic');
                    $topic =  $global_topic.'/'.$topic_web;
                    $message = $request->input('message');

                    if (!empty($message)) {
                        $mqtt->publish($topic, $message, 0, false);
                    }
                    else
                    {
                        $mqtt->publish($topic,"", 0, false);
                    }

                    $mqtt->disconnect();



                    return response()->json([
                        'status' => 'success',
                        'message' => 'topic-' .$topic.' message-' .$message,
                    ]);
                }
            public function update(Request $request,  $id)
                {
                    // Ensure the authenticated user is the owner of the dock

                        $input = $request->all();
                        $dock = Dock::find($id);
                        $dock->update($input);

                        return response()->json([
                            'status' => 'success',
                            'message' => 'data update',
                        ]);


                }

                public function subscribeToTopic()
                {
                   
                    $mqtt = MQTT::connection();
                    printf("Client connected\n");
                    $topic = '13/#';
                  
                    // Subscribe to the topic
                    $mqtt->subscribe( $topic, function ($topic, $message) use ($mqtt) {
                        printf("Received message on topic [%s]: %s\n", $topic, $message);
                        fflush(STDOUT); // Flush the output buffer to immediately display the message
            
                        // Create a new MqttMessage model instance and store the received message in the database
                        MqttMessage::create([
                            'topic' => $topic,
                            'payload' => $message,
                        ]);
                        // $client->interrupt();
                    }, 0);
            
                    // Run the MQTT loop to listen for incoming messages
                    // $mqtt->loop(true);
                }

    public function mqttSubscribe(Request $request)
    {
        $user = Auth::user()->id;
        // $user = Auth::user();
            $mqttTopic = $user .'/#';
    
            if (empty($mqttTopic)) {
                return redirect()->route('mqtt.subscribe')->with('error', 'Please enter a valid MQTT topic.');
            }
    
            MqttSubscriptionJob::dispatch($mqttTopic);
    
            return redirect()->route('mqtt.subscribe')->with('success', 'MQTT subscription started successfully!');
        }
        public function showMessages()
        {
            $authUserId = auth()->id();
        
            // Define the event code to description mapping
            $eventCodeMapping = [
                'I01' => 'Starting in normal mode',
                'I02' => 'Boondock ready and listening',
                'I03' => '',
                'I04' => 'Config updated',
                'I05' => 'Speaker mute',
                'I06' => 'Speaker unmute',
                'I07' => 'Recording active',
                'I08' => 'Recording inactive',
                'I09' => 'PTT activated',
                'I10' => 'PTT Released',
                'I11' => 'PTT recording active',
                'I12' => 'PTT recording inactive',
                'I13' => 'Playing System Audio',
                'I14' => 'SD Card usage',
                'I15' => 'Tx is enabled',
                'I16' => 'Tx is disabled',
                'I17' => 'Line in minimum db changed',
                'I18' => 'Line in gain chagned',
                'I19' => 'Play system audio queued',
                'I20' => 'Play audio queued',
                'I21' => 'Transmit audio file queued',
                'I22' => 'Min recording size updated',
                'I23' => 'Silence duration udpated',
                'I24' => 'Max recording size updated',
                'I25' => 'Speaker volume changed to',
                'I26' => 'User ID changed to',
                'I27' => 'Dock name changed to',
                'I28' => 'Playback volume changed',
                'I29' => 'OTA update changed to',
                'I30' => 'TX volume changed to',
                'I31' => 'Start remote recording',
                'I32' => 'Stop remote recording',
                'I33' => 'Remote Reboot',
                'I34' => 'Save Config',
                'I35' => 'Factory Reset',
                'I36' => 'Set default settings',
                'I37' => 'Audio file uploaded',
                'I38' => 'Upgrading config file',
                'I39' => 'Reboot reason',
                'I40' => '',
                'I41' => 'Upload response',
                'I42' => 'Playback complete',
                'I43' => 'Transmit complete',
                'I44' => 'Transmit is not allowed',
                'I45' => 'Load cdn files',
                'I46' => 'Downloading for playback',
                'I47' => 'Adding playback queue',
                'I48' => 'Upload complete',
                'I49' => '',
                'I50' => 'Completed downloading audio',
                'I51' => 'Recording upload active',
                'I52' => 'Recording upload inactive',
                'I53' => 'Start remote Mic recording',
                'I54' => 'Stop remote Mic recording',
                'I55' => 'PTT upload active',
                'I56' => 'PTT upload inactive',
                'I57' => 'Notify All Settings',
                'I58' => 'Downlaod audio cache',
                'I59' => 'Cache and Play',
                'I60' => '',
                'I61' => '',
                'I62' => '',
                'I63' => 'Audio recording complete',
                'I64' => 'Uploading Audio file',
                'I65' => 'Audio uploaded successfully',
                'E41' => 'Software Reset',
                'E01' => 'Unknown error', // New error code
                'E02' => 'Invalid parameters', // New error code
                'E03' => 'Duplicate file', // New error code
                'E04' => 'File too big', // New error code
                'E05' => 'Empty file', // New error code
                'E06' => 'File too small', // New error code
                'E07' => 'Server error when saving file', // New error code
                'E08' => 'Error moving file', // New error code
                'E09' => 'Error updating database', // New error code
                'E10' => 'Error creating directory', // New error code
            ];
            $global_topic = config('app.global_mqtt_topic');
            // Fetch dock names based on MAC addresses
                    // Fetch dock names based on MAC addresses
            $macAddresses = MqttMessage::where('topic', 'LIKE', $global_topic . '/' . $authUserId . '/%')
            ->pluck('topic')
            ->map(function ($topic) use ($authUserId) {
                [, $userId, $macAddress] = explode('/', $topic);
                if ($userId == $authUserId) {
                    return $macAddress;
                }
                return null;
            })
            ->filter()
            ->toArray();

            $docks = Dock::whereIn('mac', $macAddresses)->get()->keyBy('mac');

            // Fetch and filter MQTT messages with '/event/' in topic
            $mqttMessages = MqttMessage::where('topic', 'LIKE', $global_topic . '/' . $authUserId . '/%')
            ->where('topic', 'LIKE', $global_topic . '/%event/%') // Filter for '/event/' in topic
            ->get();

            // Replace MAC addresses in the topic with dock names and set payload to description
           // Replace MAC addresses in the topic with dock names and set payload to description
foreach ($mqttMessages as $message) {
    [, $userId, $macAddress,$eventPart, $eventCode] = explode('/', $message->topic);
    if ($userId == $authUserId && isset($docks[$macAddress])) {
        $message->topic =  $authUserId . '/' . $docks[$macAddress]->name;
        $messagedata = $message->payload;
        $description = $eventCodeMapping[$eventCode] ?? '';

        if ($messagedata !== '0' && $messagedata !== '1') {
            $message->payload = ($description ? $description . ' ' : '') . '(' . $messagedata . ')';
        } else {
            $message->payload = $description;
        }
    }
}


            return response()->json($mqttMessages);

        }
        
        
        
        
        public function messageblade()
        {
            return view('messages');
        }
}

