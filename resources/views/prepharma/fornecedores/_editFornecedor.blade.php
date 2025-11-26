<!-- Offcanvas Editar/Criar Fornecedor -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditarFornecedor" style="width: 600px;">
    <div class="offcanvas-header bg-gradient-primary text-white">
        <h5 class="offcanvas-title" id="offcanvasEditarFornecedorLabel">Editar Fornecedor</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <form id="formEditarFornecedor">
            <input type="hidden" id="fornecedor_id" name="id">

            <h6 class="mb-3 fw-bold text-primary">Informações Básicas</h6>

            <div class="mb-3">
                <label for="edit_nome" class="form-label">Nome <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="edit_nome" name="nome" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit_nif" class="form-label">NIF</label>
                    <input type="text" class="form-control" id="edit_nif" name="nif">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit_tipo" class="form-label">Tipo</label>
                    <select class="form-select" id="edit_tipo" name="tipo">
                        <option value="nacional">Nacional</option>
                        <option value="internacional">Internacional</option>
                    </select>
                </div>
            </div>

            <h6 class="mb-3 mt-4 fw-bold text-primary">Contactos</h6>

            <div class="mb-3">
                <label for="edit_email" class="form-label">Email</label>
                <input type="email" class="form-control" id="edit_email" name="email">
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="edit_telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="edit_telefone" name="telefone">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="edit_telemovel" class="form-label">Telemóvel</label>
                    <input type="text" class="form-control" id="edit_telemovel" name="telemovel">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="edit_whatsapp" class="form-label">WhatsApp</label>
                    <input type="text" class="form-control" id="edit_whatsapp" name="whatsapp">
                </div>
            </div>

            <h6 class="mb-3 mt-4 fw-bold text-primary">Endereço</h6>

            <div class="mb-3">
                <label for="edit_endereco" class="form-label">Endereço</label>
                <textarea class="form-control" id="edit_endereco" name="endereco" rows="2"></textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit_cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="edit_cidade" name="cidade">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit_provincia" class="form-label">Província</label>
                    <input type="text" class="form-control" id="edit_provincia" name="provincia">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit_pais" class="form-label">País</label>
                    <input type="text" class="form-control" id="edit_pais" name="pais" value="Angola">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit_codigo_postal" class="form-label">Código Postal</label>
                    <input type="text" class="form-control" id="edit_codigo_postal" name="codigo_postal">
                </div>
            </div>

            <h6 class="mb-3 mt-4 fw-bold text-primary">Informações Adicionais</h6>

            <div class="mb-3">
                <label for="edit_website" class="form-label">Website</label>
                <input type="url" class="form-control" id="edit_website" name="website">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit_pessoa_contacto" class="form-label">Pessoa de Contacto</label>
                    <input type="text" class="form-control" id="edit_pessoa_contacto" name="pessoa_contacto">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit_cargo_contacto" class="form-label">Cargo</label>
                    <input type="text" class="form-control" id="edit_cargo_contacto" name="cargo_contacto">
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit_status" class="form-label">Status</label>
                    <select class="form-select" id="edit_status" name="status">
                        <option value="ativo">Ativo</option>
                        <option value="inativo">Inativo</option>
                        <option value="bloqueado">Bloqueado</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit_avaliacao" class="form-label">Avaliação (0-5)</label>
                    <input type="number" step="0.1" min="0" max="5" class="form-control" id="edit_avaliacao" name="avaliacao">
                </div>
            </div>

            <h6 class="mb-3 mt-4 fw-bold text-primary">Dados Bancários</h6>

            <div class="mb-3">
                <label for="edit_banco" class="form-label">Banco</label>
                <input type="text" class="form-control" id="edit_banco" name="banco">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="edit_conta_bancaria" class="form-label">Conta Bancária</label>
                    <input type="text" class="form-control" id="edit_conta_bancaria" name="conta_bancaria">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit_iban" class="form-label">IBAN</label>
                    <input type="text" class="form-control" id="edit_iban" name="iban">
                </div>
            </div>

            <div class="mb-3">
                <label for="edit_observacoes" class="form-label">Observações</label>
                <textarea class="form-control" id="edit_observacoes" name="observacoes" rows="3"></textarea>
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save me-2"></i>Salvar
                    <span class="spinner-border spinner-border-sm ms-2 d-none" id="btnSalvarSpinner"></span>
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Cancelar</button>
            </div>
        </form>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    #offcanvasEditarFornecedor .form-label {
        font-weight: 600;
        color: #495057;
        font-size: 0.9rem;
    }

    #offcanvasEditarFornecedor .form-control,
    #offcanvasEditarFornecedor .form-select {
        border-radius: 8px;
        border: 1px solid #ced4da;
        transition: all 0.3s ease;
    }

    #offcanvasEditarFornecedor .form-control:focus,
    #offcanvasEditarFornecedor .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
