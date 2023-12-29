@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Prenotazione dell'aula eseguita</h1>
    <br>
    <p><strong>Aula:</strong> {{ $booking->room->name }}</p>
    <p><strong>Giorno di arrivo:</strong> {{ $booking->arrival_date }}</p>
    <p><strong>Orario di partenza:</strong> {{ \Carbon\Carbon::parse($booking->arrival_time)->format('H:i') }}</p>
    <p><strong>Giorno di partenza:</strong> {{ $booking->departure_date }}</p>
    <p><strong>Orario di partenza:</strong> {{ $booking->departure_time }}</p>
    <p><strong>Numero di persone:</strong> {{ $booking->people }}</p>

    <br>

    <p><strong>Data e ora creazione prenotazione:</strong> {{ $booking->created_at }}</p>

    <hr>
    <p><a href="{{ route('booking.edit', $booking->id) }}">Modifica prenotazione</a></p>
    <p><a href="{{ route('booking.index') }}">Vai alle tue prenotazioni</a></p>
    <p><a href="{{ route('home') }}">Torna alla homepage</a></p>

</div>

@endsection