<div class="modal fade" id="modalEditarFarmacia" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-sm">
            <div class="modal-body p-4">
                <div class="popup text-left">
                    <h4 class="mb-3">Editar farmácia</h4>
                    <div class="content create-workform bg-body p-3 rounded">
                        <form id="formEditFarmacia" action="#" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" id="id_farmacia" value="">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="nome_farmacia" class="form-label">Nome *</label>
                                    <input type="text" name="nome" class="form-control" id="nome_farmacia" placeholder="Nome da farmácia" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="logotipo_edit_farmacia" class="form-label">Logotipo</label>
                                    <input class="form-control" type="file" id="logotipo_edit_farmacia" name="logotipo" accept="image/*">
                                </div>

                                <div class="col-12">
                                    <label for="endereco" class="form-label">Endereço *</label>
                                    <input type="text" name="endereco" class="form-control" id="endereco" required>
                                </div>

                                <div class="col-12">
                                    <label for="descricao" class="form-label">Descrição</label>
                                    <textarea name="descricao" id="descricao" class="form-control" rows="3"></textarea>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="button" class="btn btn-outline-secondary me-2" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-sm" id="modalEliminarFarmacia" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="deleteFormFarmacia" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Eliminar Farmácia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p id="texto-aviso"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </div>
            </form>
        </div>
    </div>
</div>
