<aside class="position-fixed app-aside">
    <div class="p-3 h-100 d-flex flex-column">
        <div class="mb-4">
            <h6 class="text-muted small">Menu</h6>
        </div>

        <nav class="nav flex-column mb-3">
            <a class="nav-link d-flex align-items-center mb-1 text-dark" href="{{ route('diretor.index') }}"><i class="fa-solid fa-chart-pie me-2"></i>Visão Geral</a>
            <a class="nav-link d-flex align-items-center mb-1 text-dark" href="#"><i class="fa-solid fa-boxes-stacked me-2"></i>Inventário</a>
            <a class="nav-link d-flex align-items-center mb-1 text-dark" href="#"><i class="fa-solid fa-truck-fast me-2"></i>Fornecedores</a>
            <a class="nav-link d-flex align-items-center mb-1 text-dark" href="#"><i class="fa-solid fa-receipt me-2"></i>Vendas</a>
        </nav>

        <div class="mt-auto small text-muted">
            <div>&copy; {{ date('Y') }} Farmácia</div>
        </div>
    </div>
</aside>
