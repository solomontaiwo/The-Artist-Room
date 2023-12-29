@extends('layouts.app')

@section('content')

<div class="container">

    <h1>Tutte le prenotazioni</h1>
    <br>
    <p><strong>Nome stanza:</strong> {{ $user->name }}</p>
    <p><strong>Data di arrivo:</strong> {{ $user->surname }}</p>
    <p><strong>Data di partenza:</strong> {{ $user->email }}</p>
    <p><strong>Persone:</strong> {{ $user->is_admin }}</p>

    <hr>
    <p><a href="{{ route('home') }}">Torna alla homepage</a></p>

</div>
@endsection