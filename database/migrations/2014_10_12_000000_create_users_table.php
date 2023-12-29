<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     PARTE 2 DOCUMENTAZIONE PUNTO 2
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->boolean('is_admin')->default(false);
        });
    }

    /**
    Piccolo appunto:
    cosa rappresenta "remember_token" di Laravel? (riga 21)
    In Laravel introduce miglioramenti alla sicurezza per i cookie "ricordami".
    Prima di questo aggiornamento, se un cookie di memorizzazione veniva violato da un altro utente malintenzionato, 
    il cookie rimaneva valido per un lungo periodo di tempo, anche dopo che il vero proprietario dell'account reimpostava la password, si disconnetteva, ecc.

    Questa modifica richiede l'aggiunta di una nuova remember_tokencolonna alla userstabella del database (o equivalente).
    Dopo questa modifica, all'utente verrà assegnato un nuovo token ogni volta che accede alla tua applicazione. 
    Il token verrà aggiornato anche quando l'utente si disconnette dall'applicazione. Le implicazioni di questa modifica sono le seguenti: 
    se un cookie "ricordami" viene violato, il semplice logout dall'applicazione invaliderà il cookie.

     */

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
