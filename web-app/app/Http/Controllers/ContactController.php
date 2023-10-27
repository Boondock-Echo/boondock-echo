<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Queue;
use App\Jobs\SendContactFormEmailJob;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
   
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'email' => 'required|email',
            'phone' => 'nullable',
            'region' => 'nullable',
            'ip_address' => 'nullable',
            'user_timezone' => 'nullable',
            'description' => 'nullable',
        ]);
    
        $contact = Contact::create($validatedData);
    
        // Queue the email sending job
        SendContactFormEmailJob::dispatch($validatedData);
    
        return response()->json([
            'message' => 'Thank You for Contacting Us',
        ], 201);
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
