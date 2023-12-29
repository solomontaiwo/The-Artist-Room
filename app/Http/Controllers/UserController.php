<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        // $users = User::all(); // Trova tutti gli utenti e li inserisce nella variabile $users

        return view('users.show', compact('user'));
    }

    public function getPrenotazioni(User $user){

        $bookings = $user->bookings();

        return view('users.show', compact('bookings'));
    }

    public function destroy(User $user)
    {
        $user->delete(); // cancella il record dal database

        return response()->json([
            'message' => 'ok!',
            'data' => $user,
        ], 200);
    }
}
