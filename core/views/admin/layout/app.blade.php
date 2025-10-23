<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Core Admin - @yield('title', 'Painel')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root{
          --bg:#ffffff; --fg:#1f2937; --muted:#6b7280; --primary:#2563eb; --card:#f9fafb; --border:#e5e7eb;
        }
        body.dark-mode{ --bg:#0f172a; --fg:#e5e7eb; --muted:#94a3b8; --primary:#3b82f6; --card:#111827; --border:#1f2937; }
        body{ padding-top:56px; background:var(--bg); color:var(--fg); font-family:'Inter', system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, 'Noto Sans', 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; }
        .navbar{ background:var(--primary)!important; }
        .sidebar{ width:240px; background:var(--bg)!important; }
        .content{ margin-left:240px; }
        .card{ background:var(--card); border-color:var(--border); }
        .text-muted{ color:var(--muted)!important; }
        .card-placeholder{ height:120px; }
        #coreOverlay{ position:fixed; inset:0; display:none; background:rgba(0,0,0,.45); z-index:1050; align-items:center; justify-content:center }
        /* Skeleton */
        .skeleton{ background:linear-gradient(90deg, rgba(0,0,0,0.06), rgba(0,0,0,0.12), rgba(0,0,0,0.06)); animation: shimmer 1.2s infinite; background-size:200% 100%; border-radius:6px; }
        @keyframes shimmer{ 0%{background-position:-100% 0} 100%{background-position:100% 0} }
        .sidebar-collapsed .sidebar{ display:none }
        .sidebar-collapsed .content{ margin-left:0 }
    </style>
    @stack('styles')
    @yield('head')
</head>
<body>

    @include('core_admin::partials.header')

    <div class="d-flex">
        @include('core_admin::partials.sidebar')

        <main class="content container-fluid p-4">
            @if(session('status'))
                <div class="alert alert-info">{{ session('status') }}</div>
            @endif

            @yield('content')
            <footer class="mt-5">
                <small>© {{ date('Y') }} Pharmacus — Core Admin</small>
            </footer>
        </main>
    </div>

        <div id="coreOverlay"><div class="text-white">@include('core_admin::components.spinner')</div></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
        <script src="{{ asset('assets/core_admin.js') }}"></script>
        <script>
            // Inicialização de tooltips
            const tooltipTriggerList=[].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(el=>new bootstrap.Tooltip(el));
        </script>
    @stack('scripts')
</body>
</html>
