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

/*

Redirezione di default di Laravel

Route::get('/', function () {
    return view('welcome');
});

*/


// Redirezione alla pagina home
Route::get('/', function () {
    return redirect('/home');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::resource('/bookings', App\Http\Controllers\BookingController::class);
Route::resource('/rooms', App\Http\Controllers\RoomController::class);
Route::get('/api/rooms/{id}', [App\Http\Controllers\RoomController::class, 'getRoomInfo']);


// Rotta per la pagina "Chi siamo"
Route::get('/who-are-we', [App\Http\Controllers\WhoAreWeController::class, 'index'])->name('who-are-we.index');
