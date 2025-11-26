@extends('layout.app')

@section('titulo', 'Lista de Fornecedores')

@section('content')
<div class="content">
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Fornecedores </a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Lista de Fornecedores</li>
                </ul>
            </div>
        </div>
    </div>

    @include('prepharma.fornecedores._lista')
</div>
@endsection
