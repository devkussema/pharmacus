@extends('prepharma.layout.app')

@section('titulo', 'Usuários')

@section('content')
        <div class="content">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('usuario') }}">Usuários </a></li>
                            <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                            <li class="breadcrumb-item active">Lista de usuários</li>
                        </ul>
                    </div>
                </div>
            </div>

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
                                                {{--<div class="top-nav-search table-search-blk">
                                                    <form>
                                                        <input type="text" class="form-control"
                                                            placeholder="Search here">
                                                        <a class="btn"><img src="assets/img/icons/search-normal.svg"
                                                                alt></a>
                                                    </form>
                                                </div> --}}
                                                <div class="add-group">
                                                    <a href="#" class="btn btn-primary add-pluss ms-2" data-bs-toggle="modal" data-bs-target="#addUsuarioModal">
                                                            <img src="{{ asset('assets/img/icons/plus.svg') }}" alt>
                                                        </a>
                                                    <a href="javascript:;" class="btn btn-primary doctor-refresh ms-2">
                                                        <img src="{{ asset('assets/img/icons/re-fresh.svg') }}" alt>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<div class="col-auto text-end float-end ms-auto download-grp">
                                        <a href="javascript:;" class=" me-2"><img src="assets/img/icons/pdf-icon-01.svg"
                                                alt></a>
                                        <a href="javascript:;" class=" me-2"><img src="assets/img/icons/pdf-icon-02.svg"
                                                alt></a>
                                        <a href="javascript:;" class=" me-2"><img src="assets/img/icons/pdf-icon-03.svg"
                                                alt></a>
                                        <a href="javascript:;"><img src="assets/img/icons/pdf-icon-04.svg" alt></a>
                                    </div>--}}
                                </div>
                            </div>

                            <div class="staff-search-table">
                                <form id="user-filter-form" onsubmit="return false;">
                                    <div class="row">
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="input-block local-forms">
                                                <label>Pesquisar</label>
                                                <input id="filter-search" name="search" class="form-control" type="text" placeholder="Nome ou email">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="input-block local-forms">
                                                <label>Grupo</label>
                                                <select id="filter-grupo" name="grupo_id" class="form-control select">
                                                    <option value="">Todos os grupos</option>
                                                    @foreach($grupos as $g)
                                                        <option value="{{ $g->id }}">{{ $g->nome }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="input-block local-forms">
                                                <label>Tipo</label>
                                                <select id="filter-tipo" name="tipo" class="form-control select">
                                                    <option value="all">Todos</option>
                                                    <option value="gerente">Gerente</option>
                                                    <option value="usuario">Usuário</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="input-block local-forms">
                                                <label>Status</label>
                                                <select id="filter-status" name="status" class="form-control select">
                                                    <option value="">Todos</option>
                                                    <option value="1">Ativo</option>
                                                    <option value="0">Inativo</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 col-xl-4">
                                            <div class="doctor-submit d-flex flex-column flex-sm-row align-items-center gap-2">
                                                <button id="filter-apply" type="button" class="btn btn-primary submit-list-form d-flex align-items-center">
                                                    <!-- ícone lupa -->
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2" aria-hidden="true">
                                                        <path d="M11.742 10.344l3.387 3.387a1 1 0 0 1-1.414 1.414l-3.387-3.387a6 6 0 1 1 1.414-1.414zM6.5 11a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9z" fill="#fff"/>
                                                    </svg>
                                                    Aplicar
                                                </button>
                                                <button id="filter-reset" type="button" class="btn btn-outline-secondary d-flex align-items-center">
                                                    <!-- ícone limpar (x) -->
                                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="me-2" aria-hidden="true">
                                                        <path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    Limpar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="users-loader" class="text-center my-3" style="display:none;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">A Carregar...</span>
                                </div>
                            </div>
                            <div class="table-responsive">
                                @php
                                    // fallback: se o controller não passou $users, obter todos
                                    $users = $users ?? \App\Models\User::all();
                                @endphp
                                <table class="table border-0 custom-table comman-table datatable mb-0">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="form-check check-tables">
                                                    <input class="form-check-input" type="checkbox" value="all" id="select_all_users">
                                                </div>
                                            </th>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Grupo</th>
                                            <th>Tipo</th>
                                            <th>Status</th>
                                            <th>Telefone</th>
                                            <th class="text-end">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $user)
                                            <tr>
                                                <td>
                                                    <div class="form-check check-tables">
                                                        <input class="form-check-input user-checkbox" type="checkbox" value="{{ $user->id }}">
                                                    </div>
                                                </td>
                                                <td class="profile-image">
                                                    <a href="{{ route('u.perfil', ['username' => $user->id] ?? '#') }}">
                                                        @php
                                                            $avatar = $user->foto_perfil ? url('storage/'.$user->foto_perfil) : assetr('assets/images/default-avatar.png');
                                                        @endphp
                                                        <img width="28" height="28" src="{{ $avatar }}" class="rounded-circle m-r-5" alt>
                                                        {{ $user->nome }}
                                                    </a>
                                                </td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ optional($user->grupo)->nome ?? '-' }}</td>
                                                <td>
                                                    @if($user->isFarmacia)
                                                        Gerente
                                                    @else
                                                        Usuário
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($user->status)
                                                        <span class="badge bg-success">Ativo</span>
                                                    @else
                                                        <span class="badge bg-secondary">Inativo</span>
                                                    @endif
                                                </td>
                                                <td>{{ $user->telefone ?? '-' }}</td>
                                                <td class="text-end">
                                                    <div class="d-flex justify-content-end gap-2">
                                                        <a href="{{ route('u.perfil', ['username' => $user->id] ?? '#') }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                                        <a href="#" onclick="location.href='{{ route('u.perfil', ['username' => $user->id] ?? '#') }}'" class="btn btn-sm btn-success">Editar</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Nenhum usuário encontrado.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            (function () {
                const form = document.getElementById('user-filter-form');
                const applyBtn = document.getElementById('filter-apply');
                const resetBtn = document.getElementById('filter-reset');
                const loader = document.getElementById('users-loader');
                const tbody = document.querySelector('table.comman-table tbody');

                function serializeForm() {
                    const data = new URLSearchParams();
                    const search = document.getElementById('filter-search').value;
                    const grupo = document.getElementById('filter-grupo').value;
                    const tipo = document.getElementById('filter-tipo').value;
                    const status = document.getElementById('filter-status').value;

                    if (search) data.append('search', search);
                    if (grupo) data.append('grupo_id', grupo);
                    if (tipo) data.append('tipo', tipo);
                    if (status !== '') data.append('status', status);

                    return data.toString();
                }

                async function fetchUsers() {
                    try {
                        loader.style.display = '';
                        const qs = serializeForm();
                        const url = '{{ route('usuario') }}' + (qs ? ('?' + qs) : '');

                        const res = await fetch(url, {
                            headers: { 'Accept': 'application/json' }
                        });

                        if (!res.ok) throw new Error('Erro: ' + res.status);

                        const json = await res.json();
                        renderRows(json.users || []);
                    } catch (err) {
                        console.error('Erro ao buscar usuários', err);
                        tbody.innerHTML = '<tr><td colspan="8" class="text-center text-danger">Ocorreu um erro ao carregar os usuários.</td></tr>';
                    } finally {
                        loader.style.display = 'none';
                    }
                }

                function renderRows(users) {
                    if (!users || users.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="8" class="text-center">Nenhum usuário encontrado.</td></tr>';
                        return;
                    }

                    tbody.innerHTML = users.map(function (u) {
                        const statusBadge = u.status ? '<span class="badge bg-success">Ativo</span>' : '<span class="badge bg-secondary">Inativo</span>';
                        const tipoText = u.isFarmacia ? 'Gerente' : 'Usuário';
                        const avatar = u.foto_perfil || '{{ assetr('assets/images/default-avatar.png') }}';

                        return `
                            <tr>
                                <td>
                                    <div class="form-check check-tables">
                                        <input class="form-check-input user-checkbox" type="checkbox" value="${u.id}">
                                    </div>
                                </td>
                                <td class="profile-image">
                                    <a href="${u.perfil_url}">
                                        <img width="28" height="28" src="${avatar}" class="rounded-circle m-r-5" alt>
                                        ${u.nome}
                                    </a>
                                </td>
                                <td>${u.email}</td>
                                <td>${u.grupo || '-'}</td>
                                <td>${tipoText}</td>
                                <td>${statusBadge}</td>
                                <td>${u.telefone || '-'}</td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="${u.perfil_url}" class="btn btn-sm btn-outline-primary">Ver</a>
                                        <a href="#" onclick="location.href='${u.perfil_url}'" class="btn btn-sm btn-success">Editar</a>
                                    </div>
                                </td>
                            </tr>
                        `;
                    }).join('');
                }

                applyBtn.addEventListener('click', function (e) {
                    fetchUsers();
                });

                resetBtn.addEventListener('click', function () {
                    form.reset();
                    fetchUsers();
                });

                // Carregar inicialmente
                document.addEventListener('DOMContentLoaded', function () {
                    // se houver filtro preenchido pelo backend, não sobrescreve
                    fetchUsers();
                });
            })();
        </script>
    @include('prepharma.modals._addUsuario')
        <script>
            // Handler AJAX para criação de usuário via modal
            window.handleAddUsuario = async function (evt) {
                evt.preventDefault();
                const form = document.getElementById('formAddUsuario');
                const data = new FormData(form);
                const url = form.action;
                try {
                    const res = await fetch(url, {
                        method: 'POST',
                        headers: { 'Accept': 'application/json' },
                        body: data
                    });
                    if (res.status === 422) {
                        const json = await res.json();
                        // Exibir erros (simples alert por enquanto)
                        alert(Object.values(json.errors).flat().join('\n'));
                        return false;
                    }
                    if (!res.ok) throw new Error('Erro ao criar usuário');

                    // Sucesso — fechar modal e recarregar tabela
                    try{ const m = document.getElementById('addUsuarioModal'); if (typeof bootstrap !== 'undefined') bootstrap.Modal.getOrCreateInstance(m).hide(); else jQuery('#addUsuarioModal').modal('hide'); }catch(e){}
                    // Recarregar lista de usuários via função existente
                    try{ if (typeof fetchUsers === 'function') fetchUsers(); }catch(e){}
                    alert('Usuário criado e convite enviado por e-mail.');
                    return false;
                } catch (err) {
                    console.error(err);
                    alert('Ocorreu um erro. Tente novamente.');
                    return false;
                }
            }
        </script>
        <div class="notification-box">
            <div class="msg-sidebar notifications msg-noti">
                <div class="topnav-dropdown-header">
                    <span>Messages</span>
                </div>
                <div class="drop-scroll msg-list-scroll" id="msg_list">
                    <ul class="list-box">
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">R</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">Richard Miles </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item new-message">
                                    <div class="list-left">
                                        <span class="avatar">J</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">John Doe</span>
                                        <span class="message-time">1 Aug</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">T</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author"> Tarah Shropshire </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">M</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">Mike Litorus</span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">C</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author"> Catherine Manseau </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">D</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author"> Domenic Houston </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">B</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author"> Buster Wigton </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">R</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author"> Rolland Webber </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">C</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author"> Claire Mapes </span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">M</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">Melita Faucher</span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">J</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">Jeffery Lalor</span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">L</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">Loren Gatlin</span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <div class="list-item">
                                    <div class="list-left">
                                        <span class="avatar">T</span>
                                    </div>
                                    <div class="list-body">
                                        <span class="message-author">Tarah Shropshire</span>
                                        <span class="message-time">12:28 AM</span>
                                        <div class="clearfix"></div>
                                        <span class="message-content">Lorem ipsum dolor sit amet, consectetur
                                            adipiscing</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="chat.html">See all messages</a>
                </div>
            </div>
        </div>
@endsection
