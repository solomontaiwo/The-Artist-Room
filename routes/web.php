<?php

use App\Http\Controllers\UserController;
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

Route::resource('/booking', App\Http\Controllers\BookingController::class);
// Rotta per pagina di conferma della prenotazione
Route::get('/booking/{booking}/confirm-booking', [App\Http\Controllers\BookingController::class, 'confirmBooking'])->name('confirm-booking');

// Rotta per controllo utenti
Route::resource('/user', App\Http\Controllers\UserController::class);
Route::put('/users/{user}/promote', [App\Http\Controllers\UserController::class, 'promoteToAdmin'])->name('users.promoteToAdmin');


// Rotta per ottenere con script Javascript il numero di stanze disponibili
Route::get('/api/users/{id}', [App\Http\Controllers\UserController::class, 'getUserInfo']);

Route::resource('/room', App\Http\Controllers\RoomController::class);

// Rotta per ottenere con script Javascript il numero di stanze disponibili
Route::get('/api/rooms/{id}', [App\Http\Controllers\RoomController::class, 'getRoomInfo']);

// Rotta per la pagina "Chi siamo"
Route::get('/who-are-we', [App\Http\Controllers\WhoAreWeController::class, 'index'])->name('who-are-we.index');
