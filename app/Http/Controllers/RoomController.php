<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();

        return view('rooms.index', compact('rooms'));
    }

    /**
     * Show the form for creating a new room.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Trova tutte le stanze e le inserisce nella variabile $rooms
        $rooms = Room::all();

        return view('rooms.create', compact('rooms'));
    }

    /**
     * Store a newly created room in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'address' => 'required|string',
            'size' => 'required|integer',
            'available_seats' => 'required|integer',
        ]);

        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'address' => $request->input('address'),
            'size' => $request->input('size'),
            'available_seats' => $request->input('available_seats'),
        ];

        $newRoom = Room::create($data);

        return redirect()->route('room.index')->with('success', 'Stanza creata!');
    }

    /**
     * Display the specified room.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\View\View
     */


    // Funzione per visualizzare la pagina di edit
    public function edit(Room $room)
    {
        $rooms = Room::all();

        return view('rooms.edit', compact('room'));
    }

    // Funzione per la modifica della prenotazione con il form relativo
    public function update(Request $request, Room $room)
    {
        // Validazione dei dati
        $rules = [
            'name' => 'required|string',
            'description' => 'required|string',
            'address' => 'required|string',
            'size' => 'required|integer|min:1',
            'available_seats' => 'required|integer|min:0',
        ];

        $request->validate($rules);

        $room->update($request->all());

        return redirect()->route('room.show', $room->id)->with('success', 'Aula modificata correttamente!');
    }

    public function show(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    // Add methods for editing and updating a room...

    /**
     * Remove the specified room from the database.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('room.index')->with('success', 'Stanza eliminata!');
    }

    // Per funzione Javascript che verifica il numero di stanze disponibili
    public function getRoomInfo($id)
    {
        $room = Room::findOrFail($id);

        return response()->json([
            'available_seats' => $room->available_seats,
        ]);
    }
}
