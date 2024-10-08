<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatGPTController;

Route::get('/', function () {
    return view('app');
});
Route::post('/reponse', function () {
    return view('welcome');
});
// Route::post('/ask-chatgpt', action: [ChatGPTController::class, 'ask']);
Route::post('/ask-chatgpt', [ChatGPTController::class, 'ask'])->name('ask.chatgpt');
