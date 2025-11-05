<aside class="app-sidebar">
    <div class="sidebar-content">
        <div class="sidebar-nav-container">
            <nav class="sidebar-nav">
                <div class="nav-section">
                    <div class="nav-section-title">Dashboard</div>
                    <a href="{{ route('diretor.index') }}" class="nav-item {{ request()->routeIs('diretor.index') ? 'active' : '' }}">
                        <div class="nav-item-icon">
                            <i class="fa-solid fa-chart-line"></i>
                        </div>
                        <span class="nav-item-text">Visão Geral</span>
                    </a>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-title">Gestão</div>
                    <a href="#" class="nav-item">
                        <div class="nav-item-icon">
                            <i class="fa-solid fa-pills"></i>
                        </div>
                        <span class="nav-item-text">Medicamentos</span>
                        <span class="nav-item-badge">245</span>
                    </a>
                    <a href="{{ route('diretor.estoque.index') }}" class="nav-item {{ request()->routeIs('diretor.estoque.*') ? 'active' : '' }}">
                        <div class="nav-item-icon">
                            <i class="fa-solid fa-warehouse"></i>
                        </div>
                        <span class="nav-item-text">Estoque</span>
                        <span class="nav-item-notification"></span>
                    </a>
                    <a href="{{ route('diretor.fornecedores.index') }}" class="nav-item {{ request()->routeIs('diretor.fornecedores.*') ? 'active' : '' }}">
                        <div class="nav-item-icon">
                            <i class="fa-solid fa-truck-field"></i>
                        </div>
                        <span class="nav-item-text">Fornecedores</span>
                    </a>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-title">Vendas & Clientes</div>
                    <a href="#" class="nav-item">
                        <div class="nav-item-icon">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>
                        <span class="nav-item-text">Vendas</span>
                    </a>
                    <a href="#" class="nav-item">
                        <div class="nav-item-icon">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <span class="nav-item-text">Clientes</span>
                    </a>
                    <a href="#" class="nav-item">
                        <div class="nav-item-icon">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                        </div>
                        <span class="nav-item-text">Faturas</span>
                    </a>
                </div>
                
                <div class="nav-section">
                    <div class="nav-section-title">Relatórios</div>
                    <a href="#" class="nav-item">
                        <div class="nav-item-icon">
                            <i class="fa-solid fa-chart-bar"></i>
                        </div>
                        <span class="nav-item-text">Análise de Vendas</span>
                    </a>
                    <a href="#" class="nav-item">
                        <div class="nav-item-icon">
                            <i class="fa-solid fa-chart-pie"></i>
                        </div>
                        <span class="nav-item-text">Performance</span>
                    </a>
                </div>
            </nav>
        </div>
        
        <div class="sidebar-footer">
            <div class="sidebar-help">
                <div class="help-icon">
                    <i class="fa-solid fa-question-circle"></i>
                </div>
                <div class="help-content">
                    <div class="help-title">Precisa de ajuda?</div>
                    <div class="help-text">Consulte nossa documentação</div>
                </div>
            </div>
        </div>
    </div>
</aside>

<style>
.sidebar-content {
    display: flex;
    flex-direction: column;
    height: 100%;
}

.sidebar-nav-container {
    flex: 1;
    overflow-y: auto;
    padding: 1.5rem 0;
}

.sidebar-nav-container::-webkit-scrollbar {
    width: 6px;
}

.sidebar-nav-container::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar-nav-container::-webkit-scrollbar-thumb {
    background: var(--border-secondary);
    border-radius: 3px;
}

.sidebar-nav-container::-webkit-scrollbar-thumb:hover {
    background: var(--text-tertiary);
}

.sidebar-nav {
    padding: 0 1rem;
}

.nav-section {
    margin-bottom: 2rem;
}

.nav-section-title {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--text-tertiary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.75rem;
    padding: 0 0.75rem;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    margin-bottom: 0.25rem;
    border-radius: var(--border-radius-sm);
    color: var(--text-secondary);
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all var(--transition-fast);
    position: relative;
}

.nav-item:hover {
    background: var(--surface-hover);
    color: var(--text-primary);
    transform: translateX(2px);
}

.nav-item.active {
    background: rgba(37, 99, 235, 0.1);
    color: var(--primary);
    font-weight: 600;
}

.nav-item.active::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 3px;
    background: var(--primary);
    border-radius: 0 2px 2px 0;
}

.nav-item.active .nav-item-icon {
    color: var(--primary);
}

.nav-item-icon {
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.nav-item-text {
    flex: 1;
}

.nav-item-badge {
    background: var(--bg-tertiary);
    color: var(--text-tertiary);
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.125rem 0.5rem;
    border-radius: 12px;
    border: 1px solid var(--border-primary);
}

.nav-item-notification {
    width: 8px;
    height: 8px;
    background: var(--warning);
    border-radius: 50%;
    border: 2px solid var(--surface);
}

.sidebar-footer {
    padding: 1rem;
    border-top: 1px solid var(--border-primary);
}

.sidebar-help {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    background: var(--bg-secondary);
    border-radius: var(--border-radius);
    border: 1px solid var(--border-primary);
}

.help-icon {
    width: 32px;
    height: 32px;
    background: var(--primary);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
    flex-shrink: 0;
}

.help-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1;
}

.help-text {
    font-size: 0.75rem;
    color: var(--text-tertiary);
    margin-top: 0.25rem;
}

@media (max-width: 1024px) {
    .nav-section-title {
        font-size: 0.6875rem;
    }
    
    .nav-item {
        padding: 0.625rem;
        font-size: 0.8125rem;
    }
    
    .sidebar-help {
        padding: 0.75rem;
    }
}
</style>
