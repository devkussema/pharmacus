@extends('diretor::layout.app')

@section('title', 'Ajuda e Suporte')

@section('content')
<div class="page-header">
    <div class="page-title">
        <h1>Ajuda e Suporte</h1>
        <p>Encontre respostas, tutoriais e entre em contato conosco</p>
    </div>
</div>

<div class="page-content">
    <!-- Barra de Pesquisa de Ajuda -->
    <div class="help-search-section">
        <div class="help-search-box">
            <i class="fa-solid fa-search"></i>
            <input type="text" placeholder="Como podemos ajudá-lo? Busque por funcionalidades, dúvidas...">
            <button class="search-btn">
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
    </div>

    <!-- Ações Rápidas -->
    <div class="quick-help-grid">
        <div class="quick-help-card">
            <div class="quick-help-icon">
                <i class="fa-solid fa-book"></i>
            </div>
            <h3>Documentação</h3>
            <p>Guias completos sobre todas as funcionalidades</p>
            <button class="btn-help">Acessar</button>
        </div>

        <div class="quick-help-card">
            <div class="quick-help-icon">
                <i class="fa-solid fa-video"></i>
            </div>
            <h3>Tutoriais em Vídeo</h3>
            <p>Aprenda visualmente com nossos vídeos</p>
            <button class="btn-help">Assistir</button>
        </div>

        <div class="quick-help-card">
            <div class="quick-help-icon">
                <i class="fa-solid fa-headset"></i>
            </div>
            <h3>Suporte Técnico</h3>
            <p>Fale diretamente com nossa equipe</p>
            <button class="btn-help primary">Contatar</button>
        </div>

        <div class="quick-help-card">
            <div class="quick-help-icon">
                <i class="fa-solid fa-comments"></i>
            </div>
            <h3>Chat ao Vivo</h3>
            <p>Tire dúvidas em tempo real</p>
            <button class="btn-help primary">Iniciar Chat</button>
        </div>
    </div>

    <!-- Perguntas Frequentes -->
    <div class="card">
        <div class="card-header">
            <h3>Perguntas Frequentes (FAQ)</h3>
        </div>
        <div class="card-body">
            <div class="faq-list">
                <div class="faq-item">
                    <button class="faq-question">
                        <span>Como dispensar um medicamento para um paciente?</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Para dispensar um medicamento:</p>
                        <ol>
                            <li>Acesse o menu <strong>Dispensações</strong></li>
                            <li>Clique em "Nova Dispensação"</li>
                            <li>Informe os dados do paciente e prescrição médica</li>
                            <li>Selecione o medicamento e quantidade</li>
                            <li>Confirme o lote e validade</li>
                            <li>Finalize a dispensação</li>
                        </ol>
                        <p>O sistema registrará automaticamente a movimentação no estoque.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>Como configurar alertas de estoque baixo?</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Para configurar alertas:</p>
                        <ol>
                            <li>Vá em <strong>Configurações > Estoque</strong></li>
                            <li>Ajuste os percentuais de nível crítico e atenção</li>
                            <li>Ative as notificações por e-mail em <strong>Configurações > Alertas</strong></li>
                            <li>Adicione os e-mails que devem receber as notificações</li>
                        </ol>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>Como registrar a entrada de novos medicamentos?</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Para registrar entrada:</p>
                        <ol>
                            <li>Acesse <strong>Estoque de Medicamentos</strong></li>
                            <li>Clique em "Registrar Entrada"</li>
                            <li>Informe os dados do fornecedor e nota fiscal</li>
                            <li>Adicione os medicamentos recebidos com lote e validade</li>
                            <li>Verifique as quantidades e confirme</li>
                        </ol>
                        <p>É importante conferir todas as informações antes de confirmar.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>Como gerenciar medicamentos com validade próxima?</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>O sistema alerta automaticamente sobre medicamentos próximos ao vencimento:</p>
                        <ul>
                            <li>Acesse <strong>Alertas Críticos</strong> para ver a lista</li>
                            <li>Medicamentos são ordenados por prioridade (FIFO - First In, First Out)</li>
                            <li>Você pode gerar relatórios de validade em <strong>Relatórios</strong></li>
                            <li>Configure o período de alerta em <strong>Configurações > Estoque</strong></li>
                        </ul>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>Como adicionar novos membros à equipe?</span>
                        <i class="fa-solid fa-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Para cadastrar novos funcionários:</p>
                        <ol>
                            <li>Vá em <strong>Equipe</strong></li>
                            <li>Clique em "Novo Funcionário"</li>
                            <li>Preencha os dados pessoais e profissionais</li>
                            <li>Informe o registro profissional (CRF, TF, etc.)</li>
                            <li>Defina o cargo e permissões</li>
                            <li>Configure o turno de trabalho</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recursos de Aprendizagem -->
    <div class="card">
        <div class="card-header">
            <h3>Recursos de Aprendizagem</h3>
        </div>
        <div class="card-body">
            <div class="learning-grid">
                <div class="learning-item">
                    <div class="learning-icon video">
                        <i class="fa-solid fa-play-circle"></i>
                    </div>
                    <div class="learning-content">
                        <h4>Introdução ao Sistema</h4>
                        <p>Visão geral das funcionalidades principais</p>
                        <span class="learning-duration">
                            <i class="fa-solid fa-clock"></i>
                            8 minutos
                        </span>
                    </div>
                    <button class="btn-learning">Assistir</button>
                </div>

                <div class="learning-item">
                    <div class="learning-icon pdf">
                        <i class="fa-solid fa-file-pdf"></i>
                    </div>
                    <div class="learning-content">
                        <h4>Manual do Usuário</h4>
                        <p>Documentação completa em PDF</p>
                        <span class="learning-duration">
                            <i class="fa-solid fa-download"></i>
                            2.5 MB
                        </span>
                    </div>
                    <button class="btn-learning">Baixar</button>
                </div>

                <div class="learning-item">
                    <div class="learning-icon video">
                        <i class="fa-solid fa-play-circle"></i>
                    </div>
                    <div class="learning-content">
                        <h4>Gestão de Estoque</h4>
                        <p>Como gerenciar medicamentos eficientemente</p>
                        <span class="learning-duration">
                            <i class="fa-solid fa-clock"></i>
                            12 minutos
                        </span>
                    </div>
                    <button class="btn-learning">Assistir</button>
                </div>

                <div class="learning-item">
                    <div class="learning-icon video">
                        <i class="fa-solid fa-play-circle"></i>
                    </div>
                    <div class="learning-content">
                        <h4>Dispensação Segura</h4>
                        <p>Boas práticas na dispensação de medicamentos</p>
                        <span class="learning-duration">
                            <i class="fa-solid fa-clock"></i>
                            15 minutos
                        </span>
                    </div>
                    <button class="btn-learning">Assistir</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Contato e Suporte -->
    <div class="support-section">
        <div class="card">
            <div class="card-header">
                <h3>Entre em Contato</h3>
            </div>
            <div class="card-body">
                <div class="contact-grid">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="contact-info">
                            <h4>Telefone</h4>
                            <p>+244 222 123 456</p>
                            <small>Seg-Sex: 8h-18h</small>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="contact-info">
                            <h4>E-mail</h4>
                            <p>suporte@pharmacus.ao</p>
                            <small>Resposta em até 24h</small>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div class="contact-info">
                            <h4>WhatsApp</h4>
                            <p>+244 923 456 789</p>
                            <small>Seg-Sex: 8h-18h</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Informações do Sistema</h3>
            </div>
            <div class="card-body">
                <div class="system-info-grid">
                    <div class="system-info-item">
                        <label>Versão</label>
                        <p>2.4.1</p>
                    </div>
                    <div class="system-info-item">
                        <label>Última Atualização</label>
                        <p>01 de Novembro, 2025</p>
                    </div>
                    <div class="system-info-item">
                        <label>Licença</label>
                        <p>Enterprise</p>
                    </div>
                    <div class="system-info-item">
                        <label>Suporte Técnico</label>
                        <p>24/7 Prioritário</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.help-search-section {
    margin-bottom: 2rem;
}

