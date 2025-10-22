<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header border-bottom">
        <div>
            <h5 id="offcanvasRightLabel" class="mb-0">Histórico do produto</h5>
            <small id="offcanvasRightSubtitle" class="text-muted">Registos de alterações, entradas e saídas</small>
        </div>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
    </div>
    <div class="offcanvas-body p-3">
        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-search"></i></span>
                <input id="history_search" class="form-control" placeholder="Filtrar histórico (ex: entrada, 2025-10)" />
                <button id="history_refresh" class="btn btn-outline-secondary" title="Atualizar"><i class="fa fa-sync"></i></button>
            </div>
        </div>

        <div id="history_timeline" class="timeline list-unstyled" style="max-height:60vh; overflow:auto;">
            <!-- Exemplo de item de timeline -->
            <div class="d-flex mb-3">
                <div class="me-3">
                    <span class="badge bg-primary rounded-circle" style="width:38px; height:38px; display:flex; align-items:center; justify-content:center;">A</span>
                </div>
                <div class="flex-fill">
                    <div class="d-flex justify-content-between">
                        <div>
                            <strong class="history-action">Adição</strong>
                            <div class="text-muted small history-meta">por Augusto Kussema — 2 dias atrás</div>
                        </div>
                        <div class="text-end small text-muted history-qty">+40 unidades</div>
                    </div>
                    <div class="history-message mt-1">Lote: <strong>LT-2025-01</strong>. Observações: entrada via fornecedor X.</div>
                </div>
            </div>

            <!-- Os itens reais serão carregados dinamicamente via JS -->
        </div>

        <div id="history_empty" class="text-center text-muted mt-4" style="display:none;">
            <i class="fa fa-clock fa-2x mb-2"></i>
            <div>Nenhum histórico encontrado para este produto.</div>
        </div>

        <div class="mt-3 text-end">
            <button id="history_close" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="offcanvas">Fechar</button>
        </div>
    </div>
</div>