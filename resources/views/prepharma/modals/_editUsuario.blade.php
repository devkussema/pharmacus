<div class="modal fade" id="editUsuarioModal" tabindex="-1" aria-labelledby="editUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content border-0 shadow-sm">
            <div class="modal-header">
                <h5 class="modal-title" id="editUsuarioModalLabel">Editar Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <form id="formEditUsuario" action="#" method="POST" onsubmit="return window.handleEditUsuario ? window.handleEditUsuario(event) : true;">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_user_id" name="id" value="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_nome_usuario" class="form-label">Nome *</label>
                        <input id="edit_nome_usuario" name="nome" type="text" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_email_usuario" class="form-label">Email</label>
                        <input id="edit_email_usuario" name="email" type="email" class="form-control" disabled>
                        <small class="text-muted">O email não pode ser alterado.</small>
                    </div>

                    <div class="mb-3">
                        <label for="edit_telefone_usuario" class="form-label">Telefone</label>
                        <input id="edit_telefone_usuario" name="telefone" type="text" class="form-control" placeholder="Ex: +244 123 456 789">
                    </div>

                    <div class="mb-3">
                        <label for="edit_grupo_usuario" class="form-label">Grupo</label>
                        <select id="edit_grupo_usuario" name="grupo_id" class="form-control">
                            <option value="">Sem grupo</option>
                            @php $gruposList = $grupos ?? collect(); @endphp
                            @foreach($gruposList as $g)
                                <option value="{{ $g->id }}">{{ $g->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_status_usuario" class="form-label">Status</label>
                        <select id="edit_status_usuario" name="status" class="form-control">
                            <option value="1">Ativo</option>
                            <option value="0">Inativo</option>
                        </select>
                    </div>

                    <div id="edit-error-container" class="alert alert-danger" style="display: none;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button id="btnSaveEditUsuario" type="submit" class="btn btn-primary">
                        <span class="spinner-border spinner-border-sm me-2" id="editUsuarioSpinner" style="display:none;" role="status" aria-hidden="true"></span>
                        Salvar Alterações
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
