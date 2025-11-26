@extends('diretor::layout.app')@extends('diretor::layout.app')@extends('diretor::layout.app')



@section('title', 'Detalhes do Medicamento')



@section('content')@section('title', 'Detalhes do Medicamento')@section('title', 'Detalhes do Item')

<div class="page-header">

    <div class="page-title">

        <div class="breadcrumb">

            <a href="{{ route('diretor.estoque.index') }}">@section('content')@section('content')

                <i class="fa-solid fa-arrow-left"></i> Voltar ao Estoque

            </a><div class="page-header"><div class="page-header">

        </div>

        <h1 id="produtoNome">Carregando...</h1>    <div class="page-title">    <div class="page-title">

        <p id="produtoCategoria" class="text-secondary">...</p>

    </div>        <div class="breadcrumb">        <h1>Detalhes do Item de Estoque</h1>

    <div class="page-actions">

        <button class="btn-secondary" onclick="window.print()">            <a href="{{ route('diretor.estoque.index') }}"><i class="fa-solid fa-arrow-left"></i> Voltar ao Estoque</a>        <p>Informações completas do produto #{{ $id }}</p>

            <i class="fa-solid fa-print me-2"></i>

            Imprimir        </div>    </div>

        </button>

        <button class="btn-modern btn-primary" onclick="dispensarProduto()">        <h1 id="produtoNome">Carregando...</h1>    <div class="page-actions">

            <i class="fa-solid fa-hand-holding-medical me-2"></i>

            Dispensar        <p id="produtoCategoria">...</p>        <a href="{{ route('diretor.estoque.index') }}" class="btn-secondary">

        </button>

    </div>    </div>            <i class="fa-solid fa-arrow-left me-2"></i>

</div>

    <div class="page-actions">            Voltar

