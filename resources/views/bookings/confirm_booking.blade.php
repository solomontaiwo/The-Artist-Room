@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Prenotazione eseguita</h1>
    <a href="{{ route('bookings.index', $booking->id) }}">Vai alle tue prenotazioni</a>
    <a href="{{ route('bookings.edit', $booking->id) }}">Torna alla homepage</a>

</div>

@endsection