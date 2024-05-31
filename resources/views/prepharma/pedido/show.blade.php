@extends('layout.app')

@section('titulo', 'Pedidos')

@section('content')
    <div class="content">
        @include('partials.session')
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Pedidos</a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Ver todos</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table show-entire">
                    <div class="card-body">

                        <div class="page-table-header mb-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="doctor-table-blk">
                                        <h3>Todos Pedidos </h3>
                                        <div class="doctor-search-blk">
                                            <div class="top-nav-search table-search-blk">
                                                <form>
                                                    <input type="text" id="search-table" class="form-control"
                                                        placeholder="Procure aqui">
                                                    <a class="btn">
                                                        <img src="{{ assetr('assets/img/icons/search-normal.svg') }}" alt>
                                                    </a>
                                                </form>
                                            </div>
                                            <div class="add-group">
                                                <a data-bs-toggle="modal" data-bs-target="#AddAH" href="javascript:void(0)"
                                                    class="btn btn-primary add-pluss ms-2">
                                                    <img src="{{ assetr('assets/img/icons/plus.svg') }}" alt>
                                                </a>
                                                <a href="javascript:;" data-bs-toggle="modal" data-bs-target="#ver-pedido"
                                                    class="btn btn-primary doctor-refresh ms-2"><img
                                                        src="{{ assetr('assets/img/icons/re-fresh.svg') }}" alt></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="javascript:;" class=" me-2"><img
                                            src="{{ assetr('assets/img/icons/pdf-icon-01.svg') }}" alt></a>
                                    <a href="javascript:;" class=" me-2"><img
                                            src="{{ assetr('assets/img/icons/pdf-icon-02.svg') }}" alt></a>
                                    <a href="javascript:;" class=" me-2"><img
                                            src="{{ assetr('assets/img/icons/pdf-icon-03.svg') }}" alt></a>
                                    <a href="javascript:;"><img src="{{ assetr('assets/img/icons/pdf-icon-04.svg') }}"
                                            alt></a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table border-0 custom-table comman-table datatable mb-0" id="table-content">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Área</th>
                                        <th>Produto</th>
                                        <th>Gastos</th>
                                        <th>Existência</th>
                                        <th>Qtd Pedida</th>
                                        <th>Qtd Disponibilizada</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pedidos as $p)
                                        <tr>
                                            <td>
                                                <a href="#">
                                                    {{ $p->user_a->nome }}
                                                </a>
                                            </td>
                                            <td>{{ $p->area_a->nome }}</td>
                                            <td><b>{{ $p->item->designacao }}</b></td>
                                            <td>{{ $p->gastos }}</td>
                                            <td>{{ $p->existencia }}</td>
                                            <td>{{ $p->qtd_pedida }}</td>
                                            <td>{{ @$p->qtd_disponibilizada }}</td>
                                            <td class="text-end align-items-center justify-content-between">
                                                <div class="dropdown dropdown-action">
                                                    <a href="{{ route('pedido.atender', ['id' => $p->id]) }}" class="custom-badge status-green ">Atender</a>
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
        </div>
    </div>
@endsection
