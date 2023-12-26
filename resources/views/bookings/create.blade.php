@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Inserisci una nuova prenotazione</h1>

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="room_id" class="form-label">Stanza</label>
            <select name="room_id" id="room_id" class="form-control">
                @isset($rooms)
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}">{{ $room->name }}</option>
                    @endforeach
                @endisset
            </select>
            <div id="" class="form-text">Seleziona l'aula che vuoi prenotare</div>
        </div>

        <br>

        <div class="form-group">
            <label for="reservation_date" class="form-label">Data di prenotazione</label>
            <input type="date" class="form-control" name="reservation_date">
            <div id="" class="form-text">Inserisci la data in cui vuoi prenotare la stanza</div>
        </div>

        <br>

        <div class="form-group">
            <label for="reservation_hour" class="form-label">Orario di prenotazione</label>
            <input type="time" class="form-control" name="reservation_hour">
            <div id="" class="form-text">Inserisci l'ora dalla quale vorresti prenotare l'aula</div>
        </div> 

        <br>

        <div class="form-group">
            <label for="reservation_time" class="form-label">Tempo di permanenza (in minuti)</label>
            <input type="number" class="form-control" name="reservation_time">
            <div id="" class="form-text">Inserisci il tempo per cui vorresti prenotare la stanza</div>
        </div> 

        <br>
        
        <div class="form-group">
            <label for="people" class="form-label">Quante persone sarete?</label>
            <input type="number" class="form-control" name="people">
            <div id="" class="form-text">Inserisci il numero di persone che occuperà il locale</div>
        </div>

        <!-- Manda lo user_id al BookingController, assicurandosi prima che l'utente sia effettivamente autenticato -->
        <input type="hidden" name="user_id" value="{{ optional(Auth::user())->id }}">

        <script>
        // Add JavaScript to update the hidden room_name field when a room is selected
            document.getElementById('room_id').addEventListener('change', function() {
            var roomName = document.getElementById('room_id').options[document.getElementById('room_id').selectedIndex].text;
            document.getElementById('room_name').value = roomName;
            });
        </script>

        <input type="hidden" name="room_name" id="room_name" value="">
        
        <br>
                
        <button type="submit" class="btn btn-primary">Prenota</button>
     </form>
</div>

@endsection