<header class="app-header">
    <div class="header-container">
        <div class="header-left">
            <button class="sidebar-toggle" data-sidebar-toggle>
                <i class="fa-solid fa-bars"></i>
            </button>
            
            <div class="brand">
                <a href="{{ route('diretor.index') }}" class="brand-link">
                    <div class="brand-icon">
                        <i class="fa-solid fa-capsules"></i>
                    </div>
                    <div class="brand-text">
                        <div class="brand-title">Pharmacus</div>
                        <div class="brand-subtitle">Director</div>
                    </div>
                </a>
            </div>
        </div>
        
        <div class="header-center">
            <div class="search-container">
                <div class="search-input-group">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="search" class="search-input" placeholder="Pesquisar medicamentos, fornecedores..." autocomplete="off">
                    <kbd class="search-shortcut">⌘K</kbd>
                </div>
            </div>
        </div>
        
        <div class="header-right">
            <div class="header-actions">
                <button class="action-btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Notificações">
                    <i class="fa-solid fa-bell"></i>
                    <span class="badge">3</span>
                </button>
                
                <button class="action-btn" data-theme-toggle onclick="toggleTheme()" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Alternar tema">
                    <i class="fa-solid fa-moon"></i>
                </button>
                
                <div class="user-menu">
                    <button class="user-btn" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name=Director&background=2563eb&color=fff&size=40&font-size=0.5" class="user-avatar" alt="Diretor">
                        <div class="user-info">
                            <div class="user-name">Dr. Diretor</div>
                            <div class="user-role">Administrador</div>
                        </div>
                        <i class="fa-solid fa-chevron-down user-chevron"></i>
                    </button>
                    
                    <ul class="dropdown-menu dropdown-menu-end user-dropdown">
                        <li class="dropdown-header">
                            <div class="dropdown-user-info">
                                <img src="https://ui-avatars.com/api/?name=Director&background=2563eb&color=fff&size=40&font-size=0.5" alt="Diretor">
                                <div>
                                    <div class="dropdown-user-name">Dr. Diretor</div>
                                    <div class="dropdown-user-email">diretor@farmacia.ao</div>
                                </div>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user me-2"></i>Meu Perfil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-gear me-2"></i>Configurações</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-question-circle me-2"></i>Ajuda</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#"><i class="fa-solid fa-right-from-bracket me-2"></i>Terminar Sessão</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
.header-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    height: 100%;
    padding: 0 1.5rem;
    gap: 1rem;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.sidebar-toggle {
    display: none;
    background: none;
    border: none;
    color: var(--text-secondary);
    font-size: 1.125rem;
    padding: 0.5rem;
    border-radius: var(--border-radius-sm);
    cursor: pointer;
    transition: all var(--transition-fast);
}

.sidebar-toggle:hover {
    background: var(--surface-hover);
    color: var(--text-primary);
}

@media (max-width: 1024px) {
    .sidebar-toggle {
        display: block;
    }
}

.brand-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
    color: inherit;
}

.brand-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--primary), var(--success));
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.125rem;
}

.brand-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1;
}

.brand-subtitle {
    font-size: 0.75rem;
    color: var(--text-tertiary);
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.header-center {
    flex: 1;
    max-width: 600px;
}

.search-container {
    position: relative;
}

.search-input-group {
    position: relative;
    display: flex;
    align-items: center;
}

.search-input {
    width: 100%;
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
    background: var(--surface);
    color: var(--text-primary);
    font-size: 0.875rem;
    transition: all var(--transition-fast);
}

.search-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgb(37 99 235 / 0.1);
}

.search-icon {
    position: absolute;
    left: 0.875rem;
    color: var(--text-tertiary);
    font-size: 0.875rem;
    z-index: 1;
}

.search-shortcut {
    position: absolute;
    right: 0.75rem;
    background: var(--bg-tertiary);
    color: var(--text-tertiary);
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-size: 0.75rem;
    font-family: 'JetBrains Mono', monospace;
    border: 1px solid var(--border-primary);
}

