<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dock;
use App\Models\Schedule;
use App\Models\SchedulerLog;
use MQTT;
use App\Jobs\ScheduleJob;
use Carbon\Carbon;

class SchedularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $docks = Dock::where('owner', Auth::id())
        ->get();
        $schedules = Schedule::where('user_id', Auth::id())->get();
        $schedulerLogs = SchedulerLog::where('user_id', Auth::id())->paginate(20);

        return view('schedular.index', compact('docks', 'schedules', 'schedulerLogs'));
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
        $data = $request->validate([
            'dock_id' => 'required',
            'type' => 'required',
            'week_day' => 'required_if:type,weekly',
            'day_of_month' => 'required_if:type,monthly',
            'date' => 'required_if:type,custom',
            'time' => 'required',
            'task' => 'required',
            'description' => 'nullable',
        ]);

        $data['user_id'] = Auth::id();
        $data['is_enabled'] = '1';
      
        $user = Auth::user();
        $timezone = $user->timezone;
       
        // Perform any additional operations or validations if needed

     // Calculate the scheduled datetime based on the selected date and time
        $scheduledDateTime = null;
        if ($data['type'] === 'weekly') {
            // Use Carbon to parse the selected weekday and time
            $scheduledDateTime = Carbon::parse($data['week_day'] . ' ' . $data['time']);
        } elseif ($data['type'] === 'monthly') {
            
            // Construct the datetime string in a valid format
            $datetimeString = $data['day_of_month'] . ' ' . Carbon::now()->format('Y-m') . ' ' . $data['time'];

            // Use Carbon to parse the datetime string
            $scheduledDateTime = Carbon::createFromFormat('d Y-m H:i', $datetimeString);
        } elseif ($data['type'] === 'custom') {
            // Use Carbon to create a datetime from the selected date and time format
            $scheduledDateTime = Carbon::createFromFormat('Y-m-d H:i', $data['date'] . ' ' . $data['time']);
        } elseif ($data['type'] === 'daily') {
            // Use Carbon to parse the selected time
            $scheduledDateTime = Carbon::parse($data['time']);
        }
 // Set the timezone for the scheduled datetime
   $scheduledDateTime = $scheduledDateTime->copy()->shiftTimezone($timezone);

    


    // Add the user's timezone information to the schedule
    $data['scheduled_datetime'] = $scheduledDateTime;
   // Determine the value of the message for the job
  $message = ($data['task'] === 'record_line_in_on' || $data['task'] === 'set_speaker_on'|| $data['task'] === 'upload_on' || $data['task'] === 'reboot') ? '1' : '0';


    // Create a new instance of the Schedule model and fill it with the validated form data
    $schedule = Schedule::create($data);

    $jobTask = ($data['task'] === 'record_line_in_on' || $data['task'] === 'record_line_in_off') ? 'record_line_in' : ($data['task'] === 'set_speaker_on' || $data['task'] === 'set_speaker_off' ? 'spkr_on' : ($data['task'] === 'upload_on' || $data['task'] === 'upload_off' ? 'upload_line_in' : $data['task']));


    // Schedule the job to run at the calculated scheduled datetime
    ScheduleJob::dispatch($schedule, $message, $jobTask)->delay($scheduledDateTime);

        // Return a response or redirect to a success page
        return redirect()->back()->withSuccess('Data stored successfully.');
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


    public function disable($id)
{
    // Find the element with the given ID in your database
    $schedule = Schedule::find($id);

    // Update the 'status' field to 0
    $schedule->is_enabled = 0;
    $schedule->save();

    // Perform any other necessary actions or redirect as needed

    // Redirect back to the previous page, assuming you want to stay on the same page after disabling the element
    return redirect()->back();
}

public function activate($id)
    {
        // Find the element with the given ID in your database
        $schedule = Schedule::find($id);

        // Update the 'is_enabled' field to 1 (activated)
        $schedule->is_enabled = 1;
        $schedule->save();

        // Perform any other necessary actions or redirect as needed

        // Redirect back to the previous page, assuming you want to stay on the same page after activating the element
        return redirect()->back();
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
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
    
        // Optionally, you can redirect back to the schedule index page or any other desired location
        return redirect()->route('schedular.index')->withSuccess('Schedule deleted successfully.');
        
    }
    public function scdeularLog_delete($id)
    {
        $schedulelog = SchedulerLog::findOrFail($id);
        $schedulelog->delete();
    
        // Optionally, you can redirect back to the schedule index page or any other desired location
        return redirect()->route('schedular.index')->withSuccess('Schedule log deleted successfully.');
        
    }
    

}
