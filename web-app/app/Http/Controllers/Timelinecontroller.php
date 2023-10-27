<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;


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
class Timelinecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        return view('timeline.index', [
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
        //
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
    public function destroy($id)
    {
        //
    }
}