<div class="page-content">

    <!-- Loading State -->        <button class="btn-secondary" onclick="window.location.href='{{ route('diretor.estoque.index') }}'">        </a>

    <div id="loadingContainer" class="loading-container">

        <div class="spinner"></div>            <i class="fa-solid fa-list me-2"></i>    </div>

        <p>Carregando detalhes do medicamento...</p>

    </div>            Lista</div>



    <!-- Content Container -->        </button>

    <div id="contentContainer" style="display: none;">

        <!-- Cards de Informação Principal -->        <button class="btn-modern btn-primary" onclick="dispensarProduto()"><div class="page-content">

        <div class="info-grid">

            <div class="info-card status-card">            <i class="fa-solid fa-hand-holding-medical me-2"></i>    <div class="detail-grid">

                <div class="card-icon" id="statusIcon">

                    <i class="fa-solid fa-signal"></i>            Dispensar        <div class="detail-main">

                </div>

                <div class="card-content">        </button>            <div class="detail-card">

                    <h3>Status do Estoque</h3>

                    <div class="status-badge-large" id="statusBadge">Normal</div>    </div>                <div class="detail-header">

                    <p class="status-description" id="statusDescription">Níveis adequados</p>

                </div></div>                    <h3>Informações do Produto</h3>

            </div>

                    <span class="status-badge normal">Em Stock</span>

            <div class="info-card">

                <div class="card-icon primary"><div class="page-content">                </div>

                    <i class="fa-solid fa-boxes-stacked"></i>

                </div>    <!-- Loading State -->                <div class="detail-body">

                <div class="card-content">

                    <h3>Quantidade Atual</h3>    <div id="loadingContainer" class="loading-container">                    <div class="detail-item">

                    <div class="value-large" id="quantidade">0</div>

                    <p class="value-label">unidades disponíveis</p>        <div class="spinner"></div>                        <span class="label">Nome do Produto:</span>

                </div>

            </div>        <p>Carregando detalhes do medicamento...</p>                        <span class="value">Paracetamol 500mg</span>



            <div class="info-card">    </div>                    </div>

                <div class="card-icon warning">

                    <i class="fa-solid fa-calendar-xmark"></i>                    <div class="detail-item">

                </div>

                <div class="card-content">    <!-- Content Container -->                        <span class="label">Código:</span>

                    <h3>Data de Validade</h3>

                    <div class="value-large" id="validade">--/--/----</div>    <div id="contentContainer" style="display: none;">                        <span class="value">PAR-500-001</span>

                    <p class="value-label" id="validadeRelativa">...</p>

                </div>        <!-- Cards de Informação Principal -->                    </div>

            </div>

        <div class="info-grid">                    <div class="detail-item">

            <div class="info-card">

                <div class="card-icon success">            <div class="info-card status-card">                        <span class="label">Categoria:</span>

                    <i class="fa-solid fa-barcode"></i>

                </div>                <div class="card-icon" id="statusIcon">                        <span class="value">Analgésicos</span>

                <div class="card-content">

                    <h3>Número do Lote</h3>                    <i class="fa-solid fa-signal"></i>                    </div>

                    <div class="value-large code" id="lote">---</div>

                    <p class="value-label">Identificação única</p>                </div>                    <div class="detail-item">

                </div>

            </div>                <div class="card-content">                        <span class="label">Fabricante:</span>

        </div>

                    <h3>Status do Estoque</h3>                        <span class="value">PharmaCorp Ltd</span>

        <!-- Detalhes Completos -->

        <div class="details-grid">                    <div class="status-badge-large" id="statusBadge">Normal</div>                    </div>

            <div class="detail-card">

                <div class="detail-card-header">                    <p class="status-description" id="statusDescription">Níveis adequados</p>                    <div class="detail-item">

                    <h2><i class="fa-solid fa-info-circle"></i> Informações Gerais</h2>

                </div>                </div>                        <span class="label">Descrição:</span>

                <div class="detail-card-body">

                    <div class="detail-row">            </div>                        <span class="value">Medicamento analgésico e antipirético para alívio de dores leves a moderadas e redução de febre.</span>

                        <span class="detail-label">Designação:</span>

                        <span class="detail-value" id="designacao">---</span>                    </div>

                    </div>

                    <div class="detail-row">            <div class="info-card">                </div>

                        <span class="detail-label">Dosagem:</span>

                        <span class="detail-value" id="dosagem">---</span>                <div class="card-icon primary">            </div>

                    </div>

                    <div class="detail-row">                    <i class="fa-solid fa-boxes-stacked"></i>

                        <span class="detail-label">Forma Farmacêutica:</span>

                        <span class="detail-value" id="forma">---</span>                </div>            <div class="detail-card">

                    </div>

                    <div class="detail-row">                <div class="card-content">                <div class="detail-header">

                        <span class="detail-label">Categoria:</span>

                        <span class="detail-value" id="categoriaFull">---</span>                    <h3>Quantidade Atual</h3>                    <h3>Controle de Stock</h3>

                    </div>

                    <div class="detail-row">                    <div class="value-large" id="quantidade">0</div>                </div>

                        <span class="detail-label">Descrição:</span>

                        <span class="detail-value" id="descritivo">---</span>                    <p class="value-label">unidades disponíveis</p>                <div class="detail-body">

                    </div>

                </div>                </div>                    <div class="stock-grid">

            </div>

            </div>                        <div class="stock-item">

            <div class="detail-card">

                <div class="detail-card-header">                            <div class="stock-icon normal">

                    <h2><i class="fa-solid fa-truck"></i> Rastreamento</h2>

                </div>            <div class="info-card">                                <i class="fa-solid fa-boxes-stacked"></i>

                <div class="detail-card-body">

                    <div class="detail-row">                <div class="card-icon warning">                            </div>

                        <span class="detail-label">Fornecedor:</span>

                        <span class="detail-value" id="fornecedor">---</span>                    <i class="fa-solid fa-calendar-xmark"></i>                            <div class="stock-info">

                    </div>

                    <div class="detail-row">                </div>                                <div class="stock-value">245</div>

                        <span class="detail-label">Data de Produção:</span>

                        <span class="detail-value" id="dataProducao">---</span>                <div class="card-content">                                <div class="stock-label">Quantidade Atual</div>

                    </div>

                    <div class="detail-row">                    <h3>Data de Validade</h3>                            </div>

                        <span class="detail-label">Data de Recepção:</span>

                        <span class="detail-value" id="dataRecepcao">---</span>                    <div class="value-large" id="validade">--/--/----</div>                        </div>

                    </div>

                    <div class="detail-row">                    <p class="value-label" id="validadeRelativa">...</p>                        <div class="stock-item">

                        <span class="detail-label">Origem/Destino:</span>

                        <span class="detail-value" id="origemDestino">---</span>                </div>                            <div class="stock-icon warning">

                    </div>

                    <div class="detail-row">            </div>                                <i class="fa-solid fa-exclamation-triangle"></i>

                        <span class="detail-label">Prateleira:</span>

                        <span class="detail-value" id="prateleira">---</span>                            </div>

                    </div>

                </div>            <div class="info-card">                            <div class="stock-info">

            </div>

        </div>                <div class="card-icon success">                                <div class="stock-value">50</div>



        <!-- Observações -->                    <i class="fa-solid fa-barcode"></i>                                <div class="stock-label">Stock Mínimo</div>

        <div class="detail-card">

            <div class="detail-card-header">                </div>                            </div>

                <h2><i class="fa-solid fa-note-sticky"></i> Observações</h2>

            </div>                <div class="card-content">                        </div>

            <div class="detail-card-body">

                <p id="observacoes" class="obs-text">Nenhuma observação registrada.</p>                    <h3>Número do Lote</h3>                        <div class="stock-item">

            </div>

        </div>                    <div class="value-large code" id="lote">---</div>                            <div class="stock-icon success">

    </div>

