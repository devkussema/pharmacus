<style>
    .offcanvas-historico {
        width: 700px !important;
    }

    .offcanvas-historico .offcanvas-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        padding: 20px 25px;
    }

    .offcanvas-historico .offcanvas-title {
        font-size: 1.3rem;
        font-weight: 600;
    }

    .offcanvas-historico .btn-close {
        filter: brightness(0) invert(1);
    }

    .offcanvas-historico .offcanvas-body {
        padding: 0;
        background: #f8f9fa;
    }

    .timeline-container {
        padding: 25px;
    }

    .timeline {
        position: relative;
        padding-left: 40px;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
    }

    .timeline-item {
        position: relative;
        margin-bottom: 30px;
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .timeline-item:hover {
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
        transform: translateX(5px);
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: -30px;
        top: 25px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #fff;
        border: 3px solid #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
    }

    .timeline-item.action-create::before {
        border-color: #28a745;
        box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.2);
    }

    .timeline-item.action-update::before {
        border-color: #17a2b8;
        box-shadow: 0 0 0 3px rgba(23, 162, 184, 0.2);
    }

    .timeline-item.action-delete::before {
        border-color: #dc3545;
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.2);
    }

    .timeline-item.action-view::before {
        border-color: #ffc107;
        box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.2);
    }

    .timeline-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e9ecef;
    }

    .timeline-action {
        font-weight: 600;
        font-size: 0.95rem;
        color: #333;
    }

    .timeline-date {
        font-size: 0.85rem;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .timeline-body {
        margin-bottom: 10px;
    }

    .timeline-text {
        color: #555;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .timeline-user {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.85rem;
        color: #6c757d;
        margin-top: 10px;
    }

    .timeline-user i {
        color: #667eea;
    }

    .timeline-changes {
        margin-top: 12px;
        padding: 12px;
        background: #f8f9fa;
        border-radius: 6px;
        font-size: 0.85rem;
    }

    .timeline-changes h6 {
        font-size: 0.9rem;
        font-weight: 600;
        color: #667eea;
        margin-bottom: 8px;
    }

    .change-item {
        padding: 5px 0;
        border-bottom: 1px solid #e9ecef;
    }

    .change-item:last-child {
        border-bottom: none;
    }

    .change-label {
        font-weight: 600;
        color: #555;
    }

    .change-value {
        color: #666;
    }

    .change-value.old {
        text-decoration: line-through;
        color: #dc3545;
    }

    .change-value.new {
        color: #28a745;
        font-weight: 500;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 4rem;
        color: #dee2e6;
        margin-bottom: 20px;
    }

    .empty-state h5 {
        color: #495057;
        margin-bottom: 10px;
    }

    .action-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
    }

    .action-badge.create {
        background: #d4edda;
        color: #155724;
    }

    .action-badge.update {
        background: #d1ecf1;
        color: #0c5460;
    }

    .action-badge.delete {
        background: #f8d7da;
        color: #721c24;
    }

    .action-badge.view {
        background: #fff3cd;
        color: #856404;
    }

    .action-badge.list {
        background: #e7e7ff;
        color: #4c4caa;
    }
</style>

<div class="offcanvas offcanvas-end offcanvas-historico" tabindex="-1" id="offcanvasHistoricoFornecedor">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">
            <i class="fas fa-history me-2"></i>Histórico de Atividades
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="timeline-container">
            <div id="timelineHistorico" class="timeline">
                <!-- Timeline items serão inseridos via JavaScript -->
            </div>
            <div id="emptyHistorico" class="empty-state" style="display: none;">
                <i class="fas fa-clock"></i>
                <h5>Nenhuma atividade registrada</h5>
                <p>Ainda não há histórico disponível para este fornecedor.</p>
            </div>
        </div>
    </div>
</div>

