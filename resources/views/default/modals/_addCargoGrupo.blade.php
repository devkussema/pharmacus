<div class="modal fade" id="addCargoGrupo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="popup text-left">
                    <h4 class="mb-3">Adicionar Cargo ou Grupo</h4>
                    <div class="content create-workform bg-body">
                        <form id="formAddCargoGrupo" action="{{ route('usuario.addCargo') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="endereco">Grupo *</label>
                                <input type="hidden" name="user_id" id="user_id">
                                <select name="grupo_id" id="" class="form-control">
                                    @foreach ($grupos as $grupo)
                                        <option value="{{ $grupo->id }}">{{ $grupo->nome }}</option>
                                    @endforeach
                                </select>
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
