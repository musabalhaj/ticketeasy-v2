<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrganizerController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [RegisterController::class, 'register']);

Route::post('login', [RegisterController::class, 'login']);

// -----------------------google login---------------------//
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::apiResource('User','Api\UserController')->middleware('auth:api');

Route::apiResource('Organizer','Api\OrganizerController')->middleware('auth:api');

Route::apiResource('Event','Api\EventController')->middleware('auth:api');
