{{--
    Offcanvas para Adicionar Novo Produto ao Estoque
    Design moderno com validação e AJAX

    @author Augusto Kussema
    @date 08 Dez 2025 10:15 (Luanda)
    @description Formulário completo para cadastrar produto via AJAX com toast notifications
--}}

<div class="offcanvas offcanvas-end offcanvas-add-product" tabindex="-1" id="offcanvasAddProduct" aria-labelledby="offcanvasAddProductLabel">
    <div class="offcanvas-header">
        <div>
            <h5 class="offcanvas-title" id="offcanvasAddProductLabel">
                <i class="fas fa-plus-circle me-2"></i>Adicionar Produto
            </h5>
            <small class="text-white-50">Cadastrar novo produto no estoque</small>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
    </div>
    <div class="offcanvas-body">
        <form id="formAddProduct">
            @csrf
            <input type="hidden" name="area_id" id="add_prod_area_id" value="{{ $ah->farmacia_area->id ?? '' }}">
            <input type="hidden" name="farmacia_id" id="add_prod_farmacia_id" value="{{ auth()->user()->isFarmacia->farmacia->id ?? auth()->user()->farmacia->farmacia->id ?? '' }}">

            <!-- Seção: Informações Básicas -->
            <div class="form-section">
                <h6 class="section-title">
                    <i class="fas fa-info-circle"></i>
                    Informações Básicas
                </h6>

                <div class="mb-3">
                    <label for="add_prod_designacao" class="form-label required">
                        <i class="fas fa-tag"></i> Designação
                    </label>
                    <input type="text" class="form-control" id="add_prod_designacao" name="designacao" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="add_prod_tipo" class="form-label required">
                            <i class="fas fa-layer-group"></i> Tipo
                        </label>
                        <select class="form-select" id="add_prod_tipo" name="tipo" required>
                            <option value="" selected disabled>Selecionar tipo</option>
                            <option value="descartável">Descartável</option>
                            <option value="medicamento">Medicamento</option>
                            <option value="liquido">Líquido</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3" id="add_prod_dosagem_group" style="display:none;">
                        <label for="add_prod_dosagem" class="form-label">
                            <i class="fas fa-prescription-bottle"></i> Dosagem
                        </label>
                        <input type="text" class="form-control" id="add_prod_dosagem" name="dosagem">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="add_prod_forma" class="form-label required">
                        <i class="fas fa-flask"></i> Forma Farmacêutica
                    </label>
                    <select class="form-select" id="add_prod_forma" name="forma" required>
                        <option value="" disabled selected>Selecione uma forma</option>
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
                        <label for="add_prod_quantidade" class="form-label required">
                            <i class="fas fa-cube"></i> Quantidade
                        </label>
                        <input type="number" class="form-control" id="add_prod_quantidade" name="quantidade" min="0" value="0" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="add_prod_lote" class="form-label required">
                            <i class="fas fa-barcode"></i> Lote
                        </label>
                        <input type="text" class="form-control text-uppercase" id="add_prod_lote" name="num_lote" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="add_prod_documento" class="form-label required">
                            <i class="fas fa-file-alt"></i> Doc. Nº
                        </label>
                        <input type="text" class="form-control" id="add_prod_documento" name="num_documento" required>
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
                        <label for="add_prod_data_producao" class="form-label required">
                            <i class="fas fa-industry"></i> Produção
                        </label>
                        <input type="date" class="form-control" id="add_prod_data_producao" name="data_producao" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="add_prod_data_expiracao" class="form-label required">
                            <i class="fas fa-exclamation-triangle"></i> Expiração
                        </label>
                        <input type="date" class="form-control" id="add_prod_data_expiracao" name="data_expiracao" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="add_prod_data_recepcao" class="form-label">
                            <i class="fas fa-truck-loading"></i> Recepção
                        </label>
                        <input type="date" class="form-control" id="add_prod_data_recepcao" name="data_recepcao">
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
                        <label for="add_prod_grupo_farmaco" class="form-label required">
                            <i class="fas fa-capsules"></i> Grupo Farmacológico
                        </label>
                        <select class="form-select" id="add_prod_grupo_farmaco" name="grupo_farmaco_id" required>
                            <option value="" selected disabled>Selecionar grupo</option>
                            @foreach(\App\Models\GrupoFarmacologico::all() as $gf)
                                <option value="{{ $gf->id }}">{{ $gf->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="add_prod_origem_destino" class="form-label required">
                            <i class="fas fa-map-marker-alt"></i> Origem/Destino
                        </label>
                        <input type="text" class="form-control" id="add_prod_origem_destino" name="origem_destino" required>
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
                    <label for="add_prod_prateleira" class="form-label">
                        <i class="fas fa-th"></i> Prateleira
                    </label>
                    <select class="form-select" id="add_prod_prateleira" name="prateleira_id">
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
                    <label for="add_prod_obs" class="form-label">
                        <i class="fas fa-sticky-note"></i> Observações
                    </label>
                    <textarea class="form-control" id="add_prod_obs" name="obs" rows="3" placeholder="Informações adicionais opcionais..."></textarea>
                </div>
            </div>

            <!-- Botões de Ação -->
            <div class="action-buttons">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">
                    <i class="fas fa-times"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-primary" id="add_prod_submit_btn">
                    <span id="add_prod_submit_text">
                        <i class="fas fa-save"></i> Adicionar Produto
                    </span>
                    <span id="add_prod_submit_spinner" style="display:none;">
                        <span class="spinner-custom"></span>
                        <span class="ms-2">Salvando...</span>
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* ========== Offcanvas Add Product Premium Design ========== */
    .offcanvas-add-product {
        --bs-offcanvas-width: min(700px, 95vw) !important;
        box-shadow: -8px 0 32px rgba(0,0,0,0.15);
    }

    .offcanvas-add-product .offcanvas-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.75rem;
        border: none;
    }

    .offcanvas-add-product .offcanvas-title {
        font-size: 1.375rem;
        font-weight: 700;
        margin: 0;
    }

    .offcanvas-add-product .offcanvas-body {
        background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
        padding: 1.5rem;
    }

    .offcanvas-add-product .form-section {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.25rem;
        border-left: 4px solid #667eea;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }

    .offcanvas-add-product .section-title {
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 1.25rem;
        font-size: 1.125rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .offcanvas-add-product .section-title i {
        color: #667eea;
        font-size: 1.25rem;
    }

    .offcanvas-add-product .form-label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9375rem;
    }

    .offcanvas-add-product .form-label i {
        color: #667eea;
        font-size: 0.875rem;
    }

    .offcanvas-add-product .form-label.required::after {
        content: " *";
        color: #f5576c;
        font-weight: 700;
    }

    .offcanvas-add-product .form-control,
    .offcanvas-add-product .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.75rem;
        transition: all 0.2s;
        font-size: 0.9375rem;
    }

    .offcanvas-add-product .form-control:focus,
    .offcanvas-add-product .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .offcanvas-add-product textarea.form-control {
        min-height: 80px;
        resize: vertical;
    }

    .offcanvas-add-product .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        padding: 1.5rem 0 0;
        border-top: 2px solid #e2e8f0;
        margin-top: 1.5rem;
    }

    .offcanvas-add-product .action-buttons .btn {
        padding: 0.875rem 1.75rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s;
        min-width: 140px;
    }

    .offcanvas-add-product .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
    }

    .offcanvas-add-product .btn-primary:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .offcanvas-add-product .btn-secondary {
        background: white;
        border: 2px solid #e2e8f0;
        color: #4a5568;
    }

    .offcanvas-add-product .btn-secondary:hover {
        background: #f8f9fa;
        border-color: #cbd5e0;
    }

    .offcanvas-add-product .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
