<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
/*PARTE 2 DOCUMENTAZIONE PUNTO 2 */
return new class extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('room_id')->constrained()->onDelete('cascade'); 
            $table->string('room_name');
            $table->date('arrival_date');
            $table->time('arrival_time');
            $table->date('departure_date');
            $table->time('departure_time');
            $table->integer('people');            
            $table->timestamps();   
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
