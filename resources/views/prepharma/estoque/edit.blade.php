@extends('layout.app')

@section('titulo', 'Editar Estoque')

@section('content')
<style>
    /* ========== Design Moderno Página Edição ========== */
    .edit-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .edit-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px 12px 0 0;
        margin-bottom: 0;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
    }

    .edit-header h4 {
        color: white;
        font-weight: 600;
        margin: 0;
        font-size: 1.5rem;
    }

    .edit-header small {
        color: rgba(255,255,255,0.9);
        font-size: 0.9375rem;
    }

    .edit-card {
        background: white;
        border-radius: 0 0 12px 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        overflow: hidden;
    }

    .edit-card .card-body {
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

    .form-control:disabled {
        background: #f1f5f9;
        cursor: not-allowed;
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
        min-width: 120px;
    }

    .btn-action-group .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
    }

    .btn-action-group .btn-primary:hover {
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

    /* Alert Styles */
    .alert {
        border-radius: 12px;
        border: none;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .alert-success {
        background: #d1fae5;
        color: #065f46;
    }

    .alert-danger {
        background: #fee2e2;
        color: #991b1b;
    }

    .alert ul {
        margin: 0;
        padding-left: 1.25rem;
    }

    /* Input Groups */
    .input-with-icon {
        position: relative;
    }

    .input-with-icon i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
    }

    .input-with-icon .form-control {
        padding-left: 2.75rem;
    }

    /* Required indicator */
    .form-label:has(+ input[required])::after,
    .form-label:has(+ select[required])::after,
    .form-label:has(+ textarea[required])::after {
        content: " *";
        color: #f5576c;
    }
</style>

<div class="content">
    <div class="edit-container">
    @include('partials.session')

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <!-- Breadcrumb -->
    <div class="page-header mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item"><a href="{{ route('a_h.index') }}">Áreas Hospitalares</a></li>
                <li class="breadcrumb-item active">Editar Produto</li>
            </ol>
        </nav>
    </div>

    <!-- Header com Gradiente -->
    <div class="edit-header">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-white bg-opacity-25 p-3">
                <i class="fas fa-edit fa-lg text-white"></i>
            </div>
            <div>
                <h4 class="mb-1">Editar Produto</h4>
                <small>{{ $pe->designacao }}</small>
            </div>
        </div>
    </div>

    <!-- Card Principal -->
    <div class="edit-card">
        <div class="card-body">
            <form method="POST" action="{{ route('estoque.update', ['id' => $pe->id, 'returnID' => $returnID]) }}" id="editForm">
                @csrf
                <input type="hidden" name="returnID" value="{{ $returnID }}">

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
                                Designação
                            </label>
                            <input type="text" id="designacao" class="form-control" value="{{ $pe->designacao }}" name="designacao" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="tipo_produto_estoque">
                                <i class="fas fa-layer-group"></i>
                                Tipo
                            </label>
                            <select name="tipo" id="tipo_produto_estoque" class="form-select" required>
                                <option disabled>Selecionar tipo</option>
                                <option value="descartável" @selected($pe->tipo == 'descartável')>Descartável</option>
                                <option value="medicamento" @selected($pe->tipo == 'medicamento')>Medicamento</option>
                                <option value="liquido" @selected($pe->tipo == 'liquido')>Líquido</option>
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
                                    Dosagem
                                </label>
                                <input type="text" class="form-control" value="{{ $pe->dosagem }}" name="dosagem">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seção: Quantidade e Lote -->
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-boxes"></i>
                        <span>Quantidade e Lote</span>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="quantidade">
                                <i class="fas fa-cube"></i>
                                Quantidade
                            </label>
                            <input type="number" name="quantidade" value="{{ $pe->quantidade }}" id="quantidade" class="form-control" min="0" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="fas fa-barcode"></i>
                                Lote
                            </label>
                            <input type="text" class="form-control text-uppercase" value="{{ $pe->num_lote }}" name="num_lote" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="fas fa-file-alt"></i>
                                Documento Nº
                            </label>
                            <input type="text" id="cod_barras" value="{{ $pe->num_documento }}" class="form-control" name="num_documento" required>
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
                                Data Produção
                            </label>
                            <input type="date" class="form-control" value="{{ $pe->data_producao }}" name="data_producao" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="fas fa-exclamation-triangle"></i>
                                Data Expiração
                            </label>
                            <input type="date" class="form-control" value="{{ $pe->data_expiracao }}" name="data_expiracao" required>
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
                                Forma
                            </label>
                            <select class="form-select" name="forma" required>
                                <option value="" disabled>Selecione uma forma</option>
                                <optgroup label="Formas de Administração Oral">
                                    <option value="Comprimidos" @selected($pe->forma == 'Comprimidos')>Comprimidos</option>
                                    <option value="Cápsulas" @selected($pe->forma == 'Cápsulas')>Cápsulas</option>
                                    <option value="Tabletes efervescentes" @selected($pe->forma == 'Tabletes efervescentes')>Tabletes efervescentes</option>
                                    <option value="Pó para suspensão oral" @selected($pe->forma == 'Pó para suspensão oral')>Pó para suspensão oral</option>
                                    <option value="Xaropes" @selected($pe->forma == 'Xaropes')>Xaropes</option>
                                    <option value="Soluções orais" @selected($pe->forma == 'Soluções orais')>Soluções orais</option>
                                    <option value="Gomas mastigáveis" @selected($pe->forma == 'Gomas mastigáveis')>Gomas mastigáveis</option>
                                    <option value="Soluções ou elixires" @selected($pe->forma == 'Soluções ou elixires')>Soluções ou elixires</option>
                                </optgroup>
                                <optgroup label="Formas de Administração Parenteral">
                                    <option value="Injectável" @selected($pe->forma == 'Injectável')>Injectável</option>
                                    <option value="Soros" @selected($pe->forma == 'Soros')>Soros</option>
                                    <option value="Implantes subcutâneos" @selected($pe->forma == 'Implantes subcutâneos')>Implantes subcutâneos</option>
                                    <option value="Vacinas" @selected($pe->forma == 'Vacinas')>Vacinas</option>
                                    <option value="Pós para solução injetável" @selected($pe->forma == 'Pós para solução injetável')>Pós para solução injetável</option>
                                </optgroup>
                                <optgroup label="Formas de Administração Tópica">
                                    <option value="Cremes" @selected($pe->forma == 'Cremes')>Cremes</option>
                                    <option value="Pomadas" @selected($pe->forma == 'Pomadas')>Pomadas</option>
                                    <option value="Géis" @selected($pe->forma == 'Géis')>Géis</option>
                                    <option value="Loções" @selected($pe->forma == 'Loções')>Loções</option>
                                    <option value="Pasta" @selected($pe->forma == 'Pasta')>Pasta</option>
                                    <option value="Sprays tópicos" @selected($pe->forma == 'Sprays tópicos')>Sprays tópicos</option>
                                    <option value="Adesivos transdérmicos" @selected($pe->forma == 'Adesivos transdérmicos')>Adesivos transdérmicos</option>
                                    <option value="Shampoos" @selected($pe->forma == 'Shampoos')>Shampoos</option>
                                    <option value="Sabonetes medicinais" @selected($pe->forma == 'Sabonetes medicinais')>Sabonetes medicinais</option>
                                </optgroup>
                                <optgroup label="Outros">
                                    <option value="Descartável" @selected($pe->forma == 'Descartável')>Descartável</option>
                                    <option value="Não Atribuido" @selected($pe->forma == 'Não Atribuido')>Não Atribuido</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="fas fa-capsules"></i>
                                G. Farmacológico
                            </label>
                            <select name="grupo_farmaco_id" id="grupo_farmaco_id_" class="form-select selectr2" required>
                                @foreach (\App\Models\GrupoFarmacologico::all() as $gf)
                                    <option value="{{ $gf->id }}" @selected($gf->id == $pe->grupo_farmaco_id)>
                                        {{ $gf->nome }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="fas fa-map-marker-alt"></i>
                                Origem / Destino
                            </label>
                            <input type="text" value="{{ $pe->origem_destino }}" class="form-control" name="origem_destino" required>
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
                            <select name="area_id" id="area_id_" class="form-select select2">
                                @foreach (\App\Models\AreaHospitalar::all() as $ah)
                                    @if ($ah->nome == 'Armazém I' or $ah->nome == 'Armazém II' or $ah->nome == 'Direcção clínica')
                                        <option value="{{ $ah->id }}" @selected($ah->id == $pe->estoque->area_hospitalar_id)>{{ $ah->nome }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-shelves"></i>
                                Prateleira
                            </label>
                            <select name="prateleira_id" id="prateleira_id_" class="form-select">
                                @foreach (\App\Models\Prateleira::all() as $prat)
                                    <option value="{{ $prat->id }}" @selected($prat->id == $pe->prateleira_id)>
                                        {{ $prat->nome }} [{{ $prat->descricao }}]
                                    </option>
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
                            <textarea class="form-control" placeholder="Adicione observações opcionais..." name="obs" rows="3">{{ $pe->obs }}</textarea>
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
            <button type="submit" form="editForm" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>
                Atualizar
            </button>
        </div>
    </div>
</div>
</div>

<script>
/**
 * Script de Controle da Página de Edição de Estoque
 *
 * @author Augusto Kussema
 * @date 03 Nov 2025 15:45 (Luanda)
 * @description Controla exibição condicional de campos baseado no tipo de produto
 */
$(document).ready(function() {
    // Inicializar Select2 nos selects específicos
    $('.select2').select2({
        width: '100%',
        placeholder: 'Selecione uma opção'
    });

    $('.selectr2').select2({
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

    // Executar ao carregar a página
    toggleMedicamentoSection();

    // Executar quando o tipo mudar
    $('#tipo_produto_estoque').on('change', function() {
        toggleMedicamentoSection();
    });

    // Validação do formulário antes de submeter
    $('#editForm').on('submit', function(e) {
        const quantidade = parseInt($('#quantidade').val());

        if (isNaN(quantidade) || quantidade < 0) {
            e.preventDefault();
            alert('Por favor, insira uma quantidade válida (maior ou igual a 0)');
            $('#quantidade').focus();
            return false;
        }

        // Validar datas
        const dataProducao = new Date($('input[name="data_producao"]').val());
        const dataExpiracao = new Date($('input[name="data_expiracao"]').val());

        if (dataExpiracao <= dataProducao) {
            e.preventDefault();
            alert('A data de expiração deve ser posterior à data de produção');
            $('input[name="data_expiracao"]').focus();
            return false;
        }
    });

    // Adicionar classe de animação ao focar nos inputs
    $('.form-control, .form-select').on('focus', function() {
        $(this).parent().addClass('focused');
    }).on('blur', function() {
        $(this).parent().removeClass('focused');
    });
});
</script>

@endsection
