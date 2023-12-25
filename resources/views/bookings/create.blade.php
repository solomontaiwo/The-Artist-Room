@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Inserisci una nuova prenotazione</h1>

    <form action="{{ route('bookings.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="room" class="form-label">Stanza</label>
            <select name="room" id="room" class="form-control">
                @isset($rooms)
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                @endisset
            </select>
            <div id="" class="form-text">Seleziona l'aula che vuoi prenotare</div>
<!--        <label for="room" class="form-label">Stanza</label>
            <input type="text" class="form-control" name="room">
            <div id="" class="form-text">Inserisci la stanza che vuoi prenotare</div>
-->
        </div>

        <br>

        <div class="form-group">
            <label for="reservation_date" class="form-label">Data di prenotazione</label>
            <input type="date" class="form-control" name="reservation date">
            <div id="" class="form-text">Inserisci la data in cui vuoi prenotare la stanza</div>
        </div>

        <br>

        <div class="form-group">
            <label for="reservation_time" class="form-label">Tempo di prenotazione (in minuti)</label>
            <input type="number" class="form-control" name="reservation time">
            <div id="" class="form-text">Inserisci il tempo per cui vorresti prenotare la stanza</div>
        </div> 

        <br>
        
        <div class="form-group">
            <label for="peole" class="form-label">Quante persone sarete?</label>
            <input type="number" class="form-control" name="people">
            <div id="" class="form-text">Inserisci il numero di persone che occuperà il locale</div>
        </div>

        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        
        <br>
        
        
        <button type="submit" class="btn btn-primary">Prenota</button>
     </form>
</div>

@endsection