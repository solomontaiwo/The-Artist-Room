@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Dettagli aula</h1>
    <br>
    <p><strong>Aula:</strong> {{ $room->name }}</p>
    <p><strong>Descrizione:</strong> {{ $room->description }}</p>
    <p><strong>Indirizzo:</strong> {{ $room->address }}</p>
    <p><strong>Dimensioni:</strong> {{ $room->size }} mq</p> 
    <p><strong>Posti attualmente disponibili:</strong> {{ $room->available_seats }}</p>

    <hr>
    
    @admin
    <p><a href="{{ route('room.edit', $room->id) }}">Modifica aula</a></p>
    @endadmin
    <p><a href="{{ route('room.index') }}">Vedi tutte le aule</a></p>
    <p><a href="{{ route('home') }}">Torna alla homepage</a></p>

</div>
@endsection