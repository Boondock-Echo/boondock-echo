<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Dock;
use App\Models\AudioAlert;
use App\Models\Alert;
use Illuminate\Support\Facades\Auth;

class AlertController extends Controller
{
    public function showAlerts()
    {
        $user = User::find(Auth::id());
        // $alerts = $user->alerts()->orderBy('created_at', 'desc')->get();
        $audioAlerts = AudioAlert::where('owner_id', Auth::id())->orderBy('created_at', 'desc')->get();
        $docks = Dock::where('owner', Auth::id())
            ->where('auto_transcribe', 1)
            ->get();
            $perPage = 10; // Number of items per page
       $alerts = Alert::where('user_id', Auth::id())->paginate($perPage);



        return view('alerts.show', compact('alerts', 'audioAlerts', 'docks'));
    }

    public function destroy(Request $request, $id)
    {
        // Find the alert with the given ID
        $alert = Alert::findOrFail($id);

        // Delete the alert
        $alert->delete();
        
        return redirect()->route('alerts.show')->withSuccess('Alert deleted successfully.');
      
        
    }
}
