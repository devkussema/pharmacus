<div class="modal fade" id="modalViewFarmacia" tabindex="-1" aria-labelledby="modalViewFarmaciaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalViewFarmaciaLabel">
                    <i class="fas fa-clinic-medical me-2"></i>
                    Detalhes da Farmácia
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Cabeçalho da Farmácia -->
                <div class="row mb-4">
                    <div class="col-md-3 text-center">
                        <div class="pharmacy-logo-container">
                            <img id="view_logo" src="{{ assetr('assets/img/icons/pharmacy-default.svg') }}"
                                 alt="Logo da Farmácia" class="pharmacy-logo mb-3" />
                        </div>
                        <h4 id="view_nome" class="text-primary mb-1">Nome da Farmácia</h4>
                        <p id="view_codigo" class="text-muted mb-2">Código</p>
                        <div id="view_status" class="mb-3"></div>
                    </div>
                    <div class="col-md-9">
                        <div class="row g-3">
                            <!-- Informações Principais -->
                            <div class="col-md-6">
                                <div class="info-card h-100">
                                    <h6 class="info-title">
                                        <i class="fas fa-user-tie text-primary me-2"></i>
                                        Gerente Responsável
                                    </h6>
                                    <p id="view_gerente" class="info-content">-</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-card h-100">
                                    <h6 class="info-title">
                                        <i class="fas fa-tag text-primary me-2"></i>
                                        Categoria
                                    </h6>
                                    <p id="view_categoria" class="info-content">-</p>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="info-card">
                                    <h6 class="info-title">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        Endereço
                                    </h6>
                                    <p id="view_endereco" class="info-content">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informações Adicionais -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-card h-100">
                            <h6 class="info-title">
                                <i class="fas fa-sticky-note text-primary me-2"></i>
                                Observações
                            </h6>
                            <p id="view_obs" class="info-content">-</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-card h-100">
                            <h6 class="info-title">
                                <i class="fas fa-info-circle text-primary me-2"></i>
                                Descrição
                            </h6>
                            <p id="view_descricao" class="info-content">-</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>
                    Fechar
                </button>
                <a href="#" id="view_editar_btn" class="btn btn-primary">
                    <i class="fas fa-edit me-1"></i>
                    Editar Farmácia
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .pharmacy-logo {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 15px;
        border: 3px solid #e9ecef;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .pharmacy-logo-container {
        position: relative;
    }

    .info-card {
        background: #f8f9fa;
        padding: 1.25rem;
        border-radius: 10px;
        border-left: 4px solid #007bff;
        transition: all 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .info-title {
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: #495057;
    }

    .info-content {
        margin: 0;
        color: #6c757d;
        font-size: 0.95rem;
        line-height: 1.5;
    }

    .modal-header.bg-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
    }

    .badge {
        font-size: 0.85rem;
        padding: 0.5rem 1rem;
    }

    #modalViewFarmacia .modal-content {
        border: none;
        border-radius: 15px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
</style>
