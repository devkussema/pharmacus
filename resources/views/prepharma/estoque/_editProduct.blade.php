{{--
    Offcanvas para Editar Produto Existente
    Design moderno com pré-preenchimento e AJAX

    @author Augusto Kussema
    @date 08 Dez 2025 10:45 (Luanda)
    @description Formulário completo para editar produto via AJAX com validação
--}}

<div class="offcanvas offcanvas-end offcanvas-edit-product" tabindex="-1" id="offcanvasEditProduct" aria-labelledby="offcanvasEditProductLabel">
    <div class="offcanvas-header">
        <div>
            <h5 class="offcanvas-title" id="offcanvasEditProductLabel">
                <i class="fas fa-edit me-2"></i>Editar Produto
            </h5>
            <small class="text-white-50">Atualizar informações do produto</small>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
    </div>
    <div class="offcanvas-body">
        <!-- Loading State -->
        <div id="edit_prod_loading" class="loading-container">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Carregando...</span>
            </div>
            <p class="mt-3 text-muted">Carregando dados do produto...</p>
        </div>

        <!-- Form Container -->
        <form id="formEditProduct" style="display:none;">
            @csrf
            @method('PUT')
            <input type="hidden" name="produto_id" id="edit_prod_id">

            <!-- Seção: Informações Básicas -->
            <div class="form-section">
                <h6 class="section-title">
                    <i class="fas fa-info-circle"></i>
                    Informações Básicas
                </h6>

                <div class="mb-3">
                    <label for="edit_prod_designacao" class="form-label required">
                        <i class="fas fa-tag"></i> Designação
                    </label>
                    <input type="text" class="form-control" id="edit_prod_designacao" name="designacao" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="edit_prod_tipo" class="form-label required">
                            <i class="fas fa-layer-group"></i> Tipo
                        </label>
                        <select class="form-select select2-edit-produto" id="edit_prod_tipo" name="tipo" required>
                            <option value="" disabled>Selecionar tipo</option>
                            <option value="descartável">Descartável</option>
                            <option value="medicamento">Medicamento</option>
                            <option value="liquido">Líquido</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3" id="edit_prod_dosagem_group">
                        <label for="edit_prod_dosagem" class="form-label">
                            <i class="fas fa-prescription-bottle"></i> Dosagem
                        </label>
                        <input type="text" class="form-control" id="edit_prod_dosagem" name="dosagem">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="edit_prod_forma" class="form-label required">
                        <i class="fas fa-flask"></i> Forma Farmacêutica
                    </label>
                    <select class="form-select select2-edit-produto" id="edit_prod_forma" name="forma" required>
                        <option value="" disabled>Selecione uma forma</option>
                        <optgroup label="Administração Oral">
                            <option value="Comprimidos">Comprimidos</option>
                            <option value="Cápsulas">Cápsulas</option>
                            <option value="Tabletes efervescentes">Tabletes efervescentes</option>
                            <option value="Pó para suspensão oral">Pó para suspensão oral</option>
                            <option value="Xaropes">Xaropes</option>
                            <option value="Soluções orais">Soluções orais</option>
                            <option value="Gomas mastigáveis">Gomas mastigáveis</option>
                        </optgroup>
                        <optgroup label="Administração Parenteral">
                            <option value="Injectável">Injectável</option>
                            <option value="Soros">Soros</option>
                            <option value="Implantes subcutâneos">Implantes subcutâneos</option>
                            <option value="Vacinas">Vacinas</option>
                            <option value="Pós para solução injetável">Pós para solução injetável</option>
                        </optgroup>
                        <optgroup label="Administração Tópica">
                            <option value="Cremes">Cremes</option>
                            <option value="Pomadas">Pomadas</option>
                            <option value="Géis">Géis</option>
                            <option value="Loções">Loções</option>
                            <option value="Sprays tópicos">Sprays tópicos</option>
                            <option value="Adesivos transdérmicos">Adesivos transdérmicos</option>
                        </optgroup>
                        <optgroup label="Outros">
                            <option value="Descartável">Descartável</option>
                            <option value="Não Atribuido">Não Atribuído</option>
                        </optgroup>
                    </select>
                </div>
            </div>

            <!-- Seção: Quantidade e Lote -->
            <div class="form-section">
                <h6 class="section-title">
                    <i class="fas fa-boxes"></i>
                    Quantidade e Rastreamento
                </h6>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="edit_prod_quantidade" class="form-label required">
                            <i class="fas fa-cube"></i> Quantidade
                        </label>
                        <input type="number" class="form-control" id="edit_prod_quantidade" name="quantidade" min="0" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="edit_prod_lote" class="form-label">
                            <i class="fas fa-barcode"></i> Lote
                        </label>
                        <input type="text" class="form-control text-uppercase" id="edit_prod_lote" name="num_lote">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="edit_prod_documento" class="form-label">
                            <i class="fas fa-file-alt"></i> Doc. Nº
                        </label>
                        <input type="text" class="form-control" id="edit_prod_documento" name="num_documento">
                    </div>
                </div>
            </div>

            <!-- Seção: Datas -->
            <div class="form-section">
                <h6 class="section-title">
                    <i class="fas fa-calendar-alt"></i>
                    Datas
                </h6>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="edit_prod_data_producao" class="form-label">
                            <i class="fas fa-industry"></i> Produção
                        </label>
                        <input type="date" class="form-control" id="edit_prod_data_producao" name="data_producao">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="edit_prod_data_expiracao" class="form-label required">
                            <i class="fas fa-exclamation-triangle"></i> Expiração
                        </label>
                        <input type="date" class="form-control" id="edit_prod_data_expiracao" name="data_expiracao" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="edit_prod_data_recepcao" class="form-label">
                            <i class="fas fa-truck-loading"></i> Recepção
                        </label>
                        <input type="date" class="form-control" id="edit_prod_data_recepcao" name="data_recepcao">
                    </div>
                </div>
            </div>

            <!-- Seção: Classificação -->
            <div class="form-section">
                <h6 class="section-title">
                    <i class="fas fa-sitemap"></i>
                    Classificação
                </h6>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="edit_prod_grupo_farmaco" class="form-label required">
                            <i class="fas fa-capsules"></i> Grupo Farmacológico
                        </label>
                        <select class="form-select select2-edit-produto" id="edit_prod_grupo_farmaco" name="grupo_farmaco_id" required>
                            <option value="" disabled>Selecionar grupo</option>
                            @foreach(\App\Models\GrupoFarmacologico::all() as $gf)
                                <option value="{{ $gf->id }}">{{ $gf->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="edit_prod_fornecedor" class="form-label required">
                            <i class="fas fa-truck"></i> Fornecedor
                        </label>
                        <select class="form-select select2-edit-produto" id="edit_prod_fornecedor" name="fornecedor_id" required>
                            <option value="" disabled>Selecionar fornecedor</option>
                            @foreach(\App\Models\Fornecedor::orderBy('nome')->get() as $forn)
                                <option value="{{ $forn->id }}">{{ $forn->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Seção: Localização -->
            <div class="form-section">
                <h6 class="section-title">
                    <i class="fas fa-warehouse"></i>
                    Localização
                </h6>

                <div class="mb-3">
                    <label for="edit_prod_prateleira" class="form-label">
                        <i class="fas fa-th"></i> Prateleira
                    </label>
                    <select class="form-select select2-edit-produto" id="edit_prod_prateleira" name="prateleira_id">
                        <option value="">Não atribuída</option>
                        @foreach(\App\Models\Prateleira::all() as $prat)
                            <option value="{{ $prat->id }}">{{ $prat->nome }} [{{ $prat->descricao }}]</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Seção: Observações -->
            <div class="form-section">
                <h6 class="section-title">
                    <i class="fas fa-comment-alt"></i>
                    Observações
                </h6>

                <div class="mb-3">
                    <label for="edit_prod_obs" class="form-label">
                        <i class="fas fa-sticky-note"></i> Observações
                    </label>
                    <textarea class="form-control" id="edit_prod_obs" name="obs" rows="3" placeholder="Informações adicionais opcionais..."></textarea>
                </div>
            </div>

            <!-- Botões de Ação -->
            <div class="action-buttons">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">
                    <i class="fas fa-times"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-warning" id="edit_prod_submit_btn">
                    <span id="edit_prod_submit_text">
                        <i class="fas fa-save"></i> Salvar Alterações
                    </span>
                    <span id="edit_prod_submit_spinner" style="display:none;">
                        <span class="spinner-custom"></span>
                        <span class="ms-2">Salvando...</span>
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* ========== Offcanvas Edit Product Premium Design ========== */
    .offcanvas-edit-product {
        --bs-offcanvas-width: min(700px, 95vw) !important;
        box-shadow: -8px 0 32px rgba(0,0,0,0.15);
    }

    .offcanvas-edit-product .offcanvas-header {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        padding: 1.75rem;
        border: none;
    }

    .offcanvas-edit-product .offcanvas-title {
        font-size: 1.375rem;
        font-weight: 700;
        margin: 0;
    }

    .offcanvas-edit-product .offcanvas-body {
        background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
        padding: 1.5rem;
    }

    .offcanvas-edit-product .loading-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 400px;
    }

    .offcanvas-edit-product .loading-container .spinner-border {
        width: 3rem;
        height: 3rem;
        border-width: 0.3rem;
    }

    .offcanvas-edit-product .form-section {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.25rem;
        border-left: 4px solid #f5576c;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }

    .offcanvas-edit-product .section-title {
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 1.25rem;
        font-size: 1.125rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .offcanvas-edit-product .section-title i {
        color: #f5576c;
        font-size: 1.25rem;
    }

    .offcanvas-edit-product .form-label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9375rem;
    }

    .offcanvas-edit-product .form-label i {
        color: #f5576c;
        font-size: 0.875rem;
    }

    .offcanvas-edit-product .form-label.required::after {
        content: " *";
        color: #dc3545;
        font-weight: 700;
    }

    .offcanvas-edit-product .form-control,
    .offcanvas-edit-product .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.75rem;
        transition: all 0.2s;
        font-size: 0.9375rem;
    }

    .offcanvas-edit-product .form-control:focus,
    .offcanvas-edit-product .form-select:focus {
        border-color: #f5576c;
        box-shadow: 0 0 0 3px rgba(245, 87, 108, 0.1);
    }

    .offcanvas-edit-product textarea.form-control {
        min-height: 80px;
        resize: vertical;
    }

    .offcanvas-edit-product .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        padding: 1.5rem 0 0;
        border-top: 2px solid #e2e8f0;
        margin-top: 1.5rem;
    }

    .offcanvas-edit-product .action-buttons .btn {
        padding: 0.875rem 1.75rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s;
        min-width: 140px;
    }

    .offcanvas-edit-product .btn-warning {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        border: none;
        color: white;
    }

    .offcanvas-edit-product .btn-warning:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(245, 87, 108, 0.3);
    }

    .offcanvas-edit-product .btn-secondary {
        background: white;
        border: 2px solid #e2e8f0;
        color: #4a5568;
    }

    .offcanvas-edit-product .btn-secondary:hover {
        background: #f8f9fa;
        border-color: #cbd5e0;
    }

    .offcanvas-edit-product .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
</style>

<script>
/**
 * Script para Editar Produto via AJAX
 * @author Augusto Kussema
 * @date 08 Dez 2025 11:00 (Luanda)
 */
$(document).ready(function() {
    // Inicializar Select2 quando offcanvas abre
    $('#offcanvasEditProduct').on('shown.bs.offcanvas', function () {
        if (!$('.select2-edit-produto').hasClass('select2-hidden-accessible')) {
            $('.select2-edit-produto').select2({
                dropdownParent: $('#offcanvasEditProduct'),
                placeholder: 'Selecione uma opção',
                allowClear: true,
                width: '100%',
                language: {
                    noResults: function() {
                        return "Nenhum resultado encontrado";
                    }
                }
            });
        }
    });

    // Destruir Select2 ao fechar offcanvas para evitar conflitos
    $('#offcanvasEditProduct').on('hidden.bs.offcanvas', function () {
        $('.select2-edit-produto').each(function() {
            if ($(this).hasClass('select2-hidden-accessible')) {
                $(this).select2('destroy');
            }
        });
    });

    // Função para carregar dados do produto
    window.openEditProductOffcanvas = function(produtoId) {
        var offcanvasEl = document.getElementById('offcanvasEditProduct');
        var bsOffcanvas = new bootstrap.Offcanvas(offcanvasEl);
        bsOffcanvas.show();

        // Show loading, hide form
        $('#edit_prod_loading').show();
        $('#formEditProduct').hide();

        // Fetch product data
        $.ajax({
            url: '/estoque/produto/' + produtoId + '/detalhes',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success && response.produto) {
                    populateEditForm(response.produto);
                    $('#edit_prod_loading').hide();
                    $('#formEditProduct').show();
                } else {
                    showToast('Erro ao carregar dados do produto', 'error');
                    bsOffcanvas.hide();
                }
            },
            error: function() {
                showToast('Erro ao carregar dados do produto', 'error');
                bsOffcanvas.hide();
            }
        });
    };

    // Função para preencher o formulário
    function populateEditForm(produto) {
        $('#edit_prod_id').val(produto.id);
        $('#edit_prod_designacao').val(produto.designacao);
        $('#edit_prod_tipo').val(produto.tipo).trigger('change');
        $('#edit_prod_dosagem').val(produto.dosagem || '');
        $('#edit_prod_forma').val(produto.forma).trigger('change');
        $('#edit_prod_quantidade').val(produto.quantidade);
        $('#edit_prod_lote').val(produto.num_lote);
        $('#edit_prod_documento').val(produto.num_documento);
        $('#edit_prod_data_producao').val(produto.data_producao);
        $('#edit_prod_data_expiracao').val(produto.data_expiracao);
        $('#edit_prod_data_recepcao').val(produto.data_recepcao || '');
        $('#edit_prod_grupo_farmaco').val(produto.grupo_farmaco_id).trigger('change');
        $('#edit_prod_fornecedor').val(produto.fornecedor_id).trigger('change');
        $('#edit_prod_prateleira').val(produto.prateleira_id || '').trigger('change');
        $('#edit_prod_obs').val(produto.obs || '');

        // Show/hide dosagem based on tipo
        if (produto.tipo === 'medicamento') {
            $('#edit_prod_dosagem_group').show();
            $('#edit_prod_dosagem').prop('required', true);
        } else {
            $('#edit_prod_dosagem_group').hide();
            $('#edit_prod_dosagem').prop('required', false);
        }
    }

    // Toggle dosagem field based on tipo
    $('#edit_prod_tipo').on('change', function() {
        if ($(this).val() === 'medicamento') {
            $('#edit_prod_dosagem_group').slideDown(300);
            $('#edit_prod_dosagem').prop('required', true);
        } else {
            $('#edit_prod_dosagem_group').slideUp(300);
            $('#edit_prod_dosagem').prop('required', false);
        }
    });

    // Submit form via AJAX
    $('#formEditProduct').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);
        var formData = new FormData(this);
        var produtoId = $('#edit_prod_id').val();

        // Validar datas
        var dataProducao = new Date($('#edit_prod_data_producao').val());
        var dataExpiracao = new Date($('#edit_prod_data_expiracao').val());

        if (dataExpiracao <= dataProducao) {
            showToast('A data de expiração deve ser posterior à data de produção', 'error');
            return;
        }

        // UI elements
        var btn = $('#edit_prod_submit_btn');
        var btnText = $('#edit_prod_submit_text');
        var btnSpinner = $('#edit_prod_submit_spinner');

        // Disable form
        form.find('input, select, textarea, button').prop('disabled', true);
        btnText.hide();
        btnSpinner.show();

        // Adicionar método PUT ao FormData
        formData.append('_method', 'PUT');

        // AJAX request
        $.ajax({
            url: '/estoque/produto/' + produtoId,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                showToast(response.message || 'Produto atualizado com sucesso!', 'success');

                // Reload DataTable
                if (typeof table !== 'undefined' && table.ajax) {
                    table.ajax.reload(null, false);
                } else {
                    $('#table-c').DataTable().ajax.reload(null, false);
                }

                // Close offcanvas after delay
                setTimeout(function() {
                    var offcanvasEl = document.getElementById('offcanvasEditProduct');
                    var offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                    if (offcanvas) offcanvas.hide();

                    form[0].reset();
                    form.find('input, select, textarea, button').prop('disabled', false);
                    btnText.show();
                    btnSpinner.hide();
                }, 800);
            },
            error: function(xhr) {
                var errorMsg = 'Erro ao atualizar produto';

                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = [];
                    $.each(xhr.responseJSON.errors, function(key, value) {
                        errors.push(value[0]);
                    });
                    errorMsg = errors.join(', ');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }

                showToast(errorMsg, 'error');

                // Re-enable form
                form.find('input, select, textarea, button').prop('disabled', false);
                btnText.show();
                btnSpinner.hide();
            }
        });
    });
});
</script>
