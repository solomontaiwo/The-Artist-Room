@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Le tue prenotazioni</h1>

    @if($bookings->isEmpty())
        <p>Non hai ancora effettuato prenotazioni.</p>
    @else
        <ul>
            @foreach($bookings as $booking)
                <li>{{ $booking->name }} - {{ $booking->date }} - {{ $booking->other_booking_details }}</li>
            @endforeach
        </ul>
    @endif
</div>

@endsection