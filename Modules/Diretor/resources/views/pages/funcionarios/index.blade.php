@extends('diretor::layout.app')

@section('title', 'Gestão de Funcionários')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Gestão de Funcionários</h1>
        <p>Equipe da farmácia hospitalar</p>
    </div>
    <div class="page-actions">
        <button class="btn-modern btn-primary">
            <i class="fa-solid fa-user-plus me-2"></i>
            Novo Funcionário
        </button>
    </div>
</div>

<div class="page-content">
    <!-- Filtros -->
    <div class="filters-section">
        <div class="filters-row">
            <div class="filter-group">
                <label for="cargo">Cargo</label>
                <select id="cargo" class="filter-select">
                    <option value="">Todos</option>
                    <option value="farmaceutico">Farmacêutico</option>
                    <option value="tecnico">Técnico em Farmácia</option>
                    <option value="auxiliar">Auxiliar de Farmácia</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="status">Status</label>
                <select id="status" class="filter-select">
                    <option value="">Todos</option>
                    <option value="ativo">Ativo</option>
                    <option value="ferias">Em Férias</option>
                    <option value="afastado">Afastado</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="turno">Turno</label>
                <select id="turno" class="filter-select">
                    <option value="">Todos</option>
                    <option value="manha">Manhã</option>
                    <option value="tarde">Tarde</option>
                    <option value="noite">Noite</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Resumo da Equipe -->
    <div class="team-summary">
        <div class="summary-card">
            <div class="summary-icon total">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="summary-content">
                <div class="summary-value">24</div>
                <div class="summary-label">Total de Funcionários</div>
            </div>
        </div>
        
        <div class="summary-card">
            <div class="summary-icon active">
                <i class="fa-solid fa-user-check"></i>
            </div>
            <div class="summary-content">
                <div class="summary-value">22</div>
                <div class="summary-label">Ativos</div>
            </div>
        </div>
        
        <div class="summary-card">
            <div class="summary-icon vacation">
                <i class="fa-solid fa-umbrella-beach"></i>
            </div>
            <div class="summary-content">
                <div class="summary-value">2</div>
                <div class="summary-label">Em Férias</div>
            </div>
        </div>
        
        <div class="summary-card">
            <div class="summary-icon shift">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div class="summary-content">
                <div class="summary-value">8</div>
                <div class="summary-label">Em Serviço Agora</div>
            </div>
        </div>
    </div>

    <!-- Grid de Funcionários -->
    <div class="staff-grid">
        <div class="staff-card">
            <div class="staff-header">
                <img src="https://ui-avatars.com/api/?name=João+Silva&background=2563eb&color=fff&size=80" alt="João Silva">
                <div class="staff-status active">
                    <i class="fa-solid fa-circle"></i>
                </div>
            </div>
            <div class="staff-body">
                <h4>Dr. João Silva</h4>
                <p class="staff-role">Farmacêutico Responsável</p>
                <p class="staff-license">CRF 98765-AO</p>
                
                <div class="staff-info">
                    <div class="info-item">
                        <i class="fa-solid fa-clock"></i>
                        <span>Turno Manhã</span>
                    </div>
                    <div class="info-item">
                        <i class="fa-solid fa-phone"></i>
                        <span>+244 923 456 789</span>
                    </div>
                </div>
                
                <div class="staff-stats">
                    <div class="stat">
                        <div class="stat-value">156</div>
                        <div class="stat-label">Dispensações Hoje</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">5</div>
                        <div class="stat-label">Anos de Serviço</div>
                    </div>
                </div>
                
                <div class="staff-actions">
                    <button class="btn-action"><i class="fa-solid fa-eye"></i></button>
                    <button class="btn-action"><i class="fa-solid fa-calendar"></i></button>
                    <button class="btn-action"><i class="fa-solid fa-envelope"></i></button>
                </div>
            </div>
        </div>

        <div class="staff-card">
            <div class="staff-header">
                <img src="https://ui-avatars.com/api/?name=Maria+Santos&background=10b981&color=fff&size=80" alt="Maria Santos">
                <div class="staff-status active">
                    <i class="fa-solid fa-circle"></i>
                </div>
            </div>
            <div class="staff-body">
                <h4>Maria Santos</h4>
                <p class="staff-role">Técnica em Farmácia</p>
                <p class="staff-license">TF 54321-AO</p>
                
                <div class="staff-info">
                    <div class="info-item">
                        <i class="fa-solid fa-clock"></i>
                        <span>Turno Tarde</span>
                    </div>
                    <div class="info-item">
                        <i class="fa-solid fa-phone"></i>
                        <span>+244 912 345 678</span>
                    </div>
                </div>
                
                <div class="staff-stats">
                    <div class="stat">
                        <div class="stat-value">89</div>
                        <div class="stat-label">Dispensações Hoje</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">3</div>
                        <div class="stat-label">Anos de Serviço</div>
                    </div>
                </div>
                
                <div class="staff-actions">
                    <button class="btn-action"><i class="fa-solid fa-eye"></i></button>
                    <button class="btn-action"><i class="fa-solid fa-calendar"></i></button>
                    <button class="btn-action"><i class="fa-solid fa-envelope"></i></button>
                </div>
            </div>
        </div>

        <div class="staff-card">
            <div class="staff-header">
                <img src="https://ui-avatars.com/api/?name=Pedro+Costa&background=8b5cf6&color=fff&size=80" alt="Pedro Costa">
                <div class="staff-status vacation">
                    <i class="fa-solid fa-umbrella-beach"></i>
                </div>
            </div>
            <div class="staff-body">
                <h4>Pedro Costa</h4>
                <p class="staff-role">Auxiliar de Farmácia</p>
                <p class="staff-license">AF 12345-AO</p>
                
                <div class="staff-info">
                    <div class="info-item">
                        <i class="fa-solid fa-clock"></i>
                        <span>Turno Noite</span>
                    </div>
                    <div class="info-item">
                        <i class="fa-solid fa-phone"></i>
                        <span>+244 934 567 890</span>
                    </div>
                </div>
                
                <div class="staff-stats">
                    <div class="stat">
                        <div class="stat-value">-</div>
                        <div class="stat-label">Em Férias</div>
                    </div>
                    <div class="stat">
                        <div class="stat-value">2</div>
                        <div class="stat-label">Anos de Serviço</div>
                    </div>
                </div>
                
                <div class="staff-actions">
                    <button class="btn-action"><i class="fa-solid fa-eye"></i></button>
                    <button class="btn-action"><i class="fa-solid fa-calendar"></i></button>
                    <button class="btn-action"><i class="fa-solid fa-envelope"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.team-summary {
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
.summary-icon.active { background: var(--success); }
.summary-icon.vacation { background: var(--warning); }
.summary-icon.shift { background: #8b5cf6; }

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

.staff-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 1.5rem;
}

.staff-card {
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
    overflow: hidden;
    transition: all var(--transition-normal);
}

.staff-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
    border-color: var(--primary);
}

