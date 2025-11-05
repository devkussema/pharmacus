@extends('diretor::layout.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Dashboard do Diretor</h1>
            <small class="text-muted">Visão geral da farmácia</small>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card stat-card p-0">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2">Vendas Hoje</h6>
                        <div class="d-flex align-items-end justify-content-between">
                            <div>
                                <div class="h3 mb-0">Kz 0,00</div>
                                <small class="muted">Comparado com ontem: 0%</small>
                            </div>
                            <div class="ms-3"><i class="fa-solid fa-eye fa-2x opacity-75"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card p-0">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2">Stock Crítico</h6>
                        <div class="d-flex align-items-end justify-content-between">
                            <div>
                                <div class="h3 mb-0">0</div>
                                <small class="muted">Produtos abaixo do mínimo</small>
                            </div>
                            <div class="ms-3"><i class="fa-solid fa-box-open fa-2x opacity-75"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card p-0">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2">Fornecedores</h6>
                        <div class="d-flex align-items-end justify-content-between">
                            <div>
                                <div class="h3 mb-0">0</div>
                                <small class="muted">Ativos</small>
                            </div>
                            <div class="ms-3"><i class="fa-solid fa-truck fa-2x opacity-75"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stat-card p-0">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2">Clientes</h6>
                        <div class="d-flex align-items-end justify-content-between">
                            <div>
                                <div class="h3 mb-0">0</div>
                                <small class="muted">Cadastrados</small>
                            </div>
                            <div class="ms-3"><i class="fa-solid fa-users fa-2x opacity-75"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Movimentos Recentes</h5>
                <p class="text-muted">Tabela de exemplo — substituir por dados reais.</p>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Descrição</th>
                                <th>Tipo</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>—</td>
                                <td>Sem movimentos</td>
                                <td>—</td>
                                <td>—</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Inicializa tooltips e outras interações leves do dashboard
    document.addEventListener('DOMContentLoaded', function(){
        var tipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tipTriggerList.map(function (tipTriggerEl) {
            return new bootstrap.Tooltip(tipTriggerEl)
        })
    })
</script>
@endpush
