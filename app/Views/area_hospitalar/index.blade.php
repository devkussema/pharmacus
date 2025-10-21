@extends('admin::layout.main')

@section('title', 'Lista de Áreas Hospitalares')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card card-table show-entire">
            <div class="card-body">

                <div class="page-table-header mb-2">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="doctor-table-blk">
                                <h3>Áreas Hospitalares</h3>
                                <div class="doctor-search-blk">
                                    <div class="top-nav-search table-search-blk">
                                        <form>
                                            <input type="text" class="form-control"
                                                placeholder="Pesquise aqui">
                                            <a class="btn">
                                                <img src="{{ assetr('assets/img/icons/search-normal.svg') }}" alt>
                                            </a>
                                        </form>
                                    </div>
                                    <div class="add-group">
                                        <a href="add-department.html"
                                            class="btn btn-primary add-pluss ms-2"><img
                                                src="{{ assetr('assets/img/icons/plus.svg') }}" alt></a>
                                        <a href="javascript:;"
                                            class="btn btn-primary doctor-refresh ms-2"><img
                                                src="{{ assetr('assets/img/icons/re-fresh.svg') }}" alt></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end float-end ms-auto download-grp">
                            <a href="javascript:;" class=" me-2"><img
                                    src="{{ assetr('assets/img/icons/pdf-icon-01.svg') }}" alt></a>
                            <a href="javascript:;" class=" me-2"><img
                                    src="{{ assetr('assets/img/icons/pdf-icon-02.svg') }}" alt></a>
                            <a href="javascript:;" class=" me-2"><img
                                    src="{{ assetr('assets/img/icons/pdf-icon-03.svg') }}" alt></a>
                            <a href="javascript:;"><img src="{{ assetr('assets/img/icons/pdf-icon-04.svg') }}" alt></a>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table border-0 custom-table comman-table datatable mb-0">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check check-tables">
                                        <input class="form-check-input" type="checkbox"
                                            value="something">
                                    </div>
                                </th>
                                <th>Department</th>
                                <th>Department Head</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Status</th>
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
                                <td>Cardiology</td>
                                <td class="profile-image"><a href="profile.html"><img width="28"
                                            height="28" src="assets/img/profiles/avatar-01.jpg"
                                            class="rounded-circle m-r-5" alt> Dr.Andrea Lalema</a></td>
                                <td>Investigates and treats proble...</td>
                                <td>01.10.2022</td>
                                <td><button class="custom-badge status-green ">Active</button></td>
                                <td class="text-end">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="edit-department.html"><i
                                                    class="fa-solid fa-pen-to-square m-r-5"></i>
                                                Edit</a>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#delete_patient"><i
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
@endsection