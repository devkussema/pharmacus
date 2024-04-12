@extends('home.index')

@section('titulo', 'Estoque Farmacéutico')

@section('conteudo')
    <div id="dadoPrincipal">
        <div class="row">
            <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">Estoque {{ $ah->nome }}</h4>
                </div>
                @php
                    use App\Models\ProdutoEstoque;
                    if (isset($isAdm)) {
                        $area_hospitalar_id = 
                    }
                    $auser = Auth::user()->area_hospitalar->area_hospitalar->id;

                    $area_hospitalar_id = isset($isAdm) ? $area_id : $auser;
                    $produtoEstoques = ProdutoEstoque::whereHas('estoque', function ($query) use ($area_hospitalar_id) {
                        $query->where('area_hospitalar_id', $area_hospitalar_id);
                    })
                        ->with('saldo')
                        ->get()
                        ->take(8);
                @endphp
            </div>
            <div class="col-lg-12">
            @include('partials.notifies')
            @include('partials.session')
                <div class="row">
                    @php $gruposImpressos = []; @endphp
                    @foreach ($produtoEstoques as $p)
                        @php
                            $totalQtd = $produtoEstoques->where('grupo_farmaco.id', $p->grupo_farmaco_id)->sum('saldo.qtd');
                            #$totalProdutos = $p->grupo_farmaco->produtos->sum('saldo.qtd');
                            $totalProdutos = $totalQtd;
                        @endphp

                        @php
                            $colors = ['bg-green', 'bg-purple-light', 'bg-indigo', 'bg-info-light', 'bg-warning-light', 'bg-teal-light', 'bg-danger-light', 'bg-success-light'];
                            $colorIndex = 0;
                        @endphp
                        @if ($totalProdutos > 0)
                            @if (!in_array($p->grupo_farmaco->id, $gruposImpressos))
                                <div class="col-lg-3 col-md-3">
                                    <div class="card card-block card-stretch card-height">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-4 card-total-sale">
                                                <div class="icon iq-icon-box-2 {{ $colors[$colorIndex] }}">
                                                    <img src="{{ pharma('assets/images/white__logo.png') }}" class="img-fluid" alt="image">
                                                </div>
                                                <div>
                                                    <p class="mb-2">{{ $p->grupo_farmaco->nome }}</p>
                                                    <h4>{{ $totalProdutos }}</h4>
                                                    {{-- <small>
                                                        @foreach ($grupo->produtos as $produto)
                                                            {{ $produto->forma }} <br>
                                                        @endforeach
                                                    </small> --}}
                                                </div>
                                            </div>
                                            <div class="iq-progress-bar mt-2">
                                                <span class="{{ $colors[$colorIndex++] }} iq-progress progress-1" data-percent="85">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $gruposImpressos[] = $p->grupo_farmaco->id;
                                @endphp
                        @if ($colorIndex >= count($colors))
                            @php $colorIndex = 0; @endphp
                        @endif
                            @endif
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
                                <th>Fornecedor</th>
                                <th>Lote</th>
                                <th>Grupo</th>
                                <th>Qtd. Caixa</th>
                                <th>Qtd. Unit.</th>
                                <th>Documento nº</th>
                                <th>Data Expiração</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            {{-- Gerado automaticamente --}}
                            @foreach ($estoque as $est)
                                @if ($est->produto->confirmado != 0)
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
                                        <td>{{ $est->produto->origem_destino }}</td>
                                        <td>{{ $est->produto->num_lote }}</td>
                                        <td><b>{{ $est->produto->grupo_farmaco->nome }}</b></td>
                                        <td>{{ getCaixa($est->produto->descritivo) }}</td>
                                        <td>{{ $est->produto->saldo->qtd }}</td>
                                        <td>{{ $est->produto->num_documento }}</td>
                                        <td>{{ $est->produto->data_expiracao }}</td>
                                        <td>
                                            <div class="d-flex align-items-center list-action">
                                                @if (vPerm('produtos', ['dar_baixa']) or Auth::user()->isFarmacia)
                                                    <a class="badge bg-success mr-2" title="Dar baixa" href="javascript:void(0)"
                                                        onclick="modalDarBaixa({{ $est->produto->id }}, '{{ getCaixa($est->produto->descritivo) }}')">
                                                        <i class="ri-install-line mr-0"></i>
                                                    </a>
                                            @endif
                                                {{-- <a class="badge bg-info mr-2" data-toggle="tooltip" data-placement="top"
                                                    title="Editar" href="javascript:void(0)" onclick="modalEditarProdutoEstoque({{ $est->produto->id }})">
                                                    <i class="ri-pencil-line mr-0"></i>
                                                </a> --}}
                                                {{-- <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top"
                                                    title="Eliminar" href="javascript:void(0)" onclick="">
                                                    <i class="ri-delete-bin-line mr-0"></i>
                                                </a> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endif
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
