@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Crea una stanza</h1>

    <form action="{{ route('rooms.store') }}" method="POST">
        @csrf

        <label for="name">Nome:</label>
        <input type="text" name="name" id="name" required>

        <label for="description">Descrizione:</label>
        <textarea name="description" id="description" required></textarea>

        <label for="address">Indirizzo:</label>
        <input type="text" name="address" id="address" required>

        <label for="size">Dimensioni:</label>
        <input type="number" name="size" id="size" required>

        <label for="seats">Posti disponibili:</label>
        <input type="number" name="seats" id="seats" required>

        <button type="submit">Crea stanza</button>
    </form>
</div>
@endsection