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
            {{-- <li class="breadcrumb-item"><a href="{{ route('a_h.show', ['area_id' => $area]) }}"><i class="fas fa-boxes me-1"></i>Estoque</a></li> --}}
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
            <form method="POST" id="formCadastro" action="{{ route('estoque.store') }}">
                @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-heading">
                                    <h4>Adicionar Item</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pb-3">
                                    {{-- Remover esta linha com ID hardcoded --}}
                                    {{-- <input type="hidden" id="inp-farmacia_id" name="farmacia_id" value="11a2d86a-c885-44e4-9162-14215ef75b95"> --}}

                                    {{-- Substituir por: --}}
                                    @php
                                        $farmaciaUsuario = null;
                                        try {
                                            $farmaciaUsuario = auth()->user()->farmacia_id ??
                                                              auth()->user()->isFarmacia->farmacia_id ??
                                                              auth()->user()->userAreaHospitalar->farmacia_id ?? null;
                                        } catch (\Exception $e) {
                                            // Log do erro mas continuar
                                        }
                                    @endphp

                                    @if($farmaciaUsuario)
                                        <input type="hidden" id="inp-farmacia_id" name="farmacia_id" value="{{ $farmaciaUsuario }}">
                                    @else
                                        <div class="alert alert-danger">
                                            Erro: Usuário não possui farmácia associada. Contacte o administrador.
                                        </div>
                                    @endif

                                    <label class="mb-2">Designação *</label>
                                    <input type="text" id="designacao" value="{{ old('designacao') ?? old('designacao') }}" class="form-control" placeholder="" name="designacao">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label class="mb-2">Tipo *</label>
                                    <select name="tipo" style="width: 100%" id="tipo_produto_estoque" class="form-control">
                                        <option selected disabled>Selecionar tipo</option>
                                        <option value="descartável">Descartável</option>
                                        <option value="medicamento">Medicamento</option>
                                        <option value="liquido">Liquido</option>
                                    </select>
                                </div>
                            </div>
                            <div class="" id="item_medicamento" style="display:none">
                                <div class="form-row">
                                    {{-- <div class="col pb-3>
                                                <label class="mb-2">Quantidade em Estoque *</label>
                                                <input type="number" class="form-control" placeholder="" name="qtd">
                                            </div> --}}
                                    <div class="col pb-3">
                                        <label class="mb-2">Dosagem *</label>
                                        <input type="text" class="form-control" value="{{ old('dosagem') ?? old('dosagem') }}" placeholder="" name="dosagem">
                                    </div>
                                </div>
                            </div>
                            <div class="" id="repetir_">
                                <div class="" id="item_descartavelq" style="">
                                    <div class="row">
                                        <div class="col pb-3">
                                            <label class="mb-2">Caixa *</label>
                                            <input type="number" name="caixa" value="{{ old('caixa') ?? old('caixa') }}" id="caixa" class="form-control">
                                        </div>
                                        <div class="col pb-3">
                                            <label class="mb-2">Caixinha *</label>
                                            <input type="number" name="caxinha" value="{{ old('caxinha') ?? old('caxinha') }}" id="caxinha" class="form-control" >
                                        </div>
                                        <div class="col pb-3">
                                            <label class="mb-2">Unidade *</label>
                                            <input type="number" name="unidade" value="{{ old('unidade') ?? old('unidade') }}" id="unidade" class="form-control" onchange="setQtdDescritivo()" onblur="setDescritivo()">
                                        </div>
                                        <input type="text" id="descritivo" name="descritivo" hidden>
                                        <div class="col pb-3">
                                            <label class="mb-2">Total</label>
                                            <input style="display: none" type="number" id="qtd_total_estoque" value="{{ old('qtd_total') ?? old('qtd_total') }}" class="form-control" name="qtd_total">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col pb-3">
                                        <label class="mb-2">Lote *</label>
                                        <input type="text" class="form-control" value="{{ old('num_lote') ?? old('num_lote') }}" name="num_lote"
                                            style="text-transform: uppercase;">
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">Documento Nº *</label>
                                        <input type="text" id="cod_barras" value="{{ old('num_documento') ?? old('num_documento') }}" class="form-control" placeholder=""
                                            name="num_documento">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col pb-3">
                                        <label class="mb-2">Data Produção *</label>
                                        <input type="date" class="form-control" value="{{ old('data_producao') ?? old('data_producao') }}" name="data_producao">
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">Data Expiração *</label>
                                        <input type="date" class="form-control" value="{{ old('data_expiracao') ?? old('data_expiracao') }}" name="data_expiracao">
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">Data Recepção</label>
                                        <input type="date" class="form-control" value="{{ old('data_recepcao') ?? old('data_recepcao') }}" name="data_recepcao">
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="" id="diverso">
                                <div class="row">
                                    <div class="col pb-3">
                                        <label class="mb-2">Forma *</label>
                                        <select class="form-control" name="forma">
                                            <option value="">Selecione uma forma</option>

                                            <!-- Formas de Administração Oral -->
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

                                            <!-- Formas de Administração Parenteral -->
                                            <optgroup label="Formas de Administração Parenteral (fora do trato gastrointestinal)">
                                                <option value="Injectável">Injectável</option>
                                                <option value="Soros">Soros</option>
                                                <option value="Implantes subcutâneos">Implantes subcutâneos</option>
                                                <option value="Vacinas">Vacinas</option>
                                                <option value="Pós para solução injetável">Pós para solução injetável</option>
                                            </optgroup>

                                            <!-- Formas de Administração Tópica -->
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

                                            <!-- Formas de Administração Inalatória -->
                                            <optgroup label="Formas de Administração Inalatória">
                                                <option value="Aerossóis">Aerossóis</option>
                                                <option value="Nebulizações">Nebulizações</option>
                                                <option value="Inaladores de pó seco">Inaladores de pó seco</option>
                                            </optgroup>

                                            <!-- Formas de Administração Retal -->
                                            <optgroup label="Formas de Administração Retal">
                                                <option value="Supositórios">Supositórios</option>
                                                <option value="Enemas">Enemas</option>
                                                <option value="Pomadas retal">Pomadas retal</option>
                                            </optgroup>

                                            <!-- Formas de Administração Oftálmica -->
                                            <optgroup label="Formas de Administração Oftálmica">
                                                <option value="Colírios">Colírios</option>
                                                <option value="Pomadas oftálmicas">Pomadas oftálmicas</option>
                                            </optgroup>

                                            <!-- Formas de Administração Nasal -->
                                            <optgroup label="Formas de Administração Nasal">
                                                <option value="Sprays nasais">Sprays nasais</option>
                                                <option value="Gotas nasais">Gotas nasais</option>
                                            </optgroup>

                                            <!-- Formas de Administração Sublingual e Bucal -->
                                            <optgroup label="Formas de Administração Sublingual e Bucal">
                                                <option value="Comprimidos sublinguais">Comprimidos sublinguais</option>
                                                <option value="Tabletes bucais">Tabletes bucais</option>
                                                <option value="Pastilhas">Pastilhas</option>
                                                <option value="Balas medicinais">Balas medicinais</option>
                                            </optgroup>

                                            <!-- Formas de Administração Vaginal -->
                                            <optgroup label="Formas de Administração Vaginal">
                                                <option value="Óvulos vaginais">Óvulos vaginais</option>
                                                <option value="Creme vaginal">Creme vaginal</option>
                                            </optgroup>

                                            <optgroup label="Outros">
                                                <option value="Descartável">Descartável</option>
                                                <option value="Não Atribuido">Não Atribuido</option>
                                            </optgroup>
                                        </select>
                                    </div>

                                    <div class="col pb-3">
                                        <label class="mb-2">G. Farmacológico *</label>
                                        <select name="grupo_farmaco_id" style="width: 100%" id="grupo_farmaco_id_"
                                            class="form-control selectr2">
                                            @foreach (\App\Models\GrupoFarmacologico::orderBy('nome')->get() as $gf)
                                                <option value="{{ $gf->id }}">{{ $gf->nome }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col pb-3">
                                        <label class="mb-2">Origem / Destino *</label>
                                        <input type="text" class="form-control" value="{{ old('origem_destino') ?? old('origem_destino') }}" name="origem_destino">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pb-3">
                                    <label class="mb-2">Área Hospitalar</label>
                                    <select name="area_id" style="width: 100%" id="area_id_" class="form-control select2">
                                        @foreach (App\Models\FarmaciaAreaHospitalar::where('farmacia_id', auth()->user()->isFarmacia->farmacia->id)
                                                ->where('status', 1)
                                                ->get() as $areas)
                                            <option value="{{ $areas->id }}">{{ $areas->area_hospitalar->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label class="mb-2">Prateleira</label>
                                    <select name="prateleira_id" style="width: 100%" id="prateleira_id_" class="form-control">
                                        @foreach (\App\Models\Prateleira::all() as $prat)
                                            <option value="{{ $prat->id }}">{{ $prat->nome }} [{{ $prat->descricao }}]</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col pb-3">
                                    <label class="mb-2">OBS</label>
                                    <textarea class="form-control" value="{{ old('obs') ?? old('obs') }}" name="obs"></textarea>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                <button class="btn rounded-pill btn-primary" type="submit">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function setQtdDescritivo() {
        // Obter os valores dos campos
        var caixaValue = document.getElementById('caixa').value;
        var caxinhaValue = document.getElementById('caxinha').value;
        var unidadeValue = document.getElementById('unidade').value;

        // Construir a string descritiva
        var descritivoValue = caixaValue + 'x' + caxinhaValue + 'x' + unidadeValue;

        // Atualizar o valor do campo descritivo
        document.getElementById('descritivo').value = descritivoValue;
    }
</script>
@endsection