</style>

<script>
    // ========== Gerenciamento do Offcanvas de Edição ==========

    function popularOffcanvasEditar(data) {
        $('#fornecedor_id').val(data.id);
        $('#edit_nome').val(data.nome);
        $('#edit_nif').val(data.nif);
        $('#edit_email').val(data.email);
        $('#edit_telefone').val(data.telefone);
        $('#edit_telemovel').val(data.telemovel);
        $('#edit_whatsapp').val(data.whatsapp);
        $('#edit_endereco').val(data.endereco);
        $('#edit_cidade').val(data.cidade);
        $('#edit_provincia').val(data.provincia);
        $('#edit_pais').val(data.pais || 'Angola');
        $('#edit_codigo_postal').val(data.codigo_postal);
        $('#edit_website').val(data.website);
        $('#edit_pessoa_contacto').val(data.pessoa_contacto);
        $('#edit_cargo_contacto').val(data.cargo_contacto);
        $('#edit_tipo').val(data.tipo || 'nacional');
        $('#edit_status').val(data.status || 'ativo');
        $('#edit_avaliacao').val(data.avaliacao);
        $('#edit_banco').val(data.banco);
        $('#edit_conta_bancaria').val(data.conta_bancaria);
        $('#edit_iban').val(data.iban);
        $('#edit_observacoes').val(data.observacoes);

        $('#offcanvasEditarFornecedorLabel').text('Editar Fornecedor: ' + data.nome);
    }

    function limparOffcanvasEditar() {
        $('#formEditarFornecedor')[0].reset();
        $('#fornecedor_id').val('');
        $('#edit_pais').val('Angola');
        $('#edit_tipo').val('nacional');
        $('#edit_status').val('ativo');
        $('#offcanvasEditarFornecedorLabel').text('Novo Fornecedor');
    }

    // Submit do formulário de edição
    $('#formEditarFornecedor').on('submit', function(e) {
        e.preventDefault();

        const id = $('#fornecedor_id').val();
        const isNovo = !id;
        const url = isNovo ? '/api/fornecedores' : `/api/fornecedores/${id}`;
        const method = isNovo ? 'POST' : 'PUT';

        const formData = $(this).serializeArray().reduce((obj, item) => {
            obj[item.name] = item.value;
            return obj;
        }, {});

        // Remove o campo id se for novo
        if (isNovo) delete formData.id;

        $('#btnSalvarSpinner').removeClass('d-none');
        $('button[type=submit]').prop('disabled', true);

        $.ajax({
            url: url,
            type: method,
            data: JSON.stringify(formData),
            contentType: 'application/json',
            success: function(response) {
                $('#btnSalvarSpinner').addClass('d-none');
                $('button[type=submit]').prop('disabled', false);

                showToast(response.message || 'Fornecedor salvo com sucesso', 'success');

                // Fecha o offcanvas
                bootstrap.Offcanvas.getInstance(document.getElementById('offcanvasEditarFornecedor')).hide();

                // Recarrega a tabela
                if (typeof tableFornecedores !== 'undefined') {
                    tableFornecedores.ajax.reload();
                }
            },
            error: function(xhr) {
                $('#btnSalvarSpinner').addClass('d-none');
                $('button[type=submit]').prop('disabled', false);

                let errorMsg = 'Erro ao salvar fornecedor';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMsg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMsg = xhr.responseJSON.message;
                }

                showToast(errorMsg, 'error');
            }
        });
    });
</script>
