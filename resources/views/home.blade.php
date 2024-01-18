@extends('layouts.app')

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .card {
            max-width: 33rem;
            background: #fff;
            margin: 0 1rem;
            padding: 1rem;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            width: 100%;
            border-radius: 0.5rem;
        }

        #quote-text,
        #quote-name,
        #greetings,
        #registration-login-invitation,
        #card-one,
        #card-two,
        #card-three,
        #card-four,
        #card-five,
        #card-six {
            opacity: 0;
        }
    </style>

</head>

@section('content')

<body>

    <section id="gallery">
        <div class="container">

            <!-- Funzione per mostrare frase casuale in cima alla home, se l'utente è loggato -->
            @if (Auth::check())
            <h1 style="text-align: center" id="quote-name">Rieccoti, {{ Auth::user()->name }}!</h1>
            <p id="quote-text" style="text-align: center">"{{ $quote->phrase }}" - {{ $quote->author }}</p>
            <hr>
            @else
            <h1 style="text-align: center" id="greetings">Ciao!</h1>
            <p id="registration-login-invitation" style="text-align: center">
                <a style="text-decoration:none" href="{{ route('register') }}">Registrati</a>
                o <a style="text-decoration:none" href="{{ route('login') }}">loggati</a> per usufruire del servizio
            </p>
            <hr>
            @endif

            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card" id="card-one">
                        <img src="{{ asset('images/sculture.jpg') }}" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Scultori</h5>
                            <p class="card-text">Scalpello alle mani: diamo forma alle tue idee, dandoti la possibilità di modellare e creare le tue sculture</p>
                            <a href="{{ route('bookings.create') }}" class="btn btn-outline-success btn-sm">Prenota ora</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card" id="card-two">
                        <img src="{{ asset('images/pittore.jpg') }}" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Pittori e Disegnatori</h5>
                            <p class="card-text">Lascia libero spazio alla tua creatività: adesso hai a disposizione materiale e spazi adatti per esprimerti al meglio</p>
                            <a href="{{ route('bookings.create') }}" class="btn btn-outline-success btn-sm">Prenota ora</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card" id="card-three">
                        <img src="{{ asset('images/camera-oscura.jpg') }}" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Camera Oscura</h5>
                            <p class="card-text">Ritorno alla fotografia analogica: ambiente idoneo nel quale poter sviluppare e stampare i negativi fotografici</p>
                            <a href="{{ route('bookings.create') }}" class="btn btn-outline-success btn-sm">Prenota ora</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr> <br>

    <!-- ========== RECENSIONI ========== -->

    <section>
        <section id="gallery-reviews">
            <div class="container">
                <div class="row">

                    <div class="col-md-4 mb-4">
                        <div class="card" id="card-four" style="max-width: 400px;">
                            <div class="row g-0">
                                <div class="col-md-4 d-flex align-items-center">
                                    <img src="{{ asset('images/piva-giacomo.jpg') }}" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Giacomo Piva ha dato 30 e lode</h5>
                                        <p class="card-text">"Ragazzi fenomenali, avete imparato bene!"</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card" id="card-five" style="max-width: 400px;">
                            <div class="row g-0">
                                <div class="col-md-4 d-flex align-items-center">
                                    <img src="{{ asset('images/van-gogh-vincent.jpg') }}" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Vincent Van Gogh ha dato 4 stelle</h5>
                                        <p class="card-text">"Non ho trovato l'orecchio, ma l'aula era perfetta"</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 mb-4">
                        <div class="card" id="card-six" style="max-width: 400px;">
                            <div class="row g-0">
                                <div class="col-md-4 d-flex align-items-center">
                                    <img src="{{ asset('images/cartier-bresson-henry.jpg') }}" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">Henry Cartier-Bresson ha dato 5 stelle</h5>
                                        <p class="card-text">"Il sito del secolo (ho occhio per queste cose 😉)"</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </section>
    </section>

</body>

@endsection

</html>

<!-- Script per animazione fade delle citazioni e delle card-->
<script>
    $(document).ready(function() {
        $('#quote-text').fadeTo(1000, 1); //51
        $('#quote-name').fadeTo(1000, 1); //50
        $('#greetings').fadeTo(1000, 1); //RIGA 54
        $('#registration-login-invitation').fadeTo(1000, 1); //RIGA 55
        $('#card-one').fadeTo(1000, 1);
        $('#card-two').fadeTo(1000, 1);
        $('#card-three').fadeTo(1000, 1);
        $('#card-four').fadeTo(1000, 1);
        $('#card-five').fadeTo(1000, 1);
        $('#card-six').fadeTo(1000, 1);
    });
</script>