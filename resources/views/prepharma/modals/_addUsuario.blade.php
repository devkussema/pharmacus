<div class="modal fade" id="addUsuarioModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cadastrar Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <form id="formAddUsuario" action="{{ route('registar.store') }}" method="POST" onsubmit="return window.handleAddUsuario ? window.handleAddUsuario(event) : true;">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Senha</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmar Senha</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Grupo</label>
                        @php
                            $gruposList = $grupos ?? \App\Models\Grupo::all();
                        @endphp
                        <select name="grupo_id" class="form-control">
                            <option value="">Sem grupo</option>
                            @foreach($gruposList as $g)
                                <option value="{{ $g->id }}">{{ $g->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Criar e Enviar Convite</button>
                </div>
            </form>
        </div>
    </div>
</div>