<script>
    /**
     * Popula o offcanvas de histórico com as atividades do fornecedor.
     *
     * @param {Array} atividades Lista de atividades
     */
    function popularOffcanvasHistorico(atividades) {
        const timeline = $('#timelineHistorico');
        const emptyState = $('#emptyHistorico');
        
        timeline.empty();
        
        if (!atividades || atividades.length === 0) {
            timeline.hide();
            emptyState.show();
            return;
        }
        
        timeline.show();
        emptyState.hide();
        
        atividades.forEach(atividade => {
            const item = criarTimelineItem(atividade);
            timeline.append(item);
        });
    }

    /**
     * Cria um item de timeline para uma atividade.
     *
     * @param {Object} atividade Dados da atividade
     * @returns {jQuery} Elemento jQuery do item
     */
    function criarTimelineItem(atividade) {
        const actionClass = atividade.action ? `action-${atividade.action}` : '';
        const actionBadge = obterActionBadge(atividade.action);
        const dataFormatada = formatarData(atividade.created_at);
        const changes = atividade.changes ? renderizarMudancas(atividade.changes) : '';
        
        return $(`
            <div class="timeline-item ${actionClass}">
                <div class="timeline-header">
                    <div class="timeline-action">
                        ${actionBadge}
                    </div>
                    <div class="timeline-date">
                        <i class="far fa-clock"></i>
                        ${dataFormatada}
                    </div>
                </div>
                <div class="timeline-body">
                    <p class="timeline-text">${atividade.texto}</p>
                </div>
                <div class="timeline-user">
                    <i class="fas fa-user"></i>
                    <span>${atividade.user_name || 'Sistema'}</span>
                    ${atividade.actor_role ? `<span class="badge bg-secondary">${atividade.actor_role}</span>` : ''}
                </div>
                ${changes}
            </div>
        `);
    }

    /**
     * Retorna o badge HTML para o tipo de ação.
     *
     * @param {string} action Tipo de ação
     * @returns {string} HTML do badge
     */
    function obterActionBadge(action) {
        const badges = {
            'create': '<span class="action-badge create"><i class="fas fa-plus-circle me-1"></i>Criação</span>',
            'update': '<span class="action-badge update"><i class="fas fa-edit me-1"></i>Atualização</span>',
            'delete': '<span class="action-badge delete"><i class="fas fa-trash me-1"></i>Exclusão</span>',
            'view': '<span class="action-badge view"><i class="fas fa-eye me-1"></i>Visualização</span>',
            'list': '<span class="action-badge list"><i class="fas fa-list me-1"></i>Listagem</span>'
        };
        
        return badges[action] || '<span class="action-badge"><i class="fas fa-info-circle me-1"></i>Atividade</span>';
    }

    /**
     * Formata a data para exibição.
     *
     * @param {string} dateString Data no formato ISO
     * @returns {string} Data formatada
     */
    function formatarData(dateString) {
        const data = new Date(dateString);
        const agora = new Date();
        const diff = agora - data;
        const minutos = Math.floor(diff / 60000);
        const horas = Math.floor(diff / 3600000);
        const dias = Math.floor(diff / 86400000);
        
        if (minutos < 1) return 'Agora mesmo';
        if (minutos < 60) return `Há ${minutos} minuto${minutos > 1 ? 's' : ''}`;
        if (horas < 24) return `Há ${horas} hora${horas > 1 ? 's' : ''}`;
        if (dias < 7) return `Há ${dias} dia${dias > 1 ? 's' : ''}`;
        
        return data.toLocaleDateString('pt-PT', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }

    /**
     * Renderiza as mudanças de uma atividade de atualização.
     *
     * @param {Object} changes Objeto com as mudanças
     * @returns {string} HTML das mudanças
     */
    function renderizarMudancas(changes) {
        if (!changes || typeof changes !== 'object' || Object.keys(changes).length === 0) {
            return '';
        }
        
        let html = '<div class="timeline-changes"><h6>Alterações:</h6>';
        
        for (const [campo, valores] of Object.entries(changes)) {
            if (valores && typeof valores === 'object' && valores.antigo !== undefined) {
                html += `
                    <div class="change-item">
                        <span class="change-label">${formatarNomeCampo(campo)}:</span><br>
                        <span class="change-value old">${valores.antigo || '(vazio)'}</span>
                        →
                        <span class="change-value new">${valores.novo || '(vazio)'}</span>
                    </div>
                `;
            }
        }
        
        html += '</div>';
        return html;
    }

    /**
     * Formata o nome do campo para exibição.
     *
     * @param {string} campo Nome do campo
     * @returns {string} Nome formatado
     */
    function formatarNomeCampo(campo) {
        const nomes = {
            'nome': 'Nome',
            'nif': 'NIF',
            'email': 'Email',
            'telefone': 'Telefone',
            'telemovel': 'Telemóvel',
            'whatsapp': 'WhatsApp',
            'endereco': 'Endereço',
            'cidade': 'Cidade',
            'provincia': 'Província',
            'pais': 'País',
            'tipo': 'Tipo',
            'status': 'Status',
            'avaliacao': 'Avaliação',
            'pessoa_contacto': 'Pessoa de Contacto',
            'cargo_contacto': 'Cargo',
            'website': 'Website',
            'banco': 'Banco',
            'conta_bancaria': 'Conta Bancária',
            'iban': 'IBAN',
            'observacoes': 'Observações'
        };
        
        return nomes[campo] || campo.charAt(0).toUpperCase() + campo.slice(1).replace('_', ' ');
    }
</script>
