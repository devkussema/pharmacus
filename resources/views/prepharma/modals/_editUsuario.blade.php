<div class="modal fade" id="editUsuarioModal" tabindex="-1" aria-labelledby="editUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formEditUsuario" action="#" onsubmit="return handleEditUsuario(event);">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUsuarioModalLabel">Editar Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="edit-nome" class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" id="edit-nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="edit-email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-telefone" class="form-label">Telefone</label>
                        <input type="text" name="telefone" class="form-control" id="edit-telefone">
                    </div>
                    <div class="mb-3">
                        <label for="edit-grupo" class="form-label">Grupo</label>
                        <select name="grupo_id" id="edit-grupo" class="form-control">
                            <option value="">Sem grupo</option>
                            @foreach($grupos as $g)
                                <option value="{{ $g->id }}">{{ $g->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="status" id="edit-status" value="1">
                        <label class="form-check-label" for="edit-status">Ativo</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Guardar alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
