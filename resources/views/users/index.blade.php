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
         
            <button role="button" class="btn btn-danger btn-sm btn-elimina" data-id="{{ $user->id }}" >Elimina</button>

            <br>
            <hr>

        </div>
        @endforeach
    </ul>
    @endif
</div>

<script type="application/javascript">
    $('#btn-aggiungi').bind('click', function(event) {
        event.preventDefault();

        let nome = $('#project-name').val();
        let sede = $('input[name="sede"]').val();
        let token = $('input[name="_token"]').val();

        $.ajax({
            url: "/project",
            type: "POST",
            dataType: 'json',
            data: {
                'nome': nome,
                'sede': sede,
                '_token': token,
            },
            success: function(response) {
                // Il mio codice success
                console.log(response);

                var newColId = $('<td/>', {
                    text: response.data.id
                });
                var newColNome = $('<td/>', {
                    text: response.data.nome
                });
                var newColSede = $('<td/>', {
                    text: response.data.sede
                });

                var action = $('<button/>', {
                        role: 'button',
                        text: 'Elimina'
                    })
                    .addClass('btn btn-danger btn-sm btn-elimina')
                    .attr('data-id', response.data.id);

                var newColAzioni = $('<td/>', {
                    text: ''
                }).append(action);

                var newRow = $('<tr/>').attr('data-id', response.data.id);
                newRow.append(newColId)
                    .append(newColNome)
                    .append(newColSede)
                    .append(newColAzioni);

                $('tbody').append(newRow);

                $('#project-name').val('');
                $('input[name="sede"]').val('');
            },
            error: function(response, status) {
                // Il mio codice error
                console.log('error');
            }
        });
    });

    $('.btn.btn-elimina').on('click', function(event) {
        event.preventDefault();

        let id = $(this).attr('data-id');
        let token = $('input[name="_token"]').val();

        $.ajax({
            url: "/user/" + id,
            type: "DELETE",
            dataType: 'json',
            data: {
                '_token': token,
            },
            success: function(response) {
                // Il mio codice success
                $('tr[data-id="' + response.data.id + '"]').remove();
            },
            error: function(response, status) {
                // Il mio codice error
                console.log('error');
            }
        });

    });
</script>

@endsection