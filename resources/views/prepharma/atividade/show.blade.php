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

                                <!-- Loader while fetching data -->
                                <div id="activityLoader" class="text-center py-5" style="display: none;">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="visually-hidden">A Carregar...</span>
                                    </div>
                                    <div class="mt-2 text-muted">A Carregar...</div>
                                </div>

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

            // Mostra/oculta loader e desativa controles enquanto carrega
            function setLoading(flag) {
                const $loader = $('#activityLoader');
                const $list = $('#activityList');
                const controls = ['#typeFilter', '#limitFilter', '#userFilter', '#dateFilter', '#searchInput', '#exportBtn', '#refreshBtn'];

                if (flag) {
                    $loader.show();
                    $list.hide();
                    controls.forEach(sel => $(sel).prop('disabled', true));
                } else {
                    $loader.hide();
                    $list.show();
                    controls.forEach(sel => $(sel).prop('disabled', false));
                }
            }

            // Carrega atividades de acordo com o tipo selecionado.
            // Tenta buscar via endpoint JSON (/atividades/json?type=auth|activity&limit=XX).
            // Se falhar, usa o filtro local no DOM como fallback.
            async function loadCurrentType() {
                setLoading(true);
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
                            setLoading(false);
                            return;
                        }
                    } catch (e) {
                        // ignore and fallback to DOM filter
                    }

                    // fallback: re-show existing items and apply local filters
                    $('.activity-item').show();
                    filterActivities();
                    setLoading(false);
                    return;
                }

                // type === 'auth' -> fetch auth logs
                try {
                    const res = await fetch(`/atividades/json?type=auth&limit=${limit}`, { headers: { 'Accept': 'application/json' }});
                    if (!res.ok) throw new Error('no json');
                    const json = await res.json();
                    renderActivities(json.items || json, 'auth');
                    setLoading(false);
                    return;
                } catch (e) {
                    // if endpoint not available, show message
                    $('#activityList').empty();
                    $('#noResults').show().find('h5').text('Nenhuma atividade de autenticação disponível (endpoint faltando)');
                } finally {
                    setLoading(false);
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
                        const li = `<li class="activity-item" data-user-id="${item.user_id || ''}" data-date="${date.toISOString().slice(0,10)}" data-text="${texto.toLowerCase()}" data-action="${item.action}" data-status="${item.status}" data-ip="${item.ip_address || ''}" data-ua="${(item.user_agent||'').replace(/"/g,'&quot;')}">
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
                                                <div class="d-flex align-items-center gap-2 mt-2">
                                                    <button type="button" class="btn btn-sm btn-outline-primary btn-auth-details" data-log-id="${item.id}">Detalhes</button>
                                                </div>
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

            // util: formatar data em pt-PT
            function formatDateTimeISO(iso) {
                try {
                    const d = new Date(iso);
                    return d.toLocaleString('pt-PT', { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit' });
                } catch (e) { return iso || '—'; }
            }

            // util simples para extrair browser e OS do userAgent (fallback leve)
            function parseUserAgent(ua) {
                if (!ua) return 'Desconhecido';
                ua = ua.toLowerCase();
                let browser = 'Desconhecido';
                if (ua.includes('chrome') && !ua.includes('chromium') && !ua.includes('edge')) browser = 'Chrome';
                else if (ua.includes('safari') && !ua.includes('chrome')) browser = 'Safari';
                else if (ua.includes('firefox')) browser = 'Firefox';
                else if (ua.includes('edge') || ua.includes('edg/')) browser = 'Edge';
                else if (ua.includes('opera') || ua.includes('opr/')) browser = 'Opera';

                let os = 'Desconhecido';
                if (ua.includes('windows')) os = 'Windows';
                else if (ua.includes('macintosh') || ua.includes('mac os')) os = 'macOS';
                else if (ua.includes('android')) os = 'Android';
                else if (ua.includes('iphone') || ua.includes('ipad')) os = 'iOS';
                else if (ua.includes('linux')) os = 'Linux';

                return `${browser} on ${os}`;
            }

            // Delegated handler para abrir modal de detalhes de Auth com loader no botão
            $(document).on('click', '.btn-auth-details', function () {
                const $btn = $(this);
                const originalHtml = $btn.html();
                $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Carregando');

                const $li = $btn.closest('.activity-item');
                const user = $li.find('h3').text();
                const cachedAction = $li.data('action') || '';
                const cachedStatus = $li.data('status') || '';
                const cachedIp = $li.data('ip') || '';
                const cachedUa = $li.data('ua') || '';
                const cachedDate = $li.data('date') || '';

                const id = $btn.data('log-id');
                const showModalWith = (data) => {
                    const user_name = data.user_name || user || '—';
                    const action = data.action || cachedAction || '—';
                    const status = data.status || cachedStatus || '—';
                    const ip = data.ip_address || cachedIp || '—';
                    const ua_raw = data.user_agent || cachedUa || '—';
                    const created = data.created_at || cachedDate || '';

                    $('#authDetailsModal .modal-title').text(user_name + (action ? ' — ' + action : ''));
                    $('#auth_avatar').attr('src', data.user_foto || '{{ asset("assets/img/default-avatar.png") }}');
                    $('#auth_user').text(user_name);
                    $('#auth_role').text(data.user_role || '—');
                    $('#auth_badge_action').text(action);
                    $('#auth_badge_status').text(status);
                    $('#auth_ip').text(ip);
                    $('#auth_ua').text(ua_raw);
                    $('#auth_date').text(formatDateTimeISO(created));
                    $('#auth_browser_device').remove();
                    $('<div id="auth_browser_device" class="mb-2"><strong>Navegador/Dispositivo:</strong> ' + parseUserAgent(ua_raw) + '</div>').insertAfter('#auth_ip');

                    var modalEl = document.getElementById('authDetailsModal');
                    var modal = new bootstrap.Modal(modalEl);
                    modal.show();
                };

                if (!id) {
                    showModalWith({ user_name: user, action: cachedAction, status: cachedStatus, ip_address: cachedIp, user_agent: cachedUa, created_at: cachedDate });
                    $btn.prop('disabled', false).html(originalHtml);
                    return;
                }

                // fetch details
                fetch(`/atividades/json/${id}`, { headers: { 'Accept': 'application/json' }})
                    .then(r => r.ok ? r.json() : Promise.reject(r))
                    .then(json => {
                        showModalWith(json);
                    }).catch(() => {
                        // fallback to cached data
                        showModalWith({ user_name: user, action: cachedAction, status: cachedStatus, ip_address: cachedIp, user_agent: cachedUa, created_at: cachedDate });
                    }).finally(() => {
                        $btn.prop('disabled', false).html(originalHtml);
                    });
            });

            // copiar IP com feedback visual
            $(document).on('click', '#copy_ip', function (e) {
                e.preventDefault();
                const $btn = $(this);
                const text = $('#auth_ip').text();
                const originalHtml = $btn.html();

                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(text || '').then(() => {
                        $btn.html('<i class="fas fa-check text-success"></i> Copiado!');
                        setTimeout(() => $btn.html(originalHtml), 2000);
                    }).catch(() => {
                        $btn.html('<i class="fas fa-times text-danger"></i> Erro');
                        setTimeout(() => $btn.html(originalHtml), 2000);
                    });
                } else {
                    $btn.html('<i class="fas fa-times text-danger"></i> Não suportado');
                    setTimeout(() => $btn.html(originalHtml), 2000);
                }
            });
        });
    </script>

    <!-- Modal para detalhes de Auth -->
    <div class="modal fade" id="authDetailsModal" tabindex="-1" aria-labelledby="authDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="authDetailsModalLabel">Detalhes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex gap-3 align-items-center mb-4 pb-3 border-bottom">
                        <img id="auth_avatar" src="{{ asset('assets/img/default-avatar.png') }}" alt="avatar" class="rounded-circle shadow-sm" width="64" height="64">
                        <div class="flex-grow-1">
                            <h5 class="mb-1" id="auth_user">-</h5>
                            <div><small id="auth_role" class="text-muted"><i class="fas fa-user-tag me-1"></i>-</small></div>
                        </div>
                        <div>
                            <span id="auth_badge_action" class="badge bg-primary rounded-pill px-3 py-2 me-1">-</span>
                            <span id="auth_badge_status" class="badge bg-success rounded-pill px-3 py-2">-</span>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-12">
                            <div class="card border-0 bg-light">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <strong><i class="fas fa-network-wired me-2 text-primary"></i>Endereço IP:</strong>
                                        <button class="btn btn-sm btn-outline-primary" id="copy_ip" title="Copiar IP">
                                            <i class="fas fa-copy me-1"></i>Copiar
                                        </button>
                                    </div>
                                    <code id="auth_ip" class="d-block p-2 bg-white rounded">-</code>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12" id="auth_browser_device_wrapper">
                            <div class="card border-0 bg-light">
                                <div class="card-body">
                                    <strong><i class="fas fa-desktop me-2 text-info"></i>Navegador/Dispositivo:</strong>
                                    <div id="auth_browser_device" class="mt-2 text-muted">-</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="d-flex align-items-center text-muted">
                                <i class="fas fa-clock me-2"></i>
                                <small><strong>Data/Hora:</strong> <span id="auth_date">-</span></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

@endsection
