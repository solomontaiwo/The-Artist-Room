@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Modifica la prenotazione di "{{ $booking->room->name }}" del {{ $booking->reservation_date }} alle ore {{ \Carbon\Carbon::parse($booking->reservation_hour)->format('H:i') }}</h1>

    <form method="POST" action="{{ route('bookings.update', $booking->id) }}">
        @csrf
        @method('PUT')

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

            <!-- Script per visualizzare in tempo reale i posti liberi nell'aula selezionata -->
            <br>
            <div id="availableSeatsInfo"> Posti disponibili nell'aula selezionata: 0</div>
       
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
            <label for="reservation_time" class="form-label">Tempo di permanenza</label>
            <input type="number" class="form-control" name="reservation_time" value="{{ $booking->reservation_time }}">
            <div id="" class="form-text">Cambia il tempo di permanenza</div>
        </div>

        <br>

        <div class="form-group">
            <label for="people" class="form-label">Numero di persone</label>
            <input type="number" class="form-control" name="people" value="{{ $booking->people }}">
            <div id="" class="form-text">Cambia il nuovo numero di persone</div>
        </div>

        <br>

        <button type="submit" class="btn btn-primary">Salva modifiche</button>
    </form>

</div>

@endsection

<!-- javascript per verificare la disponibilità della stanza -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Fetch the available seats for the selected room using an AJAX request on page load
            fetchRoomInfo();

            // Listen for changes in the selected room
            $('#room_id').change(function () {
                fetchRoomInfo();
            });

            function fetchRoomInfo() {
                var roomId = $('#room_id').val();

                console.log('Fetching room information for room ID:', roomId);

                // Fetch the available seats for the selected room using an AJAX request
                $.ajax({
                    url: '/api/rooms/' + roomId, // Adjust the URL to your API endpoint
                    method: 'GET',
                    success: function (response) {
                        console.log('Received response:', response);

                        // Update the availableSeatsInfo element with the fetched data
                        $('#availableSeatsInfo').html('Posti disponibili nell\'aula selezionata: ' + response.available_seats);
                    },
                    error: function (error) {
                        console.error('Failed to fetch room information', error);
                        $('#availableSeatsInfo').html('');
                    }
                });
            }
        });
    </script>