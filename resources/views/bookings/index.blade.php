@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Le tue prenotazioni</h1>
    <br>
    <h3>Prenotazioni totali: {{ $bookings->count() }} </h3>

    @if($bookings->isEmpty())
    <p>Non hai ancora effettuato prenotazioni.</p>
    @else
    <ul>
        @foreach($bookings as $booking)
        <div>

            <br>

            <!-- Informazioni sulla prenotazione -->
            <p><strong>Aula:</strong> {{ $booking->room->name }}</p>
            <p><strong>Giorno di arrivo:</strong> {{ \Carbon\Carbon::parse($booking->arrival_date)->format('d/m/Y') }}</p>
            <p><strong>Orario di arrivo:</strong> {{ \Carbon\Carbon::parse($booking->arrival_time)->format('H:i') }}</p>

            <a href="{{ route('booking.show', $booking->id) }}">Dettagli</a> <!-- Pulsante per modificare la prenotazione -->
            -
            <a href="{{ route('booking.edit', $booking->id) }}">Modifica prenotazione</a> <!-- Pulsante per modificare la prenotazione -->

            <br> <br>
            <hr>

        </div>
        @endforeach
    </ul>
    @endif
</div>

@endsection