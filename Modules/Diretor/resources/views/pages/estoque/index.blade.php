@extends('diretor::layout.app')

@section('title', 'Gestão de Estoque')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Gestão de Estoque</h1>
        <p>Controle completo do inventário da farmácia</p>
    </div>
    <div class="page-actions">
        <button class="btn-modern btn-primary">
            <i class="fa-solid fa-plus me-2"></i>
            Adicionar Item
        </button>
    </div>
</div>

<div class="page-content">
    <!-- Filtros e Busca -->
    <div class="filters-section">
        <div class="filters-row">
            <div class="filter-group">
                <label for="categoria">Categoria</label>
                <select id="categoria" class="filter-select">
                    <option value="">Todas as categorias</option>
                    <option value="analgesicos">Analgésicos</option>
                    <option value="antibioticos">Antibióticos</option>
                    <option value="vitaminas">Vitaminas</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="status">Status do Stock</label>
                <select id="status" class="filter-select">
                    <option value="">Todos</option>
                    <option value="normal">Normal</option>
                    <option value="baixo">Stock Baixo</option>
                    <option value="critico">Crítico</option>
                    <option value="esgotado">Esgotado</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="validade">Validade</label>
                <select id="validade" class="filter-select">
                    <option value="">Todas</option>
                    <option value="30">Expiram em 30 dias</option>
                    <option value="60">Expiram em 60 dias</option>
                    <option value="vencidos">Vencidos</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Resumo do Estoque -->
    <div class="stock-summary">
        <div class="summary-card">
            <div class="summary-icon total">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
            <div class="summary-content">
                <div class="summary-value">2.847</div>
                <div class="summary-label">Total de Itens</div>
            </div>
        </div>
        
        <div class="summary-card">
            <div class="summary-icon normal">
                <i class="fa-solid fa-check-circle"></i>
            </div>
            <div class="summary-content">
                <div class="summary-value">2.756</div>
                <div class="summary-label">Stock Normal</div>
            </div>
        </div>
        
        <div class="summary-card">
            <div class="summary-icon warning">
                <i class="fa-solid fa-exclamation-triangle"></i>
            </div>
            <div class="summary-content">
                <div class="summary-value">68</div>
                <div class="summary-label">Stock Baixo</div>
            </div>
        </div>
        
        <div class="summary-card">
            <div class="summary-icon critical">
                <i class="fa-solid fa-times-circle"></i>
            </div>
            <div class="summary-content">
                <div class="summary-value">23</div>
                <div class="summary-label">Stock Crítico</div>
            </div>
        </div>
    </div>

    <!-- Tabela de Estoque -->
    <div class="table-container">
        <div class="table-header">
            <h3>Lista de Produtos</h3>
            <div class="table-actions">
                <button class="btn-secondary">
                    <i class="fa-solid fa-download me-2"></i>
                    Exportar
                </button>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Categoria</th>
                        <th>Stock Atual</th>
                        <th>Stock Mínimo</th>
                        <th>Status</th>
                        <th>Validade</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="product-info">
                                <div class="product-name">Paracetamol 500mg</div>
                                <div class="product-code">PAR-500-001</div>
                            </div>
                        </td>
                        <td><span class="category-badge analgesicos">Analgésicos</span></td>
                        <td><strong>245</strong> unidades</td>
                        <td>50 unidades</td>
                        <td><span class="status-badge normal">Normal</span></td>
                        <td>15/06/2026</td>
                        <td>Kz 1.500</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action" title="Ver detalhes"><i class="fa-solid fa-eye"></i></button>
                                <button class="btn-action" title="Editar"><i class="fa-solid fa-edit"></i></button>
                                <button class="btn-action danger" title="Remover"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="product-info">
                                <div class="product-name">Ibuprofeno 400mg</div>
                                <div class="product-code">IBU-400-002</div>
                            </div>
                        </td>
                        <td><span class="category-badge anti-inflamatorios">Anti-inflamatórios</span></td>
                        <td><strong>15</strong> unidades</td>
                        <td>30 unidades</td>
                        <td><span class="status-badge critical">Crítico</span></td>
                        <td>22/03/2026</td>
                        <td>Kz 2.200</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action" title="Ver detalhes"><i class="fa-solid fa-eye"></i></button>
                                <button class="btn-action" title="Editar"><i class="fa-solid fa-edit"></i></button>
                                <button class="btn-action danger" title="Remover"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="product-info">
                                <div class="product-name">Amoxicilina 875mg</div>
                                <div class="product-code">AMO-875-003</div>
                            </div>
                        </td>
                        <td><span class="category-badge antibioticos">Antibióticos</span></td>
                        <td><strong>125</strong> unidades</td>
                        <td>40 unidades</td>
                        <td><span class="status-badge normal">Normal</span></td>
                        <td>08/12/2025</td>
                        <td>Kz 4.800</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action" title="Ver detalhes"><i class="fa-solid fa-eye"></i></button>
                                <button class="btn-action" title="Editar"><i class="fa-solid fa-edit"></i></button>
                                <button class="btn-action danger" title="Remover"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="table-pagination">
            <div class="pagination-info">
                Mostrando 1-3 de 2.847 resultados
            </div>
            <div class="pagination-controls">
                <button class="pagination-btn" disabled>Anterior</button>
                <button class="pagination-btn active">1</button>
                <button class="pagination-btn">2</button>
                <button class="pagination-btn">3</button>
                <span class="pagination-dots">...</span>
                <button class="pagination-btn">949</button>
                <button class="pagination-btn">Próximo</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--border-primary);
}

