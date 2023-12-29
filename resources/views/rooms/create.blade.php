@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Crea un'aula</h1>

    <br>

    <form action="{{ route('room.store') }}" method="POST" id="createRoomForm">
        @csrf

        <div class="form-group">
            <label for="name" class="form-label">Nome aula</label>
            <input type="string" class="form-control" name="name" required>
            <div id="" class="form-text">Inserisci il nome dell'aula</div>
        </div>

        <br>

        <div class="form-group">
            <label for="description" class="form-label">Tipo</label>
            <input type="string" class="form-control" name="description" required>
            <div id="" class="form-text">Inserisci a che cosa è dedicata l'aula</div>
        </div>

        <br>

        <div class="form-group">
            <label for="address" class="form-label">Indirizzo</label>
            <input type="string" class="form-control" name="address" required>
            <div id="" class="form-text">Inserisci l'indirizzo dell'aula</div>
        </div>

        <br>

        <div class="form-group">
            <label for="size" class="form-label">Dimensioni</label>
            <input type="string" class="form-control" name="size" required>
            <div id="" class="form-text">Inserisci le dimensioni dell'aula in metri quadri</div>
        </div>

        <br>

        <div class="form-group">
            <label for="available_seats" class="form-label">Posti disponibili</label>
            <input type="number" class="form-control" name="available_seats" required>
            <div id="" class="form-text">Inserisci il numero di posti disponibili</div>
        </div>

        <br>

        <button type="submit" id="createRoomButton" class="btn btn-success" disabled>Crea aula</button>
    </form>
</div>

<!-- Script per rendere il pulsante di creazione non cliccabile se tutti gli altri campi non sono compilati -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Enable or disable the button based on form validation
        $('#createRoomForm input').on('input', function() {
            var isFormValid = true;

            $('#createRoomForm input[required]').each(function() {
                if ($(this).val() === '') {
                    isFormValid = false;
                    return false; // Exit the loop early if a required field is empty
                }
            });

            $('#createRoomButton').prop('disabled', !isFormValid);
        });
    });
</script>

@endsection