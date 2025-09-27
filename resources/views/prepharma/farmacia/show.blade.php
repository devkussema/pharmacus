@extends('prepharma.layout.app')

@section('titulo', 'Farmácia ')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('farmacia') }}">Farmácias</a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Detalhes</li>
                    </ul>
                </div>
            </div>
        </div>

        @include('partials.session')

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="about-info">
                                    <h4>Patients Profile <span><a href="javascript:;"><i
                                                    class="feather-more-vertical"></i></a></span></h4>
                                </div>
                                <div class="doctor-profile-head">
                                    <div class="profile-bg-img">
                                        <img src="{{ asset('assets/img/profile-bg.jpg') }}" alt="Profile">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-xl-4 col-md-4">
                                            <div class="profile-user-box">
                                                <div class="profile-user-img">
                                                    @php
                                                        $logo = $farmacia->logo ? assetr('storage/' . $farmacia->logo) : assetr('assets/img/profile-user-01.jpg');
                                                    @endphp
                                                    <img src="{{ $logo }}" alt="Logo {{ $farmacia->nome }}">
                                                    <div class="input-block doctor-up-files profile-edit-icon mb-0">
                                                        <div class="uplod d-flex">
                                                            <label class="file-upload profile-upbtn mb-0">
                                                                <img src="{{ assetr('assets/img/icons/camera-icon.svg') }}"
                                                                    alt="Profile"><input type="file"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="names-profiles">
                                                    <h4>{{ $farmacia->nome ?? '—' }}</h4>
                                                    <h5>{{ $farmacia->categoria->nome ?? '-' }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 d-flex align-items-center">
                                            <div class="follow-group">
                                                <div class="doctor-follows">
                                                    <h5>Followers</h5>
                                                    <h4>{{ $farmacia->areas_hospitalares ? $farmacia->areas_hospitalares->count() : 0 }}</h4>
                                                </div>
                                                <div class="doctor-follows">
                                                    <h5>Following</h5>
                                                    <h4>18K</h4>
                                                </div>
                                                <div class="doctor-follows">
                                                    <h5>Posts</h5>
                                                    <h4>250</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xl-4 d-flex align-items-center">
                                            <div class="follow-btn-group py-3">
                                                <button type="submit" class="btn btn-info follow-btns">Follow</button>
                                                <button type="submit" class="btn btn-info message-btns">Message</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="doctor-personals-grp">
                            <div class="card">
                                <div class="card-body">
                                        <div class="heading-detail ">
                                        <h4 class="mb-3">Sobre</h4>
                                        <p>{{ $farmacia->descricao ?? '—' }}</p>
                                    </div>
                                    <div class="about-me-list">
                                        <ul class="list-space">
                                            <li>
                                                <h4>Gender</h4>
                                                <span>Male</span>
                                            </li>
                                            <li>
                                                <h4>Operation Done</h4>
                                                <span>30+</span>
                                            </li>
                                            <li>
                                                <h4>Designation</h4>
                                                <span>Engineer</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="doctor-personals-grp">
                            <div class="card">
                                <div class="card-body">
                                    <div class="heading-detail">
                                        <h4>Skills:</h4>
                                    </div>
                                    <div class="skill-blk">
                                        <div class="skill-statistics">
                                            <div class="skills-head">
                                                <h5>Heart Beat</h5>
                                                <p>45%</p>
                                            </div>
                                            <div class="progress mb-0">
                                                <div class="progress-bar bg-operations" role="progressbar"
                                                    style="width: 45%" aria-valuenow="45" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="skill-statistics">
                                            <div class="skills-head">
                                                <h5>Haemoglobin</h5>
                                                <p>85%</p>
                                            </div>
                                            <div class="progress mb-0">
                                                <div class="progress-bar bg-haemoglobin" role="progressbar"
                                                    style="width: 85%" aria-valuenow="85" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="skill-statistics">
                                            <div class="skills-head">
                                                <h5>Blood Pressure </h5>
                                                <p>65%</p>
                                            </div>
                                            <div class="progress mb-0">
                                                <div class="progress-bar bg-statistics" role="progressbar"
                                                    style="width: 65%" aria-valuenow="65" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="skill-statistics">
                                            <div class="skills-head">
                                                <h5>Sugar </h5>
                                                <p>90%</p>
                                            </div>
                                            <div class="progress mb-0">
                                                <div class="progress-bar bg-visit" role="progressbar" style="width: 90%"
                                                    aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="doctor-personals-grp">
                            <div class="card">
                                <div class="card-body">
                                    <div class="tab-content-set">
                                        <ul class="nav">
                                            <li>
                                                <a href="patient-profile.html" class="active"><span
                                                        class="set-about-icon me-2"><img
                                                            src="{{ asset('assets/img/icons/menu-icon-02.svg') }}" alt></span>About me</a>
                                            </li>
                                            <li>
                                                <a href="patient-setting.html"><span class="set-about-icon me-2"><img
                                                            src="{{ asset('assets/img/icons/menu-icon-16.svg') }}" alt></span>Settings</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="personal-list-out">
                                        <div class="row">
                                            <div class="col-xl-3 col-md-6">
                                                <div class="detail-personal">
                                                        <h2>Nome</h2>
                                                        <h3>{{ $farmacia->nome ?? '—' }}</h3>
                                                    </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="detail-personal">
                                                        <h2>Contacto</h2>
                                                        <h3>{{ optional($farmacia->gerente)->contato ?? '-' }}</h3>
                                                    </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                            <div class="detail-personal">
                                <h2>Email</h2>
                                <h3>{{ optional(optional($farmacia->gerente)->user)->email ?? '-' }}</h3>
                            </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                                                <div class="detail-personal">
                                                        <h2>Localização</h2>
                                                        <h3>{{ $farmacia->endereco ?? '-' }}</h3>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hello-park">
                                        <p>Completed my graduation in Gynaecologist Medicine from the well known
                                            and renowned institution of India – SARDAR PATEL MEDICAL COLLEGE,
                                            BARODA in 2000-01, which was affiliated to M.S. University. I ranker
                                            in University exams from the same university from 1996-01.</p>
                                        <p>Worked as Professor and Head of the department ; Community medicine
                                            Department at Sterline Hospital, Rajkot, Gujarat from 2003-2015</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title ">Medical History</h4>
                                </div>
                                <div class="card-body p-0 table-dash">
                                    <div class="table-responsive">
                                        <table class="table mb-0 border-0 datatable custom-table patient-profile-table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <div class="form-check check-tables">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="something">
                                                        </div>
                                                    </th>
                                                    <th>Date</th>
                                                    <th>Doctor</th>
                                                    <th>Treatment</th>
                                                    <th>Charges ($)</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="form-check check-tables">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="something">
                                                        </div>
                                                    </td>
                                                    <td>29/09/2022 </td>
                                                    <td>Dr.Jenny Smith</td>
                                                    <td>Check up</td>
                                                    <td>$ 60</td>
                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                    class="fa fa-ellipsis-v"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="edit-appointment.html"><i
                                                                        class="fa-solid fa-pen-to-square m-r-5"></i>
                                                                    Edit</a>
                                                                <a class="dropdown-item" href="#"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_appointment"><i
                                                                        class="fa fa-trash-alt m-r-5"></i>
                                                                    Delete</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check check-tables">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="something">
                                                        </div>
                                                    </td>
                                                    <td>19/09/2022 </td>
                                                    <td>Andrea Lalema</td>
                                                    <td>Blood Test </td>
                                                    <td>$ 50</td>
                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                    class="fa fa-ellipsis-v"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="edit-appointment.html"><i
                                                                        class="fa-solid fa-pen-to-square m-r-5"></i>
                                                                    Edit</a>
                                                                <a class="dropdown-item" href="#"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_appointment"><i
                                                                        class="fa fa-trash-alt m-r-5"></i>
                                                                    Delete</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="form-check check-tables">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="something">
                                                        </div>
                                                    </td>
                                                    <td>20/09/2022 </td>
                                                    <td>Dr.William Stephin</td>
                                                    <td>Blood Pressure</td>
                                                    <td>$ 30</td>
                                                    <td class="text-end">
                                                        <div class="dropdown dropdown-action">
                                                            <a href="#" class="action-icon dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                    class="fa fa-ellipsis-v"></i></a>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="edit-appointment.html"><i
                                                                        class="fa-solid fa-pen-to-square m-r-5"></i>
                                                                    Edit</a>
                                                                <a class="dropdown-item" href="#"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#delete_appointment"><i
                                                                        class="fa fa-trash-alt m-r-5"></i>
                                                                    Delete</a>
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
            </div>
        </div>
    </div>
@endsection
