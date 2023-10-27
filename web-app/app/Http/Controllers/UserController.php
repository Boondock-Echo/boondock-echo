<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Account;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if (auth()->user()->hasRole('Super Admin')) {
        $per_page = $request->input('per_page', 5);
        $data = User::orderBy('id','DESC')->paginate($per_page);
        $totalUsers = User::count();
        $accounts = Account::all();
        $roles = Role::pluck('name','name')->all();
        $userRole = [];
        foreach($data as $user)
        {
            $userRole[$user->id] = $user->roles->pluck('name','name')->all();

        }

        // dd($userRole[$user->id]);
        return view('users.index', ['totalUsers' => $totalUsers ],compact('data','roles','userRole','per_page','accounts'))
            ->with('i', ($request->input('page', 1) - 1) * $per_page);
       }
    //     if (auth()->user()->hasRole('Admin')) {
    //     $per_page = $request->input('per_page', 5);
    //     $data = User::where('company', auth()->user()->company)->orderBy('id','DESC')->paginate($per_page);
    //     $totalUsers = User::where('company', auth()->user()->company)->count();
    //     $roles = Role::pluck('name','name')->all();
    //     $userRole = [];
    //     foreach($data as $user)
    //     {
    //         $userRole[$user->id] = $user->roles->pluck('name','name')->all();

    //     }
    //     // dd($userRole[$user->id]);
    //     return view('users.index', ['totalUsers' => $totalUsers ],compact('data','roles','userRole','per_page'))
    //         ->with('i', ($request->input('page', 1) - 1) * $per_page);
    //    }
    //    return redirect()->back()->withErrors(['Access denied. You are not authorized to view this page.']);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            // 'password' => 'required|same:confirm-password',
            // 'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            // 'password' => 'same:confirm-password',
            // 'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));



        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }

    public function updateLiveMode(Request $request)
    {
        $userId = $request->input('user_id');
        $liveMode = $request->input('live_mode');

        // Update the user's live_mode value in the database
        $user = User::findOrFail($userId);
        $user->live_mode = $liveMode;
        $user->save();

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }
    public function updateDarkMode(Request $request) {
        $user = Auth::user(); // Assuming you have user authentication set up

        $user->dark_mode = $request->input('darkMode');
        $user->save();

        return response()->json(['message' => 'Dark mode updated successfully.']);
    }
    public function updateOriginalAudio(Request $request)
    {
        $userId = $request->input('user_id');
        $originalAudio = $request->input('original_audio');
    
        // Update the user's original_audio value in the database
        $user = User::findOrFail($userId);
        $user->original_audio = $originalAudio;
        $user->save();
    
        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }
    
    

}
