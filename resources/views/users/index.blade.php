@extends('layouts.app')

@section('content')

<div class="container">
    <h1>Tutti gli utenti</h1>

    <hr>

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
            <p><strong>Numero di prenotazioni:</strong> {{ $user->bookings->count() }}</p>
            <p><strong>Admin:</strong> {{ $user->is_admin ? 'Sì' : 'No' }}</p>

            <!-- Pulsante per vedere le prenotazioni dell'utente -->
            <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary btn-sm me-2">Prenotazioni</a>
            @if (!$user->is_admin)
            <button role="button" class="btn btn-success btn-sm btn-promuovi me-2" data-id="{{ $user->id }}" data-token="{{ csrf_token() }}">Promuovi ad admin</button>
            <button role="button" class="btn btn-danger btn-sm btn-elimina" data-id="{{ $user->id }}" data-token="{{ csrf_token() }}">Elimina utente</button>
            @endif
            <br>
            <hr>

        </div>
        @endforeach
    </ul>
    @endif
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Script con AJAX requests -->
<script>
    $(document).ready(function() {
        // Codice per eliminare un utente
        $('.btn.btn-elimina').bind('click', function(event) {
            event.preventDefault();

            let id = $(this).attr('data-id');
            let token = $('input[name="_token"]').val();

            var confirmation = window.confirm("Sei sicuro di voler cancellare questo utente?");

            if (confirmation) {
                $.ajax({
                    url: "/users/" + id,
                    type: "DELETE",
                    dataType: 'json',
                    data: {
                        '_token': token,
                    },
                    success: function(response) {
                        // Codice di successo mostrato a log e ricarica della pagina
                        console.log('Response:', response);
                        location.reload();
                    },
                    error: function(response, status) {
                        // Codice di errore mostrato a log
                        console.log('Errore nell\'eliminazione dell\'utente');
                    }
                });
            }
        });

        // Codice per promuovere un utente ad admin
        $('.btn-promuovi').bind('click', function() {
            var userId = $(this).data('id');
            var token = $(this).data('token');

            // Chiedi conferma prima di promuovere un utente ad admin
            var confirmation = window.confirm('Sei sicuro di voler promuovere questo utente ad admin?');

            if (confirmation) {
                // AJAX request per promuovere un utente ad admin
                $.ajax({
                    url: '/users/' + userId + '/promote',
                    type: 'PUT',
                    data: {
                        _token: token
                    },
                    success: function(response) {
                        if (response.success) {
                            // Ricarica la pagina per vedere le modifiche
                            location.reload();
                        }
                    },
                    error: function(error) {
                        console.error('Fallimento nella promozione dell\'utente ad admin', error);
                    }
                });
            }
        });
    });
</script>