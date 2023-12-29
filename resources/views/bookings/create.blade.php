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
            <label for="arrival_date" class="form-label">Data di arrivo</label>
            <input type="date" class="form-control" name="arrival_date" id="arrival_date">
        </div>

        <br>

        <div class="form-group">
            <label for="arrival_time" class="form-label">Orario di arrivo</label>
            <select name="arrival_time" id="arrival_time" class="form-control">
                <option value="" selected disabled>Seleziona l'orario di arrivo</option> <!-- 'selected disabled' per fare in modo che nessun orario sia preselezionato -->
                <option value="12:00">12:00</option>
                <option value="13:00">13:00</option>
                <option value="14:00">14:00</option>
                <option value="15:00">15:00</option>
                <option value="16:00">16:00</option>
                <option value="17:00">17:00</option>
                <option value="18:00">18:00</option>
                <option value="19:00">19:00</option>
                <option value="20:00">20:00</option>
                <option value="21:00">21:00</option>
                <option value="22:00">22:00</option>
                <option value="23:00">23:00</option>
            </select>
        </div>

        <br>

        <div class="form-group">
            <label for="departure_date" class="form-label">Data di partenza</label>
            <select name="departure_date" id="formatted_departure_date" class="form-control">
                <option value="" selected disabled>Seleziona la data di termine di utilizzo dell'aula (massimo due giorni dopo la data di arrivo)</option>
                <!-- Le opzioni si aggiornano con Javascript dinamicamente in base alla data di arrivo -->
            </select>
            <input type="hidden" name="departure_date" id="departure_date">
        </div>

        <br>

        <div class="form-group">
            <label for="departure_time" class="form-label">Orario di partenza</label>
            <select name="departure_time" id="departure_time" class="form-control">
                <option value="" selected disabled>Seleziona un orario di partenza</option> <!-- Per fare in modo che nessun orario sia preselezionato -->
                <option value="09:00">09:00</option>
                <option value="10:00">10:00</option>
                <option value="11:00">11:00</option>
                <option value="12:00">12:00</option>
            </select>
        </div>

        <br>

        <div class="form-group">
            <label for="people" class="form-label">Quante persone sarete?</label>
            <input type="number" class="form-control" name="people" id="people">
        </div>

        <!-- Manda lo user_id e il nome dell'aula al BookingController, assicurandosi prima che l'utente sia effettivamente autenticato -->
        <input type="hidden" name="user_id" value="{{ optional(Auth::user())->id }}">

        <br>

        <button type="submit" id="bookingButton" class="btn btn-success">Prenota</button>

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
                    console.error('Fallimento nell\'ottenimento delle informazioni sulla stanza.');
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
            var arrivalDate = $('#arrival_date').val();
            var arrivalTime = $('#arrival_time').val();
            var departureDate = $('#formatted_departure_date').val();
            var departureTime = $('#departure_time').val();

            /* Richiesta AJAX per verificare se i posti richiesti sono maggiori di quelli disponibili.
            In caso positivo disabilitare il pulsante di prenotazione. */
            if (roomId && peopleCount && arrivalDate && arrivalTime && departureDate && departureTime) {
                $.ajax({
                    url: '/api/rooms/' + roomId,
                    method: 'GET',
                    success: function(response) {
                        var availableSeats = response.available_seats;
                        $('#bookingButton').prop('disabled', peopleCount > availableSeats);
                    },
                    error: function() {
                        console.error('Errore nell\'ottenimento dei dati sui posti disponibili');
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
        $('#room_id, #arrival_date, #arrival_time, #formatted_departure_date, #departure_time').change(updateBookingButton);

        // Aggiornamento iniziale al caricamento della pagina
        updateBookingButton();
    });
</script>

<!-- Script per fare in modo che la data di partenza si popoli in automatico con i due giorni successivi rispetto alla data di arrivo -->
<script>
    $(document).ready(function() {
        // Funzione per aggiornare la data di partenza in base alla data selezionata
        function updateDepartureDateOptions() {
            var arrivalDate = $('#arrival_date').val();

            if (arrivalDate) {
                // Clear existing options
                $('#formatted_departure_date').empty();

                // Aggiungi opzioni in base alla data di arrivo selezionata
                for (var i = 1; i <= 2; i++) { // You can adjust the range based on your requirements
                    var newDate = new Date(arrivalDate);
                    newDate.setDate(newDate.getDate() + i);

                    var formattedDate = newDate.toLocaleDateString('it-IT');

                    $('#formatted_departure_date').append('<option value="' + formattedDate + '">' + formattedDate + '</option>');

                    var parts = formattedDate.split('/');
                    var day = parts[0];
                    var month = parts[1];
                    var year = parts[2];

                    var formattedDateWithLines = new Date(`${year}-${month}-${day}`).toISOString().slice(0, 10);

                    $('#departure_date').val(formattedDateWithLines);
                }
            }
        }

        // Controlla se ci sono modifiche al form arrival date
        $('#arrival_date').change(function() {
            updateDepartureDateOptions();
        });

        // Aggiornamento iniziale al caricamento della pagina
        updateDepartureDateOptions();
    });
</script>