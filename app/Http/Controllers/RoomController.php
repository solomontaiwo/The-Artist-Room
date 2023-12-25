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
        $rooms = Room::all(); // Fetch all rooms

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
            'available_seats' => $request->input('seats'),
        ];

        $newRoom = Room::create($data);

        return redirect()->route('rooms.index')->with('success', 'Stanza creata!');
    }

    /**
     * Display the specified room.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\View\View
     */

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

        return redirect()->route('rooms.index')->with('success', 'Stanza eliminata!');
    }
}
