<aside class="sidebar bg-light border-end position-fixed h-100 p-3" id="coreSidebar">
    <h6>Menu</h6>
    <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link" href="{{ route('core_admin.dashboard') }}"><i class="fa fa-chart-pie me-2"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('core_admin.reports') }}"><i class="fa fa-file-alt me-2"></i> Relatórios</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('core_admin.users') }}"><i class="fa fa-users me-2"></i> Utilizadores</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('core_admin.products') }}"><i class="fa fa-boxes me-2"></i> Produtos</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('core_admin.settings') }}"><i class="fa fa-cog me-2"></i> Configurações</a></li>
    </ul>

    <hr>
    <div class="d-grid">
        <button id="toggleDarkBtn" class="btn btn-sm btn-outline-secondary">Modo escuro</button>
    </div>
</aside>
