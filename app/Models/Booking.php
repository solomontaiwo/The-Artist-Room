<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'room_name',
        'user_id',
        'name',
        'surname',
        'arrival_date',
        'arrival_time',
        'departure_date',
        'departure_time',
        'people'
    ];

    // Relazione tra prenotazioni e utente
    public function user()
    {
        return $this->belongsTo(User::class)->onDelete('cascade');
    }

    // Relazione tra prenotazioni e stanza
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
