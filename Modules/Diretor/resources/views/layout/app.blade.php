<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diretor - @yield('title', 'Dashboard')</title>
    <!-- Minimal CSS via CDN para protótipo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 56px; }
        .app-aside { width: 240px; }
        .content-area { margin-left: 240px; }
        @media (max-width: 767px) { .content-area { margin-left: 0; } .app-aside { display:none; } }
    </style>
</head>
<body>
    @include('diretor::partials.header')

    <div class="d-flex">
        @include('diretor::partials.aside')

        <main class="flex-fill p-4 content-area">
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @yield('content')
        </main>
    </div>

    @include('diretor::partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
