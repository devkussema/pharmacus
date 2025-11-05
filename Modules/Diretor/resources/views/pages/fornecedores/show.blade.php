@extends('diretor::layout.app')

@section('title', 'Detalhes do Fornecedor')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Perfil do Fornecedor</h1>
        <p>Informações detalhadas e histórico</p>
    </div>
    <div class="page-actions">
        <a href="{{ route('diretor.fornecedores.index') }}" class="btn-secondary">
            <i class="fa-solid fa-arrow-left me-2"></i>
            Voltar
        </a>
        <a href="{{ route('diretor.fornecedores.edit', $id) }}" class="btn-modern btn-primary">
            <i class="fa-solid fa-edit me-2"></i>
            Editar
        </a>
    </div>
</div>

<div class="page-content">
    <div class="supplier-profile-grid">
        <div class="profile-main">
            <div class="profile-card">
                <div class="profile-header">
                    <div class="profile-avatar">
                        <img src="https://ui-avatars.com/api/?name=PharmaCorp+International&size=80&background=2563eb&color=fff&bold=true" alt="PharmaCorp International">
                    </div>
                    <div class="profile-info">
                        <h2>PharmaCorp International</h2>
                        <p>Fornecedor Premium</p>
                    </div>
                    <div class="profile-rating">
                        <div class="rating-stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                        <span>4.8/5.0</span>
                    </div>
                </div>
                
                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-icon success">
                            <i class="fa-solid fa-box"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">156</div>
                            <div class="stat-label">Produtos Fornecidos</div>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon primary">
                            <i class="fa-solid fa-shopping-cart"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">243</div>
                            <div class="stat-label">Encomendas Totais</div>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon warning">
                            <i class="fa-solid fa-dollar-sign"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">Kz 8.5M</div>
                            <div class="stat-label">Volume Total</div>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon info">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div class="stat-content">
                            <div class="stat-value">98%</div>
                            <div class="stat-label">Taxa de Entrega</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="info-card">
                <div class="info-header">
                    <h3>Informações de Contacto</h3>
                </div>
                <div class="info-body">
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Email</div>
                            <div class="info-value">contato@pharmacorp.com</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Telefone</div>
                            <div class="info-value">+244 923 456 789</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Endereço</div>
                            <div class="info-value">Rua da Missão, Luanda, Angola</div>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon">
                            <i class="fa-solid fa-globe"></i>
                        </div>
                        <div class="info-content">
                            <div class="info-label">Website</div>
                            <div class="info-value"><a href="https://pharmacorp.com" target="_blank">www.pharmacorp.com</a></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="info-card">
                <div class="info-header">
                    <h3>Produtos Principais</h3>
                </div>
                <div class="info-body">
                    <div class="products-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Categoria</th>
                                    <th>Última Compra</th>
                                    <th>Preço</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Paracetamol 500mg</td>
                                    <td><span class="badge cat-1">Analgésicos</span></td>
                                    <td>Há 2 dias</td>
                                    <td>Kz 1.200</td>
                                </tr>
                                <tr>
                                    <td>Amoxicilina 500mg</td>
                                    <td><span class="badge cat-2">Antibióticos</span></td>
                                    <td>Há 5 dias</td>
                                    <td>Kz 2.500</td>
                                </tr>
                                <tr>
                                    <td>Ibuprofeno 400mg</td>
                                    <td><span class="badge cat-1">Analgésicos</span></td>
                                    <td>Há 1 semana</td>
                                    <td>Kz 1.800</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="info-card">
                <div class="info-header">
                    <h3>Histórico de Encomendas</h3>
                </div>
                <div class="info-body">
                    <div class="orders-timeline">
                        <div class="order-item">
                            <div class="order-icon delivered">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="order-content">
                                <div class="order-title">Encomenda #1243 - Entregue</div>
                                <div class="order-desc">15 itens, Kz 156.000</div>
                                <div class="order-date">15 Mar 2025</div>
                            </div>
                        </div>
                        <div class="order-item">
                            <div class="order-icon delivered">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="order-content">
                                <div class="order-title">Encomenda #1189 - Entregue</div>
                                <div class="order-desc">8 itens, Kz 89.500</div>
                                <div class="order-date">02 Mar 2025</div>
                            </div>
                        </div>
                        <div class="order-item">
                            <div class="order-icon pending">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div class="order-content">
                                <div class="order-title">Encomenda #1067 - Pendente</div>
                                <div class="order-desc">22 itens, Kz 234.000</div>
                                <div class="order-date">18 Fev 2025</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="profile-sidebar">
            <div class="info-card">
                <div class="info-header">
                    <h3>Detalhes da Conta</h3>
                </div>
                <div class="info-body">
                    <div class="detail-item">
                        <span class="label">ID Fornecedor:</span>
                        <span class="value">#F-{{ $id }}</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Membro Desde:</span>
                        <span class="value">Jan 2023</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Status:</span>
                        <span class="value"><span class="status-badge active">Ativo</span></span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Prazo de Pagamento:</span>
                        <span class="value">30 dias</span>
                    </div>
                </div>
            </div>
            
            <div class="info-card">
                <div class="info-header">
                    <h3>Performance</h3>
                </div>
                <div class="info-body">
                    <div class="performance-item">
                        <div class="perf-label">Tempo Médio de Entrega</div>
                        <div class="perf-bar">
                            <div class="perf-fill" style="width: 85%"></div>
                        </div>
                        <div class="perf-value">3-5 dias</div>
                    </div>
                    <div class="performance-item">
                        <div class="perf-label">Qualidade dos Produtos</div>
                        <div class="perf-bar">
                            <div class="perf-fill" style="width: 96%"></div>
                        </div>
                        <div class="perf-value">96%</div>
                    </div>
                    <div class="performance-item">
                        <div class="perf-label">Cumprimento de Prazos</div>
                        <div class="perf-bar">
                            <div class="perf-fill" style="width: 92%"></div>
                        </div>
                        <div class="perf-value">92%</div>
                    </div>
                </div>
            </div>
            
            <div class="info-card">
                <div class="info-header">
                    <h3>Ações Rápidas</h3>
                </div>
                <div class="info-body">
                    <div class="quick-actions">
                        <button class="action-btn full primary">
                            <i class="fa-solid fa-shopping-cart"></i>
                            Nova Encomenda
                        </button>
                        <button class="action-btn full">
                            <i class="fa-solid fa-file-invoice"></i>
                            Ver Faturas
                        </button>
                        <button class="action-btn full">
                            <i class="fa-solid fa-comment"></i>
                            Enviar Mensagem
                        </button>
                        <button class="action-btn full">
                            <i class="fa-solid fa-chart-line"></i>
                            Relatório Completo
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.supplier-profile-grid {
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: 1.5rem;
}

