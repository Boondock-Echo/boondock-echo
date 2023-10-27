<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\Core\ExponentialBackoff;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;

class TextToSpeechController extends Controller
{
    public function generateAudio(Request $request)
{
    // Path to your Google Cloud service account key file (key.json)
    $keyFilePath = storage_path('app/key.json');

    // Text to be converted to audio
    $text = $request->input('text');
    session()->put('audioText', $text);

    if (!$text) {
        return response()->json(['error' => 'Text not provided'], 400);
    }

    try {
        // Initialize the TextToSpeechClient with the key file
        $textToSpeechClient = new TextToSpeechClient([
            'credentials' => $keyFilePath,
        ]);

        // Set up the request
        $input = (new SynthesisInput())->setText($text);
        $voice = (new VoiceSelectionParams())
            ->setLanguageCode('en-US')
            ->setName('en-US-Wavenet-D'); // Adjust voice settings as needed
        $audioConfig = (new AudioConfig())->setAudioEncoding(AudioEncoding::LINEAR16); // Use the correct constant

        // Perform the text-to-speech synthesis
        $response = $textToSpeechClient->synthesizeSpeech($input, $voice, $audioConfig);

        // Get the audio content from the response
        $audioContent = $response->getAudioContent();

        // Save the audio to a local file
        $audioPath = public_path('test.wav');
        file_put_contents($audioPath, $audioContent);

        // Define response headers for audio playback
        $headers = ['Content-Type' => 'audio/wav']; // Use 'audio/wav' for LINEAR16 encoding

        return back();

    } catch (\Exception $e) {
        return response()->json(['error' => 'Error generating audio: ' . $e->getMessage()], 500);
    }
}



    public function showForm()
    {
        return view('generate_audio');
    }
}
