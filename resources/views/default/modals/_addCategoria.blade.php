<div class="modal fade" id="addCategoria" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="popup text-left">
                    <h4 class="mb-3">Adicionar categoria</h4>
                    <div class="content create-workform bg-body">
                        <form id="formAddCategoria" action="{{ route('categoria.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nome_farmacia">Nome *</label>
                                <input type="text" name="nome" class="form-control" id="nome_farmacia" value=""
                                    placeholder="Nome da farmácia">
                            </div>
                            <div class="form-group">
                                <label for="endereco">Tipo *</label>
                                <select name="tipo" id="" class="form-control">
                                    <option value="farmacia">Farmácia</option>
                                    <option value="produto">Produto</option>
                                    <option value="geral">Geral</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="descricao_">Descrição</label>
                                <textarea name="descricao" class="form-control" id="descricao_"
                                    placeholder="Descrição da categoria"></textarea>
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
