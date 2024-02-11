<div class="modal fade" id="modalEditarFarmacia" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="popup text-left">
                    <h4 class="mb-3">Editar farmácia</h4>
                    <div class="content create-workform bg-body">
                        <form id="formEditFarmacia" action="{{ route('farmacia.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nome_farmacia">Nome *</label>
                                <input type="text" name="nome" class="form-control" id="nome_farmacia" value=""
                                    placeholder="Nome da farmácia">
                                <input type="hidden" name="id" id="id_farmacia">
                            </div>
                            <div class="form-group">
                                <label for="logotipo_">Logotipo</label>
                                <div class="custom-file">
                                    <input name="logotipo" type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Escolher arquivo</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="endereco">Endereço *</label>
                                <input type="text" name="endereco" class="form-control" id="endereco">
                            </div>
                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <textarea class="form-control" id="descricao"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
