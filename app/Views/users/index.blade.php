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
                                            <a href="{{ route('cp.users.create') }}" class="btn btn-primary add-pluss ms-2">
                                                <img src="{{ assetr('assets/img/icons/plus.svg') }}" alt>
                                            </a>
                                            <a href="javascript:;" id="js-refresh-users" class="btn btn-primary doctor-refresh ms-2"><img
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
                            <tbody id="js-users-rows">
                                @include('admin::users._rows', ['users' => $users])
                            </tbody>
                        </table>
                        @include('admin::users._pagination', ['users' => $users])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        (function ($) {
            $(document).ready(function () {
                function loadUsers(url) {
                    var $btn = $('#js-refresh-users');
                    $btn.prop('disabled', true);
                    $.ajax({
                        url: url || '{{ route("cp.users.index") }}',
                        method: 'GET',
                        dataType: 'json'
                    }).done(function (res) {
                        if (res.html) {
                            $('#js-users-rows').html(res.html);
                        }
                        if (res.pagination) {
                            // replace pagination container
                            $('#js-users-pagination').replaceWith(res.pagination);
                        }
                    }).fail(function () {
                        alert('Erro ao obter lista de utilizadores.');
                    }).always(function () {
                        $btn.prop('disabled', false);
                    });
                }

                $('#js-refresh-users').on('click', function (e) {
                    e.preventDefault();
                    loadUsers();
                });

                // Delegate click on pagination links
                $(document).on('click', '#js-users-pagination a', function (e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    if (url) {
                        loadUsers(url);
                    }
                });
            });
        })(jQuery);
    </script>
@endsection
