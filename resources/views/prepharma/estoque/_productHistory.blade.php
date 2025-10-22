<style>
    /* ========== Offcanvas Largura e Layout ========== */
    .offcanvas-history { 
        /* Forçar largura maior e garantir override */
        --bs-offcanvas-width: min(56vw, 920px) !important;
        box-shadow: -4px 0 24px rgba(0,0,0,0.12);
    }

    /* ========== Cabeçalho Premium ========== */
    .offcanvas-history .offcanvas-header { 
        position: sticky; 
        top: 0; 
        z-index: 10; 
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        border: none;
    }
    .offcanvas-history .offcanvas-header h5 { 
        color: white; 
        font-weight: 600;
        font-size: 1.25rem;
        margin: 0;
    }
    .offcanvas-history .offcanvas-header small { 
        color: rgba(255,255,255,0.85); 
        font-size: 0.875rem;
    }
    .offcanvas-history .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.9;
    }
    .offcanvas-history .btn-close:hover { opacity: 1; }

    /* ========== Barra de Busca Moderna ========== */
    .history-toolbar {
        background: #f8f9fa;
        padding: 1rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
    }
    .history-toolbar .input-group {
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        border-radius: 8px;
        overflow: hidden;
    }
    .history-toolbar .input-group-text {
        background: white;
        border: 1px solid #e0e0e0;
        border-right: none;
        color: #667eea;
    }
    #history_search {
        border: 1px solid #e0e0e0;
        border-left: none;
        border-right: none;
        padding: 0.65rem 1rem;
    }
    #history_search:focus {
        box-shadow: none;
        border-color: #667eea;
    }
    #history_refresh {
        background: white;
        border: 1px solid #e0e0e0;
        border-left: none;
        color: #667eea;
        transition: all 0.2s;
    }
    #history_refresh:hover {
        background: #667eea;
        color: white;
        border-color: #667eea;
    }

    /* ========== Timeline Avançada ========== */
    #history_timeline {
        max-height: calc(100vh - 320px);
        overflow-y: auto;
        overflow-x: hidden;
        padding-right: 8px;
    }
    #history_timeline::-webkit-scrollbar { width: 6px; }
    #history_timeline::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
    #history_timeline::-webkit-scrollbar-thumb { background: #667eea; border-radius: 10px; }

    /* Item da Timeline */
    .history-item {
        position: relative;
        padding: 1.25rem;
        margin-bottom: 1rem;
        background: white;
        border-radius: 12px;
        border: 1px solid #e9ecef;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        animation: slideIn 0.4s ease-out;
    }
    .history-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(102, 126, 234, 0.15);
        border-color: #667eea;
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateX(20px); }
        to { opacity: 1; transform: translateX(0); }
    }

    /* Badge de Ação com Ícone */
    .history-badge {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: transform 0.2s;
    }
    .history-item:hover .history-badge { transform: scale(1.1) rotate(5deg); }

    /* Cores por Tipo de Ação */
    .history-badge.action-created { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
    .history-badge.action-updated { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white; }
    .history-badge.action-stock_in { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); color: white; }
    .history-badge.action-stock_out { background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); color: white; }
    .history-badge.action-deleted { background: linear-gradient(135deg, #30cfd0 0%, #330867 100%); color: white; }
    .history-badge.action-transfer { background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); color: #333; }

    /* Conteúdo do Item */
    .history-content {
        flex: 1;
        min-width: 0;
    }
    .history-action-title {
        font-weight: 600;
        font-size: 1rem;
        color: #2d3748;
        margin-bottom: 0.25rem;
        text-transform: capitalize;
    }
    .history-meta {
        font-size: 0.8125rem;
        color: #718096;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    .history-meta i { color: #667eea; }
    .history-user {
        font-weight: 500;
        color: #4a5568;
    }
    .history-time {
        color: #a0aec0;
    }

    /* Quantidade (Delta) */
    .history-qty {
        display: inline-flex;
        align-items: center;
        padding: 0.375rem 0.75rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.875rem;
        white-space: nowrap;
    }
    .history-qty.positive {
        background: #d4f4dd;
        color: #147a3d;
    }
    .history-qty.negative {
        background: #ffe2e5;
        color: #c9252d;
    }
    .history-qty.neutral {
        background: #e2e8f0;
        color: #4a5568;
    }

    /* Mensagem/Detalhes */
    .history-message {
        margin-top: 0.75rem;
        padding: 0.75rem;
        background: #f7fafc;
        border-left: 3px solid #667eea;
        border-radius: 6px;
        font-size: 0.875rem;
        color: #4a5568;
    }
    .history-message strong {
        color: #2d3748;
        font-weight: 600;
    }

    /* Estado Vazio Elegante */
    #history_empty {
        padding: 3rem 1rem;
        text-align: center;
    }
    #history_empty i {
        color: #cbd5e0;
        margin-bottom: 1rem;
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
    #history_empty div {
        color: #718096;
        font-size: 0.9375rem;
    }

    /* Botão Fechar Premium */
    #history_close {
        padding: 0.5rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.2s;
    }
    #history_close:hover {
        background: #667eea;
        color: white;
        border-color: #667eea;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }
