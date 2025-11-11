@extends('diretor::layout.app')

@section('title', 'Registro de Atividades')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Registro de Atividades</h1>
        <p>Histórico de dispensações, movimentações e operações</p>
    </div>
    <div class="page-actions">
        <button class="btn-modern btn-secondary" id="btnAtualizarRegistros">
            <i class="fa-solid fa-sync me-2"></i>Atualizar
        </button>
        <button class="btn-modern btn-primary" id="btnExportarRelatorio">
            <i class="fa-solid fa-file-export me-2"></i>Exportar Relatório
        </button>
    </div>
</div>

<div class="page-content">
    <!-- Filtros -->
    <div class="filters-section">
        <div class="filters-row">
            <div class="filter-group">
                <label for="tipo"><i class="fa-solid fa-filter me-2"></i>Tipo de Atividade</label>
                <select id="tipo" class="filter-select">
                    <option value="">Todas as Atividades</option>
                    <option value="dispensacao">Dispensação</option>
                    <option value="entrada">Entrada de Estoque</option>
                    <option value="transferencia">Transferência</option>
                    <option value="ajuste">Ajuste</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="periodo"><i class="fa-solid fa-calendar me-2"></i>Período</label>
                <select id="periodo" class="filter-select">
                    <option value="hoje">Hoje</option>
                    <option value="ontem">Ontem</option>
                    <option value="7dias">Últimos 7 dias</option>
                    <option value="30dias">Últimos 30 dias</option>
                    <option value="custom">Personalizado</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="funcionario"><i class="fa-solid fa-user me-2"></i>Funcionário</label>
                <select id="funcionario" class="filter-select">
                    <option value="">Todos os Funcionários</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="busca"><i class="fa-solid fa-search me-2"></i>Buscar</label>
                <input type="text" id="busca" class="filter-input" placeholder="Medicamento, paciente...">
            </div>
        </div>
    </div>    <!-- Resumo de Atividades -->
    <div class="activities-summary">
        <div class="summary-card">
            <div class="summary-icon dispensacao">
                <i class="fa-solid fa-hand-holding-medical"></i>
            </div>
            <div class="summary-content">
                <div class="summary-value">156</div>
                <div class="summary-label">Dispensações Hoje</div>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon entrada">
                <i class="fa-solid fa-box-open"></i>
            </div>
            <div class="summary-content">
                <div class="summary-value">12</div>
                <div class="summary-label">Entradas Registradas</div>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon transferencia">
                <i class="fa-solid fa-arrow-right-arrow-left"></i>
            </div>
            <div class="summary-content">
                <div class="summary-value">8</div>
                <div class="summary-label">Transferências</div>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon alerta">
                <i class="fa-solid fa-exclamation-circle"></i>
            </div>
            <div class="summary-content">
                <div class="summary-value">3</div>
                <div class="summary-label">Alertas Críticos</div>
            </div>
        </div>
    </div>

    <!-- Timeline de Atividades -->
    <div class="activities-container">
        <div class="activities-header">
            <h3>Histórico Recente</h3>
        </div>

        <div class="activities-timeline">
            <div class="activity-item">
                <div class="activity-time">14:32</div>
                <div class="activity-icon dispensacao">
                    <i class="fa-solid fa-hand-holding-medical"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">Dispensação de Medicamento</div>
                    <div class="activity-desc">
                        <strong>Paracetamol 500mg</strong> - 20 unidades dispensadas
                    </div>
                    <div class="activity-meta">
                        <span class="activity-user">
                            <i class="fa-solid fa-user"></i> Dr. João Silva
                        </span>
                        <span class="activity-location">
                            <i class="fa-solid fa-hospital"></i> Enfermaria 3A
                        </span>
                    </div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-time">13:15</div>
                <div class="activity-icon entrada">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">Entrada de Estoque</div>
                    <div class="activity-desc">
                        <strong>Ibuprofeno 400mg</strong> - Lote LT2025-089, 500 unidades recebidas
                    </div>
                    <div class="activity-meta">
                        <span class="activity-user">
                            <i class="fa-solid fa-user"></i> Téc. Maria Santos
                        </span>
                        <span class="activity-supplier">
                            <i class="fa-solid fa-truck"></i> PharmaCorp International
                        </span>
                    </div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-time">11:45</div>
                <div class="activity-icon alerta">
                    <i class="fa-solid fa-exclamation-triangle"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">Alerta de Nível Crítico</div>
                    <div class="activity-desc">
                        <strong>Amoxicilina 875mg</strong> atingiu nível crítico (8 unidades restantes)
                    </div>
                    <div class="activity-meta">
                        <span class="activity-status critical">
                            <i class="fa-solid fa-bell"></i> Reposição Urgente
                        </span>
                    </div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-time">10:20</div>
                <div class="activity-icon transferencia">
                    <i class="fa-solid fa-arrow-right-arrow-left"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">Transferência Interna</div>
                    <div class="activity-desc">
                        <strong>Dipirona 500mg</strong> - 50 unidades transferidas
                    </div>
                    <div class="activity-meta">
                        <span class="activity-from">
                            <i class="fa-solid fa-location-arrow"></i> Farmácia Central
                        </span>
                        <span class="activity-to">
                            <i class="fa-solid fa-location-dot"></i> Farmácia Satélite UTI
                        </span>
                    </div>
                </div>
            </div>

            <div class="activity-item">
                <div class="activity-time">09:10</div>
                <div class="activity-icon dispensacao">
                    <i class="fa-solid fa-hand-holding-medical"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">Dispensação de Medicamento</div>
                    <div class="activity-desc">
                        <strong>Omeprazol 20mg</strong> - 30 unidades dispensadas
                    </div>
                    <div class="activity-meta">
                        <span class="activity-user">
                            <i class="fa-solid fa-user"></i> Aux. Pedro Costa
                        </span>
                        <span class="activity-location">
                            <i class="fa-solid fa-hospital"></i> Enfermaria 2B
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="activities-footer">
            <button class="btn-secondary" id="btnCarregarMais">
                <i class="fa-solid fa-rotate"></i>
                Carregar Mais Atividades
            </button>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
