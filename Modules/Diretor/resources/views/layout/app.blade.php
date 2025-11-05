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
            --surface: #ffffff;
            --panel: #f8fafc;
            --text: #1f2937;
            --muted: #6b7280;
            --border: rgba(2,6,23,0.08);
            --accent-start: #6ee7b7;
            --accent-end: #3b82f6;
            --header-h: 64px;
            --aside-w: 260px;
        }
        [data-theme="dark"], .theme-dark{
            --bg: #0b1220;
            --surface: #0f1724;
            --panel: #0f1724;
            --text: #e6eef8;
            --muted: #9aa6bf;
            --border: rgba(230,238,248,0.08);
            --accent-start: #06b6d4;
            --accent-end: #7c3aed;
        }

        html,body{height:100%;font-family:'Inter',system-ui,-apple-system,Segoe UI,Roboto,'Helvetica Neue',Arial;margin:0;background:var(--bg);color:var(--text)}

        /* Shell para sticky footer */
        .app-shell{min-height:100svh;display:flex;flex-direction:column;padding-top:var(--header-h)}
        .app-content{flex:1}
        .app-main{padding:1.5rem}

        /* Header e Aside com variáveis de tema */
        .app-header{background:var(--surface);border-bottom:1px solid var(--border);height:var(--header-h)}
        .app-aside{width:var(--aside-w);background:var(--surface);border-right:1px solid var(--border);min-height:calc(100svh - var(--header-h));padding-top:1rem}
        @media (max-width: 991px){.app-aside{display:none}}

        /* Cards com gradiente e animação */
        .stat-card{background:linear-gradient(120deg,var(--accent-start),var(--accent-end));color:#fff;border-radius:12px;transition:transform .28s ease,box-shadow .28s ease;box-shadow:0 10px 24px rgba(2,6,23,.12)}
        .stat-card:hover{transform:translateY(-6px);box-shadow:0 18px 36px rgba(2,6,23,.18)}
        .stat-card .card-body{backdrop-filter: blur(4px);}

        /* table and footer tweaks */
        .card{background:var(--surface);border:1px solid var(--border)}
        .card .table thead th{border-bottom:1px solid var(--border)}
        footer.app-footer{background:var(--surface);border-top:1px solid var(--border)}

        /* small utilities */
        .muted{color:var(--muted)}

    </style>

    @stack('styles')
</head>
<body>

<!-- Preloader -->
<div id="preloader" class="position-fixed top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="z-index:1055;background:var(--bg)">
    <div class="text-center">
        <div class="spinner-border text-primary" role="status"></div>
        <div class="mt-3 fw-semibold">Carregando...</div>
    </div>
    <style>
        #preloader{transition: opacity .25s ease, visibility .25s ease}
        #preloader.hidden{opacity:0;visibility:hidden}
    </style>
</div>

@include('diretor::partials.header')

<div class="app-shell">
    <div class="app-content d-flex">
        @include('diretor::partials.aside')

        <main class="flex-fill app-main">
            @if(session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @yield('content')
        </main>
    </div>

    @include('diretor::partials.footer')
</div>

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

    // Preloader hide on window load
    window.addEventListener('load', function(){
        const p = document.getElementById('preloader');
        if(p){ p.classList.add('hidden'); setTimeout(()=>p.remove(), 350); }
    });
</script>

@stack('scripts')

</body>
</html>
