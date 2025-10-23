<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Core Admin - @yield('title', 'Painel')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 56px; }
        .sidebar { width: 220px; }
        .content { margin-left: 220px; }
        .card-placeholder { height: 120px; }
        .dark-mode { background:#1e1e2f; color:#ddd }
    </style>
    @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Core Admin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#">Notificações <span class="badge bg-danger">3</span></a></li>
                <li class="nav-item"><a class="nav-link" href="#">Perfil</a></li>
            </ul>
        </div>
    </div>
 </nav>

<div class="d-flex">
    <aside class="sidebar bg-light border-end position-fixed h-100 p-3">
        <h6>Menu</h6>
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link" href="{{ route('core_admin.dashboard') }}"><i class="fa fa-chart-pie me-2"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('core_admin.reports') }}"><i class="fa fa-file-alt me-2"></i> Relatórios</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('core_admin.users') }}"><i class="fa fa-users me-2"></i> Utilizadores</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('core_admin.products') }}"><i class="fa fa-boxes me-2"></i> Produtos</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('core_admin.settings') }}"><i class="fa fa-cog me-2"></i> Configurações</a></li>
        </ul>
        <hr>
        <div>
            <button id="toggleDark" class="btn btn-sm btn-outline-secondary">Modo escuro</button>
        </div>
    </aside>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('toggleDark')?.addEventListener('click', function(){
        document.body.classList.toggle('dark-mode');
    });
</script>
@stack('scripts')
</body>
</html>
