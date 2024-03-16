@extends('home.index')

@section('titulo', 'Áreas Hospitalares')

@section('conteudo')
    <div class="dadoPrincipal">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Áreas Hospitalares </h4>
                    </div>
                </div>
                @if (count($all_areas) === 0)
                    <div class="alert alert-info text-center" role="alert">
                        Ainda não adicionaste nenhuma área hospitalar.<a href="{{ route('a_h.index') }}" class="btn btn-dark btn-sm ml-4">Adicione uma</a>
                    </div>
                @endif
                @php
                    $colors = ['bg-green', 'bg-purple-light', 'bg-indigo', 'bg-info-light', 'bg-warning-light', 'bg-teal-light', 'bg-danger-light', 'bg-success-light'];
                    $colorIndex = 0;
                @endphp
                <div class="row">
                    @if (count($all_areas) != 0)
                        @foreach ($all_areas as $area)
                            <div class="col-lg-3">
                                <div class="card card-block card-stretch card-height">
                                    <div class="card-body">
                                        <a href="{{ route('estoque.getEstoque', ['id' => $area->id]) }}">
                                            <div class="d-flex align-items-center mb-4 card-total-sale">
                                                <div class="icon iq-icon-box-2 {{ $colors[$colorIndex] }}">
                                                    <img src="{{ pharma('assets/images/white__logo.png') }}" class="img-fluid"
                                                        alt="image">
                                                </div>
                                                <div>
                                                    <p class="mb-2"><b> {{ $area->nome }} </b></p>
                                                    <h4></h4>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="iq-progress-bar mt-2">
                                            <span class="{{ $colors[$colorIndex++] }} iq-progress progress-1" data-percent="0"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($colorIndex >= count($colors))
                                @php $colorIndex = 0; @endphp
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
            {{-- <div class="col-lg-8">
                <div class="card card-block card-stretch card-height">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Principais produtos</h4>
                        </div>
                        <div class="card-header-toolbar d-flex align-items-center">
                            <div class="dropdown">
                                <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton006"
                                    data-toggle="dropdown">
                                    Este m<i class="ri-arrow-down-s-line ml-1"></i>
                                </span>
                                <div class="dropdown-menu dropdown-menu-right shadow-none"
                                    aria-labelledby="dropdownMenuButton006">
                                    <a class="dropdown-item" href="#">Anual</a>
                                    <a class="dropdown-item" href="#">Mensal</a>
                                    <a class="dropdown-item" href="#">Semanal</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled row top-product mb-0">
                            <li class="col-lg-3">
                                <div class="card card-block card-stretch card-height mb-0">
                                    <div class="card-body">
                                        <div class="bg-warning-light rounded">
                                            <img src="../assets/images/product/01.png"
                                                class="style-img img-fluid m-auto p-3" alt="image">
                                        </div>
                                        <div class="style-text text-left mt-3">
                                            <h5 class="mb-1">Organic Cream</h5>
                                            <p class="mb-0">789 Item</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-lg-3">
                                <div class="card card-block card-stretch card-height mb-0">
                                    <div class="card-body">
                                        <div class="bg-danger-light rounded">
                                            <img src="../assets/images/product/02.png"
                                                class="style-img img-fluid m-auto p-3" alt="image">
                                        </div>
                                        <div class="style-text text-left mt-3">
                                            <h5 class="mb-1">Rain Umbrella</h5>
                                            <p class="mb-0">657 Item</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-lg-3">
                                <div class="card card-block card-stretch card-height mb-0">
                                    <div class="card-body">
                                        <div class="bg-info-light rounded">
                                            <img src="../assets/images/product/03.png"
                                                class="style-img img-fluid m-auto p-3" alt="image">
                                        </div>
                                        <div class="style-text text-left mt-3">
                                            <h5 class="mb-1">Serum Bottle</h5>
                                            <p class="mb-0">489 Item</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="col-lg-3">
                                <div class="card card-block card-stretch card-height mb-0">
                                    <div class="card-body">
                                        <div class="bg-success-light rounded">
                                            <img src="../assets/images/product/02.png"
                                                class="style-img img-fluid m-auto p-3" alt="image">
                                        </div>
                                        <div class="style-text text-left mt-3">
                                            <h5 class="mb-1">Organic Cream</h5>
                                            <p class="mb-0">468 Item</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card-transparent card-block card-stretch mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between p-0">
                        <div class="header-title">
                            <h4 class="card-title mb-0">Principais Produtos</h4>
                        </div>
                        <div class="card-header-toolbar d-flex align-items-center">
                            <div><a href="#" class="btn btn-primary view-btn font-size-14">Ver tudo</a></div>
                        </div>
                    </div>
                </div>
                <div class="card card-block card-stretch card-height-helf">
                    <div class="card-body card-item-right">
                        <div class="d-flex align-items-top">
                            <div class="bg-warning-light rounded">
                                <img src="../assets/images/product/04.png" class="style-img img-fluid m-auto"
                                    alt="image">
                            </div>
                            <div class="style-text text-left">
                                <h5 class="mb-2">Coffee Beans Packet</h5>
                                <p class="mb-2">Total Sell : 45897</p>
                                <p class="mb-0">Total Earned : $45,89 M</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-block card-stretch card-height-helf">
                    <div class="card-body card-item-right">
                        <div class="d-flex align-items-top">
                            <div class="bg-danger-light rounded">
                                <img src="../assets/images/product/05.png" class="style-img img-fluid m-auto"
                                    alt="image">
                            </div>
                            <div class="style-text text-left">
                                <h5 class="mb-2">Bottle Cup Set</h5>
                                <p class="mb-2">Total Sell : 44359</p>
                                <p class="mb-0">Total Earned : $45,50 M</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
