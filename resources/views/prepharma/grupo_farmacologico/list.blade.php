@extends('layout.app')

@section('titulo', 'Grupos Farmacológicos')

@section('content')
    <div class="content">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Grupos Farmacológicos</a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Ver todas</li>
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
                                        <h3>Grupos Farmacológicos</h3>
                                        <div class="doctor-search-blk">
                                            <div class="top-nav-search table-search-blk">
                                                <form>
                                                    <input type="text" id="search-table" class="form-control" placeholder="Procure aqui">
                                                    <a class="btn"><img
                                                            src="{{ assetr('assets/img/icons/search-normal.svg') }}"
                                                            alt></a>
                                                </form>
                                            </div>
                                            <div class="add-group">
                                                <a data-bs-toggle="modal" data-bs-target="#AddAH" href="javascript:void(0)"
                                                    class="btn btn-primary add-pluss ms-2">
                                                    <img src="{{ assetr('assets/img/icons/plus.svg') }}" alt>
                                                </a>
                                                <a href="javascript:;" class="btn btn-primary doctor-refresh ms-2"><img
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
                            <table class="table border-0 custom-table comman-table datatable mb-0  table-gfarmacos" id="table-content">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal para dar baixa --}}
        <div class="modal fade" id="DarBaixa" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="tituloModal">Adicionar Cargo</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formBaixaEstoque" action="{{ route('estoque.baixa') }}" method="POST">
                            @csrf
                            @php
                                $area_h_id = @$area_id;
                                $farmacia_id = @auth()->user()->isFarmacia->farmacia_id
                                    ? auth()->user()->isFarmacia->farmacia_id
                                    : @auth()->user()->area_hospitalar->area_hospitalar->farmacia_id;
                            @endphp
                            <div class="form-group">
                                <label for="endereco">Área *</label>
                                <input type="hidden" name="user_id" id="user_id">
                                <select name="area_hospitalar_id" id="" class="form-control">
                                    @foreach (\App\Models\FarmaciaAreaHospitalar::where('farmacia_id', $farmacia_id)->get() as $ahw)
                                        @if ($ahw->area_hospitalar->id != $area_h_id)
                                            <option value="{{ $ahw->area_hospitalar->id }}">
                                                {{ $ahw->area_hospitalar->nome }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="qtd_">Total de Caixas</label>
                                <input type="text" name="descritivo" class="form-control" id="descritivo_"
                                    min="1">
                            </div>

                            <div class="form-group">
                                <input type="hidden" name="produto_id" id="id_produto">
                                <label for="qtd_">Quantidade a transferir</label>
                                <input type="number" name="qtd" class="form-control" id="qtd_"
                                    placeholder="Quantidade a transferir" min="1"
                                    max="{{ @getCaixa($est->produto->descritivo) }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
