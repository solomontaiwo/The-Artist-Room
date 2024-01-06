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
//Auth::routes()è solo una classe helper che ti aiuta a generare tutti i percorsi richiesti per l'autenticazione dell'utente. 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

//rotta controllo prenotazioni
Route::resource('/booking', App\Http\Controllers\BookingController::class);
// Rotta per pagina di conferma della prenotazione
Route::get('/booking/{booking}/confirm-booking', [App\Http\Controllers\BookingController::class, 'confirmBooking'])->name('confirm-booking');

// Rotta per controllo utenti - Middleware per assicurarsi che solo un admin possa accedere alle pagine
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/user', App\Http\Controllers\UserController::class);
    // Rotta per promuovere gli utenti normali ad admin
    Route::put('/users/{user}/promote', [App\Http\Controllers\UserController::class, 'promoteToAdmin'])->name('users.promoteToAdmin');
});

// Rotta per ottenere con script Javascript il numero di stanze disponibili
Route::get('/api/users/{id}', [App\Http\Controllers\UserController::class, 'getUserInfo']);

// Rotta per pagine accessibili solo da admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/room/create', [App\Http\Controllers\RoomController::class, 'create'])->name('room.create');
    Route::post('/room', [App\Http\Controllers\RoomController::class, 'store'])->name('room.store');
});
// Rotta per tutte le altre pagine di room
Route::resource('/room', App\Http\Controllers\RoomController::class)->except(['create', 'store']);

// Rotta per ottenere con script Javascript il numero di stanze disponibili
Route::get('/api/rooms/{id}', [App\Http\Controllers\RoomController::class, 'getRoomInfo']);

// Rotta per pagina mostre
Route::get('/exhibition', [App\Http\Controllers\ExhibitionController::class, 'index'])->name('exhibition');

// Rotta per la pagina "Chi siamo"
Route::get('/who-we-are', [App\Http\Controllers\WhoWeAreController::class, 'index'])->name('who-we-are');
