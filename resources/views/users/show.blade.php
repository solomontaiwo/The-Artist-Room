@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Prenotazioni di {{ $user->name }} {{ $user->surname }}</h1>
    <br>
    <h3>Prenotazioni totali: {{ $user->bookings->count() }} </h3>

    @if($user->bookings->isEmpty())
    <p>L'utente non ha ancora effettuato prenotazioni.</p>
    @else
    <ul>
        @foreach($user->bookings as $booking)
        <div>

            <br>

            <p><strong>Nome stanza:</strong> {{ $booking->room->name }}</p>
            <p><strong>Data di arrivo:</strong> {{ \Carbon\Carbon::parse($booking->arrival_date)->format('d/m/Y') }}</p>
            <p><strong>Orario di arrivo:</strong> {{ \Carbon\Carbon::parse($booking->arrival_time)->format('H:i') }}</p>
            <p><strong>Data di partenza:</strong> {{ \Carbon\Carbon::parse($booking->departure_date)->format('d/m/Y') }}</p>
            <p><strong>Orario di partenza:</strong> {{ \Carbon\Carbon::parse($booking->departure_time)->format('H:i') }}</p>
            <p><strong>Persone:</strong> {{ $booking->people }}</p>

            <!-- Pulsante per modificare la prenotazione -->
            <a href="{{ route('bookings.edit', $booking->id) }}" class="btn btn-warning">Modifica prenotazione</a>

            <br> <br>
            <hr>
        </div>
        @endforeach
    </ul>
    @endif

</div>

@endsection