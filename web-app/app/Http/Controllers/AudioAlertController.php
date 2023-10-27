<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AudioAlert;
use Illuminate\Support\Facades\Auth;

class AudioAlertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'audio_array' => 'required',
            'dock_id' => 'required|exists:docks,id',
            'email_alert' => 'nullable|boolean', // Update the validation rule
        ]);
    
        // Set the default value if email_alert is not provided in the request
        $emailAlert = $request->has('email_alert') ? (bool) $request->input('email_alert') : false;
    
        // Create a new audio alert
        AudioAlert::create([
            'audio_array' => $request->input('audio_array'),
            'dock_id' => $request->input('dock_id'),
            'email_alert' => $emailAlert,
            'owner_id' => Auth::id(),
        ]);
    
        // Redirect to a success page or perform additional actions as needed
        return redirect()->route('alerts.show')->with('success', 'Audio alert created successfully.');
    }
    
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AudioAlert $audio_alert)
    {
        // Delete the audio alert
        $audio_alert->delete();

        // Redirect to a desired location or perform additional actions as needed
        return redirect()->route('alerts.show')->with('success', 'Audio alert deleted successfully.');
    }
}
