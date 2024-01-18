@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Modifica la prenotazione di "{{ $booking->room->name }}" del {{ \Carbon\Carbon::parse($booking->arrival_date)->format('d/m/Y') }} alle ore {{ \Carbon\Carbon::parse($booking->arrival_time)->format('H:i') }}</h1>

    <hr>

    <form method="POST" action="{{ route('bookings.update', $booking) }}">
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
            <div id="" class="form-text">
                <div id="availableSeatsInfo">Posti disponibili nell'aula selezionata: 0</div>
            </div>
        </div>

        <br>

        <div class="form-group">
            <label for="arrival_date" class="form-label">Data di arrivo</label>
            <input type="date" class="form-control" name="arrival_date" value="{{ $booking->arrival_date }}" id="arrival_date">
            <div id="" class="form-text">Cambia la data di arrivo</div>
        </div>

        <br>

        <div class="form-group">
            <label for="arrival_time" class="form-label">Orario di arrivo</label>
            <select name="arrival_time" id="arrival_time" class="form-control">
                <option value="{{ \Carbon\Carbon::parse($booking->arrival_time)->format('H:i') }}">{{ \Carbon\Carbon::parse($booking->arrival_time)->format('H:i') }}</option> <!-- 'selected disabled' per fare in modo che nessun orario sia preselezionato -->
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
            <div id="" class="form-text">Cambia l'orario di arrivo</div>
        </div>

        <br>

        <div class="form-group">
            <label for="departure_date" class="form-label">Data di partenza</label>
            <select name="departure_date" id="formatted_departure_date" class="form-control">
                <option value="" selected disabled></option>
                <!-- Le opzioni si aggiornano con Javascript dinamicamente in base alla data di arrivo RIGA 212 -->
            </select>
            <input type="hidden" name="departure_date" id="departure_date">
            <div id="" class="form-text">Cambia la data di partenza</div>
        </div>

        <br>

        <div class="form-group">
            <label for="departure_time" class="form-label">Orario di partenza</label>
            <select name="departure_time" id="departure_time" class="form-control">
                <option value="{{ \Carbon\Carbon::parse($booking->departure_time)->format('H:i') }}">{{ \Carbon\Carbon::parse($booking->departure_time)->format('H:i') }}</option>
                <option value="09:00">09:00</option>
                <option value="10:00">10:00</option>
                <option value="11:00">11:00</option>
                <option value="12:00">12:00</option>
            </select>
            <div id="" class="form-text">Cambia l'orario di partenza</div>
        </div>

        <br>

        <!-- Input nascosto per il numero di persone originario -->
        <input type="hidden" name="original_people" value="{{ $booking->people }}">

        <div class="form-group">
            <label for="people" class="form-label">Numero di persone</label>
            <input type="number" class="form-control" name="people" value="{{ $booking->people }}">
            <div id="" class="form-text">Cambia il nuovo numero di persone</div>
        </div>

        <br>

        <!-- Manda lo user_id al BookingController, assicurandosi prima che l'utente sia effettivamente autenticato -->
        <input type="hidden" name="user_id" value="{{ optional(Auth::user())->id }}">

        <input type="hidden" name="user_id" value="{{ optional(Auth::user())->id }}">

        <button type="submit" class="btn btn-primary">Salva modifiche</button>

    </form>

    <!-- Form per eliminare la prenotazione -->
    <form method="POST" action="{{ route('bookings.destroy', $booking->id) }}" style="display: inline-block;">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare la prenotazione?')">Elimina prenotazione</button>
    </form>

</div>

@endsection

<!-- Javascript per verificare la disponibilità della stanza -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Cerca i posti liberi per l'aula selezionata usando una ajax request al caricamento della pagina
        fetchRoomInfo();

        // Controlla i cambiamenti in input della stanza selezionata
        $('#room_id').change(function() {
            fetchRoomInfo();
        });

        function fetchRoomInfo() {
            var roomId = $('#room_id').val();


            // Trova i posti disponibili nellautla selezionata usando una AJAX request
            $.ajax({
                url: '/api/rooms/' + roomId,
                method: 'GET',
                success: function(response) {
                    console.log('Received response:', response);

                    // Aggiorna il parametro availableSeatsInfo con i dati trovati
                    $('#availableSeatsInfo').html('Posti disponibili nell\'aula selezionata: ' + response.available_seats);
                },
                error: function(error) {
                    console.error('Fallimento nella ricerca delle informazioni sull\'aula', error);
                    $('#availableSeatsInfo').html('');
                }
            })
        }
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

                $('#formatted_departure_date').empty();

                // Aggiungi opzioni in base alla data di arrivo selezionata
                for (var i = 1; i <= 2; i++) {
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

<!-- Script per verificare se viene cambiata aula -->
<script>
    $(document).ready(function() {
        $('#room_id').change(function() {
            var roomName = $('#room_id option:selected').text();
            $('#room_name').val(roomName);
        });
    });
</script>