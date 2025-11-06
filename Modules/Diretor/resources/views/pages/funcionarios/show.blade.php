@extends('diretor::layout.app')

@section('title', 'Perfil do Funcionário')

@section('content')
<div class="page-header">
    <div class="page-title">
        <a href="{{ route('diretor.funcionarios.index') }}" class="back-link">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h1>Perfil do Funcionário</h1>
            <p>Informações detalhadas e histórico</p>
        </div>
    </div>
    <div class="page-actions">
        <button class="btn-modern btn-secondary">
            <i class="fa-solid fa-calendar me-2"></i>
            Escala
        </button>
        <button class="btn-modern btn-primary">
            <i class="fa-solid fa-print me-2"></i>
            Imprimir
        </button>
    </div>
</div>

<div class="page-content">
    <div class="profile-layout">
        <div class="profile-main">
            <!-- Perfil Principal -->
            <div class="card">
                <div class="card-header-custom">
                    <img src="https://ui-avatars.com/api/?name=João+Silva&background=2563eb&color=fff&size=120" alt="João Silva" class="profile-avatar">
                    <div class="profile-header-content">
                        <div class="profile-name-row">
                            <h2>Dr. João Silva</h2>
                            <span class="status-badge active">Ativo</span>
                        </div>
                        <p class="profile-role">Farmacêutico Responsável</p>
                        <p class="profile-license">CRF 98765-AO</p>
                        
                        <div class="profile-meta">
                            <div class="meta-item">
                                <i class="fa-solid fa-calendar"></i>
                                <span>Admissão: 15 de Janeiro, 2019</span>
                            </div>
                            <div class="meta-item">
                                <i class="fa-solid fa-clock"></i>
                                <span>Turno Atual: Manhã (07:00 - 15:00)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informações de Contato -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-address-card me-2"></i>Informações de Contato</h3>
                </div>
                <div class="card-body">
                    <div class="info-grid">
                        <div class="info-block">
                            <label>E-mail Institucional</label>
                            <p>joao.silva@pharmacus.ao</p>
                        </div>
                        <div class="info-block">
                            <label>Telefone</label>
                            <p>+244 923 456 789</p>
                        </div>
                        <div class="info-block">
                            <label>E-mail Pessoal</label>
                            <p>joao.silva@email.com</p>
                        </div>
                        <div class="info-block">
                            <label>Telefone Alternativo</label>
                            <p>+244 912 345 678</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Credenciais e Certificações -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-certificate me-2"></i>Credenciais e Certificações</h3>
                </div>
                <div class="card-body">
                    <div class="credentials-list">
                        <div class="credential-item">
                            <div class="credential-icon">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                            <div class="credential-content">
                                <h4>Farmacêutico</h4>
                                <p>Universidade Agostinho Neto</p>
                                <span class="credential-year">2014</span>
                            </div>
                        </div>
                        <div class="credential-item">
                            <div class="credential-icon">
                                <i class="fa-solid fa-award"></i>
                            </div>
                            <div class="credential-content">
                                <h4>Farmácia Hospitalar</h4>
                                <p>Especialização - Instituto Superior de Ciências da Saúde</p>
                                <span class="credential-year">2016</span>
                            </div>
                        </div>
                        <div class="credential-item">
                            <div class="credential-icon">
                                <i class="fa-solid fa-id-card"></i>
                            </div>
                            <div class="credential-content">
                                <h4>Registro Profissional CRF 98765-AO</h4>
                                <p>Conselho Regional de Farmácia - Angola</p>
                                <span class="credential-year">Válido até: 2025</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Atividades Recentes -->
            <div class="card">
                <div class="card-header">
                    <h3><i class="fa-solid fa-history me-2"></i>Atividades Recentes</h3>
                </div>
                <div class="card-body">
                    <div class="activities-list">
                        <div class="activity-item">
                            <div class="activity-icon dispensacao">
                                <i class="fa-solid fa-pills"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-header">
                                    <h4>Dispensação de Medicamento</h4>
                                    <span class="activity-time">Há 15 minutos</span>
                                </div>
                                <p>Paracetamol 500mg - 20 comprimidos para Paciente João Costa (Leito 203)</p>
                                <div class="activity-meta">
                                    <span class="badge">Prescrição #PR-2024-0456</span>
                                    <span class="badge">UTI Adulto</span>
                                </div>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="activity-icon entrada">
                                <i class="fa-solid fa-box"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-header">
                                    <h4>Registro de Entrada</h4>
                                    <span class="activity-time">Há 1 hora</span>
                                </div>
                                <p>Insulina NPH 100UI/ml - 50 frascos (Lote: LT2024-INS-890)</p>
                                <div class="activity-meta">
                                    <span class="badge">Fornecedor: PharmaCare Angola</span>
                                    <span class="badge">NF: 45678</span>
                                </div>
                            </div>
                        </div>

                        <div class="activity-item">
                            <div class="activity-icon transferencia">
                                <i class="fa-solid fa-exchange-alt"></i>
                            </div>
                            <div class="activity-content">
                                <div class="activity-header">
                                    <h4>Transferência Interna</h4>
                                    <span class="activity-time">Há 2 horas</span>
                                </div>
                                <p>Dipirona 500mg - 100 ampolas para Farmácia Satélite - Pronto Socorro</p>
                                <div class="activity-meta">
                                    <span class="badge">Protocolo: TRF-2024-0123</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-sidebar">
            <!-- Estatísticas -->
            <div class="card">
                <div class="card-header">
                    <h3>Estatísticas do Mês</h3>
                </div>
                <div class="card-body">
                    <div class="stats-list">
                        <div class="stat-item">
                            <div class="stat-value">1.248</div>
                            <div class="stat-label">Dispensações</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">45</div>
                            <div class="stat-label">Entradas Registradas</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">23</div>
                            <div class="stat-label">Transferências</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value">98%</div>
                            <div class="stat-label">Taxa de Precisão</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Setores Atribuídos -->
            <div class="card">
                <div class="card-header">
                    <h3>Setores Atribuídos</h3>
                </div>
                <div class="card-body">
                    <div class="sectors-list">
                        <div class="sector-item">
                            <i class="fa-solid fa-hospital"></i>
                            <span>UTI Adulto</span>
                        </div>
                        <div class="sector-item">
                            <i class="fa-solid fa-bed"></i>
                            <span>Enfermaria Geral</span>
                        </div>
                        <div class="sector-item">
                            <i class="fa-solid fa-warehouse"></i>
                            <span>Almoxarifado Central</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Horários -->
            <div class="card">
                <div class="card-header">
                    <h3>Escala Semanal</h3>
                </div>
                <div class="card-body">
                    <div class="schedule-list">
                        <div class="schedule-day">
                            <span class="day-name">Segunda</span>
                            <span class="day-time">07:00 - 15:00</span>
                        </div>
                        <div class="schedule-day">
                            <span class="day-name">Terça</span>
                            <span class="day-time">07:00 - 15:00</span>
                        </div>
                        <div class="schedule-day">
                            <span class="day-name">Quarta</span>
                            <span class="day-time">07:00 - 15:00</span>
                        </div>
                        <div class="schedule-day">
                            <span class="day-name">Quinta</span>
                            <span class="day-time">07:00 - 15:00</span>
                        </div>
                        <div class="schedule-day">
                            <span class="day-name">Sexta</span>
                            <span class="day-time">07:00 - 15:00</span>
                        </div>
                        <div class="schedule-day off">
                            <span class="day-name">Sábado</span>
                            <span class="day-time">Folga</span>
                        </div>
                        <div class="schedule-day off">
                            <span class="day-name">Domingo</span>
                            <span class="day-time">Folga</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.profile-layout {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 1.5rem;
}

