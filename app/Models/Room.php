<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_id',
        'name', 
        'description', 
        'address',
        'size',
        'available_seats'
    ];

    // Relazione tra la stanza e le prenotazioni
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    /*
    return $this->hasMany(Booking::class);: Questa riga di codice utilizza il metodo hasMany per definire una relazione uno-a-molti. 
    In questo caso, indica che l'istanza corrente del modello ha molteplici record associati nel modello Booking. Il parametro Booking::class 
    specifica il modello a cui è associata la relazione.
    */
}
