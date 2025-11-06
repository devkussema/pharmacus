@extends('diretor::layout.app')

@section('title', 'Alertas Críticos')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Alertas Críticos</h1>
        <p>Monitoramento de situações que requerem atenção imediata</p>
    </div>
    <div class="page-actions">
        <button class="btn-modern btn-secondary">
            <i class="fa-solid fa-bell-slash me-2"></i>
            Marcar Tudo Lido
        </button>
    </div>
</div>

<div class="page-content">
    <!-- Resumo de Alertas -->
    <div class="alerts-summary">
        <div class="summary-card critico">
            <div class="summary-icon">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div class="summary-content">
                <div class="summary-value">12</div>
                <div class="summary-label">Alertas Críticos</div>
            </div>
        </div>

        <div class="summary-card atencao">
            <div class="summary-icon">
                <i class="fa-solid fa-exclamation-circle"></i>
            </div>
            <div class="summary-content">
                <div class="summary-value">28</div>
                <div class="summary-label">Requerem Atenção</div>
            </div>
        </div>

        <div class="summary-card info">
            <div class="summary-icon">
                <i class="fa-solid fa-info-circle"></i>
            </div>
            <div class="summary-content">
                <div class="summary-value">15</div>
                <div class="summary-label">Informativos</div>
            </div>
        </div>
    </div>

    <!-- Filtros -->
    <div class="alert-filters">
        <button class="filter-chip active">Todos (55)</button>
        <button class="filter-chip critical">Críticos (12)</button>
        <button class="filter-chip warning">Atenção (28)</button>
        <button class="filter-chip info">Informativos (15)</button>
    </div>

    <!-- Lista de Alertas -->
    <div class="alerts-list">
        <!-- Alerta Crítico: Estoque -->
        <div class="alert-item critical">
            <div class="alert-icon">
                <i class="fa-solid fa-box-open"></i>
            </div>
            <div class="alert-content">
                <div class="alert-header">
                    <h4>Estoque Crítico - Insulina NPH</h4>
                    <span class="alert-time">Há 5 minutos</span>
                </div>
                <p class="alert-message">
                    Apenas <strong>8 unidades</strong> restantes. Nível mínimo: 50 unidades. 
                    Necessário reposição urgente.
                </p>
                <div class="alert-meta">
                    <span class="meta-item">
                        <i class="fa-solid fa-layer-group"></i>
                        Lote: LT2024-INS-890
                    </span>
                    <span class="meta-item">
                        <i class="fa-solid fa-calendar"></i>
                        Validade: 30/01/2026
                    </span>
                </div>
                <div class="alert-actions">
                    <button class="btn-alert primary">
                        <i class="fa-solid fa-cart-plus"></i>
                        Solicitar Reposição
                    </button>
                    <button class="btn-alert">
                        <i class="fa-solid fa-eye"></i>
                        Ver Detalhes
                    </button>
                </div>
            </div>
            <button class="alert-dismiss" title="Marcar como lido">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Alerta Crítico: Validade -->
        <div class="alert-item critical">
            <div class="alert-icon">
                <i class="fa-solid fa-calendar-xmark"></i>
            </div>
            <div class="alert-content">
                <div class="alert-header">
                    <h4>Medicamentos Vencendo em 7 Dias</h4>
                    <span class="alert-time">Há 15 minutos</span>
                </div>
                <p class="alert-message">
                    <strong>3 medicamentos</strong> com validade próxima precisam de atenção imediata.
                </p>
                <div class="expiring-list">
                    <div class="expiring-item">
                        <span class="med-name">Paracetamol 500mg</span>
                        <span class="med-qty">45 und</span>
                        <span class="med-date">Vence: 13/11/2025</span>
                    </div>
                    <div class="expiring-item">
                        <span class="med-name">Dipirona 500mg</span>
                        <span class="med-qty">32 und</span>
                        <span class="med-date">Vence: 15/11/2025</span>
                    </div>
                    <div class="expiring-item">
                        <span class="med-name">Amoxicilina 500mg</span>
                        <span class="med-qty">28 und</span>
                        <span class="med-date">Vence: 17/11/2025</span>
                    </div>
                </div>
                <div class="alert-actions">
                    <button class="btn-alert primary">
                        <i class="fa-solid fa-recycle"></i>
                        Gerenciar Validades
                    </button>
                </div>
            </div>
            <button class="alert-dismiss" title="Marcar como lido">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Alerta de Atenção: Temperatura -->
        <div class="alert-item warning">
            <div class="alert-icon">
                <i class="fa-solid fa-temperature-high"></i>
            </div>
            <div class="alert-content">
                <div class="alert-header">
                    <h4>Variação de Temperatura - Geladeira 02</h4>
                    <span class="alert-time">Há 1 hora</span>
                </div>
                <p class="alert-message">
                    Temperatura registrada: <strong>9°C</strong> (Ideal: 2-8°C). 
                    Medicamentos termolábeis podem estar comprometidos.
                </p>
                <div class="alert-meta">
                    <span class="meta-item">
                        <i class="fa-solid fa-location-dot"></i>
                        Almoxarifado Central - Sala 3
                    </span>
                    <span class="meta-item">
                        <i class="fa-solid fa-pills"></i>
                        15 medicamentos afetados
                    </span>
                </div>
                <div class="alert-actions">
                    <button class="btn-alert primary">
                        <i class="fa-solid fa-wrench"></i>
                        Chamar Manutenção
                    </button>
                    <button class="btn-alert">
                        <i class="fa-solid fa-list"></i>
                        Ver Medicamentos
                    </button>
                </div>
            </div>
            <button class="alert-dismiss" title="Marcar como lido">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Alerta de Atenção: Fornecedor -->
        <div class="alert-item warning">
            <div class="alert-icon">
                <i class="fa-solid fa-truck-fast"></i>
            </div>
            <div class="alert-content">
                <div class="alert-header">
                    <h4>Atraso na Entrega - PharmaCare Angola</h4>
                    <span class="alert-time">Há 2 horas</span>
                </div>
                <p class="alert-message">
                    Pedido <strong>#PED-2024-0234</strong> com 3 dias de atraso. 
                    Previsto: 03/11/2025 | Atual: 06/11/2025
                </p>
                <div class="alert-meta">
                    <span class="meta-item">
                        <i class="fa-solid fa-box"></i>
                        8 itens no pedido
                    </span>
                    <span class="meta-item">
                        <i class="fa-solid fa-clock"></i>
                        Urgente
                    </span>
                </div>
                <div class="alert-actions">
                    <button class="btn-alert primary">
                        <i class="fa-solid fa-phone"></i>
                        Contatar Fornecedor
                    </button>
                    <button class="btn-alert">
                        <i class="fa-solid fa-file-invoice"></i>
                        Ver Pedido
                    </button>
                </div>
            </div>
            <button class="alert-dismiss" title="Marcar como lido">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Alerta Informativo -->
        <div class="alert-item info">
            <div class="alert-icon">
                <i class="fa-solid fa-box"></i>
            </div>
            <div class="alert-content">
                <div class="alert-header">
                    <h4>Nova Entrada Registrada</h4>
                    <span class="alert-time">Há 3 horas</span>
                </div>
                <p class="alert-message">
                    Entrada de <strong>50 unidades</strong> de Insulina Regular 100UI/ml registrada com sucesso.
                </p>
                <div class="alert-meta">
                    <span class="meta-item">
                        <i class="fa-solid fa-user"></i>
                        Por: Dr. João Silva
                    </span>
                    <span class="meta-item">
                        <i class="fa-solid fa-truck"></i>
                        Fornecedor: MedSupply Lda
                    </span>
                </div>
            </div>
            <button class="alert-dismiss" title="Marcar como lido">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.alerts-summary {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.summary-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem;
    border-radius: var(--border-radius);
    border: 2px solid;
}

