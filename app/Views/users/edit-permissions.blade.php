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

                        <p class="text-muted">Marque as permissões directas que pretende atribuir a este utilizador. Permissões herdadas por roles aparecem a cinzento e não podem ser desmarcadas aqui.</p>

                        @php
                            // agrupar permissões por prefixo (antes do primeiro ponto)
                            $groups = [];
                            foreach ($permissions as $p) {
                                $parts = explode('.', $p->name);
                                $group = $parts[0] ?? 'outros';
                                $groups[$group][] = $p;
                            }
                        @endphp

                        <div class="row g-3">
                            @foreach($groups as $groupName => $perms)
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <h6 class="mb-0 text-capitalize">{{ str_replace(['_','-'], ' ', $groupName) }}</h6>
                                                <div>
                                                    <input type="checkbox" class="form-check-input js-select-group" data-group="{{ $groupName }}" id="select_all_{{ $groupName }}">
                                                    <label class="form-check-label ms-2" for="select_all_{{ $groupName }}">Selecionar todos</label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                @foreach($perms as $perm)
                                                    @php
                                                        $isDirect = in_array($perm->name, $directPermissions ?? []);
                                                        $viaRole = isset($rolePermissions[$perm->name]);
                                                        $rolesForPerm = $permissionRolesMap[$perm->name] ?? [];
                                                        $humanAction = ucfirst(explode('.', $perm->name)[1] ?? $perm->name);
                                                    @endphp

                                                    <div class="col-12 col-sm-6 col-md-4">
                                                        <div class="form-check p-2 border rounded mb-2" style="min-height:56px; display:flex; align-items:center; gap:8px;">
                                                            <input class="form-check-input js-perm-checkbox" type="checkbox" name="permissions[]" value="{{ $perm->name }}" id="perm_{{ $perm->id }}" {{ ($isDirect || $viaRole) ? 'checked' : '' }} {{ $viaRole ? 'disabled' : '' }} data-group="{{ $groupName }}">
                                                            <div class="flex-fill">
                                                                <label class="form-check-label mb-0 d-block" for="perm_{{ $perm->id }}">
                                                                    <strong>{{ $humanAction }}</strong>
                                                                </label>
                                                                <small class="text-muted d-block text-truncate">{{ $perm->name }}</small>
                                                            </div>
                                                            @if($viaRole)
                                                                <span class="badge bg-secondary" title="Fornecida por: {{ implode(', ', $rolesForPerm) }}">via role</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-3 d-flex justify-content-end gap-2">
                            <a href="{{ route('cp.users.show', $user->id) }}" class="btn btn-outline-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary">Guardar alterações</button>
                        </div>
                    </form>

                    <style>
                        /* Pequenos ajustes para melhor leitura */
                        .js-perm-checkbox:disabled + .flex-fill { opacity: 0.7; }
                        .card .form-check { background: #fff; }
                        @media (max-width: 575px) {
                            .card .form-check { flex-direction: row; }
                        }
                    </style>

                    <script>
                        (function () {
                            // Select all logic por grupo
                            document.querySelectorAll('.js-select-group').forEach(function(cb){
                                cb.addEventListener('change', function(){
                                    var group = this.getAttribute('data-group');
                                    var checked = this.checked;
                                    document.querySelectorAll('.js-perm-checkbox[data-group="'+group+'"]').forEach(function(p){
                                        if (!p.disabled) p.checked = checked;
                                    });
                                });
                            });

                            // Se todas as checkboxes do grupo estiverem marcadas, marca o select_all correspondente
                            document.querySelectorAll('.js-perm-checkbox').forEach(function(p){
                                p.addEventListener('change', function(){
                                    var group = this.getAttribute('data-group');
                                    var all = Array.from(document.querySelectorAll('.js-perm-checkbox[data-group="'+group+'"]')).filter(function(x){ return !x.disabled; });
                                    var sel = all.length > 0 && all.every(function(x){ return x.checked; });
                                    var master = document.getElementById('select_all_'+group);
                                    if (master) master.checked = sel;
                                });
                            });
                        })();
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
