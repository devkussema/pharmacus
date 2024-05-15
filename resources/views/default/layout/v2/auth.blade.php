<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="language" content="pt">
    <meta name="geo.region" content="AO">
    <meta name="geo.placename" content="Angola">
    <meta name="geo.position" content="-8.838333; 13.234444">
    <meta name="geo.icbm" content="-8.838333; 13.234444">

    <!-- Meta tag robots -->
    <meta name="robots" content="index">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @if (request()->cookie('pwa_app') === 'true')
        <title>@yield('titulo', 'Entrar')</title>
    @else
        <title>@yield('titulo', 'Entrar') - {{ getConfig('nome_site') ?? env('APP_NAME') }}</title>
    @endif

    <meta name="description" content="{{ getConfig('nome_site') ?? ($app_desc ?? '') }}">
    <meta name="keywords" content="{{ $app_keywords ?? '' }}">
    <meta name="author" content="Augusto Kussema">

    <meta name="theme-color" content="#6777ef" />

    <link rel="apple-touch-icon" href="{{ assetr('assets/images/white__logo2.png') }}">
    <link rel="shortcut icon" href="{{ assetr('assets/images/white__logo2.png') }}" />
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <!-- Web Fonts ========================= -->
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900'
        type='text/css'>

    <!-- Stylesheet ========================= -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/stylesheet.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <!-- Colors Css -->
    <link id="color-switcher" type="text/css" rel="stylesheet" href="#" />
    <style>
        a {
            text-decoration: none;
        }
    </style>
</head>
@php
    #$theme = "dark";
@endphp

<body>
    <div class="preloader preloader-{{ $theme ?? 'dark' }}">
        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <div id="main-wrapper" class="oxyy-login-register">
        <div class="container-fluid px-0">
            <div class="row g-0 min-vh-100">
                <div class="col-md-4">
                    <div class="hero-wrap d-flex align-items-center h-100">
                        <div class="hero-mask opacity-4 bg-{{ $theme ?? 'light' }}"></div>
                        <div class="hero-bg hero-bg-scroll"
                            style="background-image:url({{ asset('assets/images/auth_bg.png') }});">
                        </div>
                        <div class="hero-content mx-auto w-100 h-100">
                            <div class="container d-flex flex-column h-100">
                                <div class="row g-0">
                                    <div class="col-11 col-lg-9 mx-auto">
                                        <div class="logo mt-5 mb-5">
                                            <a class="d-flex" href="#"
                                                style="text-decoration: none; color: {{ $theme == 'dark' ? '#fff' : '#343a40' }}"
                                                title="{{ getConfig('nome_site') ?? env('APP_NAME') }}">
                                                <img width="30" height="30"
                                                    src="{{ pharma('assets/images/white__logo2.png') }}"
                                                    alt="{{ getConfig('nome_site') ?? env('APP_NAME') }}">
                                                <h4 style="margin-left: 10px">Pharmatina</h4>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-0 mt-3">
                                    <div class="col-11 col-lg-9 mx-auto">
                                        <h1 class="text-9 text-{{ $theme == 'dark' ? 'white' : 'dark' }} fw-300 mb-5">
                                            <span class="fw-500">Bem-vindo</span>,
                                            Estamos felizes em vê-lo novamente!!
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        // Função para exibir o loader com efeito de fade-in
        function showLoader() {
            const loader = document.getElementById('loaderish');
            loader.style.display = 'block'; // Exibe o loader
            loader.style.opacity = '0';
            loader.style.display = 'flex';
            setTimeout(() => {
                loader.style.opacity = '1'; // Define a opacidade como 1 para exibir gradualmente
            }, 1000); // Tempo de espera para iniciar o efeito de fade
        }

        // Função para esconder o loader com efeito de fade-out
        function hideLoader() {
            const loader = document.getElementById('loaderish');
            loader.style.opacity = '0'; // Define a opacidade como 0 para esconder gradualmente
            setTimeout(() => {
                loader.style.display = 'none'; // Oculta o loader após o efeito de fade-out
            }, 1000); // Tempo de espera para concluir a transição
        }
    </script>

    <!-- Script -->
    <!-- Backend Bundle JavaScript -->
    <script src="{{ assetr('assets/js/backend-bundle.min.js') }}"></script>

    <script src="{{ assetr('assets/js/form.js') }}" async></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

    <script src="{{ asset('/sw2.js') }}"></script>
    <script>
        function wish() {
            toastr.success("Bem-vindo de volta", 'A redirecionar');
        }
        // Função para ativar os elementos
        function preloadering() {
            document.querySelector('.preloader').style.display = 'block';
            document.querySelector('.lds-ellipsis').style.display = 'block';
        }

        // Função para remover os elementos
        function unPreloadering() {
            document.querySelector('.preloader').style.display = 'none';
            document.querySelector('.lds-ellipsis').style.display = 'none';
        }

        if ("serviceWorker" in navigator) {
            // Register a service worker hosted at the root of the
            // site using the default scope.
            navigator.serviceWorker.register("/sw2.js").then(
                (registration) => {
                    //console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    //console.error(`Service worker registration failed: ${error}`);
                },
            );
        } else {
            console.error("Service workers are not supported.");
        }
    </script>

    {{-- <script src="https://harnishdesign.net/demo/html/oxyy/vendor/jquery/jquery.min.js"></script>
    <script src="https://harnishdesign.net/demo/html/oxyy/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
    <!-- Style Switcher -->
    <script src="https://harnishdesign.net/demo/html/oxyy/js/switcher.min.js"></script>
    <script src="https://harnishdesign.net/demo/html/oxyy/js/theme.js"></script>
</body>

</html>
