@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Prenotazione dell'aula eseguita</h1>
    <br>
    <p>Stanza prenotata: {{ $booking->room->name }}</p>
    <p>Data: {{ $booking->reservation_date }}</p>
    <p>Ora: {{ $booking->reservation_hour }}</p>
    <p>Tempo di permanenza: {{ $booking->reservation_time }} minuti</p>
    <p>Numero di persone: {{ $booking->people }}</p>

    <hr>
    <p><a href="{{ route('booking.edit', $booking->id) }}">Modifica prenotazione</a></p>
    <p><a href="{{ route('booking.index') }}">Vai alle tue prenotazioni</a></p>
    <p><a href="{{ route('home') }}">Torna alla homepage</a></p>

</div>

@endsection

