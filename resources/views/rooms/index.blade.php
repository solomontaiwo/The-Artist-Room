@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Tutte le aule</h1>

    <br>

    <h3> Aule totali: {{ $rooms->count() }} </h3>

    @if($rooms->isEmpty())
    <p>Nessuna aula disponibile.</p>
    @else
    <ul>
        @foreach($rooms as $room)
        <div>
            <br>

            <!-- Informazioni sull'aula -->
            <p>Nome aula: {{ $room->name }}</p>
            <p>Descrizione: {{ $room->description }}</p>
            <p>Indirizzo: {{ $room->address }}</p>
            <p>Dimensioni: {{ $room->size }} mq</p>
            <p>Posti attualmente disponibili: {{ $room->available_seats }}</p>

            <br>
            <hr>
        </div>
        @endforeach
    </ul>
    @endif
</div>

@endsection