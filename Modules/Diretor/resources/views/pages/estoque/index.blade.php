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
            <div class="filter-group" style="flex: 1; max-width: 400px;">
                <label for="busca"><i class="fa-solid fa-search"></i> Buscar</label>
                <input type="text" id="busca" class="filter-select" placeholder="Nome, lote, descrição..." style="padding-right: 2.5rem;">
            </div>
            <div class="filter-group">
                <label for="categoria"><i class="fa-solid fa-pills"></i> Categoria</label>
                <select id="categoria" class="filter-select">
                    <option value="">Todas as categorias</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="status"><i class="fa-solid fa-signal"></i> Status do Stock</label>
                <select id="status" class="filter-select">
                    <option value="">Todos os status</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="validade"><i class="fa-solid fa-calendar-xmark"></i> Validade</label>
                <select id="validade" class="filter-select">
                    <option value="">Todas</option>
                    <option value="30">Expiram em 30 dias</option>
                    <option value="60">Expiram em 60 dias</option>
                    <option value="vencidos">Vencidos</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Resumo do Estoque - Farmácia Hospitalar -->
    <div class="stock-summary">
        <div class="summary-card">
            <div class="summary-icon total">
                <i class="fa-solid fa-boxes-stacked"></i>
            </div>
            <div class="summary-content">
                <div class="summary-value">2.847</div>
                <div class="summary-label">Total de Medicamentos</div>
            </div>
        </div>
        
        <div class="summary-card">
            <div class="summary-icon normal">
                <i class="fa-solid fa-check-circle"></i>
            </div>
            <div class="summary-content">
                <div class="summary-value">2.756</div>
                <div class="summary-label">Nível Adequado</div>
            </div>
        </div>
        
        <div class="summary-card">
            <div class="summary-icon warning">
                <i class="fa-solid fa-exclamation-triangle"></i>
            </div>
            <div class="summary-content">
                <div class="summary-value">68</div>
                <div class="summary-label">Nível Mínimo</div>
            </div>
        </div>
        
        <div class="summary-card">
            <div class="summary-icon critical">
                <i class="fa-solid fa-times-circle"></i>
            </div>
            <div class="summary-content">
                <div class="summary-value">23</div>
                <div class="summary-label">Nível Crítico</div>
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
                        <th>Medicamento</th>
                        <th>Categoria</th>
                        <th>Quantidade Atual</th>
                        <th>Nível Mínimo</th>
                        <th>Status</th>
                        <th>Validade</th>
                        <th>Lote</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 3rem;">
                            <div class="spinner" style="margin: 0 auto;"></div>
                            <p style="color: var(--text-secondary); margin-top: 1rem;">Carregando produtos...</p>
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

<!-- Loading Overlay -->
<div id="loadingOverlay" class="loading-overlay" style="display: none;">
    <div class="spinner"></div>
</div>

<!-- Toast Container -->
<div id="toastContainer" class="toast-container"></div>
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
    font-weight: 600;
    color: var(--text-secondary);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.filter-group label i {
    color: var(--text-tertiary);
    font-size: 0.875rem;
}

.filter-select {
    padding: 0.5rem 0.75rem;
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    background: var(--surface);
    color: var(--text-primary);
    font-size: 0.875rem;
    transition: all var(--transition-fast);
}

.filter-select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
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
    white-space: nowrap;
}

.category-badge.analgesicos,
.category-badge.analgesico { background: rgba(34, 197, 94, 0.1); color: var(--success); }

.category-badge.antibioticos,
.category-badge.antibiotico { background: rgba(59, 130, 246, 0.1); color: var(--primary); }

