@extends('layout.app')

@section('titulo', 'Página Inicial')

@push('styles')
    <style>
        .system-updating-card {
            position: relative;
            overflow: hidden;
            border: 0;
            border-radius: 14px;
            background: linear-gradient(135deg, rgba(46, 55, 164, 0.12) 0%, rgba(46, 55, 164, 0.06) 100%);
            backdrop-filter: saturate(1.05) blur(6px);
            box-shadow: 0 12px 34px rgba(17,24,39,0.08);
        }

        .system-updating-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                90deg,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.55) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: translateX(-120%);
            animation: su_shimmer 2.2s ease-in-out infinite;
            pointer-events: none;
        }

        .system-updating-inner {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px 18px;
        }

        .system-updating-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: grid;
            place-items: center;
            background: rgba(46, 55, 164, 0.10);
            flex: 0 0 auto;
            position: relative;
        }

        .system-updating-spinner {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            border: 3px solid rgba(46, 55, 164, 0.20);
            border-top-color: rgba(46, 55, 164, 0.95);
            animation: su_spin 0.9s linear infinite;
        }

        .system-updating-title {
            margin: 0;
            font-weight: 700;
            color: #2E37A4;
            font-size: 15px;
            line-height: 1.25;
        }

        .system-updating-text {
            margin: 0;
            opacity: 0.95;
            font-size: 13px;
            line-height: 1.3;
        }

        .system-updating-dots {
            display: inline-flex;
            gap: 6px;
            margin-left: 6px;
            vertical-align: middle;
        }

        .system-updating-dots span {
            width: 6px;
            height: 6px;
            border-radius: 999px;
            background: rgba(46, 55, 164, 0.75);
            animation: su_bounce 1.2s ease-in-out infinite;
        }

        .system-updating-dots span:nth-child(2) {
            animation-delay: 0.15s;
        }

        .system-updating-dots span:nth-child(3) {
            animation-delay: 0.30s;
        }

        @keyframes su_spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes su_shimmer {
            0% { transform: translateX(-120%); }
            100% { transform: translateX(120%); }
        }

        @keyframes su_bounce {
            0%, 80%, 100% { transform: translateY(0); opacity: 0.65; }
            40% { transform: translateY(-4px); opacity: 1; }
        }

        @media (prefers-reduced-motion: reduce) {
            .system-updating-card::before,
            .system-updating-spinner,
            .system-updating-dots span {
                animation: none !important;
            }
        }

        /* ==========================
           Modernização do Dashboard
           (escopo desta página)
           ========================== */
        .dashboard-modern { --brand:#2E37A4; --radius:16px; }

        .dashboard-modern .good-morning-blk { border-radius: var(--radius); overflow: hidden; position: relative; }
        .dashboard-modern .good-morning-blk::before { content:''; position:absolute; inset:0; background:
            radial-gradient(1200px 220px at 85% -40%, rgba(46,55,164,0.12), rgba(46,55,164,0))
        ; pointer-events:none; }

        .dashboard-modern .card,
        .dashboard-modern .dash-widget { border-radius: var(--radius); box-shadow: 0 6px 22px rgba(17,24,39,0.08); transition: transform .24s ease, box-shadow .24s ease; }
        .dashboard-modern .card:hover,
        .dashboard-modern .dash-widget:hover { transform: translateY(-2px); box-shadow: 0 16px 38px rgba(17,24,39,0.12); }

        .dashboard-modern .dash-boxs { position: relative; overflow: hidden; }
        .dashboard-modern .dash-boxs::after { content:''; position:absolute; inset:-2px; background: radial-gradient(160px 80px at 20% 20%, rgba(46,55,164,.18), transparent 60%); pointer-events:none; }
        .dashboard-modern .dash-boxs::before { content:''; position:absolute; width:42px; height:42px; border-radius:50%;
            top:50%; left:50%; transform: translate(-50%, -50%);
            background: conic-gradient(from 0deg, var(--brand) 0deg, rgba(46,55,164,0) 120deg);
            animation: kpiSpin 1.8s linear infinite; opacity:.8; filter: drop-shadow(0 2px 6px rgba(46,55,164,0.2));
        }
        .dashboard-modern .dash-boxs img { position:relative; z-index:1; transform: translateZ(0); transition: transform .3s ease; }
        .dashboard-modern .dash-widget:hover .dash-boxs img { transform: scale(1.06); }

        @keyframes kpiSpin { from { transform: translate(-50%, -50%) rotate(0deg); } to { transform: translate(-50%, -50%) rotate(360deg); } }

        /* Animação de entrada */
        .dashboard-modern .reveal { opacity: 0; transform: translateY(10px); }
        .dashboard-modern .reveal.in { opacity: 1; transform: translateY(0); transition: all .48s cubic-bezier(.22,1,.36,1); }

        /* Tabelas com realce */
        .dashboard-modern .table tbody tr { transition: background-color .18s ease; }
        .dashboard-modern .table tbody tr:hover { background-color: rgba(46,55,164,0.04); }

        /* Link com sublinhado animado */
        .dashboard-modern a.patient-views { position: relative; }
        .dashboard-modern a.patient-views::after { content:''; position:absolute; left:0; bottom:-2px; height:2px; width:0; background: var(--brand); transition: width .22s ease; border-radius:2px; }
        .dashboard-modern a.patient-views:hover::after { width:100%; }

        /* Texto do KPI com leve gradiente */
        .dashboard-modern .dash-count h2 span {
            background: linear-gradient(90deg, #2E37A4 0%, #6D75E0 60%, #2E37A4 100%);
            -webkit-background-clip: text; background-clip: text; color: transparent;
        }

        @media (prefers-reduced-motion: reduce) {
            .dashboard-modern .reveal { opacity:1; transform:none; }
            .dashboard-modern .card, .dashboard-modern .dash-widget { transition: none !important; }
        }
    </style>
@endpush

@section('content')
    <div class="content dashboard-modern">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard </a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active" onclick="playAudio()">Página Inicial</li>
                    </ul>
                </div>
            </div>
        </div>

        @include('partials.session')

        <div class="good-morning-blk">
            <div class="row">
                <div class="col-md-6">
                    <div class="morning-user">
                        <h2>Olá <span>Dr(a){{ printNome(Auth::user()->nome) }}</span>, {{ saudacaoDoDia() }}</h2>
                        <p>Tenha um bom dia no trabalho</p>
                    </div>
                </div>
                <div class="col-md-6 position-blk">
                    <div class="morning-img">
                        <img src="{{ asset('prepharma/img/morning-img-01.png')}}" alt>
                    </div>
                </div>
            </div>
        </div>
        <div class="row reveal">
            @php
                use App\Models\RelatorioEstoqueAlerta as REA;
                $id_niv = [];
            @endphp
            @php
                $ordem = ['Crítico', 'Mínimo', 'Médio', 'Máximo'];

                $dadosOrdenados = REA::all()->sortBy(function ($item) use ($ordem) {
                    return array_search($item->nivel_alerta->nome, $ordem);
                });

                $id_niv = []; // Para evitar duplicação
            @endphp

            @foreach ($dadosOrdenados as $n)
                @if (!in_array($n->nivel_alerta->id, $id_niv))
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <div class="dash-boxs comman-flex-center">
                                <img src="{{ asset('prepharma/img/white__logo2.png') }}" width="24" height="24" alt>
                            </div>
                            <div class="dash-content dash-count">
                                <h4>{{ $n->nivel_alerta->nome }}</h4>
                                <h2><span class="counter-up">
                                    @if (Str::lower($n->nivel_alerta->nome) == 'crítico' || Str::lower($n->nivel_alerta->nome) == 'mínimo' || Str::lower($n->nivel_alerta->nome) == 'minimo' || Str::lower($n->nivel_alerta->nome) == 'critico')
                                        0
                                    @else
                                        {{ $n->nivel_alerta->relatorios->count() }}
                                    @endif
                                </span></h2>
                                @if ($n->nivel_alerta->regra == '3') até 3 meses @endif
                                @if ($n->nivel_alerta->regra == '6') até 6 meses @endif
                                @if ($n->nivel_alerta->regra == '10') até 10 meses @endif
                                @if ($n->nivel_alerta->regra == '12') até 12 meses @endif
                            </div>
                        </div>
                    </div>
                    @php $id_niv[] = $n->nivel_alerta->id; @endphp
                @endif
            @endforeach
        </div>

        {{-- <div class="row">
            <div class="col-12 col-md-12 col-lg-6 col-xl-9">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-title patient-visit">
                            <h4>Patient Visit by Gender</h4>
                            <div>
                                <ul class="nav chat-user-total">
                                    <li><i class="fa fa-circle current-users" aria-hidden="true"></i>Male 75%
                                    </li>
                                    <li><i class="fa fa-circle old-users" aria-hidden="true"></i> Female 25%
                                    </li>
                                </ul>
                            </div>
                            <div class="input-block mb-0">
                                <select class="form-control select">
                                    <option>2022</option>
                                    <option>2021</option>
                                    <option>2020</option>
                                    <option>2019</option>
                                </select>
                            </div>
                        </div>
                        <div id="patient-chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-6 col-xl-3 d-flex">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-title">
                            <h4>Patient by Department</h4>
                        </div>
                        <div id="donut-chart-dash" class="chart-user-icon">
                            <img src="{{ asset('prepharma/img/icons/user-icon.svg')}}" alt>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row reveal">
            <div class="col-12 col-md-12  col-xl-4">
                <div class="card top-departments">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Principais Departamentos</h4>
                    </div>
                    <div class="card-body">
                        @foreach (\App\Models\FarmaciaAreaHospitalar::all() as $fah)
                            <div class="activity-top">
                                <div class="activity-boxs comman-flex-center">
                                    <img src="{{ asset('prepharma/img/icons/dep-icon-01.svg')}}" alt>
                                </div>
                                <div class="departments-list">
                                    <h4>
                                        <a href="{{ route('estoque.getEstoque', ['id' => $fah->area_hospitalar->id]) }}">
                                            {{ $fah->area_hospitalar->nome }}
                                        </a>
                                    </h4>
                                    {{-- <p>35%</p> --}}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12  col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title d-inline-block">Atividades</h4> <a href="{{ route('atividade.show') }}"
                            class="patient-views float-end">Mostrar todas</a>
                    </div>
                    <div class="card-body p-0 table-dash">
                        <div class="table-responsive">
                            <table class="table mb-0 border-0 datatable custom-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>Usuário</th>
                                        <th>Texto</th>
                                        <th>Tempo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\Atividade::orderBy('created_at', 'desc')->take(6)->get() as $at)
                                        <tr>
                                            <td>
                                                <div class="form-check check-tables">
                                                    <input class="form-check-input" type="checkbox" value="something">
                                                </div>
                                            </td>
                                            <td class="table-image appoint-doctor">
                                                {{-- <img width="28" height="28" class="rounded-circle"
                                                    src="{{ asset('prepharma/img/profiles/avatar-02.jpg')}}" alt> --}}
                                                <h2>{{ @$at->user->nome }}</h2>
                                            </td>
                                            <td>{{ $at->texto }}</td>
                                            <td class="appoint-time">
                                                {{ statusOnline($at->created_at) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row reveal">
            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title d-inline-block">Acessos recentes </h4> <a href="#"
                            class="float-end patient-views">Mostrar todos</a>
                    </div>
                    <div class="card-block table-dash">
                        <div class="table-responsive">
                            <table class="table mb-0 border-0 datatable custom-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Online</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\User::orderBy('online', 'desc')->take(5)->get() as $usr)
                                        <tr>
                                            <td>
                                                <div class="form-check check-tables">
                                                    <input class="form-check-input" type="checkbox" value="something">
                                                </div>
                                            </td>
                                            <td class="table-image">
                                                {{-- <img width="28" height="28" class="rounded-circle"
                                                    src="{{ asset('prepharma/img/profiles/avatar-02.jpg')}}" alt> --}}
                                                <h2>{{ $usr->nome }}</h2>
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $usr->email }}">
                                                    {{ $usr->email }}
                                                </a>
                                            </td>
                                            <td>
                                                @php
                                                    $isOnline = $usr->online === 1 || $usr->online === '1' || $usr->online === true;
                                                    $lastSeen = $usr->ultimo_acesso ?? $usr->last_seen ?? $usr->last_login_at ?? $usr->updated_at ?? null;
                                                @endphp

                                                @if ($isOnline)
                                                    <span class="text-success"><i class="fa fa-circle me-1" aria-hidden="true"></i> Online</span>
                                                @else
                                                    @if ($lastSeen)
                                                        @php
                                                            $last = \Carbon\Carbon::parse($lastSeen);
                                                            $oneWeekAgo = \Carbon\Carbon::now()->subWeek();
                                                        @endphp

                                                        @if ($last->greaterThanOrEqualTo($oneWeekAgo))
                                                            <span class="text-success"><i class="fa fa-clock me-1" aria-hidden="true"></i> {{ statusOnline($lastSeen) }}</span>
                                                        @else
                                                            <span class="text-muted"><i class="fa fa-circle me-1" aria-hidden="true"></i> Offline</span>
                                                        @endif
                                                    @else
                                                        <span class="text-muted"><i class="fa fa-circle me-1" aria-hidden="true"></i> Offline</span>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    (function() {
        const root = document.querySelector('.dashboard-modern');
        if (!root) return;
        const revealBlocks = root.querySelectorAll('.reveal');
        revealBlocks.forEach(b => b.classList.remove('in'));

        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.classList.add('in');
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.08 });
        revealBlocks.forEach(b => io.observe(b));

        // Contadores
        const $ = window.jQuery;
        if ($ && typeof $.fn.counterUp === 'function') {
            $('.counter-up').counterUp({ delay: 18, time: 520 });
        } else {
            document.querySelectorAll('.counter-up').forEach(function(el){
                const end = parseInt(el.textContent || '0', 10) || 0;
                let cur = 0; const steps = 24; const inc = Math.max(1, Math.ceil(end/steps));
                const tick = () => { cur = Math.min(end, cur + inc); el.textContent = cur.toString(); if (cur < end) requestAnimationFrame(tick); };
                requestAnimationFrame(tick);
            });
        }
    })();
</script>
@endpush
