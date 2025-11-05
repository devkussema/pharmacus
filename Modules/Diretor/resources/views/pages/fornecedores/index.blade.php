@extends('diretor::layout.app')

@section('title', 'Fornecedores')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Gestão de Fornecedores</h1>
        <p>Controle e relacionamento com parceiros comerciais</p>
    </div>
    <div class="page-actions">
        <button class="btn-modern btn-primary">
            <i class="fa-solid fa-plus me-2"></i>
            Novo Fornecedor
        </button>
    </div>
</div>

<div class="page-content">
    <!-- Métricas dos Fornecedores -->
    <div class="supplier-metrics">
        <div class="metric-card">
            <div class="metric-icon active">
                <i class="fa-solid fa-handshake"></i>
            </div>
            <div class="metric-content">
                <div class="metric-value">47</div>
                <div class="metric-label">Fornecedores Ativos</div>
            </div>
        </div>
        
        <div class="metric-card">
            <div class="metric-icon pending">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div class="metric-content">
                <div class="metric-value">8</div>
                <div class="metric-label">Pedidos Pendentes</div>
            </div>
        </div>
        
        <div class="metric-card">
            <div class="metric-icon revenue">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div class="metric-content">
                <div class="metric-value">Kz 2.4M</div>
                <div class="metric-label">Valor Total Mensal</div>
            </div>
        </div>
        
        <div class="metric-card">
            <div class="metric-icon rating">
                <i class="fa-solid fa-star"></i>
            </div>
            <div class="metric-content">
                <div class="metric-value">4.7</div>
                <div class="metric-label">Avaliação Média</div>
            </div>
        </div>
    </div>

    <!-- Lista de Fornecedores -->
    <div class="suppliers-grid">
        <div class="supplier-card">
            <div class="supplier-header">
                <div class="supplier-avatar">
                    <img src="https://ui-avatars.com/api/?name=MedSupply&background=2563eb&color=fff&size=64" alt="MedSupply">
                </div>
                <div class="supplier-info">
                    <h3>MedSupply Angola</h3>
                    <p>Fornecedor Premium</p>
                    <div class="supplier-rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span>5.0</span>
                    </div>
                </div>
                <div class="supplier-status active">Ativo</div>
            </div>
            
            <div class="supplier-details">
                <div class="detail-row">
                    <span class="detail-label">Contacto:</span>
                    <span class="detail-value">+244 923 456 789</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">comercial@medsupply.ao</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Especialidade:</span>
                    <span class="detail-value">Medicamentos Gerais</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Última Entrega:</span>
                    <span class="detail-value">Há 2 dias</span>
                </div>
            </div>
            
            <div class="supplier-stats">
                <div class="stat-item">
                    <div class="stat-value">142</div>
                    <div class="stat-label">Produtos</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">Kz 840K</div>
                    <div class="stat-label">Este Mês</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">98%</div>
                    <div class="stat-label">Pontualidade</div>
                </div>
            </div>
            
            <div class="supplier-actions">
                <button class="btn-action primary">
                    <i class="fa-solid fa-eye"></i>
                    Ver Detalhes
                </button>
                <button class="btn-action secondary">
                    <i class="fa-solid fa-shopping-cart"></i>
                    Novo Pedido
                </button>
                <button class="btn-action secondary">
                    <i class="fa-solid fa-message"></i>
                    Contactar
                </button>
            </div>
        </div>

        <div class="supplier-card">
            <div class="supplier-header">
                <div class="supplier-avatar">
                    <img src="https://ui-avatars.com/api/?name=PharmaDistrib&background=059669&color=fff&size=64" alt="PharmaDistrib">
                </div>
                <div class="supplier-info">
                    <h3>PharmaDistrib Lda</h3>
                    <p>Fornecedor Padrão</p>
                    <div class="supplier-rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <span>4.2</span>
                    </div>
                </div>
                <div class="supplier-status active">Ativo</div>
            </div>
            
            <div class="supplier-details">
                <div class="detail-row">
                    <span class="detail-label">Contacto:</span>
                    <span class="detail-value">+244 912 345 678</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">vendas@pharmadistrib.ao</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Especialidade:</span>
                    <span class="detail-value">Antibióticos & Vitaminas</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Última Entrega:</span>
                    <span class="detail-value">Há 1 semana</span>
                </div>
            </div>
            
            <div class="supplier-stats">
                <div class="stat-item">
                    <div class="stat-value">89</div>
                    <div class="stat-label">Produtos</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">Kz 520K</div>
                    <div class="stat-label">Este Mês</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">85%</div>
                    <div class="stat-label">Pontualidade</div>
                </div>
            </div>
            
            <div class="supplier-actions">
                <button class="btn-action primary">
                    <i class="fa-solid fa-eye"></i>
                    Ver Detalhes
                </button>
                <button class="btn-action secondary">
                    <i class="fa-solid fa-shopping-cart"></i>
                    Novo Pedido
                </button>
                <button class="btn-action secondary">
                    <i class="fa-solid fa-message"></i>
                    Contactar
                </button>
            </div>
        </div>

        <div class="supplier-card">
            <div class="supplier-header">
                <div class="supplier-avatar">
                    <img src="https://ui-avatars.com/api/?name=HealthCorp&background=dc2626&color=fff&size=64" alt="HealthCorp">
                </div>
                <div class="supplier-info">
                    <h3>HealthCorp Solutions</h3>
                    <p>Fornecedor Novo</p>
                    <div class="supplier-rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                        <span>3.8</span>
                    </div>
                </div>
                <div class="supplier-status pending">Pendente</div>
            </div>
            
            <div class="supplier-details">
                <div class="detail-row">
                    <span class="detail-label">Contacto:</span>
                    <span class="detail-value">+244 934 567 890</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">info@healthcorp.ao</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Especialidade:</span>
                    <span class="detail-value">Equipamentos Médicos</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Cadastro:</span>
                    <span class="detail-value">Há 3 dias</span>
                </div>
            </div>
            
            <div class="supplier-stats">
                <div class="stat-item">
                    <div class="stat-value">45</div>
                    <div class="stat-label">Produtos</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">Kz 0</div>
                    <div class="stat-label">Este Mês</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">-</div>
                    <div class="stat-label">Pontualidade</div>
                </div>
            </div>
            
            <div class="supplier-actions">
                <button class="btn-action primary">
                    <i class="fa-solid fa-check"></i>
                    Aprovar
                </button>
                <button class="btn-action secondary">
                    <i class="fa-solid fa-eye"></i>
                    Avaliar
                </button>
                <button class="btn-action danger">
                    <i class="fa-solid fa-times"></i>
                    Rejeitar
                </button>
            </div>
        </div>
    </div>

    <!-- Seção de Análise -->
    <div class="analysis-section">
        <div class="analysis-card">
            <div class="analysis-header">
                <h3>Performance dos Fornecedores</h3>
                <select class="period-select">
                    <option>Últimos 30 dias</option>
                    <option>Últimos 90 dias</option>
                    <option>Este ano</option>
                </select>
            </div>
            <div class="analysis-content">
                <div class="performance-chart">
                    <i class="fa-solid fa-chart-bar fa-3x"></i>
                    <p>Gráfico de performance será implementado aqui</p>
                </div>
            </div>
        </div>
        
        <div class="analysis-card">
            <div class="analysis-header">
                <h3>Top Fornecedores do Mês</h3>
            </div>
            <div class="analysis-content">
                <div class="top-suppliers">
                    <div class="top-supplier-item">
                        <div class="rank">1</div>
                        <div class="supplier-mini">
                            <img src="https://ui-avatars.com/api/?name=MedSupply&background=2563eb&color=fff&size=32" alt="MedSupply">
                            <span>MedSupply Angola</span>
                        </div>
                        <div class="value">Kz 840K</div>
                    </div>
                    
                    <div class="top-supplier-item">
                        <div class="rank">2</div>
                        <div class="supplier-mini">
                            <img src="https://ui-avatars.com/api/?name=PharmaDistrib&background=059669&color=fff&size=32" alt="PharmaDistrib">
                            <span>PharmaDistrib Lda</span>
                        </div>
                        <div class="value">Kz 520K</div>
                    </div>
                    
                    <div class="top-supplier-item">
                        <div class="rank">3</div>
                        <div class="supplier-mini">
                            <img src="https://ui-avatars.com/api/?name=HealthPlus&background=7c3aed&color=fff&size=32" alt="HealthPlus">
                            <span>HealthPlus Sarl</span>
                        </div>
                        <div class="value">Kz 380K</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.supplier-metrics {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.metric-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
}

