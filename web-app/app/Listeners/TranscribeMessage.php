<?php
namespace App\Listeners;

use App\Events\MessageAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Message;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class TranscribeMessage implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Handle the event.
     *
     * @param  \App\Events\MessageAdded  $event
     * @return void
     */
    public function handle(MessageAdded $event)
    {
        $messageId = $event->messageId;
        $message = Message::findOrFail($messageId);

        if ($message->transcribe_long) {
            // Transcription has already been done
            return;
        }

        if ($message->dock->auto_transcribe) {
            $file = "https://cdn.boondockdev.com/uploads/{$message->mac}/{$message->file_name}";
            $originalFileExtension = pathinfo($file, PATHINFO_EXTENSION);
            $transcription = $this->audio_2_text($file, $originalFileExtension);
            $message->transcribe_long = $transcription;
            $message->save();
        }
    }

    private function audio_2_text($file, $originalFileExtension ) {
        // $key = env('OPENAI_API_KEY');
        $key = \config('openaiapi.key');

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
}