</div>                    <p class="value-label">Identificação única</p>                                <i class="fa-solid fa-chart-line"></i>



<!-- Toast Container -->                </div>                            </div>

<div id="toastContainer" class="toast-container"></div>

@endsection            </div>                            <div class="stock-info">



@push('styles')        </div>                                <div class="stock-value">195</div>

<style>

.breadcrumb {                                <div class="stock-label">Acima do Mínimo</div>

    margin-bottom: 0.75rem;

}        <!-- Detalhes Completos -->                            </div>



.breadcrumb a {        <div class="details-grid">                        </div>

    color: var(--text-secondary);

    text-decoration: none;            <div class="detail-card">                    </div>

    font-size: 0.875rem;

    display: inline-flex;                <div class="detail-card-header">                </div>

    align-items: center;

    gap: 0.5rem;                    <h2><i class="fa-solid fa-info-circle"></i> Informações Gerais</h2>            </div>

    transition: color var(--transition-fast);

}                </div>



.breadcrumb a:hover {                <div class="detail-card-body">            <div class="detail-card">

    color: var(--primary);

}                    <div class="detail-row">                <div class="detail-header">



.loading-container {                        <span class="detail-label">Designação:</span>                    <h3>Histórico de Movimentos</h3>

    display: flex;

    flex-direction: column;                        <span class="detail-value" id="designacao">---</span>                </div>

    align-items: center;

    justify-content: center;                    </div>                <div class="detail-body">

    padding: 5rem 1rem;

    color: var(--text-secondary);                    <div class="detail-row">                    <div class="timeline">

}

                        <span class="detail-label">Dosagem:</span>                        <div class="timeline-item">

.loading-container .spinner {

    width: 50px;                        <span class="detail-value" id="dosagem">---</span>                            <div class="timeline-icon in">

    height: 50px;

    border: 4px solid var(--border-primary);                    </div>                                <i class="fa-solid fa-arrow-down"></i>

    border-top-color: var(--primary);

    border-radius: 50%;                    <div class="detail-row">                            </div>

    animation: spin 1s linear infinite;

    margin-bottom: 1rem;                        <span class="detail-label">Forma Farmacêutica:</span>                            <div class="timeline-content">

}

                        <span class="detail-value" id="forma">---</span>                                <div class="timeline-title">Entrada de Stock</div>

@keyframes spin {

    to { transform: rotate(360deg); }                    </div>                                <div class="timeline-desc">+100 unidades recebidas</div>

}

                    <div class="detail-row">                                <div class="timeline-date">Há 2 dias</div>

.info-grid {

    display: grid;                        <span class="detail-label">Categoria:</span>                            </div>

    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));

    gap: 1.5rem;                        <span class="detail-value" id="categoriaFull">---</span>                        </div>

    margin-bottom: 2rem;

}                    </div>                        <div class="timeline-item">



.info-card {                    <div class="detail-row">                            <div class="timeline-icon out">

    background: var(--surface);

    border: 1px solid var(--border-primary);                        <span class="detail-label">Descrição:</span>                                <i class="fa-solid fa-arrow-up"></i>

    border-radius: var(--border-radius);

    padding: 1.5rem;                        <span class="detail-value" id="descritivo">---</span>                            </div>

    display: flex;

    gap: 1rem;                    </div>                            <div class="timeline-content">

    transition: all var(--transition-fast);

}                </div>                                <div class="timeline-title">Venda</div>



.info-card:hover {            </div>                                <div class="timeline-desc">-5 unidades vendidas</div>

    box-shadow: var(--shadow-lg);

    transform: translateY(-2px);                                <div class="timeline-date">Há 3 horas</div>

}

            <div class="detail-card">                            </div>

.card-icon {

    width: 60px;                <div class="detail-card-header">                        </div>

    height: 60px;

    border-radius: var(--border-radius-sm);                    <h2><i class="fa-solid fa-truck"></i> Rastreamento</h2>                    </div>

    display: flex;

    align-items: center;                </div>                </div>

    justify-content: center;

    font-size: 1.5rem;                <div class="detail-card-body">            </div>

    color: white;

    flex-shrink: 0;                    <div class="detail-row">        </div>

}

                        <span class="detail-label">Fornecedor:</span>

.card-icon.primary { background: var(--primary); }

.card-icon.success { background: var(--success); }                        <span class="detail-value" id="fornecedor">---</span>        <div class="detail-sidebar">

.card-icon.warning { background: var(--warning); }

.card-icon.danger, .card-icon.critical { background: var(--danger); }                    </div>            <div class="detail-card">

.card-icon.normal { background: var(--success); }

                    <div class="detail-row">                <div class="detail-header">

.card-content {

    flex: 1;                        <span class="detail-label">Data de Produção:</span>                    <h3>Informações Comerciais</h3>

}

                        <span class="detail-value" id="dataProducao">---</span>                </div>

