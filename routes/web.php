<?php

use App\Http\Controllers\ChatGPTController;
use App\Http\Controllers\DiagnosisController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});
Route::post('/reponse', function () {
    return view('welcome');
});

Route::post('/ask-chatgpt', [ChatGPTController::class, 'ask'])->name('ask.chatgpt');

Route::post('/diagnosis', [DiagnosisController::class, 'create']);
Route::get('/diagnosis/all', [DiagnosisController::class, 'getAll']);
