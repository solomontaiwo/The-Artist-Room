@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Inserisci una nuova prenotazione</h1>

    <br>

    <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="room_id" class="form-label">Stanza</label>
            <select name="room_id" id="room_id" class="form-control">
                <option value="" selected disabled>Seleziona un'aula</option> <!-- Per fare in modo che nessuna stanza sia preselezionata -->
                @isset($rooms)
                @foreach ($rooms as $room)
                <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
                @endisset
            </select>
            <div id="" class="form-text">Seleziona l'aula che vuoi prenotare</div>

            <!-- Script per visualizzare in tempo reale i posti liberi nell'aula selezionata -->
            <br>
            <div id="availableSeatsInfo">Seleziona un'aula per verificare quanti posti sono disponibili </div>

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

<!-- javascript per verificare la disponibilità della stanza -->

<!-- Per far funzionare il javascript che dice quanti posti disponibili ci sono alla selezione dell'aula -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        // Listen for changes in the selected room
        $('#room_id').change(function() {
            var roomId = $(this).val();

            // Fetch the available seats for the selected room using an AJAX request
            $.ajax({
                url: '/api/rooms/' + roomId, // Adjust the URL to your API endpoint
                method: 'GET',
                success: function(response) {
                    // Update the availableSeatsInfo element with the fetched data
                    $('#availableSeatsInfo').html('Posti disponibili nell\'aula selezionata: ' + response.available_seats);
                },
                error: function() {
                    console.error('Failed to fetch room information');
                    $('#availableSeatsInfo').html('');
                }
            });
        });
    });
</script>