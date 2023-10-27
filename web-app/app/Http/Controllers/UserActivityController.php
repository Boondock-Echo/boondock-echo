<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Dock;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Session;

class UserActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $loginusers = Activity::where('description', 'Login')
        ->latest()
        ->get();
        $totalUsers = User::count();
    
        // Assuming you have a relationship named 'docks' in your User model
        $totalActiveDocks = Dock::where('active', '1')->count();
        $totalDocks = Dock::count();
    
        return view('user_activity.index', compact('totalUsers', 'loginusers', 'totalActiveDocks','totalDocks'));
    }
    // {
       
    //     // $docks = Dock::where('owner', $user->id)->get();
    //     $loginusers = Activity::where('description', 'Login')
    //     ->get();
       
    //     $totalUsers = User::count();
    //     return view('user_activity.index', compact('totalUsers','loginusers'));
    // }


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
    public function show(Request $request,$id)
    {
         
        $user = User::findOrFail($id);
       // Retrieve the latest dock logs for the user
       $docklogsQuery = Activity::where('causer_id', $user->id);

       // Retrieve the selected filter from the request
       $selectedFilter = $request->input('filter');
   
       // Apply filter if selected
       if ($selectedFilter && in_array($selectedFilter, ['created', 'updated', 'deleted'])) {
           $docklogsQuery->where('description', $selectedFilter);
       }
   
       $docklogs = $docklogsQuery->latest()->paginate(10);

       
        $loginusers = Activity::where('description', 'Login')
        ->where('causer_id',  $user->id)
        ->get();
        // dd($user->id);
        $docks = Dock::where('owner', $user->id)->get();
      
        $totalUsers = User::count();
        return view('user_activity.user_activity_details',compact('totalUsers','loginusers','user','docks','docklogs'));
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
    public function destroy(Request $request, $id)
    {
        // Find the login user record based on the provided $id
        $loginuser = Activity::find($id);

        // Perform the delete action
        if ($loginuser) {
            $loginuser->delete();
            // Optionally, you can add some logic or a success message here.
            $request->session()->flash('success', 'User activity deleted successfully.');
        } else {
            // Optionally, you can handle the case when the login user is not found.
        }

        // Redirect back to the previous page or any other page you want after the delete.
        return redirect()->back();
    }

    public function forceLogout($userId)
    {
        // Find the user by ID
        $user = User::find($userId);

        // Check if the user exists
        if ($user) {
            // Check if the user is currently logged in
            if (Auth::check()) {
                // Force logout the user
                Auth::logout();

                // Redirect back to the previous page or any other page you want after the forced logout.
                return redirect()->back()->with('success', 'User logged out successfully.');
            } else {
                // The user is not currently logged in. Handle this case accordingly.
                return redirect()->back()->with('error', 'User is not currently logged in.');
            }
        } else {
            // The user with the provided ID was not found. Handle this case accordingly.
            return redirect()->back()->with('error', 'User not found.');
        }
    }

    
}
