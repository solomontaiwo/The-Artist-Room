@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Modifica "{{ $room->name }}"</h1>

    <br>

    <form method="POST" action="{{ route('room.update', $room->id) }}">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="name" class="form-label">Nome aula</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $room->name }}">
            <div id="" class="form-text">Cambia il nome dell'aula</div>
        </div>

        <br>

        <div class="form-group">
            <label for="description" class="form-label">Descrizione</label>
            <input type="string" class="form-control" name="description" value="{{ $room->description }}">
            <div id="" class="form-text">Cambia la descrizione</div>
        </div>

        <br>

        <div class="form-group">
            <label for="address" class="form-label">Indirizzo</label>
            <input type="string" class="form-control" name="address" value="{{ $room->address }}">
            <div id="" class="form-text">Cambia l'indirizzo dell'aula</div>
        </div>

        <br>

        <div class="form-group">
            <label for="size" class="form-label">Dimensioni</label>
            <input type="number" class="form-control" name="size" value="{{ $room->size }}">
            <div id="" class="form-text">Cambia le dimensioni dell'aula</div>
        </div>

        <br>

        <div class="form-group">
            <label for="available_seats" class="form-label">Posti attualmente disponibili</label>
            <input type="number" class="form-control" name="available_seats" value="{{ $room->available_seats }}">
            <div id="" class="form-text">Cambia il nuovo numero di persone</div>
        </div>

        <br>

        <button type="submit" class="btn btn-primary">Salva modifiche</button>

    </form>

    <!-- Form per eliminare la prenotazione -->
    <form method="POST" action="{{ route('room.destroy', $room->id) }}" style="display: inline-block;">
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare l\'aula?')">Elimina aula</button>
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