.summary-card.critico {
    background: rgba(239, 68, 68, 0.05);
    border-color: #ef4444;
}

.summary-card.atencao {
    background: rgba(245, 158, 11, 0.05);
    border-color: #f59e0b;
}

.summary-card.info {
    background: rgba(59, 130, 246, 0.05);
    border-color: #3b82f6;
}

.summary-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.summary-card.critico .summary-icon {
    background: #ef4444;
    color: white;
}

.summary-card.atencao .summary-icon {
    background: #f59e0b;
    color: white;
}

.summary-card.info .summary-icon {
    background: #3b82f6;
    color: white;
}

.summary-value {
    font-size: 1.75rem;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 0.25rem;
}

.summary-card.critico .summary-value {
    color: #ef4444;
}

.summary-card.atencao .summary-value {
    color: #f59e0b;
}

.summary-card.info .summary-value {
    color: #3b82f6;
}

.summary-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.alert-filters {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.filter-chip {
    padding: 0.5rem 1rem;
    border: 1px solid var(--border-primary);
    border-radius: 20px;
    background: var(--surface);
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all var(--transition-fast);
}

.filter-chip:hover {
    background: var(--surface-hover);
    color: var(--text-primary);
}

.filter-chip.active {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

.filter-chip.critical {
    border-color: #ef4444;
}

.filter-chip.warning {
    border-color: #f59e0b;
}

.filter-chip.info {
    border-color: #3b82f6;
}

.alerts-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.alert-item {
    display: flex;
    gap: 1rem;
    padding: 1.5rem;
    background: var(--surface);
    border: 2px solid;
    border-radius: var(--border-radius);
    position: relative;
}

.alert-item.critical {
    border-color: #ef4444;
    background: rgba(239, 68, 68, 0.03);
}

.alert-item.warning {
    border-color: #f59e0b;
    background: rgba(245, 158, 11, 0.03);
}

.alert-item.info {
    border-color: #3b82f6;
    background: rgba(59, 130, 246, 0.03);
}

.alert-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--border-radius);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: white;
    flex-shrink: 0;
}

