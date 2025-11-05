<!DOCTYPE html>
<html lang="pt-br" data-theme>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diretor - @yield('title', 'Dashboard')</title>

    <!-- Tipografia Inter e FontAwesome -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root{
            --bg: #ffffff;
            --panel: #f8fafc;
            --text: #1f2937;
            --muted: #6b7280;
            --accent-start: #6ee7b7;
            --accent-end: #3b82f6;
        }
        [data-theme="dark"], .theme-dark{
            --bg: #0b1220;
            --panel: #0f1724;
            --text: #e6eef8;
            --muted: #9aa6bf;
            --accent-start: #06b6d4;
            --accent-end: #7c3aed;
        }

        html,body{height:100%;font-family:'Inter',system-ui,-apple-system,Segoe UI,Roboto,'Helvetica Neue',Arial;margin:0;background:var(--bg);color:var(--text)}
        .navbar-brand{font-weight:700}
        .app-aside{width:240px;background:linear-gradient(180deg,var(--panel),rgba(255,255,255,0));min-height:100vh;padding-top:1rem}
        .content-area{margin-left:240px;padding:1.5rem}
        @media (max-width: 991px){.content-area{margin-left:0}.app-aside{display:none}}

        /* Cards com gradiente e animação */
        .stat-card{background:linear-gradient(90deg,var(--accent-start),var(--accent-end));color:#fff;border-radius:8px;transition:transform .28s ease,box-shadow .28s ease;box-shadow:0 6px 18px rgba(15,23,42,.06)}
        .stat-card:hover{transform:translateY(-6px);box-shadow:0 18px 36px rgba(2,6,23,.18)}
        .stat-card .card-body{backdrop-filter: blur(4px);}

        /* table and footer tweaks */
        .card .table thead th{border-bottom:1px solid rgba(0,0,0,.06)}
        footer{background:transparent}

        /* small utilities */
        .muted{color:var(--muted)}

    </style>

    @stack('styles')
</head>
<body>

@include('diretor::partials.header')

<div class="d-flex">
    @include('diretor::partials.aside')

    <main class="flex-fill content-area">
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @yield('content')
    </main>
</div>

@include('diretor::partials.footer')

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Modo claro/escuro simples com localStorage
    (function(){
        const html = document.documentElement;
        const storageKey = 'diretor-theme';
        const saved = localStorage.getItem(storageKey);
        const apply = (mode)=>{
            if(mode === 'dark'){
                html.setAttribute('data-theme','dark');
                html.classList.add('theme-dark');
            } else {
                html.removeAttribute('data-theme');
                html.classList.remove('theme-dark');
            }
        };
        apply(saved || 'light');

        window.toggleDiretorTheme = function(){
            const current = localStorage.getItem(storageKey) === 'dark' ? 'dark' : 'light';
            const next = current === 'dark' ? 'light' : 'dark';
            localStorage.setItem(storageKey,next);
            apply(next);
        }
    })();
</script>

@stack('scripts')

</body>
</html>
