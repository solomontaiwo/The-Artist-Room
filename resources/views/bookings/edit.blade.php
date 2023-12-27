@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Modifica la prenotazione di "{{ $booking->room->name }}" del {{ $booking->reservation_date }} alle ore {{ \Carbon\Carbon::parse($booking->reservation_hour)->format('H:i') }}</h1>

    <form method="POST" action="{{ route('booking.update', $booking) }}">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="room_id" class="form-label">Stanza</label>
            <select name="room_id" id="room_id" class="form-control">
                @isset($rooms)
                @foreach ($rooms as $room)
                <option value="{{ $room->id }}" {{ $booking->room_id == $room->id ? 'selected' : '' }}>
                    {{ $room->name }}
                </option>
                @endforeach
                @endisset
            </select>
            <div id="" class="form-text">Cambia l'aula che vuoi prenotare</div>

            <br>
            <!-- Script per visualizzare in tempo reale i posti liberi nell'aula selezionata -->
            <div id="availableSeatsInfo">Posti disponibili nell'aula selezionata: 0</div>

        </div>

        <br>

        <div class="form-group">
            <label for="reservation_date" class="form-label">Data di prenotazione</label>
            <input type="date" class="form-control" name="reservation_date" value="{{ $booking->reservation_date }}">
            <div id="" class="form-text">Cambia la data di prenotazione</div>
        </div>

        <br>

        <div class="form-group">
            <label for="reservation_hour" class="form-label">Ora di prenotazione</label>
            <input type="time" class="form-control" name="reservation_hour" value="{{ $booking->reservation_hour }}">
            <div id="" class="form-text">Cambia l'ora di prenotazione</div>
        </div>

        <br>

        <div class="form-group">
            <label for="reservation_time" class="form-label">Tempo di permanenza (in minuti)</label>
            <input type="number" class="form-control" name="reservation_time" value="{{ $booking->reservation_time }}">
            <div id="" class="form-text">Cambia il tempo di permanenza</div>
        </div>

        <br>

        <!-- Input nascosto per il numero originario di persone originario -->
        <input type="hidden" name="original_people" value="{{ $booking->people }}">

        <div class="form-group">
            <label for="people" class="form-label">Numero di persone</label>
            <input type="number" class="form-control" name="people" value="{{ $booking->people }}">
            <div id="" class="form-text">Cambia il nuovo numero di persone</div>
        </div>

        <br>

        <!-- Manda lo user_id al BookingController, assicurandosi prima che l'utente sia effettivamente autenticato -->
        <input type="hidden" name="user_id" value="{{ optional(Auth::user())->id }}">

        <!-- Script per verificare se viene cambiata aula -->
        <script>
            $(document).ready(function() {
                $('#room_id').change(function() {
                    var roomName = $('#room_id option:selected').text();
                    $('#room_name').val(roomName);
                });
            });
        </script>

        <input type="hidden" name="room_name" id="room_name" value="{{ $room->name }}">

        <button type="submit" class="btn btn-primary">Salva modifiche</button>

    </form>

    <!-- Form per eliminare la prenotazione -->
    <form method="POST" action="{{ route('booking.destroy', $booking->id) }}" style="display: inline-block;">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare la prenotazione?')">Elimina prenotazione</button>
    </form>

</div>

@endsection

<!-- javascript per verificare la disponibilità della stanza -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Fetch the available seats for the selected room using an AJAX request on page load
        fetchRoomInfo();

        // Listen for changes in the selected room
        $('#room_id').change(function() {
            fetchRoomInfo();
        });

        function fetchRoomInfo() {
            var roomId = $('#room_id').val();

            console.log('Fetching room information for room ID:', roomId);

            // Fetch the available seats for the selected room using an AJAX request
            $.ajax({
                url: '/api/rooms/' + roomId, // Adjust the URL to your API endpoint
                method: 'GET',
                success: function(response) {
                    console.log('Received response:', response);

                    // Update the availableSeatsInfo element with the fetched data
                    $('#availableSeatsInfo').html('Posti disponibili nell\'aula selezionata: ' + response.available_seats);
                },
                error: function(error) {
                    console.error('Failed to fetch room information', error);
                    $('#availableSeatsInfo').html('');
                }
            })
        }
    });
</script>