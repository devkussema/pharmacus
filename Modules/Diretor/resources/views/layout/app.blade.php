<!DOCTYPE html>
<html lang="pt-br" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') | Pharmacus Director</title>
    <meta name="description" content="Sistema de gestão farmacêutica profissional">
    
    <!-- Fontes Profissionais -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    
    <style>
        :root {
            /* Sistema de Cores Profissional */
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --secondary: #64748b;
            --success: #059669;
            --warning: #d97706;
            --danger: #dc2626;
            
            /* Superfícies e Fundos */
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-tertiary: #f1f5f9;
            --surface: #ffffff;
            --surface-hover: #f8fafc;
            
            /* Texto */
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-tertiary: #64748b;
            --text-inverse: #ffffff;
            
            /* Bordas e Divisores */
            --border-primary: #e2e8f0;
            --border-secondary: #cbd5e1;
            --divider: #f1f5f9;
            
            /* Sombras */
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            
            /* Layout */
            --header-height: 72px;
            --sidebar-width: 280px;
            --border-radius: 12px;
            --border-radius-sm: 8px;
            
            /* Transições */
            --transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-normal: 300ms cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: 500ms cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        [data-theme="dark"] {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
            --surface: #1e293b;
            --surface-hover: #334155;
            
            --text-primary: #f8fafc;
            --text-secondary: #cbd5e1;
            --text-tertiary: #94a3b8;
            
            --border-primary: #334155;
            --border-secondary: #475569;
            --divider: #334155;
            
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.3);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.3), 0 2px 4px -2px rgb(0 0 0 / 0.3);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.3), 0 4px 6px -4px rgb(0 0 0 / 0.3);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.3), 0 8px 10px -6px rgb(0 0 0 / 0.3);
        }
        
        /* Reset e Base */
        * {
            box-sizing: border-box;
        }
        
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            font-feature-settings: 'cv02', 'cv03', 'cv04', 'cv11';
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        /* Layout Principal */
        .app-layout {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        .app-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            height: var(--header-height);
            background: var(--surface);
            border-bottom: 1px solid var(--border-primary);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        
        .app-body {
            display: flex;
            flex: 1;
            margin-top: var(--header-height);
        }
        
        .app-sidebar {
            width: var(--sidebar-width);
            background: var(--surface);
            border-right: 1px solid var(--border-primary);
            position: fixed;
            top: var(--header-height);
            bottom: 0;
            left: 0;
            overflow-y: auto;
            z-index: 100;
        }
        
        .app-main {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem;
            background: var(--bg-secondary);
            min-height: calc(100vh - var(--header-height));
            display: flex;
            flex-direction: column;
        }
        
        .app-footer {
            margin-left: var(--sidebar-width);
        }
        
        /* Responsivo */
        @media (max-width: 1024px) {
            .app-sidebar {
                transform: translateX(-100%);
                transition: transform var(--transition-normal);
                z-index: 200;
            }
            
            .app-sidebar.open {
                transform: translateX(0);
                box-shadow: var(--shadow-xl);
            }
            
            .app-main {
                margin-left: 0;
            }
            
            .app-footer {
                margin-left: 0;
            }
            
            .sidebar-overlay {
                position: fixed;
                top: var(--header-height);
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 150;
                opacity: 0;
                visibility: hidden;
                transition: all var(--transition-normal);
            }
            
            .sidebar-overlay.show {
                opacity: 1;
                visibility: visible;
            }
        }
        
        /* Componentes */
        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border-primary);
            border-radius: var(--border-radius);
            padding: 1.5rem;
            transition: all var(--transition-normal);
            box-shadow: var(--shadow-sm);
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--success));
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary);
        }
        
        .card-modern {
            background: var(--surface);
            border: 1px solid var(--border-primary);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            transition: box-shadow var(--transition-normal);
        }
        
        .card-modern:hover {
            box-shadow: var(--shadow-md);
        }
        
        /* Utilitários */
        .text-primary { color: var(--text-primary) !important; }
        .text-secondary { color: var(--text-secondary) !important; }
        .text-tertiary { color: var(--text-tertiary) !important; }
        .text-brand { color: var(--primary) !important; }
        
        .bg-surface { background: var(--surface) !important; }
        .bg-hover { background: var(--surface-hover) !important; }
        
        .border-primary { border-color: var(--border-primary) !important; }
        
        .btn-modern {
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius-sm);
            font-weight: 500;
            font-size: 0.875rem;
            transition: all var(--transition-fast);
            border: none;
            cursor: pointer;
        }
        
        .btn-primary {
            background: var(--primary);
            color: var(--text-inverse);
        }
        
        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
        
        .loading-shimmer {
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }
        
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Preloader Profissional -->
    <div id="preloader" class="preloader">
        <div class="preloader-content">
            <div class="preloader-logo">
                <i class="fa-solid fa-capsules fa-2x text-brand"></i>
            </div>
            <div class="preloader-spinner"></div>
            <div class="preloader-text">Inicializando Pharmacus...</div>
        </div>
    </div>

    <div class="app-layout">
        @include('diretor::partials.header')
        
        <div class="app-body">
            @include('diretor::partials.aside')
            
            <main class="app-main">
                @if(session('success'))
                    <div class="alert alert-success modern">
                        <i class="fa-solid fa-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger modern">
                        <i class="fa-solid fa-exclamation-circle me-2"></i>
                        {{ session('error') }}
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
        
        @include('diretor::partials.footer')
    </div>
    
    <style>
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--bg-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: all var(--transition-normal);
        }
        
        .preloader.fade-out {
            opacity: 0;
            visibility: hidden;
        }
        
        .preloader-content {
            text-align: center;
        }
        
        .preloader-logo {
            margin-bottom: 1.5rem;
            animation: pulse 2s infinite;
        }
        
        .preloader-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid var(--border-primary);
            border-top: 3px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }
        
        .preloader-text {
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .alert.modern {
            border: none;
            border-radius: var(--border-radius);
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: var(--shadow-sm);
        }
    </style>

    <script>
        // Sistema de Tema Profissional
        class ThemeManager {
            constructor() {
                this.storageKey = 'pharmacus-theme';
                this.init();
            }
            
            init() {
                const saved = localStorage.getItem(this.storageKey);
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                const theme = saved || (prefersDark ? 'dark' : 'light');
                this.setTheme(theme);
                
                // Escuta mudanças na preferência do sistema
                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                    if (!localStorage.getItem(this.storageKey)) {
                        this.setTheme(e.matches ? 'dark' : 'light');
                    }
                });
            }
            
            setTheme(theme) {
                document.documentElement.setAttribute('data-theme', theme);
                localStorage.setItem(this.storageKey, theme);
                this.updateThemeIcon(theme);
            }
            
            toggle() {
                const current = document.documentElement.getAttribute('data-theme');
                const next = current === 'dark' ? 'light' : 'dark';
                this.setTheme(next);
            }
            
            updateThemeIcon(theme) {
                const icon = document.querySelector('[data-theme-toggle] i');
                if (icon) {
                    icon.className = theme === 'dark' 
                        ? 'fa-solid fa-sun' 
                        : 'fa-solid fa-moon';
                }
            }
        }
        
        // Inicialização da aplicação
        document.addEventListener('DOMContentLoaded', function() {
            // Inicializar tema
            window.themeManager = new ThemeManager();
            
            // Remover preloader
            setTimeout(() => {
                const preloader = document.getElementById('preloader');
                if (preloader) {
                    preloader.classList.add('fade-out');
                    setTimeout(() => preloader.remove(), 300);
                }
            }, 1000);
            
            // Inicializar tooltips (se Bootstrap estiver disponível)
            if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
                    try { new bootstrap.Tooltip(el); } catch (err) { /* ignore */ }
                });
            }

            // Dropdown do usuário (fallback sem depender do Bootstrap JS)
            (function() {
                const userMenus = document.querySelectorAll('.user-menu');
                userMenus.forEach(menu => {
                    const btn = menu.querySelector('.user-btn');
                    const dropdown = menu.querySelector('.user-dropdown');
                    if (!btn || !dropdown) return;

                    // Toggle on click
                    btn.addEventListener('click', function(e) {
                        const expanded = btn.getAttribute('aria-expanded') === 'true';
                        btn.setAttribute('aria-expanded', expanded ? 'false' : 'true');
                        dropdown.classList.toggle('show');
                        menu.classList.toggle('show');
                        e.stopPropagation();
                    });

                    // Close when clicking outside
                    document.addEventListener('click', function(ev) {
                        if (!menu.contains(ev.target)) {
                            btn.setAttribute('aria-expanded', 'false');
                            dropdown.classList.remove('show');
                            menu.classList.remove('show');
                        }
                    });

                    // Close on ESC
                    document.addEventListener('keydown', function(ev) {
                        if (ev.key === 'Escape') {
                            btn.setAttribute('aria-expanded', 'false');
                            dropdown.classList.remove('show');
                            menu.classList.remove('show');
                        }
                    });
                });
            })();
            
            // Sidebar toggle para mobile
            const sidebarToggle = document.querySelector('[data-sidebar-toggle]');
            const sidebar = document.querySelector('.app-sidebar');
            
            if (sidebarToggle && sidebar) {
                // Criar overlay se não existir
                let overlay = document.querySelector('.sidebar-overlay');
                if (!overlay) {
                    overlay = document.createElement('div');
                    overlay.className = 'sidebar-overlay';
                    document.body.appendChild(overlay);
                }
                
                sidebarToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('open');
                    overlay.classList.toggle('show');
                });
                
                overlay.addEventListener('click', () => {
                    sidebar.classList.remove('open');
                    overlay.classList.remove('show');
                });
            }
            
                        // Atalho de teclado para busca (Cmd+K / Ctrl+K)
            document.addEventListener('keydown', function(e) {
                try {
                    if ((e.metaKey || e.ctrlKey) && e.key && e.key.toLowerCase() === 'k') {
                        e.preventDefault();
                        const searchInput = document.querySelector('#globalSearch');
                        if (searchInput) {
                            try { searchInput.focus({ preventScroll: true }); } catch (err) { searchInput.focus(); }
                            if (typeof searchInput.select === 'function') {
                                searchInput.select();
                            }
                        }
                    }
                } catch (err) {
                    console.warn('Atalho de busca falhou', err);
                }
            });
            
            // Busca Global
            let searchTimeout;
            const globalSearchInput = document.getElementById('globalSearch');
            const searchResultsEl = document.getElementById('searchResults');
            
            if (globalSearchInput && searchResultsEl) {
                globalSearchInput.addEventListener('input', function(e) {
                    const query = e.target.value.trim();
                    
                    clearTimeout(searchTimeout);
                    
                    if (query.length < 2) {
                        searchResultsEl.classList.remove('active');
                        return;
                    }
                    
                    searchTimeout = setTimeout(() => {
                        performGlobalSearch(query);
                    }, 300);
                });
                
                // Fechar ao clicar fora
                document.addEventListener('click', function(e) {
                    if (!e.target.closest('.search-container')) {
                        searchResultsEl.classList.remove('active');
                    }
                });
            }
            
            async function performGlobalSearch(query) {
                const searchResultsEl = document.getElementById('searchResults');
                
                searchResultsEl.innerHTML = '<div class="search-result-empty"><i class="fa-solid fa-spinner fa-spin"></i><p>Pesquisando...</p></div>';
                searchResultsEl.classList.add('active');
                
                try {
                    const response = await fetch(`{{ url('diretor/busca-global') }}?q=${encodeURIComponent(query)}`);
                    const data = await response.json();
                    
                    if (!data.success || (data.produtos.length === 0 && data.paginas.length === 0)) {
                        searchResultsEl.innerHTML = `
                            <div class="search-result-empty">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <p>Nenhum resultado encontrado</p>
                            </div>
                        `;
                        return;
                    }
                    
                    let html = '';
                    
                    // Produtos
                    if (data.produtos.length > 0) {
                        html += '<div class="search-results-header">Medicamentos</div>';
                        data.produtos.forEach(p => {
                            html += `
                                <a href="{{ url('diretor/estoque') }}/${p.id}" class="search-result-item">
                                    <div class="search-result-icon produto">
                                        <i class="fa-solid fa-pills"></i>
                                    </div>
                                    <div class="search-result-content">
                                        <div class="search-result-title">${p.designacao}</div>
                                        <div class="search-result-subtitle">${p.categoria} • Estoque: ${p.quantidade}</div>
                                    </div>
                                </a>
                            `;
                        });
                    }
                    
                    // Páginas
                    if (data.paginas.length > 0) {
                        html += '<div class="search-results-header">Páginas</div>';
                        data.paginas.forEach(p => {
                            html += `
                                <a href="${p.url}" class="search-result-item">
                                    <div class="search-result-icon pagina">
                                        <i class="${p.icon}"></i>
                                    </div>
                                    <div class="search-result-content">
                                        <div class="search-result-title">${p.nome}</div>
                                        <div class="search-result-subtitle">${p.descricao}</div>
                                    </div>
                                </a>
                            `;
                        });
                    }
                    
                    searchResultsEl.innerHTML = html;
                } catch (error) {
                    console.error('Erro na busca:', error);
                    searchResultsEl.innerHTML = `
                        <div class="search-result-empty">
                            <i class="fa-solid fa-exclamation-triangle"></i>
                            <p>Erro ao pesquisar</p>
                        </div>
                    `;
                }
            }
        });
        
        // Funções globais
        window.toggleTheme = () => window.themeManager?.toggle();
    </script>
    
    @stack('scripts')

</body>
</html>

```
        });
        
        // Funções globais
        window.toggleTheme = () => window.themeManager?.toggle();
    </script>
    
    @stack('scripts')

</body>
</html>
