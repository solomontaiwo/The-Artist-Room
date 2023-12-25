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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Load the user's bookings
        $bookings = $user->bookings;

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $rooms = Room::all();

        return view('bookings.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'room' => 'required|exists:rooms,id',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'people' => 'required|integer',
            'user_id' => 'required|exists:users,id',
        ]);

        // Retrive the selected room
        $room = Room::find($request->input('room'));

        if (!$room) {
            return redirect()->back()->with('error', 'La stanza non è stata trovata.');
        }

        // Check if there are enough available seats
        if ($room->available_seats < $request->input('people')) {
            return redirect()->back()->with('error', 'Spazio non disponibile.');
        }
        try {
            DB::beginTransaction();

            // Create a new booking
            $booking = auth()->user()->bookings()->create([
                'room_id' => $room->id,
                // 'room_id' => $request->input('room'),
                'reservation_date' => $request->input('reservation_date'),
                'reservation_time' => $request->input('reservation_time'),
                'people' => $request->input('people'),
                // 'user_id' => $request->input('user_id'),
            ]);
            
            // Update the number of available seats in the room
            $room->available_seats -= $request->input('people');
            $room->save();

            DB::commit();

            return redirect()->route('bookings.index')->with('success', 'Prenotazione eseguita con successo.');
        } catch(\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'C\'è stato un errore durante la prenotazione.');
        }

        /*
        
        $input = $request->all();

        Log::info($input);

        Booking::create($input);

        return redirect('/booking');

        */
    }


    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
