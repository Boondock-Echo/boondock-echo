<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Http\Request;

class CustomVerificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Controllers\Auth\VerificationController  $verificationController
     * @return \Illuminate\Http\Response
     */
    public function index(VerificationController $verificationController)
    {
        return view('auth.verify');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Http\Controllers\Auth\VerificationController  $verificationController
     * @return \Illuminate\Http\Response
     */
    public function create(VerificationController $verificationController)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Controllers\Auth\VerificationController  $verificationController
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, VerificationController $verificationController)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Controllers\Auth\VerificationController  $verificationController
     * @param  \{{ namespacedModel }}  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    public function show(VerificationController $verificationController, \App\Models\User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Controllers\Auth\VerificationController  $verificationController
     * @param  \{{ namespacedModel }}  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    public function edit(VerificationController $verificationController, \App\Models\User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Controllers\Auth\VerificationController  $verificationController
     * @param  \{{ namespacedModel }}  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VerificationController $verificationController, \App\Models\User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Controllers\Auth\VerificationController  $verificationController
     * @param  \{{ namespacedModel }}  ${{ modelVariable }}
     * @return \Illuminate\Http\Response
     */
    public function destroy(VerificationController $verificationController, \App\Models\User $user)
    {
        //
    }
}
