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
            <p>Tipo: {{ $room->description }}</p>
            <p>Indirizzo: {{ $room->address }}</p>
            <p>Dimensioni: {{ $room->size }} mq</p>
            <p>Posti attualmente disponibili: {{ $room->available_seats }}</p>

            <!-- Pulsante per modificare l'aula, si vede solo se l'utente è un admin -->
            @admin
            <a href="{{ route('room.edit', $room->id) }}" class="btn btn-warning btn-sm">Modifica aula</a>
            @endadmin
            
            <br><hr>
            </form>
        </div>
        @endforeach
    </ul>
    @endif
</div>

@endsection