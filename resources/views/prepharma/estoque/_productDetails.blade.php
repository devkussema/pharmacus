{{--
    Offcanvas de Detalhes do Produto
    Exibe informações completas do produto em estoque
    Autor: Augusto Kussema
    Data: {{ date('d/m/Y') }}
--}}

<div class="offcanvas offcanvas-end offcanvas-details" tabindex="-1" id="productDetailsOffcanvas" aria-labelledby="productDetailsLabel">
    <div class="offcanvas-header bg-gradient">
        <h5 class="offcanvas-title text-white" id="productDetailsLabel">
            <i class="fa fa-info-circle me-2"></i>Detalhes do Produto
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Fechar"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div id="productDetailsContent">
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">A carregar...</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* ========== Offcanvas Detalhes Premium ========== */
    .offcanvas-details {
        --bs-offcanvas-width: min(55vw, 650px) !important;
        box-shadow: -4px 0 24px rgba(0,0,0,0.12);
    }

    .offcanvas-details .offcanvas-header {
        position: sticky;
        top: 0;
        z-index: 10;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.5rem;
        border: none;
    }

    .offcanvas-details .offcanvas-title {
        font-size: 1.25rem;
        font-weight: 600;
    }

    .offcanvas-details .offcanvas-body {
        background: #f8f9fa;
    }

    /* Seções de Detalhes */
    #productDetailsContent .detail-section {
        background: white;
        margin-bottom: 0.75rem;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        transition: all 0.3s;
    }

    #productDetailsContent .detail-section:hover {
        box-shadow: 0 4px 16px rgba(102, 126, 234, 0.12);
        transform: translateY(-2px);
    }

    #productDetailsContent .detail-section h6 {
        color: #667eea;
        font-weight: 700;
        margin-bottom: 1.25rem;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f0f0f0;
    }

    #productDetailsContent .detail-section h6 i {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 6px;
        font-size: 0.75rem;
    }

    #productDetailsContent .detail-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.875rem 0;
        border-bottom: 1px solid #f0f0f0;
        transition: background 0.2s;
    }

    #productDetailsContent .detail-item:hover {
        background: #f8f9fa;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        border-radius: 6px;
    }

    #productDetailsContent .detail-item:last-child {
        border-bottom: none;
    }

    #productDetailsContent .detail-label {
        font-weight: 600;
        color: #4a5568;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    #productDetailsContent .detail-label i {
        color: #94a3b8;
        font-size: 0.75rem;
    }

    #productDetailsContent .detail-value {
        font-weight: 600;
        color: #1a202c;
        text-align: right;
        font-size: 0.9rem;
    }

    #productDetailsContent .detail-value.highlight {
        color: #667eea;
        font-size: 1.1rem;
    }

    /* Badges Melhorados */
    #productDetailsContent .badge {
        font-size: 0.75rem;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    #productDetailsContent .badge.bg-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
    }

    #productDetailsContent .badge.bg-danger {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
    }

    #productDetailsContent .badge.bg-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
    }

    #productDetailsContent .badge.bg-secondary {
        background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%) !important;
    }

    /* Caixa de Observações */
    #productDetailsContent .obs-box {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        border-left: 4px solid #667eea;
        padding: 1rem;
        border-radius: 8px;
        font-size: 0.875rem;
        color: #334155;
        font-style: italic;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.08);
    }

    /* Cards de Estatística */
    .stat-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 1.25rem;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }

    .stat-card .stat-value {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .stat-card .stat-label {
        font-size: 0.75rem;
        opacity: 0.9;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Alerta de Expiração */
    .expiry-alert {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1rem;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .expiry-alert.critical {
        background: #fee2e2;
        color: #991b1b;
        border-left: 4px solid #dc2626;
    }

    .expiry-alert.warning {
        background: #fef3c7;
        color: #92400e;
        border-left: 4px solid #f59e0b;
    }

    .expiry-alert.good {
        background: #d1fae5;
        color: #065f46;
        border-left: 4px solid #10b981;
    }

    /* Spinner Customizado */
    .detail-loading {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 3rem;
        gap: 1rem;
    }

    .detail-loading .spinner-border {
        width: 3rem;
        height: 3rem;
        border-width: 0.3rem;
    }

    /* Info Box */
    .info-box {
        background: #f8f9fa;
        border: 2px dashed #cbd5e0;
        border-radius: 8px;
        padding: 1rem;
        text-align: center;
        color: #64748b;
        font-size: 0.875rem;
    }

    .info-box i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        color: #94a3b8;
    }
</style>

<script>
    $(document).ready(function() {
        // Handler para botão de detalhes
        $(document).on('click', '.btn-detalhes', function() {
            const produtoId = $(this).data('id');

            // Abrir offcanvas
            const offcanvas = new bootstrap.Offcanvas(document.getElementById('productDetailsOffcanvas'));
            offcanvas.show();

            // Loading state
            $('#productDetailsContent').html(`
                <div class="detail-loading">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">A carregar...</span>
                    </div>
                    <div class="text-muted">Carregando detalhes...</div>
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
            // Calcular dias para expiração
            const expiryInfo = calculateExpiry(produto.data_expiracao);

            let html = `
                <div style="padding: 1rem;">
                    <!-- Cards de Estatísticas -->
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <div class="stat-card">
                                <div class="stat-value">${produto.quantidade || 0}</div>
                                <div class="stat-label">Em Estoque</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                <div class="stat-value">${produto.saldo?.qtd || 0}</div>
                                <div class="stat-label">Saldo Disponível</div>
                            </div>
                        </div>
                    </div>

                    ${expiryInfo.html}

                    <!-- Informações Básicas -->
                    <div class="detail-section">
                        <h6><i class="fa fa-pills"></i>Identificação</h6>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-tag"></i> Designação:</span>
                            <span class="detail-value">${produto.designacao || '-'}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-prescription-bottle"></i> Dosagem:</span>
                            <span class="detail-value">${produto.dosagem || 'Não especificada'}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-flask"></i> Forma:</span>
                            <span class="detail-value">${produto.forma || '-'}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-layer-group"></i> Tipo:</span>
                            <span class="detail-value">${formatTipo(produto.tipo)}</span>
                        </div>
                    </div>

                    <!-- Classificação -->
                    <div class="detail-section">
                        <h6><i class="fa fa-sitemap"></i>Classificação</h6>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-capsules"></i> Grupo Farmacológico:</span>
                            <span class="detail-value">${produto.grupo_farmaco?.designacao || 'Não classificado'}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-info-circle"></i> Status:</span>
                            <span class="detail-value">${getStatusBadge(produto.status_stock)}</span>
                        </div>
                    </div>

                    <!-- Localização e Rastreamento -->
                    <div class="detail-section">
                        <h6><i class="fa fa-map-marker-alt"></i>Localização e Rastreamento</h6>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-hospital"></i> Área Hospitalar:</span>
                            <span class="detail-value">${produto.estoque?.area_hospitalar?.nome || '-'}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-warehouse"></i> Prateleira:</span>
                            <span class="detail-value">${produto.prateleira?.designacao || 'Não atribuída'}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-barcode"></i> Lote:</span>
                            <span class="detail-value highlight">${produto.num_lote || 'Sem lote'}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-file-alt"></i> Documento Nº:</span>
                            <span class="detail-value">${produto.num_documento || 'N/A'}</span>
                        </div>
                    </div>

                    <!-- Quantidades Detalhadas -->
                    <div class="detail-section">
                        <h6><i class="fa fa-boxes"></i>Quantidades</h6>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-cubes"></i> Quantidade Total:</span>
                            <span class="detail-value highlight">${produto.quantidade || 0} unidades</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-box"></i> Qtd. por Embalagem:</span>
                            <span class="detail-value">${produto.qtd_embalagem || 'N/A'}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-balance-scale"></i> Saldo Atual:</span>
                            <span class="detail-value">${produto.saldo?.qtd || 0} unidades</span>
                        </div>
                    </div>

                    <!-- Datas Importantes -->
                    <div class="detail-section">
                        <h6><i class="fa fa-calendar-alt"></i>Datas Importantes</h6>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-industry"></i> Data de Produção:</span>
                            <span class="detail-value">${formatDate(produto.data_producao)}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-exclamation-triangle"></i> Data de Expiração:</span>
                            <span class="detail-value" style="color: ${expiryInfo.color}; font-weight: 700;">
                                ${formatDate(produto.data_expiracao)}
                            </span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-truck-loading"></i> Data de Recepção:</span>
                            <span class="detail-value">${formatDate(produto.data_recepcao)}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-clock"></i> Cadastrado em:</span>
                            <span class="detail-value">${formatDateTime(produto.created_at)}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-sync"></i> Última Atualização:</span>
                            <span class="detail-value">${formatDateTime(produto.updated_at)}</span>
                        </div>
                    </div>

                    <!-- Fornecimento -->
                    ${produto.origem_destino || produto.fornecedor ? `
                    <div class="detail-section">
                        <h6><i class="fa fa-truck"></i>Fornecimento</h6>
                        ${produto.origem_destino ? `
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-map-signs"></i> Origem/Destino:</span>
                            <span class="detail-value">${produto.origem_destino}</span>
                        </div>
                        ` : ''}
                        ${produto.fornecedor ? `
                        <div class="detail-item">
                            <span class="detail-label"><i class="fa fa-building"></i> Fornecedor:</span>
                            <span class="detail-value">${produto.fornecedor}</span>
                        </div>
                        ` : ''}
                    </div>
                    ` : ''}
            `;

            // Observações (se existir)
            if (produto.obs && produto.obs.trim() !== '') {
                html += `
                    <div class="detail-section">
                        <h6><i class="fa fa-comment"></i>Observações</h6>
                        <div class="obs-box">
                            <i class="fa fa-quote-left me-2"></i>${produto.obs}<i class="fa fa-quote-right ms-2"></i>
                        </div>
                    </div>
                `;
            } else {
                html += `
                    <div class="detail-section">
                        <div class="info-box">
                            <i class="fa fa-info-circle"></i>
                            <div>Nenhuma observação registrada</div>
                        </div>
                    </div>
                `;
            }

            html += `</div>`;

            $('#productDetailsContent').html(html);
        }

        function calculateExpiry(expirationDate) {
            if (!expirationDate) {
                return {
                    html: '',
                    color: '#6b7280'
                };
            }

            const today = new Date();
            const expiry = new Date(expirationDate);
            const diffTime = expiry - today;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

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
                html: `
                    <div class="expiry-alert ${alertClass}">
                        <i class="fa ${icon}"></i>
                        <span>${message}</span>
                    </div>
                `,
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

            return `<span class="badge bg-${statusInfo.color}">
                <i class="fa ${statusInfo.icon} me-1"></i>${status.designacao}
            </span>`;
        }

        function formatDate(dateString) {
            if (!dateString) return '<span class="text-muted">Não informada</span>';
            const date = new Date(dateString);
            return date.toLocaleDateString('pt-PT', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
        }

        function formatDateTime(dateString) {
            if (!dateString) return '<span class="text-muted">Não informada</span>';
            const date = new Date(dateString);
            return date.toLocaleString('pt-PT', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function showError(message) {
            $('#productDetailsContent').html(`
                <div class="text-center py-5 px-3">
                    <i class="fa fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                    <p class="text-muted fw-bold">${message}</p>
                    <button class="btn btn-sm btn-outline-primary mt-2" onclick="$('#productDetailsOffcanvas').offcanvas('hide')">
                        Fechar
                    </button>
                </div>
            `);
        }
    });
</script>