.category-badge.anti-inflamatorios,
.category-badge.anti-inflamatorio { background: rgba(168, 85, 247, 0.1); color: #a855f7; }

.category-badge.cardiovasculares,
.category-badge.cardiovascular { background: rgba(239, 68, 68, 0.1); color: var(--danger); }

.category-badge.antihipertensivos,
.category-badge.antihipertensivo { background: rgba(245, 158, 11, 0.1); color: var(--warning); }

.category-badge.vitaminas,
.category-badge.vitamina { background: rgba(16, 185, 129, 0.1); color: #10b981; }

/* Default para outras categorias */
.category-badge { background: rgba(107, 114, 128, 0.1); color: #6b7280; }

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

/* Loading Overlay */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.spinner {
    width: 50px;
    height: 50px;
    border: 4px solid rgba(255, 255, 255, 0.3);
    border-top-color: var(--primary);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Toast Notifications */
.toast-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 10000;
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.toast {
    min-width: 300px;
    padding: 1rem 1.5rem;
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    display: flex;
    align-items: center;
    gap: 1rem;
    animation: slideIn 0.3s ease-out;
}

@keyframes slideIn {
    from {
        transform: translateX(400px);
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

@push('scripts')
<script>
// ==================== UTILIDADES ====================
const showLoading = () => document.getElementById('loadingOverlay').style.display = 'flex';
const hideLoading = () => document.getElementById('loadingOverlay').style.display = 'none';

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

// ==================== CARREGAR CATEGORIAS ====================
async function carregarCategorias() {
    try {
        const response = await fetch('{{ route("diretor.estoque.categorias") }}');
        const data = await response.json();
        
        const select = document.getElementById('categoria');
        select.innerHTML = '<option value="">Todas as categorias</option>';
        
        data.categorias.forEach(cat => {
            const option = document.createElement('option');
            option.value = cat.id;
            option.textContent = `${cat.nome} (${cat.total_produtos})`;
            select.appendChild(option);
        });
    } catch (error) {
        console.error('Erro ao carregar categorias:', error);
        showToast('Erro ao carregar categorias', 'error');
    }
}

// ==================== CARREGAR STATUS ====================
async function carregarStatusOpcoes() {
    try {
        const response = await fetch('{{ route("diretor.estoque.status-opcoes") }}');
        const data = await response.json();
        
        const select = document.getElementById('status');
        select.innerHTML = '<option value="">Todos os status</option>';
        
        data.status.forEach(st => {
            const option = document.createElement('option');
            option.value = st.nome.toLowerCase();
            option.textContent = st.nome;
            select.appendChild(option);
        });
    } catch (error) {
        console.error('Erro ao carregar status:', error);
        showToast('Erro ao carregar status', 'error');
    }
}

// ==================== CARREGAR PRODUTOS ====================
let currentPage = 1;
let currentFilters = {};
let searchTimeout;

async function carregarProdutos(page = 1) {
    showLoading();
    currentPage = page;
    
    try {
        const params = new URLSearchParams({
            page: page,
            categoria: document.getElementById('categoria').value || '',
            status: document.getElementById('status').value || '',
            validade: document.getElementById('validade').value || '',
            search: document.getElementById('busca').value || ''
        });
        
        const response = await fetch(`{{ route("diretor.estoque.listar") }}?${params}`);
        const data = await response.json();
        
        if (data.success) {
            atualizarTabela(data.produtos.data);
            atualizarPaginacao(data.produtos);
            atualizarResumo(data.resumo);
        } else {
            showToast(data.message || 'Erro ao carregar produtos', 'error');
        }
    } catch (error) {
        console.error('Erro ao carregar produtos:', error);
        showToast('Erro ao carregar produtos. Verifique sua conexão.', 'error');
    } finally {
        hideLoading();
    }
}

// ==================== ATUALIZAR TABELA ====================
function atualizarTabela(produtos) {
    const tbody = document.querySelector('.data-table tbody');
    
    if (!produtos || produtos.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="8" style="text-align: center; padding: 3rem;">
                    <i class="fa-solid fa-inbox" style="font-size: 3rem; color: var(--text-tertiary); margin-bottom: 1rem; display: block;"></i>
                    <p style="color: var(--text-secondary);">Nenhum produto encontrado</p>
                </td>
            </tr>
        `;
        return;
    }
    
    tbody.innerHTML = produtos.map(produto => {
        const statusClass = produto.status_classe || 'normal';
        const categoriaSlug = produto.categoria.toLowerCase()
            .replace(/\s+/g, '-')
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace('á', 'a').replace('é', 'e').replace('í', 'i')
            .replace('ó', 'o').replace('ú', 'u').replace('ç', 'c');
        
        return `
            <tr>
                <td>
                    <div class="product-info">
                        <div class="product-name">${produto.designacao}</div>
                        <div class="product-code">${produto.num_lote}</div>
                    </div>
                </td>
                <td><span class="category-badge ${categoriaSlug}">${produto.categoria}</span></td>
                <td><strong>${produto.quantidade}</strong> unidades</td>
                <td>${produto.nivel_minimo} unidades</td>
                <td><span class="status-badge ${statusClass}">${produto.status_badge}</span></td>
                <td>${produto.validade_formatada}</td>
                <td><code>${produto.num_lote}</code></td>
                <td>
                    <div class="action-buttons">
                        <button class="btn-action" title="Ver detalhes" onclick="verDetalhes(${produto.id})">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button class="btn-action ${statusClass === 'critical' ? 'danger' : ''}" title="${statusClass === 'critical' ? 'Solicitar' : 'Dispensar'}" onclick="dispensar(${produto.id})">
                            <i class="fa-solid fa-${statusClass === 'critical' ? 'bell' : 'hand-holding-medical'}"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `;
    }).join('');
}

// ==================== ATUALIZAR PAGINAÇÃO ====================
function atualizarPaginacao(pagination) {
    const info = document.querySelector('.pagination-info');
    const controls = document.querySelector('.pagination-controls');
    
    const from = pagination.from || 0;
    const to = pagination.to || 0;
    const total = pagination.total || 0;
    
    info.textContent = `Mostrando ${from}-${to} de ${total} resultados`;
    
    const currentPage = pagination.current_page;
    const lastPage = pagination.last_page;
    
    let buttonsHTML = `
        <button class="pagination-btn" onclick="carregarProdutos(${currentPage - 1})" ${currentPage === 1 ? 'disabled' : ''}>
            Anterior
        </button>
    `;
    
    // Primeira página
    if (currentPage > 2) {
        buttonsHTML += `<button class="pagination-btn" onclick="carregarProdutos(1)">1</button>`;
        if (currentPage > 3) {
            buttonsHTML += `<span class="pagination-dots">...</span>`;
        }
    }
    
    // Páginas ao redor da atual
    for (let i = Math.max(1, currentPage - 1); i <= Math.min(lastPage, currentPage + 1); i++) {
        buttonsHTML += `
            <button class="pagination-btn ${i === currentPage ? 'active' : ''}" 
                    onclick="carregarProdutos(${i})">
                ${i}
            </button>
        `;
    }
    
    // Última página
    if (currentPage < lastPage - 1) {
        if (currentPage < lastPage - 2) {
            buttonsHTML += `<span class="pagination-dots">...</span>`;
        }
        buttonsHTML += `<button class="pagination-btn" onclick="carregarProdutos(${lastPage})">${lastPage}</button>`;
    }
    
    buttonsHTML += `
        <button class="pagination-btn" onclick="carregarProdutos(${currentPage + 1})" ${currentPage === lastPage ? 'disabled' : ''}>
            Próximo
        </button>
    `;
    
    controls.innerHTML = buttonsHTML;
}

// ==================== ATUALIZAR RESUMO ====================
function atualizarResumo(resumo) {
    if (!resumo) return;
    
    const cards = document.querySelectorAll('.summary-card');
    if (cards.length >= 4) {
        cards[0].querySelector('.summary-value').textContent = resumo.total || 0;
        cards[1].querySelector('.summary-value').textContent = resumo.adequado || 0;
        cards[2].querySelector('.summary-value').textContent = resumo.minimo || 0;
        cards[3].querySelector('.summary-value').textContent = resumo.critico || 0;
    }
}

// ==================== AÇÕES DOS BOTÕES ====================
function verDetalhes(id) {
    window.location.href = `{{ url('diretor/estoque') }}/${id}`;
}

function dispensar(id) {
    showToast('Funcionalidade de dispensação em desenvolvimento', 'info');
}

// ==================== EVENT LISTENERS ====================
document.addEventListener('DOMContentLoaded', function() {
    // Carregar dados iniciais
    carregarCategorias();
    carregarStatusOpcoes();
    carregarProdutos(1);
    
    // Filtros
    document.getElementById('categoria').addEventListener('change', () => carregarProdutos(1));
    document.getElementById('status').addEventListener('change', () => carregarProdutos(1));
    document.getElementById('validade').addEventListener('change', () => carregarProdutos(1));
    
    // Busca com debounce
    document.getElementById('busca').addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            carregarProdutos(1);
        }, 500); // 500ms de delay
    });
});
</script>
@endpush