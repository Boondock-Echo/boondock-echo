<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;
use App\Models\Dock;
use App\Models\Alert;
use App\Models\User;
use App\Models\AudioAlert;
use App\Mail\KeywordAlert;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Http\Request;

class TranscribeAudioJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $messageId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($messageId)
    {
        $this->messageId = $messageId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    private function audio_2_text($file, $originalFileExtension ) {
        // $key = env('OPENAI_API_KEY');
        $key = \Config('openaiapi.key');

        $client = new \GuzzleHttp\Client();

        $response = $client->request('POST', 'https://api.openai.com/v1/audio/transcriptions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $key,
            ],
            'multipart' => [
                [
                    'name'     => 'model',
                    'contents' => 'whisper-1'
                ],
                [
                    'name'     => 'file',
                    'contents' => fopen($file, 'r'),
                    'filename' => 'audio.'.$originalFileExtension // use original file extension here
                ],
                [
                    'name'     => 'language',
                    'contents' => 'en'
                ],
            ]
        ]);
        $response_body = $response->getBody()->getContents();
        $response_data = json_decode($response_body, true);
        $transcription = $response_data['text'];
        return $transcription;
    }
    public function handle()
    {
        $message = Message::findOrFail($this->messageId);
        // if ($message->transcribe_long && $dock->auto_level)
        //  {
        //     // Transcription has already been done
        //     return response()->json(['error' => 'Transcription has already been done.']);
        // }
    
        $dock = Dock::where('mac', $message->mac)->first();
    
            // if (!$dock || $dock->auto_transcribe != 1 && $dock->auto_level != 1 && $dock->noise_reduction != 1) 
            // {
            //     // Auto transcription is not enabled for the dock
            //     return response()->json(['info' => 'Auto transcription is not enabled for '.$dock->name ]);
            // }
         if ($dock->auto_level == 1 && $dock->noise_reduction != 1)
            {
                $apiData = [
                    'mac' => $message->mac,
                    'filename' => $message->file_name,
                    'type' => 1,
                ];

                // dd($message->file_name);
                // Make the API request
                $apiEndpoint = config('app.auto_level_endpoint');
                $client = new \GuzzleHttp\Client();
                $response = $client->post($apiEndpoint, [
                    'multipart' => [
                        [
                            'name' => 'mac',
                            'contents' => $apiData['mac'],
                        ],
                        [
                            'name' => 'filename',
                            'contents' => $apiData['filename'],
                        ],
                        [
                            'name' => 'type',
                            'contents' => $apiData['type'],
                        ],
                    ],
                ]);
                $message->org_audio = 'old';
                $message->save();
            }
        elseif ( $dock->noise_reduction == 1)
                {
                    $apiData = [
                        'mac' => $message->mac,
                        'filename' => $message->file_name,
                        'type' => 3,
                    ];

                    // dd($message->file_name);
                    // Make the API request
                    $apiEndpoint = config('app.auto_level_endpoint');
                    $client = new \GuzzleHttp\Client();
                    $response = $client->post($apiEndpoint, [
                        'multipart' => [
                            [
                                'name' => 'mac',
                                'contents' => $apiData['mac'],
                            ],
                            [
                                'name' => 'filename',
                                'contents' => $apiData['filename'],
                            ],
                            [
                                'name' => 'type',
                                'contents' => $apiData['type'],
                            ],
                        ],
                    ]);
                    $message->org_audio = 'old';
                    $message->save();
                }
       

       
            //   $file = \Config('app.cdn_server') . '/uploads/' . $message->mac . '/' . $message->file_name;
            $cdnserver  = config('app.cdn_server');

            $file = "$cdnserver/uploads/$message->mac/$message->file_name";  
        // $file = "http://localhost/cdn/uploads/$message->mac/$message->file_name";
        // if ($dock->auto_transcribe == 1)
        // {
        //     $originalFileExtension = pathinfo($file, PATHINFO_EXTENSION);
        //     $transcription = $this->audio_2_text($file, $originalFileExtension);
        //     $message->transcribe_long = $transcription;
        
        //     $message->save();

        //     $keywords = $this->getMatchingKeywords($transcription, $message->mac);
        
        //     if (!empty($keywords)) {
        //         $dock = Dock::where('mac', $message->mac)->first();
        //         $owner = User::find($dock->owner); // Assuming the owner's ID is stored in the 'user_id' column of the Dock model
            
        //         if ($owner) {
        //             // Send the email
        //             Mail::to($owner->email)->send(new KeywordAlert($keywords, $file, $owner->name, $dock->name));

            
        //             $alert = new Alert();
        //             $alert->user_id = $owner->id;
        //             $alert->dock_id = $dock->id;
        //             $alert->message_id = $message->id;
        //             $alert->audio_url = $file;
        //             $alert->keywords = json_encode($keywords);
        //             $alert->message = "test";
        //             $alert->alert_type = 'Audio';
        //             $alert->alerts_seen = false;
        //             $alert->alert_mood = 'info';
        //             $alert->save();
        //         }
        //     }

        // }
   
    }
    /**
     * Convert audio to text using OpenAI API.
     *
     * @param string $file
     * @param string $originalFileExtension
     * @return string
     */
    

    /**
     * Get matching keywords from the transcription.
     *
     * @param string $transcription
     * @return array
     */
    private function getMatchingKeywords($transcription, $mac)
    {
        $keywords = [];
    
        $dock = Dock::where('mac', $mac)->first();
        if (!$dock) {
            return $keywords;
        }
    
        $audioAlerts = AudioAlert::where('dock_id', $dock->id)->get();
        foreach ($audioAlerts as $audioAlert) {
            $audioArray = explode(',', $audioAlert->audio_array);
            foreach ($audioArray as $keyword) {
                if (stripos($transcription, trim($keyword)) !== false) {
                    $keywords[] = trim($keyword);
                }
            }
        }
    // dd($keywords);
        return $keywords;
    }
    

}
