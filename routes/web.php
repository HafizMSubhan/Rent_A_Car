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

Route::resource('cars', 'App\Http\Controllers\CarController');

Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
Route::post('/settings/update', [SettingsController::class, 'update'])->name('settings.update');

});

Route::resource('rides', 'App\Http\Controllers\RidesController');

Route::post('/get-car-details', 'App\Http\Controllers\CarController@getCarDetails')->name('get.car.details');

Route::post('/get-available-cars', 'App\Http\Controllers\CarController@getAvailableCars')->name('get.available.cars');

Route::get('/selected_car', function () {
    return view('selected_car', [
        'car' => (object)request()->all(),
    ]);
})->name('selected_car');








