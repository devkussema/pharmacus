@extends('layout.app')

@section('titulo', 'Página Inicial')

@section('content')
    <div class="content">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard </a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Admin Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="good-morning-blk">
            <div class="row">
                <div class="col-md-6">
                    <div class="morning-user">
                        <h2>Olá <span>{{ printNome(Auth::user()->nome) }}</span>, {{ saudacaoDoDia() }}</h2>
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
                                {{-- <p><span class="passive-view"><i class="feather-arrow-up-right me-1"></i>40%</span> vs
                                    last month</p> --}}
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
                        <h4 class="card-title d-inline-block">Atividades</h4> <a href="#"
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
                                        <th>Dosagem</th>
                                        <th>Time</th>
                                        <th>Disease</th>
                                        <th></th>
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
                                            <td>{{ $at }}</td>
                                            <td class="appoint-time"><span>12.05.2022 at </span>7.00 PM</td>
                                            <td><button class="custom-badge status-green ">Fracture</button></td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="edit-appointment.html"><i
                                                                class="fa-solid fa-pen-to-square m-r-5"></i>
                                                            Edit</a>
                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                            data-bs-target="#delete_appointment"><i
                                                                class="fa fa-trash-alt m-r-5"></i> Delete</a>
                                                    </div>
                                                </div>
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
                        <h4 class="card-title d-inline-block">Recent Patients </h4> <a href="patients.html"
                            class="float-end patient-views">Show all</a>
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
                                        <th>No</th>
                                        <th>Patient name</th>
                                        <th>Age</th>
                                        <th>Date of Birth</th>
                                        <th>Diagnosis</th>
                                        <th>Triage</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </td>
                                        <td>R00001</td>
                                        <td class="table-image">
                                            <img width="28" height="28" class="rounded-circle"
                                                src="{{ assetr('assets/img/profiles/avatar-02.jpg')}}" alt>
                                            <h2>Andrea Lalema</h2>
                                        </td>
                                        <td>21</td>
                                        <td>07 January 2002</td>
                                        <td>Heart attack</td>
                                        <td><button class="custom-badge status-green ">Non Urgent</button></td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                                        class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="edit-patient.html"><i
                                                            class="fa-solid fa-pen-to-square m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete_appointment"><i
                                                            class="fa fa-trash-alt m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </td>
                                        <td>R00002</td>
                                        <td class="table-image">
                                            <img width="28" height="28" class="rounded-circle"
                                                src="{{ assetr('assets/img/profiles/avatar-03.jpg')}}" alt>
                                            <h2>Mark Hay Smith</h2>
                                        </td>
                                        <td>23</td>
                                        <td>06 January 2002</td>
                                        <td>Jaundice</td>
                                        <td><button class="custom-badge status-pink">Emergency</button></td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                                        class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="edit-patient.html"><i
                                                            class="fa-solid fa-pen-to-square m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete_appointment"><i
                                                            class="fa fa-trash-alt m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </td>
                                        <td>R00003</td>
                                        <td class="table-image">
                                            <img width="28" height="28" class="rounded-circle"
                                                src="{{ assetr('assets/img/profiles/avatar-04.jpg')}}" alt>
                                            <h2>Cristina Groves</h2>
                                        </td>
                                        <td>25</td>
                                        <td>10 January 2002</td>
                                        <td>Malaria</td>
                                        <td><button class="custom-badge status-gray">Out Patient</button></td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                                        class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="edit-patient.html"><i
                                                            class="fa-solid fa-pen-to-square m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete_appointment"><i
                                                            class="fa fa-trash-alt m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </td>
                                        <td>R00004</td>
                                        <td class="table-image">
                                            <img width="28" height="28" class="rounded-circle"
                                                src="{{ assetr('assets/img/profiles/avatar-05.jpg')}}" alt>
                                            <h2>Galaviz Lalema</h2>
                                        </td>
                                        <td>21</td>
                                        <td>09 January 2002</td>
                                        <td>Typhoid</td>
                                        <td><button class="custom-badge status-orange">Non Urgent</button></td>
                                        <td class="text-end">
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false"><i
                                                        class="fa fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" href="edit-patient.html"><i
                                                            class="fa-solid fa-pen-to-square m-r-5"></i>
                                                        Edit</a>
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        data-bs-target="#delete_appointment"><i
                                                            class="fa fa-trash-alt m-r-5"></i> Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
