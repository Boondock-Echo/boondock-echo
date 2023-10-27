<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
use Illuminate\Support\Str;
use App\Models\Dock;
use App\Models\Message;
use App\Models\Message2;
use Carbon\Carbon;


class AllinboxController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->user()->hasRole('Super Admin'))
         {
        $per_page = $request->input('per_page', 5);
        $audioFiles = Message::where('deleted', 0)
            ->orderBy('added', 'desc');

        // Filter by dock name if it's provided in the request
        if ($request->filled('dock_name')) {
            $audioFiles->whereHas('dock', function ($query) use ($request) {
                $query->where('name', $request->input('dock_name'));
            });
        }
          $audioFiles = $audioFiles->paginate($per_page);
        $totalaudioFiles = Message::count();
        $docks = Dock::where('active', 1)->get();
        $activeDocks = Dock::join('messages', 'docks.mac', '=', 'messages.mac')
    ->where('docks.active', 1)
    ->select('docks.*')
    ->distinct()
    ->get();
        $totalActiveDocks = $docks->count();
        $totalDocks = Dock::count();
        return view('allinbox.index',['totalDocks' => $totalDocks ], compact('audioFiles','per_page','totalaudioFiles','totalActiveDocks','activeDocks'))
        ->with('i', ($audioFiles->currentPage() - 1) * $per_page)
        ->with('per_page', $per_page)
        ->withInput($request->only('per_page'));
         }


    }


    public function store(Request $request)
    {
        // Validate the file and retrieve file details
        $request->validate([
            'file' => 'required|file|mimetypes:audio/mpeg,audio/wav,audio/x-wav'
        ]);

        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();

        // Get the parts of the file name that you want to use
        $fileNameBefore = Str::before($fileName, '.');
        $fileNameAfter = Str::after($fileName, '.');


        $mac = $fileNameBefore;
        $file_name = $file->getClientOriginalName();
        $message_length = $file->getSize();

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
        $file_name = $now->format('Ymd-H-i-s').'.'.$file->getClientOriginalExtension();

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
        $path = Storage::putFileAs($directory, $file, $file_name);


        return back()
            ->with('success','You have successfully upload file.')
            ->with('file', $path);
    }

    public function delete($id)
{
    $audioFile = Message::find($id);
    if($audioFile){
        $audioFile->delete();
        return redirect()->back()->with('success', 'Audio File has been deleted successfully');
    }
    return redirect()->back()->with('error', 'Audio File not found');
}
}

