@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Le tue prenotazioni</h1>

    @if($bookings->isEmpty())
        <p>Non hai ancora effettuato prenotazioni.</p>
    @else
        <ul>
            @foreach($bookings as $booking)
                <div>
                    <br>

                    <p>Aula: {{ $booking->room->name }}</p>
                    <p>Giorno: {{ $booking->reservation_date }}</p>
                    <p>Ora: {{ $booking->reservation_date }}</p>
                    <p>Tempo: {{ $booking->reservation_time }} minuti</p>
                    <!-- Pulsante per modificare la prenotazione -->
                    <a href="{{ route('bookings.edit', $booking->id) }}">Modifica</a>

                    <br> <br> <hr>
                </div>
            @endforeach
        </ul>
    @endif
</div>

@endsection