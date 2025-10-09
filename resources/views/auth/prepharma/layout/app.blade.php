<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <title>@yield('titulo', 'Iniciar Sessão')</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('prepharma/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('prepharma/css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('prepharma/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('prepharma/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('prepharma/css/style.css') }}">
</head>
<body>
<div class="main-wrapper login-body">
        <div class="container-fluid px-0">
            <div class="row">

                <div class="col-lg-6 login-wrap">
                    <div class="login-sec">
                        <div class="log-img">
                            <img class="img-fluid" src="{{ asset('prepharma/img/login-02.png') }}" alt="Logo">
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('prepharma/js/jquery-3.7.1.min.js') }}" type="b8473ea80c51681c0602e544-text/javascript"></script>
    <script src="{{ asset('prepharma/js/bootstrap.bundle.min.js') }}" type="b8473ea80c51681c0602e544-text/javascript"></script>
    <script src="{{ asset('prepharma/js/feather.min.js') }}" type="b8473ea80c51681c0602e544-text/javascript"></script>
    <script src="{{ asset('prepharma/js/app.js') }}" type="b8473ea80c51681c0602e544-text/javascript"></script>
    <script src="{{ asset('prepharma/js/rocket-loader.min.js') }}"
        data-cf-settings="b8473ea80c51681c0602e544-|49" defer></script>
</body>
</html>