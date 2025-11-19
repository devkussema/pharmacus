{{--
    Offcanvas de Detalhes do Produto Premium
    Design moderno com todas as informações do produto
    Autor: Augusto Kussema
    Data: 18/11/2025
--}}

<div class="offcanvas offcanvas-end offcanvas-details-premium" tabindex="-1" id="productDetailsOffcanvas" aria-labelledby="productDetailsLabel">
    <div class="offcanvas-header">
        <div>
            <h5 class="offcanvas-title" id="productDetailsLabel">
                <i class="fas fa-pills me-2"></i>Detalhes do Produto
            </h5>
            <small class="text-white-50">Informação completa do estoque</small>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div id="productDetailsContent">
            <div class="loading-state">
                <div class="loading-spinner"></div>
                <p class="mt-3 text-muted fw-semibold">Carregando detalhes...</p>
            </div>
        </div>
    </div>
</div>

<style>
    /* ========== Offcanvas Premium Design ========== */
    .offcanvas-details-premium {
        --bs-offcanvas-width: min(600px, 90vw) !important;
        box-shadow: -8px 0 32px rgba(0,0,0,0.15);
    }

    .offcanvas-details-premium .offcanvas-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.75rem;
        position: sticky;
        top: 0;
        z-index: 100;
        border: none;
    }

    .offcanvas-details-premium .offcanvas-title {
        font-size: 1.375rem;
        font-weight: 700;
        margin: 0;
    }

    .offcanvas-details-premium .offcanvas-body {
        background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
        padding: 0;
    }

    /* Loading State */
    .loading-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 4rem 2rem;
    }

    .loading-spinner {
        width: 60px;
        height: 60px;
        border: 4px solid #e9ecef;
        border-top-color: #667eea;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Content Container */
    #productDetailsContent {
        padding: 1.25rem;
    }

    /* Stats Cards no Topo */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-bottom: 1.25rem;
    }

    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        border-radius: 16px;
        text-align: center;
        box-shadow: 0 8px 24px rgba(102, 126, 234, 0.25);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -30%;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }

    .stat-card .stat-value {
        font-size: 2.25rem;
        font-weight: 800;
        margin-bottom: 0.25rem;
        position: relative;
        z-index: 1;
    }

    .stat-card .stat-label {
        font-size: 0.8125rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
        position: relative;
        z-index: 1;
    }

    .stat-card.secondary {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    }

    /* Section Styles */
    .detail-section {
        background: white;
        border-radius: 16px;
        padding: 1.75rem;
        margin-bottom: 1rem;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        border: 1px solid #e9ecef;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .detail-section:hover {
        box-shadow: 0 8px 28px rgba(102, 126, 234, 0.15);
        transform: translateY(-2px);
    }

    .detail-section h6 {
        color: #667eea;
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 3px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .detail-section h6 i {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 10px;
        font-size: 1rem;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    /* Detail Items */
    .detail-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-item:hover {
        background: linear-gradient(90deg, transparent 0%, rgba(102, 126, 234, 0.03) 100%);
        padding-left: 0.75rem;
        padding-right: 0.75rem;
        margin-left: -0.75rem;
        margin-right: -0.75rem;
        border-radius: 8px;
    }

    .detail-label {
        font-weight: 600;
        color: #4a5568;
        font-size: 0.9375rem;
        display: flex;
        align-items: center;
        gap: 0.625rem;
    }

    .detail-label i {
        color: #94a3b8;
        font-size: 1rem;
        width: 20px;
    }

    .detail-value {
        font-weight: 700;
        color: #1a202c;
        text-align: right;
        font-size: 0.9375rem;
    }

    .detail-value.highlight {
        color: #667eea;
        font-size: 1.125rem;
    }

    /* Badges */
    .badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.8125rem;
        letter-spacing: 0.3px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .badge.bg-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
    }

    .badge.bg-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
    }

    .badge.bg-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
        color: white !important;
    }

    /* Expiry Alert */
    .expiry-alert {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.25rem;
        border-radius: 12px;
        margin-bottom: 1.25rem;
        font-weight: 600;
        font-size: 0.9375rem;
        border-left: 5px solid;
    }

    .expiry-alert i {
        font-size: 1.5rem;
    }

    .expiry-alert.critical {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #991b1b;
        border-color: #dc2626;
    }

    .expiry-alert.warning {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        color: #92400e;
        border-color: #f59e0b;
    }

    .expiry-alert.good {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        border-color: #10b981;
    }

    /* Obs Box */
    .obs-box {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        border-left: 5px solid #667eea;
        padding: 1.25rem;
        border-radius: 12px;
        font-size: 0.9375rem;
        color: #334155;
        font-style: italic;
        box-shadow: 0 2px 12px rgba(102, 126, 234, 0.1);
        line-height: 1.6;
    }

    .obs-box i {
        color: #667eea;
        margin: 0 0.375rem;
    }

    /* Info Box */
    .info-box {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 2px dashed #cbd5e0;
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        color: #64748b;
    }

    .info-box i {
        font-size: 2.5rem;
        margin-bottom: 0.75rem;
        color: #94a3b8;
        display: block;
    }

    /* Error State */
    .error-state {
        text-align: center;
        padding: 3rem 2rem;
    }

    .error-state i {
        font-size: 4rem;
        color: #f59e0b;
        margin-bottom: 1rem;
    }

    .error-state .btn {
        margin-top: 1rem;
    }
