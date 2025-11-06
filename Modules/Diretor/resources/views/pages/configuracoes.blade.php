@extends('diretor::layout.app')

@section('title', 'Configurações do Sistema')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Configurações do Sistema</h1>
        <p>Gerencie as configurações gerais da farmácia hospitalar</p>
    </div>
    <div class="page-actions">
        <button class="btn-modern btn-primary">
            <i class="fa-solid fa-save me-2"></i>
            Salvar Todas as Alterações
        </button>
    </div>
</div>

<div class="page-content">
    <div class="config-layout">
        <!-- Menu Lateral de Configurações -->
        <div class="config-sidebar">
            <nav class="config-nav">
                <button class="config-nav-item active" data-section="geral">
                    <i class="fa-solid fa-sliders"></i>
                    <span>Geral</span>
                </button>
                <button class="config-nav-item" data-section="estoque">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    <span>Estoque</span>
                </button>
                <button class="config-nav-item" data-section="alertas">
                    <i class="fa-solid fa-bell"></i>
                    <span>Alertas</span>
                </button>
                <button class="config-nav-item" data-section="relatorios">
                    <i class="fa-solid fa-file-chart-line"></i>
                    <span>Relatórios</span>
                </button>
                <button class="config-nav-item" data-section="integracao">
                    <i class="fa-solid fa-link"></i>
                    <span>Integrações</span>
                </button>
            </nav>
        </div>

        <!-- Conteúdo das Configurações -->
        <div class="config-content">
            <!-- Configurações Gerais -->
            <div class="config-section active" id="section-geral">
                <div class="card">
                    <div class="card-header">
                        <h3>Informações da Farmácia</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nome da Instituição</label>
                            <input type="text" class="form-control" value="Hospital Geral de Luanda" placeholder="Nome do hospital">
                        </div>

                        <div class="form-group">
                            <label>Nome da Farmácia</label>
                            <input type="text" class="form-control" value="Farmácia Hospitalar Central" placeholder="Nome da farmácia">
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>CNPJ / Nº de Registro</label>
                                <input type="text" class="form-control" value="123456789-AO" placeholder="Número de registro">
                            </div>
                            <div class="form-group">
                                <label>Telefone Principal</label>
                                <input type="tel" class="form-control" value="+244 222 123 456" placeholder="+244 900 000 000">
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Endereço Completo</label>
                            <textarea class="form-control" rows="3" placeholder="Endereço da farmácia">Rua Principal, nº 123, Luanda, Angola</textarea>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Horário de Funcionamento</h3>
                    </div>
                    <div class="card-body">
                        <div class="schedule-grid">
                            <div class="schedule-item">
                                <label>Segunda a Sexta</label>
                                <div class="time-inputs">
                                    <input type="time" class="form-control" value="07:00">
                                    <span>até</span>
                                    <input type="time" class="form-control" value="19:00">
                                </div>
                            </div>
                            <div class="schedule-item">
                                <label>Sábado</label>
                                <div class="time-inputs">
                                    <input type="time" class="form-control" value="08:00">
                                    <span>até</span>
                                    <input type="time" class="form-control" value="14:00">
                                </div>
                            </div>
                            <div class="schedule-item">
                                <label>Domingo</label>
                                <div class="time-inputs">
                                    <input type="text" class="form-control" value="Plantão 24h" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Configurações de Estoque -->
            <div class="config-section" id="section-estoque">
                <div class="card">
                    <div class="card-header">
                        <h3>Níveis de Estoque</h3>
                    </div>
                    <div class="card-body">
                        <div class="config-item">
                            <div class="config-item-info">
                                <h4>Nível Crítico (%)</h4>
                                <p>Percentual do estoque mínimo para alerta crítico</p>
                            </div>
                            <input type="number" class="config-input" value="20" min="0" max="100">
                        </div>

                        <div class="config-item">
                            <div class="config-item-info">
                                <h4>Nível de Atenção (%)</h4>
                                <p>Percentual do estoque mínimo para alerta de atenção</p>
                            </div>
                            <input type="number" class="config-input" value="40" min="0" max="100">
                        </div>

                        <div class="config-item">
                            <div class="config-item-info">
                                <h4>Dias de Alerta de Validade</h4>
                                <p>Alertar quando medicamentos estiverem próximos ao vencimento</p>
                            </div>
                            <input type="number" class="config-input" value="30" min="1" max="365">
                        </div>

                        <div class="config-item">
                            <div class="config-item-info">
                                <h4>Controle de Lotes</h4>
                                <p>Ativar rastreamento rigoroso por lote</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Dispensação</h3>
                    </div>
                    <div class="card-body">
                        <div class="config-item">
                            <div class="config-item-info">
                                <h4>Exigir Prescrição Médica</h4>
                                <p>Bloquear dispensação sem prescrição válida</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>

                        <div class="config-item">
                            <div class="config-item-info">
                                <h4>Validar CRM do Prescritor</h4>
                                <p>Verificar registro profissional do médico</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>

                        <div class="config-item">
                            <div class="config-item-info">
                                <h4>Registro de Paciente Obrigatório</h4>
                                <p>Vincular dispensação a paciente específico</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Configurações de Alertas -->
            <div class="config-section" id="section-alertas">
                <div class="card">
                    <div class="card-header">
                        <h3>Notificações por E-mail</h3>
                    </div>
                    <div class="card-body">
                        <div class="config-item">
                            <div class="config-item-info">
                                <h4>Estoque Crítico</h4>
                                <p>Enviar e-mail quando medicamentos atingirem nível crítico</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>

                        <div class="config-item">
                            <div class="config-item-info">
                                <h4>Validade Próxima</h4>
                                <p>Alertar sobre medicamentos próximos ao vencimento</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>

                        <div class="config-item">
                            <div class="config-item-info">
                                <h4>Falhas no Sistema</h4>
                                <p>Notificar sobre erros e problemas técnicos</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label>E-mails para Alertas (separados por vírgula)</label>
                            <textarea class="form-control" rows="3" placeholder="email1@exemplo.com, email2@exemplo.com">diretor@pharmacus.ao, gestao@pharmacus.ao</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Configurações de Relatórios -->
            <div class="config-section" id="section-relatorios">
                <div class="card">
                    <div class="card-header">
                        <h3>Relatórios Automáticos</h3>
                    </div>
                    <div class="card-body">
                        <div class="config-item">
                            <div class="config-item-info">
                                <h4>Relatório Diário</h4>
                                <p>Resumo de dispensações e movimentações do dia</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>

                        <div class="config-item">
                            <div class="config-item-info">
                                <h4>Relatório Semanal</h4>
                                <p>Análise semanal de atividades e estatísticas</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" checked>
                                <span class="toggle-slider"></span>
                            </label>
                        </div>

                        <div class="config-item">
                            <div class="config-item-info">
                                <h4>Relatório Mensal</h4>
                                <p>Consolidado mensal completo</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Configurações de Integração -->
            <div class="config-section" id="section-integracao">
                <div class="card">
                    <div class="card-header">
                        <h3>Sistemas Integrados</h3>
                    </div>
                    <div class="card-body">
                        <div class="integration-item">
                            <div class="integration-icon">
                                <i class="fa-solid fa-hospital"></i>
                            </div>
                            <div class="integration-info">
                                <h4>Sistema Hospitalar (HIS)</h4>
                                <p>Sincronização com prontuário eletrônico</p>
                                <span class="integration-status active">
                                    <i class="fa-solid fa-circle"></i>
                                    Conectado
                                </span>
                            </div>
                            <button class="btn-config">Configurar</button>
                        </div>

                        <div class="integration-item">
                            <div class="integration-icon">
                                <i class="fa-solid fa-flask"></i>
                            </div>
                            <div class="integration-info">
                                <h4>Laboratório</h4>
                                <p>Integração com resultados de exames</p>
                                <span class="integration-status inactive">
                                    <i class="fa-solid fa-circle"></i>
                                    Desconectado
                                </span>
                            </div>
                            <button class="btn-config">Configurar</button>
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
.config-layout {
    display: grid;
    grid-template-columns: 240px 1fr;
    gap: 1.5rem;
}