.metric-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.metric-icon.active { background: var(--success); }
.metric-icon.pending { background: var(--warning); }
.metric-icon.revenue { background: var(--primary); }
.metric-icon.rating { background: #f59e0b; }

.metric-value {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1;
}

.metric-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-top: 0.25rem;
}

.suppliers-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.supplier-card {
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
    padding: 1.5rem;
    transition: all var(--transition-normal);
}

.supplier-card:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-2px);
}

.supplier-header {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.supplier-avatar img {
    width: 64px;
    height: 64px;
    border-radius: var(--border-radius-sm);
    border: 2px solid var(--border-primary);
}

.supplier-info {
    flex: 1;
}

.supplier-info h3 {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 0.25rem;
}

.supplier-info p {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0 0 0.5rem;
}

.supplier-rating {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    color: #f59e0b;
    font-size: 0.875rem;
}

.supplier-rating span {
    color: var(--text-secondary);
    margin-left: 0.5rem;
    font-weight: 600;
}

.supplier-status {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.supplier-status.active {
    background: rgba(34, 197, 94, 0.1);
    color: var(--success);
}

.supplier-status.pending {
    background: rgba(245, 158, 11, 0.1);
    color: var(--warning);
}

.supplier-details {
    margin-bottom: 1.5rem;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
    border-bottom: 1px solid var(--border-primary);
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
    font-weight: 500;
}

.detail-value {
    font-size: 0.875rem;
    color: var(--text-primary);
    font-weight: 600;
}

.supplier-stats {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1.5rem;
    padding: 1rem;
    background: var(--bg-secondary);
    border-radius: var(--border-radius-sm);
}

.stat-item {
    text-align: center;
}

.stat-item .stat-value {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1;
}

.stat-item .stat-label {
    font-size: 0.75rem;
    color: var(--text-tertiary);
    margin-top: 0.25rem;
    text-transform: uppercase;
}

.supplier-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.btn-action {
    flex: 1;
    min-width: 120px;
    padding: 0.75rem 1rem;
    border: none;
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all var(--transition-fast);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-action.primary {
    background: var(--primary);
    color: white;
}

.btn-action.primary:hover {
    background: var(--primary-hover);
}

.btn-action.secondary {
    background: var(--bg-secondary);
    color: var(--text-secondary);
    border: 1px solid var(--border-primary);
}

.btn-action.secondary:hover {
    background: var(--surface-hover);
    color: var(--text-primary);
}

.btn-action.danger {
    background: rgba(239, 68, 68, 0.1);
    color: var(--danger);
    border: 1px solid rgba(239, 68, 68, 0.2);
}

.btn-action.danger:hover {
    background: var(--danger);
    color: white;
}

.analysis-section {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 1.5rem;
}

.analysis-card {
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
    overflow: hidden;
}

.analysis-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border-bottom: 1px solid var(--border-primary);
}

.analysis-header h3 {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
}

.analysis-content {
    padding: 1.5rem;
}

.performance-chart {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 200px;
    color: var(--text-tertiary);
    text-align: center;
}

.performance-chart i {
    margin-bottom: 1rem;
    opacity: 0.5;
}

.top-suppliers {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.top-supplier-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.75rem;
    background: var(--bg-secondary);
    border-radius: var(--border-radius-sm);
}

.rank {
    width: 24px;
    height: 24px;
    background: var(--primary);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 700;
}

.supplier-mini {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.supplier-mini img {
    width: 32px;
    height: 32px;
    border-radius: 50%;
}

.supplier-mini span {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--text-primary);
}

.value {
    font-size: 0.875rem;
    font-weight: 700;
    color: var(--text-primary);
}

@media (max-width: 1024px) {
    .analysis-section {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .suppliers-grid {
        grid-template-columns: 1fr;
    }
    
    .supplier-metrics {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .supplier-actions {
        flex-direction: column;
    }
    
    .btn-action {
        min-width: auto;
    }
}
</style>
@endpush