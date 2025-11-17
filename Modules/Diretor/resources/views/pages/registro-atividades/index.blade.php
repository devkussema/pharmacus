@extends('diretor::layout.app')

@section('title', 'Registro de Atividades')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Registro de Atividades</h1>
        <p>Histórico de dispensações, movimentações e operações</p>
    </div>
    <div class="page-actions">
        <button class="btn-export" id="btnExportar">
            <i class="fa-solid fa-file-export me-2"></i>
            Exportar Relatório
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
                    <option value="entrada">Entrada</option>
                    <option value="transferencia">Transferência</option>
                    <option value="ajuste">Ajuste de Inventário</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="periodo"><i class="fa-solid fa-calendar me-2"></i>Período</label>
                <select id="periodo" class="filter-select">
                    <option value="hoje">Hoje</option>
                    <option value="semana">Última Semana</option>
                    <option value="mes">Último Mês</option>
                    <option value="trimestre">Último Trimestre</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="funcionario"><i class="fa-solid fa-user me-2"></i>Funcionário</label>
                <select id="funcionario" class="filter-select">
                    <option value="">Todos os Funcionários</option>
                    <option value="1">Dr. João Silva</option>
                    <option value="2">Téc. Maria Santos</option>
                    <option value="3">Aux. Pedro Costa</option>
                </select>
            </div>
            <div class="filter-group search-group">
                <label for="busca"><i class="fa-solid fa-search me-2"></i>Buscar</label>
                <input type="text" id="busca" class="filter-input" placeholder="Medicamento, paciente, funcionário...">
            </div>
        </div>
    </div>

    <!-- Resumo de Atividades -->
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

.btn-export {
    padding: 0.75rem 1.5rem;
    background: var(--success);
    color: white;
    border: none;
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--transition-fast);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    box-shadow: 0 2px 4px rgba(34, 197, 94, 0.2);
}

.btn-export:hover {
    background: #16a34a;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(34, 197, 94, 0.3);
}

.btn-export:active {
    transform: translateY(0);
}

.filters-section {
    margin-bottom: 1.5rem;
    padding: 1.25rem;
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
}

.filters-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    width: 100%;
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    min-width: 0;
}

.filter-group label {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-primary);
    display: flex;
    align-items: center;
}

.filter-group label i {
    color: var(--text-tertiary);
    font-size: 0.75rem;
}

.filter-select,
.filter-input {
    padding: 0.625rem 0.875rem;
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    background: var(--bg-secondary);
    color: var(--text-primary);
    font-size: 0.875rem;
    transition: all var(--transition-fast);
}

