@extends('admin::layout.main')

@section('title', 'Detalhes do Utilizador')

@section('content')
    @include('admin::partials.session')

    <div class="row">
        <div class="col-xl-10 offset-xl-1">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb bg-transparent p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('cp.admin.index') }}">Painel</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cp.users.index') }}">Utilizadores</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $user->nome ?? $user->email }}</li>
                </ol>
            </nav>

            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row gap-3">
                        <div class="flex-shrink-0 text-center" style="min-width:150px;">
                            @if(!empty($user->foto_perfil) && \Storage::disk('public')->exists($user->foto_perfil))
                                <img src="{{ asset('storage/' . $user->foto_perfil) }}" alt="Foto de {{ $user->nome }}" class="rounded-circle img-fluid mb-2" style="width:140px;height:140px;object-fit:cover;">
                            @else
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mb-2" style="width:140px;height:140px;font-size:40px;">
                                    {{ strtoupper(substr($user->nome ?? $user->email,0,1)) }}
                                </div>
                            @endif

                            <div>
                                <a href="{{ route('cp.users.edit', $user->id) }}" class="btn btn-sm btn-primary w-100 mb-1">Editar</a>
                                <a href="{{ route('cp.users.index') }}" class="btn btn-sm btn-outline-secondary w-100 mb-1">Voltar</a>
                                <a href="{{ route('cp.users.permissions.edit', $user->id) }}" class="btn btn-sm btn-warning w-100">Editar permissões</a>
                            </div>
                        </div>

                        <div class="flex-fill">
                            <div class="d-flex align-items-start justify-content-between">
                                <div>
                                    <h2 class="mb-1">{{ $user->nome ?? '—' }}</h2>
                                    <div class="mb-2 text-muted">{{ $user->email }}</div>

                                    <div class="d-flex flex-wrap gap-2 mb-2">
                                        <span class="badge bg-info text-dark">{{ ucfirst($user->role ?? '—') }}</span>
                                        @if(!empty($user->status))
                                            <span class="badge bg-{{ $user->status === 'activo' ? 'success' : 'secondary' }}">{{ ucfirst($user->status) }}</span>
                                        @endif
                                        <span class="badge bg-light text-dark">Criado: {{ $user->created_at?->format('d/m/Y') ?? '—' }}</span>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <small class="text-muted">ID: {{ $user->id }}</small>
                                </div>
                            </div>

                            <hr>

                            <div class="pt-3">
                                <h5>Perfil</h5>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <dl class="row mb-0">
                                            <dt class="col-sm-4">Telefone</dt>
                                            <dd class="col-sm-8">{{ $user->telefone ?? '—' }}</dd>

                                            <dt class="col-sm-4">Telefone (sec.)</dt>
                                            <dd class="col-sm-8">{{ $user->telefone_sec ?? '—' }}</dd>

                                            <dt class="col-sm-4">Grupo</dt>
                                            <dd class="col-sm-8">{{ optional($user->grupo)->nome ?? '—' }}</dd>
                                        </dl>
                                    </div>

                                    <div class="col-md-6">
                                        <h6>Observações</h6>
                                        <p class="text-muted">{{ $user->observacoes ?? '—' }}</p>
                                    </div>
                                </div>

                                <hr>

                                <h5>Atividades</h5>
                                <div id="js-user-activities" class="mb-3">
                                    <p class="text-muted">Clique em carregar para buscar actividades recentes.</p>
                                    <div>
                                        <button id="js-load-activities" class="btn btn-sm btn-outline-primary">Carregar actividades</button>
                                    </div>
                                </div>

                                <hr>

                                <h5>Permissões</h5>
                                <ul>
                                    <li>Role: <strong>{{ $user->role ?? '—' }}</strong></li>
                                    <li>Pode cadastrar produtos: <strong>{{ !empty($user->pode_cadastrar_produtos) ? 'Sim' : 'Não' }}</strong></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        (function () {
            const btn = document.getElementById('js-load-activities');
            const activitiesContainer = document.getElementById('js-user-activities');
            let loaded = false;

            function renderActivities(items) {
                if (!items || items.length === 0) {
                    activitiesContainer.innerHTML = '<p class="text-muted">Sem atividades registadas.</p>';
                    return;
                }

                const list = document.createElement('div');
                list.className = 'list-group';

                items.forEach(item => {
                    const el = document.createElement('div');
                    el.className = 'list-group-item';
                    el.innerHTML = `
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1">${item.tipo ?? 'Atividade'}</h6>
                            <small class="text-muted">${item.created_at ?? ''}</small>
                        </div>
                        <p class="mb-1 text-truncate">${item.descricao ?? (item.meta? JSON.stringify(item.meta) : '')}</p>
                    `;
                    list.appendChild(el);
                });

                activitiesContainer.innerHTML = '';
                activitiesContainer.appendChild(list);
            }

            btn.addEventListener('click', function () {
                if (loaded) return;
                loaded = true;
                btn.setAttribute('disabled', 'disabled');
                const userId = '{{ $user->id }}';
                const url = '/atividades/json?user_id=' + encodeURIComponent(userId) + '&per_page=10';

                fetch(url, { headers: { 'Accept': 'application/json' } })
                    .then(res => res.json())
                    .then(data => {
                        renderActivities(data.items || []);
                    })
                    .catch(() => {
                        activitiesContainer.innerHTML = '<p class="text-danger">Erro ao carregar atividades.</p>';
                    })
                    .finally(() => {
                        btn.removeAttribute('disabled');
                    });
            });
        })();
    </script>
@endsection
