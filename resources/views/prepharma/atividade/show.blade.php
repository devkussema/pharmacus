@extends('layout.app')

@section('titulo', 'Atividades')

@section('content')
    <div class="content container-fluid">

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

        @include('partials.session')

        <!-- Barra de Filtros e Ações -->
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                    <input type="text" id="searchInput" class="form-control"
                                           placeholder="Buscar por usuário ou atividade...">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select id="userFilter" class="form-control">
                                    <option value="">Todos os usuários</option>
                                    @foreach(\App\Models\User::orderBy('nome')->get() as $user)
                                        <option value="{{ $user->id }}">{{ $user->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select id="typeFilter" class="form-control">
                                    <option value="all">Todos os tipos</option>
                                    <option value="activity">Atividades</option>
                                    <option value="auth">Auth (login/logout/password)</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select id="dateFilter" class="form-control">
                                    <option value="">Todas as datas</option>
                                    <option value="today">Hoje</option>
                                    <option value="yesterday">Ontem</option>
                                    <option value="week">Esta semana</option>
                                    <option value="month">Este mês</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select id="limitFilter" class="form-control">
                                    <option value="12">12 itens</option>
                                    <option value="25">25 itens</option>
                                    <option value="50">50 itens</option>
                                    <option value="100">100 itens</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div class="d-flex">
                                    <button id="exportBtn" class="btn btn-outline-success btn-sm me-2" data-bs-toggle="tooltip" title="Exportar para Excel">
                                        <i class="fas fa-file-excel"></i>
                                    </button>
                                    <button id="refreshBtn" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" title="Atualizar">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="activity">
                            <div class="activity-box">
                                <ul class="activity-list" id="activityList">
                                    @foreach (\App\Models\Atividade::take(25)->orderByDesc('created_at')->get() as $at)
                                        <li class="activity-item" data-user-id="{{ $at->user_id }}" data-date="{{ $at->created_at->format('Y-m-d') }}" data-text="{{ strtolower($at->texto) }}">
                                            <div class="activity-user">
                                                <a href="javascript:void(0)"
                                                   title="Usuário: {{ $at->user->nome }}&#10;Data: {{ formatDataAtv($at->created_at) }}&#10;Hora: {{ formatar_horas($at->created_at) }}&#10;Atividade: {{ $at->texto }}"
                                                   data-bs-toggle="tooltip" data-bs-html="true" class="avatar">
                                                    <img alt="{{ $at->user->nome }}"
                                                        src="{{ assetr('assets/img/white__logo2.png') }}"
                                                        class="img-fluid rounded-circle">
                                                </a>
                                            </div>
                                            <div class="activity-content timeline-group-blk">
                                                <div class="timeline-group flex-shrink-0">
                                                    <h4 class="{{ $at->created_at->isToday() ? 'text-primary' : '' }}">
                                                        {{ formatDataAtv($at->created_at) }}
                                                    </h4>
                                                    <span class="time">{{ formatar_horas($at->created_at) }}</span>
                                                </div>
                                                <div class="comman-activitys flex-grow-1">
                                                    <h3>{{ $at->user->nome }}</h3>
                                                    <p><span>{{ $at->texto }}</span></p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>

                                <!-- No Results Message -->
                                <div id="noResults" class="text-center py-5" style="display: none;">
                                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">Nenhuma atividade encontrada</h5>
                                    <p class="text-muted">Tente ajustar os filtros de pesquisa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Search functionality
            $('#searchInput').on('keyup', function() {
                filterActivities();
            });

            // Filter functionality
            $('#userFilter, #dateFilter').on('change', function() {
                filterActivities();
            });

            // Limit filter
            $('#limitFilter').on('change', function() {
                // prefer AJAX reload when switching limit
                loadCurrentType();
            });

            // Type filter (Auth / Atividades)
            $('#typeFilter').on('change', function() {
                loadCurrentType();
            });

            // Export functionality
            $('#exportBtn').on('click', function() {
                exportToExcel();
            });

            // Refresh functionality
            $('#refreshBtn').on('click', function() {
                location.reload();
            });

            function filterActivities() {
                let searchTerm = $('#searchInput').val().toLowerCase();
                let userFilter = $('#userFilter').val();
                let dateFilter = $('#dateFilter').val();
                let visibleCount = 0;

                $('.activity-item').each(function() {
                    let show = true;
                    let $item = $(this);

                    // Search filter
                    if (searchTerm) {
                        let text = $item.data('text');
                        let userName = $item.find('h3').text().toLowerCase();
                        if (!text.includes(searchTerm) && !userName.includes(searchTerm)) {
                            show = false;
                        }
                    }

                    // User filter
                    if (userFilter && $item.data('user-id') != userFilter) {
                        show = false;
                    }

                    // Date filter
                    if (dateFilter) {
                        let itemDate = new Date($item.data('date'));
                        let today = new Date();
                        let showDate = false;

                        switch(dateFilter) {
                            case 'today':
                                showDate = itemDate.toDateString() === today.toDateString();
                                break;
                            case 'yesterday':
                                let yesterday = new Date(today);
                                yesterday.setDate(yesterday.getDate() - 1);
                                showDate = itemDate.toDateString() === yesterday.toDateString();
                                break;
                            case 'week':
                                let weekAgo = new Date(today);
                                weekAgo.setDate(weekAgo.getDate() - 7);
                                showDate = itemDate >= weekAgo;
                                break;
                            case 'month':
                                let monthAgo = new Date(today);
                                monthAgo.setMonth(monthAgo.getMonth() - 1);
                                showDate = itemDate >= monthAgo;
                                break;
                        }
                        if (!showDate) show = false;
                    }

                    if (show) {
                        $item.show();
                        visibleCount++;
                    } else {
                        $item.hide();
                    }
                });

                // Show/hide no results message
                if (visibleCount === 0) {
                    $('#noResults').show();
                } else {
                    $('#noResults').hide();
                }
            }

            // Carrega atividades de acordo com o tipo selecionado.
            // Tenta buscar via endpoint JSON (/atividades/json?type=auth|activity&limit=XX).
            // Se falhar, usa o filtro local no DOM como fallback.
            async function loadCurrentType() {
                const type = $('#typeFilter').val() || 'all';
                const limit = $('#limitFilter').val() || 25;

                // Se "all" ou "activity", podemos reutilizar o HTML atual
                if (type === 'all' || type === 'activity') {
                    // Request para servidor caso exista endpoint
                    try {
                        const res = await fetch(`/atividades/json?type=${type}&limit=${limit}`, { headers: { 'Accept': 'application/json' }});
                        if (res.ok) {
                            const json = await res.json();
                            renderActivities(json.items || json);
                            return;
                        }
                    } catch (e) {
                        // ignore and fallback to DOM filter
                    }

                    // fallback: re-show existing items and apply local filters
                    $('.activity-item').show();
                    filterActivities();
                    return;
                }

                // type === 'auth' -> fetch auth logs
                try {
                    const res = await fetch(`/atividades/json?type=auth&limit=${limit}`, { headers: { 'Accept': 'application/json' }});
                    if (!res.ok) throw new Error('no json');
                    const json = await res.json();
                    renderActivities(json.items || json, 'auth');
                    return;
                } catch (e) {
                    // if endpoint not available, show message
                    $('#activityList').empty();
                    $('#noResults').show().find('h5').text('Nenhuma atividade de autenticação disponível (endpoint faltando)');
                }
            }

            // Renderiza um array de items no #activityList
            function renderActivities(items, mode = 'activity') {
                $('#noResults').hide();
                const $list = $('#activityList');
                $list.empty();
                if (!items || items.length === 0) {
                    $('#noResults').show();
                    return;
                }

                items.forEach(item => {
                    if (mode === 'auth' || item.action) {
                        // auth log
                        const date = new Date(item.created_at || item.createdAt);
                        const userName = item.user_name || item.user?.nome || '—';
                        const texto = `${(item.action || 'auth')} — ${item.status || ''}`;
                        const li = `<li class="activity-item" data-user-id="${item.user_id || ''}" data-date="${date.toISOString().slice(0,10)}" data-text="${texto.toLowerCase()}">
                                        <div class="activity-user">
                                            <a href="javascript:void(0)" title="Usuário: ${userName}&#10;Data: ${date.toLocaleDateString()}&#10;Hora: ${date.toLocaleTimeString()}&#10;Atividade: ${texto}" data-bs-toggle="tooltip" data-bs-html="true" class="avatar">
                                                <img alt="${userName}" src="${"`"+""}" class="img-fluid rounded-circle">
                                            </a>
                                        </div>
                                        <div class="activity-content timeline-group-blk">
                                            <div class="timeline-group flex-shrink-0">
                                                <h4 class="${isToday(date) ? 'text-primary' : ''}">${formatDateSimple(date)}</h4>
                                                <span class="time">${formatTimeSimple(date)}</span>
                                            </div>
                                            <div class="comman-activitys flex-grow-1">
                                                <h3>${userName}</h3>
                                                <p><span>${texto}</span></p>
                                            </div>
                                        </div>
                                    </li>`;
                        $list.append(li);
                    } else {
                        // atividade normal (espera-se campos user, texto, created_at)
                        const date = new Date(item.created_at || item.createdAt);
                        const userName = item.user?.nome || item.user_name || '—';
                        const texto = item.texto || item.action || '';
                        const li = `<li class="activity-item" data-user-id="${item.user_id || ''}" data-date="${date.toISOString().slice(0,10)}" data-text="${(texto||'').toLowerCase()}">
                                        <div class="activity-user">
                                            <a href="javascript:void(0)" title="Usuário: ${userName}&#10;Data: ${formatDateSimple(date)}&#10;Hora: ${formatTimeSimple(date)}&#10;Atividade: ${texto}" data-bs-toggle="tooltip" data-bs-html="true" class="avatar">
                                                <img alt="${userName}" src="${"`"+""}" class="img-fluid rounded-circle">
                                            </a>
                                        </div>
                                        <div class="activity-content timeline-group-blk">
                                            <div class="timeline-group flex-shrink-0">
                                                <h4 class="${isToday(date) ? 'text-primary' : ''}">${formatDateSimple(date)}</h4>
                                                <span class="time">${formatTimeSimple(date)}</span>
                                            </div>
                                            <div class="comman-activitys flex-grow-1">
                                                <h3>${userName}</h3>
                                                <p><span>${texto}</span></p>
                                            </div>
                                        </div>
                                    </li>`;
                        $list.append(li);
                    }
                });

                // re-init tooltips se necessário
                try { $('[data-bs-toggle="tooltip"]').tooltip(); } catch (e) {}
            }

            function isToday(d) {
                const t = new Date();
                return d.toDateString() === t.toDateString();
            }

            function formatDateSimple(d) {
                return d.toLocaleDateString();
            }

            function formatTimeSimple(d) {
                return d.toLocaleTimeString();
            }

            function exportToExcel() {
                let activities = [];
                $('.activity-item:visible').each(function() {
                    let $item = $(this);
                    activities.push({
                        'Usuário': $item.find('h3').text(),
                        'Data': $item.find('h4').text(),
                        'Hora': $item.find('.time').text(),
                        'Atividade': $item.find('p span').text()
                    });
                });

                // Converter para CSV
                let csvContent = "data:text/csv;charset=utf-8,";
                csvContent += "Usuário,Data,Hora,Atividade\n";

                activities.forEach(function(activity) {
                    csvContent += `"${activity.Usuário}","${activity.Data}","${activity.Hora}","${activity.Atividade}"\n`;
                });

                let encodedUri = encodeURI(csvContent);
                let link = document.createElement("a");
                link.setAttribute("href", encodedUri);
                link.setAttribute("download", "atividades_" + new Date().toISOString().split('T')[0] + ".csv");
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        });
    </script>

@endsection
