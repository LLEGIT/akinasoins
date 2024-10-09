<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatGPTController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\DiagnosisController;

Route::post('/reponse', function () {
    return view('welcome');
});

Route::post('/ask-chatgpt', [ChatGPTController::class, 'ask'])->name('ask.chatgpt');

Route::get('/', [HomeController::class, 'show']);

 Route::get('/questions', function () {
    return view('questions');
})->name('questions');

Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics');

Route::get('/questions/{page?}', [QuestionsController::class, 'show'])->name('questions');
Route::post('/diagnosis', [DiagnosisController::class, 'create']);
Route::get('/diagnosis/all', [DiagnosisController::class, 'getAll']);
Route::get('/diagnosis/statistics', [DiagnosisController::class, 'getStatistics']);
Route::get('/questions', [ChatGPTController::class, 'initialize_game']);
