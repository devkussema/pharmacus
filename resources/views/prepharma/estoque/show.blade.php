@extends('layout.app')

@section('titulo', 'Estoque ' . $ah->nome)

@section('content')
    <style>
        .action-row {
            background-color: #f8f9fa;
        }

        /* Coloca os botões alinhados à esquerda com espaçamento consistente */
        .action-buttons {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 8px;
            padding: 10px;
        }

        .action-buttons button {
            margin: 0;
        }

        /* Overlay de loading */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-overlay.active {
            display: flex;
        }

        .loading-spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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

    <div class="content">
        @include('partials.session')
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('a_h.index') }}">Áreas Hospitalares</a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Ver todas</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table show-entire">
                    <div class="card-body">
                        <div class="page-table-header mb-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="doctor-table-blk">
                                        <h3>Estoque {{ $ah->nome }}</h3>
                                        <div class="doctor-search-blk mt-2">
                                            <div class="top-nav-search table-search-blk">
                                                <form id="form_search" method="POST">
                                                    <input type="text" id="search-table"
                                                        class="form-control outline-success" placeholder="Procure aqui">
                                                    <a class="btn">
                                                        <img src="{{ asset('prepharma/img/icons/search-normal.svg') }}" alt>
                                                    </a>
                                                </form>
                                            </div>
                                            <div class="add-group">
                                                @if (isAdministrator() or auth()->user()->pode_cadastrar_produtos)
                                                    <button
                                                        onclick="location.href = '{{ route('estoque.cadastrar', ['area_id' => $ah->id]) }}'"
                                                        class="btn btn-rounded btn-outline-primary ms-2">
                                                        <img src="{{ asset('prepharma/img/icons/plus.svg') }}" alt>
                                                        Adicionar Produto
                                                    </button>
                                                @endif
                                                <button
                                                    onclick="location.href = '{{ route('estoque.solicitar', ['id' => $ah->id]) }}';"
                                                    class="btn btn-rounded btn-outline-success ms-2">
                                                    <i class="fa fa-box"></i>
                                                    Solicitar
                                                </button>
                                                <button
                                                    onclick="location.href = '{{ route('estoque._minimo', ['id' => $ah->id]) }}';"
                                                    class="btn btn-rounded btn-outline-success ms-2">
                                                    <i class="fa fa-box"></i>
                                                    Adicionar Estoque Minimo
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @include('estoque.modalAddProduto')
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="{{ route('print.view', ['estoque_id' => $ah->id]) }}" id="imprimir-pagina"
                                        target="_blank" class=" me-2">
                                        <img src="{{ asset('prepharma/img/icons/pdf-icon-01.svg') }}" alt>
                                    </a>
                                    {{-- <a href="javascript:;" class=" me-2"><img
                                            src="{{ asset('prepharma/img/icons/pdf-icon-02.svg') }}" alt></a>
                                    <a href="javascript:;" class=" me-2"><img
                                            src="{{ asset('prepharma/img/icons/pdf-icon-03.svg') }}" alt></a>
                                    <a href="javascript:;" id="alert"><img
                                            src="{{ asset('prepharma/img/icons/pdf-icon-04.svg') }}" alt></a> --}}
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table border-0 custom-table comman-table datatable mb-0 table-produto" id="table-c">
                                <thead>
                                    <tr>
                                        <th>Designação</th>
                                        <th>Dosagem</th>
                                        <th>Forma</th>
                                        <th>Status</th>
                                        <th>Prateleira</th>
                                        <th>Lote</th>
                                        <th>Quantidade</th>
                                        <th>Qtd. Caixa</th>
                                        <th>Qtd. Unit.</th>
                                        <th>Inserido em</th>
                                        <th>Data Expiração</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal para dar baixa --}}
        <div class="modal fade" id="DarBaixa" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="tituloModal">Dar baixa</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formBaixaEstoque" action="{{ route('estoque.baixa') }}" method="POST">
                            @csrf
                            @php
                                $area_h_id = @$area_id;
                                $farmacia_id = @auth()->user()->isFarmacia->farmacia_id
                                    ? auth()->user()->isFarmacia->farmacia_id
                                    : @auth()->user()->area_hospitalar->area_hospitalar->farmacia_id;
                            @endphp
                            <div class="form-group pb-3">
                                <label for="qtd_">Designação</label>
                                <input type="text" name="designacao" class="form-control" id="designacao"
                                    min="1">
                            </div>
                            <div class="form-group pb-3">
                                <label for="endereco">Área *</label>
                                <input type="hidden" name="user_id" id="user_id">
                                <select name="area_hospitalar_id" id="" class="form-control">
                                    @foreach (\App\Models\FarmaciaAreaHospitalar::where('farmacia_id', $farmacia_id)->get() as $ahw)
                                        @if ($ahw->area_hospitalar->id != $area_h_id)
                                            <option value="{{ $ahw->area_hospitalar->id }}">
                                                {{ $ahw->area_hospitalar->nome }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group pb-3">
                                <input type="hidden" name="produto_id" id="id_produto">
                                <input type="hidden" name="quantidade_disponivel" id="quantidade_disponivel">

                                <label for="quantidade_atual_display">Quantidade Atual (unidades)</label>
                                <input type="number" name="quantidade_atual_display" class="form-control form-control-lg mb-3" id="quantidade_atual_display" disabled>

                                <label for="qtd_">Quantidade a Transferir (unidades) *</label>
                                <input type="number" name="quantidade" class="form-control form-control-lg" id="baixa_quantidade"
                                    placeholder="Ex: 100" min="1" required>
                                <small class="form-text text-muted">
                                    Informe quantas unidades deseja transferir para outra área
                                </small>
                            </div>

                            <div class="form-group pb-3">
                                <label for="movement_date">Data do movimento</label>
                                <input type="datetime-local" name="movement_date" id="movement_date" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Confirmação -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteLabel">Confirmar Exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir este produto?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Confirmar</button>
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
                        { data: "produto.forma" },
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
                        {
                            data: function(row) {
                                return row.produto?.prateleira?.nome ? getCaixa(row.produto.prateleira.nome) : '--';
                            }
                        },
                        { data: "produto.num_lote" },
                        { data: "produto.quantidade" },
                        { data: function(row) { return getCaixa(row.produto.descritivo); } },
                        { data: "produto.saldo.qtd" },
                        { data: function(row) { return formatDate(row.created_at); } },
                        { data: function(row) { return formatDate(row.produto.data_expiracao); } },
                        { data: null, defaultContent: "" }
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
                        <td colspan="11">
                            <div class="action-buttons">
                                <button class="btn btn-success btn-add" data-id="${data.produto.id}" data-descritivo="${data.produto.descritivo}" title="Adicionar" aria-label="Adicionar">
                                    <i class="fa fa-plus me-1" aria-hidden="true"></i> Adicionar
                                </button>
                                <button class="btn btn-primary btn-editar" data-id="${data.produto.id}" title="Editar" aria-label="Editar">
                                    <i class="fa fa-edit me-1" aria-hidden="true"></i> Editar
                                </button>
                                <button class="btn btn-secondary btn-sincronizar" data-id="${data.produto.id}" title="Sincronizar" aria-label="Sincronizar">
                                    <i class="fa fa-sync me-1" aria-hidden="true"></i> Sincronizar
                                </button>
                                <button class="btn btn-outline-info btn-historico" data-id="${data.produto.id}" title="Ver Histórico" aria-label="Histórico">
                                    <i class="fa fa-history me-1"></i> Histórico
                                </button>
                                <button class="btn btn-warning btn-dar-baixa" data-id="${data.produto.id}" data-designacao="${data.produto.designacao}" data-quantidade="${data.produto.quantidade || 0}" title="Dar Baixa" aria-label="Dar Baixa">
                                    <i class="fa fa-arrow-down me-1" aria-hidden="true"></i> Dar Baixa
                                </button>
                                <button class="btn btn-danger btn-eliminar-item" data-id="${data.produto.id}" title="Eliminar" aria-label="Eliminar">
                                    <i class="fa fa-trash me-1" aria-hidden="true"></i> Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>`;

                row.after(actionRow);
            });

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
                document.getElementById('offcanvasRightSubtitle').innerText = 'Carregando histórico...';

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
                    'updated': 'Atualizado',
                    'stock_in': 'Entrada de estoque',
                    'stock_out': 'Saída de estoque',
                    'deleted': 'Eliminado',
                    'transfer': 'Transferência'
                };

                // Carregar histórico com filtros e paginação
                var currentHistoryRequest = null;

                function renderHistoryItems(list, meta) {
                    timeline.innerHTML = '';
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
                        var createdFmt = item.movement_date_fmt || item.created_at_fmt || '';
                        var labelPT = actionLabelsPT[action] || (action || '').replace('_', ' ');

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
                                            </div>
                                        </div>
                                        <span class="history-qty ${qtyClass}">${qtyText}</span>
                                    </div>
                                    ${item.summary_pt ? '<div class="history-message">'+item.summary_pt+'</div>' : (item.payload && item.payload.num_lote ? '<div class="history-message">Lote: <strong>'+item.payload.num_lote+'</strong>' + (item.payload.obs ? ' • ' + item.payload.obs : '') + '</div>' : '')}
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

                    document.getElementById('offcanvasRightSubtitle').innerText = 'Carregando histórico...';
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

                $.ajax({
                    url: '/api/produtos_/' + produtoId,
                    type: 'DELETE',
                    success: function(response) {
                        $('#confirmDeleteModal').modal('hide');
                        showToast('Produto eliminado com sucesso!', 'success', 'Eliminado!');
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        console.error("Erro ao excluir: ${produtoId}", xhr.responseText);
                        showToast('Erro ao eliminar o produto', 'error', 'Erro!');
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

        // --- Modal sofisticada para Adicionar Estoque (caixa, caixinha, unidade, lote, fornecedor, obs) ---
        (function insertAddModal() {
            if (!document.getElementById('modalAdicionarEstoque')) {
                var modalHtml = `
                <div class="modal fade modal-offcanvas-style" id="modalAdicionarEstoque" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div>
                                    <h5 class="modal-title">
                                        <i class="fa fa-plus-circle me-2"></i>
                                        Adicionar Estoque
                                    </h5>
                                    <small style="opacity: 0.9; font-size: 0.85rem;">Preencher detalhes do produto</small>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formAdicionarEstoque">
                                    <input type="hidden" name="produto_id" id="add_produto_id">

                                    <div class="mb-4">
                                        <label class="form-label">
                                            <i class="fa fa-box me-1"></i>
                                            Quantidade a Adicionar (unidades) *
                                        </label>
                                        <input type="number" min="1" class="form-control form-control-lg"
                                               id="add_quantidade" name="quantidade" value="0"
                                               placeholder="Ex: 500" required>
                                        <small class="text-muted d-block mt-2">
                                            <i class="fa fa-info-circle me-1"></i>
                                            Informe a quantidade total em unidades
                                        </small>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                <i class="fa fa-barcode me-1"></i>
                                                Lote
                                            </label>
                                            <input type="text" class="form-control" id="add_lote"
                                                   name="num_lote" placeholder="Ex: L2024-001">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">
                                                <i class="fa fa-truck me-1"></i>
                                                Fornecedor
                                            </label>
                                            <input type="text" class="form-control" id="add_fornecedor"
                                                   name="fornecedor" placeholder="Nome do fornecedor">
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label">
                                            <i class="fa fa-comment me-1"></i>
                                            Observações
                                        </label>
                                        <textarea class="form-control" id="add_obs" name="obs"
                                                  rows="3" placeholder="Observações adicionais (opcional)"></textarea>
                                    </div>

                                    <div class="d-flex gap-2 pt-3 border-top">
                                        <button type="button" class="btn btn-secondary flex-fill" data-bs-dismiss="modal">
                                            <i class="fa fa-times me-2"></i>Cancelar
                                        </button>
                                        <button type="submit" class="btn btn-success flex-fill" id="add_submit_btn">
                                            <span id="add_submit_text">
                                                <i class="fa fa-check me-2"></i>Adicionar
                                            </span>
                                            <span id="add_submit_spinner" style="display:none;">
                                                <span class="spinner-custom"></span>
                                                <span class="ms-2">Processando...</span>
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>`;

                document.body.insertAdjacentHTML('beforeend', modalHtml);
            }
        })();

        // Abrir modal ao clicar em Adicionar
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

            var modal = new bootstrap.Modal(document.getElementById('modalAdicionarEstoque'));
            modal.show();
        });

        // Envio via AJAX (melhor UX: spinner, disable inputs, toast notifications)
        document.addEventListener('submit', function(e) {
            if (e.target && e.target.id === 'formAdicionarEstoque') {
                e.preventDefault();
                var form = e.target;
                var fd = new FormData(form);

                var quantidade = parseInt(document.getElementById('add_quantidade').value || 0, 10);
                fd.set('quantidade', quantidade);

                // incluir area_hospitalar_id no payload se estiver disponível na página
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

                    // Close modal after short delay
                    setTimeout(function() {
                        var modalEl = document.getElementById('modalAdicionarEstoque');
                        var modal = bootstrap.Modal.getInstance(modalEl);
                        if (modal) modal.hide();

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

        document.getElementById('imprimir-pagina').addEventListener('click', function(e) {
            e.preventDefault(); // Evita que o link seja seguido imediatamente

            // Redireciona para a página específica em uma nova aba
            var novaAba = window.open(this.href, '_blank');

            // Espera até que a página seja completamente carregada na nova aba
            novaAba.onload = function() {
                // Imprime a página
                novaAba.print();
            };
        });

        function modalDarBaixa(id_produto, descritivo, designacao, quantidade) { //formBaixaEstoque
            $('#DarBaixa #formBaixaEstoque #id_produto').val(id_produto);
            $('#DarBaixa #formBaixaEstoque #designacao').val(designacao);
            $('#DarBaixa #formBaixaEstoque #designacao').prop("disabled", true);

            // Armazenar quantidade disponível para validação
            $('#DarBaixa #formBaixaEstoque #quantidade_disponivel').val(quantidade || 0);
            $('#DarBaixa #formBaixaEstoque #quantidade_atual_display').val(quantidade || 0);
            $('#DarBaixa #formBaixaEstoque #baixa_quantidade').attr('max', quantidade || 0);
            $('#DarBaixa #formBaixaEstoque #baixa_quantidade').val(''); // limpar campo

            // set default movement_date to now (local) formatted for datetime-local
            try {
                const now = new Date();
                const tzOffset = now.getTimezoneOffset() * 60000; // offset in ms
                const localISOTime = new Date(now - tzOffset).toISOString().slice(0,16);
                $('#DarBaixa #formBaixaEstoque #movement_date').val(localISOTime);
            } catch (e) {
                // ignore if element not found
            }

            $('#DarBaixa').modal('show');
        }

        // Inicializar Select2 dentro da modal ao ser exibida (evita problemas de z-index e inicialização prematura)
        $('#DarBaixa').on('shown.bs.modal', function() {
            var $sel = $(this).find('select[name="area_hospitalar_id"]');
            if ($sel.length) {
                try {
                    if (!$sel.hasClass('select2-hidden-accessible')) {
                        $sel.select2({ width: '100%', dropdownParent: $(this) });
                    }
                } catch (e) {
                    // se select2 não estiver disponível, ignorar silenciosamente
                    console.warn('Select2 não disponível para o select da modal DarBaixa');
                }
            }
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
    </script>
@endsection

@include('prepharma.estoque._productHistory')
