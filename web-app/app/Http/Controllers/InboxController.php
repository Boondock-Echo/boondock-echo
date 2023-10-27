<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Config;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
use Illuminate\Support\Str;
use App\Models\Dock;
use App\Models\Message;
use App\Models\Message2;
use App\Models\Station;
use App\Models\DockCategory;
use Carbon\Carbon;
use GuzzleHttp\Client;
use OpenAI\Transporters\HttpTransporter;
use OpenAI\Client as OpenAI;
use OpenAI\ValueObjects\Transporter\BaseUri;

use FFMpeg\FFMpeg;
use FFMpeg\Format\Audio\Wav;
use FFMpeg\Coordinate\TimeCode;
use Illuminate\Support\Facades\Auth;


class InboxController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

                        $per_page = $request->input('per_page', 10);
                        $userId = Auth::user()->id;

                        // Get all docks owned by the user
                        $docks = Dock::where('owner', $userId)->get();
                        $station = Station::where('user_id', $userId)->get();

                    

                        // Get dock names to use in the view
                        $dockNames = $docks->pluck('name');

                        // Get audio files that match the search criteria
                        $audioFiles = Message::where('deleted', 0)
                        ->whereHas('dock', function ($query) use ($userId, $request) {
                            $query->where('owner', $userId);


                            if ($request->filled('dock_name')) {
                                $query->where('name', $request->input('dock_name'));
                                $dockName = $request->input('dock_name');
                            }

                            // Filter by date range if it's provided in the request
                            if ($request->filled('date_range')) {
                                $date_range = $request->input('date_range');
                                if ($date_range == 'today') {
                                    $query->whereDate('added', today());
                                } else if ($date_range == '7_days') {
                                    $query->whereBetween('added', [now()->subDays(7), now()]);
                                } else if ($date_range == '30_days') {
                                    $query->whereBetween('added', [now()->subDays(30), now()]);
                                } else if ($date_range == '60_days') {
                                    $query->whereBetween('added', [now()->subDays(60), now()]);
                                }
                            }
                        })
                        ->orderBy('added', 'desc')
                        ->paginate($per_page);

                        $dockNameFilter = $request->input('dock_name');
                        $totalaudioFilesofuser = Message::where('deleted', 0)
                            ->whereHas('dock', function ($query) use ($userId, $request) {
                                $query->where('owner', $userId);
                            })
                            ->count();
                // Get total count of audio files that match the search criteria
                    $totalaudioFiles = Message::where('deleted', 0)
                        ->whereHas('dock', function ($query) use ($userId, $request) {
                            $query->where('owner', $userId);

                            // Filter by dock name if it's provided in the request
                            if ($request->filled('dock_name')) {
                                $query->where('name', $request->input('dock_name'));
                            }

                            // Filter by date range if it's provided in the request
                            if ($request->filled('date_range')) {
                                $date_range = $request->input('date_range');
                                if ($date_range == 'today') {
                                    $query->whereDate('added', today());
                                } else if ($date_range == '7_days') {
                                    $query->whereBetween('added', [now()->subDays(7), now()]);
                                } else if ($date_range == '30_days') {
                                    $query->whereBetween('added', [now()->subDays(30), now()]);
                                } else if ($date_range == '60_days') {
                                    $query->whereBetween('added', [now()->subDays(60), now()]);
                                }
                            }
                        })
                        ->count();

                        // Count the number of sent messages that match the search criteria
                        $sentfile = Message::where('deleted', 0)
                            ->whereHas('dock', function ($query) use ($userId, $request) {
                                $query->where('owner', $userId);
                                if ($request->filled('dock_name')) {
                                    $query->where('name', $request->input('dock_name'));
                                }

                                // Filter by date range if it's provided in the request
                                if ($request->filled('date_range')) {
                                    $date_range = $request->input('date_range');
                                    if ($date_range == 'today') {
                                        $query->whereDate('added', today());
                                    } else if ($date_range == '7_days') {
                                        $query->whereBetween('added', [now()->subDays(7), now()]);
                                    } else if ($date_range == '30_days') {
                                        $query->whereBetween('added', [now()->subDays(30), now()]);
                                    } else if ($date_range == '60_days') {
                                        $query->whereBetween('added', [now()->subDays(60), now()]);
                                    }
                                }
                            })
                            ->whereHas('outbox', function ($query) {
                                $query->whereNotNull('message_id');
                            })
                            ->count();

                        // Get all active docks owned by the user
                        $activeDocks = Dock::where('active', 1)->where('owner', $userId)->get();

                        // Get the total count of active docks owned by the user
                        $totalActiveDocks = $activeDocks->count();

                        // Get dock names for the active docks
                        $activeDockNames = $activeDocks->pluck('name');

                        // Get the IDs of sent messages
                        $sentMessageIds = DB::table('outbox')->pluck('message_id')->toArray();
                        $categories = DockCategory::all();
                        // Pass data to the view
                        return view('dashboard.inbox', [
                            'totalDocks' => $docks->count(),
                            'audioFiles' => $audioFiles,
                            'per_page' => $per_page,
                            'activeDocks' => $activeDocks,
                            'totalaudioFiles' => $totalaudioFiles,
                            'totalActiveDocks' => $totalActiveDocks,
                            'activeDockNames' => $activeDockNames,
                            'dockNames' => $dockNames,
                            'sentfile' => $sentfile,
                            'sentMessageIds' => $sentMessageIds,
                            'dockNameFilter' => $dockNameFilter,
                            'station' => $station,
                            'categories' => $categories,
                            'userId' => $userId,
                        ])
                        ->with('i', ($audioFiles->currentPage() - 1) * $per_page)
                        ->with('per_page', $per_page)
                        ->withInput($request->only('per_page', 'dock_name','date_range'));
    }

   public function getNewMessagesCount($lastViewedTime)
{
    $userId = Auth::user()->id;

        $newMessagesCount = Message::where('added', '>=', $lastViewedTime)
                        ->whereHas('dock', function ($query) use ($userId,) {
                            $query->where('owner', $userId);

                          
                        })
                        ->count();
        
        // dd($newMessagesCount);
    return response()->json(['newMessagesCount' => $newMessagesCount]);
}

    
    
    

    public function receivedtable(Request $request)
    {

        $per_page = $request->input('per_page', 5);
        $userId = Auth::user()->id;

        // Get all docks owned by the user
        $docks = Dock::where('owner', $userId)->get();

        // Get dock names to use in the view
        $dockNames = $docks->pluck('name');

        // Get audio files that match the search criteria
        $audioFiles = Message::where('deleted', 0)
        ->whereHas('dock', function ($query) use ($userId, $request) {
            $query->where('owner', $userId);

            // Filter by dock name if it's provided in the request
            if ($request->filled('dock_name')) {
                $query->where('name', $request->input('dock_name'));
            }

            // Filter by date range if it's provided in the request
            if ($request->filled('date_range')) {
                $date_range = $request->input('date_range');
                if ($date_range == 'today') {
                    $query->whereDate('added', today());
                } else if ($date_range == '7_days') {
                    $query->whereBetween('added', [now()->subDays(7), now()]);
                } else if ($date_range == '30_days') {
                    $query->whereBetween('added', [now()->subDays(30), now()]);
                } else if ($date_range == '60_days') {
                    $query->whereBetween('added', [now()->subDays(60), now()]);
                }
            }
        })
        ->orderBy('added', 'desc')
        ->paginate($per_page);

        // Get total count of audio files that match the search criteria
        $totalaudioFiles = Message::where('deleted', 0)
            ->whereHas('dock', function ($query) use ($userId, $request) {
                $query->where('owner', $userId);

                // Filter by dock name if it's provided in the request
                // if ($request->has('dock_name')) {
                //     $query->where('name', $request->input('dock_name'));
                // }
            })
            ->count();

        // Count the number of sent messages that match the search criteria
        $sentfile = Message::where('deleted', 0)
            ->whereHas('dock', function ($query) use ($userId) {
                $query->where('owner', $userId);
            })
            ->whereHas('outbox', function ($query) {
                $query->whereNotNull('message_id');
            })
            ->count();

        // Get all active docks owned by the user
        $activeDocks = Dock::where('active', 1)->where('owner', $userId)->get();

        // Get the total count of active docks owned by the user
        $totalActiveDocks = $activeDocks->count();

        // Get dock names for the active docks
        $activeDockNames = $activeDocks->pluck('name');

        // Get the IDs of sent messages
        $sentMessageIds = DB::table('outbox')->pluck('message_id')->toArray();

        // Pass data to the view
        return view('inbox.receivedtable', [
            'totalDocks' => $docks->count(),
            'audioFiles' => $audioFiles,
            'per_page' => $per_page,
            'activeDocks' => $activeDocks,
            'totalaudioFiles' => $totalaudioFiles,
            'totalActiveDocks' => $totalActiveDocks,
            'activeDockNames' => $activeDockNames,
            'dockNames' => $dockNames,
            'sentfile' => $sentfile,
            'sentMessageIds' => $sentMessageIds,
        ])
        ->with('i', ($audioFiles->currentPage() - 1) * $per_page)
        ->with('per_page', $per_page)
        ->withInput($request->only('per_page', 'dock_name','date_range'));
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




    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required'
        ]);
    
        $file = $request->file('file');
        $userId = auth()->user()->id; // Assuming you have user authentication and can retrieve the user ID
        $fileName = (string) $userId; // Convert $userId to string
    
        // Convert audio file to 8000 sampling rate and 1 channel using FFmpeg
        $outputFile = sys_get_temp_dir() . '/' . uniqid('converted_', true) . '.wav';
        $ffmpegPath = Config::get('filesystems.disks.ffmpeg.path');
        $command = "$ffmpegPath -i {$file->getRealPath()} -ar 8000 -ac 1 -acodec pcm_s16le $outputFile";
        exec($command);
    
        // Check if the conversion was successful
        if (!file_exists($outputFile)) {
            return redirect()->back()->with('error', 'Failed to convert audio file.');
        }
    
        // Generate the timestamp parameter
        $timestamp = now()->format('Y-m-d\TH-i-s\Z');
        $fileUrl = 'https://cdn.boondockdev.com/favorite.php?f=' . $timestamp . '.wav';
    
        // Perform a POST request to the desired URL with the converted file data
        $client = new Client();
        $response = $client->post($fileUrl, [
            'multipart' => [
                [
                    'name' => 'audioFile',
                    'contents' => fopen($outputFile, 'r'),
                    'filename' => $fileName // Set the filename as the user ID
                ]
            ]
        ]);
    
        // Delete the temporary converted file
        unlink($outputFile);
    
        // Check the response status code
        $statusCode = $response->getStatusCode();
    
        // Retrieve the message from the response body
        $message = $response->getBody()->getContents();
    
        // Return the response
        return redirect()->route('favorites.index')->with('success', 'File uploaded successfully.');
    }
    

    
    public function transcribeAudio($id)
    {
        $message = Message::findOrFail($id);
        if ($message->transcribe_long) {
            // Transcription has already been done
            return response()->json(['error' => 'Transcription has already been done.']);
        }
        // if (str_contains($message->file_name, 'uploads'))
        // {
            $file = \config('app.cdn_server') . '/uploads/' . $message->mac . '/' . $message->file_name;
        // }
        // else
        // {
        //     $file = storage_path('app/public/uploads/' . $message->mac . '/' . $message->file_name);
        // }
        $originalFileExtension = pathinfo($file, PATHINFO_EXTENSION);
        $transcription = $this->audio_2_text($file, $originalFileExtension);
        $message->transcribe_long = $transcription;
        $message->save();
        return response()->json(['transcription' => $transcription]);
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
public function deleteSelected(Request $request)
{
    try {
        $selectedIds = $request->input('selectedIds');
        Message::whereIn('id', $selectedIds)->delete();
        return response()->json([
            'message' => 'Selected audio files have been deleted successfully.'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'An error occurred while deleting the selected audio files: ' . $e->getMessage()
        ], 500);
    }
}

}
