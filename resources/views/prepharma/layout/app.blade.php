<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ assetr('assets/img/white__logo2.png') }}">

    @if (request()->cookie('pwa_app') === 'true')
        <title>@yield('titulo', 'Página Inicial')</title>
    @else
        <title>@yield('titulo', 'Página Inicial') - {{ getConfig('nome_site') ?? env('APP_NAME') }}</title>
    @endif

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ assetr('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="{{ assetr('assets/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ assetr('assets/plugins/datatables/datatables.min.css') }}">

    <link rel="stylesheet" href="{{ assetr('assets/css/feather.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ assetr('assets/css/style.css') }}">
</head>

<body>
    <div class="main-wrapper">
        @include('partials.header')

        @include('partials.sidebar')

        <div class="page-wrapper">
            @yield('content')

            @include('partials.notification-box')
        </div>
    </div>


    <script src="{{ assetr('assets/js/jquery-3.7.1.min.js') }}" type="be6558ccd95e077c3366a663-text/javascript"></script>

    <script src="{{ assetr('assets/js/bootstrap.bundle.min.js') }}" type="be6558ccd95e077c3366a663-text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.8.1/feather.js" type="be6558ccd95e077c3366a663-text/javascript"></script>

    <script src="{{ assetr('assets/js/jquery.slimscroll.js')}}" type="be6558ccd95e077c3366a663-text/javascript"></script>

    <script src="{{ assetr('assets/js/select2.min.js')}}" type="be6558ccd95e077c3366a663-text/javascript"></script>

    <script src="{{ assetr('assets/plugins/datatables/jquery.dataTables.min.js')}}" type="be6558ccd95e077c3366a663-text/javascript"></script>
    <script src="{{ assetr('assets/plugins/datatables/datatables.min.js')}}" type="be6558ccd95e077c3366a663-text/javascript"></script>

    <script src="{{ assetr('assets/js/jquery.waypoints.js')}}" type="be6558ccd95e077c3366a663-text/javascript"></script>
    <script src="{{ assetr('assets/js/jquery.counterup.min.js')}}" type="be6558ccd95e077c3366a663-text/javascript"></script>

    <script src="{{ assetr('assets/plugins/apexchart/apexcharts.min.js')}}" type="be6558ccd95e077c3366a663-text/javascript"></script>
    <script src="{{ assetr('assets/plugins/apexchart/chart-data.js')}}" type="be6558ccd95e077c3366a663-text/javascript"></script>

    <script src="{{ assetr('assets/js/app.js')}}" type="be6558ccd95e077c3366a663-text/javascript"></script>
    <script src="{{ assetr('assets/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}"
        data-cf-settings="be6558ccd95e077c3366a663-|49" defer></script>
</body>

</html>
