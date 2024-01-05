@extends('layouts.app')

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mostre d'Arte con Vue.js</title>

    <!-- Link ai fogli di stile di Bootstrap -->
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

@section('content')

<body>
    <div class="container">
        <div id="app" class="col-lg-12 mb-12">
            <exhibition-component></exhibition-component>
        </div>
    </div>
    </div>

    <p style="text-align: center">Pagina realizzata in collaborazione con <a href="https://www.arte.it/" target="_blank">ARTE.it</a></p>

</body>

</html>

@endsection