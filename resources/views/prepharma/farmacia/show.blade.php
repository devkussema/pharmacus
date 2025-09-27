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

        @php
            use App\Models\Estoque;
            use App\Models\ProdutoEstoque;
            use App\Models\SaldoEstoque;
            use Carbon\Carbon;

            $farm_id = $farmacia->id;
            $areas_count = $farmacia->areas_hospitalares ? $farmacia->areas_hospitalares->count() : 0;

            $total_produtos = ProdutoEstoque::whereHas('estoque', function ($q) use ($farm_id) {
                $q->where('farmacia_id', $farm_id);
            })->count();

            $expirando_30 = ProdutoEstoque::whereHas('estoque', function ($q) use ($farm_id) {
                $q->where('farmacia_id', $farm_id);
            })->whereNotNull('data_expiracao')
                ->whereDate('data_expiracao', '<=', Carbon::now()->addDays(30))
                ->count();

            $baixo_stock = SaldoEstoque::whereHas('produtos.estoque', function ($q) use ($farm_id) {
                $q->where('farmacia_id', $farm_id);
            })->where('qtd', '<=', 5)->count();

            $status_text = isset($farmacia->status) && $farmacia->status == 1 ? 'Ativa' : 'Inativa';
            $gerente_nome = optional(optional($farmacia->gerente)->user)->nome ?? '-';
            $gerente_email = optional(optional($farmacia->gerente)->user)->email ?? '-';
            $created = $farmacia->created_at ? formatarData($farmacia->created_at) : '-';
        @endphp

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="about-info">
                                    <h4>Perfil da Farmácia <span><a href="javascript:;"><i
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
                                                    <h5>Áreas</h5>
                                                    <h4>{{ $areas_count }}</h4>
                                                </div>
                                                <div class="doctor-follows">
                                                    <h5>Produtos</h5>
                                                    <h4>{{ $total_produtos }}</h4>
                                                </div>
                                                <div class="doctor-follows">
                                                    <h5>Expiram (30d)</h5>
                                                    <h4>{{ $expirando_30 }}</h4>
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

                                        @php
                                            $farm_id = $farmacia->id;

                                            // Total de produtos distintos em estoque para esta farmácia
                                            $total_distintos = Estoque::where('farmacia_id', $farm_id)
                                                ->distinct('produto_estoque_id')->count('produto_estoque_id');

                                            // Total de registros de produtos ligados à farmácia
                                            $total_produtos = ProdutoEstoque::whereHas('estoque', function ($q) use ($farm_id) {
                                                $q->where('farmacia_id', $farm_id);
                                            })->count();

                                            // Produtos com data de expiração nos próximos 30 dias
                                            $expirando_30 = ProdutoEstoque::whereHas('estoque', function ($q) use ($farm_id) {
                                                $q->where('farmacia_id', $farm_id);
                                            })->whereNotNull('data_expiracao')
                                                ->whereDate('data_expiracao', '<=', Carbon::now()->addDays(30))
                                                ->count();

                                            // Itens com baixo stock (saldo <= 5)
                                            $baixo_stock = SaldoEstoque::whereHas('produtos.estoque', function ($q) use ($farm_id) {
                                                $q->where('farmacia_id', $farm_id);
                                            })->where('qtd', '<=', 5)->count();

                                            // Top 3 produtos que mais rapidamente expiram
                                            $top_expiring = ProdutoEstoque::whereHas('estoque', function ($q) use ($farm_id) {
                                                $q->where('farmacia_id', $farm_id);
                                            })->whereNotNull('data_expiracao')
                                                ->orderBy('data_expiracao', 'asc')
                                                ->take(3)->get();
                                        @endphp

                                        <div class="about-me-list">
                                            <ul class="list-space">
                                                <li>
                                                    <h4>Produtos distintos em estoque</h4>
                                                    <span>{{ $total_distintos }}</span>
                                                </li>
                                                <li>
                                                    <h4>Registros de produtos</h4>
                                                    <span>{{ $total_produtos }}</span>
                                                </li>
                                                <li>
                                                    <h4>Expiram nos próximos 30 dias</h4>
                                                    <span>{{ $expirando_30 }}</span>
                                                </li>
                                                <li>
                                                    <h4>Itens com baixo stock (≤5)</h4>
                                                    <span>{{ $baixo_stock }}</span>
                                                </li>
                                                <li>
                                                    <h4>Última atualização</h4>
                                                    <span>{{ $farmacia->updated_at ? formatarData($farmacia->updated_at) : '-' }}</span>
                                                </li>
                                            </ul>
                                        </div>

                                        @if($top_expiring->count() > 0)
                                            <div class="mt-3">
                                                <h5 class="mb-2">Produtos a expirar (próximos)</h5>
                                                <ul class="list-unstyled small">
                                                    @foreach($top_expiring as $p)
                                                        <li>
                                                            <strong>{{ $p->designacao ?? $p->descricao ?? '—' }}</strong>
                                                            — <span class="text-muted">{{ $p->data_expiracao ? \Carbon\Carbon::parse($p->data_expiracao)->format('d/m/Y') : 's/ data' }}</span>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="doctor-personals-grp">
                            <div class="card">
                                <div class="card-body">
                                    <div class="heading-detail">
                                        <h4>Principais áreas</h4>
                                    </div>
                                    <div class="skill-blk">
                                        @php
                                            $areas = $farmacia->areas_hospitalares ?? collect();
                                            // extrai os nomes das áreas hospitalares relacionadas (se existir relation area_hospitalar)
                                            $nomes = $areas->map(function($item) {
                                                return optional($item->area_hospitalar)->nome;
                                            })->filter()->values();
                                        @endphp

                                        @if($nomes->count() > 0)
                                            @foreach($nomes->slice(0,5) as $nome)
                                                <div class="skill-statistics">
                                                    <div class="skills-head">
                                                        <h5>{{ $nome }}</h5>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-muted">Nenhuma área registada para esta farmácia.</p>
                                        @endif
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
                                        <p>{{ $farmacia->descricao ?? 'Descrição não informada.' }}</p>

                                        <p class="mt-3 small text-muted">
                                            Código: <strong>{{ $farmacia->codigo ?? '-' }}</strong>
                                            &nbsp;•&nbsp; Status: <strong>{{ $status_text }}</strong>
                                            &nbsp;•&nbsp; Registada: <strong>{{ $created }}</strong>
                                        </p>

                                        <p class="small text-muted">
                                            Gerente: <strong>{{ $gerente_nome }}</strong>
                                            &nbsp;•&nbsp; {{ $gerente_email }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title ">Atividades dos usuários</h4>
                                </div>
                                <div class="card-body p-0 table-dash">
                                    <div class="card-body">
                                        <div class="activity">
                                            <div class="activity-box">
                                                <ul class="activity-list" id="activityList">
                                                    @php
                                                        // IDs de utilizadores ligados à farmácia (gerentes + user_area_hospitalar)
                                                        $gerentes = \App\Models\GerenteFarmacia::where('farmacia_id', $farm_id)->pluck('user_id')->toArray();
                                                        $uahs = \App\Models\UserAreaHospitalar::where('farmacia_id', $farm_id)->pluck('user_id')->toArray();
                                                        $userIds = array_values(array_unique(array_merge($gerentes, $uahs)));

                                                        $atividades = [];
                                                        if (count($userIds) > 0) {
                                                            $atividades = \App\Models\Atividade::with('user')
                                                                ->whereIn('user_id', $userIds)
                                                                ->orderByDesc('created_at')
                                                                ->take(50)->get();
                                                        }
                                                    @endphp

                                                    @forelse($atividades as $at)
                                                        <li class="activity-item" data-user-id="{{ $at->user_id }}" data-date="{{ $at->created_at->format('Y-m-d') }}" data-text="{{ strtolower($at->texto) }}">
                                                            <div class="activity-user">
                                                                <a href="javascript:void(0)" title="Usuário: {{ $at->user->nome }}\nData: {{ formatDataAtv($at->created_at) }}\nHora: {{ formatar_horas($at->created_at) }}\nAtividade: {{ $at->texto }}" data-bs-toggle="tooltip" data-bs-html="true" class="avatar">
                                                                    <img alt="{{ $at->user->nome }}" src="{{ assetr('assets/img/white__logo2.png') }}" class="img-fluid rounded-circle">
                                                                </a>
                                                            </div>
                                                            <div class="activity-content timeline-group-blk">
                                                                <div class="timeline-group flex-shrink-0">
                                                                    <h4 class="{{ $at->created_at->isToday() ? 'text-primary' : '' }}">{{ formatDataAtv($at->created_at) }}</h4>
                                                                    <span class="time">{{ formatar_horas($at->created_at) }}</span>
                                                                </div>
                                                                <div class="comman-activitys flex-grow-1">
                                                                    <h3>{{ $at->user->nome }}</h3>
                                                                    <p><span>{{ $at->texto }}</span></p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @empty
                                                        <div class="text-center p-4 text-muted">Nenhuma atividade registada para esta farmácia.</div>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
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