.filter-select:focus,
.filter-input:focus {
    outline: none;
    border-color: var(--primary);
    background: var(--surface);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
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
    padding: 0.75rem 1.5rem;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: var(--border-radius-sm);
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--transition-fast);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.activities-footer .btn-secondary:hover {
    background: var(--primary-hover);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.activities-footer .btn-secondary:active {
    transform: translateY(0);
}

.activities-footer .btn-secondary:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
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
    const btnExportar = document.getElementById('btnExportar');
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
    btnCarregarMais.addEventListener('click', () => {
        paginaAtual++;
        carregarAtividades(false);
    });

    // Exportar relatório
    btnExportar.addEventListener('click', () => {
        showToast('Exportando relatório...', 'info');
        // TODO: Implementar exportação real
        setTimeout(() => {
            showToast('Funcionalidade de exportação em desenvolvimento', 'warning');
        }, 1000);
    });

    /**
     * Carrega resumo de estatísticas
     */
    async function carregarResumo() {
        try {
            const response = await fetch('{{ route('diretor.registro-atividades.resumo') }}');
            const data = await response.json();

            if (data.success) {
                document.querySelectorAll('.summary-value')[0].textContent = data.resumo.dispensacoes;
                document.querySelectorAll('.summary-value')[1].textContent = data.resumo.entradas;
                document.querySelectorAll('.summary-value')[2].textContent = data.resumo.transferencias;
                document.querySelectorAll('.summary-value')[3].textContent = data.resumo.alertas;
            }
        } catch (error) {
            console.error('Erro ao carregar resumo:', error);
        }
    }

    /**
     * Carrega lista de funcionários
     */
    async function carregarFuncionarios() {
        try {
            const response = await fetch('{{ route('diretor.registro-atividades.funcionarios') }}');
            const data = await response.json();

            if (data.success) {
                const opcaoTodos = filtroFuncionario.querySelector('option[value=""]');
                filtroFuncionario.innerHTML = '';
                filtroFuncionario.appendChild(opcaoTodos);

                data.funcionarios.forEach(func => {
                    const option = document.createElement('option');
                    option.value = func.id;
                    option.textContent = func.nome;
                    filtroFuncionario.appendChild(option);
                });
            }
        } catch (error) {
            console.error('Erro ao carregar funcionários:', error);
        }
    }

    /**
     * Carrega atividades com filtros
     */
    async function carregarAtividades(limpar = false) {
        if (carregando) return;
        carregando = true;

        if (limpar) {
            timelineContainer.innerHTML = '<div class="loading-container"><div class="spinner"></div></div>';
        } else {
            btnCarregarMais.disabled = true;
            btnCarregarMais.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Carregando...';
        }

        try {
            const params = new URLSearchParams({
                tipo: filtroTipo.value,
                periodo: filtroPeriodo.value,
                funcionario: filtroFuncionario.value,
                busca: inputBusca.value,
                pagina: paginaAtual
            });

            const response = await fetch(`{{ route('diretor.registro-atividades.listar') }}?${params}`);
            const data = await response.json();

            if (data.success) {
                if (limpar) {
                    timelineContainer.innerHTML = '';
                }

                data.atividades.forEach(atividade => {
                    timelineContainer.innerHTML += criarItemAtividade(atividade);
                });

                // Controlar botão "Carregar Mais"
                if (data.temMais) {
                    btnCarregarMais.style.display = 'inline-flex';
                    btnCarregarMais.disabled = false;
                    btnCarregarMais.innerHTML = '<i class="fa-solid fa-rotate"></i> Carregar Mais Atividades';
                } else {
                    btnCarregarMais.style.display = 'none';
                }
            } else {
                showToast(data.message, 'error');
            }
        } catch (error) {
            console.error('Erro ao carregar atividades:', error);
            showToast('Erro ao carregar atividades', 'error');
        } finally {
            carregando = false;
        }
    }

    /**
     * Cria HTML para item de atividade
     */
    function criarItemAtividade(atividade) {
        const icones = {
            'dispensacao': 'fa-hand-holding-medical',
            'entrada': 'fa-box-open',
            'transferencia': 'fa-arrow-right-arrow-left',
            'alerta': 'fa-exclamation-triangle'
        };

        let metaHtml = '';

        if (atividade.usuario) {
            metaHtml += `<span class="activity-user">
                <i class="fa-solid fa-user"></i> ${atividade.usuario}
            </span>`;
        }

        if (atividade.localizacao) {
            metaHtml += `<span class="activity-location">
                <i class="fa-solid fa-hospital"></i> ${atividade.localizacao}
            </span>`;
        }

        if (atividade.fornecedor) {
            metaHtml += `<span class="activity-supplier">
                <i class="fa-solid fa-truck"></i> ${atividade.fornecedor}
            </span>`;
        }

        if (atividade.status) {
            metaHtml += `<span class="activity-status ${atividade.status}">
                <i class="fa-solid fa-bell"></i> ${atividade.status_texto}
            </span>`;
        }

        return `
            <div class="activity-item">
                <div class="activity-time">${atividade.hora}</div>
                <div class="activity-icon ${atividade.tipo}">
                    <i class="fa-solid ${icones[atividade.tipo] || 'fa-circle'}"></i>
                </div>
                <div class="activity-content">
                    <div class="activity-title">${atividade.titulo}</div>
                    <div class="activity-desc">${atividade.descricao}</div>
                    <div class="activity-meta">${metaHtml}</div>
                </div>
            </div>
        `;
    }

    /**
     * Exibe toast de notificação
     */
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.innerHTML = `
            <i class="fa-solid ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
            <span>${message}</span>
        `;

        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.animation = 'slideOut 0.3s ease-out';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
});
</script>
@endpush