.card-content h3 {

    font-size: 0.875rem;                    </div>                <div class="detail-body">

    font-weight: 600;

    color: var(--text-secondary);                    <div class="detail-row">                    <div class="detail-item">

    margin: 0 0 0.75rem;

    text-transform: uppercase;                        <span class="detail-label">Data de Recepção:</span>                        <span class="label">Fornecedor:</span>

    letter-spacing: 0.5px;

}                        <span class="detail-value" id="dataRecepcao">---</span>                        <span class="value">PharmaCorp Ltd</span>



.value-large {                    </div>                    </div>

    font-size: 2rem;

    font-weight: 700;                    <div class="detail-row">                    <div class="detail-item">

    color: var(--text-primary);

    line-height: 1;                        <span class="detail-label">Origem/Destino:</span>                        <span class="label">Lote:</span>

    margin-bottom: 0.25rem;

}                        <span class="detail-value" id="origemDestino">---</span>                        <span class="value"><code>LT2024-089</code></span>



.value-large.code {                    </div>                    </div>

    font-family: 'JetBrains Mono', monospace;

    font-size: 1.5rem;                    <div class="detail-row">                    <div class="detail-item">

}

                        <span class="detail-label">Prateleira:</span>                        <span class="label">Data de Entrada:</span>

.value-label {

    font-size: 0.875rem;                        <span class="detail-value" id="prateleira">---</span>                        <span class="value">10/01/2025</span>

    color: var(--text-tertiary);

    margin: 0;                    </div>                    </div>

}

                </div>                    <div class="detail-item">

.status-badge-large {

    display: inline-block;            </div>                        <span class="label">Unidades Dispensadas:</span>

    padding: 0.5rem 1rem;

    border-radius: 12px;        </div>                        <span class="value">155 unidades</span>

    font-size: 1rem;

    font-weight: 600;                    </div>

    text-transform: uppercase;

    margin-bottom: 0.5rem;        <!-- Observações -->                </div>

}

        <div class="detail-card">            </div>

.status-badge-large.normal {

    background: rgba(34, 197, 94, 0.1);            <div class="detail-card-header">

    color: var(--success);

}                <h2><i class="fa-solid fa-note-sticky"></i> Observações</h2>            <div class="detail-card">



.status-badge-large.warning {            </div>                <div class="detail-header">

    background: rgba(245, 158, 11, 0.1);

    color: var(--warning);            <div class="detail-card-body">                    <h3>Validade</h3>

}

                <p id="observacoes" class="obs-text">Nenhuma observação registrada.</p>                </div>

.status-badge-large.critical {

    background: rgba(239, 68, 68, 0.1);            </div>                <div class="detail-body">

    color: var(--danger);

}        </div>                    <div class="detail-item">



.status-description {    </div>                        <span class="label">Data de Validade:</span>

    font-size: 0.875rem;

    color: var(--text-tertiary);</div>                        <span class="value">15/06/2026</span>

    margin: 0;

}                    </div>



.details-grid {<!-- Toast Container -->                    <div class="detail-item">

    display: grid;

    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));<div id="toastContainer" class="toast-container"></div>                        <span class="label">Dias Restantes:</span>

    gap: 1.5rem;

    margin-bottom: 1.5rem;@endsection                        <span class="value">589 dias</span>

}

                    </div>

.detail-card {

    background: var(--surface);@push('styles')                    <div class="alert-box info">

    border: 1px solid var(--border-primary);

    border-radius: var(--border-radius);<style>                        <i class="fa-solid fa-info-circle"></i>

    overflow: hidden;

}.breadcrumb {                        Produto dentro do prazo de validade



.detail-card-header {    margin-bottom: 0.75rem;                    </div>

    background: var(--bg-secondary);

    padding: 1rem 1.5rem;}                </div>

    border-bottom: 1px solid var(--border-primary);

}            </div>



.detail-card-header h2 {.breadcrumb a {

    font-size: 1.125rem;

    font-weight: 600;    color: var(--text-secondary);            <div class="detail-card">

    color: var(--text-primary);

    margin: 0;    text-decoration: none;                <div class="detail-header">

    display: flex;

    align-items: center;    font-size: 0.875rem;                    <h3>Ações Rápidas</h3>

    gap: 0.5rem;

}    display: inline-flex;                </div>



.detail-card-body {    align-items: center;                <div class="detail-body">

    padding: 1.5rem;

}    gap: 0.5rem;                    <div class="quick-actions">



.detail-row {    transition: color var(--transition-fast);                        <button class="action-btn full primary">

    display: flex;

    justify-content: space-between;}                            <i class="fa-solid fa-hand-holding-medical"></i>

    align-items: flex-start;

    padding: 0.75rem 0;                            Dispensar Medicamento

    border-bottom: 1px solid var(--border-primary);

    gap: 1rem;.breadcrumb a:hover {                        </button>

}

    color: var(--primary);                        <button class="action-btn full">

.detail-row:last-child {

    border-bottom: none;}                            <i class="fa-solid fa-plus"></i>

}

                            Registrar Entrada

