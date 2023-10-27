<?php

namespace App\Http\Controllers;

use App\Models\Dock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Devicecodes;
use App\Models\Station;
use App\Models\Message;
use App\Models\DockCategory;
use MQTT;
use App\Rules\VerifyDeviceCode;


class MydockController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all docks assigned to the authenticated user
        $docks = Dock::where('owner', Auth::id())->get();
        $users = User::all();
        $categories = DockCategory::all();
        $userId = Auth::user()->id;
        $station = Station::where('user_id', $userId)->get();
        $totaldockaudio = Message::where('deleted', 0)
        ->whereHas('dock', function ($query) use ($userId) {
            $query->where('owner', $userId);
        })
        ->count();
        $dockAudioCounts = [];

    foreach ($docks as $dock) {
        $dockAudioCount = Message::where('mac', $dock->mac) // Filter messages by dock's mac
            ->where('deleted', 0)
            ->count();

        $dockAudioCounts[$dock->id] = $dockAudioCount;
    }
        return view('mydocks.index', compact('docks','users','categories','station','totaldockaudio','dockAudioCounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mydocks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // Validate the incoming data

        $this->validate($request, [
            'code' => [
                'required',
                function ($attribute, $value, $fail) {
                    $device = Devicecodes::where('code', $value)->where('status', 0)->first();
                    if (!$device) {
                        $fail($attribute.' is invalid Please Enter Valid Code Here.');
                    }
                },
            ],
            // 'name' => 'required',
            // 'station' => 'required',
            // 'rx_enabled' => 'required',
            // 'tx_enabled' => 'required',


        ]);
        $input = $request->all();
        // Assign the authenticated user as the owner of the new dock
        $input['owner'] = Auth::id();


       // Check if the dock with the given code already exists
       $dock = Dock::where('code', $input['code'])->first();
         if ($dock) {
      return response()->json(['success' => false, 'message' => 'Sorry Code Is Already Activated'], 409);
            }

        // Create the new dock
        $dock = Dock::create($input);
        $dockId = $dock->id;

        // return redirect()->route('mydocks.index')->with('success', 'Dock created successfully!');
        return response()->json(['success' => true, 'message' => 'Dock added successfully!', 'dock' => ['id' => $dockId]]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dock  $dock
     * @return \Illuminate\Http\Response
     */
    public function edit(Dock $dock)
    {
        // Ensure the authenticated user is the owner of the dock
        if ($dock->owner != Auth::id()) {
            return redirect()->route('mydocks.index')->with('error', 'You do not have permission to edit this dock.');
        }

        return view('mydocks.edit', compact('dock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dock  $dock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dock $dock, $id)
    {
        // Ensure the authenticated user is the owner of the dock
        if ($dock->owner = Auth::id()) {
            $input = $request->all();
            $dock = Dock::find($id);
            $dock->update($input);

            return redirect()->route('mydocks.index')->with('success', 'Dock Updated successfully!');
        }
        else{
            return redirect()->route('mydocks.index')->with('error', 'You do not have permission to edit this dock.');
        }

    }
    public function updatenewdock(Request $request)
{
  $code = $request->input('code');
  $dock = Dock::where('code', $code)->first();
  // Ensure the authenticated user is the owner of the dock
  if ($dock && $dock->owner == Auth::id()) {
    $input = $request->except('code');
    $updateData = [];

    foreach ($input as $key => $value) {
        if (!empty($value)) {
            $updateData[$key] = $value;
        } else {
            // Skip updating this field and keep the previous value
            $updateData[$key] = $dock->{$key};
        }
    }

    $dock->fill($updateData);
    $dock->save();
    return redirect()->route('mydocks.index')->with('success', 'Dock Added successfully!');
  } else {
    return redirect()->route('mydocks.index')->with('error', 'You do not have permission to edit this dock.');
  }
}
    public function destroy($id)
    {
        Dock::find($id)->delete();
        return redirect()->route('mydocks.index')
                        ->with('success','dock deleted successfully');
    }
    public function delete_alldockAudio($id)
    {
        $dock = Dock::findOrFail($id);
    
        // Delete all messages with the same MAC address as the dock's MAC address
        Message::where('mac', $dock->mac)->delete();
    
        return redirect()->route('mydocks.index')
                         ->with('success', 'All messages for the dock deleted successfully');
    }
    public function activation(Request $request)
{
    // Validate the incoming data
    $validator = Validator::make($request->all(), [
        'code' => [
            'required',
            function ($attribute, $value, $fail) {
                $code = Devicecodes::where('code', $value)->where('status', 1)->first();
                if (!$code) {
                    $fail($attribute.' is invalid. Please enter a valid code.');
                }
            },
        ],
    ]);

    if ($validator->fails()) {
        return redirect()->back()->with('error', $validator->errors()->first());
    }

    $input = $validator->validated();

    // Assign the authenticated user as the owner of the new dock
    $user = Auth::user();  // Use Auth::user() instead of Auth::id()

    // Check if the dock with the given code already exists
    $dock = Dock::where('code', $input['code'])->first();
    if ($dock) {
        // Check if the dock is already assigned to a user
        if ($dock->owner === $user->id) {
            return redirect()->back()->with('error', 'Key is already activated for your account  with dock '.$dock->name);
        }

        $code = Devicecodes::where('code', $input['code'])->first();

        if ($code->user_id) {
            return redirect()->back()->with('error', 'Key is already activated .');
        }

        $code->user_id = $user->id;
        $code->save();
        
        // Update the dock's owner
        $dock->owner = $user->id;
        $dock->save();

        $mqtt = MQTT::connection();
        $global_topic = config('app.global_mqtt_topic');
        $topic_web = 'user_id';
        $topic =  $global_topic.'/'.$dock->mac.'/'.'set'.'/'.$topic_web;
        $message = $user->id;

        if (!empty($message)) {
            $mqtt->publish($topic, $message, 0, false);
        }
        else
        {
            $mqtt->publish($topic,"", 0, false);
        }

        $mqtt->disconnect();
        return redirect()->back()->with('success', 'License activated to you');
    }

    return redirect()->back()->with('error', 'No license found!');
}

    
    
}
