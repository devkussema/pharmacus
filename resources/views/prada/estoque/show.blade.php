@extends('home.index')

@section('titulo', 'Estoque Farmacéutico')

@section('conteudo')
    <div id="dadoPrincipal">
        <div class="row">
            <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">Estoque {{ Auth::user()->area_hospitalar->area_hospitalar->nome }}</h4>
                </div>
                {{-- <a href="#" class="btn btn-primary add-list" style="float: right" data-toggle="modal" data-target="#addFarmacia"><i
                        class="las la-plus mr-3"></i>
                    Adicionar
                </a> --}}
            </div>
            @include('partials.session')
            <div class="col-lg-12">
                <div class="row">
                    @foreach (\App\Models\GrupoFarmacologico::with(['produtos.saldo' => function ($query) {
                        $query->orderByDesc('qtd')->take(4);
                    }])->get() as $grupo)
                        @php
                            $totalProdutos = $grupo->produtos->sum('saldo.qtd');
                        @endphp

                        @if ($totalProdutos > 0)
                            <div class="col-lg-3 col-md-3">
                                <div class="card card-block card-stretch card-height">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-4 card-total-sale">
                                            <div class="icon iq-icon-box-2 bg-info-light">
                                                <img src="{{ asset('assets/images/product/1.png') }}" class="img-fluid"
                                                    alt="image">
                                            </div>
                                            <div>
                                                <p class="mb-2">{{ $grupo->nome }}</p>
                                                <h4>{{ $totalProdutos }}</h4>
                                                <small>
                                                    @foreach ($grupo->produtos as $produto)
                                                        {{ $produto->forma }} <br>
                                                    @endforeach
                                                </small>
                                            </div>
                                        </div>
                                        <div class="iq-progress-bar mt-2">
                                            <span class="bg-info iq-progress progress-1" data-percent="85">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    {{-- <div class="col-lg-3 col-md-3">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-danger-light">
                                        <img src="{{ asset('assets/images/product/2.png') }}" class="img-fluid"
                                            alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">Total Gestores</p>
                                        <h4>{{ \App\Models\GerenteFarmacia::all()->count() }}</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-danger iq-progress progress-1" data-percent="70">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-success-light">
                                        <img src="{{ asset('assets/images/product/3.png') }}" class="img-fluid"
                                            alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">Áreas Hospitalares</p>
                                        <h4>{{ \App\Models\AreaHospitalar::all()->count() }}</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-success iq-progress progress-1" data-percent="75">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-success-light">
                                        <img src="{{ asset('assets/images/product/3.png') }}" class="img-fluid"
                                            alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">Áreas Hospitalares</p>
                                        <h4>{{ \App\Models\AreaHospitalar::all()->count() }}</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-success iq-progress progress-1" data-percent="75">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            {{-- <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-info-light">
                                        <img src="{{ asset('assets/images/product/1.png') }}" class="img-fluid"
                                            alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">Total de Farmácias</p>
                                        <h4>{{ \App\Models\Farmacia::all()->count() }}</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-info iq-progress progress-1" data-percent="85">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-danger-light">
                                        <img src="{{ asset('assets/images/product/2.png') }}" class="img-fluid"
                                            alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">Aa</p>
                                        <h4>{{ \App\Models\GerenteFarmacia::all()->count() }}</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-danger iq-progress progress-1" data-percent="70">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-success-light">
                                        <img src="{{ asset('assets/images/product/3.png') }}" class="img-fluid"
                                            alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">Áreas Hospitalares</p>
                                        <h4>{{ \App\Models\AreaHospitalar::all()->count() }}</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-success iq-progress progress-1" data-percent="75">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-success-light">
                                        <img src="{{ asset('assets/images/product/3.png') }}" class="img-fluid"
                                            alt="image">
                                    </div>
                                    <div>
                                        <p class="mb-2">Áreas Hospitalares</p>
                                        <h4>{{ \App\Models\AreaHospitalar::all()->count() }}</h4>
                                    </div>
                                </div>
                                <div class="iq-progress-bar mt-2">
                                    <span class="bg-success iq-progress progress-1" data-percent="75">
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="data-table table mb-0 tbl-server-info tbl-estoque">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox1">
                                        <label for="checkbox1" class="mb-0"></label>
                                    </div>
                                </th>
                                <th>Designação</th>
                                <th>Dosagem</th>
                                <th>Forma</th>
                                <th>Lote</th>
                                <th>Qtd.</th>
                                <th>Documento nº</th>
                                <th>Data Expiração</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            {{-- Gerado automaticamente --}}
                            @foreach ($estoque as $est)
                                <tr>
                                    <td>
                                        <div class="checkbox d-inline-block">
                                            <input type="checkbox" class="checkbox-input" id="checkbox2">
                                            <label for="checkbox2" class="mb-0"></label>
                                        </div>
                                    </td>
                                    <td>{{ $est->produto->designacao }}</td>
                                    <td>{{ $est->produto->dosagem }}</td>
                                    <td>{{ $est->produto->forma }}</td>
                                    <td>{{ $est->produto->num_lote }}</td>
                                    <td>{{ $est->produto->saldo->qtd }}</td>
                                    <td>{{ $est->produto->num_documento }}</td>
                                    <td>{{ $est->produto->data_expiracao }}</td>
                                    <td>
                                        <div class="d-flex align-items-center list-action">
                                            @if (isCargo('Gerente'))
                                                <a class="badge bg-info mr-2" data-toggle="tooltip" data-placement="top"
                                                    title="Adicionar Responsável" href="javascript:void(0)" onclick="">
                                                    <i class="ri-key-2-line mr-0"></i>
                                                </a>
                                            @endif
                                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top"
                                                title="Editar" href="javascript:void(0)" onclick="">
                                                <i class="ri-pencil-line mr-0"></i>
                                            </a>
                                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top"
                                                title="Eliminar" href="javascript:void(0)" onclick="">
                                                <i class="ri-delete-bin-line mr-0"></i>
                                            </a>
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
@endsection
