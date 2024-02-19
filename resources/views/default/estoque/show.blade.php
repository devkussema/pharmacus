@extends('home.index')

@section('titulo', 'Estoque Farmacéutico')

@section('conteudo')
    <div id="dadoPrincipal">
        <div class="row">
            <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">Estoque {{ Auth::user()->area_hospitalar->area_hospitalar->nome }}</h4>
                </div>
                @php
                    use App\Models\ProdutoEstoque;
                    $area_hospitalar_id = Auth::user()->area_hospitalar->area_hospitalar->id;
                    $produtoEstoques = ProdutoEstoque::whereHas('estoque', function ($query) use ($area_hospitalar_id) {
                        $query->where('area_hospitalar_id', $area_hospitalar_id);
                    })->with('saldo')->get();

                @endphp

                {{-- <a href="#" class="btn btn-primary add-list" style="float: right" data-toggle="modal" data-target="#addFarmacia"><i
                        class="las la-plus mr-3"></i>
                    Adicionar
                </a> --}}
            </div>
            @foreach ($produtoEstoques as $p)
                Grupo Farmaco: {{ $p->grupo_farmaco->nome }} <br>
                Saldo qtd: {{ $p->saldo->qtd }} <hr>
                <hr>
            @endforeach
            @include('partials.session')
            <div class="col-lg-12">
                <div class="row">
                    @foreach (\App\Models\GrupoFarmacologico::with([
            'produtos.saldo' => function ($query) {
                $query->orderByDesc('qtd')->take(4);
            },
        ])->whereHas('produtos', function ($query) {
                $query->whereHas('estoque', function ($query) {
                    $query->where('area_hospitalar_id', auth()->user()->area_hospitalar->area_hospitalar_id);
                });
            })->distinct()->get() as $grupo)
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
                                                {{-- <small>
                                                    @foreach ($grupo->produtos as $produto)
                                                        {{ $produto->forma }} <br>
                                                    @endforeach
                                                </small> --}}
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
                </div>
            </div>
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
                                <th>Grupo</th>
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
                                    <td><b>{{ $est->produto->designacao }}</b></td>
                                    <td>{{ $est->produto->dosagem }}</td>
                                    <td>{{ $est->produto->forma }}</td>
                                    <td>{{ $est->produto->num_lote }}</td>
                                    <td><b>{{ $est->produto->grupo_farmaco->nome }}</b></td>
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
                                            <a class="badge bg-success mr-2" title="Dar baixa" href="javascript:void(0)"
                                                onclick="modalDarBaixa({{ $est->produto->id }})">
                                                <i class="ri-install-line mr-0"></i>
                                            </a>
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
    @include('modals._estoqueOps')
    <script type="text/javascript">
        // $(document).ready(function() {
        //     $('.tbl-estoque').DataTable({
        //         "processing": true,
        //         "serverSide": true,
        //         "ajax": "{{ route('estoque.ajax') }}",
        //         "columns": [
        //             { "data": null }, // Checkbox
        //             { "data": "produto.designacao" },
        //             { "data": "produto.dosagem" },
        //             { "data": "produto.forma" },
        //             { "data": "produto.num_lote" },
        //             { "data": "produto.grupo_farmaco.nome" },
        //             { "data": "produto.saldo.qtd" },
        //             { "data": "produto.num_documento" },
        //             { "data": "produto.data_expiracao" },
        //             { "data": null } // Ações
        //         ]
        //     });
        // });
    </script>

@endsection
