@extends('admin::layout.main')

@section('title', 'Cadastrar Usuário')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('cp.users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-heading">
                                <h4>Cadastrar Usuário</h4>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="input-block local-forms">
                                <label>Nome <span class="login-danger">*</span></label>
                                <input name="nome" value="{{ old('nome') }}" class="form-control" type="text" placeholder="Nome completo">
                                @error('nome') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="input-block local-forms">
                                <label>Telefone</label>
                                <input name="telefone" value="{{ old('telefone') }}" class="form-control" type="text" placeholder="Telefone">
                                @error('telefone') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="input-block local-forms">
                                <label>Email <span class="login-danger">*</span></label>
                                <input name="email" value="{{ old('email') }}" class="form-control" type="email" placeholder="email@exemplo.com">
                                @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="input-block local-forms">
                                <label>Senha <span class="login-danger">*</span></label>
                                <input name="password" class="form-control" type="password" placeholder="Digite a senha">
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
                                        <option value="{{ $g->id }}" {{ old('grupo_id') == $g->id ? 'selected' : '' }}>{{ $g->nome }}</option>
                                    @endforeach
                                </select>
                                @error('grupo_id') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xl-6">
                            <div class="input-block select-gender">
                                <label class="gen-label">Role</label>
                                <select name="role" class="form-control">
                                    <option value="{{ \App\Models\User::ROLE_USER }}">Utilizador</option>
                                    <option value="{{ \App\Models\User::ROLE_ADMIN }}" {{ old('role') == \App\Models\User::ROLE_ADMIN ? 'selected' : '' }}>Admin</option>
                                    <option value="{{ \App\Models\User::ROLE_SUPER_ADMIN }}" {{ old('role') == \App\Models\User::ROLE_SUPER_ADMIN ? 'selected' : '' }}>Super Admin</option>
                                </select>
                                @error('role') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-4">
                            <div class="input-block local-forms">
                                <label>Telefone secundário</label>
                                <input name="telefone_sec" value="{{ old('telefone_sec') }}" class="form-control" type="text" placeholder="Telefone secundário">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12">
                            <div class="input-block local-forms">
                                <label>Observações</label>
                                <textarea name="observacoes" class="form-control" rows="3" cols="30">{{ old('observacoes') }}</textarea>
                            </div>
                        </div>
                        <!-- Foto / Permissão / Estado - alinhados em uma linha -->
                        <div class="col-12 col-md-4">
                            <div class="input-block local-forms">
                                <label>Foto de Perfil</label>
                                <input type="file" name="foto_perfil" accept="image/*" class="form-control">
                                @error('foto_perfil') <div class="text-danger small">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="col-12 col-md-4 d-flex align-items-center">
                            <div class="w-100">
                                <label class="d-block mb-1">Permissão cadastrar produtos</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="pode_cadastrar_produtos" value="1" {{ old('pode_cadastrar_produtos') ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="input-block local-forms">
                                <label>Estado</label>
                                <select name="estado" class="form-control">
                                    <option value="">-- selecione --</option>
                                    <option value="activo" {{ old('estado')=='activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ old('estado')=='inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="doctor-submit text-end">
                                <button type="submit" class="btn btn-primary submit-form me-2">Salvar</button>
                                <a href="{{ route('cp.users.index') }}" class="btn btn-secondary">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection