@extends('admin::layout.main')

@section('title', 'Detalhes do Utilizador')

@section('content')
    <div class="row">
        <div class="col-12">
            @include('admin::partials.session')
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="me-4">
                            @if(!empty($user->foto_perfil))
                                <img src="{{ asset('storage/' . $user->foto_perfil) }}" alt="Foto de {{ $user->nome }}" class="rounded-circle" width="120" height="120">
                            @else
                                <div class="avatar avatar-lg bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:120px;height:120px;">
                                    <strong style="font-size:28px;">{{ strtoupper(substr($user->nome ?? $user->email,0,1)) }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="flex-fill">
                            <h3 class="mb-1">{{ $user->nome ?? '—' }}</h3>
                            <p class="text-muted mb-1">{{ $user->email }}</p>
                            <p class="mb-0">
                                <small class="text-muted">Telefone:</small>
                                <strong>{{ $user->telefone ?? '—' }}</strong>
                            </p>
                            <p class="mb-0">
                                <small class="text-muted">Papel:</small>
                                <strong>{{ $user->role ?? '—' }}</strong>
                            </p>
                            <p class="mb-0">
                                <small class="text-muted">Grupo:</small>
                                <strong>{{ optional($user->grupo)->nome ?? '—' }}</strong>
                            </p>
                            <p class="mb-2">
                                <small class="text-muted">Criado em:</small>
                                <strong>{{ $user->created_at?->format('d/m/Y H:i') ?? '—' }}</strong>
                            </p>

                            <div class="mt-3">
                                <a href="{{ route('cp.users.edit', $user->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                <a href="{{ route('cp.users.index') }}" class="btn btn-sm btn-outline-secondary ms-2">Voltar à lista</a>

                                {{-- Formulário de eliminação com confirmação simples --}}
                                <form action="{{ route('cp.users.destroy', $user->id) }}" method="POST" class="d-inline-block ms-2" onsubmit="return confirm('Tem a certeza que deseja remover este utilizador?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Remover</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5>Informações adicionais</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">Telefone secundário</dt>
                                <dd class="col-sm-8">{{ $user->telefone_sec ?? '—' }}</dd>

                                <dt class="col-sm-4">Estado</dt>
                                <dd class="col-sm-8">{{ $user->status ?? '—' }}</dd>

                                <dt class="col-sm-4">Permite cadastrar produtos</dt>
                                <dd class="col-sm-8">{{ !empty($user->pode_cadastrar_produtos) ? 'Sim' : 'Não' }}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <h6>Observações</h6>
                            <p class="text-muted">{{ $user->observacoes ?? '—' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
