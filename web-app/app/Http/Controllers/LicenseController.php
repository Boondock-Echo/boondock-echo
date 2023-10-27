<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Dock;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Devicecodes;
use App\Models\Station;
use App\Models\Message;
use App\Models\DockCategory;
use App\Rules\VerifyDeviceCode;
use Illuminate\Support\Facades\DB;

class LicenseController extends Controller
{
    public function index()
    {
        $license_code = Devicecodes::paginate(10); // Change the number (10) as per your desired page size.
        return view('license.index', compact('license_code'));
    }
    
    public function register_code_details($id)
    {
      
        $license_code = Devicecodes::where('id', $id)->first();
        // dd($license_code);
        return view('license.details', compact('license_code'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number_of_codes' => 'required|integer|min:1',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('license.create')->withErrors($validator)->withInput();
        }
    
        $numberOfCodes = $request->input('number_of_codes');
    
        $codes = [];
    
        for ($i = 0; $i < $numberOfCodes; $i++) {
            $part1 = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4));
            $part2 = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4));
            $code = $part1 . '-' . $part2;
    
            $codes[] = [
                'code' => $code,
                'status' => 0,
                'dock_id' => null,
                'license_type' => 1,
                'storage_type' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        DB::table('device_codes')->insert($codes);
    
        return redirect()->route('license.index')->with('success', 'Generated ' . $numberOfCodes . ' license codes successfully.');
    }
}