* {
    box-sizing: border-box;
}

.filters-section {
    margin-bottom: 1.5rem;
    padding: 1.5rem;
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
}

.filters-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1rem;
    width: 100%;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 0.625rem;
    min-width: 0;
}

.filter-group label {
    font-size: 0.875rem;
    font-weight: 700;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    letter-spacing: 0.2px;
}

.filter-group label i {
    color: var(--primary);
    font-size: 0.75rem;
}

.filter-select,
.filter-input {
    padding: 0.75rem 1rem;
    border: 2px solid var(--border-primary);
    border-radius: 10px;
    background: var(--bg-secondary);
    color: var(--text-primary);
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}

.filter-select:hover,
.filter-input:hover {
    border-color: var(--primary);
    background: var(--surface);
}

.filter-select:focus,
.filter-input:focus {
    outline: none;
    border-color: var(--primary);
    background: var(--surface);
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1), 0 4px 12px rgba(37, 99, 235, 0.15);
    transform: translateY(-1px);
}

.filter-select {
    cursor: pointer;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%232563eb' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 16px 12px;
    padding-right: 2.5rem;
    appearance: none;
}

.search-group {
    min-width: 250px;
}

.activities-summary {
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

.summary-icon.dispensacao { background: var(--primary); }
.summary-icon.entrada { background: var(--success); }
.summary-icon.transferencia { background: #8b5cf6; }
.summary-icon.alerta { background: var(--warning); }

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

.activities-container {
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
    overflow: hidden;
}

.activities-header {
    padding: 1.5rem;
    border-bottom: 1px solid var(--border-primary);
}

.activities-header h3 {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
}

.activities-timeline {
    padding: 1.5rem;
}

.activity-item {
    display: grid;
    grid-template-columns: 60px 48px 1fr;
    gap: 1rem;
    padding: 1.25rem;
    border-left: 2px solid var(--border-primary);
    position: relative;
    margin-bottom: 1rem;
}

.activity-item:last-child {
    margin-bottom: 0;
}

.activity-time {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-tertiary);
    font-family: 'JetBrains Mono', monospace;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
    position: relative;
    z-index: 1;
}

.activity-title {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
}

.activity-desc {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-bottom: 0.5rem;
}

.activity-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    font-size: 0.75rem;
    color: var(--text-tertiary);
}

