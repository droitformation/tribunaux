<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="@Designpond | Cindy Leschaud">
    <meta name="description" content="Tribunaux civils | Faculté de droit, Universite de Neuchâtel">
    <title>Tribunaux civils</title>
    <link rel="stylesheet" type="text/css" href="<?php echo asset('backend/css/styles.css');?>">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>
</head>
<body class="focusedform">

    <div class="verticalcenter">

        <br/>
        <!-- messages and errors -->
        @include('backend.partials.message')

        <h1 class="text-center"><a href="{{ url('/') }}">{!! trans('carte.site') !!}</a></h1>
        <div class="panel panel-primary">
            <!-- Contenu -->
            @yield('content')
            <!-- Fin contenu -->
        </div>

    </div>

</body>
</html>
