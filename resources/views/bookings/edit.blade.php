@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Modifica la tua prenotazione</h1>

    <form method="POST" action="{{ route('bookings.update', $booking->id) }}">
        @csrf
        @method('PUT')

        <label for="name">Nome:</label>
        <input type="text" name="name" value="{{ $booking->name }}" required>

        <!-- Include form fields for editing booking details -->

        <button type="submit">Aggiorna prenotazione</button>
    </form>

</div>