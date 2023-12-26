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
                return redirect()->back()
                    ->with('error', 'Spazio non disponibile.')
                    ->withInput(); // Torna alla pagina di prenotazione con gli stessi valori di prima
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

            // Redirezione alla pagina della conferma della prenotazione
            return redirect()->route('booking.show', $booking->id)->with('success', 'Prenotazione eseguita con successo.');
        } catch (\Exception $e) {
            // Rollback in caso di exception
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'C\'è stato un errore durante la prenotazione.');
        }
    }

    // Funzione per visualizzare la pagina di edit
    public function edit(Booking $booking)
    {
        $rooms = Room::all();

        return view('bookings.edit', compact('booking', 'rooms'));
    }

    // Funzione per la modifica della prenotazione con il form relativo
    public function update(Request $request, Booking $booking)
    {
        // Validazione dei dati
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'reservation_date' => 'required|date',
            'reservation_hour' => 'required|date_format:H:i',
            'reservation_time' => 'required',
            'people' => 'required|integer',
            'user_id' => 'required|exists:users,id',
        ]);

        $booking->update($request->all()); 
       
        return redirect()->route('bookings.show', $booking->id)->with('success', 'Prenotazione modificata correttamente!');
    }

    public function show(Booking $booking)
    {
        return view('bookings.show', compact('booking'));
    }

    // Funzione per visualizzare la pagina di conferma della prenotazione in resources/views/confirm-booking
    public function confirmBooking()
    {
        $booking = Booking::latest()->first();

        return view('bookings.confirm-booking', compact('booking'));
    }

    // Funzione per eliminare la prenotazione
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect('/booking');
    }
}