.staff-header {
    position: relative;
    padding: 2rem 1.5rem 1rem;
    background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--surface) 100%);
    text-align: center;
}

.staff-header img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 3px solid var(--surface);
    box-shadow: var(--shadow-md);
}

.staff-status {
    position: absolute;
    top: 1rem;
    right: 1rem;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
}

.staff-status.active {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success);
}

.staff-status.vacation {
    background: rgba(245, 158, 11, 0.1);
    color: var(--warning);
}

.staff-body {
    padding: 1.5rem;
}

.staff-body h4 {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 0.25rem 0;
    text-align: center;
}

.staff-role {
    font-size: 0.875rem;
    color: var(--text-secondary);
    text-align: center;
    margin: 0 0 0.25rem 0;
}

.staff-license {
    font-size: 0.75rem;
    color: var(--text-tertiary);
    font-family: 'JetBrains Mono', monospace;
    text-align: center;
    margin: 0 0 1rem 0;
}

.staff-info {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    padding: 1rem 0;
    border-top: 1px solid var(--border-primary);
    border-bottom: 1px solid var(--border-primary);
    margin-bottom: 1rem;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.info-item i {
    width: 16px;
    color: var(--text-tertiary);
}

.staff-stats {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-bottom: 1rem;
}

.stat {
    text-align: center;
}

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

.staff-actions {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
}

.btn-action {
    width: 36px;
    height: 36px;
    border: 1px solid var(--border-primary);
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
    color: var(--primary);
    border-color: var(--primary);
}
</style>
@endpush
