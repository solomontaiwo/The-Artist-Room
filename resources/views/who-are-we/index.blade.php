@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

        .star-container {
            white-space: nowrap;
        }

        .star {
            font-size: 10vh;
            cursor: pointer;
            white-space: nowrap;
            align-items: center;
        }

        .one {
            color: rgb(255, 0, 0);
        }

        .two {
            color: rgb(255, 106, 0);
        }

        .three {
            color: rgb(251, 255, 120);
        }

        .four {
            color: rgb(255, 255, 0);
        }

        .five {
            color: rgb(24, 159, 14);
        }
    </style>

</head>

<div class="container">
    <h1>Chi siamo</h1>

    <br>

    <section id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 mb-3">
                    <div class="card">
                        <img src="{{ asset('images/gaudenzi-luca.jpg') }}" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Gaudenzi Luca</h5>
                            <p class="card-text">Giocatore di tennis professionista</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-3">
                    <div class="card">
                        <img src="{{ asset('images/marzola-gaia.jpg') }}" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Marzola Gaia</h5>
                            <p class="card-text">Quella che offre da bere a tutti</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-3">
                    <div class="card">
                        <img src="{{ asset('images/pirelli-giorgia.jpg') }}" alt="" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">Pirelli Giorgia</h5>
                            <p class="card-text">Non produce gomme</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mb-3">
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

@endsection