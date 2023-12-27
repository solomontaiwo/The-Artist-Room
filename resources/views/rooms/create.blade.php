@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Crea un'aula</h1>

    <br>

    <form action="{{ route('room.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label">Nome aula</label>
            <input type="string" class="form-control" name="name">
            <div id="" class="form-text">Inserisci il nome dell'aula</div>
        </div>

        <br>

        <div class="form-group">
            <label for="description" class="form-label">Descrizione</label>
            <input type="string" class="form-control" name="description">
            <div id="" class="form-text">Inserisci una descrizione per l'aula</div>
        </div>

        <br>

        <div class="form-group">
            <label for="address" class="form-label">Indirizzo</label>
            <input type="string" class="form-control" name="address">
            <div id="" class="form-text">Inserisci l'indirizzo dell'aula</div>
        </div>

        <br>

        <div class="form-group">
            <label for="size" class="form-label">Dimensioni</label>
            <input type="string" class="form-control" name="size">
            <div id="" class="form-text">Inserisci le dimensioni dell'aula in metri quadri</div>
        </div>

        <br>

        <div class="form-group">
            <label for="available_seats" class="form-label">Posti disponibili</label>
            <input type="number" class="form-control" name="available_seats">
            <div id="" class="form-text">Inserisci il numero di posti disponibili</div>
        </div>

        <br>

        <button type="submit" class="btn btn-primary">Crea aula</button>
    </form>
</div>
@endsection