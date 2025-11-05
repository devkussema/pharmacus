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
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Vendas Hoje</h5>
                        <p class="card-text display-6">Kz 0,00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Stock Crítico</h5>
                        <p class="card-text display-6">0</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Fornecedores</h5>
                        <p class="card-text display-6">0</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Clientes</h5>
                        <p class="card-text display-6">0</p>
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