.activity-meta span {
    display: flex;
    align-items: center;
    gap: 0.375rem;
}

.activity-status.critical {
    color: var(--danger);
    font-weight: 600;
}

.activities-footer {
    padding: 1.5rem;
    border-top: 1px solid var(--border-primary);
    text-align: center;
}

.activities-footer .btn-secondary {
    padding: 0.875rem 2rem;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 0.875rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 2px 8px rgba(37, 99, 235, 0.2);
}

.activities-footer .btn-secondary:hover {
    background: var(--primary-hover);
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
}

.activities-footer .btn-secondary:active {
    transform: translateY(-1px);
}

.activities-footer .btn-secondary:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

.btn-modern {
    padding: 0.875rem 1.75rem;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.875rem;
    letter-spacing: 0.2px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    border: none;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.15);
}

.btn-modern.btn-primary {
    background: linear-gradient(135deg, var(--primary) 0%, #1e40af 100%);
    color: white;
}

.btn-modern.btn-secondary {
    background: var(--surface);
    color: var(--text-primary);
    border: 2px solid var(--border-primary);
}

.btn-modern.btn-secondary:hover {
    background: var(--surface-hover);
    border-color: var(--primary);
}

.loading-container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 3rem;
}

.spinner {
    width: 48px;
    height: 48px;
    border: 4px solid var(--border-primary);
    border-top-color: var(--primary);
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.toast {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    padding: 1rem 1.5rem;
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-lg);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    z-index: 9999;
    animation: slideIn 0.3s ease-out;
}

.toast.success {
    border-left: 4px solid var(--success);
}

