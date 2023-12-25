<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout'); // aggiunto per comodità


// Route::resource('booking', App\Http\Controllers\BookingController::class); // Creare tutte le rotte per il CRUD di una risorsa
Route::get('/booking/{booking}/destroy', [App\Http\Controllers\BookingController::class, 'destroy']); // Creare tutte le rotte per il CRUD di una risorsa


// Make sure that the user is authenticated when accessing the bookings page
Route::middleware(['auth'])->group(function () {
    Route::resource('bookings', App\Http\Controllers\BookingController::class);
    Route::resource('rooms', App\Http\Controllers\RoomController::class);

});

// Define the "Chi Siamo" page route
Route::resource('who-are-we', App\Http\Controllers\WhoAreWeController::class);


/*

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

*/
