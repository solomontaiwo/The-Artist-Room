@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Dettagli prenotazione</h1>
    <br>
    <p><strong>Aula:</strong> {{ $booking->room->name }}</p>
    <p><strong>Giorno:</strong> {{ $booking->reservation_date }}</p>
    <p><strong>Ora:</strong> {{ \Carbon\Carbon::parse($booking->reservation_hour)->format('H:i') }}</p>
    <p><strong>Tempo:</strong> {{ $booking->reservation_time }} minuti</p> 
    <p><strong>Giorno e ora di prenotazione:</strong> {{ $booking->created_at }}</p>
    <p><strong>Numero di persone:</strong> {{ $booking->people }}</p>

    <hr>
    <p><a href="{{ route('booking.edit', $booking->id) }}">Modifica prenotazione</a></p>
    <p><a href="{{ route('booking.index') }}">Vai alle tue prenotazioni</a></p>
    <p><a href="{{ route('home') }}">Torna alla homepage</a></p>

</div>
@endsection