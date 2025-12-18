@extends('layout.app')

@section('titulo', 'Estoque ' . $ah->nome)

@section('content')
    <style>
        /* ========== Design Moderno Página Estoque ========== */
        .estoque-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 1rem;
        }

        .estoque-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 12px 12px 0 0;
            margin-bottom: 0;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
        }

        .estoque-header h3 {
            color: white;
            font-weight: 600;
            margin: 0;
            font-size: 1.75rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .estoque-header h3 i {
            font-size: 1.5rem;
        }

        .estoque-card {
            background: white;
            border-radius: 0 0 12px 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .estoque-card .card-body {
            padding: 2rem;
        }

        /* Toolbar de Ações */
        .toolbar-actions {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .toolbar-actions .search-box {
            flex: 1;
            min-width: 250px;
            max-width: 400px;
        }

        .toolbar-actions .search-box input {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.2s;
        }

        .toolbar-actions .search-box input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .toolbar-actions .action-group {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .toolbar-actions .btn {
            padding: 0.75rem 1.25rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .toolbar-actions .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .toolbar-actions .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }

        /* Tabela Moderna */
        .table-responsive {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
            background: white;
        }

        .custom-table {
            margin: 0;
            width: 100%;
        }

        .custom-table thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .custom-table thead th {
            color: white;
            font-weight: 700;
            padding: 1.125rem 1rem;
            border: none;
            text-transform: uppercase;
            font-size: 0.8125rem;
            letter-spacing: 0.8px;
            white-space: nowrap;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .custom-table thead th i {
            margin-right: 0.5rem;
            opacity: 0.9;
        }

        .custom-table tbody tr {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            border-bottom: 1px solid #e9ecef;
        }

        .custom-table tbody tr:hover {
            background: linear-gradient(90deg, rgba(102, 126, 234, 0.06) 0%, rgba(255,255,255,0) 100%);
            transform: translateX(6px);
            box-shadow: -6px 0 0 0 #667eea, 0 2px 8px rgba(102, 126, 234, 0.15);
        }

        .custom-table tbody td {
            padding: 1.125rem 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.875rem;
            color: #2d3748;
            transition: padding-left 0.3s;
        }

        .custom-table tbody tr:hover td {
            padding-left: 1.5rem;
        }

        .custom-table tbody td:first-child {
            font-weight: 600;
            color: #1a202c;
            font-size: 0.9rem;
        }

        /* Action Row */
        .action-row {
            background: linear-gradient(135deg, #f8f9fa 0%, #e2e8f0 100%);
            border-left: 4px solid #667eea;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            flex-wrap: wrap;
        }

        .action-buttons button {
            margin: 0;
            font-size: 0.7rem;
            padding: 0.3rem 0.55rem;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            white-space: nowrap;
        }

        .action-buttons button i {
            font-size: 0.7rem;
        }

        .action-buttons button:hover:not(:disabled) {
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(0,0,0,0.12);
        }

        /* Impedir que os botões ocupem toda a largura (algum CSS global estava forçando isso) */
        .action-buttons .btn {
            flex: none !important;
        }

        /* Ajustes de largura das colunas da tabela */
        .table-produto thead th:nth-child(1) { width: 25%; min-width: 200px; } /* Designação */
        .table-produto thead th:nth-child(2) { width: 12%; min-width: 100px; } /* Dosagem */
        .table-produto thead th:nth-child(3) { width: 12%; min-width: 110px; text-align: center; } /* Status */
        .table-produto thead th:nth-child(4) { width: 10%; min-width: 90px; text-align: center; } /* Quantidade */
        .table-produto thead th:nth-child(5) { width: 15%; min-width: 120px; } /* Lote */
        .table-produto thead th:nth-child(6) { width: 13%; min-width: 110px; } /* Expiração */
        .table-produto thead th:nth-child(7) { width: 13%; min-width: 100px; } /* Ações */

        .table-produto tbody td:nth-child(3),
        .table-produto tbody td:nth-child(4) {
            text-align: center;
        }

        /* Forçar layout fixo para melhor alinhamento dos cabeçalhos com colunas */
        .table-produto {
            table-layout: fixed;
            width: 100%;
        }

        /* Reforçar estilos dos botões inline (maior especificidade) */
        .table-produto .action-row .action-buttons .btn,
        .table-produto .action-row .action-buttons button {
            display: inline-flex !important;
            width: auto !important;
            max-width: 160px !important;
            padding: 0.35rem 0.65rem !important;
            font-size: 0.78rem !important;
            white-space: nowrap;
        }

        /* Botão Sincronizar Global */
        #btnSincronizarGlobal {
            display: inline-flex;
            animation: fadeInDown 0.3s ease-in-out;
        }

        #btnSincronizarGlobal.hidden {
            display: none;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Badges de Status */
        .badge {
            padding: 0.5rem 0.875rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.8125rem;
        }

        /* Overlay de loading */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(4px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-overlay.active {
            display: flex;
        }

        .loading-spinner {
            border: 4px solid rgba(255,255,255,0.2);
            border-top: 4px solid white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Breadcrumb Moderno */
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 1.5rem;
        }

        .breadcrumb-item {
            font-size: 0.9375rem;
            color: #718096;
        }

        .breadcrumb-item.active {
            color: #2d3748;
            font-weight: 600;
        }

        .breadcrumb-item a {
            color: #667eea;
            text-decoration: none;
            transition: color 0.2s;
        }

        .breadcrumb-item a:hover {
            color: #764ba2;
        }

        /* Botões de Ferramentas (PDF, etc) */
        .tool-buttons {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .tool-buttons a {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 8px;
            transition: all 0.2s;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .tool-buttons a:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        /* ========== Modal Estilo Offcanvas ========== */
        .modal-offcanvas-style .modal-dialog {
            position: fixed;
            margin: 0;
            right: 0;
            top: 0;
            height: 100vh;
            max-width: 500px;
            width: 100%;
            transform: translateX(100%);
            transition: transform 0.3s ease-out;
        }

        .modal-offcanvas-style.show .modal-dialog {
            transform: translateX(0);
        }

        .modal-offcanvas-style .modal-content {
            height: 100%;
            border: 0;
            border-radius: 0;
            box-shadow: -5px 0 25px rgba(0,0,0,0.15);
        }

        .modal-offcanvas-style .modal-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 1.5rem;
        }

        .modal-offcanvas-style .modal-header .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
        }

        .modal-offcanvas-style .modal-header .btn-close:hover {
            opacity: 1;
        }

        .modal-offcanvas-style .modal-title {
            font-weight: 600;
            font-size: 1.25rem;
        }

        .modal-offcanvas-style .modal-body {
            padding: 2rem;
            overflow-y: auto;
        }

        .modal-offcanvas-style .form-label {
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 0.5rem;
        }

        .modal-offcanvas-style .form-control,
        .modal-offcanvas-style textarea {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.75rem;
            transition: all 0.2s;
        }

        .modal-offcanvas-style .form-control:focus,
        .modal-offcanvas-style textarea:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .modal-offcanvas-style .btn {
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .modal-offcanvas-style .btn-success {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }

        .modal-offcanvas-style .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        /* ========== Toast Notifications ========== */
        .toast-container-custom {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 10000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .toast-custom {
            min-width: 300px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideInRight 0.3s ease-out;
            opacity: 0;
            transform: translateX(100%);
        }

        .toast-custom.show {
            opacity: 1;
            transform: translateX(0);
        }

        .toast-custom.hiding {
            animation: slideOutRight 0.3s ease-in forwards;
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideOutRight {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(100%);
            }
        }

        .toast-custom .toast-icon {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            flex-shrink: 0;
        }

        .toast-custom.toast-success .toast-icon {
            background: #d1fae5;
            color: #065f46;
        }

        .toast-custom.toast-error .toast-icon {
            background: #fee2e2;
            color: #991b1b;
        }

        .toast-custom.toast-info .toast-icon {
            background: #dbeafe;
            color: #1e40af;
        }

        .toast-custom.toast-warning .toast-icon {
            background: #fef3c7;
            color: #92400e;
        }

        .toast-custom .toast-content {
            flex: 1;
        }

        .toast-custom .toast-title {
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 2px;
        }

        .toast-custom.toast-success .toast-title {
            color: #065f46;
        }

        .toast-custom.toast-error .toast-title {
            color: #991b1b;
        }

        .toast-custom.toast-info .toast-title {
            color: #1e40af;
        }

        .toast-custom.toast-warning .toast-title {
            color: #92400e;
        }

        .toast-custom .toast-message {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .toast-custom .toast-close {
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            padding: 0;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s;
        }

        .toast-custom .toast-close:hover {
            color: #4b5563;
        }

        /* Spinner personalizado */
        .spinner-custom {
            display: inline-block;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }
    </style>

    <!-- Overlay de Loading -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- Toast Container -->
    <div class="toast-container-custom" id="toastContainer"></div>

    <div class="content estoque-container">
        @include('partials.session')

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('a_h.index') }}"><i class="fas fa-hospital me-1"></i>Áreas Hospitalares</a></li>
                <li class="breadcrumb-item active" aria-current="page">Estoque {{ $ah->nome }}</li>
            </ol>
        </nav>

        <!-- Header com Gradiente -->
        <div class="estoque-header">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-white bg-opacity-25 p-3">
                        <i class="fas fa-boxes fa-lg text-white"></i>
                    </div>
                    <div>
                        <h3 class="mb-0">
                            <i class="fas fa-warehouse"></i>
                            Estoque {{ $ah->nome }}
                        </h3>
                        <small style="color: rgba(255,255,255,0.9);">Gestão completa de produtos e movimentações</small>
                    </div>
                </div>
                <div class="tool-buttons">
                    <a href="{{ route('print.view', ['estoque_id' => $ah->id]) }}"
                       id="imprimir-pagina"
                       target="_blank"
                       title="Exportar PDF">
                        <img src="{{ asset('prepharma/img/icons/pdf-icon-01.svg') }}" alt="PDF">
                    </a>
                </div>
            </div>
        </div>

        <!-- Card Principal -->
        <div class="estoque-card">
            <div class="card-body">
                <!-- Toolbar de Ações -->
                <div class="toolbar-actions">
                    <div class="search-box">
                        <form id="form_search" method="POST">
                            <input type="text"
                                   id="search-table"
                                   class="form-control"
                                   placeholder="🔍 Pesquisar produtos...">
                        </form>
                    </div>
                    <div class="action-group">
                        <!-- Botão Atualizar Estoque -->
                        <button id="btnAtualizarEstoque"
                                class="btn btn-outline-primary"
                                title="Atualizar lista de produtos">
                            <i class="fas fa-sync-alt"></i>
                            <span>Atualizar</span>
                        </button>

                        <!-- Botão Sincronizar Global -->
                        <button id="btnSincronizarGlobal"
                                class="btn btn-outline-secondary"
                                title="Sincronizar todos os produtos (Cmd+Alt+S no Mac ou Ctrl+Alt+S no Windows)">
                            <i class="fas fa-sync"></i>
                            <span>Sincronizar Todos</span>
                            <span id="btnSyncSpinner" style="display:none;">
                                <span class="spinner-custom"></span>
                            </span>
                        </button>

                        @if (isAdministrator() or auth()->user()->pode_cadastrar_produtos)
                            <button onclick="location.href = '{{ route('estoque.cadastrar', ['area_id' => $ah->id]) }}'"
                                    class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                Adicionar Produto
                            </button>
                        @endif
                        <button onclick="location.href = '{{ route('estoque.solicitar', ['id' => $ah->id]) }}';"
                                class="btn btn-outline-success">
                            <i class="fas fa-box"></i>
                            Solicitar
                        </button>
                        <button onclick="location.href = '{{ route('estoque._minimo', ['id' => $ah->id]) }}';"
                                class="btn btn-outline-info">
                            <i class="fas fa-chart-line"></i>
                            Estoque Mínimo
                        </button>
                    </div>
                </div>

                <!-- Tabela de Produtos -->
                <div class="table-responsive">
                    <table class="table border-0 custom-table comman-table datatable mb-0 table-produto" id="table-c">
                        <thead>
                            <tr>
                                <th><i class="fas fa-tag me-1"></i>Designação</th>
                                <th><i class="fas fa-prescription-bottle me-1"></i>Dosagem</th>
                                <th><i class="fas fa-signal me-1"></i>Status</th>
                                <th><i class="fas fa-cube me-1"></i>Quantidade</th>
                                <th><i class="fas fa-barcode me-1"></i>Lote</th>
                                <th><i class="fas fa-exclamation-triangle me-1"></i>Expiração</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

        <!-- Modal de Confirmação de Exclusão -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius: 12px; overflow: hidden; border: none;">
                    <div class="modal-header" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; border: none;">
                        <h5 class="modal-title" id="confirmDeleteLabel" style="font-weight: 600;">
                            <i class="fas fa-exclamation-triangle me-2"></i>Confirmar Exclusão
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar" style="filter: brightness(0) invert(1);"></button>
                    </div>
                    <div class="modal-body" style="padding: 2rem;">
                        <div class="text-center mb-3">
                            <div class="rounded-circle bg-danger bg-opacity-10 d-inline-flex p-3 mb-3">
                                <i class="fas fa-trash fa-2x text-danger"></i>
                            </div>
                            <p class="mb-0" style="font-size: 1.125rem; color: #2d3748;">
                                Tem certeza que deseja excluir este produto?
                            </p>
                            <small style="color: #718096;">Esta ação não poderá ser desfeita.</small>
                        </div>
                    </div>
                    <div class="modal-footer" style="border: none; padding: 1rem 2rem 2rem;">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 8px; padding: 0.75rem 1.5rem;">
                            <i class="fas fa-times me-2"></i>Cancelar
                        </button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn" style="border-radius: 8px; padding: 0.75rem 1.5rem;">
                            <span id="delete_btn_text">
                                <i class="fas fa-trash me-2"></i>Confirmar Exclusão
                            </span>
                            <span id="delete_btn_spinner" style="display:none;">
                                <span class="spinner-custom"></span>
                                <span class="ms-2">Excluindo...</span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        // ========== Sistema de Toast Notifications ==========
        /**
         * Exibe uma notificação toast elegante
         * @author Augusto Kussema
         * @date 03/11/2025 às 14:30 (Luanda)
         * @param {string} message - Mensagem principal
         * @param {string} type - Tipo: 'success', 'error', 'info', 'warning'
         * @param {string} title - Título opcional
         * @param {number} duration - Duração em ms (padrão: 4000)
         */
        function showToast(message, type = 'info', title = '', duration = 4000) {
            const icons = {
                success: '<svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>',
                error: '<svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>',
                info: '<svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>',
                warning: '<svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>'
            };

            const titles = {
                success: title || 'Sucesso!',
                error: title || 'Erro!',
                info: title || 'Informação',
                warning: title || 'Atenção!'
            };

            const container = document.getElementById('toastContainer');
            if (!container) return;

            const toast = document.createElement('div');
            toast.className = `toast-custom toast-${type}`;
            toast.innerHTML = `
                <div class="toast-icon">${icons[type] || icons.info}</div>
                <div class="toast-content">
                    <div class="toast-title">${titles[type]}</div>
                    <div class="toast-message">${message}</div>
                </div>
                <button class="toast-close" onclick="this.parentElement.remove()">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            `;

            container.appendChild(toast);

            // Trigger animation
            setTimeout(() => toast.classList.add('show'), 10);

            // Auto remove
            setTimeout(() => {
                toast.classList.add('hiding');
                setTimeout(() => toast.remove(), 300);
            }, duration);
        }

        $(document).ready(function() {

            $('.solicitar-produto .js-example-basic-multiple').select2();

            // Consolidated DataTable handling for '#table-c'
            //  - define errMode early so DataTables won't show native alerts
            //  - provide a single initializer and expose `table` variable for later use
            $.fn.dataTable.ext.errMode = function (settings, helpPage, message) {
                console.error('DataTables error:', message);
                // evitar alert() nativo do DataTables
            };

            var table = null;

            function initTable() {
                if ($.fn.dataTable.isDataTable('#table-c')) {
                    table = $('#table-c').DataTable();
                    // atualiza url caso a view seja reutilizada
                    table.ajax.url('/api/produtos/{{ $ah->id }}').load();
                    return;
                }

                table = $('#table-c').DataTable({
                    // usa ajax com tratamento de dataSrc para evitar exceções quando o servidor retorna 500/HTML
                    ajax: {
                        url: '/api/produtos/{{ $ah->id }}',
                        dataSrc: function (json) {
                            if (!json) {
                                console.error('Resposta vazia do endpoint /api/produtos/{{ $ah->id }}');
                                return [];
                            }
                            if (Array.isArray(json)) return json;
                            if (json.data && Array.isArray(json.data)) return json.data;
                            console.error('Resposta inesperada do endpoint /api/produtos/{{ $ah->id }}', json);
                            return [];
                        },
                        error: function (xhr, status, error) {
                            console.error('Erro Ajax DataTable /api/produtos/{{ $ah->id }}:', status, error);
                        }
                    },
                    columns: [{
                            data: "produto.designacao"
                        },
                        { data: "produto.dosagem" },
                        {
                            data: function(row) {
                                let saldo = row.produto?.saldo?.qtd ?? 0;
                                let statusStock = row.produto?.status_stock;
                                if (statusStock) {
                                    if (saldo <= (statusStock.critico <= 0))
                                        return '<span class="badge bg-dark">Estoque 0</span>';
                                    if (saldo <= (statusStock.critico ?? -1))
                                        return '<span class="badge bg-danger">Crítico</span>';
                                    if (saldo <= (statusStock.minimo ?? -1))
                                        return '<span class="badge bg-warning">Mínimo</span>';
                                    if (saldo <= (statusStock.medio ?? -1))
                                        return '<span class="badge bg-info">Médio</span>';
                                    if (saldo <= (statusStock.maximo ?? -1))
                                        return '<span class="badge bg-success">Máximo</span>';
                                    if (saldo >= (statusStock.maximo ?? -1))
                                        return '<span class="badge bg-success">Estável</span>';
                                }
                                return '<span class="badge bg-secondary">Não Atribuido</span>';
                            }
                        },
                        { data: "produto.quantidade" },
                        { data: "produto.num_lote" },
                        { data: function(row) { return formatDate(row.produto.data_expiracao); } },
                        /* { data: null, defaultContent: "" } */
                    ],
                    language: {
                        search: "Filtrar resultados:",
                        zeroRecords: "Nenhum resultado encontrado",
                        info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                        infoEmpty: "Mostrando 0 a 0 de 0 entradas",
                        infoFiltered: "(filtrado de _MAX_ entradas no total)",
                        lengthMenu: "Mostrar _MENU_ entradas",
                        paginate: { first: "Primeiro", last: "Último", next: "Próximo", previous: "Anterior" }
                    }
                });
            }

            // Inicializa tabela agora
            initTable();

            // Função para adicionar linha extra manualmente após carregar os dados
            $('#table-c tbody').on('click', 'tr', function() {
                var row = $(this);
                var data = table.row(row).data(); // Pega os dados da linha clicada

                // Se a linha de ações já existir, remover
                if (row.next().hasClass('action-row')) {
                    row.next().remove();
                    return;
                }

                // Fecha qualquer outra linha de ação aberta
                $('.action-row').remove();

                // Criar e inserir nova linha de ação
                var actionRow = `
                    <tr class="action-row">
                        <td colspan="7">
                            <div class="action-buttons">
                                <button class="btn btn-sm btn-info btn-detalhes" data-id="${data.produto.id}" title="Ver Detalhes">
                                    <i class="fa fa-info-circle"></i> Detalhes
                                </button>
                                <button class="btn btn-sm btn-success btn-add" data-id="${data.produto.id}" title="Adicionar">
                                    <i class="fa fa-plus"></i> Adicionar
                                </button>
                                <button class="btn btn-sm btn-primary btn-editar" data-id="${data.produto.id}" title="Editar">
                                    <i class="fa fa-edit"></i> Editar
                                </button>
                                <button class="btn btn-sm btn-secondary btn-sincronizar" data-id="${data.produto.id}" title="Sincronizar">
                                    <i class="fa fa-sync"></i> Sincronizar
                                </button>
                                <button class="btn btn-sm btn-dark btn-historico" data-id="${data.produto.id}" title="Histórico">
                                    <i class="fa fa-history"></i> Histórico
                                </button>
                                <button class="btn btn-sm btn-warning btn-dar-baixa" data-id="${data.produto.id}" data-designacao="${data.produto.designacao}" data-quantidade="${data.produto.quantidade || 0}" title="Dar Baixa">
                                    <i class="fa fa-arrow-down"></i> Baixa
                                </button>
                                <button class="btn btn-sm btn-danger btn-eliminar-item" data-id="${data.produto.id}" title="Eliminar">
                                    <i class="fa fa-trash"></i> Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>`;

                row.after(actionRow);
            });

            // Pré-carregar mapa de áreas (FAH e AH -> nome) para mensagens humanizadas do histórico
            @php
                try {
                    $farmaciaCtx = auth()->user()->isFarmacia->farmacia_id ?? (auth()->user()->area_hospitalar->area_hospitalar->farmacia_id ?? null);
                    $__areas = $farmaciaCtx
                        ? \App\Models\FarmaciaAreaHospitalar::with('area_hospitalar')->where('farmacia_id', $farmaciaCtx)->get()
                        : collect();
                    $__areaMap = [];
                    foreach ($__areas as $__a) {
                        if ($__a->id) $__areaMap[$__a->id] = $__a->area_hospitalar->nome;
                        if ($__a->area_hospitalar_id) $__areaMap[$__a->area_hospitalar_id] = $__a->area_hospitalar->nome;
                    }
                } catch (\Throwable $e) { $__areaMap = []; }
            @endphp
            window.AREA_MAP = @json($__areaMap);

            // Abrir offcanvas de histórico ao clicar no botão
            $(document).on('click', '.btn-historico', function() {
                var produtoId = $(this).data('id');
                var offcanvasEl = document.getElementById('offcanvasRight');
                var offcanvas = new bootstrap.Offcanvas(offcanvasEl);

                // Mostrar overlay de loading
                document.getElementById('loadingOverlay').classList.add('active');

                // limpar conteúdo anterior (menos o exemplo)
                var timeline = document.getElementById('history_timeline');
                var examples = timeline.querySelectorAll('.history-item');
                Array.from(examples).forEach(function(ex) { ex.remove(); });

                document.getElementById('history_empty').style.display = 'none';
                document.getElementById('offcanvasRightSubtitle').innerText = 'A carregar histórico...';

                // Mapeamento de ícones por ação
                var actionIcons = {
                    'created': 'fa-plus-circle',
                    'updated': 'fa-edit',
                    'stock_in': 'fa-arrow-down',
                    'stock_out': 'fa-arrow-up',
                    'deleted': 'fa-trash',
                    'transfer': 'fa-exchange-alt'
                };

                // Mapeamento de ações para rótulos em Português
                var actionLabelsPT = {
                    'created': 'Criado',
                    // Ocultar rótulo textual para 'updated' (mostra apenas detalhes)
                    'updated': '',
                    'stock_in': 'Entrada de estoque',
                    'stock_out': 'Saída de estoque',
                    'deleted': 'Eliminado',
                    'transfer': 'Transferência'
                };

                // Carregar histórico com filtros e paginação
                var currentHistoryRequest = null;

                function normalizeListDedup(list) {
                    if (!Array.isArray(list)) return [];
                    const out = [];
                    const keyFor = (it) => {
                        const t = it.created_at || it.movement_date || '';
                        const q = (it.quantity_delta ?? '').toString();
                        const a = it.action || '';
                        return `${t}|${q}|${a}`;
                    };
                    const byKey = new Map();
                    for (const it of list) {
                        const k = keyFor(it);
                        if (!byKey.has(k)) byKey.set(k, []);
                        byKey.get(k).push(it);
                    }
                    // Regra: se existir 'stock_out' ou 'stock_in' e também 'updated' com mesmo timestamp/qty, descartar 'updated'
                    byKey.forEach((arr) => {
                        const hasStockMove = arr.some(x => x.action === 'stock_out' || x.action === 'stock_in' || x.action === 'transfer');
                        const filtered = hasStockMove ? arr.filter(x => x.action !== 'updated') : arr;
                        filtered.forEach(x => out.push(x));
                    });
                    // Ordenar por data desc se necessário
                    out.sort((a,b) => new Date(b.created_at||b.movement_date||0) - new Date(a.created_at||a.movement_date||0));
                    return out;
                }

                function areaName(id) {
                    return (window.AREA_MAP && window.AREA_MAP[id]) ? window.AREA_MAP[id] : `Área ${id}`;
                }

                function humanizeDetails(item) {
                    const a = item.action || '';
                    const p = item.payload || {};
                    const parts = [];
                    if (a === 'stock_out' || a === 'transfer') {
                        if (p.to_area) parts.push(`<i class="fa fa-location-arrow me-1"></i> Transferido para: <strong>${areaName(p.to_area)}</strong>`);
                        if (p.num_lote) parts.push(`<i class=\"fa fa-barcode me-1\"></i> Lote: <strong>${p.num_lote}</strong>`);
                        if (p.obs) parts.push(`<i class=\"fa fa-comment me-1\"></i> ${p.obs}`);
                    } else if (a === 'stock_in') {
                        if (p.num_lote) parts.push(`<i class=\"fa fa-barcode me-1\"></i> Lote: <strong>${p.num_lote}</strong>`);
                        var forn = p.supplier_name || p.fornecedor || '';
                        if (forn) parts.push(`<i class=\"fa fa-truck me-1\"></i> Fornecedor: <strong>${forn}</strong>`);
                        if (p.obs) parts.push(`<i class=\"fa fa-comment me-1\"></i> ${p.obs}`);
                    } else if (a === 'updated') {
                        if (Array.isArray(p.changed_fields) && p.changed_fields.length) {
                            parts.push(`<i class=\"fa fa-edit me-1\"></i> Atualizações: <strong>${p.changed_fields.join(', ')}</strong>`);
                        } else if (typeof item.quantity_delta === 'number' && item.quantity_delta !== 0) {
                            const sign = item.quantity_delta > 0 ? '+' : '';
                            parts.push(`<i class=\"fa fa-balance-scale me-1\"></i> Quantidade ajustada: <strong>${sign}${item.quantity_delta} un</strong>`);
                        }
                    } else if (p.summary_pt) {
                        parts.push(p.summary_pt);
                    }
                    return parts.length ? `<div class="history-message">${parts.join(' • ')}</div>` : '';
                }

                function renderHistoryItems(list, meta) {
                    timeline.innerHTML = '';
                    list = normalizeListDedup(list);
                    if (!list || list.length === 0) {
                        document.getElementById('history_empty').style.display = 'block';
                        document.getElementById('offcanvasRightSubtitle').innerText = 'Sem registos';
                        document.getElementById('history_pagination_info').innerText = '';
                        document.getElementById('history_pagination_controls').innerHTML = '';
                        return;
                    }

                    document.getElementById('history_empty').style.display = 'none';
                    document.getElementById('offcanvasRightSubtitle').innerText = (meta && meta.total ? meta.total : list.length) + ' ' + ((meta && meta.total === 1) || list.length === 1 ? 'registo' : 'registos');

                    list.forEach(function(item, idx) {
                        var qty = item.quantity_delta || 0;
                        var qtyClass = qty > 0 ? 'positive' : (qty < 0 ? 'negative' : 'neutral');
                        var qtyText = qty > 0 ? '+'+qty+' un' : (qty < 0 ? qty+' un' : '—');
                        var action = item.action || 'updated';
                        var icon = actionIcons[action] || 'fa-circle';
                        var userName = item.user ? item.user.name : 'Sistema';

                        // Formatar data profissionalmente
                        var createdAt = item.created_at || item.movement_date;
                        var dateFormatted = '';
                        var timeFormatted = '';

                        if (createdAt) {
                            try {
                                var d = new Date(createdAt);
                                var months = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];
                                dateFormatted = d.getDate().toString().padStart(2, '0') + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
                                timeFormatted = d.getHours().toString().padStart(2, '0') + ':' + d.getMinutes().toString().padStart(2, '0');
                            } catch(e) {
                                dateFormatted = item.movement_date_fmt || item.created_at_fmt || '';
                            }
                        }

                        var labelPT = actionLabelsPT[action] || (action || '').replace('_', ' ');

                        // Extrair informações detalhadas
                        var detailsHtml = humanizeDetails(item);

                        var el = document.createElement('div');
                        el.className = 'history-item';
                        el.style.animationDelay = (idx * 0.05) + 's';
                        el.innerHTML = `
                            <div class="d-flex gap-3 align-items-start">
                                <div class="history-badge action-${action}">
                                    <i class="fa ${icon}"></i>
                                </div>
                                <div class="history-content">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div>
                                            <div class="history-action-title">${labelPT}</div>
                                            <div class="history-meta">
                                                <span class="history-user">
                                                    <i class="fa fa-user-circle"></i> ${userName}
                                                </span>
                                                ${dateFormatted ? '<span class="history-time"><i class="fa fa-calendar"></i> ' + dateFormatted + '</span>' : ''}
                                                ${timeFormatted ? '<span class="history-time"><i class="fa fa-clock"></i> ' + timeFormatted + '</span>' : ''}
                                            </div>
                                        </div>
                                        <span class="history-qty ${qtyClass}">${qtyText}</span>
                                    </div>
                                    ${detailsHtml}
                                </div>
                            </div>`;
                        timeline.appendChild(el);
                    });

                    // Render pagination controls se meta existir
                    var controls = document.getElementById('history_pagination_controls');
                    var info = document.getElementById('history_pagination_info');
                    controls.innerHTML = '';
                    info.innerText = '';
                    if (meta && meta.total !== undefined) {
                        info.innerText = `Mostrando ${meta.from || 1} a ${meta.to || list.length} de ${meta.total}`;

                        var last = meta.last_page || 1;
                        var current = meta.current_page || 1;

                        var group = document.createElement('div');
                        group.className = 'btn-group';

                        // Primeiro
                        var firstBtn = document.createElement('button');
                        firstBtn.className = 'btn btn-sm btn-outline-secondary';
                        firstBtn.innerText = 'Primeiro';
                        firstBtn.disabled = current === 1;
                        firstBtn.addEventListener('click', function() { loadProductHistory(1); });
                        group.appendChild(firstBtn);

                        // Anterior
                        var prevBtn = document.createElement('button');
                        prevBtn.className = 'btn btn-sm btn-outline-secondary';
                        prevBtn.innerText = 'Anterior';
                        prevBtn.disabled = current === 1;
                        prevBtn.addEventListener('click', function() { loadProductHistory(Math.max(1, current - 1)); });
                        group.appendChild(prevBtn);

                        // Números de página (janela)
                        var start = Math.max(1, current - 3);
                        var end = Math.min(last, current + 3);
                        for (var p = start; p <= end; p++) {
                            var pBtn = document.createElement('button');
                            pBtn.className = 'btn btn-sm ' + (p === current ? 'btn-primary' : 'btn-outline-secondary');
                            pBtn.innerText = p;
                            (function(pp) { pBtn.addEventListener('click', function() { loadProductHistory(pp); }); })(p);
                            group.appendChild(pBtn);
                        }

                        // Próximo
                        var nextBtn = document.createElement('button');
                        nextBtn.className = 'btn btn-sm btn-outline-secondary';
                        nextBtn.innerText = 'Próximo';
                        nextBtn.disabled = current === last;
                        nextBtn.addEventListener('click', function() { loadProductHistory(Math.min(last, current + 1)); });
                        group.appendChild(nextBtn);

                        // Último
                        var lastBtn = document.createElement('button');
                        lastBtn.className = 'btn btn-sm btn-outline-secondary';
                        lastBtn.innerText = 'Último';
                        lastBtn.disabled = current === last;
                        lastBtn.addEventListener('click', function() { loadProductHistory(last); });
                        group.appendChild(lastBtn);

                        controls.appendChild(group);
                    }
                }

                function buildQueryParams(page) {
                    var q = document.getElementById('history_search').value || '';
                    var from = document.getElementById('history_from').value || '';
                    var to = document.getElementById('history_to').value || '';
                    var per_page = document.getElementById('history_per_page').value || '';
                    var params = new URLSearchParams();
                    if (q) params.append('q', q);
                    if (from) params.append('from', from);
                    if (to) params.append('to', to);
                    if (per_page) params.append('per_page', per_page);
                    if (page) params.append('page', page);
                    return params.toString();
                }

                function loadProductHistory(page) {
                    var qs = buildQueryParams(page);
                    if (currentHistoryRequest) currentHistoryRequest.abort();
                    currentHistoryRequest = new AbortController();
                    var signal = currentHistoryRequest.signal;

                    // mostrar loader overlay
                    var loader = document.getElementById('history_loader');
                    if (loader) loader.style.display = 'flex';

                    document.getElementById('offcanvasRightSubtitle').innerText = 'A carregar histórico...';
                    timeline.innerHTML = '';

                    fetch(`/api/product-history/${produtoId}?${qs}`, { signal: signal }).then(function(resp) {
                        if (!resp.ok) throw new Error('no-data');
                        return resp.json();
                    }).then(function(json) {
                        var data = json.data || [];
                            var meta = json.meta || {};
                            // se o endpoint retornou infos do produto, atualiza header
                            if (json.product) {
                                var titleEl = document.getElementById('offcanvasRightLabel');
                                var subtitleEl = document.getElementById('offcanvasRightSubtitle');
                                if (titleEl) titleEl.innerHTML = '<i class="fa fa-history me-2"></i> ' + (json.product.designacao || 'Histórico do produto');
                                if (subtitleEl) subtitleEl.innerText = json.product.descritivo || 'Registos de alterações, entradas e saídas';
                            }
                            renderHistoryItems(data, meta);
                    }).catch(function(err) {
                        if (err.name === 'AbortError') return; // requisição cancelada
                        document.getElementById('history_empty').style.display = 'block';
                        document.getElementById('offcanvasRightSubtitle').innerText = 'Erro ao carregar';
                    }).finally(function() {
                        // Esconder overlay quando o offcanvas for exibido
                        document.getElementById('loadingOverlay').classList.remove('active');
                        offcanvas.show();
                        if (loader) loader.style.display = 'none';
                    });
                }

                // Ações do toolbar
                document.getElementById('history_refresh').onclick = function() { loadProductHistory(1); };
                document.getElementById('history_apply').onclick = function() { loadProductHistory(1); };
                // limpar filtros
                document.getElementById('history_clear').onclick = function() {
                    document.getElementById('history_search').value = '';
                    document.getElementById('history_from').value = '';
                    document.getElementById('history_to').value = '';
                    document.getElementById('history_per_page').value = '20';
                    loadProductHistory(1);
                };

                // debounce para busca por texto
                var searchTimer = null;
                document.getElementById('history_search').addEventListener('input', function() {
                    clearTimeout(searchTimer);
                    searchTimer = setTimeout(function() { loadProductHistory(1); }, 450);
                });

                // carregar primeira página
                loadProductHistory(1);
            });

            // Evento para abrir a modal de confirmação ao clicar em "Eliminar"
            $(document).on('click', '.btn-eliminar-item', function() {
                var produtoId = $(this).data('id');

                // Configura a modal antes de exibir
                $('#confirmDeleteModal').modal('show');
                $('#confirmDeleteBtn').data('id', produtoId);
            });

            // Evento para confirmar e enviar a solicitação de exclusão
            $('#confirmDeleteBtn').on('click', function() {
                var produtoId = $(this).data('id');
                var btn = $(this);
                var btnText = $('#delete_btn_text');
                var btnSpinner = $('#delete_btn_spinner');

                // Disable button e mostrar spinner
                btn.prop('disabled', true);
                btnText.hide();
                btnSpinner.show();

                $.ajax({
                    url: '/api/produtos_/' + produtoId,
                    type: 'DELETE',
                    success: function(response) {
                        $('#confirmDeleteModal').modal('hide');
                        showToast(response.message || 'Produto eliminado com sucesso!', 'success', 'Eliminado!');
                        table.ajax.reload(null, false);

                        // Reset button
                        setTimeout(function() {
                            btn.prop('disabled', false);
                            btnText.show();
                            btnSpinner.hide();
                        }, 500);
                    },
                    error: function(xhr) {
                        console.error("Erro ao excluir: " + produtoId, xhr.responseText);
                        var errorMsg = xhr.responseJSON && xhr.responseJSON.message
                            ? xhr.responseJSON.message
                            : 'Erro ao eliminar o produto';
                        showToast(errorMsg, 'error', 'Erro!');

                        // Reset button
                        btn.prop('disabled', false);
                        btnText.show();
                        btnSpinner.hide();
                    }
                });
            });

            // Função para Editar Produto
            $(document).on('click', '.btn-editar', function() {
                var id = $(this).data('id');
                window.location.href = `/estoque/editar/${id}/{{ $ah->id }}`;
            });

            // Função para Sincronizar quantidade a partir do descritivo
            $(document).on('click', '.btn-sincronizar', function() {
                var produtoId = $(this).data('id');
                var btn = $(this);
                var originalHtml = btn.html();

                btn.prop('disabled', true).html('<span class="spinner-custom"></span> <span class="ms-2">Sincronizando...</span>');

                $.ajax({
                    url: '{{ route('estoque.sincronizar') }}',
                    type: 'POST',
                    data: { produto_id: produtoId, _token: '{{ csrf_token() }}' },
                    success: function(response) {
                        showToast(
                            response.message || 'Quantidade sincronizada: ' + response.quantidade + ' unidades',
                            'success',
                            'Sincronizado!'
                        );

                        btn.html('<i class="fa fa-check me-1"></i> Sincronizado!').removeClass('btn-secondary').addClass('btn-success');

                        setTimeout(function() {
                            table.ajax.reload(null, false);
                            btn.html(originalHtml).removeClass('btn-success').addClass('btn-secondary');
                            btn.prop('disabled', false);
                        }, 1500);
                    },
                    error: function(xhr) {
                        btn.html(originalHtml).prop('disabled', false);
                        var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Erro ao sincronizar';
                        showToast(msg, 'error', 'Erro na sincronização');
                    }
                });
            });

            // Função para Dar Baixa
            $(document).on('click', '.btn-dar-baixa', function() {
                var id = $(this).data('id');
                var quantidade = $(this).data('quantidade');
                var designacao = $(this).data('designacao');
                modalDarBaixa(id, null, designacao, quantidade); // passa quantidade como 4º parâmetro
            });

            // Função para Excluir Produto
            $(document).on('click', '.btn-excluir', function() {
                var id = $(this).data('id');
                if (confirm("Tem certeza que deseja excluir este produto?")) {
                    $.ajax({
                        url: `/api/produtos/excluir/${id}`,
                        type: 'DELETE',
                        success: function(response) {
                            alert("Produto excluído com sucesso!");
                            table.ajax.reload(); // Recarrega a tabela
                        },
                        error: function(xhr) {
                            alert("Erro ao excluir o produto.");
                        }
                    });
                }
            });

            $('form#form_search').on('submit', function(e) {
                e.preventDefault();
            });
            $('#search-table').on('keyup', function() {
                // Obtém a instância da DataTable
                var table = $('#table-c').DataTable();

                // Aplica o filtro ao DataTable usando o valor do campo de pesquisa personalizado
                table.search(this.value).draw();
            });

            // Função para atualizar a DataTable periodicamente
            function updateTable() {
                table.ajax.reload(null, false); // Atualiza a tabela sem reiniciar a paginação
            }

            // Atualiza a tabela a cada 30 segundos (30000 milissegundos)
            setInterval(updateTable, 30000); // Altere o tempo conforme necessário

            function getCaixa(string) {
                var valores = string.split('x');
                var valor = valores[0].replace(/^0+/, ''); // Remove os zeros à esquerda

                return valor;
            }

            function formatDate(dateString) {
                var date = new Date(dateString);
                var day = String(date.getDate()).padStart(2, '0');
                var month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based
                var year = date.getFullYear();
                return `${day}-${month}-${year}`;
            }

            function getUnit(string) {
                var partes = string.split('x');
                return partes[partes.length - 1];
            }
        });

        // ========== Handlers para Offcanvas Adicionar Estoque ==========
        /**
         * Abre o offcanvas de adicionar estoque
         * @author Augusto Kussema
         * @date 03/11/2025 às 16:15 (Luanda)
         */
        document.addEventListener('click', function(e) {
            var target = e.target.closest('.btn-add');
            if (!target) return;

            var produtoId = target.getAttribute('data-id');
            document.getElementById('add_produto_id').value = produtoId;

            // resetar campos
            document.getElementById('add_quantidade').value = '0';
            document.getElementById('add_lote').value = '';
            document.getElementById('add_fornecedor').value = '';
            document.getElementById('add_obs').value = '';

            var offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasAddStock'));
            offcanvas.show();
        });

        // Handler de submit do formulário de adicionar
        document.addEventListener('submit', function(e) {
            if (e.target && e.target.id === 'formAdicionarEstoque') {
                e.preventDefault();
                var form = e.target;
                var fd = new FormData(form);

                var quantidade = parseInt(document.getElementById('add_quantidade').value || 0, 10);
                fd.set('quantidade', quantidade);

                // incluir area_hospitalar_id no payload
                try {
                    fd.append('area_hospitalar_id', '{{ $area_id ?? '' }}');
                } catch (e) {}

                // Validar quantidade
                if (quantidade <= 0) {
                    showToast('A quantidade deve ser maior que zero', 'error');
                    return;
                }

                // UI elements
                var btn = document.getElementById('add_submit_btn');
                var btnText = document.getElementById('add_submit_text');
                var btnSpinner = document.getElementById('add_submit_spinner');

                // Disable form
                Array.from(form.querySelectorAll('input, textarea, button')).forEach(function(i) {
                    i.disabled = true;
                });
                btnText.style.display = 'none';
                btnSpinner.style.display = 'inline-flex';

                fetch('{{ route('estoque.adicionar') }}', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: fd
                }).then(function(response) {
                    if (!response.ok) return response.json().then(function(j) { throw j; });
                    return response.json();
                }).then(function(data) {
                    showToast(data.message || 'Estoque adicionado com sucesso!', 'success');

                    // Reload table
                    try {
                        if (typeof table !== 'undefined' && table.ajax) {
                            table.ajax.reload(null, false);
                        } else {
                            $('#table-c').DataTable().ajax.reload(null, false);
                        }
                    } catch (err) {}

                    // Close offcanvas after short delay
                    setTimeout(function() {
                        var offcanvasEl = document.getElementById('offcanvasAddStock');
                        var offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                        if (offcanvas) offcanvas.hide();

                        // Reset form
                        form.reset();
                        Array.from(form.querySelectorAll('input, textarea, button')).forEach(function(i) {
                            i.disabled = false;
                        });
                        btnText.style.display = 'inline-flex';
                        btnSpinner.style.display = 'none';
                    }, 800);
                }).catch(function(err) {
                    var errorMsg = 'Erro ao adicionar estoque';

                    if (err && err.errors) {
                        var msgs = [];
                        for (var k in err.errors) {
                            if (err.errors.hasOwnProperty(k)) msgs.push(err.errors[k][0]);
                        }
                        errorMsg = msgs.join(', ');
                    } else if (err && err.message) {
                        errorMsg = err.message;
                    }

                    showToast(errorMsg, 'error');

                    // Re-enable form
                    Array.from(form.querySelectorAll('input, textarea, button')).forEach(function(i) {
                        i.disabled = false;
                    });
                    btnText.style.display = 'inline-flex';
                    btnSpinner.style.display = 'none';
                });
            }
        });

        // ========== Handlers para Offcanvas Dar Baixa ==========
        /**
         * Abre o offcanvas de dar baixa
         * @author Augusto Kussema
         * @date 03/11/2025 às 16:15 (Luanda)
         */
        function modalDarBaixa(id_produto, descritivo, designacao, quantidade) {
            document.getElementById('baixa_produto_id').value = id_produto;
            document.getElementById('baixa_designacao_display').textContent = designacao || '—';
            document.getElementById('baixa_qtd_display').textContent = quantidade || 0;
            document.getElementById('baixa_quantidade_disponivel').value = quantidade || 0;
            document.getElementById('baixa_quantidade').value = '';
            document.getElementById('baixa_quantidade').setAttribute('max', quantidade || 0);

            // set default movement_date to now (local)
            try {
                const now = new Date();
                const tzOffset = now.getTimezoneOffset() * 60000;
                const localISOTime = new Date(now - tzOffset).toISOString().slice(0,16);
                document.getElementById('baixa_movement_date').value = localISOTime;
            } catch (e) {
                // ignore if element not found
            }

            var offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasDarBaixa'));
            offcanvas.show();
        }

        // Handler de submit do formulário de dar baixa (AJAX)
        document.addEventListener('submit', function(e) {
            if (e.target && e.target.id === 'formBaixaEstoque') {
                e.preventDefault();
                var form = e.target;
                var fd = new FormData(form);

                var quantidade = parseInt(document.getElementById('baixa_quantidade').value || 0, 10);
                var quantidadeDisponivel = parseInt(document.getElementById('baixa_quantidade_disponivel').value || 0, 10);

                // Validações
                if (quantidade <= 0) {
                    showToast('A quantidade deve ser maior que zero', 'error');
                    return;
                }

                if (quantidade > quantidadeDisponivel) {
                    showToast(`Quantidade insuficiente. Disponível: ${quantidadeDisponivel} unidades`, 'error');
                    return;
                }

                // UI elements
                var btn = document.getElementById('baixa_submit_btn');
                var btnText = document.getElementById('baixa_submit_text');
                var btnSpinner = document.getElementById('baixa_submit_spinner');

                // Disable form
                Array.from(form.querySelectorAll('input, select, button')).forEach(function(i) {
                    i.disabled = true;
                });
                btnText.style.display = 'none';
                btnSpinner.style.display = 'inline-flex';

                fetch('{{ route('estoque.baixa') }}', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: fd
                }).then(function(response) {
                    if (!response.ok) return response.json().then(function(j) { throw j; });
                    return response.json();
                }).then(function(data) {
                    showToast(data.message || 'Baixa realizada com sucesso!', 'success', 'Transferido!');

                    // Reload table
                    try {
                        if (typeof table !== 'undefined' && table.ajax) {
                            table.ajax.reload(null, false);
                        } else {
                            $('#table-c').DataTable().ajax.reload(null, false);
                        }
                    } catch (err) {}

                    // Close offcanvas after short delay
                    setTimeout(function() {
                        var offcanvasEl = document.getElementById('offcanvasDarBaixa');
                        var offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                        if (offcanvas) offcanvas.hide();

                        // Reset form
                        form.reset();
                        Array.from(form.querySelectorAll('input, select, button')).forEach(function(i) {
                            i.disabled = false;
                        });
                        btnText.style.display = 'inline-flex';
                        btnSpinner.style.display = 'none';
                    }, 800);
                }).catch(function(err) {
                    var errorMsg = 'Erro ao dar baixa';

                    if (err && err.errors) {
                        var msgs = [];
                        for (var k in err.errors) {
                            if (err.errors.hasOwnProperty(k)) msgs.push(err.errors[k][0]);
                        }
                        errorMsg = msgs.join(', ');
                    } else if (err && err.message) {
                        errorMsg = err.message;
                    }

                    showToast(errorMsg, 'error');

                    // Re-enable form
                    Array.from(form.querySelectorAll('input, select, button')).forEach(function(i) {
                        i.disabled = false;
                    });
                    btnText.style.display = 'inline-flex';
                    btnSpinner.style.display = 'none';
                });
            }
        });

        // Inicializar Select2 no offcanvas quando aberto
        document.getElementById('offcanvasDarBaixa').addEventListener('shown.bs.offcanvas', function() {
            var $sel = $('#baixa_area_select');
            if ($sel.length && !$sel.hasClass('select2-hidden-accessible')) {
                try {
                    $sel.select2({
                        width: '100%',
                        dropdownParent: $('#offcanvasDarBaixa'),
                        placeholder: 'Selecionar área...'
                    });
                } catch (e) {
                    console.warn('Select2 não disponível');
                }
            }
        });

        // Handler para botão Atualizar Estoque
        document.getElementById('btnAtualizarEstoque').addEventListener('click', function() {
            const btn = this;
            const icon = btn.querySelector('i');

            // Adicionar rotação ao ícone
            icon.classList.add('fa-spin');
            btn.disabled = true;

            try {
                if (typeof table !== 'undefined' && table.ajax) {
                    table.ajax.reload(function() {
                        // Callback após reload
                        icon.classList.remove('fa-spin');
                        btn.disabled = false;
                        showToast('Estoque atualizado com sucesso!', 'success', 'Atualizado!');
                    }, false);
                } else {
                    $('#table-c').DataTable().ajax.reload(function() {
                        icon.classList.remove('fa-spin');
                        btn.disabled = false;
                        showToast('Estoque atualizado com sucesso!', 'success', 'Atualizado!');
                    }, false);
                }
            } catch (err) {
                console.error('Erro ao atualizar:', err);
                icon.classList.remove('fa-spin');
                btn.disabled = false;
                showToast('Erro ao atualizar estoque', 'error');
            }
        });

        // Handler para imprimir
        document.getElementById('imprimir-pagina').addEventListener('click', function(e) {
            e.preventDefault();
            var novaAba = window.open(this.href, '_blank');
            novaAba.onload = function() {
                novaAba.print();
            };
        });

        document.querySelector('form#formProdutoEstoque').addEventListener('submit', function(e) {
            e.preventDefault(); // Evita o comportamento padrão do formulário
            //showLoader();

            // Obtém os dados do formulário
            var formData = new FormData(this);

            // Envia a requisição AJAX
            fetch(this.getAttribute('action'), {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // hideLoader();
                    if (data.message) {
                        alertify.alert("Produto inserido com sucesso!", data.message, function() {
                            alertify.success("Ok");
                        });
                        // alert(data.message);

                        // Limpa o formulário
                        document.querySelector('#formProdutoEstoque').reset();

                        // Oculta o modal
                        document.querySelector('#modalAddProdutoEstoque').classList.remove('show');
                        document.querySelector('#modalAddProduto').style.display = 'none';
                    } else {
                        // Trata caso a resposta não contenha a mensagem esperada
                        alertify.alert("Erro", "Resposta inesperada do servidor!", function() {
                            alertify.success("Ok");
                        });
                        // alert("Resposta inesperada do servidor");
                    }
                })
                .catch(error => {
                    // hideLoader();
                    // Trata os erros de validação retornados pelo servidor
                    if (error.response && error.response.json) {
                        error.response.json().then(data => {
                            var errors = data.errors;
                            var errorMessage = '';

                            if (errors) {
                                // Percorre os erros e os concatena em uma única string
                                for (var key in errors) {
                                    if (errors.hasOwnProperty(key)) {
                                        errorMessage += errors[key][0] + '<br>';
                                    }
                                }
                            } else if (data.error) {
                                errorMessage = data.error;
                            } else {
                                errorMessage = data.message;
                            }
                            alertify.alert("Erro", errorMessage, function() {
                                alertify.success("Ok");
                            });
                            // alert(errorMessage);
                        });
                    } else {
                        alertify.alert("Erro", "Ocorreu um erro inesperado", function() {
                            alertify.success("Ok");
                        });
                        // alert('Ocorreu um erro inesperado');
                    }
                });
        });

        // ========== Atalho de Teclado: CMD/CTRL+ALT+S ==========
        /**
         * Atalho para clicar no botão "Sincronizar Todos"
         * Funciona com Cmd+Alt+S (macOS) ou Ctrl+Alt+S (Windows/Linux)
         * @author Augusto Kussema
         * @date 28/11/2025 às 14:45 (Luanda)
         */
        document.addEventListener('keydown', function(e) {
            // Detectar (CMD ou CTRL) + ALT + S
            var isModifierPressed = (e.metaKey || e.ctrlKey); // metaKey = Cmd no Mac, ctrlKey = Ctrl no Windows

            if (isModifierPressed && e.altKey && e.key.toLowerCase() === 's') {
                e.preventDefault();

                var btn = document.getElementById('btnSincronizarGlobal');
                if (btn && !btn.disabled) {
                    // Clica no botão para acionar a sincronização
                    btn.click();
                    showToast('Sincronização acionada via atalho!', 'info', '', 2000);
                }
            }
        });

        // ========== Handler: Sincronizar Todos os Produtos ==========
        /**
         * Sincroniza todos os produtos do estoque em lote usando endpoint otimizado
         * @author Augusto Kussema
         * @date 04/11/2025 às 10:30 (Luanda)
         */
        (function(){
            function attachGlobalSyncHandler() {
                var btn = document.getElementById('btnSincronizarGlobal');
                if (!btn) return false;

                btn.addEventListener('click', function() {
                    if (this.disabled) return;

                    // Confirmar ação
                    if (!confirm('Deseja sincronizar TODOS os produtos do estoque com quantidade zerada?\n\nIsso calculará automaticamente as quantidades a partir do descritivo.')) {
                        return;
                    }

                    var btnEl = this;
                    var btnText = btnEl.querySelector('span:not(#btnSyncSpinner)');
                    var btnSpinner = document.getElementById('btnSyncSpinner');
                    var btnIcon = btnEl.querySelector('i');

                    // Desabilitar botão e mostrar spinner
                    btnEl.disabled = true;
                    if (btnIcon) btnIcon.style.display = 'none';
                    if (btnText) btnText.style.display = 'none';
                    if (btnSpinner) btnSpinner.style.display = 'inline-flex';

                    showToast('Iniciando sincronização em lote...', 'info', 'Sincronização', 2000);

                    // Chamar endpoint de sincronização em lote
                    fetch('{{ route('estoque.sincronizarTodos') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({
                            area_id: {{ $ah->id ?? 'null' }}
                        })
                    })
                    .then(function(response) {
                        if (!response.ok) throw new Error('Erro na sincronização');
                        return response.json();
                    })
                    .then(function(data) {
                        // Restaurar botão
                        btnEl.disabled = false;
                        if (btnIcon) btnIcon.style.display = 'inline-block';
                        if (btnText) btnText.style.display = 'inline';
                        if (btnSpinner) btnSpinner.style.display = 'none';

                        // Recarregar tabela
                        try {
                            if (window.jQuery && window.jQuery.fn.dataTable) {
                                window.jQuery('#table-c').DataTable().ajax.reload(null, false);
                            }
                        } catch(e) {
                            console.warn('Erro ao recarregar tabela:', e);
                        }

                        // Mostrar resultado
                        var percentual = data.total > 0 ? Math.round((data.sincronizados / data.total) * 100) : 0;
                        var mensagem = data.sincronizados + ' de ' + data.total + ' produtos sincronizados (' + percentual + '%)';

                        if (data.erros > 0) {
                            mensagem += ' - ' + data.erros + ' erros';
                            showToast(mensagem, 'warning', 'Sincronização Concluída', 5000);
                        } else if (data.sincronizados === 0) {
                            showToast('Nenhum produto precisou ser sincronizado', 'info', 'Sincronização', 3000);
                        } else {
                            showToast(mensagem, 'success', 'Sincronização Concluída', 5000);
                        }
                    })
                    .catch(function(err) {
                        console.error('Erro ao sincronizar:', err);

                        // Restaurar botão
                        btnEl.disabled = false;
                        if (btnIcon) btnIcon.style.display = 'inline-block';
                        if (btnText) btnText.style.display = 'inline';
                        if (btnSpinner) btnSpinner.style.display = 'none';

                        showToast('Erro ao sincronizar produtos', 'error', 'Erro', 4000);
                    });
                });

                return true;
            }

            // Anexar handler
            if (!attachGlobalSyncHandler()) {
                document.addEventListener('DOMContentLoaded', attachGlobalSyncHandler);
            }
        })();
    </script>
@endsection

@include('prepharma.estoque._productHistory')
@include('prepharma.estoque._addStock')
@include('prepharma.estoque._darBaixa')
@include('prepharma.estoque._productDetails')

<!-- Small resilient script: attach keyboard toggle and delegated click handler AFTER all other scripts to avoid being blocked by earlier JS errors -->
<script>
    (function(){
        // Keyboard: CMD/CTRL + ALT + S aciona sincronização
        document.addEventListener('keydown', function(e) {
            try {
                var isModifierPressed = (e.metaKey || e.ctrlKey);
                if (isModifierPressed && e.altKey && e.key && e.key.toLowerCase() === 's') {
                    e.preventDefault();
                    var btn = document.getElementById('btnSincronizarGlobal');
                    if (btn && !btn.disabled) {
                        btn.click();
                        showToast('Sincronização acionada!', 'info');
                    } else if (btn && btn.disabled) {
                        showToast('Aguarde a sincronização em andamento', 'warning');
                    } else {
                        showToast('Botão de sincronização não encontrado', 'warning');
                    }
                }
            } catch (err) {
                console.warn('Erro no atalho de teclado:', err);
            }
        });

        // Delegated click handler: in case direct binding failed earlier
        document.addEventListener('click', function(e) {
            // Sync Global button (delegated)
            var syncBtn = e.target.closest && e.target.closest('#btnSincronizarGlobal');
            if (syncBtn) {
                try { syncBtn.dispatchEvent(new Event('syncAllTrigger')); } catch(err) { console.warn('Erro ao disparar syncAllTrigger', err); }
                return;
            }

            // Details button (fallback if jQuery handler didn't attach)
            var det = e.target.closest && e.target.closest('.btn-detalhes');
            if (det) {
                try {
                    var produtoId = det.getAttribute('data-id');
                    if (!produtoId) return;

                    var offcanvasEl = document.getElementById('productDetailsOffcanvas');
                    if (!offcanvasEl) return;
                    var off = new bootstrap.Offcanvas(offcanvasEl);
                    off.show();

                    var content = document.getElementById('productDetailsContent');
                    if (content) {
                        content.innerHTML = `\n                            <div class="text-center py-5">\n                                <div class="spinner-border text-primary" role="status">\n                                    <span class="visually-hidden">A carregar...</span>\n                                </div>\n                            </div>`;
                    }

                    // Fetch details via vanilla fetch
                    fetch('/estoque/produto/' + produtoId + '/detalhes', { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                        .then(function(r){ if (!r.ok) throw r; return r.json(); })
                        .then(function(json){
                            if (json && json.success && json.produto) {
                                var p = json.produto;
                                var html = '';
                                html += '<div class="detail-section">';
                                html += '<h6><i class="fa fa-pills me-2"></i>Identificação</h6>';
                                html += '<div class="detail-item"><span class="detail-label">Designação:</span><span class="detail-value">' + (p.designacao||'-') + '</span></div>';
                                html += '<div class="detail-item"><span class="detail-label">Dosagem:</span><span class="detail-value">' + (p.dosagem||'-') + '</span></div>';
                                html += '</div>';
                                html += '<div class="detail-section">';
                                html += '<h6><i class="fa fa-boxes me-2"></i>Quantidades</h6>';
                                html += '<div class="detail-item"><span class="detail-label">Quantidade:</span><span class="detail-value text-primary fw-bold">' + (p.quantidade||0) + '</span></div>';
                                html += '<div class="detail-item"><span class="detail-label">Lote:</span><span class="detail-value">' + (p.num_lote||'-') + '</span></div>';
                                html += '</div>';
                                if (p.obs) html += '<div class="detail-section"><h6><i class="fa fa-comment me-2"></i>Observações</h6><div class="obs-box">' + p.obs + '</div></div>';
                                if (content) content.innerHTML = html;
                            } else {
                                if (content) content.innerHTML = '<div class="text-center py-4">Não foi possível carregar detalhes.</div>';
                            }
                        }).catch(function(err){
                            console.error('Erro ao buscar detalhes (fallback):', err);
                            if (content) content.innerHTML = '<div class="text-center py-4">Erro ao carregar detalhes.</div>';
                        });
                } catch (err) { console.warn('Erro no fallback de detalhes:', err); }
            }
        });

        // If earlier guarded handler attached custom listener for 'syncAllTrigger', it will run; otherwise attach fallback simple action
        var btn = document.getElementById('btnSincronizarGlobal');
        if (btn && !btn._syncFallbackAttached) {
            btn.addEventListener('syncAllTrigger', function(){
                // Try to trigger click on the button (this will call the main handler if attached)
                try { btn.click(); } catch(e) { console.warn(e); }
            });
            // fallback: if no handler attached and user clicks, run a lightweight action
            btn.addEventListener('click', function(){
                // if main handler attached (guarded one), it will run; otherwise show a toast
                setTimeout(function(){
                    // check if button still disabled or spinner shown; if not, and no sync started, show info
                    if (!btn.classList.contains('running')) {
                        showToast('Sincronização iniciada (fallback)', 'info');
                    }
                }, 200);
            });
            btn._syncFallbackAttached = true;
        }
    })();
</script>
