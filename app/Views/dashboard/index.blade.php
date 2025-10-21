@extends('admin::layout.main')

@section('content')
    <div class="good-morning-blk">
        <div class="row">
            <div class="col-md-6">
                <div class="morning-user">
                    <h2>Bom dia, <span>{{ Auth::user()->nome }}</span></h2>
                    <p>Tenha um bom dia no trabalho</p>
                </div>
            </div>
            <div class="col-md-6 position-blk">
                <div class="morning-img">
                    <img src="{{ assetr('assets/img/morning-img-02.png')}}" alt>
                </div>
            </div>
        </div>
    </div>

    <div class="doctor-list-blk">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="doctor-widget border-right-bg">
                    <div class="doctor-box-icon flex-shrink-0">
                        <img src="{{ assetr('assets/img/icons/doctor-dash-01.svg')}}" alt>
                    </div>
                    <div class="doctor-content dash-count flex-grow-1">
                        <h4><span class="counter-up">30</span><span>/85</span><span class="status-green">+60%</span></h4>
                        <h5>Appointments</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="doctor-widget border-right-bg">
                    <div class="doctor-box-icon flex-shrink-0">
                        <img src="{{ assetr('assets/img/icons/doctor-dash-02.svg')}}" alt>
                    </div>
                    <div class="doctor-content dash-count flex-grow-1">
                        <h4><span class="counter-up">20</span><span>/125</span><span class="status-pink">-20%</span></h4>
                        <h5>Consultations</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="doctor-widget border-right-bg">
                    <div class="doctor-box-icon flex-shrink-0">
                        <img src="{{ assetr('assets/img/icons/doctor-dash-03.svg')}}" alt>
                    </div>
                    <div class="doctor-content dash-count flex-grow-1">
                        <h4><span class="counter-up">12</span><span>/30</span><span class="status-green">+40%</span></h4>
                        <h5>Operations</h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="doctor-widget">
                    <div class="doctor-box-icon flex-shrink-0">
                        <img src="{{ assetr('assets/img/icons/doctor-dash-04.svg')}}" alt>
                    </div>
                    <div class="doctor-content dash-count flex-grow-1">
                        <h4>$<span class="counter-up">530</span><span></span><span class="status-green">+50%</span></h4>
                        <h5>Earnings</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
