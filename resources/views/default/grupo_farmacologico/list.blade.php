@extends('home.index')

@section('titulo', 'Grupos Farmacológicos')

@section('conteudo')
    <div id="dadoPrincipal">
        <div class="row">
            <div class="col-lg-12">
                @include('partials.session')
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Grupos Farmacológicos</h4>
                    </div>
                    {{-- <a href="#" data-toggle="modal" data-target="#area_hospitalar" class="btn btn-primary add-list">
                        <i class="las la-plus mr-3"></i>
                        Adicionar
                    </a> --}}
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
                                <th>Descrição</th>
                                {{-- <th class="hide-on-print">Ação</th> --}}
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            @foreach ($gfs as $gf)
                                <tr>
                                    <td>
                                        <div class="checkbox d-inline-block">
                                            <input type="checkbox" class="checkbox-input" id="checkbox2">
                                            <label for="checkbox2" class="mb-0"></label>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $gf->nome }}
                                    </td>
                                    <td>
                                        {{ $gf->descricao }}
                                    </td>
                                    {{-- <td class="hide-on-print">
                                        <div class="d-flex align-items-center list-action">
                                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top"
                                                title="Ver perfil de {{ $usr->nome }}" href="{{ route('u.perfil', ['username' => $usr->username]) }}">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                                <a class="badge bg-info mr-2" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Adicionar permissões"
                                                    onclick="">
                                                    <i class="ri-key-line"></i>
                                                </a>
                                                <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top"
                                                    title="Bloquear" href="javascript:void(0)" onclick="">
                                                    <i class="ri-spam-3-line"></i>
                                                </a>
                                                <a class="badge bg-info mr-2" data-toggle="tooltip" data-placement="top"
                                                    title="Desbloquear" href="">
                                                    <i class="ri-spam-3-line"></i>
                                                </a>
                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
