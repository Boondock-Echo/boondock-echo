<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use DB;
use Illuminate\Support\Str;
use App\Models\Dock;
use App\Models\Message;
use App\Models\Outbox;
use App\Models\Message2;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
class OutboxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

            $per_page = $request->input('per_page', 10);
            $userId = Auth::user()->id;
            $audioFiles = Message::where('deleted', 0)->whereHas('dock', function ($query) use ($userId) {$query->where('owner', $userId);
         })->whereHas('outbox', function ($query) {
         $query->whereNotNull('message_id');
        })
         ->orderBy('added', 'desc')
         ->paginate($per_page);
            $audioFiles2 = Message::where('deleted', 0)->whereHas('dock', function ($query) use ($userId) {$query->where('owner', $userId);
         })->whereHas('outbox', function ($query) {
         $query->whereNotNull('message_id');
        });

            // $audioFiles1 = Message::where('deleted', 0)->whereHas('dock', function ($query) use ($userId) {
            //     $query->where('owner', $userId);
            // });

            $totalaudioFiles = $audioFiles2->count();
            $docks = Dock::where('owner', Auth::id())->get();
            $totalDocks = $docks->count();
            $docks1 = Dock::where('active', 1)->where('owner', Auth::id())->get();
            $dock2 = Dock::join('messages', 'docks.mac', '=', 'messages.mac')
            ->where('docks.active', 1)
            ->select('docks.*')
            ->distinct()
            ->get();
            $totalActiveDocks = $docks1->count();

            return view('outbox.index',['totalDocks' => $totalDocks ], compact('audioFiles','per_page','totalaudioFiles','totalActiveDocks','dock2'))
            ->with('i', ($audioFiles->currentPage() - 1) * $per_page)
            ->with('per_page', $per_page)
            ->withInput($request->only('per_page'));





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
        $exists = Outbox::where('message_id', $request->input('message_id'))->exists();
        if ($exists) {
            return response()->json([
                'status' => 'error',
                'message' => ' already audio Sent.'
            ]);
        }

        $outbox = new Outbox;
        $outbox->message_id = $request->input('message_id');
        $outbox->save();

        return response()->json([
            'status' => 'success',
            'message' => 'send Successfully.',
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