</style>

<script>
/**
 * Script para Adicionar Produto via AJAX
 * @author Augusto Kussema
 * @date 08 Dez 2025 10:30 (Luanda)
 */
$(document).ready(function() {
    // Toggle dosagem field based on tipo
    $('#add_prod_tipo').on('change', function() {
        if ($(this).val() === 'medicamento') {
            $('#add_prod_dosagem_group').slideDown(300);
            $('#add_prod_dosagem').prop('required', true);
        } else {
            $('#add_prod_dosagem_group').slideUp(300);
            $('#add_prod_dosagem').prop('required', false);
        }
    });

    // Submit form via AJAX
    $('#formAddProduct').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);
        var formData = new FormData(this);

        // Validar datas
        var dataProducao = new Date($('#add_prod_data_producao').val());
        var dataExpiracao = new Date($('#add_prod_data_expiracao').val());

        if (dataExpiracao <= dataProducao) {
            showToast('A data de expiração deve ser posterior à data de produção', 'error');
            return;
        }

        // UI elements
        var btn = $('#add_prod_submit_btn');
        var btnText = $('#add_prod_submit_text');
        var btnSpinner = $('#add_prod_submit_spinner');

        // Disable form
        form.find('input, select, textarea, button').prop('disabled', true);
        btnText.hide();
        btnSpinner.show();

        // AJAX request
        $.ajax({
            url: '{{ route("estoque.store") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                showToast(response.message || 'Produto adicionado com sucesso!', 'success');

                // Reload DataTable
                if (typeof table !== 'undefined' && table.ajax) {
                    table.ajax.reload(null, false);
                } else {
                    $('#table-c').DataTable().ajax.reload(null, false);
                }

                // Close offcanvas and reset form after delay
                setTimeout(function() {
                    var offcanvasEl = document.getElementById('offcanvasAddProduct');
                    var offcanvas = bootstrap.Offcanvas.getInstance(offcanvasEl);
                    if (offcanvas) offcanvas.hide();

                    form[0].reset();
                    form.find('input, select, textarea, button').prop('disabled', false);
                    btnText.show();
                    btnSpinner.hide();
                    $('#add_prod_dosagem_group').hide();
                }, 800);
            },
            error: function(xhr) {
                var errorMsg = 'Erro ao adicionar produto';

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
