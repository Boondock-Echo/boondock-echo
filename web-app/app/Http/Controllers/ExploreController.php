<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;
use App\Models\Explore;
use App\Models\RadioReferenceDb;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;
use Symfony\Component\HttpFoundation\StreamedResponse;

 
class ExploreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mapapi  = config('app.map_api');
        $exploreData = Explore::select('*')
        ->whereIn('id', function ($query) {
            $query->select(DB::raw('MAX(id)'))
                ->from('explore')
                ->groupBy('call');
        })
        ->orderBy('created_at', 'desc')
        
        ->get();
        // dd($exploreData);
        // Get the zoom level from the request, default to 10miles zoom 5 if not provided
        $userzoomfilter = $request->input('zoom', '11');
        
        // Initialize the distance variable with a default value
        $distance = '1';
     
        // Use conditional logic to set the distance based on the zoom level
    if ($userzoomfilter == '13') {
        $distance = 2;
    } elseif ($userzoomfilter == '12') {
        $distance = 5;
    } elseif ($userzoomfilter == '11') {
        $distance = 5;
    } elseif ($userzoomfilter == '10') {
        $distance = 10;
    
} elseif ($userzoomfilter == '9') { // Added condition for 50 miles
    $distance = 50;
} elseif ($userzoomfilter == '4') {
            $distance = '6371';
        }
       // Fetch data from the RadioReferenceDb model
    $radioReferenceData = RadioReferenceDb::all(); // You may need to adjust this to your actual use case 
        return view('explore.index', compact('mapapi', 'exploreData', 'userzoomfilter', 'distance', 'radioReferenceData'));
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
    public function store( )
    {
        
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
    public function importCsvForm()
{
    $exploreData = Explore::paginate(10); // Change the number per page as needed

    return view('explore.explore_data', compact('exploreData'));
}

    

public function importCsv(Request $request)
{
    // Validate the uploaded file
    $validator = Validator::make($request->all(), [
        'csv_file' => [
            'required',
            'file',
            'mimes:csv',
            'max:9048', // Only allow CSV files up to 9MB
        ],
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Get the uploaded CSV file
    $csvFile = $request->file('csv_file');

    // Initialize variables to keep track of progress
    $totalRecords = 0;
    $recordsProcessed = 0;

    // Process and store the CSV file
    try {
        $csvFilePath = $csvFile->storeAs('public/csv_files', $csvFile->getClientOriginalName());

        if (Storage::exists($csvFilePath)) {
            $csv = Reader::createFromPath(storage_path('app/' . $csvFilePath), 'r');
            $csv->setHeaderOffset(0);

            foreach ($csv->getRecords() as $row) {
                if ($recordsProcessed >= 500) {
                    break; // Exit the loop when the limit is reached
                }
                // Process the row and create the data array as before
                $data = [
                   
                    'Output_Freq' => isset($row['Output Freq']) && trim($row['Output Freq']) !== '-' ? floatval(str_replace(',', '.', $row['Output Freq'])) : null,
                    'Input_Freq' => isset($row['Input Freq']) && trim($row['Input Freq']) !== '-' ? floatval(str_replace(',', '.', $row['Input Freq'])) : null,
                    'Offset' =>  isset($row['Offset']) && trim($row['Offset']) !== '-' ? floatval(str_replace(',', '.', $row['Offset'])) : null,
                    'Uplink_Tone' => isset($row['Uplink Tone']) && trim($row['Uplink Tone']) !== '-' ? $row['Uplink Tone'] : null,
                    'Downlink_Tone' => isset($row['Downlink Tone']) && trim($row['Downlink Tone']) !== '-' ? $row['Downlink Tone'] : null,
                    'Location' => isset($row['Location']) && trim($row['Location']) !== '-' ? $row['Location'] : null,
                    'County' => isset($row['County']) && trim($row['County']) !== '-' ? $row['County'] : null,
                    'Lat' => isset($row['Lat']) && trim($row['Lat']) !== '-' ? floatval($row['Lat']) : null,
                    'Long' => isset($row['Long']) && trim($row['Long']) !== '-' ? floatval($row['Long']) : null,
                    'Call' => isset($row['Call']) && trim($row['Call']) !== '-' ? $row['Call'] : null,
                    'Use' => isset($row['Use']) && trim($row['Use']) !== '-' ? $row['Use'] : null,
                    'Op_Status' => isset($row['Op Status']) && trim($row['Op Status']) !== '-' ? $row['Op Status'] : null,
                    'Mode' => isset($row['Mode']) && trim($row['Mode']) !== '-' ? $row['Mode'] : null,
                    'Digital_Access' => isset($row['Digital Access']) && trim($row['Digital Access']) !== '-' ? $row['Digital Access'] : null,
                    'EchoLink' => isset($row['EchoLink']) && trim($row['EchoLink']) !== '-' ? $row['EchoLink'] : null,
                    'IRLP' => isset($row['IRLP']) && trim($row['IRLP']) !== '-' ? $row['IRLP'] : null,
                    'AllStar' => isset($row['AllStar']) && trim($row['AllStar']) !== '-' ? $row['AllStar'] : null,
                    'Coverage' => isset($row['Coverage']) && trim($row['Coverage']) !== '-' ? $row['Coverage'] : null,
                    'Status' => isset($row['Status']) && trim($row['Status']) !== '-' ? $row['Status'] : null,
                    'Last_Update' => null,
                ];
                    // Check if a record with the same data already exists
                    $existingRecord = Explore::where([
                        'Output_Freq' => $data['Output_Freq'],
                        // 'Input_Freq' => $data['Input_Freq'],
                        'Call' => $data['Call']
                        // Add more fields as needed for comparison
                    ])->first();

                       if ($existingRecord) {
                        // Update the existing record with new data if needed
                        $existingRecord->update($data);
                    } else {
                        // Create a new record if no existing record is found
                        Explore::create($data);
                    }



          $recordsProcessed++;
    }

   
    } return redirect()->back()->with('success', 'CSV file uploaded and data stored successfully!');
        } catch (\Exception $e) {
        // Log the error for debugging purposes
        Log::error('Error processing CSV file: ' . $e->getMessage());

        // Return a meaningful error message to the client
        return redirect()->back()->with('error', 'An error occurred while processing the CSV file. Please try again.');
        }
}
public function exportCsv()
{
    $exploreData = Explore::all();

    if ($exploreData->isEmpty()) {
        return redirect()->back()->with('error', 'No data to export.');
    }

    // Create a new CSV writer
    $csv = Writer::createFromFileObject(new \SplTempFileObject());

    // Add the CSV header row
    $csv->insertOne([
        'ID', 'Output Freq', 'Input Freq', 'Offset', 'Uplink Tone', 'Downlink Tone', 'Location',
        'County', 'Lat', 'Long', 'Call', 'Use', 'Op Status', 'Mode', 'Digital Access',
        'EchoLink', 'IRLP', 'AllStar', 'Coverage', 'Status', 'Type', 'Last Update',
    ]);

    // Add the data rows
    foreach ($exploreData as $data) {
        $csv->insertOne([
            $data->id, $data->Output_Freq, $data->Input_Freq, $data->Offset, $data->Uplink_Tone,
            $data->Downlink_Tone, $data->Location, $data->County, $data->Lat, $data->Long,
            $data->Call, $data->Use, $data->Op_Status, $data->Mode, $data->Digital_Access,
            $data->EchoLink, $data->IRLP, $data->AllStar, $data->Coverage, $data->Status,
            $data->Type, $data->Last_Update,
        ]);
    }

    // Create a response to stream the CSV
    $response = new StreamedResponse(function () use ($csv) {
        $csv->output();
    });

    // Set response headers
    $response->headers->set('Content-Type', 'text/csv');
    $response->headers->set('Content-Disposition', 'attachment; filename=explore_data.csv');

    return $response;
}


    private function parseOffset($value)
{
    // Define a mapping of special values to their respective conversions
    $valueMap = [
        '-' => null,
        '+' => null, // You can adjust this conversion as needed
        'x(*)' => null, // You can adjust this conversion as needed
        's' => null,
        'null' => null,
    ];

    // Check if the value exists in the mapping, and return the corresponding conversion
    if (array_key_exists($value, $valueMap)) {
        return $valueMap[$value];
    }

    // Check if the value is numeric, and replace commas with dots
    if (is_numeric($value)) {
        return floatval(str_replace(',', '.', $value));
    }

    // If none of the above conditions match, return null
    return null;
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
