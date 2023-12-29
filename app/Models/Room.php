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
}