@extends('admin::layout.main')

@section('title', 'Editar Permissões')

@section('content')
    @include('admin::partials.session')

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3">Editar Permissões — {{ $user->nome ?? $user->email }}</h4>

                    <form action="{{ route('cp.users.permissions.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <p class="text-muted">Marque as permissões que pretende atribuir a este utilizador. As permissões são agrupadas por módulo (prefixo antes do ponto).</p>

                        @php
                            // agrupar permissões por prefixo (antes do primeiro ponto)
                            $groups = [];
                            foreach ($permissions as $p) {
                                $parts = explode('.', $p->name);
                                $group = $parts[0] ?? 'outros';
                                $groups[$group][] = $p;
                            }
                        @endphp

                        @foreach($groups as $groupName => $perms)
                            <div class="mb-3">
                                <h6 class="mb-2 text-capitalize">{{ $groupName }}</h6>
                                <div class="row">
                                    @foreach($perms as $perm)
                                        <div class="col-6 col-md-4">
                                            <div class="form-check">
                                                @php
                                                    $isDirect = in_array($perm->name, $directPermissions ?? []);
                                                    $viaRole = isset($rolePermissions[$perm->name]);
                                                    $rolesForPerm = $permissionRolesMap[$perm->name] ?? [];
                                                @endphp

                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $perm->name }}" id="perm_{{ $perm->id }}" {{ ($isDirect || $viaRole) ? 'checked' : '' }} {{ $viaRole ? 'disabled' : '' }}>
                                                <label class="form-check-label d-flex align-items-center" for="perm_{{ $perm->id }}">
                                                    <span class="me-2">{{ $perm->name }}</span>
                                                    @if($viaRole)
                                                        <small class="badge bg-secondary ms-2" title="Permissão fornecida por role(s)">{{ implode(', ', $rolesForPerm) }}</small>
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="{{ route('cp.users.show', $user->id) }}" class="btn btn-outline-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
