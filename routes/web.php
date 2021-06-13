<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;
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

// feedback routes
Route::get('/', [FeedbackController::class, 'showFeedbackForm'])->name('feedback');
Route::post('/', [FeedbackController::class, 'storeFeedback'])->name('feedback.store');
//state and city
Route::get('/stateList', [FeedbackController::class, 'getStateList'])->name('states');

Route::get('/cityList', [FeedbackController::class, 'getCityList'])->name('cities');
