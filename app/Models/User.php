<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'is_admin'
    ];

    /*
     *Il comando hidden in Laravel è utilizzato per definire gli attributi di un modello che dovrebbero essere nascosti quando il m
     odello viene convertito in un array o in formato JSON. 
     Questa funzionalità è particolarmente utile per proteggere informazioni sensibili o attributi
     che non devono essere visualizzati pubblicamente.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    /*
'email_verified_at' => 'datetime': Questa riga indica che l'attributo email_verified_at
dovrebbe essere convertito automaticamente in un oggetto di tipo DateTime quando viene letto dal database. 
Questo è utile quando si vuole trattare l'attributo come un oggetto data e utilizzare le funzionalità date di Laravel.

'password' => 'hashed': Questa riga indica che l'attributo password dovrebbe essere automaticamente cifrato (hashed)
quando viene scritto nel database. Questo è spesso utilizzato per garantire che le password degli utenti siano memorizzate in modo sicuro nel database.

L'utilizzo di $casts semplifica la gestione dei dati del modello, consentendo di trattare certi attributi come tipi specifici di dati 
senza doverli convertire manualmente ogni volta. 
    */

    // Funzione per determinare se un utente è un admin o meno
    public function isAdmin()
    {
        return $this->is_admin;
    }

    // Relazione tra l'utente e le prenotazioni
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
