@extends('layout.app')

@section('titulo', 'Adicionar Produto ao Estoque')

@section('content')
<style>
    /* ========== Design Moderno Página Cadastro ========== */
    .cadastro-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .cadastro-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px 12px 0 0;
        margin-bottom: 0;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
    }

    .cadastro-header h4 {
        color: white;
        font-weight: 600;
        margin: 0;
        font-size: 1.5rem;
    }

    .cadastro-header small {
        color: rgba(255,255,255,0.9);
        font-size: 0.9375rem;
    }

    .cadastro-card {
        background: white;
        border-radius: 0 0 12px 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .cadastro-card .card-body {
        padding: 2rem;
    }

    .form-section {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border-left: 4px solid #667eea;
    }

    .form-section-title {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 1rem;
        font-size: 1.125rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-section-title i {
        color: #667eea;
    }

    .form-label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label i {
        color: #667eea;
        font-size: 0.875rem;
    }

    .form-control, .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.75rem;
        transition: all 0.2s;
        font-size: 0.9375rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .btn-action-group {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        padding: 1.5rem;
        background: #f8f9fa;
        border-radius: 0 0 12px 12px;
        border-top: 1px solid #e2e8f0;
    }

    .btn-action-group .btn {
        padding: 0.875rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s;
        min-width: 150px;
    }

    .btn-action-group .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
    }

    .btn-action-group .btn-primary:hover:not(:disabled) {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-action-group .btn-secondary {
        background: white;
        border: 2px solid #e2e8f0;
        color: #4a5568;
    }

    .btn-action-group .btn-secondary:hover {
        background: #f8f9fa;
        border-color: #cbd5e0;
    }

    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
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

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Toast Notifications */
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
        animation: slideInRight 0.3s ease-out forwards;
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

    .toast-custom.hiding {
        animation: slideOutRight 0.3s ease-in forwards;
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

    /* Breadcrumb */
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
</style>

<!-- Toast Container -->
<div class="toast-container-custom" id="toastContainer"></div>

<div class="content cadastro-container">
    @include('partials.session')

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('a_h.index') }}"><i class="fas fa-hospital me-1"></i>Áreas Hospitalares</a></li>
            <li class="breadcrumb-item active" aria-current="page">Adicionar Produto</li>
        </ol>
    </nav>

    <!-- Header com Gradiente -->
    <div class="cadastro-header">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 p-3">
                <i class="fas fa-plus-circle fa-lg text-white"></i>
            </div>
            <div>
                <h4 class="mb-1">Adicionar Produto ao Estoque</h4>
                <small>Preencha as informações do novo produto</small>
            </div>
        </div>
    </div>

    <!-- Card Principal -->
    <div class="cadastro-card">
        <div class="card-body">
            <form method="POST" id="formCadastro">
                @csrf
                
                @php
                    $farmaciaUsuario = null;
                    try {
                        $farmaciaUsuario = auth()->user()->farmacia_id ??
                                          auth()->user()->isFarmacia->farmacia_id ??
                                          auth()->user()->userAreaHospitalar->farmacia_id ?? null;
                    } catch (\Exception $e) {}
                @endphp

                @if($farmaciaUsuario)
                    <input type="hidden" id="inp-farmacia_id" name="farmacia_id" value="{{ $farmaciaUsuario }}">
                @else
                    <div class="alert alert-danger">
                        Erro: Usuário não possui farmácia associada. Contacte o administrador.
                    </div>
                @endif

                <!-- Seção: Informações Básicas -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-info-circle"></i>
                        <span>Informações Básicas</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="designacao">
                                <i class="fas fa-tag"></i>
                                Designação *
                            </label>
                            <input type="text" id="designacao" class="form-control" placeholder="Nome do produto" name="designacao" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="tipo_produto_estoque">
                                <i class="fas fa-layer-group"></i>
                                Tipo *
                            </label>
                            <select name="tipo" id="tipo_produto_estoque" class="form-control" required>
                                <option value="" disabled selected>Selecionar tipo</option>
                                <option value="descartável">Descartável</option>
                                <option value="medicamento">Medicamento</option>
                                <option value="liquido">Líquido</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Seção Condicional: Medicamento -->
                <div id="item_medicamento" style="display:none">
                    <div class="form-section">
                        <div class="form-section-title">
                            <i class="fas fa-pills"></i>
                            <span>Detalhes do Medicamento</span>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-prescription-bottle"></i>
                                    Dosagem *
                                </label>
                                <input type="text" class="form-control" placeholder="Ex: 500mg" name="dosagem">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seção: Quantidade e Embalagem -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-boxes"></i>
                        <span>Quantidade</span>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                <i class="fas fa-boxes"></i>
                                Quantidade *
                            </label>
                            <input type="number" name="quantidade" id="quantidade" class="form-control" min="1" placeholder="Digite a quantidade" required>
                            <small class="text-muted">Informe a quantidade total do produto.</small>
                        </div>
                    </div>
                </div>

                <!-- Seção: Lote e Documento -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-barcode"></i>
                        <span>Lote e Documento</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-barcode"></i>
                                Lote *
                            </label>
                            <input type="text" class="form-control text-uppercase" name="num_lote" placeholder="Ex: L2024-001" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-file-alt"></i>
                                Documento Nº *
                            </label>
                            <input type="text" id="cod_barras" class="form-control" placeholder="Número do documento" name="num_documento" required>
                        </div>
                    </div>
                </div>

                <!-- Seção: Datas -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Datas</span>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="fas fa-industry"></i>
                                Data Produção *
                            </label>
                            <input type="date" class="form-control" name="data_producao" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="fas fa-exclamation-triangle"></i>
                                Data Expiração *
                            </label>
                            <input type="date" class="form-control" name="data_expiracao" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="fas fa-truck-loading"></i>
                                Data Recepção
                            </label>
                            <input type="date" class="form-control" name="data_recepcao">
                        </div>
                    </div>
                </div>

                <!-- Seção: Características -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-cogs"></i>
                        <span>Características do Produto</span>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="fas fa-flask"></i>
                                Forma *
                            </label>
                            <select class="form-control" name="forma" required>
                                <option value="" disabled selected>Selecione uma forma</option>
                                <optgroup label="Formas de Administração Oral">
                                    <option value="Comprimidos">Comprimidos</option>
                                    <option value="Cápsulas">Cápsulas</option>
                                    <option value="Tabletes efervescentes">Tabletes efervescentes</option>
                                    <option value="Pó para suspensão oral">Pó para suspensão oral</option>
                                    <option value="Xaropes">Xaropes</option>
                                    <option value="Soluções orais">Soluções orais</option>
                                    <option value="Gomas mastigáveis">Gomas mastigáveis</option>
                                    <option value="Soluções ou elixires">Soluções ou elixires</option>
                                </optgroup>
                                <optgroup label="Formas de Administração Parenteral">
                                    <option value="Injectável">Injectável</option>
                                    <option value="Soros">Soros</option>
                                    <option value="Implantes subcutâneos">Implantes subcutâneos</option>
                                    <option value="Vacinas">Vacinas</option>
                                    <option value="Pós para solução injetável">Pós para solução injetável</option>
                                </optgroup>
                                <optgroup label="Formas de Administração Tópica">
                                    <option value="Cremes">Cremes</option>
                                    <option value="Pomadas">Pomadas</option>
                                    <option value="Géis">Géis</option>
                                    <option value="Loções">Loções</option>
                                    <option value="Pasta">Pasta</option>
                                    <option value="Sprays tópicos">Sprays tópicos</option>
                                    <option value="Adesivos transdérmicos">Adesivos transdérmicos</option>
                                    <option value="Shampoos">Shampoos</option>
                                    <option value="Sabonetes medicinais">Sabonetes medicinais</option>
                                </optgroup>
                                <optgroup label="Outros">
                                    <option value="Descartável">Descartável</option>
                                    <option value="Não Atribuido">Não Atribuido</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="fas fa-capsules"></i>
                                G. Farmacológico *
                            </label>
                            <select name="grupo_farmaco_id" id="grupo_farmaco_id_" class="form-control selectr2" required>
                                @foreach (\App\Models\GrupoFarmacologico::orderBy('nome')->get() as $gf)
                                    <option value="{{ $gf->id }}">{{ $gf->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="fas fa-map-marker-alt"></i>
                                Origem / Destino *
                            </label>
                            <input type="text" class="form-control" name="origem_destino" required>
                        </div>
                    </div>
                </div>

                <!-- Seção: Localização -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-warehouse"></i>
                        <span>Localização</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-hospital"></i>
                                Área Hospitalar
                            </label>
                            <select name="area_id" id="area_id_" class="form-control select2">
                                @foreach (App\Models\FarmaciaAreaHospitalar::where('farmacia_id', auth()->user()->isFarmacia->farmacia->id)->where('status', 1)->get() as $areas)
                                    <option value="{{ $areas->id }}" {{ $areas->id == $area ? 'selected' : '' }}>
                                        {{ $areas->area_hospitalar->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-shelves"></i>
                                Prateleira
                            </label>
                            <select name="prateleira_id" id="prateleira_id_" class="form-control">
                                @foreach (\App\Models\Prateleira::all() as $prat)
                                    <option value="{{ $prat->id }}">{{ $prat->nome }} [{{ $prat->descricao }}]</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Seção: Observações -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-sticky-note"></i>
                        <span>Observações</span>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">
                                <i class="fas fa-comment-alt"></i>
                                OBS
                            </label>
                            <textarea class="form-control" placeholder="Adicione observações opcionais..." name="obs" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Botões de Ação -->
        <div class="btn-action-group">
            <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                <i class="fas fa-times me-2"></i>
                Cancelar
            </button>
            <button type="submit" form="formCadastro" class="btn btn-primary" id="submitBtn">
                <span id="submitText">
                    <i class="fas fa-save me-2"></i>
                    Cadastrar
                </span>
                <span id="submitSpinner" style="display:none;">
                    <span class="spinner-custom"></span>
                    <span class="ms-2">Processando...</span>
                </span>
            </button>
        </div>
    </div>
</div>

<script>
/**
 * Script de Controle da Página de Cadastro de Estoque
 *
 * @author Augusto Kussema
 * @date 03 Nov 2025 21:30 (Luanda)
 * @description Controla exibição condicional de campos, AJAX, validações e toast notifications
 */

// ========== Toast Notifications ==========
function showToast(message, type = 'info', title = '', duration = 4000) {
    const icons = {
        success: '<svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>',
        error: '<svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>'
    };

    const titles = {
        success: title || 'Sucesso!',
        error: title || 'Erro!'
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

    setTimeout(() => {
        toast.classList.add('hiding');
        setTimeout(() => toast.remove(), 300);
    }, duration);
}

$(document).ready(function() {
    // Inicializar Select2 nos selects específicos
    $('.select2, .selectr2').select2({
        width: '100%',
        placeholder: 'Selecione uma opção'
    });

    // Função para mostrar/ocultar seção de medicamento
    function toggleMedicamentoSection() {
        const tipoSelecionado = $('#tipo_produto_estoque').val();
        if (tipoSelecionado === 'medicamento') {
            $('#item_medicamento').slideDown(300);
        } else {
            $('#item_medicamento').slideUp(300);
        }
    }

    // Executar quando o tipo mudar
    $('#tipo_produto_estoque').on('change', toggleMedicamentoSection);

    // Submit do formulário via AJAX
    $('#formCadastro').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const btn = $('#submitBtn');
        const btnText = $('#submitText');
        const btnSpinner = $('#submitSpinner');
        const formData = new FormData(this);

        // Validar quantidade
        const caixa = parseInt($('#caixa').val()) || 0;
        const caxinha = parseInt($('#caxinha').val()) || 0;
        const unidade = parseInt($('#unidade').val()) || 0;

        if (caixa <= 0 || caxinha <= 0 || unidade <= 0) {
            showToast('Por favor, insira valores válidos para Caixa, Caixinha e Unidade (maior que 0)', 'error');
            return;
        }

        // Validar datas
        const dataProducao = new Date($('input[name="data_producao"]').val());
        const dataExpiracao = new Date($('input[name="data_expiracao"]').val());

        if (dataExpiracao <= dataProducao) {
            showToast('A data de expiração deve ser posterior à data de produção', 'error');
            $('input[name="data_expiracao"]').focus();
            return;
        }

        // Validar quantidade
        const quantidade = parseInt($('input[name="quantidade"]').val());
        if (!quantidade || quantidade <= 0) {
            showToast('A quantidade deve ser maior que zero', 'error');
            $('input[name="quantidade"]').focus();
            return;
        }

        // Disable form
        form.find('input, select, textarea, button').prop('disabled', true);
        btn.prop('disabled', true);
        btnText.hide();
        btnSpinner.show();

        $.ajax({
            url: '{{ route('estoque.store') }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                showToast(
                    response.message || 'Produto cadastrado com sucesso!',
                    'success',
                    'Sucesso!'
                );

                // Limpar formulário completamente
                form[0].reset();
                $('#item_medicamento').hide();

                // Re-enable form
                form.find('input, select, textarea, button').prop('disabled', false);
                btn.prop('disabled', false);
                btnText.show();
                btnSpinner.hide();

                // Reset Select2
                $('.select2, .selectr2').val(null).trigger('change');

                // Scroll to top suavemente
                $('html, body').animate({ scrollTop: 0 }, 500);
            },
            error: function(xhr) {
                let errorMsg = 'Erro ao cadastrar produto';

                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;
                    const errorMessages = [];
                    for (let field in errors) {
                        errorMessages.push(errors[field][0]);
                    }
                    errorMsg = errorMessages.join(', ');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }

                showToast(errorMsg, 'error');

                // Re-enable form
                form.find('input, select, textarea, button').prop('disabled', false);
                btn.prop('disabled', false);
                btnText.show();
                btnSpinner.hide();
            }
        });
    });
});
</script>

@endsection
