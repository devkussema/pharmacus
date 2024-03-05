<!doctype html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="language" content="pt">
    <meta name="geo.region" content="AO">
    <meta name="geo.placename" content="Angola">
    <meta name="geo.position" content="-8.838333; 13.234444">
    <meta name="geo.icbm" content="-8.838333; 13.234444">

    <!-- Meta tag robots -->
    <meta name="robots" content="index, follow">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('titulo') | {{ env('APP_NAME') }} - {{ env('APP_DESCRIPTION') }}</title>

    <meta name="description" content="{{ $app_desc ?? '' }}">
    <meta name="keywords" content="{{ $app_keywords ?? '' }}">
    <meta name="author" content="Augusto Kussema">

    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('assets/images/white__logo2.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/white__logo2.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/backende209.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">

    <style>
        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            /* Inicialmente, o loader estará invisível */
            transition: opacity 0.5s;
        }

        .loader img {
            width: 48px;
            /* Defina o tamanho da imagem como uma porcentagem da largura da tela */
            animation: spin 2s linear infinite;
            /* Efeito de rotação */
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class=" ">
    <div class="loader" id="loaderish" style="display: none">
        <img src="{{ asset('assets/images/white__logo2.png') }}" alt="Logotipo" class="logo">
    </div>

    <div class="wrapper">
        <section class="login-content">
            <div class="container">
                <div id="rd">
                    @yield('conteudo')
                </div>
            </div>
        </section>
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
            }, 1); // Tempo de espera para iniciar o efeito de fade
        }

        // Função para esconder o loader com efeito de fade-out
        function hideLoader() {
            const loader = document.getElementById('loaderish');
            loader.style.opacity = '0'; // Define a opacidade como 0 para esconder gradualmente
            setTimeout(() => {
                loader.style.display = 'none'; // Oculta o loader após o efeito de fade-out
            }, 50); // Tempo de espera para concluir a transição
        }
    </script>

    {{-- <script src="{{ asset('assets/js/helpers.js') }}" async></script> --}}
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('assets/js/backend-bundle.min.js') }}"></script>

    <!-- Table Treeview JavaScript -->
    <script src="{{ asset('assets/js/table-treeview.js') }}"></script>

    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Chart Custom JavaScript -->
    <script async src="{{ asset('assets/js/chart-custom.js') }}"></script>

    <!-- app JavaScript -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="{{ asset('assets/js/form.js') }}" async></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if ("serviceWorker" in navigator) {
            // Register a service worker hosted at the root of the
            // site using the default scope.
            navigator.serviceWorker.register("/sw.js").then(
                (registration) => {
                    console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    console.error(`Service worker registration failed: ${error}`);
                },
            );
        } else {
            console.error("Service workers are not supported.");
        }
    </script>
</body>

</html>
