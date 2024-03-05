@extends('home.index')

@section('titulo', 'Lista de funcionários')

@section('conteudo')
    <div id="dadoPrincipal">
        <div class="row">
            <div class="col-lg-12">
                @include('partials.session')
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Funcionários</h4>
                    </div>
                    <a href="#" data-toggle="modal" data-target="#area_hospitalar" class="btn btn-primary add-list">
                        <i class="las la-plus mr-3"></i>
                        Adicionar
                    </a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="data-table table mb-0 tbl-server-info tbl-area_hospitalar">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox1">
                                        <label for="checkbox1" class="mb-0"></label>
                                    </div>
                                </th>
                                <th>Nome</th>
                                <th>Área Hospitalar</th>
                                <th>Estado</th>
                                <th class="hide-on-print">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            @if ($cfg == 1)
                                @foreach ($usrs as $usr)
                                    <tr>
                                        <td>
                                            <div class="checkbox d-inline-block">
                                                <input type="checkbox" class="checkbox-input" id="checkbox2">
                                                <label for="checkbox2" class="mb-0"></label>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $usr->nome }}
                                        </td>
                                        <td>
                                            {{ $usr->area_hospitalar->area_hospitalar->nome }}
                                        </td>
                                        <td>
                                            @if ($usr->status == 0)
                                                Inativo
                                            @else
                                                Ativo
                                            @endif
                                        </td>
                                        <td class="hide-on-print">
                                            <div class="d-flex align-items-center list-action">
                                                <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top"
                                                    title="Ver perfil de {{ $usr->nome }}" href="{{ route('u.perfil', ['username' => $usr->username]) }}">
                                                    <i class="ri-eye-line"></i>
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
                            @endif
                            {{-- @foreach ($usrs as $usr)
                                <tr>
                                    <td>
                                        <div class="checkbox d-inline-block">
                                            <input type="checkbox" class="checkbox-input" id="checkbox2">
                                            <label for="checkbox2" class="mb-0"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('u.perfil', ['username' => $usr->username]) }}">
                                            {{ $usr->nome }}
                                        </a>
                                    </td>
                                    <td>{{ $usr->area_hospitalar->area_hospitalar->nome }}</td>
                                    <td class="hide-on-print">
                                        <div class="d-flex align-items-center list-action">
                                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top"
                                                title="Ver perfil de {{ $usr->nome }}" href="{{ route('u.perfil', ['username' => $usr->username]) }}">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top"
                                                title="Editar" href="javascript:void(0)">
                                                <i class="ri-pencil-line mr-0"></i>
                                            </a>
                                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top"
                                                title="Bloquear {{ $usr->nome }}" href="javascript:void(0)" onclick="modalBloquearUsr('{{ $usr->id }}', '{{ $usr->nome }}', '{{ route('usuario') }}')">
                                                <i class="ri-spam-3-line"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('modals.__funcionario')
@endsection
