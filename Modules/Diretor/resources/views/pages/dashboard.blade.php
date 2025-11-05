@extends('diretor::layout.app')

@section('title', 'Dashboard')

@section('content')
<div class="dashboard">
    <div class="dashboard-header">
        <div class="dashboard-title">
            <h1>Dashboard Executivo</h1>
            <p>Visão geral completa da sua farmácia em tempo real</p>
        </div>
        <div class="dashboard-actions">
            <button class="btn-modern btn-primary">
                <i class="fa-solid fa-download me-2"></i>
                Exportar Relatório
            </button>
        </div>
    </div>

    <!-- KPIs Principais -->
    <div class="stats-grid">
        <div class="stat-card revenue">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fa-solid fa-money-bill-trend-up"></i>
                </div>
                <div class="stat-menu">
                    <button class="stat-menu-btn">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>
                </div>
            </div>
            <div class="stat-content">
                <div class="stat-value">
                    <span class="currency">Kz</span>
                    <span class="amount">245.890</span>
                </div>
                <div class="stat-label">Receita Hoje</div>
                <div class="stat-change positive">
                    <i class="fa-solid fa-arrow-up"></i>
                    <span>+12.5%</span>
                    <small>vs ontem</small>
                </div>
            </div>
        </div>

        <div class="stat-card orders">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <div class="stat-menu">
                    <button class="stat-menu-btn">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>
                </div>
            </div>
            <div class="stat-content">
                <div class="stat-value">
                    <span class="amount">156</span>
                </div>
                <div class="stat-label">Vendas Hoje</div>
                <div class="stat-change positive">
                    <i class="fa-solid fa-arrow-up"></i>
                    <span>+8.2%</span>
                    <small>vs média semanal</small>
                </div>
            </div>
        </div>

        <div class="stat-card inventory">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </div>
                <div class="stat-menu">
                    <button class="stat-menu-btn">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>
                </div>
            </div>
            <div class="stat-content">
                <div class="stat-value">
                    <span class="amount">23</span>
                </div>
                <div class="stat-label">Stock Crítico</div>
                <div class="stat-change negative">
                    <i class="fa-solid fa-exclamation-triangle"></i>
                    <span>Atenção</span>
                    <small>requer ação</small>
                </div>
            </div>
        </div>

        <div class="stat-card customers">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="stat-menu">
                    <button class="stat-menu-btn">
                        <i class="fa-solid fa-ellipsis"></i>
                    </button>
                </div>
            </div>
            <div class="stat-content">
                <div class="stat-value">
                    <span class="amount">1.247</span>
                </div>
                <div class="stat-label">Clientes Ativos</div>
                <div class="stat-change positive">
                    <i class="fa-solid fa-arrow-up"></i>
                    <span>+5.8%</span>
                    <small>este mês</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos e Análises -->
    <div class="analytics-grid">
        <div class="analytics-card chart-card">
            <div class="card-header">
                <h3>Vendas dos Últimos 7 Dias</h3>
                <div class="card-actions">
                    <select class="period-select">
                        <option>7 dias</option>
                        <option>30 dias</option>
                        <option>90 dias</option>
                    </select>
                </div>
            </div>
            <div class="card-content">
                <div class="chart-placeholder">
                    <i class="fa-solid fa-chart-line fa-3x"></i>
                    <p>Gráfico de vendas será implementado aqui</p>
                </div>
            </div>
        </div>

        <div class="analytics-card activity-card">
            <div class="card-header">
                <h3>Atividade Recente</h3>
                <a href="#" class="view-all">Ver todas</a>
            </div>
            <div class="card-content">
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon success">
                            <i class="fa-solid fa-check"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Venda realizada - Fatura #2847</div>
                            <div class="activity-meta">Paracetamol 500mg • Há 2 minutos</div>
                        </div>
                        <div class="activity-value">Kz 2.500</div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon warning">
                            <i class="fa-solid fa-exclamation"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Stock baixo detectado</div>
                            <div class="activity-meta">Ibuprofeno 400mg • Há 15 minutos</div>
                        </div>
                        <div class="activity-badge">Crítico</div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon primary">
                            <i class="fa-solid fa-truck"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Entrega recebida</div>
                            <div class="activity-meta">Fornecedor MedSupply • Há 1 hora</div>
                        </div>
                        <div class="activity-value">245 itens</div>
                    </div>
                    
                    <div class="activity-item">
                        <div class="activity-icon info">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>
                        <div class="activity-content">
                            <div class="activity-title">Novo cliente registado</div>
                            <div class="activity-meta">Maria Silva • Há 2 horas</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Produtos e Insights -->
    <div class="insights-grid">
        <div class="insight-card top-products">
            <div class="card-header">
                <h3>Top Produtos</h3>
                <span class="period-badge">Hoje</span>
            </div>
            <div class="card-content">
                <div class="products-list">
                    <div class="product-item">
                        <div class="product-info">
                            <div class="product-name">Paracetamol 500mg</div>
                            <div class="product-category">Analgésico</div>
                        </div>
                        <div class="product-sales">
                            <div class="sales-count">45 vendas</div>
                            <div class="sales-value">Kz 67.500</div>
                        </div>
                    </div>
                    
                    <div class="product-item">
                        <div class="product-info">
                            <div class="product-name">Amoxicilina 875mg</div>
                            <div class="product-category">Antibiótico</div>
                        </div>
                        <div class="product-sales">
                            <div class="sales-count">32 vendas</div>
                            <div class="sales-value">Kz 128.000</div>
                        </div>
                    </div>
                    
                    <div class="product-item">
                        <div class="product-info">
                            <div class="product-name">Ibuprofeno 400mg</div>
                            <div class="product-category">Anti-inflamatório</div>
                        </div>
                        <div class="product-sales">
                            <div class="sales-count">28 vendas</div>
                            <div class="sales-value">Kz 42.000</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="insight-card alerts-card">
            <div class="card-header">
                <h3>Alertas Importantes</h3>
                <div class="alerts-count">3 alertas</div>
            </div>
            <div class="card-content">
                <div class="alerts-list">
                    <div class="alert-item critical">
                        <div class="alert-icon">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <div class="alert-content">
                            <div class="alert-title">Stock crítico</div>
                            <div class="alert-message">23 produtos abaixo do limite mínimo</div>
                        </div>
                        <button class="alert-action">Reabastecer</button>
                    </div>
                    
                    <div class="alert-item warning">
                        <div class="alert-icon">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div class="alert-content">
                            <div class="alert-title">Produtos a expirar</div>
                            <div class="alert-message">12 produtos expiram em 30 dias</div>
                        </div>
                        <button class="alert-action">Verificar</button>
                    </div>
                    
                    <div class="alert-item info">
                        <div class="alert-icon">
                            <i class="fa-solid fa-info-circle"></i>
                        </div>
                        <div class="alert-content">
                            <div class="alert-title">Relatório mensal</div>
                            <div class="alert-message">Relatório de outubro disponível</div>
                        </div>
                        <button class="alert-action">Visualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.dashboard {
    max-width: 1400px;
    margin: 0 auto;
}

