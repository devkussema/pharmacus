@extends('layout.app')

@section('titulo', 'Página Inicial')

@section('content')
    <div class="content">
        @include('partials.session')
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard </a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Página Inicial</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="good-morning-blk">
            <div class="row">
                <div class="col-md-6">
                    <div class="morning-user">
                        <h2>Olá <span>Dr(a){{ printNome(Auth::user()->nome) }}</span>, {{ saudacaoDoDia() }}</h2>
                        <p>Tenha um bom dia no trabalho</p>
                    </div>
                </div>
                <div class="col-md-6 position-blk">
                    <div class="morning-img">
                        <img src="{{ assetr('assets/img/morning-img-01.png')}}" alt>
                    </div>
                </div>
            </div>
        </div>
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
                                @if ($n->nivel_alerta->regra == '3') até 3 meses @endif
                                @if ($n->nivel_alerta->regra == '6') até 6 meses @endif
                                @if ($n->nivel_alerta->regra == '10') até 10 meses @endif
                                @if ($n->nivel_alerta->regra == '12') até 12 meses @endif
                            </div>
                        </div>
                    </div>
                    @php $id_niv[] = $n->nivel_alerta->id; @endphp
                @endif
            @endforeach
        </div>
        {{-- <div class="row">
            <div class="col-12 col-md-12 col-lg-6 col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-title patient-visit">
                            <h4>Patient Visit by Gender</h4>
                            <div>
                                <ul class="nav chat-user-total">
                                    <li><i class="fa fa-circle current-users" aria-hidden="true"></i>Male 75%
                                    </li>
                                    <li><i class="fa fa-circle old-users" aria-hidden="true"></i> Female 25%
                                    </li>
                                </ul>
                            </div>
                            <div class="input-block mb-0">
                                <select class="form-control select">
                                    <option>2022</option>
                                    <option>2021</option>
                                    <option>2020</option>
                                    <option>2019</option>
                                </select>
                            </div>
                        </div>
                        <div id="patient-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6 col-xl-3 d-flex">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-title">
                            <h4>Patient by Department</h4>
                        </div>
                        <div id="donut-chart-dash" class="chart-user-icon">
                            <img src="{{ assetr('assets/img/icons/user-icon.svg')}}" alt>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-12 col-md-12  col-xl-4">
                <div class="card top-departments">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Principais Departamentos</h4>
                    </div>
                    <div class="card-body">
                        @foreach (\App\Models\FarmaciaAreaHospitalar::all() as $fah)
                            <div class="activity-top">
                                <div class="activity-boxs comman-flex-center">
                                    <img src="{{ assetr('assets/img/icons/dep-icon-01.svg')}}" alt>
                                </div>
                                <div class="departments-list">
                                    <h4>
                                        <a href="{{ route('estoque.getEstoque', ['id' => $fah->area_hospitalar->id]) }}">
                                            {{ $fah->area_hospitalar->nome }}
                                        </a>
                                    </h4>
                                    {{-- <p>35%</p> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12  col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title d-inline-block">Atividades</h4> <a href="{{ route('atividade.show') }}"
                            class="patient-views float-end">Mostrar todas</a>
                    </div>
                    <div class="card-body p-0 table-dash">
                        <div class="table-responsive">
                            <table class="table mb-0 border-0 datatable custom-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>Usuário</th>
                                        <th>Texto</th>
                                        <th>Tempo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\Atividade::take(6)->get() as $at)
                                        <tr>
                                            <td>
                                                <div class="form-check check-tables">
                                                    <input class="form-check-input" type="checkbox" value="something">
                                                </div>
                                            </td>
                                            <td class="table-image appoint-doctor">
                                                {{-- <img width="28" height="28" class="rounded-circle"
                                                    src="{{ assetr('assets/img/profiles/avatar-02.jpg')}}" alt> --}}
                                                <h2>{{ $at->user->nome }}</h2>
                                            </td>
                                            <td>{{ $at->texto }}</td>
                                            <td class="appoint-time">
                                                {{ statusOnline($at->created_at) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title d-inline-block">Acessos recentes </h4> <a href="#"
                            class="float-end patient-views">Mostrar todos</a>
                    </div>
                    <div class="card-block table-dash">
                        <div class="table-responsive">
                            <table class="table mb-0 border-0 datatable custom-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Online</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\User::orderBy('online', 'desc')->take(5)->get() as $usr)
                                        <tr>
                                            <td>
                                                <div class="form-check check-tables">
                                                    <input class="form-check-input" type="checkbox" value="something">
                                                </div>
                                            </td>
                                            <td class="table-image">
                                                {{-- <img width="28" height="28" class="rounded-circle"
                                                    src="{{ assetr('assets/img/profiles/avatar-02.jpg')}}" alt> --}}
                                                <h2>{{ $usr->nome }}</h2>
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $usr->email }}">
                                                    {{ $usr->email }}
                                                </a>
                                            </td>
                                            <td>{{ statusOnline($usr->online) }}</td>
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
@endsection
