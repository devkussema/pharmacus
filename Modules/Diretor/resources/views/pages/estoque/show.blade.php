@extends('diretor::layout.app')

@section('title', 'Detalhes do Item')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Detalhes do Item de Estoque</h1>
        <p>Informações completas do produto #{{ $id }}</p>
    </div>
    <div class="page-actions">
        <a href="{{ route('diretor.estoque.index') }}" class="btn-secondary">
            <i class="fa-solid fa-arrow-left me-2"></i>
            Voltar
        </a>
    </div>
</div>

<div class="page-content">
    <div class="detail-grid">
        <div class="detail-main">
            <div class="detail-card">
                <div class="detail-header">
                    <h3>Informações do Produto</h3>
                    <span class="status-badge normal">Em Stock</span>
                </div>
                <div class="detail-body">
                    <div class="detail-item">
                        <span class="label">Nome do Produto:</span>
                        <span class="value">Paracetamol 500mg</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Código:</span>
                        <span class="value">PAR-500-001</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Categoria:</span>
                        <span class="value">Analgésicos</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Fabricante:</span>
                        <span class="value">PharmaCorp Ltd</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Descrição:</span>
                        <span class="value">Medicamento analgésico e antipirético para alívio de dores leves a moderadas e redução de febre.</span>
                    </div>
                </div>
            </div>
            
            <div class="detail-card">
                <div class="detail-header">
                    <h3>Controle de Stock</h3>
                </div>
                <div class="detail-body">
                    <div class="stock-grid">
                        <div class="stock-item">
                            <div class="stock-icon normal">
                                <i class="fa-solid fa-boxes-stacked"></i>
                            </div>
                            <div class="stock-info">
                                <div class="stock-value">245</div>
                                <div class="stock-label">Quantidade Atual</div>
                            </div>
                        </div>
                        <div class="stock-item">
                            <div class="stock-icon warning">
                                <i class="fa-solid fa-exclamation-triangle"></i>
                            </div>
                            <div class="stock-info">
                                <div class="stock-value">50</div>
                                <div class="stock-label">Stock Mínimo</div>
                            </div>
                        </div>
                        <div class="stock-item">
                            <div class="stock-icon success">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <div class="stock-info">
                                <div class="stock-value">195</div>
                                <div class="stock-label">Acima do Mínimo</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="detail-card">
                <div class="detail-header">
                    <h3>Histórico de Movimentos</h3>
                </div>
                <div class="detail-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-icon in">
                                <i class="fa-solid fa-arrow-down"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-title">Entrada de Stock</div>
                                <div class="timeline-desc">+100 unidades recebidas</div>
                                <div class="timeline-date">Há 2 dias</div>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-icon out">
                                <i class="fa-solid fa-arrow-up"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-title">Venda</div>
                                <div class="timeline-desc">-5 unidades vendidas</div>
                                <div class="timeline-date">Há 3 horas</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="detail-sidebar">
            <div class="detail-card">
                <div class="detail-header">
                    <h3>Informações Comerciais</h3>
                </div>
                <div class="detail-body">
                    <div class="detail-item">
                        <span class="label">Preço de Compra:</span>
                        <span class="value">Kz 1.200</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Preço de Venda:</span>
                        <span class="value">Kz 1.500</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Margem:</span>
                        <span class="value text-success">25%</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Valor Total Stock:</span>
                        <span class="value">Kz 367.500</span>
                    </div>
                </div>
            </div>
            
            <div class="detail-card">
                <div class="detail-header">
                    <h3>Validade</h3>
                </div>
                <div class="detail-body">
                    <div class="detail-item">
                        <span class="label">Data de Validade:</span>
                        <span class="value">15/06/2026</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Dias Restantes:</span>
                        <span class="value">589 dias</span>
                    </div>
                    <div class="alert-box info">
                        <i class="fa-solid fa-info-circle"></i>
                        Produto dentro do prazo de validade
                    </div>
                </div>
            </div>
            
            <div class="detail-card">
                <div class="detail-header">
                    <h3>Ações Rápidas</h3>
                </div>
                <div class="detail-body">
                    <div class="quick-actions">
                        <button class="action-btn full">
                            <i class="fa-solid fa-plus"></i>
                            Adicionar Stock
                        </button>
                        <button class="action-btn full">
                            <i class="fa-solid fa-minus"></i>
                            Remover Stock
                        </button>
                        <button class="action-btn full">
                            <i class="fa-solid fa-print"></i>
                            Imprimir Etiqueta
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.detail-grid {
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 1.5rem;
}

.detail-card {
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
    margin-bottom: 1.5rem;
    overflow: hidden;
}

.detail-header {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--border-primary);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.detail-header h3 {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
}

.detail-body {
    padding: 1.5rem;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    padding: 0.75rem 0;
    border-bottom: 1px solid var(--border-primary);
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-item .label {
    font-size: 0.875rem;
    color: var(--text-secondary);
    font-weight: 500;
}

.detail-item .value {
    font-size: 0.875rem;
    color: var(--text-primary);
    font-weight: 600;
    text-align: right;
}

.stock-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
}

.stock-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 1rem;
    background: var(--bg-secondary);
    border-radius: var(--border-radius-sm);
}

.stock-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    margin-bottom: 0.75rem;
}

.stock-icon.normal { background: var(--primary); }
.stock-icon.warning { background: var(--warning); }
.stock-icon.success { background: var(--success); }

.stock-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1;
}

.stock-label {
    font-size: 0.75rem;
    color: var(--text-secondary);
    margin-top: 0.25rem;
}

.timeline {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.timeline-item {
    display: flex;
    gap: 1rem;
}

.timeline-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.timeline-icon.in { background: var(--success); }
.timeline-icon.out { background: var(--warning); }

.timeline-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
}

.timeline-desc {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-top: 0.25rem;
}

.timeline-date {
    font-size: 0.75rem;
    color: var(--text-tertiary);
    margin-top: 0.25rem;
}

.alert-box {
    padding: 0.75rem 1rem;
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.875rem;
    margin-top: 1rem;
}

.alert-box.info {
    background: rgba(37, 99, 235, 0.1);
    color: var(--primary);
}

.quick-actions {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.action-btn.full {
    width: 100%;
    padding: 0.75rem 1rem;
    background: var(--bg-secondary);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all var(--transition-fast);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.action-btn.full:hover {
    background: var(--surface-hover);
    color: var(--text-primary);
    border-color: var(--primary);
}

@media (max-width: 1024px) {
    .detail-grid {
        grid-template-columns: 1fr;
    }
    
    .stock-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush
@endsection