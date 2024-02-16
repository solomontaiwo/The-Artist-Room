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
    // Per rendere i metodi di booking solo accessibili agli utenti  autenticati
    public function __construct()
    {
        //Il middleware viene specificato nel costruttore del controller
        $this->middleware('auth');
    }

    public function index()
    {
        // Ottengo l'utente autenticato
        $user = Auth::user();

        // Carico le prenotazioni dell'utente
        $bookings = $user->bookings;

        return view('bookings.index', compact('bookings'));
        //Quando hai diverse variabili con dati salvati e vuoi analizzarli view, puoi utilizzare il metodo compact()
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
            'arrival_date' => 'required|date',
            'arrival_time' => 'required|date_format:H:i',
            'departure_date' => 'required|date',
            'departure_time' => 'required|date_format:H:i',
            'people' => 'required|integer',
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            //
            DB::beginTransaction();
            //Riga 56 ci permette: se viene lanciata un'eccezione di qualsiasi tipo all'interno della chiusura, viene eseguito il rollback della transazione. Ciò significa che se si verifica un errore SQL (uno che normalmente non fallirebbe in modo silenzioso),
            // viene eseguito il rollback della transazione. 

            // Cerca l'aula selezionata
            //Il metodo findOrFail nel contesto di Laravel è utilizzato per recuperare un record 
            //dal database in base a una chiave primaria specificata
            $room = Room::findOrFail($request->input('room_id'));

            // Verifica che ci siano abbastanza posti disponibili
            if ($room->available_seats < $request->input('people')) {
                return redirect()->back()
                    ->withInput(); // Torna alla pagina di prenotazione con gli stessi valori di prima, in modo tale che utente riesca a correggerli meglio
            }

            // Crea una nuova prenotazione, INSERENDO I DATI CHE l'utente passa nel database
            $bookingData = $request->only(['arrival_date', 'arrival_time', 'departure_time', 'departure_date', 'people']);
            $bookingData['room_id'] = $room->id;
            $bookingData['user_id'] = auth()->user()->id; // Per assicurarsi che lo user id sia impostato correttamente
            $bookingData['room_name'] = $room->name;

            $booking = Booking::create($bookingData);

            // Aggiorna il numero di posti disponibili nella stanza
            $room->available_seats -= $request->input('people');
            $room->save();

            DB::commit();
            /*
            In Laravel, il metodo DB::commit() fa parte della gestione delle transazioni database. 
            Quando si utilizzano transazioni, si possono eseguire più query sul database e, in caso di eventuali errori,
            è possibile annullare tutte le modifiche apportate fino a quel momento.

            Il metodo DB::commit() è utilizzato per confermare e applicare le modifiche apportate durante una transazione. 
            Se tutte le operazioni eseguite all'interno della transazione sono riuscite senza errori, si chiama DB::commit() 
            per applicare in modo definitivo le modifiche al database.
            */
            // Redirezione alla pagina della conferma della prenotazione
            return redirect()->route('bookings.show', $booking->id)->with('success', 'Prenotazione eseguita con successo.');
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

        Log::info($request);

        // Validazione dei dati
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'arrival_date' => 'required|date',
            'arrival_time' => 'required|date_format:H:i',
            'departure_date' => 'required|date',
            'departure_time' => 'required|date_format:H:i',
            'original_people' => 'required|integer|min:1',
            'people' => 'required|integer|min:1',
            'user_id' => 'required|exists:users,id',
        ]);

        Log::info($request);

        // Per verificare se l'aula è cambiata o meno
        $originalRoomId = $booking->room_id;

        Log::info($originalRoomId);

        $newRoomId = $request->input('room_id');

        Log::info($newRoomId);

        // Per verificare se è cambiato il numero di persone
        $originalPeople = $booking->people;
        $newPeople = $request->input('people');

        if ($originalRoomId != $newRoomId) {
            // Cerca la nuova stanza e diminuisce il numero di posti
            $newRoom = Room::find($newRoomId);
            $originalRoom = Room::find($originalRoomId);

            $newRoom->available_seats -= $request->input('people');
            $newRoom->save();

            Log::info($newRoom);

            $originalRoom->available_seats += $originalPeople;
            $originalRoom->save();
        }

        if ($originalRoomId == $newRoomId) {
            if ($originalPeople != $newPeople) {
                // Calcola la differenza del numero di persone prenotate
                $peopleDifference = $originalPeople - $newPeople;

                // Aggiorna il numero di posti disponibili nella stanza
                $room = $booking->room;
                $room->available_seats += $peopleDifference;
                $room->save();
            }
            //questa funzione da riga 147 a 156
            /*
            $peopleDifference = $originalPeople - $newPeople;: Calcola la differenza tra il numero di persone nella prenotazione
            originale e quello nella nuova prenotazione.
            Questo valore sarà utilizzato per aggiornare il numero di posti disponibili nella stanza.

            $room = $booking->room;: Recupera l'istanza del modello Eloquent associato alla stanza della prenotazione corrente.

            $room->available_seats += $peopleDifference;: Aggiorna il numero di posti disponibili nella stanza in base alla differenza calcolata. 
            Se $peopleDifference è positivo, significa che stanno prenotando più persone, quindi il numero di posti disponibili diminuirà. 
            Se è negativo, significa che stanno annullando la prenotazione di alcune persone, quindi il numero di posti disponibili aumenterà. */
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
        //Questo metodo ordina le righe della tabella "bookings" in ordine decrescente rispetto alla colonna created_at.
        //In altre parole, recupera le prenotazioni in base alla data di creazione, dalla più recente alla meno recente.

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

        return redirect('/bookings');
    }
}
