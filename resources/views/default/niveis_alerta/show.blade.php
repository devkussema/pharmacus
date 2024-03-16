@extends('home.index')

@section('titulo', 'Niveis de Alerta')

@section('conteudo')
    <div id="dadoPrincipal">
        <div class="row">
            <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="mb-3">Niveis de Alerta</h4>
                </div>
            </div>
            @php
                use App\Models\RelatorioEstoqueAlerta as REA;
                $id_niv = [];
            @endphp

            <div class="col-lg-12">
                <div class="row">
                    @foreach (REA::all() as $n)
                        @if (!in_array($n->nivel_alerta->id, $id_niv))
                            <div class="col-lg-3 col-md-3">
                                <div class="card card-block card-stretch card-height">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center mb-4 card-total-sale">
                                            <div class="icon iq-icon-box-2 bg-info-light">
                                                <img src="{{ pharma('assets/images/product/1.png') }}" class="img-fluid"
                                                    alt="image">
                                            </div>
                                            <div>
                                                <p class="mb-2">{{ $n->nivel_alerta->nome }}</p>
                                                <h4>{{ $n->nivel_alerta->relatorios->count() }}</h4>
                                            </div>
                                        </div>
                                        <div class="iq-progress-bar mt-2">
                                            <span class="bg-info iq-progress progress-1" data-percent="85">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php $id_niv[] = $n->nivel_alerta->id; @endphp
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="data-table table mb-0 tbl-server-info tbl-estoque">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>Designação</th>
                                <th>Quantidade</th>
                                <th>Área Hospitalar</th>
                                <th>Lote</th>
                                <th>Tempo restante</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            {{-- Gerado automaticamente --}}
                            @foreach ($niveis as $na)
                                <tr>
                                    <td><b>{{ $na->produto->designacao }}</b></td>
                                    <td>{{ $na->produto->saldo->qtd }}</td>
                                    <td>{{ $na->produto->estoque->area_hospitalar->nome }}</td>
                                    <td>{{ $na->produto->num_lote }}</td>
                                    <td>{{ calcMes($na->produto->data_expiracao) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
