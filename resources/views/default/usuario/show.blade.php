@extends('home.index')

@section('titulo', 'Usuários')

@section('conteudo')
    <div id="dadoPrincipal">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Lista de Usuário</h4>
                        <p class="mb-0">
                            Usuários são essenciais para a interação e utilização dos serviços, promovendo <br>
                            uma experiência personalizada e eficiente para todos.
                        </p>
                    </div>
                    <a href="#" class="btn btn-primary add-list" data-toggle="modal" data-target="#addUsuario"><i
                            class="las la-plus mr-3"></i>
                        Adicionar
                    </a>
                </div>
                @include('partials.session')
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table id="datatable" class="table data-table table-striped">
                        <thead>
                            <tr class="ligth ligth-data">
                                <th>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox1">
                                        <label for="checkbox1" class="mb-0"></label>
                                    </div>
                                </th>
                                <th>Nome</th>
                                <th>Estado</th>
                                <th>Email</th>
                                <th>Verificado</th>
                                <th>Grupo</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            @foreach ($users as $usr)
                                <tr>
                                    <td>
                                        <div class="checkbox d-inline-block">
                                            <input type="checkbox" class="checkbox-input" id="checkbox2">
                                            <label for="checkbox2" class="mb-0"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if (!$usr->foto_perfil)
                                                <img src="{{ asset('assets/images/user/1.png') }}"
                                                    class="img-fluid rounded avatar-50 mr-3" alt="image">
                                            @else
                                                <img src="{{ asset('storage/' . $usr->foto_perfil) }}"
                                                    class="img-fluid rounded avatar-50 mr-3" alt="image">
                                            @endif
                                            <div>
                                                {{ $usr->nome }}
                                                <p class="mb-0"><small>{{ calcTempo($usr->created_at) }}</small></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($usr->status)
                                            <h6>Ativo</h6>
                                        @else
                                            <h6>Inativo</h6>
                                        @endif
                                    </td>
                                    <td>{{ $usr->email }}</td>
                                    <td>
                                        @if ($usr->email_verified_at)
                                            <h6>Verificado</h6>
                                        @else
                                            <h6>Não verificado</h6>
                                        @endif
                                    </td>
                                    <td>{{ @$usr->grupo->nome }}</td>
                                    <td>
                                        <div class="d-flex align-items-center list-action">
                                            <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top"
                                                title="" data-original-title="View" href="javascript:void(0)"><i
                                                    class="ri-eye-line mr-0"></i>
                                            </a>
                                            <a href="javascript:void(0)" class="badge bg-success mr-2"
                                                onclick="getDataFarma('{{ route('farmacia.get', ['id' => $usr->id]) }}')"
                                                title="Editar {{ $usr->nome }}">
                                                <i class="ri-pencil-line mr-0"></i>
                                            </a>
                                            <a class="badge bg-info mr-2" href="javascript:void(0)" title="Adicionar cargo ou grupo"
                                                onclick="addCargoGrupo('{{ route('user.get', ['id' => $usr->id]) }}')">
                                                <i class="ri-key-line"></i>
                                            </a>
                                            @if ($usr->status == 1)
                                                    <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top"
                                                        title="Bloquear {{ $usr->nome }}" href="javascript:void(0)" onclick="modalBloquearUsr('{{ $usr->id }}', '{{ $usr->nome }}', '{{ route('usuario') }}')">
                                                        <i class="ri-spam-3-line"></i>
                                                    </a>
                                                @else
                                                    <a class="badge bg-info mr-2" data-toggle="tooltip" data-placement="top"
                                                        title="Desbloquear {{ $usr->nome }}" href="{{ route('u.desbloquear', ['id' => $usr->id]) }}">
                                                        <i class="ri-spam-3-line"></i>
                                                    </a>
                                                @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('modals._addCargoGrupo')
@endsection
