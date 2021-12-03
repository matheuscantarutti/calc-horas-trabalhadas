<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <h1 class='text-center'>Calculadora de Horas Trabalhadas</h1>
        <div class="w-50 mx-auto m-5">
            <form class="form-horizontal w-50 mx-auto" action='turno/calcular' method='post' enctype='multipart/form-data'>
                @csrf
                <div class="form-group m-2">
                    <label class='form-label mt-1' for="data_hora_inicial">Horário inicial</label>
                    <input class='form-control mt-1' type="datetime-local" name="data_hora_inicial" id="data_hora_inicial">
                </div>
                <div class="form-group m-2">
                    <label  class='form-label mt-1' for="data_hora_final">Horário final</label>
                    <input  class='form-control mt-1' type="datetime-local" name="data_hora_final" id="data_hora_final">
                </div>
                <button type="submit" class='btn btn-primary btn-md w-100 mt-3'>Calcular</button>
            </form>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
</body>

</html>
