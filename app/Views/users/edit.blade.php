@extends('admin::layout.main')

@section('title', 'Editar Usuário')

@section('content')
<div class="row">
    <div class="col-sm-12">
        @include('admin::partials.session')
        <div class="card">
            <div class="card-body">
                <form action="{{ route('cp.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <div class="form-heading">
                                <h4>Cadastrar Usuário</h4>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="input-block local-forms">
                                <label>Nome <span class="login-danger">*</span></label>
                                <input name="nome" value="{{ old('nome', $user->nome) }}" class="form-control" type="text" placeholder="Nome completo">
                                @error('nome') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="input-block local-forms">
                                <label>Telefone</label>
                                <input name="telefone" value="{{ old('telefone', $user->telefone) }}" class="form-control" type="text" placeholder="Telefone">
                                @error('telefone') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="input-block local-forms">
                                <label>Email <span class="login-danger">*</span></label>
                                <input name="email" value="{{ old('email', $user->email) }}" class="form-control" type="email" placeholder="email@exemplo.com">
                                @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                <label>Senha <span class="login-danger">*</span></label>
                                <input name="password" class="form-control" type="password" placeholder="Digite a senha (deixe vazio para manter)">
                                @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                <label>Confirmar Senha <span class="login-danger">*</span></label>
                                <input name="password_confirmation" class="form-control" type="password" placeholder="Confirme a senha">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-6">
                            <div class="input-block local-forms">
                                <label>Grupo</label>
                                <select name="grupo_id" class="form-control">
                                        <option value="">-- Selecionar grupo --</option>
                                    @foreach(\App\Models\Grupo::orderBy('nome')->get() as $g)
                                        <option value="{{ $g->id }}" {{ (old('grupo_id', $user->grupo_id) == $g->id) ? 'selected' : '' }}>{{ $g->nome }}</option>
                                    @endforeach
                                </select>
                                @error('grupo_id') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-6">
                            <div class="input-block select-gender">
                                <label class="gen-label">Role</label>
                                <select name="role" class="form-control">
                                    <option value="{{ \App\Models\User::ROLE_USER }}" {{ (old('role', $user->role) == \App\Models\User::ROLE_USER) ? 'selected' : '' }}>Utilizador</option>
                                    <option value="{{ \App\Models\User::ROLE_ADMIN }}" {{ (old('role', $user->role) == \App\Models\User::ROLE_ADMIN) ? 'selected' : '' }}>Admin</option>
                                    <option value="{{ \App\Models\User::ROLE_SUPER_ADMIN }}" {{ (old('role', $user->role) == \App\Models\User::ROLE_SUPER_ADMIN) ? 'selected' : '' }}>Super Admin</option>
                                </select>
                                @error('role') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-4">
                            <div class="input-block local-forms">
                                <label>Telefone secundário</label>
                                <input name="telefone_sec" value="{{ old('telefone_sec', $user->telefone_sec) }}" class="form-control" type="text" placeholder="Telefone secundário">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="input-block local-forms">
                                <label>Observações</label>
                                <textarea name="observacoes" class="form-control" rows="3" cols="30">{{ old('observacoes', $user->observacoes) }}</textarea>
                            </div>
                        </div>
                        <!-- Foto / Permissão / Estado - alinhados em uma linha -->
                        <div class="col-12 col-md-4">
                            <div class="input-block local-forms d-flex gap-3 align-items-center">
                                <div>
                                    <label class="d-block mb-1">Avatar</label>
                                    <img id="avatarPreview" src="{{ $user->foto_perfil ? asset('storage/'.$user->foto_perfil) : asset('prepharma/img/profiles/avatar-01.jpg') }}" alt="avatar" width="72" height="72" class="rounded-circle border" style="object-fit:cover;">
                                </div>
                                <div class="flex-grow-1">
                                    <label>Foto de Perfil</label>
                                    <input id="foto_perfil_input" type="file" name="foto_perfil" accept="image/*" class="form-control">
                                    @error('foto_perfil') <div class="text-danger small">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4 d-flex align-items-center">
                            <div class="w-100">
                                <label class="d-block mb-1">Permissão cadastrar produtos</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="pode_cadastrar_produtos" value="1" {{ old('pode_cadastrar_produtos', $user->pode_cadastrar_produtos) ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="input-block local-forms">
                                <label>Estado</label>
                                <select name="status" class="form-control">
                                    <option value="">-- selecione --</option>
                                    <option value="activo" {{ old('status', $user->status)=='activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ old('status', $user->status)=='inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="doctor-submit text-end">
                                <div class="d-flex justify-content-end gap-2 align-items-center">
                                    <button type="button" id="js-sync-farm" class="btn btn-outline-warning">Sync com Farmácia</button>

                                    <button type="submit" class="btn btn-primary submit-form">Salvar</button>

                                    <a href="{{ route('cp.users.index') }}" class="btn btn-secondary">Cancelar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        (function(){
            document.addEventListener('DOMContentLoaded', function(){
                const input = document.getElementById('foto_perfil_input');
                const preview = document.getElementById('avatarPreview');

                if (!input || !preview) return;

                input.addEventListener('change', function(e){
                    const file = input.files && input.files[0];
                    if (!file) return;
                    if (!file.type.startsWith('image/')) {
                        alert('Por favor selecione uma imagem válida.');
                        input.value = '';
                        return;
                    }
                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        preview.src = ev.target.result;
                    };
                    reader.readAsDataURL(file);
                });
            });
        })();
    </script>
@endsection

@section('scripts_bottom')
    <script>
        (function(){
            const btn = document.getElementById('js-sync-farm');
            if (!btn) return;

            btn.addEventListener('click', function(){
                if (!confirm('Deseja sincronizar este utilizador como Gerente da farmácia?')) return;
                btn.setAttribute('disabled', 'disabled');
                const telefoneInput = document.querySelector('input[name="telefone"]');
                const contato = telefoneInput ? telefoneInput.value : '';
                const url = '{{ route("cp.users.sync.farmacia", $user->id) }}';

                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ contato: contato })
                }).then(res => res.json().then(body => ({ status: res.status, body })))
                .then(({ status, body }) => {
                    if (status >= 200 && status < 300) {
                        // inserir alerta na página
                        const wrapper = document.createElement('div');
                        wrapper.innerHTML = `<div class="alert alert-success">${body.message ?? 'Sincronizado com sucesso.'}</div>`;
                        const container = document.querySelector('.card-body');
                        if (container) container.prepend(wrapper);
                        btn.setAttribute('disabled', 'disabled');
                    } else {
                        const wrapper = document.createElement('div');
                        wrapper.innerHTML = `<div class="alert alert-danger">${body.message ?? 'Erro ao sincronizar.'}</div>`;
                        const container = document.querySelector('.card-body');
                        if (container) container.prepend(wrapper);
                        btn.removeAttribute('disabled');
                    }
                }).catch(err => {
                    console.error(err);
                    const wrapper = document.createElement('div');
                    wrapper.innerHTML = `<div class="alert alert-danger">Erro de rede ao sincronizar.</div>`;
                    const container = document.querySelector('.card-body');
                    if (container) container.prepend(wrapper);
                    btn.removeAttribute('disabled');
                });
            });
        })();
    </script>
@endsection