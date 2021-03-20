<?php

use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\OrganizerController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\GoogleController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Kataki\Syber_pay\Http\Controllers\PaymentController;

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

// Route::apiResource('User','Api\UserController')->middleware('auth:api');

Route::post('register', [RegisterController::class, 'register']);

Route::post('login', [RegisterController::class, 'login']);

// -----------------------google login---------------------//
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);

Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
// -----------------------google login---------------------//

// -----------------------sayber pay route---------------------//
Route::post('transactions/syber/payment/{order_id}', [PaymentController::class, 'SyberPay'])->name('payment');
Route::post('transactions/syber/notify', [PaymentController::class, 'notify']);
Route::post('transactions/syber/return', [PaymentController::class, 'return']);
Route::post('transactions/syber/cancel', [PaymentController::class, 'cancel']);
// -----------------------sayber pay route---------------------//

Route::group(['middleware' => ['auth:api']], function () {
    Route::apiResources([
        'User' => 'Api\UserController',
        'Organizer' => 'Api\OrganizerController',
        'Event' => 'Api\EventController',
        'Booking' => 'Api\BookingController',
    ]); 
});

// Route::apiResource('Booking','Api\BookingController');