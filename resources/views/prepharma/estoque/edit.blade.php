@extends('layout.app')

@section('titulo', 'Editar Estoque')

@section('content')
<style>
    /* ========== Design Moderno Página Edição ========== */
    .edit-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
        background: #f8f9fa;
        min-height: 100vh;
    }

    .edit-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2.5rem 2rem;
        border-radius: 16px 16px 0 0;
        margin-bottom: 0;
        box-shadow: 0 8px 24px rgba(102, 126, 234, 0.25);
        position: relative;
        overflow: hidden;
    }

    .edit-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }

    .edit-header::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.08);
        border-radius: 50%;
    }

    .edit-header .header-content {
        position: relative;
        z-index: 1;
    }

    .edit-header h4 {
        color: white;
        font-weight: 700;
        margin: 0;
        font-size: 1.75rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .edit-header small {
        color: rgba(255,255,255,0.95);
        font-size: 1rem;
        font-weight: 500;
    }

    .edit-header .icon-box {
        width: 70px;
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        border-radius: 16px;
        border: 2px solid rgba(255,255,255,0.3);
    }

    .edit-header .icon-box i {
        font-size: 2rem;
    }

    .edit-card {
        background: white;
        border-radius: 0 0 16px 16px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        overflow: hidden;
    }

    .edit-card .card-body {
        padding: 2.5rem;
    }

    .form-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 2px solid #e9ecef;
        border-left: 6px solid #667eea;
        box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }

    .form-section::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(102, 126, 234, 0.08) 0%, transparent 70%);
        border-radius: 50%;
        transform: translate(30%, -30%);
    }

    .form-section:hover {
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.15);
        transform: translateY(-2px);
        border-left-width: 8px;
    }

    .form-section-title {
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 1.5rem;
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e9ecef;
        position: relative;
        z-index: 1;
    }

    .form-section-title i {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px;
        font-size: 1.125rem;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .form-label {
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9375rem;
        letter-spacing: 0.2px;
    }

    .form-label i {
        color: #667eea;
        font-size: 0.875rem;
        width: 20px;
        text-align: center;
    }

    .form-control, .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 0.875rem 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 0.9375rem;
        background: white;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    .form-control:hover, .form-select:hover {
        border-color: #cbd5e0;
    }

    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1), 0 4px 12px rgba(102, 126, 234, 0.15);
        transform: translateY(-1px);
    }

    .form-control:disabled {
        background: #f1f5f9;
        cursor: not-allowed;
        opacity: 0.7;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
        line-height: 1.6;
    }

    .btn-action-group {
        display: flex;
        gap: 1.25rem;
        justify-content: flex-end;
        padding: 2rem 2.5rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border-radius: 0 0 16px 16px;
        border-top: 2px solid #e2e8f0;
    }

    .btn-action-group .btn {
        padding: 1rem 2.5rem;
        border-radius: 10px;
        font-weight: 700;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        min-width: 160px;
        font-size: 1rem;
        letter-spacing: 0.3px;
        text-transform: uppercase;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .btn-action-group .btn i {
        font-size: 1.125rem;
    }

    .btn-action-group .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        position: relative;
        overflow: hidden;
    }

    .btn-action-group .btn-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s;
    }

    .btn-action-group .btn-primary:hover::before {
        left: 100%;
    }

    .btn-action-group .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
    }

    .btn-action-group .btn-secondary {
        background: white;
        border: 2px solid #cbd5e0;
        color: #4a5568;
    }

    .btn-action-group .btn-secondary:hover {
        background: #f8f9fa;
        border-color: #94a3b8;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    /* Alert Styles */
    .alert {
        border-radius: 12px;
        border: none;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        animation: slideInDown 0.4s ease-out;
    }

    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .alert i {
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .alert-success {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        border-left: 4px solid #10b981;
    }

    .alert-success i {
        color: #10b981;
    }

    .alert-danger {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #991b1b;
        border-left: 4px solid #ef4444;
    }

    .alert-danger i {
        color: #ef4444;
    }

    .alert ul {
        margin: 0;
        padding-left: 1.5rem;
        flex: 1;
    }

    .alert ul li {
        margin-bottom: 0.25rem;
    }

    /* Breadcrumb */
    .page-header {
        margin-bottom: 1.5rem;
    }

    .breadcrumb {
        background: white;
        padding: 1rem 1.5rem;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        margin-bottom: 0;
    }

    .breadcrumb-item {
        font-size: 0.9375rem;
        font-weight: 500;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: "›";
        font-size: 1.25rem;
        color: #94a3b8;
    }

    .breadcrumb-item a {
        color: #667eea;
        text-decoration: none;
        transition: all 0.2s;
    }

    .breadcrumb-item a:hover {
        color: #764ba2;
        transform: translateX(-2px);
        display: inline-block;
    }

    .breadcrumb-item.active {
        color: #4a5568;
        font-weight: 600;
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
        z-index: 5;
    }

    .input-with-icon .form-control {
        padding-left: 2.75rem;
    }

    /* Required indicator */
    .form-label:has(+ input[required])::after,
    .form-label:has(+ select[required])::after,
    .form-label:has(+ textarea[required])::after {
        content: " *";
        color: #ef4444;
        font-weight: 700;
        font-size: 1.125rem;
    }

    /* Input Focus Animation */
    .form-control:focus ~ .form-label,
    .form-select:focus ~ .form-label {
        color: #667eea;
    }

    /* Select Styling */
    .form-select {
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23667eea' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .edit-container {
            padding: 1rem 0.5rem;
        }

        .edit-header {
            padding: 1.5rem;
            border-radius: 12px 12px 0 0;
        }

        .edit-header h4 {
            font-size: 1.5rem;
        }

        .edit-card .card-body {
            padding: 1.5rem;
        }

        .form-section {
            padding: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .btn-action-group {
            flex-direction: column;
            gap: 0.75rem;
        }

        .btn-action-group .btn {
            width: 100%;
            min-width: unset;
        }
    }

    /* Loading State */
    .btn .spinner-border-sm {
        width: 1rem;
        height: 1rem;
        border-width: 0.15rem;
    }

    /* Toast Customizado */
    .toast-custom {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 10000;
        min-width: 350px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.15);
        padding: 1.25rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        animation: slideInRight 0.4s ease-out;
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

    .toast-custom.toast-success {
        border-left: 4px solid #10b981;
    }

    .toast-custom.toast-error {
        border-left: 4px solid #ef4444;
    }

    .toast-custom .toast-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .toast-custom.toast-success .toast-icon {
        background: #d1fae5;
        color: #10b981;
    }

    .toast-custom.toast-error .toast-icon {
        background: #fee2e2;
        color: #ef4444;
    }

    .toast-custom .toast-content {
        flex: 1;
    }

    .toast-custom .toast-title {
        font-weight: 700;
        margin-bottom: 0.25rem;
        font-size: 1rem;
    }

    .toast-custom .toast-message {
        font-size: 0.875rem;
        color: #64748b;
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
        <div class="d-flex align-items-center gap-4 header-content">
            <div class="icon-box">
                <i class="fas fa-edit text-white"></i>
            </div>
            <div>
                <h4 class="mb-2">Editar Produto</h4>
                <small><i class="fas fa-box me-2"></i>{{ $pe->designacao }}</small>
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
                            <input type="text" class="form-control text-uppercase" value="{{ $pe->num_lote }}" name="num_lote">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="fas fa-file-alt"></i>
                                Documento Nº
                            </label>
                            <input type="text" id="cod_barras" value="{{ $pe->num_documento }}" class="form-control" name="num_documento">
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
                            <input type="date" class="form-control" value="{{ $pe->data_producao }}" name="data_producao">
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
                            <input type="text" value="{{ $pe->origem_destino }}" class="form-control" name="origem_destino">
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
        e.preventDefault();

        const quantidade = parseInt($('#quantidade').val());

        if (isNaN(quantidade) || quantidade < 0) {
            alert('Por favor, insira uma quantidade válida (maior ou igual a 0)');
            $('#quantidade').focus();
            return false;
        }

        // Validar datas
        const dataProducao = new Date($('input[name="data_producao"]').val());
        const dataExpiracao = new Date($('input[name="data_expiracao"]').val());

        if (dataExpiracao <= dataProducao) {
            alert('A data de expiração deve ser posterior à data de produção');
            $('input[name="data_expiracao"]').focus();
            return false;
        }

        // Submit via AJAX com toast e redirecionamento
        const form = $(this);
        const formData = new FormData(this);
        const submitBtn = $('button[type="submit"]');
        const originalHtml = submitBtn.html();

        submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Atualizando...');

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Criar toast de sucesso
                const toastHtml = `
                    <div class="toast-custom toast-success" style="position:fixed; top:20px; right:20px; z-index:10000;">
                        <div class="toast-icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="toast-content">
                            <div class="toast-title">Sucesso!</div>
                            <div class="toast-message">${response.message || 'Produto atualizado com sucesso! Redirecionando...'}</div>
                        </div>
                    </div>`;

                $('body').append(toastHtml);

                // Redirecionar após 1.5 segundos
                setTimeout(function() {
                    const returnID = $('input[name="returnID"]').val() || '{{ $returnID }}';
                    window.location.href = `/estoque/ver/${returnID}`;
                }, 1500);
            },
            error: function(xhr) {
                let errorMsg = 'Erro ao atualizar produto';

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

                const toastHtml = `
                    <div class="toast-custom toast-error" style="position:fixed; top:20px; right:20px; z-index:10000;">
                        <div class="toast-icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="toast-content">
                            <div class="toast-title">Erro!</div>
                            <div class="toast-message">${errorMsg}</div>
                        </div>
                    </div>`;

                $('body').append(toastHtml);

                submitBtn.prop('disabled', false).html(originalHtml);

                // Remove toast após 4 segundos
                setTimeout(function() {
                    $('.toast-custom').remove();
                }, 4000);
            }
        });
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
