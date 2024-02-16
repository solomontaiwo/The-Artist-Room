@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Crea un'aula</h1>

    <hr>

    <form action="{{ route('rooms.store') }}" method="POST" id="createRoomForm">
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

        <br>

        <br>

        <a href="{{ url()->previous() }}" class="btn btn-primary">Indietro</a>

    </form>
</div>

@endsection

<!-- Script per rendere il pulsante di creazione non cliccabile se tutti gli altri campi non sono compilati -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function() {
        // Abilita o disabilita il bottone a seconda dell'input dei form
        //stia verificando se tutti gli input richiesti del form sono stati compilati per decidere se abilitare o disabilitare il bottone.
        $('#createRoomForm input').on('input', function() {
            var isFormValid = true;
            // Itera attraverso tutti gli input obbligatori nel form
            $('#createRoomForm input[required]').each(function() {
                // Se l'input è vuoto, il form non è valido
                if ($(this).val() === '') {
                    isFormValid = false;
                    return false; // Esci dal loop prima se un input è vuoto
                }
            });
            // Imposta lo stato del bottone a seconda della validità del form
            $('#createRoomButton').prop('disabled', !isFormValid);
        });
    });
</script>