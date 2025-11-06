{{--
    Offcanvas de Detalhes do Produto
    Exibe informações completas do produto em estoque
    Autor: Augusto Kussema
    Data: {{ date('d/m/Y') }}
--}}

<div class="offcanvas offcanvas-end" tabindex="-1" id="productDetailsOffcanvas" aria-labelledby="productDetailsLabel" style="width: 450px;">
    <div class="offcanvas-header bg-gradient" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
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
    #productDetailsContent .detail-section {
        border-bottom: 1px solid #e9ecef;
        padding: 1.25rem;
    }

    #productDetailsContent .detail-section:last-child {
        border-bottom: none;
    }

    #productDetailsContent .detail-section h6 {
        color: #667eea;
        font-weight: 600;
        margin-bottom: 1rem;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    #productDetailsContent .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 0.5rem 0;
        border-bottom: 1px dashed #f0f0f0;
    }

    #productDetailsContent .detail-item:last-child {
        border-bottom: none;
    }

    #productDetailsContent .detail-label {
        font-weight: 500;
        color: #6c757d;
        font-size: 0.875rem;
    }

    #productDetailsContent .detail-value {
        font-weight: 600;
        color: #212529;
        text-align: right;
        font-size: 0.875rem;
    }

    #productDetailsContent .badge {
        font-size: 0.75rem;
        padding: 0.35rem 0.65rem;
    }

    #productDetailsContent .obs-box {
        background: #f8f9fa;
        border-left: 4px solid #667eea;
        padding: 0.75rem;
        border-radius: 4px;
        font-size: 0.875rem;
        color: #495057;
        font-style: italic;
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
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">A carregar...</span>
                    </div>
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
            let html = `
                <!-- Informações Básicas -->
                <div class="detail-section">
                    <h6><i class="fa fa-pills me-2"></i>Identificação</h6>
                    <div class="detail-item">
                        <span class="detail-label">Designação:</span>
                        <span class="detail-value">${produto.designacao || '-'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Dosagem:</span>
                        <span class="detail-value">${produto.dosagem || '-'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Forma:</span>
                        <span class="detail-value">${produto.forma || '-'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Tipo:</span>
                        <span class="detail-value">${produto.tipo || '-'}</span>
                    </div>
                </div>

                <!-- Classificação -->
                <div class="detail-section">
                    <h6><i class="fa fa-tags me-2"></i>Classificação</h6>
                    <div class="detail-item">
                        <span class="detail-label">Grupo Farmacológico:</span>
                        <span class="detail-value">${produto.grupo_farmaco?.designacao || '-'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Status:</span>
                        <span class="detail-value">${getStatusBadge(produto.status_stock)}</span>
                    </div>
                </div>

                <!-- Localização -->
                <div class="detail-section">
                    <h6><i class="fa fa-map-marker-alt me-2"></i>Localização</h6>
                    <div class="detail-item">
                        <span class="detail-label">Estoque:</span>
                        <span class="detail-value">${produto.estoque?.designacao || '-'}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Prateleira:</span>
                        <span class="detail-value">${produto.prateleira?.designacao || '-'}</span>
                    </div>
                </div>

                <!-- Quantidades -->
                <div class="detail-section">
                    <h6><i class="fa fa-boxes me-2"></i>Quantidades</h6>
                    <div class="detail-item">
                        <span class="detail-label">Quantidade:</span>
                        <span class="detail-value text-primary fw-bold">${produto.quantidade || 0}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Lote:</span>
                        <span class="detail-value">${produto.num_lote || '-'}</span>
                    </div>
                </div>

                <!-- Datas -->
                <div class="detail-section">
                    <h6><i class="fa fa-calendar-alt me-2"></i>Datas</h6>
                    <div class="detail-item">
                        <span class="detail-label">Data de Produção:</span>
                        <span class="detail-value">${formatDate(produto.data_producao)}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Data de Expiração:</span>
                        <span class="detail-value">${formatDate(produto.data_expiracao)}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Data de Recepção:</span>
                        <span class="detail-value">${formatDate(produto.data_recepcao)}</span>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Inserido em:</span>
                        <span class="detail-value">${formatDateTime(produto.created_at)}</span>
                    </div>
                </div>
            `;

            // Observações (se existir)
            if (produto.obs && produto.obs.trim() !== '') {
                html += `
                    <div class="detail-section">
                        <h6><i class="fa fa-comment me-2"></i>Observações</h6>
                        <div class="obs-box">
                            ${produto.obs}
                        </div>
                    </div>
                `;
            }

            $('#productDetailsContent').html(html);
        }

        function getStatusBadge(status) {
            if (!status) return '<span class="badge bg-secondary">Indefinido</span>';

            const colors = {
                'Ativo': 'success',
                'Inativo': 'secondary',
                'Esgotado': 'danger',
                'Crítico': 'warning'
            };

            const color = colors[status.designacao] || 'secondary';
            return `<span class="badge bg-${color}">${status.designacao}</span>`;
        }

        function formatDate(dateString) {
            if (!dateString) return '-';
            const date = new Date(dateString);
            return date.toLocaleDateString('pt-BR');
        }

        function formatDateTime(dateString) {
            if (!dateString) return '-';
            const date = new Date(dateString);
            return date.toLocaleString('pt-BR');
        }

        function showError(message) {
            $('#productDetailsContent').html(`
                <div class="text-center py-5 px-3">
                    <i class="fa fa-exclamation-triangle text-warning fa-3x mb-3"></i>
                    <p class="text-muted">${message}</p>
                </div>
            `);
        }
    });
</script>
