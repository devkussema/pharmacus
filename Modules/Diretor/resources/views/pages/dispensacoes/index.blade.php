@extends('diretor::layout.app')

@section('title', 'Dispensações')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Dispensações de Medicamentos</h1>
        <p>Histórico de medicamentos dispensados aos pacientes</p>
    </div>
    <div class="page-actions">
        <button class="btn-modern btn-secondary">
            <i class="fa-solid fa-filter me-2"></i>
            Filtros Avançados
        </button>
        <button class="btn-modern btn-primary">
            <i class="fa-solid fa-file-export me-2"></i>
            Exportar
        </button>
    </div>
</div>

<div class="page-content">
    <!-- Estatísticas -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon today">
                <i class="fa-solid fa-calendar-day"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">156</div>
                <div class="stat-label">Dispensações Hoje</div>
                <div class="stat-trend positive">
                    <i class="fa-solid fa-arrow-up"></i>
                    <span>12% vs ontem</span>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon week">
                <i class="fa-solid fa-calendar-week"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">1.047</div>
                <div class="stat-label">Esta Semana</div>
                <div class="stat-trend">
                    <span>Média: 175/dia</span>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon pending">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">8</div>
                <div class="stat-label">Pendentes</div>
                <div class="stat-trend warning">
                    <i class="fa-solid fa-exclamation-circle"></i>
                    <span>Aguardando</span>
                </div>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon time">
                <i class="fa-solid fa-hourglass-half"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value">4,2min</div>
                <div class="stat-label">Tempo Médio</div>
                <div class="stat-trend positive">
                    <i class="fa-solid fa-arrow-down"></i>
                    <span>-8% tempo</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros Rápidos -->
    <div class="quick-filters">
        <button class="filter-btn active">Todas</button>
        <button class="filter-btn">Concluídas</button>
        <button class="filter-btn">Pendentes</button>
        <button class="filter-btn">Urgentes</button>
        <button class="filter-btn">Hoje</button>
    </div>

    <!-- Lista de Dispensações -->
    <div class="card">
        <div class="card-header">
            <h3>Dispensações Recentes</h3>
            <div class="search-box">
                <i class="fa-solid fa-search"></i>
                <input type="text" placeholder="Buscar por paciente, medicamento...">
            </div>
        </div>
        <div class="card-body p-0">
            <div class="dispensacoes-list">
                <div class="dispensacao-item">
                    <div class="dispensacao-status concluida"></div>
                    <div class="dispensacao-main">
                        <div class="dispensacao-header">
                            <div class="dispensacao-info">
                                <h4>Paracetamol 500mg</h4>
                                <p class="paciente-nome">Paciente: João Pedro Costa</p>
                            </div>
                            <span class="dispensacao-time">Há 5 minutos</span>
                        </div>
                        <div class="dispensacao-details">
                            <div class="detail-item">
                                <i class="fa-solid fa-capsules"></i>
                                <span>20 comprimidos</span>
                            </div>
                            <div class="detail-item">
                                <i class="fa-solid fa-bed"></i>
                                <span>Leito 203 - UTI Adulto</span>
                            </div>
                            <div class="detail-item">
                                <i class="fa-solid fa-user-doctor"></i>
                                <span>Dr. Carlos Silva</span>
                            </div>
                            <div class="detail-item">
                                <i class="fa-solid fa-user"></i>
                                <span>Dispensado por: Dra. Maria Santos</span>
                            </div>
                        </div>
                        <div class="dispensacao-meta">
                            <span class="badge">Prescrição #PR-2024-0456</span>
                            <span class="badge">Lote: LT2024-PAR-123</span>
                            <span class="badge urgente">Urgente</span>
                        </div>
                    </div>
                    <div class="dispensacao-actions">
                        <button class="btn-action" title="Ver detalhes">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button class="btn-action" title="Imprimir">
                            <i class="fa-solid fa-print"></i>
                        </button>
                    </div>
                </div>

                <div class="dispensacao-item">
                    <div class="dispensacao-status pendente"></div>
                    <div class="dispensacao-main">
                        <div class="dispensacao-header">
                            <div class="dispensacao-info">
                                <h4>Insulina NPH 100UI/ml</h4>
                                <p class="paciente-nome">Paciente: Maria Francisca Santos</p>
                            </div>
                            <span class="dispensacao-time">Há 12 minutos</span>
                        </div>
                        <div class="dispensacao-details">
                            <div class="detail-item">
                                <i class="fa-solid fa-syringe"></i>
                                <span>3 frascos</span>
                            </div>
                            <div class="detail-item">
                                <i class="fa-solid fa-bed"></i>
                                <span>Leito 115 - Enfermaria Geral</span>
                            </div>
                            <div class="detail-item">
                                <i class="fa-solid fa-user-doctor"></i>
                                <span>Dra. Ana Paula</span>
                            </div>
                        </div>
                        <div class="dispensacao-meta">
                            <span class="badge">Prescrição #PR-2024-0455</span>
                            <span class="badge warning">Aguardando confirmação</span>
                        </div>
                    </div>
                    <div class="dispensacao-actions">
                        <button class="btn-action primary" title="Confirmar">
                            <i class="fa-solid fa-check"></i>
                        </button>
                        <button class="btn-action" title="Ver detalhes">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="dispensacao-item">
                    <div class="dispensacao-status concluida"></div>
                    <div class="dispensacao-main">
                        <div class="dispensacao-header">
                            <div class="dispensacao-info">
                                <h4>Dipirona 500mg</h4>
                                <p class="paciente-nome">Paciente: Pedro Manuel Oliveira</p>
                            </div>
                            <span class="dispensacao-time">Há 25 minutos</span>
                        </div>
                        <div class="dispensacao-details">
                            <div class="detail-item">
                                <i class="fa-solid fa-vial"></i>
                                <span>5 ampolas</span>
                            </div>
                            <div class="detail-item">
                                <i class="fa-solid fa-bed"></i>
                                <span>Leito 308 - UTI Pediátrica</span>
                            </div>
                            <div class="detail-item">
                                <i class="fa-solid fa-user-doctor"></i>
                                <span>Dr. Fernando Costa</span>
                            </div>
                            <div class="detail-item">
                                <i class="fa-solid fa-user"></i>
                                <span>Dispensado por: João Silva</span>
                            </div>
                        </div>
                        <div class="dispensacao-meta">
                            <span class="badge">Prescrição #PR-2024-0454</span>
                            <span class="badge">Lote: LT2024-DIP-456</span>
                        </div>
                    </div>
                    <div class="dispensacao-actions">
                        <button class="btn-action" title="Ver detalhes">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button class="btn-action" title="Imprimir">
                            <i class="fa-solid fa-print"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.stat-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem;
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
}