.detail-label {

    font-weight: 600;.loading-container {                        </button>

    color: var(--text-secondary);

    font-size: 0.875rem;    display: flex;                        <button class="action-btn full">

    flex-shrink: 0;

}    flex-direction: column;                            <i class="fa-solid fa-bell"></i>



.detail-value {    align-items: center;                            Solicitar Reposição

    color: var(--text-primary);

    font-size: 0.875rem;    justify-content: center;                        </button>

    text-align: right;

    word-break: break-word;    padding: 5rem 1rem;                        <button class="action-btn full">

}

    color: var(--text-secondary);                            <i class="fa-solid fa-print"></i>

.obs-text {

    color: var(--text-secondary);}                            Imprimir Etiqueta

    line-height: 1.6;

    margin: 0;                        </button>

}

.loading-container .spinner {                    </div>

.toast-container {

    position: fixed;    width: 50px;                </div>

    top: 20px;

    right: 20px;    height: 50px;            </div>

    z-index: 10000;

    display: flex;    border: 4px solid var(--border-primary);        </div>

    flex-direction: column;

    gap: 10px;    border-top-color: var(--primary);    </div>

}

    border-radius: 50%;</div>

.toast {

    min-width: 300px;    animation: spin 1s linear infinite;

    padding: 1rem 1.5rem;

    background: var(--surface);    margin-bottom: 1rem;@push('styles')

    border: 1px solid var(--border-primary);

    border-radius: var(--border-radius);}<style>

    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);

    display: flex;.detail-grid {

    align-items: center;

    gap: 1rem;@keyframes spin {    display: grid;

    animation: slideIn 0.3s ease-out;

}    to { transform: rotate(360deg); }    grid-template-columns: 1fr 350px;



@keyframes slideIn {}    gap: 1.5rem;

    from {

        transform: translateX(400px);}

        opacity: 0;

    }.info-grid {

    to {

        transform: translateX(0);    display: grid;.detail-card {

        opacity: 1;

    }    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));    background: var(--surface);

}

    gap: 1.5rem;    border: 1px solid var(--border-primary);

.toast.success { border-left: 4px solid var(--success); }

.toast.error { border-left: 4px solid var(--danger); }    margin-bottom: 2rem;    border-radius: var(--border-radius);

.toast.warning { border-left: 4px solid var(--warning); }

.toast.info { border-left: 4px solid var(--primary); }}    margin-bottom: 1.5rem;



.toast-icon {    overflow: hidden;

    font-size: 1.25rem;

}.info-card {}



.toast.success .toast-icon { color: var(--success); }    background: var(--surface);

.toast.error .toast-icon { color: var(--danger); }

.toast.warning .toast-icon { color: var(--warning); }    border: 1px solid var(--border-primary);.detail-header {

.toast.info .toast-icon { color: var(--primary); }

    border-radius: var(--border-radius);    padding: 1.25rem 1.5rem;

.toast-message {

    flex: 1;    padding: 1.5rem;    border-bottom: 1px solid var(--border-primary);

    font-size: 0.875rem;

    color: var(--text-primary);    display: flex;    display: flex;

}

    gap: 1rem;    justify-content: space-between;

.toast-close {

    background: none;    transition: all var(--transition-fast);    align-items: center;

    border: none;

    color: var(--text-tertiary);}}

    cursor: pointer;

    font-size: 1.25rem;

    padding: 0;

    line-height: 1;.info-card:hover {.detail-header h3 {

}

    box-shadow: var(--shadow-lg);    font-size: 1.125rem;

.toast-close:hover {

    color: var(--text-primary);    transform: translateY(-2px);    font-weight: 600;

}

}    color: var(--text-primary);

@media (max-width: 768px) {

    .page-header {    margin: 0;

        flex-direction: column;

        gap: 1rem;.card-icon {}

    }

    width: 60px;

    .info-grid {

        grid-template-columns: 1fr;    height: 60px;.detail-body {

    }

    border-radius: var(--border-radius-sm);    padding: 1.5rem;

    .details-grid {

        grid-template-columns: 1fr;    display: flex;}

    }

}    align-items: center;

</style>

