@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Inserisci una nuova prenotazione</h1>

    <form action="{{ url('/booking') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="room" class="form-label">Stanza</label>
            <input type="text" class="form-control" name="room">
            <div id="" class="form-text">Inserisci la stanza che vuoi prenotare</div>
        </div>

        <br>

        <div class="form-group">
            <label for="reservation date" class="form-label">Data di prenotazione</label>
            <input type="date" class="form-control" name="reservation date">
            <div id="" class="form-text">Inserisci la data in cui vuoi prenotare la stanza</div>
        </div>

        <br>

        <div class="form-group">
            <label for="reservation time" class="form-label">Tempo di prenotazione</label>
            <input type="time" class="form-control" name="reservation time">
            <div id="" class="form-text">Inserisci il tempo per cui vorresti prenotare la stanza</div>
        </div>  

        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        
        <br>
        
        
        <button type="submit" class="btn btn-primary">Prenota</button>
     </form>
</div>

@endsection