<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\RidesController;

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
    return view('welcome');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');


Auth::routes();

Route::middleware(['auth', 'admin'])->group(function () {

Route::resource('drivers', 'App\Http\Controllers\DriverController');
Route::get('/get-available-cars', 'DriverController@getAvailableCars')->name('get.available.cars');

Route::resource('cars', 'App\Http\Controllers\CarController');

Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');
});



Route::resource('rides', 'App\Http\Controllers\RidesController');

Route::get('/get-available-cars', [RidesController::class, 'getAvailableCars'])->name('get.available.cars');
Route::post('/get-available-cars', [RidesController::class, 'getAvailableCars'])->name('get.available.cars');
Route::get('/ride-details', 'App\Http\Controllers\RidesController@showRideDetails')->name('show.ride.details');


Route::get('get/available/drivers', 'RidesController@getAvailableDrivers')->name('get.available.drivers');

Route::put('/rides/{rideBooking}', 'RidesController@update')->name('rides.update');



