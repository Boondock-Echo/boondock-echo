<?php

namespace App\Http\Controllers;

use App\Models\Dockpack;
use App\Http\Requests\StoredockpackRequest;
use App\Http\Requests\UpdatedockpackRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Dock;
use App\Models\Devicecodes;
use App\Rules\VerifyDeviceCode;
use Illuminate\Support\Str;

class DockpackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dockpacks = Dockpack::where('owner', Auth::id())->get();
        $docks = Dock::where('owner', Auth::id())
        ->where('in_use', 0)
        ->get();
        $dockcount = Dock::where('owner', Auth::id())
        ->get();
        $dock_in_use = Dock::where('owner', Auth::id())
        ->where('in_use', 1)
        ->get();
        $users = User::all();
        return view('dockpack.index', compact('dockpacks','users','docks','dock_in_use','dockcount'));
    }
    public function updateInUse(Request $request)
    {
        $selectedDocks = explode(',', $request->selected_docks);
        $docks = Dock::whereIn('name', $selectedDocks)->where('owner', Auth::id())->where('in_use', 0)->get();

        if ($docks->count() > 0) {
            foreach ($docks as $dock) {
                $dock->in_use = 1;
                $dock->save();
            }
            return redirect()->back()->with('success', 'Dock Have Been added  successfully.');
        } else {
            return redirect()->back()->with('error', 'No docks were updated.');
        }
    }
    public function update_in_usesett(Request $request, $id)
    {
        $validatedData = $request->validate([
            'selected_docks' => 'required'
        ]);

        $selectedDocks = explode(',', $request->selected_docks);
        $docks = Dock::whereIn('name', $selectedDocks)
                    ->where('owner', Auth::id())
                    ->get();

        if ($docks->count() > 0) {
            foreach ($docks as $dock) {
                $dock->in_use = 1;
                $dock->update(['dock_pack_id' => $id]);
                $dock->save();
            }
            return redirect()->back()->with('success', 'Docks have been added successfully.');
        } else {
            return redirect()->back()->with('error', 'No docks were updated.');
        }
    }
    public function update_available_docks(Request $request)
    {
        $dockIds = $request->input('dock_ids');

        foreach ($dockIds as $dockId) {
            $dock = Dock::find($dockId);
            $dock->in_use = 0;
            $dock->save();
        }

        return redirect()->back()->with('success', 'Selected docks have been removed successfully.');
    }
    public function update_available_docksett(Request $request , $id)
    {
        $dockIds = $request->input('dock_ids');

        foreach ($dockIds as $dockId) {
            $dock = Dock::find($dockId);
            $dock->in_use = 0;
            $dock->dock_pack_id = NULL;
            $dock->save();
        }

        return redirect()->back()->with('success', 'Selected docks have been removed successfully.');
    }
    public function dock_enable(Request $request, $id)
    {
        $dock = Dock::find($id);

        if (!$dock) {
            return response()->json([
                'success' => false,
                'message' => 'Dock not found'
            ]);
        }

        if ($request->has('rx_enabled')) {
            $dock->rx_enabled = $request->input('rx_enabled');
        }

        if ($request->has('tx_enabled')) {
            $dock->tx_enabled = $request->input('tx_enabled');
        }

        $dock->save();

        return response()->json([
            'success' => true,
            'message' => 'Dock updated successfully'
        ]);
    }

    public function getData()
    {
        $dock_in_use = Dock::where('owner', Auth::id())
        ->where('in_use', 1)
        ->whereNull('dock_pack_id')
        ->get();
        return view('dockpack.table', compact('dock_in_use'))->render();
    }
    public function dockpacksett_container($id)
{
    $dock_in_use = Dock::where('owner', Auth::id())
        ->where('in_use', 1)
        ->where('dock_pack_id', $id)
        ->get();

    return view('dockpack.dockpacksett_container', compact('dock_in_use','id'))->render();
}
    public function available_docks()
    {
        $available_docks = Dock::where('owner', Auth::id())
        ->where('in_use', 0)
        ->get();
        return view('dockpack.available_docks', compact('available_docks'))->render();

    // need to create routes and function
    }
    public function available_docksett($id)
    {
        $available_docks = Dock::where('owner', Auth::id())
        ->whereNull('dock_pack_id')
        ->get();
        return view('dockpack.available_docksett', compact('available_docks','id'))->render();
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
     * @param  \App\Http\Requests\StoredockpackRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoredockpackRequest $request)
    {
        $validatedData = $request->validated();

        $dockpack = new Dockpack;

        $dockpack->pack_id = mt_rand(100000, 999999); // Generate a random number between 100000 and 999999 as pack id

        $dockpack->name = $validatedData['name'];
        $dockpack->description = $validatedData['description'];
        $dockpack->owner = Auth::id();
        $dockpack->enabled = $request->has('enabled');

        $dock_in_use = Dock::where('owner', Auth::id())
            ->where('in_use', 1)
            ->whereNull('dock_pack_id')
            ->get();

        $dockpack->save();

        // Update dock_pack_id of related docks
        foreach ($dock_in_use as $dock) {
            $dock->dock_pack_id = $dockpack->id;
            $dock->save();
        }

        return redirect()->route('dockpack.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\dockpack  $dockpack
     * @return \Illuminate\Http\Response
     */
    public function show(dockpack $dockpack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\dockpack  $dockpack
     * @return \Illuminate\Http\Response
     */
    public function edit(dockpack $dockpack)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatedockpackRequest  $request
     * @param  \App\Models\dockpack  $dockpack
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatedockpackRequest $request, Dockpack $dockpack)
{
    $validatedData = $request->validated();

    $dockpack->name = $validatedData['name'];
    $dockpack->description = $validatedData['description'];

    $dockpack->save();

    return redirect()->route('dockpack.index');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\dockpack  $dockpack
     * @return \Illuminate\Http\Response
     */
    public function destroy(dockpack $dockpack)
    {
        $dockpack->delete();


    return redirect()->route('dockpack.index');
    }
}