</style>

<script>
$(document).ready(function() {
    // Handler para abrir detalhes
    $(document).on('click', '.btn-detalhes', function() {
        const produtoId = $(this).data('id');

        // Abrir offcanvas
        const offcanvas = new bootstrap.Offcanvas(document.getElementById('productDetailsOffcanvas'));
        offcanvas.show();

        // Loading state
        $('#productDetailsContent').html(`
            <div class="loading-state">
                <div class="loading-spinner"></div>
                <p class="mt-3 text-muted fw-semibold">Carregando detalhes...</p>
            </div>
        `);

        // Buscar detalhes via AJAX
        $.ajax({
            url: `/estoque/produto/${produtoId}/detalhes`,
            method: 'GET',
            success: function(response) {
                if (response.success && response.produto) {
                    renderProductDetails(response.produto);
                } else {
                    showError('Não foi possível carregar os detalhes do produto.');
                }
            },
            error: function(xhr) {
                console.error('Erro ao buscar detalhes:', xhr);
                showError('Erro ao carregar detalhes. Tente novamente.');
            }
        });
    });

    function renderProductDetails(produto) {
        const expiryInfo = calculateExpiry(produto.data_expiracao);

        let html = `
            <div style="padding: 1.25rem;">
                ${expiryInfo.html}

                <!-- Stats Cards -->
                <div class="stats-row">
                    <div class="stat-card">
                        <div class="stat-value">${produto.quantidade || 0}</div>
                        <div class="stat-label">Quantidade Total</div>
                    </div>
                    <div class="stat-card secondary">
                        <div class="stat-value">${produto.saldo?.qtd || 0}</div>
                        <div class="stat-label">Saldo Disponível</div>
                    </div>
                </div>

                <!-- Identificação -->
                <div class="detail-section">
                    <h6><i class="fas fa-pills"></i>Identificação</h6>
                    <div class="detail-item">
                        <span class="detail-label"><i class="fas fa-tag"></i> Designação:</span>
                        <span class="detail-value">${produto.designacao || '-'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label"><i class="fas fa-prescription-bottle"></i> Dosagem:</span>
                        <span class="detail-value">${produto.dosagem || '-'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label"><i class="fas fa-flask"></i> Forma:</span>
                        <span class="detail-value">${produto.forma || '-'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label"><i class="fas fa-layer-group"></i> Tipo:</span>
                        <span class="detail-value">${formatTipo(produto.tipo)}</span>
                    </div>
                </div>

                <!-- Classificação -->
                <div class="detail-section">
                    <h6><i class="fas fa-sitemap"></i>Classificação</h6>
                    <div class="detail-item">
                        <span class="detail-label"><i class="fas fa-capsules"></i> Grupo Farmacológico:</span>
                        <span class="detail-value">${produto.grupo_farmaco?.designacao || 'Não classificado'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label"><i class="fas fa-info-circle"></i> Status:</span>
                        <span class="detail-value">${getStatusBadge(produto.status_stock)}</span>
                    </div>
                </div>

                <!-- Localização -->
                <div class="detail-section">
                    <h6><i class="fas fa-map-marker-alt"></i>Localização e Rastreamento</h6>
                    <div class="detail-item">
                        <span class="detail-label"><i class="fas fa-hospital"></i> Área Hospitalar:</span>
                        <span class="detail-value">${produto.estoque?.area_hospitalar?.nome || '-'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label"><i class="fas fa-warehouse"></i> Prateleira:</span>
                        <span class="detail-value">${produto.prateleira?.designacao || 'Não atribuída'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label"><i class="fas fa-barcode"></i> Lote:</span>
                        <span class="detail-value highlight">${produto.num_lote || '-'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label"><i class="fas fa-file-alt"></i> Documento Nº:</span>
                        <span class="detail-value">${produto.num_documento || 'N/A'}</span>
                    </div>
                </div>

                <!-- Datas -->
                <div class="detail-section">
                    <h6><i class="fas fa-calendar-alt"></i>Datas Importantes</h6>
                    <div class="detail-item">
                        <span class="detail-label"><i class="fas fa-industry"></i> Produção:</span>
                        <span class="detail-value">${formatDate(produto.data_producao)}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label"><i class="fas fa-exclamation-triangle"></i> Expiração:</span>
                        <span class="detail-value" style="color: ${expiryInfo.color}; font-weight: 800;">
                            ${formatDate(produto.data_expiracao)}
                        </span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label"><i class="fas fa-truck-loading"></i> Recepção:</span>
                        <span class="detail-value">${formatDate(produto.data_recepcao)}</span>
                    </div>
                </div>
        `;

        // Observações
        if (produto.obs && produto.obs.trim() !== '') {
            html += `
                <div class="detail-section">
                    <h6><i class="fas fa-comment"></i>Observações</h6>
                    <div class="obs-box">
                        <i class="fas fa-quote-left"></i>${produto.obs}<i class="fas fa-quote-right"></i>
                    </div>
                </div>
            `;
        }

        html += `</div>`;
        $('#productDetailsContent').html(html);
    }

    function calculateExpiry(expirationDate) {
        if (!expirationDate) return { html: '', color: '#6b7280' };

        const today = new Date();
        const expiry = new Date(expirationDate);
        const diffDays = Math.ceil((expiry - today) / (1000 * 60 * 60 * 24));

        let alertClass, icon, message, color;

        if (diffDays < 0) {
            alertClass = 'critical';
            icon = 'fa-times-circle';
            message = `Produto EXPIRADO há ${Math.abs(diffDays)} dias`;
            color = '#dc2626';
        } else if (diffDays <= 30) {
            alertClass = 'critical';
            icon = 'fa-exclamation-triangle';
            message = `Expira em ${diffDays} dias - CRÍTICO`;
            color = '#dc2626';
        } else if (diffDays <= 90) {
            alertClass = 'warning';
            icon = 'fa-exclamation-circle';
            message = `Expira em ${diffDays} dias - Atenção necessária`;
            color = '#f59e0b';
        } else {
            alertClass = 'good';
            icon = 'fa-check-circle';
            message = `Validade OK - ${diffDays} dias restantes`;
            color = '#10b981';
        }

        return {
            html: `<div class="expiry-alert ${alertClass}"><i class="fas ${icon}"></i><span>${message}</span></div>`,
            color: color
        };
    }

    function formatTipo(tipo) {
        const tipos = {
            'medicamento': 'Medicamento',
            'descartável': 'Descartável',
            'liquido': 'Líquido'
        };
        return tipos[tipo] || tipo || '-';
    }

    function getStatusBadge(status) {
        if (!status) return '<span class="badge bg-secondary">Indefinido</span>';

        const statusMap = {
            'Estável': { color: 'success', icon: 'fa-check-circle' },
            'Máximo': { color: 'success', icon: 'fa-arrow-up' },
            'Médio': { color: 'warning', icon: 'fa-minus-circle' },
            'Mínimo': { color: 'warning', icon: 'fa-arrow-down' },
            'Crítico': { color: 'danger', icon: 'fa-exclamation-triangle' },
            'Esgotado': { color: 'danger', icon: 'fa-times-circle' }
        };

        const statusInfo = statusMap[status.designacao] || { color: 'secondary', icon: 'fa-question-circle' };
        return `<span class="badge bg-${statusInfo.color}"><i class="fas ${statusInfo.icon} me-1"></i>${status.designacao}</span>`;
    }

    function formatDate(dateString) {
        if (!dateString) return '<span class="text-muted">-</span>';
        const date = new Date(dateString);
        return date.toLocaleDateString('pt-PT', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        });
    }

    function showError(message) {
        $('#productDetailsContent').html(`
            <div class="error-state">
                <i class="fas fa-exclamation-triangle"></i>
                <p class="text-muted fw-bold mb-0">${message}</p>
                <button class="btn btn-sm btn-outline-primary mt-3" onclick="$('#productDetailsOffcanvas').offcanvas('hide')">
                    Fechar
                </button>
            </div>
        `);
    }
});
</script>
