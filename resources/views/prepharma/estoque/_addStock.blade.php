{{--
/**
 * Offcanvas para Adicionar Estoque
 * @author Augusto Kussema
 * @date 03/11/2025 às 15:45 (Luanda)
 * @description Offcanvas moderno com animações suaves para adicionar quantidade ao estoque
 */
--}}
<style>
    /* ========== Offcanvas Adicionar Estoque ========== */
    .offcanvas-add-stock {
        --bs-offcanvas-width: min(50vw, 600px) !important;
        box-shadow: -4px 0 24px rgba(0,0,0,0.12);
    }

    .offcanvas-add-stock .offcanvas-header {
        position: sticky;
        top: 0;
        z-index: 10;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        border: none;
    }

    .offcanvas-add-stock .offcanvas-header h5 {
        color: white;
        font-weight: 600;
        font-size: 1.25rem;
        margin: 0;
    }

    .offcanvas-add-stock .offcanvas-header small {
        color: rgba(255,255,255,0.85);
        font-size: 0.875rem;
    }

    .offcanvas-add-stock .btn-close {
        filter: brightness(0) invert(1);
        opacity: 0.9;
    }

    .offcanvas-add-stock .btn-close:hover { opacity: 1; }

    .offcanvas-add-stock .offcanvas-body {
        padding: 2rem;
        background: #f8f9fa;
    }

    /* Form Styles */
    .form-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }

    .form-card .form-label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-card .form-label i {
        color: #667eea;
    }

    .form-card .form-control,
    .form-card textarea {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.75rem;
        transition: all 0.2s;
    }

    .form-card .form-control:focus,
    .form-card textarea:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .form-card .form-control-lg {
        font-size: 1.25rem;
        font-weight: 600;
        text-align: center;
        color: #667eea;
    }

    .form-hint {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 0.5rem;
        font-size: 0.875rem;
        color: #718096;
    }

    .form-hint i {
        color: #667eea;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 1rem;
        padding: 1.5rem;
        background: white;
        border-top: 1px solid #e2e8f0;
        position: sticky;
        bottom: 0;
    }

    .action-buttons .btn {
        flex: 1;
        border-radius: 8px;
        padding: 0.875rem;
        font-weight: 600;
        transition: all 0.2s;
    }

    .action-buttons .btn-success {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
    }

    .action-buttons .btn-success:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .action-buttons .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Spinner Custom */
    .btn .spinner-custom {
        display: inline-block;
        width: 16px;
        height: 16px;
        border: 2px solid rgba(255,255,255,0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.6s linear infinite;
    }
</style>

<div class="offcanvas offcanvas-end offcanvas-add-stock" tabindex="-1" id="offcanvasAddStock" aria-labelledby="offcanvasAddStockLabel">
    <div class="offcanvas-header">
        <div>
            <h5 id="offcanvasAddStockLabel">
                <i class="fa fa-plus-circle me-2"></i>Adicionar Estoque
            </h5>
            <small id="offcanvasAddStockSubtitle">Preencher detalhes do produto</small>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
    </div>

    <div class="offcanvas-body">
        <form id="formAdicionarEstoque">
            <input type="hidden" name="produto_id" id="add_produto_id">

            <div class="form-card">
                <label class="form-label">
                    <i class="fa fa-box"></i>
                    Quantidade a Adicionar *
                </label>
                <input type="number" min="1" class="form-control form-control-lg"
                       id="add_quantidade" name="quantidade" value="0"
                       placeholder="0" required>
                <div class="form-hint">
                    <i class="fa fa-info-circle"></i>
                    <span>Informe a quantidade total em unidades</span>
                </div>
            </div>

                <script>
                    // Inicialização do Select2 para fornecedores dentro do offcanvas Adicionar Estoque
                    document.addEventListener('DOMContentLoaded', function () {
                        var ocEl = document.getElementById('offcanvasAddStock');
                        if (!ocEl) return;

                        ocEl.addEventListener('shown.bs.offcanvas', function () {
                            var $sel = $('#add_fornecedor_select');
                            if (!$sel.length) return;

                            if (typeof $sel.select2 !== 'function') {
                                console.warn('Select2 não disponível');
                                return;
                            }

                            if ($sel.hasClass('select2-hidden-accessible')) return; // já inicializado

                            try {
                                $sel.select2({
                                    width: '100%',
                                    dropdownParent: $('#offcanvasAddStock'),
                                    placeholder: 'Selecionar fornecedor...',
                                    allowClear: true,
                                    ajax: {
                                        url: '/api/fornecedores',
                                        dataType: 'json',
                                        delay: 250,
                                        data: function (params) {
                                            return { nome: params.term || '' };
                                        },
                                        processResults: function (data) {
                                            var results = [];
                                            if (data && data.data) {
                                                results = data.data.map(function (f) {
                                                    var text = f.nome || '';
                                                    if (f.nif) text += ' — ' + f.nif;
                                                    return { id: f.id, text: text, raw: f };
                                                });
                                            }
                                            // Opção fixa para ajustes sem fornecedor
                                            results.unshift({ id: '_revisao_', text: 'Revisão Estoque', raw: null });
                                            return { results: results };
                                        },
                                        cache: true
                                    }
                                });

                                $sel.on('select2:select', function (e) {
                                    var item = e.params && e.params.data ? e.params.data : null;
                                    var nome = '';
                                    if (item) {
                                        if (item.id === '_revisao_') {
                                            nome = 'Revisão Estoque';
                                        } else if (item.raw && item.raw.nome) {
                                            nome = item.raw.nome;
                                        } else if (item.text) {
                                            // Remover NIF do texto quando usado como nome
                                            nome = String(item.text).split(' — ')[0];
                                        }
                                    }
                                    var hidden = document.getElementById('add_fornecedor');
                                    if (hidden) hidden.value = nome;
                                });

                                $sel.on('select2:clear', function () {
                                    var hidden = document.getElementById('add_fornecedor');
                                    if (hidden) hidden.value = '';
                                });
                            } catch (e) {
                                console.warn('Falha ao inicializar Select2 do fornecedor:', e);
                            }
                        });
                    });
                </script>

            <div class="form-card">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fa fa-barcode"></i>
                            Lote
                        </label>
                        <input type="text" class="form-control" id="add_lote"
                               name="num_lote" placeholder="Ex: L2024-001">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            <i class="fa fa-truck"></i>
                            Fornecedor
                        </label>
                        <select class="form-control" id="add_fornecedor_select" style="width: 100%"
                                data-placeholder="Selecionar fornecedor..."></select>
                        <input type="hidden" id="add_fornecedor" name="fornecedor">
                        <div class="form-hint">
                            <i class="fa fa-search"></i>
                            <span>Pesquise por nome ou NIF do fornecedor</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="form-label">
                        <i class="fa fa-comment"></i>
                        Observações
                    </label>
                    <textarea class="form-control" id="add_obs" name="obs"
                              rows="3" placeholder="Observações adicionais (opcional)"></textarea>
                </div>
            </div>
        </form>
    </div>

    <div class="action-buttons">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">
            <i class="fa fa-times me-2"></i>Cancelar
        </button>
        <button type="submit" class="btn btn-success" id="add_submit_btn" form="formAdicionarEstoque">
            <span id="add_submit_text">
                <i class="fa fa-check me-2"></i>Adicionar
            </span>
            <span id="add_submit_spinner" style="display:none;">
                <span class="spinner-custom"></span>
                <span class="ms-2">A Processar...</span>
            </span>
        </button>
    </div>
</div>
