@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Tutti gli utenti</h1>
    <br>
    <h3>Utenti totali: {{ $users->count() }} </h3>

    @if($users->isEmpty())
    <p>Non ci sono utenti.</p>
    @else
    <ul>
        @foreach($users as $user)
        <div>
            <!-- Informazioni sull'utente -->
            <br>
            <p><strong>Nome:</strong> {{ $user->name }}</p>
            <p><strong>Cognome:</strong> {{ $user->surname }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Admin:</strong> {{ $user->is_admin ? 'Sì' : 'No' }}</p>

            <!-- Pulsante per vedere le prenotazioni dell'utente -->
            <a href="{{ route('user.show', $user->id) }}">Prenotazioni</a>
            <button role="button" class="btn btn-danger btn-sm btn-elimina" data-id="{{ $user->id }}" data-token="{{ csrf_token() }}">Elimina utente</button>

            <br>
            <hr>

        </div>
        @endforeach
    </ul>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $('.btn.btn-elimina').bind('click', function(event) {
        event.preventDefault();

        let id = $(this).attr('data-id');
        let token = $('input[name="_token"]').val();

        console.log(id);

        $.ajax({
            url: "/user/" + id,
            type: "DELETE",
            dataType: 'json',
            data: {
                '_token': token,
            },
            success: function(response) {
                // Il mio codice success
                console.log('Response:', response);
                location.reload();
            },
            error: function(response, status) {
                // Il mio codice error
                console.log('Errore nell\'eliminazione dell\'utente');
            }
        });
    });
</script>

@endsection