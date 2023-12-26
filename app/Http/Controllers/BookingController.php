<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function index()
    {
        // Ottengo l'utente autenticato
        $user = Auth::user();

        // Carico le prenotazioni dell'utente
        $bookings = $user->bookings;

        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
       $rooms = Room::all();

        return view('bookings.create', compact('rooms'));
    }

    // Funzione per creare nuova prenotazione
    public function store(Request $request)
    {
        /* 
        Debugging per verificare che venga mandato tutto
        dd($request->all()); 
        */

        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'reservation_date' => 'required|date',
            'reservation_hour' => 'required|date_format:H:i',
            'reservation_time' => 'required',
            'people' => 'required|integer',
            'user_id' => 'required|exists:users,id',
        ]); 
                
        try {
            DB::beginTransaction();

            // Cerca l'aula selezionata
            $room = Room::findOrFail($request->input('room_id'));
        
            // Verifica che ci siano abbastanza posti disponibili
            if ($room->available_seats < $request->input('people')) {
            return redirect()->back()->with('error', 'Spazio non disponibile.');
            }

            // Crea una nuova prenotazione
            $bookingData = $request->only(['reservation_date', 'reservation_hour', 'reservation_time', 'people']);
            $bookingData['room_id'] = $room->id;
            $bookingData['user_id'] = auth()->user()->id; // Per assicurarsi che lo user id sia impostato correttamente
            $bookingData['room_name'] = $room->name;

            $booking = Booking::create($bookingData);

            // Aggiorna il numero di posti disponibili nella stanza
            $room->available_seats -= $request->input('people');
            $room->save();

            DB::commit();

            // Redirezione alla pagina delle prenotazioni
            return redirect()->route('bookings.index')->with('success', 'Prenotazione eseguita con successo.');
        } catch(\Exception $e) {
            // Rollback in caso di exception
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'C\'è stato un errore durante la prenotazione.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    // Funzione per visualizzare la pagina di edit
    public function edit(Booking $booking)
    {
        return view('bookings.edit', compact('booking'));

    }

    // Funzione per la modifica della prenotazione con il form relativo
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'people' => 'required|integer',
        ]);

        $booking->update([
            'name' => $request->input('name'),
            'surname' => $request->input('surname'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'people' => $request->input('people'),
        ]);

        return redirect()->route('bookings.index')->with('success', 'Prenotazione modificata correttamente!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
