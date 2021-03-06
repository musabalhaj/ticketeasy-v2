<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ReportController;

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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/report', [ReportController::class, 'index'])->name('report');

Route::get('/', function () {
    return view('welcome');
});

// -----------------------google login---------------------//
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Auth::routes();

Route::get('lang/{locale}', 'HomeController@lang');

Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::get('/profile/{id}', 'ProfileController@profile')->name('profile');
    
    Route::put('/updateProfile/{id}', 'ProfileController@updateProfile')->name('updateProfile');
    
    Route::get('/report', 'ReportController@index')->name('report.index');

    Route::get('/report/user', 'ReportController@user')->name('report.user');

    Route::get('/report/organizer', 'ReportController@organizer')->name('report.organizer');

    Route::get('/report/event', 'ReportController@event')->name('report.event');
    
    Route::get('/report/booking', 'ReportController@booking')->name('report.booking');
    
});

Route::group(['middleware' => ['auth','Admin']], function () {
    
    Route::resource('User', 'UserController');
    
    Route::resource('Organizer', 'OrganizerController');
    
});

Route::group(['middleware' => ['auth','Organizer']], function () {
    
    Route::resource('Event', 'EventController');

    Route::resource('Booking', 'BookingController');
    
});

Route::group(['middleware' => ['auth','User']], function () {
    

});