@endpush    justify-content: center;.detail-item {



@push('scripts')    font-size: 1.5rem;    display: flex;

<script>

const produtoId = {{ $id }};    color: white;    justify-content: space-between;



function showToast(message, type = 'info') {    flex-shrink: 0;    padding: 0.75rem 0;

    const container = document.getElementById('toastContainer');

    const toast = document.createElement('div');}    border-bottom: 1px solid var(--border-primary);

    toast.className = `toast ${type}`;

}

    const icons = {

        success: 'fa-check-circle',.card-icon.primary { background: var(--primary); }

        error: 'fa-times-circle',

        warning: 'fa-exclamation-triangle',.card-icon.success { background: var(--success); }.detail-item:last-child {

        info: 'fa-info-circle'

    };.card-icon.warning { background: var(--warning); }    border-bottom: none;



    toast.innerHTML = `.card-icon.danger, .card-icon.critical { background: var(--danger); }}

        <i class="fa-solid ${icons[type]} toast-icon"></i>

        <span class="toast-message">${message}</span>.card-icon.normal { background: var(--success); }

        <button class="toast-close" onclick="this.parentElement.remove()">

            <i class="fa-solid fa-times"></i>.detail-item .label {

        </button>

    `;.card-content {    font-size: 0.875rem;



    container.appendChild(toast);    flex: 1;    color: var(--text-secondary);



    setTimeout(() => {}    font-weight: 500;

        toast.style.animation = 'slideIn 0.3s ease-out reverse';

        setTimeout(() => toast.remove(), 300);}

    }, 5000);

}.card-content h3 {



async function carregarDetalhes() {    font-size: 0.875rem;.detail-item .value {

    try {

        const response = await fetch(`{{ route('diretor.estoque.detalhes', ':id') }}`.replace(':id', produtoId));    font-weight: 600;    font-size: 0.875rem;

        const data = await response.json();

    color: var(--text-secondary);    color: var(--text-primary);

        if (data.success) {

            preencherDetalhes(data.produto);    margin: 0 0 0.75rem;    font-weight: 600;

            document.getElementById('loadingContainer').style.display = 'none';

            document.getElementById('contentContainer').style.display = 'block';    text-transform: uppercase;    text-align: right;

        } else {

            showToast(data.message || 'Erro ao carregar detalhes', 'error');    letter-spacing: 0.5px;}

        }

    } catch (error) {}

        console.error('Erro:', error);

        showToast('Erro ao carregar detalhes do medicamento', 'error');.stock-grid {

    }

}.value-large {    display: grid;



function preencherDetalhes(produto) {    font-size: 2rem;    grid-template-columns: repeat(3, 1fr);

    document.getElementById('produtoNome').textContent = produto.designacao;

    document.getElementById('produtoCategoria').textContent = produto.categoria;    font-weight: 700;    gap: 1rem;



    document.getElementById('quantidade').textContent = produto.quantidade || 0;    color: var(--text-primary);}

    document.getElementById('validade').textContent = produto.data_expiracao || 'N/A';

    document.getElementById('validadeRelativa').textContent = produto.data_expiracao ? 'Válido até ' + produto.data_expiracao : 'Não informado';    line-height: 1;

    document.getElementById('lote').textContent = produto.num_lote || 'N/A';

    margin-bottom: 0.25rem;.stock-item {

    // Status

    const statusBadge = document.getElementById('statusBadge');}    display: flex;

    statusBadge.textContent = produto.status_label || 'Normal';

    statusBadge.className = `status-badge-large ${produto.status_classe || 'normal'}`;    flex-direction: column;



    const statusIcon = document.getElementById('statusIcon');.value-large.code {    align-items: center;

    statusIcon.className = `card-icon ${produto.status_classe || 'normal'}`;

    font-family: 'JetBrains Mono', monospace;    text-align: center;

    document.getElementById('statusDescription').textContent = produto.status_descricao || 'Níveis adequados';

    font-size: 1.5rem;    padding: 1rem;

    // Detalhes

    document.getElementById('designacao').textContent = produto.designacao || 'N/A';}    background: var(--bg-secondary);

    document.getElementById('dosagem').textContent = produto.dosagem || 'N/A';

    document.getElementById('forma').textContent = produto.forma || 'N/A';    border-radius: var(--border-radius-sm);

    document.getElementById('categoriaFull').textContent = produto.categoria || 'N/A';

    document.getElementById('descritivo').textContent = produto.descritivo || 'N/A';.value-label {}



    document.getElementById('fornecedor').textContent = produto.fornecedor || 'N/A';    font-size: 0.875rem;

    document.getElementById('dataProducao').textContent = produto.data_producao || 'N/A';

    document.getElementById('dataRecepcao').textContent = produto.data_recepcao || 'N/A';    color: var(--text-tertiary);.stock-icon {

    document.getElementById('origemDestino').textContent = produto.origem_destino || 'N/A';

    document.getElementById('prateleira').textContent = produto.prateleira_codigo || 'N/A';    margin: 0;    width: 48px;



    document.getElementById('observacoes').textContent = produto.obs || 'Nenhuma observação registrada.';}    height: 48px;

}

    border-radius: var(--border-radius-sm);

function dispensarProduto() {

    showToast('Funcionalidade de dispensação em desenvolvimento', 'info');.status-badge-large {    display: flex;

}

    display: inline-block;    align-items: center;

document.addEventListener('DOMContentLoaded', () => {

    carregarDetalhes();    padding: 0.5rem 1rem;    justify-content: center;

});

</script>    border-radius: 12px;    color: white;

@endpush

    font-size: 1rem;    font-size: 1.25rem;

    font-weight: 600;    margin-bottom: 0.75rem;

    text-transform: uppercase;}

    margin-bottom: 0.5rem;

}.stock-icon.normal { background: var(--primary); }

