<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ErrorCodeManagement;
use Illuminate\Support\Facades\Http; // Import Http class
use App\Http\Requests\ErrorCodeRequest;
use GuzzleHttp\Client;

class ErrorCodeManagementController extends Controller
{
    public function index()
    {
        $errorCodes = ErrorCodeManagement::all();
        return view('error_code_management.index', compact('errorCodes'));
    }

    public function store(ErrorCodeRequest $request)
        {
            // Validation has already been performed by the ErrorCodeRequest
        
        // Define the data to send to the external API
        $apiData = [
            [
                'name' => 'text', // Field name in the form data
                'contents' => $request->input('text') // Value for the "text" field
            ],
            [
                'name' => 'error_code',
                'contents' => $request->input('event_code')
            ],
            [
                'name' => 'event_description',
                'contents' => $request->input('event_description')
            ],
            [
                'name' => 'system',
                'contents' => $request->has('system') ? 'true' : 'false' // Convert boolean to string
            ],
            // Add other required fields as needed by the API
        ];
        $api  = config('app.audio_url');
        $apiUrl = $request->has('system') ?
        $api . '/system_audio' :
        $api . '/text-to-audio';
    

        // Create a GuzzleHTTP client
        $client = new Client();

        try {
            $apiResponse = $client->request('POST', $apiUrl, [
                'multipart' => $apiData,
            ]);
            
                    // Check if the API request was successful
                    if ($apiResponse->getStatusCode() == 200) {
                        // Parse the API response JSON
                        $apiResponseData = json_decode($apiResponse->getBody(), true);
            
                        // Extract the 'name' from the API response
                        $apiName = pathinfo($apiResponseData['audio_url'], PATHINFO_FILENAME);
            
                        // Create a new error code entry with the obtained 'name'
                        ErrorCodeManagement::create([
                            'name' => $apiName,
                            'text' => $request->input('text'),
                            'event_code' => $request->input('event_code'),
                            'event_description' => $request->input('event_description'),
                            'system' => $request->has('system'),
                        ]);
            
                        // Display the API message to the user
                        $apiMessage = $apiResponseData['message'];
                        return redirect()->route('error_code_management.index')->with('success', $apiMessage);
                    } else {
                        // Handle API request error
                        // You can log the error or return an error response as needed
                        $apiErrorMessage = 'API request failed: ' . $apiResponse->getStatusCode();
                        return redirect()->route('error_code_management.index')->with('error', $apiErrorMessage);
                    }
                } catch (\Exception $e) {
                    // Handle exceptions that may occur during the API request
                    dd($e);
                    return redirect()->route('error_code_management.index')->with('error', 'API request failed: ' . $e->getMessage());
                }
            }
    public function update(Request $request, $id)
    {
        // Validation and updating logic here
        $errorCode = ErrorCodeManagement::find($id);

        if ($errorCode) {
            $errorCode->update([
                'name' => $request->input('name'),
                'text' => $request->input('text'),
                'event_code' => $request->input('event_code'),
                'event_description' => $request->input('event_description'),
                'system' => $request->has('system'),
            ]);
        }

        return redirect()->route('error_code_management.index');
    }

    public function destroy($id)
    {
        $errorCode = ErrorCodeManagement::find($id);
        
        if ($errorCode) {
            // Get the error_code associated with the ErrorCodeManagement entry
            $error_code = $errorCode->event_code;
            
            // Make a DELETE request to your API to delete the system audio file
            $api = config('app.audio_url'); // Replace with your API URL
            $apiUrl = $api . '/delete_system_audio';
            
            // Create a GuzzleHTTP client
            $client = new Client();
            
            try {
                $apiResponse = $client->request('POST', $apiUrl, [
                    'form_params' => ['error_code' => $error_code],
                ]);
    
                // Check if the API request was successful
                if ($apiResponse->getStatusCode() == 200) {
                    // Delete the ErrorCodeManagement entry from your database
                    $errorCode->delete();
    
                    // Redirect back with a success message
                    return redirect()->route('error_code_management.index')->with('success', 'Error code and system audio deleted successfully.');
                } else {
                    // Handle API request error
                    // You can log the error or return an error response as needed
                    $apiErrorMessage = 'API request failed: ' . $apiResponse->getStatusCode();
                    return redirect()->route('error_code_management.index')->with('error', $apiErrorMessage);
                }
            } catch (\Exception $e) {
                // Handle exceptions that may occur during the API request
                // dd($e);
                $errorCode->delete();
                return redirect()->route('error_code_management.index')->with('error', 'API request failed: ' . $e->getMessage());
            }
        }
    
        // If the ErrorCodeManagement entry doesn't exist, simply redirect back
        return redirect()->route('error_code_management.index');
    }
}