.toast.error {
    border-left: 4px solid var(--danger);
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let paginaAtual = 1;
    let carregando = false;

    const filtroTipo = document.getElementById('tipo');
    const filtroPeriodo = document.getElementById('periodo');
    const filtroFuncionario = document.getElementById('funcionario');
    const inputBusca = document.getElementById('busca');
    const btnCarregarMais = document.getElementById('btnCarregarMais');
    const btnExportarRelatorio = document.getElementById('btnExportarRelatorio');
    const btnAtualizarRegistros = document.getElementById('btnAtualizarRegistros');
    const timelineContainer = document.querySelector('.activities-timeline');

    // Carregar dados iniciais
    carregarResumo();
    carregarFuncionarios();
    carregarAtividades(true);

    // Event listeners para filtros
    filtroTipo.addEventListener('change', () => {
        paginaAtual = 1;
        carregarAtividades(true);
    });

    filtroPeriodo.addEventListener('change', () => {
        paginaAtual = 1;
        carregarAtividades(true);
    });

    filtroFuncionario.addEventListener('change', () => {
        paginaAtual = 1;
        carregarAtividades(true);
    });

    // Debounce para busca
    let timeoutBusca;
    inputBusca.addEventListener('input', () => {
        clearTimeout(timeoutBusca);
        timeoutBusca = setTimeout(() => {
            paginaAtual = 1;
            carregarAtividades(true);
        }, 500);
    });

    // Carregar mais atividades
    if (btnCarregarMais) {
        btnCarregarMais.addEventListener('click', () => {
            paginaAtual++;
            carregarAtividades(false);
        });
    }

    // Exportar relatório
    if (btnExportarRelatorio) {
        btnExportarRelatorio.addEventListener('click', exportarRelatorio);
    }

    // Atualizar registros
    if (btnAtualizarRegistros) {
        btnAtualizarRegistros.addEventListener('click', () => {
            paginaAtual = 1;
            carregarAtividades(true);
            showToast('Registros atualizados com sucesso!', 'success');
        });
    }

    async function carregarResumo() {
        try {
            // Simulação de dados
            document.getElementById('totalDispensacoes').textContent = '156';
            document.getElementById('totalEntradas').textContent = '12';
            document.getElementById('totalTransferencias').textContent = '8';
            document.getElementById('totalAlertas').textContent = '3';
        } catch (error) {
            console.error('Erro ao carregar resumo:', error);
        }
    }

    async function carregarFuncionarios() {
        try {
            // Simulação de dados
            const funcionarios = [
                { id: 1, nome: 'Dr. João Silva' },
                { id: 2, nome: 'Maria Santos' },
                { id: 3, nome: 'Carlos Oliveira' }
            ];

            funcionarios.forEach(func => {
                const option = document.createElement('option');
                option.value = func.id;
                option.textContent = func.nome;
                filtroFuncionario.appendChild(option);
            });
        } catch (error) {
            console.error('Erro ao carregar funcionários:', error);
        }
    }

    async function carregarAtividades(limpar = false) {
        if (carregando) return;
        carregando = true;

        if (limpar) {
            timelineContainer.innerHTML = '<div class="loading-container"><div class="spinner"></div></div>';
        }

        try {
            // Simulação de dados
            const atividades = [
                {
                    id: 1,
                    tipo: 'dispensacao',
                    hora: '14:32',
                    titulo: 'Dispensação de Medicamento',
                    descricao: 'Paracetamol 500mg - 20 unidades dispensadas',
                    usuario: 'Dr. João Silva',
                    local: 'Enfermaria 3A',
                    paciente: 'Maria da Silva',
                    status: null
                },
                {
                    id: 2,
                    tipo: 'entrada',
                    hora: '13:15',
                    titulo: 'Entrada de Estoque',
                    descricao: 'Lote Y8405 recebido',
                    usuario: 'Adriano Lata',
                    local: 'Farmácia Central',
                    quantidade: '+45 un',
                    status: null
                },
                {
                    id: 3,
                    tipo: 'alerta',
                    hora: '11:20',
                    titulo: 'Alerta Crítico',
                    descricao: 'Dipirona 1g abaixo do nível mínimo',
                    usuario: 'Sistema',
                    local: 'Estoque Principal',
                    quantidade: '8 unidades',
                    status: 'critical'
                }
            ];

            if (limpar) {
                timelineContainer.innerHTML = '';
            }

            atividades.forEach(ativ => {
                timelineContainer.insertAdjacentHTML('beforeend', criarItemAtividade(ativ));
            });

        } catch (error) {
            console.error('Erro ao carregar atividades:', error);
            showToast('Erro ao carregar atividades', 'error');
        } finally {
            carregando = false;
        }
    }

    function criarItemAtividade(atividade) {
        const icones = {
            'dispensacao': 'fa-pills',
            'entrada': 'fa-arrow-down',
            'transferencia': 'fa-exchange-alt',
            'alerta': 'fa-exclamation-triangle'
        };

        const cores = {
            'dispensacao': 'var(--primary)',
            'entrada': 'var(--success)',
            'transferencia': '#8b5cf6',
            'alerta': 'var(--warning)'
        };

        return `
            <div class="activity-item">
                <div class="activity-time">${atividade.hora}</div>
                <div class="activity-icon" style="background: ${cores[atividade.tipo]}">
                    <i class="fa-solid ${icones[atividade.tipo]}"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">${atividade.titulo}</div>
                    <div class="activity-desc">${atividade.descricao}</div>
                    <div class="activity-meta">
                        <span><i class="fa-solid fa-user"></i> ${atividade.usuario}</span>
                        ${atividade.local ? `<span><i class="fa-solid fa-location-dot"></i> ${atividade.local}</span>` : ''}
                        ${atividade.quantidade ? `<span><i class="fa-solid fa-cube"></i> ${atividade.quantidade}</span>` : ''}
                        ${atividade.paciente ? `<span><i class="fa-solid fa-hospital-user"></i> ${atividade.paciente}</span>` : ''}
                        ${atividade.status === 'critical' ? '<span class="activity-status critical"><i class="fa-solid fa-circle-exclamation"></i> Crítico</span>' : ''}
                    </div>
                </div>
            </div>
        `;
    }

    function exportarRelatorio() {
        const tipo = filtroTipo.value;
        const periodo = filtroPeriodo.value;
        const funcionario = filtroFuncionario.value;

        showToast('Gerando relatório...', 'success');

        setTimeout(() => {
            showToast('Relatório exportado com sucesso!', 'success');
        }, 1500);
    }

    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `
            <i class="fa-solid ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
            <span>${message}</span>
        `;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 3000);
    }
});
</script>
@endpush
