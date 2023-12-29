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
            <p><strong>Numero di prenotazioni:</strong> {{ $user->bookings->count() }}</p>
            <p><strong>Admin:</strong> {{ $user->is_admin ? 'Sì' : 'No' }}</p>

            <!-- Pulsante per vedere le prenotazioni dell'utente -->
            <a href="{{ route('user.show', $user->id) }}" class="btn btn-primary btn-sm">Prenotazioni</a>
            @if (!$user->is_admin)
            <button role="button" class="btn btn-success btn-sm btn-promuovi" data-id="{{ $user->id }}" data-token="{{ csrf_token() }}">Promuovi ad admin</button>
            @endif
            <button role="button" class="btn btn-danger btn-sm btn-elimina" data-id="{{ $user->id }}" data-token="{{ csrf_token() }}">Elimina utente</button>

            <br>
            <hr>

        </div>
        @endforeach
    </ul>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Script per promuovere utente ad admin -->



<!-- Script per eliminare utente -->
<script>
    $('.btn.btn-elimina').bind('click', function(event) {
        event.preventDefault();

        let id = $(this).attr('data-id');
        let token = $('input[name="_token"]').val();

        var confirmation = window.confirm("Sei sicuro di voler cancellare questo utente?");

        if (confirmation) {
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
        }
    });

    // Codice per promuovere un utente ad admin
    $('.btn-promuovi').bind('click', function() {
        var userId = $(this).data('id');
        var token = $(this).data('token');

        // Ask for confirmation before proceeding with the promotion
        var confirmation = window.confirm('Sei sicuro di voler promuovere questo utente ad admin?');

        if (confirmation) {
            // Perform AJAX request to update user as admin
            $.ajax({
                url: '/users/' + userId + '/promote',
                type: 'PUT', // Use PUT or POST method based on your implementation
                data: {
                    _token: token
                },
                success: function(response) {
                    if (response.success) {
                        // Update the admin status in the UI
                        location.reload();
                    }
                },
                error: function(error) {
                    console.error('Fallimento nella promozione dell\'utente ad admin', error);
                }
            });
        }
    });
</script>

@endsection