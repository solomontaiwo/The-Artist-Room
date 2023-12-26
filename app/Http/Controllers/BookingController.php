<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class BookingController extends Controller
{
    // Per rendere i metodi di booking solo accessibili agli utenti registrati e autenticati
    public function __construct()
{
    $this->middleware('auth');
}

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
            'reservation_date' => 'required|date',
            'reservation_hour' => 'required|date_format:H:i',
            'reservation_time' => 'required',
            'people' => 'required|integer',
        ]);

        $validator = Validator::make($request->all(), [
            'reservation_date' => 'required|date',
            'reservation_hour' => 'required|date_format:H:i',
            'reservation_time' => 'required',
            'people' => 'required|integer',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

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
        // Individuo l'aula associata alla prenotazione e prendo il numero di persone che erano prenotate
        $room = $booking->room;
        $peopleCount = $booking->people;

        // Cancello la prenotazione
        $booking->delete();

        // Aumento il numero di posti disponibili, dato che ora la prenotazione è cancellata
        $room->available_seats += $peopleCount;
        $room->save();

        return redirect('/booking');
    }
}