.stock-icon.warning { background: var(--warning); }

.status-badge-large.normal {.stock-icon.success { background: var(--success); }

    background: rgba(34, 197, 94, 0.1);

    color: var(--success);.stock-value {

}    font-size: 1.5rem;

    font-weight: 700;

.status-badge-large.warning {    color: var(--text-primary);

    background: rgba(245, 158, 11, 0.1);    line-height: 1;

    color: var(--warning);}

}

.stock-label {

.status-badge-large.critical {    font-size: 0.75rem;

    background: rgba(239, 68, 68, 0.1);    color: var(--text-secondary);

    color: var(--danger);    margin-top: 0.25rem;

}}



.status-description {.timeline {

    font-size: 0.875rem;    display: flex;

    color: var(--text-tertiary);    flex-direction: column;

    margin: 0;    gap: 1rem;

}}



.details-grid {.timeline-item {

    display: grid;    display: flex;

    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));    gap: 1rem;

    gap: 1.5rem;}

    margin-bottom: 1.5rem;

}.timeline-icon {

    width: 40px;

.detail-card {    height: 40px;

    background: var(--surface);    border-radius: 50%;

    border: 1px solid var(--border-primary);    display: flex;

    border-radius: var(--border-radius);    align-items: center;

    overflow: hidden;    justify-content: center;

}    color: white;

    flex-shrink: 0;

.detail-card-header {}

    background: var(--bg-secondary);

    padding: 1rem 1.5rem;.timeline-icon.in { background: var(--success); }

    border-bottom: 1px solid var(--border-primary);.timeline-icon.out { background: var(--warning); }

}

.timeline-title {

.detail-card-header h2 {    font-size: 0.875rem;

    font-size: 1.125rem;    font-weight: 600;

    font-weight: 600;    color: var(--text-primary);

    color: var(--text-primary);}

    margin: 0;

    display: flex;.timeline-desc {

    align-items: center;    font-size: 0.875rem;

    gap: 0.5rem;    color: var(--text-secondary);

}    margin-top: 0.25rem;

}

.detail-card-body {

    padding: 1.5rem;.timeline-date {

}    font-size: 0.75rem;

    color: var(--text-tertiary);

.detail-row {    margin-top: 0.25rem;

    display: flex;}

    justify-content: space-between;

    align-items: flex-start;.alert-box {

    padding: 0.75rem 0;    padding: 0.75rem 1rem;

    border-bottom: 1px solid var(--border-primary);    border-radius: var(--border-radius-sm);

    gap: 1rem;    display: flex;

}    align-items: center;

    gap: 0.75rem;

.detail-row:last-child {    font-size: 0.875rem;

    border-bottom: none;    margin-top: 1rem;

}}



.detail-label {.alert-box.info {

    font-weight: 600;    background: rgba(37, 99, 235, 0.1);

    color: var(--text-secondary);    color: var(--primary);

    font-size: 0.875rem;}

    flex-shrink: 0;

}.quick-actions {

    display: flex;

.detail-value {    flex-direction: column;

    color: var(--text-primary);    gap: 0.75rem;

    font-size: 0.875rem;}

    text-align: right;

    word-break: break-word;.action-btn.full {

}    width: 100%;

    padding: 0.75rem 1rem;

.obs-text {    background: var(--bg-secondary);

    color: var(--text-secondary);    border: 1px solid var(--border-primary);

    line-height: 1.6;    border-radius: var(--border-radius-sm);

    margin: 0;    color: var(--text-secondary);

}    font-size: 0.875rem;

    font-weight: 500;

.toast-container {    cursor: pointer;

    position: fixed;    transition: all var(--transition-fast);

    top: 20px;    display: flex;

    right: 20px;    align-items: center;

    z-index: 10000;    justify-content: center;

    display: flex;    gap: 0.5rem;

    flex-direction: column;}

    gap: 10px;

}.action-btn.full:hover {

    background: var(--surface-hover);

.toast {    color: var(--text-primary);

    min-width: 300px;    border-color: var(--primary);

    padding: 1rem 1.5rem;}

    background: var(--surface);

    border: 1px solid var(--border-primary);@media (max-width: 1024px) {

    border-radius: var(--border-radius);    .detail-grid {

    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);        grid-template-columns: 1fr;

    display: flex;    }

    align-items: center;

    gap: 1rem;    .stock-grid {

    animation: slideIn 0.3s ease-out;        grid-template-columns: 1fr;

}    }

}