</style>

<div class="offcanvas offcanvas-end offcanvas-history" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <div>
            <h5 id="offcanvasRightLabel">
                <i class="fa fa-history me-2"></i>Histórico do produto
            </h5>
            <small id="offcanvasRightSubtitle">Registos de alterações, entradas e saídas</small>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
    </div>
    
    <div class="offcanvas-body p-3">
        <div class="history-toolbar">
            <div class="d-flex gap-2 align-items-center mb-2">
                <div class="flex-fill">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                        <input id="history_search" class="form-control" placeholder="Pesquisar no histórico..." />
                        <button id="history_refresh" class="btn" title="Atualizar">
                            <i class="fa fa-sync"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 align-items-center">
                <input id="history_from" type="date" class="form-control form-control-sm" placeholder="De" />
                <input id="history_to" type="date" class="form-control form-control-sm" placeholder="Até" />
                <select id="history_per_page" class="form-select form-select-sm" style="width:95px;">
                    <option value="10">10</option>
                    <option value="20" selected>20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <button id="history_apply" class="btn btn-sm btn-primary">Aplicar</button>
            </div>
        </div>

        <div id="history_timeline">
            <!-- Exemplo estático para preview -->
            <div class="history-item">
                <div class="d-flex gap-3 align-items-start">
                    <div class="history-badge action-stock_in">
                        <i class="fa fa-plus"></i>
                    </div>
                    <div class="history-content">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <div class="history-action-title">Entrada de estoque</div>
                                <div class="history-meta">
                                    <span class="history-user">
                                        <i class="fa fa-user-circle"></i> Augusto Kussema
                                    </span>
                                    <span class="history-time">
                                        <i class="fa fa-clock"></i> há 2 dias
                                    </span>
                                </div>
                            </div>
                            <span class="history-qty positive">+40 un</span>
                        </div>
                        <div class="history-message">
                            Lote: <strong>LT-2025-01</strong> • Fornecedor: FarmaTech S.A.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Itens dinâmicos serão inseridos aqui via JS -->
        </div>

        <div id="history_empty" style="display:none;">
            <i class="fa fa-inbox fa-3x"></i>
            <div>Nenhum histórico encontrado para este produto.</div>
        </div>

        <!-- Paginação e estado -->
        <div id="history_pagination" class="d-flex justify-content-between align-items-center mt-2">
            <div id="history_pagination_info" class="text-muted small">&nbsp;</div>
            <div id="history_pagination_controls"></div>
        </div>

        <div class="mt-3 text-end">
            <button id="history_close" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">
                <i class="fa fa-times me-1"></i> Fechar
            </button>
        </div>
    </div>
</div>