.stat-icon {
    width: 56px;
    height: 56px;
    border-radius: var(--border-radius);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.stat-icon.today { background: var(--primary); }
.stat-icon.week { background: #10b981; }
.stat-icon.pending { background: #f59e0b; }
.stat-icon.time { background: #8b5cf6; }

.stat-value {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-bottom: 0.5rem;
}

.stat-trend {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.75rem;
    color: var(--text-tertiary);
}

.stat-trend.positive {
    color: var(--success);
}

.stat-trend.warning {
    color: var(--warning);
}

.stat-trend i {
    font-size: 0.625rem;
}

.quick-filters {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}

.filter-btn {
    padding: 0.5rem 1rem;
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    background: var(--surface);
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all var(--transition-fast);
}

.filter-btn:hover {
    background: var(--surface-hover);
    color: var(--text-primary);
}

.filter-btn.active {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

.search-box {
    position: relative;
    width: 300px;
}

.search-box i {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-tertiary);
    font-size: 0.875rem;
}

.search-box input {
    width: 100%;
    padding: 0.625rem 1rem 0.625rem 2.5rem;
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    background: var(--bg-secondary);
    color: var(--text-primary);
    font-size: 0.875rem;
}

.search-box input:focus {
    outline: none;
    border-color: var(--primary);
    background: var(--surface);
}

.dispensacoes-list {
    display: flex;
    flex-direction: column;
}

.dispensacao-item {
    display: flex;
    gap: 1rem;
    padding: 1.5rem;
    border-bottom: 1px solid var(--border-primary);
    transition: background var(--transition-fast);
}

.dispensacao-item:last-child {
    border-bottom: none;
}

.dispensacao-item:hover {
    background: var(--bg-secondary);
}

.dispensacao-status {
    width: 4px;
    border-radius: 2px;
    flex-shrink: 0;
}

.dispensacao-status.concluida {
    background: var(--success);
}

.dispensacao-status.pendente {
    background: var(--warning);
}

.dispensacao-main {
    flex: 1;
}

.dispensacao-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 0.75rem;
}

.dispensacao-info h4 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 0.25rem 0;
}

.paciente-nome {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0;
}

.dispensacao-time {
    font-size: 0.75rem;
    color: var(--text-tertiary);
    font-family: 'JetBrains Mono', monospace;
}

.dispensacao-details {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    margin-bottom: 0.75rem;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.detail-item i {
    width: 16px;
    color: var(--text-tertiary);
}

.dispensacao-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.badge.urgente {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
}

.dispensacao-actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.btn-action.primary {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

.btn-action.primary:hover {
    background: #1d4ed8;
    border-color: #1d4ed8;
}
</style>
@endpush
