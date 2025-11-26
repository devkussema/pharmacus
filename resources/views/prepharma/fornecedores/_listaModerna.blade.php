<style>
    /* ========== Design Moderno Lista Fornecedores ========== */
    .fornecedores-container {
        padding: 20px;
        background: #f8f9fa;
    }

    .fornecedores-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .toolbar-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        align-items: center;
        justify-content: space-between;
        padding: 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
    }

    .toolbar-actions .search-box {
        flex: 1;
        max-width: 400px;
        position: relative;
    }

    .toolbar-actions .search-box input {
        width: 100%;
        padding: 10px 15px 10px 40px;
        border-radius: 25px;
        border: none;
        outline: none;
    }

    .toolbar-actions .search-box i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #999;
    }

    .toolbar-actions .action-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .toolbar-actions .btn {
        padding: 8px 20px;
        border-radius: 25px;
        font-weight: 500;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-add-fornecedor {
        background: #28a745;
        color: #fff;
    }

    .btn-add-fornecedor:hover {
        background: #218838;
        transform: translateY(-2px);
    }

    /* Filtros */
    .filters-section {
        padding: 20px;
        background: #f8f9fa;
        border-bottom: 1px solid #e0e0e0;
    }

    /* Tabela */
    .table-responsive {
        padding: 20px;
    }

    .table-fornecedores {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px;
    }

    .table-fornecedores thead {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
    }

    .table-fornecedores thead th {
        padding: 15px;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border: none;
    }

    .table-fornecedores tbody tr {
        background: #fff;
        transition: all 0.3s ease;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .table-fornecedores tbody tr:hover {
        background: #f8f9fa;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .table-fornecedores tbody tr.row-selected {
        background: #e3f2fd !important;
    }

    .table-fornecedores tbody td {
        padding: 15px;
        vertical-align: middle;
        border: none;
    }

    /* Action Buttons */
    .action-buttons {
        display: none;
        gap: 8px;
        animation: fadeIn 0.3s ease;
    }

    .table-fornecedores tbody tr.row-selected .action-buttons {
        display: flex;
    }

    .action-buttons .btn {
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 0.85rem;
        border: none;
        transition: all 0.3s ease;
    }

    .action-buttons .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Badges */
    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.85rem;
    }

    .badge-success {
        background: #28a745;
        color: #fff;
    }

    .badge-warning {
        background: #ffc107;
        color: #333;
    }

    .badge-danger {
        background: #dc3545;
        color: #fff;
    }

    .badge-info {
        background: #17a2b8;
        color: #fff;
    }

    .badge-primary {
        background: #007bff;
        color: #fff;
    }

    /* Loading overlay */
    .loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(255, 255, 255, 0.9);
        z-index: 9999;
        place-items: center;
    }

    .loading-overlay.active {
        display: grid;
    }

    .loading-spinner {
        width: 60px;
        height: 60px;
        border: 5px solid #f3f3f3;
        border-top: 5px solid #667eea;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<!-- Loading Overlay -->
<div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
</div>

<div class="fornecedores-container">
    <div class="fornecedores-card">
        <!-- Toolbar de Ações -->
        <div class="toolbar-actions">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="globalSearch" class="form-control" placeholder="Buscar fornecedor...">
            </div>
            <div class="action-group">
                <button class="btn btn-add-fornecedor" id="btnAddFornecedor">
                    <i class="fas fa-plus me-2"></i>Novo Fornecedor
                </button>
                <button class="btn btn-light" id="btnRefresh">
                    <i class="fas fa-sync-alt me-2"></i>Atualizar
                </button>
                <button class="btn btn-light" id="btnExportExcel">
                    <i class="fas fa-file-excel me-2"></i>Excel
                </button>
                <button class="btn btn-light" id="btnExportPDF">
                    <i class="fas fa-file-pdf me-2"></i>PDF
                </button>
            </div>
        </div>

        <!-- Filtros -->
        <div class="filters-section">
            <form id="formFiltros" class="row g-3">
                <div class="col-md-3">
                    <label for="filtroNome" class="form-label">Nome/NIF</label>
                    <input type="text" class="form-control" id="filtroNome" name="nome" placeholder="Buscar...">
                </div>
                <div class="col-md-2">
                    <label for="filtroTipo" class="form-label">Tipo</label>
                    <select class="form-select" id="filtroTipo" name="tipo">
                        <option value="">Todos</option>
                        <option value="nacional">Nacional</option>
                        <option value="internacional">Internacional</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="filtroStatus" class="form-label">Status</label>
                    <select class="form-select" id="filtroStatus" name="status">
                        <option value="">Todos</option>
                        <option value="ativo">Ativo</option>
                        <option value="inativo">Inativo</option>
                        <option value="bloqueado">Bloqueado</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="filtroAvaliacao" class="form-label">Avaliação Mín.</label>
                    <select class="form-select" id="filtroAvaliacao" name="avaliacao_min">
                        <option value="">Todas</option>
                        <option value="1">⭐ 1+</option>
                        <option value="2">⭐ 2+</option>
                        <option value="3">⭐ 3+</option>
                        <option value="4">⭐ 4+</option>
                        <option value="5">⭐ 5</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-filter me-2"></i>Filtrar
                    </button>
                    <button type="button" class="btn btn-secondary" id="btnLimparFiltros">
                        <i class="fas fa-times me-2"></i>Limpar
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabela -->
        <div class="table-responsive">
            <table class="table table-fornecedores" id="tableFornecedores">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>NIF</th>
                        <th>Contacto</th>
                        <th>Tipo</th>
                        <th>Status</th>
                        <th>Avaliação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // ========== Configuração do DataTable ==========
    let tableFornecedores;

    $(document).ready(function() {
        initDataTable();
        initEventHandlers();
    });

    function initDataTable() {
        tableFornecedores = $('#tableFornecedores').DataTable({
            ajax: {
                url: '/api/fornecedores',
                type: 'GET',
                data: function(d) {
                    d.nome = $('#filtroNome').val();
                    d.tipo = $('#filtroTipo').val();
                    d.status = $('#filtroStatus').val();
                    d.avaliacao_min = $('#filtroAvaliacao').val();
                },
                dataSrc: function(json) {
                    if (!json || !json.data) {
                        showToast('Erro ao carregar dados', 'error');
                        return [];
                    }
                    return json.data;
                },
                error: function(xhr, status, error) {
                    showToast('Erro ao carregar fornecedores: ' + error, 'error');
                }
            },
            columns: [
                {
                    data: 'nome',
                    render: function(data, type, row) {
                        return `<strong>${data || '--'}</strong>`;
                    }
                },
                {
                    data: 'nif',
                    defaultContent: '--'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        let contacto = row.whatsapp || row.telemovel || row.telefone || '--';
                        let icon = row.whatsapp ? '<i class="fab fa-whatsapp text-success me-1"></i>' :
                                   row.telemovel ? '<i class="fas fa-mobile-alt me-1"></i>' :
                                   '<i class="fas fa-phone me-1"></i>';
                        return contacto !== '--' ? icon + contacto : '--';
                    }
                },
                {
                    data: 'tipo',
                    render: function(data, type, row) {
                        if (data === 'nacional') {
                            return '<span class="badge badge-info">Nacional</span>';
                        } else if (data === 'internacional') {
                            return '<span class="badge badge-primary">Internacional</span>';
                        }
                        return '--';
                    }
                },
                {
                    data: 'status',
                    render: function(data, type, row) {
                        if (data === 'ativo') {
                            return '<span class="badge badge-success">Ativo</span>';
                        } else if (data === 'inativo') {
                            return '<span class="badge badge-warning">Inativo</span>';
                        } else if (data === 'bloqueado') {
                            return '<span class="badge badge-danger">Bloqueado</span>';
                        }
                        return '--';
                    }
                },
                {
                    data: 'avaliacao',
                    render: function(data, type, row) {
                        if (!data) return '<span class="text-muted">Sem avaliação</span>';
                        let stars = '⭐'.repeat(Math.round(data));
                        return `${stars} (${data})`;
                    }
                },
                {
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                            <div class="action-buttons">
                                <button class="btn btn-sm btn-info btn-detalhes" data-id="${row.id}">
                                    <i class="fas fa-eye"></i> Detalhes
                                </button>
                                <button class="btn btn-sm btn-primary btn-editar" data-id="${row.id}">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                                <button class="btn btn-sm btn-warning btn-historico" data-id="${row.id}">
                                    <i class="fas fa-history"></i> Histórico
                                </button>
                            </div>
                        `;
                    }
                }
            ],
            language: {
                search: 'Buscar:',
                lengthMenu: 'Mostrar _MENU_ registos',
                info: 'Mostrando _START_ a _END_ de _TOTAL_ registos',
                infoEmpty: 'Mostrando 0 a 0 de 0 registos',
                infoFiltered: '(filtrado de _MAX_ registos)',
                paginate: {
                    first: 'Primeiro',
                    last: 'Último',
                    next: 'Próximo',
                    previous: 'Anterior'
                },
                zeroRecords: 'Nenhum fornecedor encontrado',
                emptyTable: 'Nenhum dado disponível'
            },
            pageLength: 25,
            ordering: true,
            searching: true,
            processing: true,
            dom: 'rtip'
        });

        $('#tableFornecedores tbody').on('click', 'tr', function() {
            if ($(this).hasClass('row-selected')) {
                $(this).removeClass('row-selected');
            } else {
                $('#tableFornecedores tbody tr').removeClass('row-selected');
                $(this).addClass('row-selected');
            }
        });

        $('#tableFornecedores').on('click', '.btn-detalhes', function(e) {
            e.stopPropagation();
            mostrarDetalhes($(this).data('id'));
        });

        $('#tableFornecedores').on('click', '.btn-editar', function(e) {
            e.stopPropagation();
            abrirOffcanvasEditar($(this).data('id'));
        });

        $('#tableFornecedores').on('click', '.btn-historico', function(e) {
            e.stopPropagation();
            mostrarHistorico($(this).data('id'));
        });
    }

    function initEventHandlers() {
        $('#globalSearch').on('keyup', function() {
            tableFornecedores.search(this.value).draw();
        });

        $('#btnRefresh').on('click', function() {
            tableFornecedores.ajax.reload();
            showToast('Dados atualizados', 'success');
        });

        $('#formFiltros').on('submit', function(e) {
            e.preventDefault();
            tableFornecedores.ajax.reload();
        });

        $('#btnLimparFiltros').on('click', function() {
            $('#formFiltros')[0].reset();
            tableFornecedores.ajax.reload();
        });

        $('#btnAddFornecedor').on('click', function() {
            abrirOffcanvasNovo();
        });

        $('#btnExportExcel').on('click', function() {
            showToast('Exportação para Excel em desenvolvimento', 'info');
        });

        $('#btnExportPDF').on('click', function() {
            showToast('Exportação para PDF em desenvolvimento', 'info');
        });
    }

    function mostrarDetalhes(id) {
        showLoading();
        $.ajax({
            url: `/api/fornecedores/${id}`,
            type: 'GET',
            success: function(data) {
                hideLoading();
                showToast('Detalhes do fornecedor: ' + data.nome, 'info');
                console.log('Detalhes:', data);
            },
            error: function(xhr) {
                hideLoading();
                showToast('Erro ao carregar detalhes', 'error');
            }
        });
    }

    function abrirOffcanvasEditar(id) {
        showLoading();
        $.ajax({
            url: `/api/fornecedores/${id}`,
            type: 'GET',
            success: function(data) {
                hideLoading();
                popularOffcanvasEditar(data);
                const offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasEditarFornecedor'));
                offcanvas.show();
            },
            error: function(xhr) {
                hideLoading();
                showToast('Erro ao carregar fornecedor', 'error');
            }
        });
    }

    function abrirOffcanvasNovo() {
        limparOffcanvasEditar();
        const offcanvas = new bootstrap.Offcanvas(document.getElementById('offcanvasEditarFornecedor'));
        offcanvas.show();
    }

    function mostrarHistorico(id) {
        showToast('Histórico do fornecedor em desenvolvimento', 'info');
    }

    function showLoading() {
        $('#loadingOverlay').addClass('active');
    }

    function hideLoading() {
        $('#loadingOverlay').removeClass('active');
    }
</script>