@media (max-width: 1024px) {
    .config-layout {
        grid-template-columns: 1fr;
    }
}

.config-sidebar {
    position: sticky;
    top: 1rem;
    height: fit-content;
}

.config-nav {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
    padding: 0.5rem;
}

.config-nav-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    border: none;
    border-radius: var(--border-radius-sm);
    background: transparent;
    color: var(--text-secondary);
    font-size: 0.9375rem;
    font-weight: 500;
    cursor: pointer;
    transition: all var(--transition-fast);
    text-align: left;
}

.config-nav-item:hover {
    background: var(--bg-secondary);
    color: var(--text-primary);
}

.config-nav-item.active {
    background: var(--primary);
    color: white;
}

.config-nav-item i {
    width: 20px;
}

.config-content {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.config-section {
    display: none;
    flex-direction: column;
    gap: 1.5rem;
}

.config-section.active {
    display: flex;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-group label {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
}

.form-control {
    padding: 0.75rem;
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    background: var(--bg-secondary);
    color: var(--text-primary);
    font-size: 0.9375rem;
    transition: all var(--transition-fast);
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    background: var(--surface);
}

.schedule-grid {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.schedule-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.schedule-item label {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
}

.time-inputs {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.time-inputs span {
    color: var(--text-tertiary);
    font-size: 0.875rem;
}

.config-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.25rem 0;
    border-bottom: 1px solid var(--border-primary);
}

.config-item:last-child {
    border-bottom: none;
}

.config-item-info h4 {
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 0.25rem 0;
}

.config-item-info p {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0;
}

.config-input {
    width: 100px;
    padding: 0.5rem 0.75rem;
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    background: var(--bg-secondary);
    color: var(--text-primary);
    font-size: 0.9375rem;
    text-align: center;
}

.toggle-switch {
    position: relative;
    width: 48px;
    height: 28px;
    cursor: pointer;
}

.toggle-switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.toggle-slider {
    position: absolute;
    inset: 0;
    background: var(--bg-tertiary);
    border-radius: 28px;
    transition: background var(--transition-fast);
}

.toggle-slider:before {
    content: '';
    position: absolute;
    width: 20px;
    height: 20px;
    left: 4px;
    bottom: 4px;
    background: white;
    border-radius: 50%;
    transition: transform var(--transition-fast);
}

.toggle-switch input:checked + .toggle-slider {
    background: var(--primary);
}

.toggle-switch input:checked + .toggle-slider:before {
    transform: translateX(20px);
}

.integration-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem;
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
    margin-bottom: 1rem;
}

.integration-icon {
    width: 56px;
    height: 56px;
    border-radius: var(--border-radius);
    background: var(--primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.integration-info {
    flex: 1;
}

.integration-info h4 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 0.25rem 0;
}

.integration-info p {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0 0 0.5rem 0;
}

.integration-status {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
}

.integration-status.active {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success);
}

.integration-status.inactive {
    background: rgba(107, 114, 128, 0.1);
    color: var(--text-tertiary);
}

.integration-status i {
    font-size: 0.5rem;
}

.btn-config {
    padding: 0.5rem 1rem;
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    background: var(--bg-secondary);
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all var(--transition-fast);
}

.btn-config:hover {
    background: var(--surface-hover);
    color: var(--primary);
    border-color: var(--primary);
}
</style>
@endpush

@push('scripts')
<script>
document.querySelectorAll('.config-nav-item').forEach(btn => {
    btn.addEventListener('click', function() {
        const section = this.dataset.section;
        
        // Atualizar nav ativo
        document.querySelectorAll('.config-nav-item').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        // Mostrar seção correspondente
        document.querySelectorAll('.config-section').forEach(s => s.classList.remove('active'));
        document.getElementById(`section-${section}`).classList.add('active');
    });
});
</script>
@endpush