.alert-item.critical .alert-icon {
    background: #ef4444;
}

.alert-item.warning .alert-icon {
    background: #f59e0b;
}

.alert-item.info .alert-icon {
    background: #3b82f6;
}

.alert-content {
    flex: 1;
}

.alert-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 0.75rem;
}

.alert-header h4 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
}

.alert-time {
    font-size: 0.75rem;
    color: var(--text-tertiary);
    font-family: 'JetBrains Mono', monospace;
}

.alert-message {
    font-size: 0.9375rem;
    color: var(--text-secondary);
    margin: 0 0 1rem 0;
    line-height: 1.6;
}

.alert-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    margin-bottom: 1rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.meta-item i {
    width: 16px;
    color: var(--text-tertiary);
}

.alert-actions {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.btn-alert {
    padding: 0.5rem 1rem;
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    background: var(--bg-secondary);
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all var(--transition-fast);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-alert:hover {
    background: var(--surface-hover);
    color: var(--text-primary);
    border-color: var(--border-secondary);
}

.btn-alert.primary {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

.btn-alert.primary:hover {
    background: #1d4ed8;
    border-color: #1d4ed8;
}

.alert-dismiss {
    position: absolute;
    top: 1rem;
    right: 1rem;
    width: 28px;
    height: 28px;
    border: 1px solid var(--border-primary);
    border-radius: 50%;
    background: var(--surface);
    color: var(--text-tertiary);
    cursor: pointer;
    transition: all var(--transition-fast);
    display: flex;
    align-items: center;
    justify-content: center;
}

.alert-dismiss:hover {
    background: #ef4444;
    color: white;
    border-color: #ef4444;
}

.expiring-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    margin-bottom: 1rem;
    padding: 1rem;
    background: var(--bg-secondary);
    border-radius: var(--border-radius-sm);
}

.expiring-item {
    display: grid;
    grid-template-columns: 1fr auto auto;
    gap: 1rem;
    align-items: center;
    font-size: 0.875rem;
    padding: 0.5rem;
    background: var(--surface);
    border-radius: var(--border-radius-sm);
}

.med-name {
    color: var(--text-primary);
    font-weight: 500;
}

.med-qty {
    color: var(--text-secondary);
    font-family: 'JetBrains Mono', monospace;
}

.med-date {
    color: #ef4444;
    font-weight: 600;
}
</style>
@endpush
