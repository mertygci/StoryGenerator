<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('multistep');
});

use App\Http\Controllers\ElevenLabsController;

Route::get('voices', [ElevenLabsController::class, 'indexVoices'])->name('voices.index');
Route::get('text-to-speech', [ElevenLabsController::class, 'textToSpeech'])->name('text.to.speech');
Route::post('synthesize', [ElevenLabsController::class, 'synthesize'])->name('synthesize');

use App\Http\Controllers\StoryController;

Route::get('story', [StoryController::class, 'index'])->name('indexStory');
Route::post('generate-story', [StoryController::class, 'generateStory'])->name('generateStory');
Route::get('story/show', [StoryController::class, 'show'])->name('showStory');
