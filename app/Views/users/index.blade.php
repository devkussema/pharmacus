@extends('admin::layout.main')

@section('title', 'Lista de Usuários')

@section('content')
    <div class="row">
        <div class="col-sm-12">
                @include('admin::partials.session')
            <div class="card card-table show-entire">
                <div class="card-body">
                    <div class="page-table-header mb-2">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="doctor-table-blk">
                                    <h3>Lista de Usuários</h3>
                                    <div class="doctor-search-blk">
                                        <div class="top-nav-search table-search-blk">
                                            <form id="js-users-search-form" onsubmit="return false;">
                                                <input type="text" id="js-users-search" name="q" value="{{ request('q') }}" class="form-control" placeholder="Pesquisar">
                                                <a class="btn" id="js-users-search-btn">
                                                    <img src="{{ assetr('assets/img/icons/search-normal.svg')}}" alt>
                                                </a>
                                            </form>
                                        </div>
                                        <div class="add-group">
                                            <a href="{{ route('cp.users.create') }}" class="btn btn-primary add-pluss ms-2">
                                                <img src="{{ assetr('assets/img/icons/plus.svg') }}" alt>
                                            </a>
                                            <a href="javascript:;" id="js-refresh-users" class="btn btn-primary doctor-refresh ms-2">
                                                <span id="js-refresh-spinner" class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true" style="display:none"></span>
                                                <img src="{{ assetr('assets/img/icons/re-fresh.svg') }}" alt>
                                            </a>
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
                                    <th>Nome</th>
                                    <th>Grupo</th>
                                    <th>Telefone</th>
                                    <th>Email</th>
                                    <th>Data de Criação</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody id="js-users-rows">
                                @include('admin::users._rows', ['users' => $users])
                            </tbody>
                        </table>
                        <div id="js-users-pagination">
                            @include('admin::users._pagination', ['users' => $users])
                        </div>
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
                function loadUsers(url, qs) {
                    var $btn = $('#js-refresh-users');
                    var $spinner = $('#js-refresh-spinner');
                    $btn.prop('disabled', true);
                    $spinner.show();

                    // append querystring if provided
                    var requestUrl = url || '{{ route("cp.users.index") }}';
                    if (qs) {
                        requestUrl += (requestUrl.indexOf('?') === -1 ? '?' : '&') + qs;
                    }

                    $.ajax({
                        url: requestUrl,
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
                        $spinner.hide();
                    });
                }

                $('#js-refresh-users').on('click', function (e) {
                    e.preventDefault();
                    var qs = $('#js-users-search').val() ? 'q=' + encodeURIComponent($('#js-users-search').val()) : '';
                    loadUsers(undefined, qs);
                });

                // Delegate click on pagination links
                $(document).on('click', '#js-users-pagination a', function (e) {
                    e.preventDefault();
                    var url = $(this).attr('href');
                    if (url) {
                        // preserve current search
                        var qs = $('#js-users-search').val() ? 'q=' + encodeURIComponent($('#js-users-search').val()) : '';
                        loadUsers(url, qs);
                    }
                });

                // Debounced search
                var debounceTimer;
                $('#js-users-search').on('input', function () {
                    clearTimeout(debounceTimer);
                    var q = $(this).val();
                    debounceTimer = setTimeout(function () {
                        var qs = q ? 'q=' + encodeURIComponent(q) : '';
                        loadUsers(undefined, qs);
                    }, 400);
                });
            });
        })(jQuery);
    </script>
@endsection
