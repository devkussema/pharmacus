<div class="row">
    <div class="col-sm-12">
        <div class="card card-table show-entire">
            <div class="card-body">

                <div class="page-table-header mb-2">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="doctor-table-blk">
                                <h3>Lista de Fornecedores</h3>
                                <div class="doctor-search-blk">
                                    <div class="top-nav-search table-search-blk">
                                        <form>
                                            <input type="text" class="form-control" placeholder="Procure aqui...">
                                            <a class="btn"><img src="assets/img/icons/search-normal.svg" alt></a>
                                        </form>
                                    </div>
                                    <div class="add-group">
                                        <a href="add-leave.html" class="btn btn-primary add-pluss ms-2"><img
                                                src="assets/img/icons/plus.svg" alt></a>
                                        <a href="javascript:;" class="btn btn-primary doctor-refresh ms-2"><img
                                                src="assets/img/icons/re-fresh.svg" alt></a>
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

                <div class="staff-search-table">
                    <form>
                        <div class="row">
                            <div class="col-12 col-md-6 col-xl-4">
                                <div class="input-block local-forms">
                                    <label>Employee Name </label>
                                    <input class="form-control" type="text">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-xl-4">
                                <div class="input-block local-forms">
                                    <label>Leave Type </label>
                                    <select class="form-control select">
                                        <option>Select Leave Type</option>
                                        <option>Medical Leave</option>
                                        <option>Casual Leave</option>
                                        <option>Loss of Pay</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-xl-4">
                                <div class="input-block local-forms">
                                    <label>Leave Status </label>
                                    <select class="form-control select">
                                        <option>Leave Status</option>
                                        <option>Pending</option>
                                        <option>Approved</option>
                                        <option>Declined</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-xl-4">
                                <div class="input-block local-forms cal-icon">
                                    <label>From </label>
                                    <input class="form-control datetimepicker" type="text">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-xl-4">
                                <div class="input-block local-forms cal-icon">
                                    <label>To </label>
                                    <input class="form-control datetimepicker" type="text">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-xl-4">
                                <div class="doctor-submit">
                                    <button type="submit" class="btn btn-primary submit-list-form me-2">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
                                <th>Employee Name</th>
                                <th>Leave Type</th>
                                <th>From</th>
                                <th>To</th>
                                <th>No of days</th>
                                <th>Reason</th>
                                <th>Status</th>
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
                                <td>Medical Leave</td>
                                <td>02.10.2022</td>
                                <td>04.10.2022</td>
                                <td>2 Days</td>
                                <td>Not Feeling well</td>
                                <td>
                                    <div class="dropdown action-label">
                                        <a class="custom-badge status-green dropdown-toggle" href="#"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Approved
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end status-staff">
                                            <a class="dropdown-item" href="javascript:;">New</a>
                                            <a class="dropdown-item" href="javascript:;">Pending</a>
                                            <a class="dropdown-item" href="javascript:;">Approved</a>
                                            <a class="dropdown-item" href="javascript:;">Declined</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="edit-leave.html"><i
                                                    class="fa-solid fa-pen-to-square m-r-5"></i>
                                                Edit</a>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#delete_patient"><i class="fa fa-trash-alt m-r-5"></i>
                                                Delete</a>
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
                                <td class="profile-image"><a href="profile.html"><img width="28" height="28"
                                            src="assets/img/profiles/avatar-02.jpg" class="rounded-circle m-r-5"
                                            alt>Smith Bruklin</a></td>
                                <td>Casual Leave</td>
                                <td>04.10.2022</td>
                                <td>06.10.2022</td>
                                <td>2 Days</td>
                                <td>Going to Vacation</td>
                                <td>
                                    <div class="dropdown action-label">
                                        <a class="custom-badge status-orange dropdown-toggle" href="#"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Pending
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end status-staff">
                                            <a class="dropdown-item" href="javascript:;">New</a>
                                            <a class="dropdown-item" href="javascript:;">Pending</a>
                                            <a class="dropdown-item" href="javascript:;">Approved</a>
                                            <a class="dropdown-item" href="javascript:;">Declined</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="edit-leave.html"><i
                                                    class="fa-solid fa-pen-to-square m-r-5"></i>
                                                Edit</a>
                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#delete_patient"><i class="fa fa-trash-alt m-r-5"></i>
                                                Delete</a>
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
                                <td class="profile-image"><a href="profile.html"><img width="28" height="28"
                                            src="assets/img/profiles/avatar-03.jpg" class="rounded-circle m-r-5"
                                            alt>William Stephin</a></td>
                                <td>Casual Leave</td>
                                <td>02.10.2022</td>
                                <td>04.10.2022</td>
                                <td>2 Days</td>
                                <td>Family Function</td>
                                <td>
                                    <div class="dropdown action-label">
                                        <a class="custom-badge status-pink dropdown-toggle" href="#"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Declined
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end status-staff">
                                            <a class="dropdown-item" href="javascript:;">New</a>
                                            <a class="dropdown-item" href="javascript:;">Pending</a>
                                            <a class="dropdown-item" href="javascript:;">Approved</a>
                                            <a class="dropdown-item" href="javascript:;">Declined</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle"
                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="edit-leave.html"><i
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
