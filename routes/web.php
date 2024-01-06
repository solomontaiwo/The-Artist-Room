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
//Auth::routes() è solo una classe helper che ti aiuta a generare tutti i percorsi richiesti per l'autenticazione dell'utente. 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

//rotta controllo prenotazioni resouce:: inserisce tutte le rotte che servono per un CRUD COMPLETO
Route::resource('/bookings', App\Http\Controllers\BookingController::class);
// Rotta per pagina di conferma della prenotazione
Route::get('/bookings/{booking}/confirm-booking', [App\Http\Controllers\BookingController::class, 'confirmBooking'])->name('confirm-booking');

// Rotta per controllo utenti - Middleware per assicurarsi che solo un admin possa accedere alle pagine
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/users', App\Http\Controllers\UserController::class);
    // Rotta per promuovere gli utenti normali ad admin
    Route::put('/users/{user}/promote', [App\Http\Controllers\UserController::class, 'promoteToAdmin'])->name('users.promoteToAdmin');
});

// Rotta per ottenere con script Javascript il numero di stanze disponibili, RICHIAMA FUNZIONE GETUSERINFO DELLO UserController
Route::get('/api/users/{id}', [App\Http\Controllers\UserController::class, 'getUserInfo']);

// Rotta per pagine accessibili solo da admin
/*
Route::middleware(['auth', 'admin'])->group(function () { ... }): Questo codice crea un gruppo di rotte e applica il middleware ['auth', 'admin'] 
a tutte le rotte incluse in questo gruppo. Il middleware auth assicura che l'utente sia autenticato, 
mentre il middleware admin è probabilmente un middleware personalizzato che verifica se l'utente ha il ruolo di amministratore.
*/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/rooms/create', [App\Http\Controllers\RoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms', [App\Http\Controllers\RoomController::class, 'store'])->name('rooms.store');
});
// Rotta per tutte le altre pagine di room
Route::resource('/rooms', App\Http\Controllers\RoomController::class)->except(['create', 'store']);

// Rotta per ottenere con script Javascript il numero di stanze disponibili
Route::get('/api/rooms/{id}', [App\Http\Controllers\RoomController::class, 'getRoomInfo']);

// Rotta per pagina mostre
Route::get('/exhibitions', [App\Http\Controllers\ExhibitionController::class, 'index'])->name('exhibitions');

// Rotta per la pagina "Chi siamo"
Route::get('/who-we-are', [App\Http\Controllers\WhoWeAreController::class, 'index'])->name('who-we-are');
