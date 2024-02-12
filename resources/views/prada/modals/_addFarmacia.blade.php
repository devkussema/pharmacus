<div class="modal fade" id="addFarmacia" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="popup text-left">
                    <h4 class="mb-3">Adicionar farmácia</h4>
                    <div class="content create-workform bg-body">
                        <form id="formAddFarmacia" action="{{ route('farmacia.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nome_farmacia">Nome *</label>
                                <input type="text" name="nome" class="form-control" id="nome_farmacia" value=""
                                    placeholder="Nome da farmácia">
                            </div>
                            <div class="form-group">
                                <label for="nome_farmacia">Nome *</label>
                                <select name="categoria_id" id="" class="form-control">
                                    @php $cats = \App\Models\Categoria::where('tipo', 'farmacia')->get() @endphp
                                    @foreach ($cats as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                    @endforeach
                                </select>
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
                            <input type="submit" hidden id="btn_sender">
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <label for="btn_sender" class="btn btn-primary">Cadastrar</label>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
