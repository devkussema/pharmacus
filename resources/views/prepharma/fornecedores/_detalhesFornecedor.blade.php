<style>
    .offcanvas-detalhes {
        width: 650px !important;
    }

    .offcanvas-detalhes .offcanvas-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        padding: 20px 25px;
    }

    .offcanvas-detalhes .offcanvas-title {
        font-size: 1.3rem;
        font-weight: 600;
    }

    .offcanvas-detalhes .btn-close {
        filter: brightness(0) invert(1);
    }

    .offcanvas-detalhes .offcanvas-body {
        padding: 25px;
        background: #f8f9fa;
    }

    .info-section {
        background: #fff;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .info-section h5 {
        color: #667eea;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e3f2fd;
    }

    .info-row {
        display: flex;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #555;
        width: 160px;
        flex-shrink: 0;
    }

    .info-value {
        color: #333;
        flex-grow: 1;
    }

    .info-value a {
        color: #667eea;
        text-decoration: none;
    }

    .info-value a:hover {
        text-decoration: underline;
    }
</style>

<div class="offcanvas offcanvas-end offcanvas-detalhes" tabindex="-1" id="offcanvasDetalhesFornecedor">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">
            <i class="fas fa-info-circle me-2"></i>Detalhes do Fornecedor
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <!-- Informações Básicas -->
        <div class="info-section">
            <h5><i class="fas fa-building me-2"></i>Informações Básicas</h5>
            <div class="info-row">
                <div class="info-label">Nome:</div>
                <div class="info-value" id="detalheNome">--</div>
            </div>
            <div class="info-row">
                <div class="info-label">NIF:</div>
                <div class="info-value" id="detalheNif">--</div>
            </div>
            <div class="info-row">
                <div class="info-label">Tipo:</div>
                <div class="info-value" id="detalheTipo">--</div>
            </div>
            <div class="info-row">
                <div class="info-label">Status:</div>
                <div class="info-value" id="detalheStatus">--</div>
            </div>
            <div class="info-row">
                <div class="info-label">Avaliação:</div>
                <div class="info-value" id="detalheAvaliacao">--</div>
            </div>
        </div>

        <!-- Contactos -->
        <div class="info-section">
            <h5><i class="fas fa-phone me-2"></i>Contactos</h5>
            <div class="info-row">
                <div class="info-label">Email:</div>
                <div class="info-value" id="detalheEmail">--</div>
            </div>
            <div class="info-row">
                <div class="info-label">Telefone:</div>
                <div class="info-value" id="detalheTelefone">--</div>
            </div>
            <div class="info-row">
                <div class="info-label">Telemóvel:</div>
                <div class="info-value" id="detalheTelemovel">--</div>
            </div>
            <div class="info-row">
                <div class="info-label">WhatsApp:</div>
                <div class="info-value" id="detalheWhatsapp">--</div>
            </div>
            <div class="info-row">
                <div class="info-label">Website:</div>
                <div class="info-value" id="detalheWebsite">--</div>
            </div>
        </div>

        <!-- Endereço -->
        <div class="info-section">
            <h5><i class="fas fa-map-marker-alt me-2"></i>Endereço</h5>
            <div class="info-row">
                <div class="info-label">Endereço:</div>
                <div class="info-value" id="detalheEndereco">--</div>
            </div>
            <div class="info-row">
                <div class="info-label">Cidade:</div>
                <div class="info-value" id="detalheCidade">--</div>
            </div>
            <div class="info-row">
                <div class="info-label">Província:</div>
                <div class="info-value" id="detalheProvincia">--</div>
            </div>
            <div class="info-row">
                <div class="info-label">País:</div>
                <div class="info-value" id="detalhePais">--</div>
            </div>
            <div class="info-row">
                <div class="info-label">Código Postal:</div>
                <div class="info-value" id="detalheCodigoPostal">--</div>
            </div>
        </div>

        <!-- Pessoa de Contacto -->
        <div class="info-section">
            <h5><i class="fas fa-user-tie me-2"></i>Pessoa de Contacto</h5>
            <div class="info-row">
                <div class="info-label">Nome:</div>
                <div class="info-value" id="detalhePessoaContacto">--</div>
            </div>
            <div class="info-row">
                <div class="info-label">Cargo:</div>
                <div class="info-value" id="detalheCargoContacto">--</div>
            </div>
        </div>

        <!-- Dados Bancários -->
        <div class="info-section">
            <h5><i class="fas fa-university me-2"></i>Dados Bancários</h5>
            <div class="info-row">
                <div class="info-label">Banco:</div>
                <div class="info-value" id="detalheBanco">--</div>
            </div>
            <div class="info-row">
                <div class="info-label">Conta Bancária:</div>
                <div class="info-value" id="detalheContaBancaria">--</div>
            </div>
            <div class="info-row">
                <div class="info-label">IBAN:</div>
                <div class="info-value" id="detalheIban">--</div>
            </div>
        </div>

        <!-- Observações -->
        <div class="info-section">
            <h5><i class="fas fa-comment-alt me-2"></i>Observações</h5>
            <div class="info-row">
                <div class="info-value" id="detalheObservacoes">--</div>
            </div>
        </div>
    </div>
</div>