.profile-card {
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
    overflow: hidden;
    margin-bottom: 1.5rem;
}

.profile-header {
    padding: 2rem;
    background: linear-gradient(135deg, var(--primary) 0%, #1e40af 100%);
    color: white;
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.profile-avatar img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 3px solid rgba(255,255,255,0.2);
}

.profile-info h2 {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0 0 0.25rem 0;
}

.profile-info p {
    margin: 0;
    opacity: 0.9;
}

.profile-rating {
    margin-left: auto;
    text-align: center;
}

.rating-stars {
    color: #fbbf24;
    font-size: 1.125rem;
    margin-bottom: 0.25rem;
}

.rating-stars i {
    margin: 0 1px;
}

.profile-rating span {
    font-size: 0.875rem;
    opacity: 0.9;
}

.profile-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    padding: 1.5rem;
    gap: 1.5rem;
}

.stat-item {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.stat-icon.success { background: var(--success); }
.stat-icon.primary { background: var(--primary); }
.stat-icon.warning { background: var(--warning); }
.stat-icon.info { background: #3b82f6; }

.stat-value {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1;
}

.stat-label {
    font-size: 0.75rem;
    color: var(--text-secondary);
    margin-top: 0.25rem;
}

.info-card {
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
    margin-bottom: 1.5rem;
    overflow: hidden;
}

.info-header {
    padding: 1.25rem 1.5rem;
    border-bottom: 1px solid var(--border-primary);
}

.info-header h3 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
}

.info-body {
    padding: 1.5rem;
}

.info-item {
    display: flex;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid var(--border-primary);
}

.info-item:last-child {
    border-bottom: none;
}

.info-icon {
    width: 40px;
    height: 40px;
    border-radius: var(--border-radius-sm);
    background: var(--bg-secondary);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    flex-shrink: 0;
}

.info-label {
    font-size: 0.75rem;
    color: var(--text-secondary);
    margin-bottom: 0.25rem;
}

.info-value {
    font-size: 0.875rem;
    color: var(--text-primary);
    font-weight: 500;
}

.info-value a {
    color: var(--primary);
    text-decoration: none;
}

.info-value a:hover {
    text-decoration: underline;
}

.products-table table {
    width: 100%;
    border-collapse: collapse;
}

.products-table th {
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--text-secondary);
    text-align: left;
    padding: 0.75rem;
    border-bottom: 1px solid var(--border-primary);
}

.products-table td {
    font-size: 0.875rem;
    color: var(--text-primary);
    padding: 0.875rem 0.75rem;
    border-bottom: 1px solid var(--border-primary);
}

.badge {
    padding: 0.25rem 0.625rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 500;
}

.badge.cat-1 {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success);
}

.badge.cat-2 {
    background: rgba(37, 99, 235, 0.1);
    color: var(--primary);
}

.orders-timeline {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.order-item {
    display: flex;
    gap: 1rem;
}

.order-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.order-icon.delivered { background: var(--success); }
.order-icon.pending { background: var(--warning); }

.order-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
}

.order-desc {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-top: 0.25rem;
}

.order-date {
    font-size: 0.75rem;
    color: var(--text-tertiary);
    margin-top: 0.25rem;
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
}

.detail-item .value {
    font-size: 0.875rem;
    color: var(--text-primary);
    font-weight: 600;
}

.status-badge.active {
    padding: 0.25rem 0.625rem;
    background: rgba(16, 185, 129, 0.1);
    color: var(--success);
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 500;
}

.performance-item {
    margin-bottom: 1.25rem;
}

.performance-item:last-child {
    margin-bottom: 0;
}

.perf-label {
    font-size: 0.75rem;
    color: var(--text-secondary);
    margin-bottom: 0.5rem;
}

.perf-bar {
    height: 8px;
    background: var(--bg-secondary);
    border-radius: 999px;
    overflow: hidden;
    margin-bottom: 0.5rem;
}

.perf-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--primary), #3b82f6);
    border-radius: 999px;
    transition: width var(--transition-base);
}

.perf-value {
    font-size: 0.875rem;
    color: var(--text-primary);
    font-weight: 600;
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

.action-btn.full.primary {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

.action-btn.full.primary:hover {
    background: #1e40af;
}

@media (max-width: 1024px) {
    .supplier-profile-grid {
        grid-template-columns: 1fr;
    }
    
    .profile-header {
        flex-direction: column;
        text-align: center;
    }
    
    .profile-rating {
        margin-left: 0;
    }
    
    .profile-stats {
        grid-template-columns: repeat(2, 1fr);
    }
}
</style>
@endpush
@endsection