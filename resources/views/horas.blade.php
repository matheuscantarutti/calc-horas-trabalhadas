<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Calculadora de Horas</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->


    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>

<body class="container">
    <div class="row m-5">
        <h1 class='text-center m-3'>Calculadora de Horas Trabalhadas</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="w-50 mx-auto m-5">
            <form class="form-horizontal w-50 mx-auto" action='turno/calcular' method='post' enctype='multipart/form-data'>
                @csrf
                <div class="form-group m-2">
                    <label class='form-label mt-1' for="hora_inicial">Horário inicial</label>
                    <input class='form-control mt-1' type="time" name="hora_inicial" id="hora_inicial">
                </div>
                <div class="form-group m-2">
                    <label  class='form-label mt-1' for="hora_final">Horário final</label>
                    <input  class='form-control mt-1' type="time" name="hora_final" id="hora_final">
                </div>
                <button type="submit" class='btn btn-primary btn-md w-100 mt-3'>Calcular</button>
            </form>
        </div>

    </div>
</body>

</html>
