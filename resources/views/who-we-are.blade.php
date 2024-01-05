@extends('layouts.app')

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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

        #card-one,
        #card-two,
        #card-three,
        #card-four {
            opacity: 0;
        }
    </style>

</head>

@section('content')

<body>
    <div class="container">
        <h1>Chi siamo</h1>

        <hr>

        <section id="gallery">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 mb-3" id="card-one">
                        <div class="card">
                            <img src="{{ asset('images/gaudenzi-luca.jpg') }}" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Gaudenzi Luca</h5>
                                <p class="card-text">Giocatore di tennis professionista</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-3" id="card-two">
                        <div class="card">
                            <img src="{{ asset('images/marzola-gaia.jpg') }}" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Marzola Gaia</h5>
                                <p class="card-text">Quella che offre da bere a tutti</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-3" id="card-three">
                        <div class="card">
                            <img src="{{ asset('images/pirelli-giorgia.jpg') }}" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Pirelli Giorgia</h5>
                                <p class="card-text">Non produce gomme</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mb-3" id="card-four">
                        <div class="card">
                            <img src="{{ asset('images/taiwo-solomon.jpg') }}" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">Taiwo Solomon Olamide</h5>
                                <p class="card-text">Cugino di Barack Obama</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

</body>

@endsection

</html>

<!-- Animazioni -->
<script>
    $(document).ready(function() {
        $('#card-one').fadeTo(1000, 1);
        $('#card-two').fadeTo(1150, 1);
        $('#card-three').fadeTo(1250, 1);
        $('#card-four').fadeTo(1350, 1);
    });
</script>