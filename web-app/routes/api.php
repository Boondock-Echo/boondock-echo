<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileApiController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Str;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TranscriptionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('uploads', [FileApiController::class, 'store'])->middleware('guest');
Route::post('contacts', [ContactController::class, 'store'])->middleware('guest');
Route::post('/transcribe/{id}', [TranscriptionController::class, 'transcribeAudio'])->name('transcribe.audio');