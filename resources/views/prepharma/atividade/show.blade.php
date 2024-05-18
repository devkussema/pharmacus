@extends('layout.app')

@section('titulo', 'Atividades')

@section('content')
    <div class="content">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="activites.html">Atividades </a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Atividades dos usuários</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="activity">
                            <div class="activity-box">
                                <ul class="activity-list">
                                    @foreach (\App\Models\Atividade::take(12)->orderByDesc('created_at')->get() as $at)
                                        <li>
                                            <div class="activity-user">
                                                <a href="profile.html" title="{{ $at->user->nome }}" data-bs-toggle="tooltip"
                                                    class="avatar">
                                                    <img alt="{{ $at->user->nome }}" src="{{ assetr('assets/img/user-02.jpg')}}"
                                                        class="img-fluid rounded-circle">
                                                </a>
                                            </div>
                                            <div class="activity-content timeline-group-blk">
                                                <div class="timeline-group flex-shrink-0">
                                                    <h4>{{ formatDataAtv($at->created_at) }}</h4>
                                                    <span class="time">5.50 PM</span>
                                                </div>
                                                <div class="comman-activitys flex-grow-1">
                                                    <h3>{{ $at->user->nome }}</h3>
                                                    <p><span>{{ $at->texto }}</span></p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
