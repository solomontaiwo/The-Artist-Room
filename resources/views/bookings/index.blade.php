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

                    <!-- Informazioni sulla prenotazione -->
                    <p>Aula: {{ $booking->room->name }}</p>
                    <p>Giorno: {{ $booking->reservation_date }}</p>
                    <p>Ora: {{ \Carbon\Carbon::parse($booking->reservation_hour)->format('H:i') }}</p> <!-- Orario convertito in istanza Carbon per formattare in H:i -->
                    <p>Tempo: {{ $booking->reservation_time }} minuti</p>
                    <a href="{{ route('bookings.edit', $booking->id) }}">Modifica</a> <!-- Pulsante per modificare la prenotazione -->

                    <br> <br> <hr>
                </div>
            @endforeach
        </ul>
    @endif
</div>

@endsection