@extends('core_admin::layout.app')

@section('title','Dashboard')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Dashboard</h1>
        <small>Visão geral do sistema</small>
    </div>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="card card-placeholder p-3">
                <h5>Novos pedidos</h5>
                <p class="display-6">12</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-placeholder p-3">
                <h5>Stock crítico</h5>
                <p class="display-6 text-danger">4</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-placeholder p-3">
                <h5>Utilizadores</h5>
                <p class="display-6">58</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card card-placeholder p-3">
                <h5>Farmácias</h5>
                <p class="display-6">6</p>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <h4>Relatórios recentes</h4>
        <div class="card p-3">
            <p>Gráfico placeholder — implementar gráficos com Chart.js / ApexCharts conforme necessário.</p>
        </div>
    </div>

@endsection
