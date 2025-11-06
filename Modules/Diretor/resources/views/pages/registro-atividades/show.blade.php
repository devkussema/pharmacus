@extends('diretor::layout.app')

@section('title', 'Detalhes da Atividade')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Detalhes da Atividade #{{ $id }}</h1>
        <p>Informações completas da movimentação</p>
    </div>
    <div class="page-actions">
        <a href="{{ route('diretor.atividades.index') }}" class="btn-secondary">
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
                    <h3>Informações da Atividade</h3>
                    <span class="activity-badge dispensacao">Dispensação</span>
                </div>
                <div class="detail-body">
                    <div class="detail-item">
                        <span class="label">Data e Hora:</span>
                        <span class="value">05/11/2025 14:32</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Tipo:</span>
                        <span class="value">Dispensação de Medicamento</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Medicamento:</span>
                        <span class="value">Paracetamol 500mg</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Quantidade:</span>
                        <span class="value">20 unidades</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Lote:</span>
                        <span class="value"><code>LT2024-089</code></span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Validade do Lote:</span>
                        <span class="value">15/06/2026</span>
                    </div>
                </div>
            </div>

            <div class="detail-card">
                <div class="detail-header">
                    <h3>Detalhes do Paciente/Destino</h3>
                </div>
                <div class="detail-body">
                    <div class="detail-item">
                        <span class="label">Setor:</span>
                        <span class="value">Enfermaria 3A</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Leito:</span>
                        <span class="value">Leito 12</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Prescrição Médica:</span>
                        <span class="value">#PM-2025-11-0156</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Médico Prescritor:</span>
                        <span class="value">Dr. Carlos Mendes - CRM 12345</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="detail-sidebar">
            <div class="detail-card">
                <div class="detail-header">
                    <h3>Responsável</h3>
                </div>
                <div class="detail-body">
                    <div class="user-profile">
                        <img src="https://ui-avatars.com/api/?name=João+Silva&background=2563eb&color=fff&size=60" alt="João Silva">
                        <div>
                            <div class="user-name">Dr. João Silva</div>
                            <div class="user-role">Farmacêutico</div>
                            <div class="user-license">CRF 98765</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="detail-card">
                <div class="detail-header">
                    <h3>Rastreabilidade</h3>
                </div>
                <div class="detail-body">
                    <div class="detail-item">
                        <span class="label">ID da Transação:</span>
                        <span class="value"><code>{{ $id }}</code></span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Protocolo:</span>
                        <span class="value"><code>PROT-2025-{{ str_pad($id, 6, '0', STR_PAD_LEFT) }}</code></span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Registro no Sistema:</span>
                        <span class="value">05/11/2025 14:32:15</span>
                    </div>
                    <div class="detail-item">
                        <span class="label">Status:</span>
                        <span class="value"><span class="status-badge success">Confirmado</span></span>
                    </div>
                </div>
            </div>

            <div class="detail-card">
                <div class="detail-header">
                    <h3>Ações</h3>
                </div>
                <div class="detail-body">
                    <div class="quick-actions">
                        <button class="action-btn full">
                            <i class="fa-solid fa-print"></i>
                            Imprimir Comprovante
                        </button>
                        <button class="action-btn full">
                            <i class="fa-solid fa-file-pdf"></i>
                            Exportar PDF
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

.activity-badge {
    padding: 0.375rem 0.875rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.activity-badge.dispensacao {
    background: rgba(37, 99, 235, 0.1);
    color: var(--primary);
}

.user-profile {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.user-profile img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    border: 2px solid var(--border-primary);
}

.user-name {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
}

.user-role {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-top: 0.25rem;
}

.user-license {
    font-size: 0.75rem;
    color: var(--text-tertiary);
    margin-top: 0.125rem;
    font-family: 'JetBrains Mono', monospace;
}

.status-badge {
    padding: 0.25rem 0.625rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-badge.success {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success);
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
}
</style>
@endpush
@endsection