.help-search-box {
    position: relative;
    max-width: 800px;
    margin: 0 auto;
}

.help-search-box i {
    position: absolute;
    left: 1.5rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-tertiary);
    font-size: 1.25rem;
}

.help-search-box input {
    width: 100%;
    padding: 1.25rem 5rem 1.25rem 4rem;
    border: 2px solid var(--border-primary);
    border-radius: var(--border-radius);
    background: var(--surface);
    color: var(--text-primary);
    font-size: 1rem;
    transition: all var(--transition-fast);
}

.help-search-box input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
}

.search-btn {
    position: absolute;
    right: 0.5rem;
    top: 50%;
    transform: translateY(-50%);
    width: 48px;
    height: 48px;
    border: none;
    border-radius: var(--border-radius-sm);
    background: var(--primary);
    color: white;
    font-size: 1rem;
    cursor: pointer;
    transition: all var(--transition-fast);
}

.search-btn:hover {
    background: #1d4ed8;
}

.quick-help-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.quick-help-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: 2rem 1.5rem;
    background: var(--surface);
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius);
    transition: all var(--transition-normal);
}

.quick-help-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
    border-color: var(--primary);
}

.quick-help-icon {
    width: 64px;
    height: 64px;
    border-radius: var(--border-radius);
    background: linear-gradient(135deg, var(--primary) 0%, #1d4ed8 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    margin-bottom: 1rem;
}

.quick-help-card h3 {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 0.5rem 0;
}

.quick-help-card p {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0 0 1rem 0;
}

.btn-help {
    padding: 0.5rem 1.5rem;
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    background: var(--bg-secondary);
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all var(--transition-fast);
}

.btn-help:hover {
    background: var(--surface-hover);
    color: var(--text-primary);
}

.btn-help.primary {
    background: var(--primary);
    color: white;
    border-color: var(--primary);
}

.btn-help.primary:hover {
    background: #1d4ed8;
}

.faq-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.faq-item {
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    overflow: hidden;
}

.faq-question {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 1.25rem;
    background: var(--bg-secondary);
    border: none;
    color: var(--text-primary);
    font-size: 0.9375rem;
    font-weight: 500;
    text-align: left;
    cursor: pointer;
    transition: all var(--transition-fast);
}

.faq-question:hover {
    background: var(--surface-hover);
}

.faq-question i {
    color: var(--text-tertiary);
    transition: transform var(--transition-fast);
}

.faq-item.open .faq-question i {
    transform: rotate(180deg);
}

.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height var(--transition-normal);
}

