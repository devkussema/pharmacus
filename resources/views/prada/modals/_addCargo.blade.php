<div class="modal fade" id="addCargo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="popup text-left">
                    <h4 class="mb-3">Adicionar Cargo</h4>
                    <div class="content create-workform bg-body">
                        <form id="formAddCargo" action="{{ route('cargo.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nome_farmacia">Nome *</label>
                                <input type="text" name="nome" class="form-control" id="nome" value=""
                                    placeholder="Nome do cargo">
                            </div>
                            <div class="form-group">
                                <label for="descricao_">Descrição</label>
                                <textarea name="descricao" class="form-control" id="descricao"
                                    placeholder="Descrição do cargo"></textarea>
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
