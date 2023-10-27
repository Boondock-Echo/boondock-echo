<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use GuzzleHttp\Client;
class ProxyAudioController extends Controller
{
  public function getAudio()
    {
        // Create a new Guzzle HTTP client
        $client = new Client();

        // URL of the remote audio file
        $remoteUrl = 'https://cdn.boondockdev.com/uploads/13/2023-05-22T11-24-18Z.wav';

        try {
            // Make a GET request to the remote server and retrieve the audio file
            $response = $client->get($remoteUrl);

            // Get the audio file contents
            $audioContent = $response->getBody();

            // Determine the MIME type of the audio file
            $mimeType = $response->getHeaderLine('Content-Type');

            // Return the audio file with appropriate headers
            return response($audioContent, 200)->header('Content-Type', $mimeType);
        } catch (\Exception $e) {
            // Handle any errors that occur during the request
            return response('Error fetching audio', 500);
        }
    }
}