@keyframes slideIn {</style>

    from {@endpush

        transform: translateX(400px);@endsection
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.toast.success { border-left: 4px solid var(--success); }
.toast.error { border-left: 4px solid var(--danger); }
.toast.warning { border-left: 4px solid var(--warning); }
.toast.info { border-left: 4px solid var(--primary); }

.toast-icon {
    font-size: 1.25rem;
}

.toast.success .toast-icon { color: var(--success); }
.toast.error .toast-icon { color: var(--danger); }
.toast.warning .toast-icon { color: var(--warning); }
.toast.info .toast-icon { color: var(--primary); }

.toast-message {
    flex: 1;
    font-size: 0.875rem;
    color: var(--text-primary);
}

.toast-close {
    background: none;
    border: none;
    color: var(--text-tertiary);
    cursor: pointer;
    font-size: 1.25rem;
    padding: 0;
    line-height: 1;
}

.toast-close:hover {
    color: var(--text-primary);
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        gap: 1rem;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }

    .details-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@push('scripts')
<script>
const produtoId = {{ $id }};

function showToast(message, type = 'info') {
    const container = document.getElementById('toastContainer');
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;

    const icons = {
        success: 'fa-check-circle',
        error: 'fa-times-circle',
        warning: 'fa-exclamation-triangle',
        info: 'fa-info-circle'
    };

    toast.innerHTML = `
        <i class="fa-solid ${icons[type]} toast-icon"></i>
        <span class="toast-message">${message}</span>
        <button class="toast-close" onclick="this.parentElement.remove()">
            <i class="fa-solid fa-times"></i>
        </button>
    `;

    container.appendChild(toast);

    setTimeout(() => {
        toast.style.animation = 'slideIn 0.3s ease-out reverse';
        setTimeout(() => toast.remove(), 300);
    }, 5000);
}

async function carregarDetalhes() {
    try {
        const response = await fetch(`{{ url('diretor/estoque/historico') }}/${produtoId}`);
        const data = await response.json();

        if (data.success) {
            preencherDetalhes(data.produto);
            document.getElementById('loadingContainer').style.display = 'none';
            document.getElementById('contentContainer').style.display = 'block';
        } else {
            showToast(data.message || 'Erro ao carregar detalhes', 'error');
        }
    } catch (error) {
        console.error('Erro:', error);
        showToast('Erro ao carregar detalhes do medicamento', 'error');
    }
}

function preencherDetalhes(produto) {
    document.getElementById('produtoNome').textContent = produto.designacao;
    document.getElementById('produtoCategoria').textContent = produto.categoria;

    document.getElementById('quantidade').textContent = produto.quantidade;
    document.getElementById('validade').textContent = produto.data_expiracao;
    document.getElementById('validadeRelativa').textContent = 'Válido até ' + produto.data_expiracao;
    document.getElementById('lote').textContent = produto.num_lote;

    // Status
    const quantidade = produto.quantidade;
    let statusClasse = 'normal';
    let statusLabel = 'Normal';
    let statusDesc = 'Níveis adequados';

    if (quantidade <= 20) {
        statusClasse = 'critical';
        statusLabel = 'Crítico';
        statusDesc = 'Reposição urgente necessária';
    } else if (quantidade <= 50) {
        statusClasse = 'warning';
        statusLabel = 'Mínimo';
        statusDesc = 'Considerar reposição';
    }

    const statusBadge = document.getElementById('statusBadge');
    statusBadge.textContent = statusLabel;
    statusBadge.className = `status-badge-large ${statusClasse}`;

    const statusIcon = document.getElementById('statusIcon');
    statusIcon.className = `card-icon ${statusClasse}`;

    document.getElementById('statusDescription').textContent = statusDesc;

    // Detalhes
    document.getElementById('designacao').textContent = produto.designacao;
    document.getElementById('dosagem').textContent = 'N/A';
    document.getElementById('forma').textContent = 'N/A';
    document.getElementById('categoriaFull').textContent = produto.categoria;
    document.getElementById('descritivo').textContent = 'N/A';

    document.getElementById('fornecedor').textContent = 'N/A';
    document.getElementById('dataProducao').textContent = 'N/A';
    document.getElementById('dataRecepcao').textContent = 'N/A';
    document.getElementById('origemDestino').textContent = 'N/A';
    document.getElementById('prateleira').textContent = 'N/A';

    document.getElementById('observacoes').textContent = 'Nenhuma observação registrada.';
}

function dispensarProduto() {
    showToast('Funcionalidade de dispensação em desenvolvimento', 'info');
}

document.addEventListener('DOMContentLoaded', () => {
    carregarDetalhes();
});
</script>
@endpush
