@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica il tuo indirizzo email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('Un link di verifica è stato mandato al tuo indirizzo emailß.') }}
                    </div>
                    @endif

                    {{ __('Prima di procedere, controlla che non ti sia arrivata una email con il link di verifica.') }}
                    {{ __('Se non hai ricevuto la mail') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('clicca qui per chiederne un\'altra') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection