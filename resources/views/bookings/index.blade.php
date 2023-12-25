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
                    <p>Room: {{ $booking->room->name }}</p>
                    <p>Date: {{ $booking->reservation_date }}</p>
                    <p>Time: {{ $booking->reservation_time }}</p>
                </div>
            @endforeach
        </ul>
    @endif
</div>

@endsection