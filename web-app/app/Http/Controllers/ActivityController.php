<?php

namespace App\Http\Controllers;

use App\Models\MqttMessage;
use Illuminate\Http\Request;


class ActivityController extends Controller
{
    public function onMessageArrived(Request $request)
{
    try {
        // Get the topic and message from the request
        $topic = $request->input('topic');
        $message = $request->input('message');

        // Save the message to the database
        $mqttMessage = new MqttMessage;
        $mqttMessage->topic = $topic;
        $mqttMessage->payload = $message;
        $mqttMessage->save();

        // Return a response indicating success
        return response()->json(['status' => 'success']);
    } catch (\Exception $e) {
        // Print the error message
        $errorMessage = $e->getMessage();
        return response()->json(['status' => 'error', 'message' => $errorMessage]);
    }
}
public function myControllerMethod()
{
   

    // Pass the received message to the view
    return View('subscribe');

    
}
}
