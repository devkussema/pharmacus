@extends('layout.app')

@section('titulo', 'Painel Estoque')

@section('content')
<div class="doctor-list-blk">
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="doctor-widget border-right-bg">
                <a href="#" class="doctor-box-icon flex-shrink-0">
                    <img src="{{ assetr('assets/img/white__logo2.png') }}" width="48" height="48" alt>
                </a>
                <div class="doctor-content dash-count flex-grow-1">
                    <h4><span class="counter-up">30</span><span>/85</span><span
                            class="status-green">+60%</span></h4>
                    <h5>Crítico</h5>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="doctor-widget border-right-bg">
                <a href="#" class="doctor-box-icon flex-shrink-0">
                    <img src="{{ assetr('assets/img/white__logo2.png') }}" width="48" height="48" alt>
                </a>
                <div class="doctor-content dash-count flex-grow-1">
                    <h4><span class="counter-up">20</span><span>/125</span><span
                            class="status-pink">-20%</span></h4>
                    <h5>Minimo</h5>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="doctor-widget border-right-bg">
                <a href="#" class="doctor-box-icon flex-shrink-0">
                    <img src="{{ assetr('assets/img/white__logo2.png') }}" width="48" height="48" alt>
                </a>
                <div class="doctor-content dash-count flex-grow-1">
                    <h4><span class="counter-up">12</span><span>/30</span><span
                            class="status-green">+40%</span></h4>
                    <h5>Médio</h5>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="doctor-widget">
                <a href="#" class="doctor-box-icon flex-shrink-0">
                    <img src="{{ assetr('assets/img/white__logo2.png') }}" width="48" height="48" alt>
                </a>
                <div class="doctor-content dash-count flex-grow-1">
                    <h4>$<span class="counter-up">530</span><span></span><span
                            class="status-green">+50%</span></h4>
                    <h5>Máximo</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-12 col-lg-12 col-xl-7">
        <div class="card">
            <div class="card-body">
                <div class="chart-title patient-visit mb-0">
                    <h4>Income</h4>
                    <div class="income-value">
                        <h3><span>$</span> 20,560</h3>
                        <p><span class="passive-view"><i
                                    class="feather-arrow-up-right me-1"></i>40%</span> vs last month</p>
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
                <div id="apexcharts-area"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-6 col-xl-3 d-flex">
        <div class="card">
            <div class="card-body">
                <div id="radial-patients"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-6 col-xl-2 d-flex">
        <div class="struct-point">
            <div class="card patient-structure">
                <div class="card-body">
                    <h5>New Patients</h5>
                    <h3>56<span class="status-green"><img src="{{ assetr('assets/img/icons/sort-icon-01.svg')}}" alt
                                class="me-1">60%</span></h3>
                </div>
            </div>
            <div class="card patient-structure">
                <div class="card-body">
                    <h5>Old Patients</h5>
                    <h3>35<span class="status-pink"><img src="{{ assetr('assets/img/icons/sort-icon-02.svg')}}" alt
                                class="me-1">-20%</span></h3>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-12  col-xl-7">
        <div class="card">
            <div class="card-body">
                <div class="chart-title patient-visit">
                    <h4>Activity Chart</h4>
                    <div>
                        <ul class="nav chat-user-total">
                            <li><i class="fa fa-circle low-users" aria-hidden="true"></i>Low</li>
                            <li><i class="fa fa-circle current-users" aria-hidden="true"></i> High</li>
                        </ul>
                    </div>
                    <div class="input-block mb-0">
                        <select class="form-control select">
                            <option>This Week</option>
                            <option>Last Week</option>
                            <option>This Month</option>
                            <option>Last Month</option>
                        </select>
                    </div>
                </div>
                <div id="activity-chart"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12  col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title d-inline-block">Recent Appointments</h4> <a
                            href="appointments.html" class="patient-views float-end">Show all</a>
                    </div>
                    <div class="card-body p-0 table-dash">
                        <div class="table-responsive">
                            <table class="table mb-0 border-0 custom-table">
                                <tbody>
                                    <tr>
                                        <td class="table-image appoint-doctor">
                                            <img width="28" height="28" class="rounded-circle"
                                                src="{{ assetr('assets/img/profiles/avatar-02.jpg')}}" alt>
                                            <h2>Dr.Jenny Smith</h2>
                                        </td>
                                        <td class="appoint-time text-center">
                                            <h6>Today 5:40 PM</h6>
                                            <span>Typoid Fever</span>
                                        </td>
                                        <td>
                                            <button class="check-point status-green me-1"><i
                                                    class="feather-check"></i></button>
                                            <button class="check-point status-pink "><i
                                                    class="feather-x"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-image appoint-doctor">
                                            <img width="28" height="28" class="rounded-circle"
                                                src="{{ assetr('assets/img/profiles/avatar-03.jpg')}}" alt>
                                            <h2>Dr.Angelica Ramos</h2>
                                        </td>
                                        <td class="appoint-time text-center">
                                            <h6>Today 5:40 PM</h6>
                                            <span>Typoid Fever</span>
                                        </td>
                                        <td>
                                            <button class="check-point status-green me-1"><i
                                                    class="feather-check"></i></button>
                                            <button class="check-point status-pink "><i
                                                    class="feather-x"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="table-image appoint-doctor">
                                            <img width="28" height="28" class="rounded-circle"
                                                src="{{ assetr('assets/img/profiles/avatar-04.jpg')}}" alt>
                                            <h2>Dr.Martin Doe</h2>
                                        </td>
                                        <td class="appoint-time text-center">
                                            <h6>Today 5:40 PM</h6>
                                            <span>Typoid Fever</span>
                                        </td>
                                        <td>
                                            <button class="check-point status-green me-1"><i
                                                    class="feather-check"></i></button>
                                            <button class="check-point status-pink "><i
                                                    class="feather-x"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12  col-xl-4 d-flex">
                <div class="card wallet-widget">
                    <div class="circle-bar circle-bar2">
                        <div class="circle-graph2" data-percent="66">
                            <b><img src="{{ assetr('assets/img/icons/timer.svg')}}" alt></b>
                        </div>
                    </div>
                    <div class="main-limit">
                        <p>Next Appointment in</p>
                        <h4>02h:12m</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-12 col-xl-5 d-flex">
        <div class="card flex-fill comman-shadow">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Recent Appointments</h4> <a
                    href="appointments.html" class="patient-views float-end">Show all</a>
            </div>
            <div class="card-body">
                <div class="teaching-card">
                    <ul class="steps-history">
                        <li>08:00</li>
                    </ul>
                    <ul class="activity-feed">
                        <li class="feed-item d-flex align-items-center">
                            <div class="dolor-activity hide-activity">
                                <ul class="doctor-date-list mb-2">
                                    <li class="stick-line"><i class="fas fa-circle me-2"></i>08:00
                                        <span>Benjamin Bruklin</span></li>
                                    <li class="stick-line"><i class="fas fa-circle me-2"></i>08:00
                                        <span>Andrea Lalema</span></li>
                                    <li class=" dropdown ongoing-blk ">
                                        <a href="#" class="dropdown-toggle  active-doctor"
                                            data-bs-toggle="dropdown">
                                            <i class="fas fa-circle me-2 active-circles"></i>08:00
                                            <span>Andrea Lalema</span><span
                                                class="ongoing-drapt">Ongoing <i
                                                    class="feather-chevron-down ms-2"></i></span>
                                        </a>
                                        <ul class="doctor-sub-list dropdown-menu">
                                            <li class="patient-new-list dropdown-item">
                                                Patient<span>Marie kennedy</span><a href="javascript:;"
                                                    class="new-dot status-green"><i
                                                        class="fas fa-circle me-1 fa-2xs"></i>New</a>
                                            </li>
                                            <li class="dropdown-item">Time<span>8:30 - 9:00
                                                    (30min)</span></li>
                                            <li class="schedule-blk mb-0 pt-2 dropdown-item">
                                                <ul class="nav schedule-time">
                                                    <li><a href="javascript:;"><img
                                                                src="{{ assetr('assets/img/icons/trash.svg')}}"
                                                                alt></a></li>
                                                    <li><a href="javascript:;"><img
                                                                src="{{ assetr('assets/img/icons/profile.svg')}}"
                                                                alt></a></li>
                                                    <li><a href="javascript:;"><img
                                                                src="{{ assetr('assets/img/icons/edit.svg')}}" alt></a>
                                                    </li>
                                                </ul>
                                                <a class="btn btn-primary appoint-start">Start
                                                    Appointment</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="teaching-card">
                    <ul class="steps-history">
                        <li>09:00</li>
                    </ul>
                    <ul class="activity-feed">
                        <li class="feed-item d-flex align-items-center">
                            <div class="dolor-activity">
                                <ul class="doctor-date-list mb-2">
                                    <li><i class="fas fa-circle me-2"></i>09:00 <span>Galaviz
                                            Lalema</span></li>
                                    <li><i class="fas fa-circle me-2"></i>09:20 <span>Benjamin
                                            Bruklin</span></li>
                                    <li><i class="fas fa-circle me-2"></i>09:40 <span>Jenny Smith</span>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="teaching-card">
                    <ul class="steps-history">
                        <li>10:00</li>
                    </ul>
                    <ul class="activity-feed">
                        <li class="feed-item d-flex align-items-center">
                            <div class="dolor-activity">
                                <ul class="doctor-date-list mb-2">
                                    <li><i class="fas fa-circle me-2"></i>10:00 <span>Cristina
                                            Groves</span></li>
                                    <li><i class="fas fa-circle me-2"></i>10:30 <span>Benjamin
                                            Bruklin</span></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="teaching-card">
                    <ul class="steps-history">
                        <li>11:00</li>
                    </ul>
                    <ul class="activity-feed">
                        <li class="feed-item d-flex align-items-center">
                            <div class="dolor-activity">
                                <ul class="doctor-date-list mb-2">
                                    <li><i class="fas fa-circle me-2"></i>11:00 <span>Cristina
                                            Groves</span></li>
                                    <li><i class="fas fa-circle me-2"></i>11:30 <span>Benjamin
                                            Bruklin</span></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
