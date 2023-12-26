@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <li><a href="{{ route('room.index') }}">Tutte le aule</a></li>
                    <li><a href="{{ route('booking.index') }}">Visualizza le tue prenotazioni</a></li>
                    <li><a href="{{ route('booking.create') }}">Fai una prenotazione</a></li>
                    <li><a href="{{ route('who-are-we.index') }}">Chi siamo</a></li>

                    <!-- {{ __('Sei loggato!') }} -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