.faq-item.open .faq-answer {
    max-height: 500px;
}

.faq-answer p, .faq-answer ol, .faq-answer ul {
    padding: 0 1.25rem 1rem;
    margin: 0;
    font-size: 0.9375rem;
    color: var(--text-secondary);
    line-height: 1.6;
}

.faq-answer ol {
    padding-left: 2.5rem;
}

.learning-grid {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.learning-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border: 1px solid var(--border-primary);
    border-radius: var(--border-radius-sm);
    transition: background var(--transition-fast);
}

.learning-item:hover {
    background: var(--bg-secondary);
}

.learning-icon {
    width: 56px;
    height: 56px;
    border-radius: var(--border-radius);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    flex-shrink: 0;
}

.learning-icon.video {
    background: #ef4444;
}

.learning-icon.pdf {
    background: #dc2626;
}

.learning-content {
    flex: 1;
}

.learning-content h4 {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 0.25rem 0;
}

.learning-content p {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0 0 0.5rem 0;
}

.learning-duration {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.75rem;
    color: var(--text-tertiary);
}

.learning-duration i {
    font-size: 0.625rem;
}

.btn-learning {
    padding: 0.5rem 1rem;
    border: 1px solid var(--primary);
    border-radius: var(--border-radius-sm);
    background: transparent;
    color: var(--primary);
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all var(--transition-fast);
}

.btn-learning:hover {
    background: var(--primary);
    color: white;
}

.support-section {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

@media (max-width: 768px) {
    .support-section {
        grid-template-columns: 1fr;
    }
}

.contact-grid {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem;
    background: var(--bg-secondary);
    border-radius: var(--border-radius-sm);
}

.contact-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--border-radius);
    background: var(--primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.contact-info h4 {
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 0.25rem 0;
}

.contact-info p {
    font-size: 1rem;
    font-weight: 500;
    color: var(--primary);
    margin: 0 0 0.25rem 0;
}

.contact-info small {
    font-size: 0.75rem;
    color: var(--text-tertiary);
}

.system-info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

.system-info-item label {
    display: block;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--text-tertiary);
    margin-bottom: 0.5rem;
}

.system-info-item p {
    font-size: 0.9375rem;
    font-weight: 500;
    color: var(--text-primary);
    margin: 0;
}
</style>
@endpush

@push('scripts')
<script>
// FAQ Toggle
document.querySelectorAll('.faq-question').forEach(btn => {
    btn.addEventListener('click', function() {
        const item = this.closest('.faq-item');
        const isOpen = item.classList.contains('open');
        
        // Fechar todos
        document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
        
        // Abrir o clicado se estava fechado
        if (!isOpen) {
            item.classList.add('open');
        }
    });
});
</script>
@endpush
