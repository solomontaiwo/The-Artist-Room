<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function viewAvailableRooms() 
    {
    // Logica per ottenere le stanze disponibili
    $availableRooms = Room::where('available', true)->get();

    return view('bookings.view_rooms', ['rooms' => $availableRooms]);
    }

    public function bookRoom(Request $request, $roomId) {

        // Logica per gestire la prenotazione
        $user_Id = auth()->id(); // Assume che l'artista sia autenticato
        $stanza = Room::findOrFail($roomId);

        // Assicurati che la stanza sia disponibile
        if ($stanza->available) {
            // Esegui la prenotazione
            Booking::create([
                'user_id' => $user_Id,
                'room_id' => $roomId,
                'data_prenotazione' => now(),
                // Aggiungi altri campi necessari per la tua applicazione
            ]);

            // Aggiorna lo stato della stanza
            $stanza->update(['disponibile' => false]);

            return redirect()->route('visualizza.stanze')->with('success', 'Stanza prenotata con successo!');
        } else {
            return redirect()->route('visualizza.stanze')->with('error', 'La stanza non è disponibile.');
        }
    }
}