@media (max-width: 1024px) {
    .profile-layout {
        grid-template-columns: 1fr;
    }
}

.card-header-custom {
    display: flex;
    gap: 1.5rem;
    padding: 2rem;
    background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--surface) 100%);
    border-bottom: 1px solid var(--border-primary);
}

.profile-avatar {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 4px solid var(--surface);
    box-shadow: var(--shadow-md);
}

.profile-header-content {
    flex: 1;
}

.profile-name-row {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 0.5rem;
}

.profile-name-row h2 {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: var(--border-radius-sm);
    font-size: 0.75rem;
    font-weight: 600;
}

.status-badge.active {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success);
}

.profile-role {
    font-size: 1rem;
    color: var(--text-secondary);
    margin: 0 0 0.25rem 0;
}

.profile-license {
    font-size: 0.875rem;
    color: var(--text-tertiary);
    font-family: 'JetBrains Mono', monospace;
    margin: 0 0 1rem 0;
}

.profile-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.meta-item i {
    color: var(--text-tertiary);
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

.info-block label {
    display: block;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--text-tertiary);
    margin-bottom: 0.5rem;
}

.info-block p {
    font-size: 0.9375rem;
    color: var(--text-primary);
    margin: 0;
}

.credentials-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.credential-item {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    background: var(--bg-secondary);
    border-radius: var(--border-radius);
}

.credential-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--border-radius-sm);
    background: var(--primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.credential-content h4 {
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 0.25rem 0;
}

.credential-content p {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0 0 0.25rem 0;
}

.credential-year {
    font-size: 0.75rem;
    color: var(--text-tertiary);
}

.activities-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.activity-item {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    background: var(--bg-secondary);
    border-radius: var(--border-radius);
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: var(--border-radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
}

.activity-icon.dispensacao { background: var(--primary); }
.activity-icon.entrada { background: var(--success); }
.activity-icon.transferencia { background: #8b5cf6; }

.activity-content {
    flex: 1;
}

.activity-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 0.5rem;
}

.activity-header h4 {
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
}

.activity-time {
    font-size: 0.75rem;
    color: var(--text-tertiary);
}

.activity-content > p {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0 0 0.5rem 0;
}

.activity-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.stats-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.stat-item {
    text-align: center;
    padding: 1rem;
    background: var(--bg-secondary);
    border-radius: var(--border-radius);
}

.stat-value {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--primary);
    line-height: 1;
}

.stat-label {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-top: 0.5rem;
}

.sectors-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.sector-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    background: var(--bg-secondary);
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    color: var(--text-primary);
}

.sector-item i {
    color: var(--primary);
}

.schedule-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.schedule-day {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem;
    background: var(--bg-secondary);
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
}

.schedule-day.off {
    opacity: 0.5;
}

.day-name {
    font-weight: 600;
    color: var(--text-primary);
}

.day-time {
    color: var(--text-secondary);
    font-family: 'JetBrains Mono', monospace;
}
</style>
@endpush
