<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatGPTController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\DiagnosisController;

Route::get('/', [HomeController::class, 'show'])->name('home');
Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics');

Route::get('/diagnosis/all', [DiagnosisController::class, 'getAll']);
Route::get('/diagnosis/statistics', [DiagnosisController::class, 'getStatistics']);

Route::get('/questions/{question}', [QuestionsController::class, 'show'])->name('questions');
Route::post('/submit-answer/{question}', [QuestionsController::class, 'submitAnswer'])->name('questions.answer');

Route::get('/questions', [ChatGPTController::class, 'initialize_game']);

Route::get('/recommendations', function () {
    return view('recommendations');
})->name('recommendations');

Route::view('/stats', 'stats');

Route::get('/initialize-diagnosis/{disorderType}', [ChatGPTController::class, 'initializeGame'])->name('chatgpt.initialize');
Route::post('/diagnosis/{step}', [ChatGPTController::class, 'ask'])->name('chatgpt.ask');
