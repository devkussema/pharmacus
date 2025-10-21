@extends('admin::layout.main')

@section('title', 'Lista de Usuários')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-table show-entire">
                <div class="card-body">

                    <div class="page-table-header mb-2">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="doctor-table-blk">
                                    <h3>Lista de Usuários</h3>
                                    <div class="doctor-search-blk">
                                        <div class="top-nav-search table-search-blk">
                                            <form>
                                                <input type="text" class="form-control" placeholder="Pesquisar">
                                                <a class="btn">
                                                    <img src="{{ assetr('assets/img/icons/search-normal.svg')}}" alt>
                                                </a>
                                            </form>
                                        </div>
                                        <div class="add-group">
                                            <a href="add-doctor.html" class="btn btn-primary add-pluss ms-2">
                                                <img src="{{ assetr('assets/img/icons/plus.svg') }}" alt>
                                                </a>
                                            <a href="javascript:;" class="btn btn-primary doctor-refresh ms-2"><img
                                                    src="{{ assetr('assets/img/icons/re-fresh.svg') }}" alt></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href="javascript:;" class=" me-2"><img src="assets/img/icons/pdf-icon-01.svg" alt></a>
                                <a href="javascript:;" class=" me-2"><img src="assets/img/icons/pdf-icon-02.svg" alt></a>
                                <a href="javascript:;" class=" me-2"><img src="assets/img/icons/pdf-icon-03.svg" alt></a>
                                <a href="javascript:;"><img src="assets/img/icons/pdf-icon-04.svg" alt></a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table border-0 custom-table comman-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-check check-tables">
                                            <input class="form-check-input" type="checkbox" value="something">
                                        </div>
                                    </th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Specialization</th>
                                    <th>Degree</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Joining Date</th>
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
                                    <td class="profile-image"><a href="profile.html"><img width="28" height="28"
                                                src="assets/img/profiles/avatar-01.jpg" class="rounded-circle m-r-5" alt>
                                            Andrea Lalema</a></td>
                                    <td>Otolaryngology</td>
                                    <td>Infertility</td>
                                    <td>MBBS, MS</td>
                                    <td><a href="javascript:;">+1 23 456890</a></td>
                                    <td><a href="https://preclinic.dreamstechnologies.com/cdn-cgi/l/email-protection"
                                            class="__cf_email__"
                                            data-cfemail="9df8e5fcf0edf1f8ddf8f0fcf4f1b3fef2f0">[email&#160;protected]</a>
                                    </td>
                                    <td>01.10.2022</td>
                                    <td class="text-end">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                                aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="edit-doctor.html"><i
                                                        class="fa-solid fa-pen-to-square m-r-5"></i>
                                                    Edit</a>
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#delete_patient"><i class="fa fa-trash-alt m-r-5"></i>
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
@endsection
