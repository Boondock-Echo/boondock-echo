<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Dock;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DockadminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 5);
        $docks = Dock::orderBy('id','DESC')->paginate($per_page);
        $user = Auth::user();
        $docks = Dock::whereHas('owner', function($query) use($user){
            $query->where('company', $user->company);
        })->orderBy('id', 'DESC')->paginate($per_page);
        $totalDocks =  $docks->count();
        $users = User::where('company', $user->company)->get();

        return view('dockadmin.index', ['totalDocks' => $totalDocks ], compact('docks','per_page','users','user'))
        ->with('i', ($request->input('page', 1) - 1) * $per_page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dockadmin.create');
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
            'mac' => 'required|unique:docks',
        ]);

        Dock::create([
            'name' => $request->name,
            'mac' => $request->mac,
            // 'location' => $request->location,
        ]);

        return redirect()->route('dockadmin.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('dockadmin.show', compact('dock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('dockadmin.edit', compact('dock'));
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
            // 'mac' => 'required|unique:docks',
        ]);

        $input = $request->all();
        $dock = Dock::find($id);
        $dock->update($input);

        return redirect()->route('dockadmin.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Dock::find($id)->delete();
        return redirect()->route('dockadmin.index')
                        ->with('success','User deleted successfully');
    }
}
