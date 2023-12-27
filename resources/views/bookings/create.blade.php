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
            <div id="" class="form-text">
                <!-- Script per visualizzare in tempo reale i posti liberi nell'aula selezionata, inserito come 'sottotitolo' del form -->
                <div id="availableSeatsInfo">Seleziona un'aula che vuoi prenotare per verificare quanti posti sono disponibili</div>
            </div>
        </div>

        <br>

        <div class="form-group">
            <label for="reservation_date" class="form-label">Data di prenotazione</label>
            <input type="date" class="form-control" name="reservation_date" id="reservation_date">
            <div id="" class="form-text">Inserisci la data in cui vuoi prenotare la stanza</div>
        </div>

        <br>

        <div class="form-group">
            <label for="reservation_hour" class="form-label">Orario di prenotazione</label>
            <input type="time" class="form-control" name="reservation_hour" id="reservation_hour">
            <div id="" class="form-text">Inserisci l'ora dalla quale vorresti prenotare l'aula</div>
        </div>

        <br>

        <div class="form-group">
            <label for="reservation_time" class="form-label">Tempo di permanenza (in minuti)</label>
            <input type="number" class="form-control" name="reservation_time" id="reservation_time">
            <div id="" class="form-text">Inserisci il tempo per cui vorresti prenotare la stanza</div>
        </div>

        <br>

        <div class="form-group">
            <label for="people" class="form-label">Quante persone sarete?</label>
            <input type="number" class="form-control" name="people" id="people">
            <div id="" class="form-text">Inserisci il numero di persone che occuperà il locale</div>
        </div>

        <!-- Manda lo user_id al BookingController, assicurandosi prima che l'utente sia effettivamente autenticato -->
        <input type="hidden" name="user_id" value="{{ optional(Auth::user())->id }}">

        <input type="hidden" name="room_name" id="room_name" value="">

        <br>

        <button type="submit" id="bookingButton" class="btn btn-primary">Prenota</button>

    </form>
</div>

@endsection

<!-- Javascript -->
<!-- Per far funzionare le JQuery  -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Script per determinare quanti posti sono disponibili nell'aula selezionata -->
<script>
    $(document).ready(function() {
        // Controlla se viene selezionata un'aula diversa
        $('#room_id').change(function() {
            var roomId = $(this).val();

            // Controlla la disponibilità dei posti per l'aula selezionata usando una richiesta AJAX
            $.ajax({
                url: '/api/rooms/' + roomId,
                method: 'GET',
                success: function(response) {
                    // Aggiorna availableSeatsInfo con i dati trovati
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

<!-- Script per rendere il pulsante di prenotazione non cliccabile se il numero di 
persone che vogliono occupare l'aula è superiore al numero di posti disponibili 
e se tutti gli altri campi non sono compilati -->
<script>
    $(document).ready(function() {
        function updateBookingButton() {
            var roomId = $('#room_id').val();
            var peopleCount = $('#people').val();
            var reservationDate = $('#reservation_date').val();
            var reservationHour = $('#reservation_hour').val();
            var reservationTime = $('#reservation_time').val();

            /* Richiesta AJAX per verificare se i posti richiesti sono maggiori di quelli disponibili.
            In caso positivo disabilitare il pulsante di prenotazione. */
            if (roomId && peopleCount && reservationDate && reservationHour && reservationTime) {
                $.ajax({
                    url: '/api/rooms/' + roomId,
                    method: 'GET',
                    success: function(response) {
                        var availableSeats = response.available_seats;
                        $('#bookingButton').prop('disabled', peopleCount > availableSeats);
                    },
                    error: function() {
                        console.error('Errore nell\ottenimento dei dati sui posti disponibili');
                        $('#bookingButton').prop('disabled', true);
                    }
                });
            } else {
                $('#bookingButton').prop('disabled', true);
            }
        }

        // Controlla se viene inserito il numero di persone che prenota l'aula
        $('#people').on('input', updateBookingButton);

        // Controlla se viene inserito un input in tutti gli altri form
        $('#room_id, #reservation_date, #reservation_hour, #reservation_time').change(updateBookingButton);

        // Initial update on page load
        updateBookingButton();
    });
</script>