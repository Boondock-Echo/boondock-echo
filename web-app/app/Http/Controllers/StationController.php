<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;
use App\Models\Dock;

use Illuminate\Support\Facades\Auth;
class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::user()->id;

        $station = Station::where('user_id', $userId)->get();
        $activeDocks = Dock::where('active', 1)->where('owner', $userId)->get();
        return view('station.index', ['station' => $station, 'activeDocks' => $activeDocks,]);
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
    try {
        // Validate the request data
        $validatedData = $request->validate([
            'station' => 'required|string|max:255',
            'category_id' => 'nullable|integer',
            'frequency' => 'required|string|max:255',
            'rx_enabled' => 'nullable|boolean',
            'tx_enabled' => 'nullable|boolean',
            'description' => 'nullable|string',
        ]);
    
        // Get the authenticated user's ID
        $user_id =  Auth::user()->id;
    
        // Create a new station with the validated data and authenticated user's ID
        $station = Station::create([
            'user_id' => $user_id,
            'category_id' => $validatedData['category_id'],
            'station' => $validatedData['station'],
            'frequency' => $validatedData['frequency'],
            'rx_enabled' => $validatedData['rx_enabled'],
            'tx_enabled' => $validatedData['tx_enabled'],
            'description' => $validatedData['description'],
        ]);
    
        // Return a response indicating success
        return response()->json(['message' => 'Station added successfully']);
    } catch (\Exception $e) {
        // Return a response indicating failure
        $errors = ['error' => $e->getMessage()];
        return response()->json(['errors' => $errors], 500);
    }
}


public function stationdockupdate(Request $request, $id)
{
    try {
        $dock = Dock::findOrFail($id);
        $dock->station = $request->input('station');
        $dock->frequency = $request->input('frequency');
        $dock->save();

        // Return a response indicating success
        return response()->json(['message' => 'Station updated successfully']);
    } catch (\Exception $e) {
        // Return a response indicating failure
        $errors = ['error' => $e->getMessage()];
        return response()->json(['errors' => $errors], 500);
    }
}

    
    

    public function stationdockremove($id)
{
    // Find the station or dock you want to remove
    $station = Station::find($id);

    // Perform the necessary actions to remove the station or dock
    $station->delete();

    // Return a JSON response to indicate successful removal
    return response()->json([
        'message' => 'Station removed successfully'
    ]);
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
    public function delete(Request $request)
{
    try {
        // Retrieve the station IDs to be deleted
        $stationIds = $request->input('stationIds');

        // Delete the stations
        Station::whereIn('id', $stationIds)->delete();

        // Return a response indicating success
        return response()->json(['message' => 'Stations deleted successfully']);
    } catch (\Exception $e) {
        // Return a response indicating failure
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

}
