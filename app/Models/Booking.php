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
    //Questo codice viene tipicamente trovato all'interno di una classe di modello Eloquent di Laravel e stabilisce una relazione
    //tra le istanze del modello corrente e le istanze del modello Room. Questa relazione si basa spesso sulla presenza di una chiave 
    //esterna nella tabella del database del modello corrente che fa riferimento alla chiave primaria della tabella del modello Room.
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
