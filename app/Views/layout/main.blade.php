<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <title>@yield('title', 'Página Inicial') - Pharmatina</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ assetr('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ assetr('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ assetr('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetr('assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ assetr('assets/plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ assetr('assets/css/feather.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetr('assets/css/style.css') }}">
</head>
<body>
    <div class="main-wrapper">
        @include('admin::partials.header')

        @include('admin::partials.sidebar')

        <div class="page-wrapper">
            <div class="content">
                @yield('content')

            </div>
                @include('admin::partials.notification-box')
        </div>
    </div>

    <div class="sidebar-overlay" data-reff></div>


    @include('admin::partials.scripts')
</body>
</html>
