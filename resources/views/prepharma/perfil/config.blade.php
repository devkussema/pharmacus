@extends('layout.app')

@section('titulo', 'Perfil')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-sm-7 col-6">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard </a></li>
                    <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                    <li class="breadcrumb-item active">Perfil</li>
                </ul>
            </div>
            <div class="col-sm-5 col-6 text-end m-b-30">
                {{-- <a href="javascript:void(0)" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Editar Perfil</a> --}}
            </div>
        </div>
        <div class="card-box profile-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view">
                        <div class="profile-img-wrap">
                            <div class="profile-img">
                                <a href="#"><img class="avatar" src="{{ assetr('assets/img/doctor-03.jpg')}}" alt></a>
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0 mb-0">{{ Auth::user()->nome }}</h3>
                                        <small class="text-muted"></small>
                                        <div class="staff-id">ID do Usuário : {{{ Auth::user()->username }}}</div>
                                        {{-- <div class="staff-msg"><a href="chat.html" class="btn btn-primary">Send
                                                Message</a></div> --}}
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li>
                                            <span class="title">Telefone:</span>
                                            <span class="text">
                                                <a href>[Não Configurado]</a>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="title">Email:</span>
                                            <span class="text">
                                                <a href="javascript:void(0)">
                                                    <span class="__cf_email__">
                                                        [Email Protegido]
                                                    </span>
                                                </a>
                                            </span>
                                        </li>
                                        <li>
                                            <span class="title">Birthday:</span>
                                            <span class="text">{Não Configurado}</span>
                                        </li>
                                        <li>
                                            <span class="title">Endereço:</span>
                                            <span class="text">[Não Configurado]</span>
                                        </li>
                                        <li>
                                            <span class="title">Gênero:</span>
                                            <span class="text">[Não Configurado]</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="profile-tabs">
            <ul class="nav nav-tabs nav-tabs-bottom">
                <li class="nav-item"><a class="nav-link active" href="#about-cont" data-bs-toggle="tab">Sobre</a></li>
                <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-bs-toggle="tab">Perfil</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-bs-toggle="tab">Mensagens</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane show active" id="about-cont">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h3 class="card-title">Informações Acadêmicas</h3>
                                <div class="experience-box">
                                    <ul class="experience-list">
                                        <li>
                                            <div class="experience-user">
                                                <div class="before-circle"></div>
                                            </div>
                                            <div class="experience-content">
                                                <div class="timeline-content">
                                                    <a href="#/" class="name">International College of Medical
                                                        Science (UG)</a>
                                                    <div>MBBS</div>
                                                    <span class="time">2001 - 2003</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="experience-user">
                                                <div class="before-circle"></div>
                                            </div>
                                            <div class="experience-content">
                                                <div class="timeline-content">
                                                    <a href="#/" class="name">International College of Medical
                                                        Science (PG)</a>
                                                    <div>MD - Obstetrics & Gynaecology</div>
                                                    <span class="time">1997 - 2001</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-box ">
                                <h3 class="card-title">Experiência</h3>
                                <div class="experience-box">
                                    <ul class="experience-list">
                                        <li>
                                            <div class="experience-user">
                                                <div class="before-circle"></div>
                                            </div>
                                            <div class="experience-content">
                                                <div class="timeline-content">
                                                    <a href="#/" class="name">Consultant Gynecologist</a>
                                                    <span class="time">Jan 2014 - Present (4 years 8
                                                        months)</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="experience-user">
                                                <div class="before-circle"></div>
                                            </div>
                                            <div class="experience-content">
                                                <div class="timeline-content">
                                                    <a href="#/" class="name">Consultant Gynecologist</a>
                                                    <span class="time">Jan 2009 - Present (6 years 1
                                                        month)</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="experience-user">
                                                <div class="before-circle"></div>
                                            </div>
                                            <div class="experience-content">
                                                <div class="timeline-content">
                                                    <a href="#/" class="name">Consultant Gynecologist</a>
                                                    <span class="time">Jan 2004 - Present (5 years 2
                                                        months)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="bottom-tab2">
                    Tab content 2
                </div>
                <div class="tab-pane" id="bottom-tab3">
                    Tab content 3
                </div>
            </div>
        </div> --}}
    </div>
@endsection
