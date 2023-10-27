<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FccController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
public function index(Request $request)
{
    $searchValue = $request->input('searchValue');
    $url = "https://data.fcc.gov/api/license-view/basicSearch/getLicenses?searchValue=$searchValue&format=json";

    // Send the AJAX request to retrieve data
    $response = Http::get($url);

    if ($response->successful()) {
        $data = $response->json();

        // Update the authenticated user with the retrieved data
        $user = Auth::user();
        $user->license_status = $data['Licenses']['License'][0]['statusDesc'];
        
        // Convert the date format to 'YYYY-MM-DD'
        $expirationDate = Carbon::createFromFormat('m/d/Y', $data['Licenses']['License'][0]['expiredDate']);
        $user->license_expiration_date = $expirationDate->format('Y-m-d');
        
        $user->license_type = $data['Licenses']['License'][0]['serviceDesc'];
        $user->license_name = $data['Licenses']['License'][0]['licName'];
        $user->call_sign = $data['Licenses']['License'][0]['callsign'];
        // $user->call_sign = $searchValue;
        $user->save();

        return response()->json($data);
    } else {
        return response()->json(['error' => 'Failed to fetch license data'], 500);
    }
}
public function fcccheck(Request $request)
{
    $searchValue = $request->input('searchValue');
    $url = "https://data.fcc.gov/api/license-view/basicSearch/getLicenses?searchValue=$searchValue&format=json";

    $response = Http::get($url);

    if ($response->successful()) {
        $data = $response->json();

        return response()->json($data);
    } else {
        return response()->json(['error' => 'Failed to fetch license data'], 500);
    }
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
