@extends('layout.app')

@section('titulo', 'Niveis de Alerta')

@section('content')
    <div class="content">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Niveis de Alerta</a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Ver todos</li>
                    </ul>
                </div>
            </div>
        </div>
        @include('partials.session')
        <div class="row">
            @php
                use App\Models\RelatorioEstoqueAlerta as REA;
                $id_niv = [];
            @endphp
            @foreach (REA::all() as $n)
                @if (!in_array($n->nivel_alerta->id, $id_niv))
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <div class="dash-boxs comman-flex-center">
                                <img src="{{ assetr('assets/img/white__logo2.png') }}" width="24" height="24" alt>
                            </div>
                            <div class="dash-content dash-count">
                                <h4>{{ $n->nivel_alerta->nome }}</h4>
                                <h2><span class="counter-up">{{ $n->nivel_alerta->relatorios->count() }}</span></h2>
                                <p>
                                    <span class="passive-view">
                                        <i class="feather-arrow-up-right me-1"></i>
                                        {{-- 40% --}}
                                    </span>
                                    @if ($n->nivel_alerta->regra == '3') até 3 meses @endif
                                    @if ($n->nivel_alerta->regra == '6') até 6 meses @endif
                                    @if ($n->nivel_alerta->regra == '10') até 10 meses @endif
                                    @if ($n->nivel_alerta->regra == '12') até 12 meses @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    @php $id_niv[] = $n->nivel_alerta->id; @endphp
                @endif
            @endforeach
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table show-entire">
                    <div class="card-body">
                        <div class="page-table-header mb-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="doctor-table-blk">
                                        <h3>Niveis de Alerta</h3>
                                        <div class="doctor-search-blk">
                                            <div class="top-nav-search table-search-blk">
                                                <form>
                                                    <input type="text" id="search-tableq" class="form-control" placeholder="Procure aqui">
                                                    <a class="btn"><img
                                                            src="{{ assetr('assets/img/icons/search-normal.svg') }}"
                                                            alt></a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="{{ route('print.nivel_alerta') }}" id="imprimir-pagina" target="_blank" class=" me-2">
                                        <img src="{{ assetr('assets/img/icons/pdf-icon-01.svg') }}" alt>
                                    </a>
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
                            <table class="table border-0 custom-table comman-table datatable mb-0" id="table-cd">
                                <thead>
                                    <tr>
                                        <th>Designação</th>
                                        <th>Dosagem</th>
                                        <th>Quantidade</th>
                                        <th>Área Hospitalar</th>
                                        <th>Lote</th>
                                        <th>Tempo restante</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($niveis as $na)
                                        <tr>
                                            <td><b>{{ $na->produto->designacao }}</b></td>
                                            <td><b>{{ $na->produto->dosagem }}</b></td>
                                            @if ($na->produto->tipo == "Liquido")
                                                <td>{{ getEmbalagem($na->produto->descritivo) }}</td>
                                            @else
                                                <td>{{ $na->produto->saldo->qtd }}</td>
                                            @endif
                                            <td>{{ @$na->produto->estoque->area_hospitalar->nome }}</td>
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
        </div>
    </div>
    <script>
        $('#search-tableq').on('keyup', function() {
            // Obtém a instância da DataTable
            var table = $('#table-cd').DataTable();

            // Aplica o filtro ao DataTable usando o valor do campo de pesquisa personalizado
            table.search(this.value).draw();
        });
        document.getElementById('imprimir-pagina').addEventListener('click', function(e) {
            e.preventDefault(); // Evita que o link seja seguido imediatamente

            // Redireciona para a página específica em uma nova aba
            var novaAba = window.open(this.href, '_blank');

            // Espera até que a página seja completamente carregada na nova aba
            novaAba.onload = function() {
                // Imprime a página
                novaAba.print();
            };
        });
    </script>
@endsection
