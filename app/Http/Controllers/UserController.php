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
        return view('users.show', compact('user'));
    }

    // Funzione per il pulsante di promozione utente normale ad admin
    public function promoteToAdmin(User $user)
    {
        $user->update(['is_admin' => true]);

        return response()->json([
            'success' => true,
            'data' => $user,
        ], 200);
    }

    public function destroy(User $user)
    {
        // Cancella il record dal database
        $user->delete();

        return response()->json([
            'success' => true,
            'data' => $user,
        ], 200);
    }
}
