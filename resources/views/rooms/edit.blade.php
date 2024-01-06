@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Modifica "{{ $room->name }}"</h1>

    <hr>

    <form method="POST" action="{{ route('room.update', $room->id) }}">
        @csrf
        @method('PATCH')
        <!--Quando il form viene inviato, il server Laravel interpreterà la richiesta come un aggiornamento di un record esistente, 
        poiché il metodo HTTP è stato impostato su PATCH.
        <form action="/example/{{ $example->id }}" method="POST">: Questo è l'inizio del tag del form. L'attributo action specifica l'URL 
        a cui verrà inviata la richiesta, e method="POST" viene utilizzato perché il browser supporta solo metodi HTTP GET e POST nei tag dei form HTML. 
        -->

        <div class="form-group">
            <label for="name" class="form-label">Nome aula</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $room->name }}">
            <div id="" class="form-text">Cambia il nome dell'aula</div>
        </div>

        <br>

        <div class="form-group">
            <label for="description" class="form-label">Tipo</label>
            <input type="string" class="form-control" name="description" value="{{ $room->description }}">
            <div id="" class="form-text">Cambia il tipo di aula</div>
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

        <button type="submit" class="btn btn-success">Salva modifiche</button>

    </form>

    <!-- Form per eliminare la prenotazione -->
    <form method="POST" action="{{ route('room.destroy', $room->id) }}">
        @csrf
        @method('DELETE')
        <!-- <form action="/example/{{ $example->id }}" method="POST">: Questo è l'inizio del tag del form. 
        L'attributo action specifica l'URL a cui verrà inviata la richiesta, e method="POST" viene utilizzato perché il browser 
        supporta solo metodi HTTP GET e POST nei tag dei form HTML. Tuttavia, grazie a @method('DELETE'), il metodo reale sarà DELETE.

        Quando il form viene inviato, il server Laravel interpreterà la richiesta come un comando di eliminazione del record associato all'ID specificato.-->

        <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare l\'aula?')">Elimina aula</button>
    </form>

</div>

@endsection

<!-- Il codice JavaScript fornito utilizza jQuery per effettuare una richiesta AJAX e ottenere informazioni sugli aule selezionate dinamicamente. -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
        // Cerca i posti disponibili per l'aula selezionata usando una AJAX request al caricamento della pagina
        fetchRoomInfo();

        // Controlla se viene cambiata l'aula selezionata
        $('#room_id').change(function() {
            fetchRoomInfo();
        });

        function fetchRoomInfo() {
            var roomId = $('#room_id').val();

            // Cerca i posti disponibili per l'aula selezionata usando una AJAX request 
            $.ajax({
                url: '/api/rooms/' + roomId,
                method: 'GET',
                success: function(response) {
                    console.log('Received response:', response);

                    // Aggiorna availableSeatsInfo con i dati trovati
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