.header-right {
    display: flex;
    align-items: center;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.action-btn {
    position: relative;
    background: none;
    border: none;
    color: var(--text-secondary);
    font-size: 1.125rem;
    padding: 0.625rem;
    border-radius: var(--border-radius-sm);
    cursor: pointer;
    transition: all var(--transition-fast);
}

.action-btn:hover {
    background: var(--surface-hover);
    color: var(--text-primary);
}

.action-btn .badge {
    position: absolute;
    top: 0.25rem;
    right: 0.25rem;
    background: var(--danger);
    color: white;
    font-size: 0.625rem;
    padding: 0.125rem 0.375rem;
    border-radius: 10px;
    font-weight: 600;
    min-width: 1.125rem;
    text-align: center;
}

.user-btn {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    background: none;
    border: none;
    padding: 0.5rem;
    border-radius: var(--border-radius-sm);
    cursor: pointer;
    transition: all var(--transition-fast);
}

.user-btn:hover {
    background: var(--surface-hover);
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid var(--border-primary);
}

.user-info {
    text-align: left;
}

.user-name {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1;
}

.user-role {
    font-size: 0.75rem;
    color: var(--text-tertiary);
    margin-top: 0.125rem;
}

.user-chevron {
    color: var(--text-tertiary);
    font-size: 0.75rem;
    transition: transform var(--transition-fast);
}

.user-btn[aria-expanded="true"] .user-chevron {
    transform: rotate(180deg);
}

.user-dropdown {
    min-width: 280px;
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-xl);
    background: var(--surface);
    margin-top: 0.5rem;
}

/* Remover marcadores padrão da lista e ajustar espaçamento */
.user-dropdown,
.user-dropdown li {
    list-style: none !important;
    padding-left: 0 !important;
    margin: 0 !important;
}

.user-dropdown { padding: 0; }

/* Garantir que o dropdown está oculto por padrão e só mostra quando ativado.
   Suporte para diferentes triggers: Bootstrap adiciona .show na lista ou aria-expanded no botão.
*/
.user-dropdown {
    display: none !important;
    opacity: 0;
    transform: translateY(-6px);
    transition: opacity 160ms var(--transition-ease), transform 160ms var(--transition-ease);
    pointer-events: none;
    z-index: 1050;
}

/* Mostrar quando o Bootstrap adicionar a classe .show na própria lista */
.user-dropdown.show {
    display: block !important;
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}

/* Mostrar quando o botão estiver expandido (fallback caso o JS não adicione .show ao menu) */
.user-btn[aria-expanded="true"] + .user-dropdown {
    display: block !important;
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}

/* Se por algum motivo o plugin adicionar .show ao pai (.user-menu), suportar também */
.user-menu.show .user-dropdown {
    display: block !important;
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}

.user-dropdown .dropdown-header {
    padding: 1rem;
    border-bottom: 1px solid var(--border-primary);
}

.user-dropdown .dropdown-item {
    padding: 0.75rem 1rem;
    color: var(--text-primary);
    transition: all var(--transition-fast);
    display: flex;
    align-items: center;
    font-size: 0.875rem;
}

.user-dropdown .dropdown-item:hover {
    background: var(--surface-hover);
    color: var(--text-primary);
}

.user-dropdown .dropdown-item.text-danger {
    color: var(--danger) !important;
}

.user-dropdown .dropdown-item.text-danger:hover {
    background: rgba(220, 38, 38, 0.1);
}

.user-dropdown .dropdown-divider {
    margin: 0;
    border-color: var(--border-primary);
}

.dropdown-user-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem 0;
}

.dropdown-user-info img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

.dropdown-user-name {
    font-weight: 600;
    color: var(--text-primary);
}

.dropdown-user-email {
    font-size: 0.875rem;
    color: var(--text-tertiary);
}

@media (max-width: 768px) {
    .header-center {
        display: none;
    }
    
    .user-info {
        display: none;
    }
}
</style>
