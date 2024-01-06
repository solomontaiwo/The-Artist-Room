@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Dettagli prenotazione</h1>

    <hr>

    <p><strong>Aula:</strong> {{ $booking->room->name }}</p>
    <p><strong>Giorno di arrivo:</strong> {{ \Carbon\Carbon::parse($booking->arrival_date)->format('d/m/Y') }}</p>
    <p><strong>Orario di arrivo:</strong> {{ \Carbon\Carbon::parse($booking->arrival_time)->format('H:i') }}</p>
    <p><strong>Giorno di partenza:</strong> {{ \Carbon\Carbon::parse($booking->departure_date)->format('d/m/Y') }}</p>
    <p><strong>Orario di partenza:</strong> {{ \Carbon\Carbon::parse($booking->departure_time)->format('H:i') }}</p>
    <p><strong>Numero di persone:</strong> {{ $booking->people }}</p>

    @admin
    <p><strong>Data e ora creazione prenotazione:</strong> {{ $booking->created_at }}</p>
    @endadmin

    <hr>
    <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning btn-sm me-2">Modifica prenotazione</a>
    <a href="{{ route('bookings.index') }}" class="btn btn-primary btn-sm me-2">Vai alle tue prenotazioni</a>
    <a href="{{ route('home') }}" class="btn btn-primary btn-sm">Torna alla homepage</a>

</div>

@endsection