<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Models\Dock;
use App\Models\Message;
use Carbon\Carbon;

class FileApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only('store');
    }
    public function store(Request $request)
    {
         // Validate the file and retrieve file details
         $request->validate([
            'audioFile' => 'required|file|mimetypes:audio/mpeg,audio/wav,audio/x-wav'
        ]);

        $audioFile = $request->file('audioFile');
        $fileName = $audioFile->getClientOriginalName();

        // Get the parts of the file name that you want to use
        $fileNameBefore = Str::before($fileName, '.');
        $fileNameAfter = Str::after($fileName, '.');


        $mac = $fileNameBefore;
        $file_name = $audioFile->getClientOriginalName();
        $message_length = $audioFile->getSize();

        $dock = Dock::where('mac', $mac)->first();

        if ($dock) {
            $dock->update([
                'last_seen' => Carbon::now()
            ]);
            $dock_station = $dock->station;
            $dock_frequency = $dock->frequency;
        }
         else {
            $dock = new Dock([
                'mac' => $mac,
                'station' => 'Default Station',
                // 'frequency' => 'Default Frequency',
                'last_seen' => Carbon::now()
            ]);
            $dock->save();
            $dock_station = 'Default Station';
            $dock_frequency = $dock->frequency;
        }




        // Get the first 6 characters of the file name
        $file_name_prefix = substr($file_name, 0, 6);

        // Create the directory where the file will be stored
        $directory = '/public/uploads/'.$mac;

        // Create the file name
        $now = now();
        $file_name = $now->format('Ymd-H-i-s').'.'.$audioFile->getClientOriginalExtension();

        // Create a new message object and save it to the database
        $message = new Message([
            'mac' => $mac,
            'length' => $message_length,
            'file_name' => $file_name,
            'sent' => 0,
            'station' => $dock_station,
            'frequency' => $dock_frequency
        ]);
        $message->save();
        // Store the file
        $path = Storage::putFileAs($directory, $audioFile, $file_name);

        return response()->json(['message' => 'File uploaded successfully', 'file_path' => $path], 200);
    }
}