.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 2rem;
}

.dashboard-title h1 {
    font-size: 2rem;
    font-weight: 800;
    color: var(--text-primary);
    margin: 0 0 0.5rem;
}

.dashboard-title p {
    color: var(--text-secondary);
    margin: 0;
    font-size: 1rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
    padding: 1.5rem;
    transition: all var(--transition-normal);
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
}

.stat-card.revenue::before { background: linear-gradient(90deg, #10b981, #059669); }
.stat-card.orders::before { background: linear-gradient(90deg, #3b82f6, #2563eb); }
.stat-card.inventory::before { background: linear-gradient(90deg, #f59e0b, #d97706); }
.stat-card.customers::before { background: linear-gradient(90deg, #8b5cf6, #7c3aed); }

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-xl);
}

.stat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: white;
}

.revenue .stat-icon { background: linear-gradient(135deg, #10b981, #059669); }
.orders .stat-icon { background: linear-gradient(135deg, #3b82f6, #2563eb); }
.inventory .stat-icon { background: linear-gradient(135deg, #f59e0b, #d97706); }
.customers .stat-icon { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }

.stat-menu-btn {
    background: none;
    border: none;
    color: var(--text-tertiary);
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 4px;
    transition: all var(--transition-fast);
}

.stat-menu-btn:hover {
    background: var(--surface-hover);
    color: var(--text-secondary);
}

.stat-value {
    display: flex;
    align-items: baseline;
    gap: 0.25rem;
    margin-bottom: 0.5rem;
}

.stat-value .currency {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-secondary);
}

.stat-value .amount {
    font-size: 2.25rem;
    font-weight: 800;
    color: var(--text-primary);
    line-height: 1;
}

.stat-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
    font-weight: 500;
    margin-bottom: 0.75rem;
}

.stat-change {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    font-size: 0.75rem;
    font-weight: 600;
}

.stat-change.positive {
    color: var(--success);
}

.stat-change.negative {
    color: var(--warning);
}

.stat-change small {
    color: var(--text-tertiary);
    font-weight: 400;
}

.analytics-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.analytics-card {
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
    overflow: hidden;
}

.card-header {
    padding: 1.5rem;
    border-bottom: 1px solid var(--border-primary);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-header h3 {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
}

.period-select {
    background: var(--bg-secondary);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    color: var(--text-primary);
}

.view-all {
    color: var(--primary);
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
}

.card-content {
    padding: 1.5rem;
}

.chart-placeholder {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 300px;
    color: var(--text-tertiary);
    text-align: center;
}

.chart-placeholder i {
    margin-bottom: 1rem;
    opacity: 0.5;
}

.activity-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border-radius: var(--border-radius-sm);
    background: var(--bg-secondary);
    transition: background var(--transition-fast);
}

.activity-item:hover {
    background: var(--surface-hover);
}

.activity-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.875rem;
    flex-shrink: 0;
}

.activity-icon.success { background: var(--success); }
.activity-icon.warning { background: var(--warning); }
.activity-icon.primary { background: var(--primary); }
.activity-icon.info { background: var(--secondary); }

.activity-content {
    flex: 1;
}

.activity-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
}

.activity-meta {
    font-size: 0.75rem;
    color: var(--text-tertiary);
}

.activity-value {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
}

.activity-badge {
    background: var(--warning);
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.625rem;
    font-weight: 600;
    text-transform: uppercase;
}

.insights-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

.insight-card {
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
    overflow: hidden;
}

.period-badge {
    background: var(--primary);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.products-list, .alerts-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.product-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    border-radius: var(--border-radius-sm);
    background: var(--bg-secondary);
}

.product-name {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
}

.product-category {
    font-size: 0.75rem;
    color: var(--text-tertiary);
}

.product-sales {
    text-align: right;
}

.sales-count {
    font-size: 0.75rem;
    color: var(--text-secondary);
    margin-bottom: 0.25rem;
}

.sales-value {
    font-size: 0.875rem;
    font-weight: 700;
    color: var(--text-primary);
}

.alerts-count {
    background: var(--danger);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.alert-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border-radius: var(--border-radius-sm);
    border: 1px solid var(--border-primary);
}

.alert-item.critical {
    background: rgba(220, 38, 38, 0.05);
    border-color: rgba(220, 38, 38, 0.2);
}

.alert-item.warning {
    background: rgba(217, 119, 6, 0.05);
    border-color: rgba(217, 119, 6, 0.2);
}

.alert-item.info {
    background: rgba(37, 99, 235, 0.05);
    border-color: rgba(37, 99, 235, 0.2);
}

.alert-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.875rem;
    flex-shrink: 0;
}

.alert-item.critical .alert-icon { background: var(--danger); }
.alert-item.warning .alert-icon { background: var(--warning); }
.alert-item.info .alert-icon { background: var(--primary); }

.alert-content {
    flex: 1;
}

.alert-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
}

.alert-message {
    font-size: 0.75rem;
    color: var(--text-secondary);
}

.alert-action {
    background: var(--primary);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: var(--border-radius-sm);
    font-size: 0.75rem;
    font-weight: 600;
    cursor: pointer;
    transition: background var(--transition-fast);
}

.alert-action:hover {
    background: var(--primary-hover);
}

@media (max-width: 1024px) {
    .analytics-grid {
        grid-template-columns: 1fr;
    }
    
    .insights-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    }
}

@media (max-width: 768px) {
    .dashboard-header {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .stat-value .amount {
        font-size: 1.875rem;
    }
}
</style>
@endpush
