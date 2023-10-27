<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dock;
use App\Models\AudioAlert;
use App\Models\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class MonitorController extends Controller
{
    

    public function fetchMonitorTable()
    {
        $user = User::find(Auth::id());
        $alerts = $user->alerts()->orderBy('created_at', 'desc')->get();
        $audioAlerts = AudioAlert::where('owner_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $docks = Dock::where('owner', Auth::id())
            ->where('auto_transcribe', 1)
            ->get();

       
        // Render the monitor table view and return the HTML
        // return view('alerts.show', compact('alerts', 'audioAlerts', 'docks'));
        $html = View::make('keyword_monitor.monitor_table', compact('alerts', 'audioAlerts', 'docks'))->render();

        return response()->json($html);
    }

}
