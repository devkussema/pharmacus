@extends('home.index')

@section('conteudo')
    <div id="dadoPrincipal">
        @include('partials.session')
        <div class="row">
            <div class="col-lg-4">
                <div class="card card-transparent card-block card-stretch card-height border-none">
                    <div class="card-body p-0 mt-lg-2 mt-0">
                        <h3 class="mb-3">Olá {{ printNome(Auth::user()->nome) }}, {{ saudacaoDoDia() }}</h3>
                        <p class="mb-0 mr-4">Seu painel oferece visualizações dos principais desempenhos ou processos de
                            negócios.</p>
                        {{-- {{ auth()->user()->grupo }} --}}
                    </div>
                </div>
            </div>
            <div class="modal modal-left fade" id="modal-left" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Your content comes here</p>
                        </div>
                        <div class="modal-footer modal-footer-uniform">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary float-end">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-info-light">
                                        <img src="{{ pharma('assets/images/product/1.png') }}" class="img-fluid"
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
                    <div class="col-lg-4 col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-danger-light">
                                        <img src="{{ pharma('assets/images/product/2.png') }}" class="img-fluid"
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
                    <div class="col-lg-4 col-md-4">
                        <div class="card card-block card-stretch card-height">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4 card-total-sale">
                                    <div class="icon iq-icon-box-2 bg-success-light">
                                        <img src="{{ pharma('assets/images/product/3.png') }}" class="img-fluid"
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
            </div>
            <div class="col-lg-12">
                <div class="card card-block card-stretch card-height" style="max-height: calc(100% - 30px)">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Estatistica da Farmácia e Área Hospitalar</h4>
                        </div>
                        <div class="card-header-toolbar d-flex align-items-center">
                            <div class="dropdown">
                                <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton002"
                                    data-toggle="dropdown">
                                    Este mês<i class="ri-arrow-down-s-line ml-1"></i>
                                </span>
                                <div class="dropdown-menu dropdown-menu-right shadow-none"
                                    aria-labelledby="dropdownMenuButton002">
                                    <a class="dropdown-item" href="#">Anual</a>
                                    <a class="dropdown-item" href="#">Mensal</a>
                                    <a class="dropdown-item" href="#">Semanal</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <canvas id="myChart" height="80"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