.page-title h1 {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 0.5rem;
}

.page-title p {
    color: var(--text-secondary);
    margin: 0;
}

.filters-section {
    margin-bottom: 1.5rem;
}

.filters-row {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    min-width: 200px;
}

.filter-group label {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--text-secondary);
}

.filter-select {
    padding: 0.5rem 0.75rem;
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    background: var(--surface);
    color: var(--text-primary);
    font-size: 0.875rem;
}

.stock-summary {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.summary-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
}

.summary-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.summary-icon.total { background: var(--primary); }
.summary-icon.normal { background: var(--success); }
.summary-icon.warning { background: var(--warning); }
.summary-icon.critical { background: var(--danger); }

.summary-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1;
}

.summary-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-top: 0.25rem;
}

.table-container {
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
    overflow: hidden;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border-bottom: 1px solid var(--border-primary);
}

.table-header h3 {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
}

.btn-secondary {
    background: var(--bg-secondary);
    color: var(--text-secondary);
    border: 1px solid var(--border-primary);
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all var(--transition-fast);
}

.btn-secondary:hover {
    background: var(--surface-hover);
    color: var(--text-primary);
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th {
    background: var(--bg-secondary);
    color: var(--text-secondary);
    font-weight: 600;
    font-size: 0.875rem;
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid var(--border-primary);
}

.data-table td {
    padding: 1rem;
    border-bottom: 1px solid var(--border-primary);
    color: var(--text-primary);
    font-size: 0.875rem;
}

.product-info .product-name {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
}

.product-info .product-code {
    font-size: 0.75rem;
    color: var(--text-tertiary);
    font-family: 'JetBrains Mono', monospace;
}

.category-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.category-badge.analgesicos { background: rgba(34, 197, 94, 0.1); color: var(--success); }
.category-badge.antibioticos { background: rgba(59, 130, 246, 0.1); color: var(--primary); }
.category-badge.anti-inflamatorios { background: rgba(168, 85, 247, 0.1); color: #a855f7; }

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-badge.normal { background: rgba(34, 197, 94, 0.1); color: var(--success); }
.status-badge.warning { background: rgba(245, 158, 11, 0.1); color: var(--warning); }
.status-badge.critical { background: rgba(239, 68, 68, 0.1); color: var(--danger); }

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.btn-action {
    width: 32px;
    height: 32px;
    border: none;
    border-radius: var(--border-radius-sm);
    background: var(--bg-secondary);
    color: var(--text-secondary);
    cursor: pointer;
    transition: all var(--transition-fast);
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-action:hover {
    background: var(--surface-hover);
    color: var(--text-primary);
}

.btn-action.danger:hover {
    background: var(--danger);
    color: white;
}

.table-pagination {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.5rem;
    border-top: 1px solid var(--border-primary);
}

.pagination-info {
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.pagination-controls {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.pagination-btn {
    padding: 0.5rem 0.75rem;
    border: 1px solid var(--border-primary);
    background: var(--surface);
    color: var(--text-secondary);
    font-size: 0.875rem;
    border-radius: var(--border-radius-sm);
    cursor: pointer;
    transition: all var(--transition-fast);
}

.pagination-btn:hover:not(:disabled) {
    background: var(--surface-hover);
    color: var(--text-primary);
}

.pagination-btn.active {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

.pagination-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.pagination-dots {
    color: var(--text-tertiary);
    padding: 0 0.5rem;
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .filters-row {
        flex-direction: column;
    }
    
    .filter-group {
        min-width: auto;
    }
    
    .stock-summary {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .pagination-controls {
        flex-wrap: wrap;
        justify-content: center;
    }
}
</style>
@endpush