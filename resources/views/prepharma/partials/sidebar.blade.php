<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span data-key="t-menu">Menu</span>
                </li>
                <li class="{{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="sidebar-link" data-route="home">
                        <span class="menu-side">
                            <i class="fas fa-tachometer-alt"></i>
                        </span>
                        <span> Dashboard </span>
                    </a>
                </li>

                {{-- Farmácias e Usuários são administração global (Admin only) --}}
                @if (isAdministrator())
                    <li class="{{ Route::currentRouteName() == 'farmacia' ? 'active' : '' }}">
                        <a href="{{ route('farmacia') }}" class="sidebar-link" data-route="farmacia">
                            <span class="menu-side">
                                <i class="fas fa-clinic-medical"></i>
                            </span>
                            <span> Farmácias </span>
                            <span class="badge badge-pill badge-info ms-auto">{{ App\Models\Farmacia::count() }}</span>
                        </a>
                    </li>
                    <li class="{{ Route::currentRouteName() == 'usuario' ? 'active' : '' }}">
                        <a href="{{ route('usuario') }}" class="sidebar-link" data-route="usuario">
                            <span class="menu-side">
                                <i class="fas fa-users"></i>
                            </span>
                            <span> Usuários </span>
                        </a>
                    </li>
                @endif

                {{-- Funcionários: administradores, gerentes ou quem tem permissão explícita --}}
                @if (Auth::check() && (Auth::user()->hasAnyRole(['Admin','Gerente']) || vPerm('funcionario', ['ver'])))
                    <li class="{{ Route::currentRouteName() == 'gerente.funcionarios.index' ? 'active' : '' }}">
                        <a href="{{ route('gerente.funcionarios.index') }}" class="sidebar-link" data-route="gerente.funcionarios.index">
                            <span class="menu-side">
                                <i class="fas fa-users"></i>
                            </span>
                            <span> Funcionários </span>
                        </a>
                    </li>
                @endif

                {{-- Áreas Hospitalares: gerentes/admins ou permissão específica --}}
                @if (Auth::check() && (Auth::user()->hasAnyRole(['Admin','Gerente']) || vPerm('areas_hospitalares', ['ver'])))
                    <li>
                        <a href="{{ route('a_h.index') }}" class="{{ Route::currentRouteName() == 'a_h.index' ? 'active' : '' }}">
                            <span class="menu-side">
                                <img src="{{ asset('prepharma/img/icons/menu-icon-06.svg')}}" alt>
                            </span>
                            <span> Áreas Hospitalares </span>
                        </a>
                    </li>
                @endif

                @if (Auth::user()->area_hospitalar || Auth::user()->isFarmacia)
                    <li>
                        <a href="{{ route('atividade.show') }}" class="{{ Route::currentRouteName() == 'atividade.show' ? 'active' : '' }}">
                            <i class="fa fa-edit"></i>
                            <span> Atividades </span>
                        </a>
                    </li>
                    @if (Auth::user()->username == 'adriano.lata' or Auth::user()->username == 'augusto.kussema')
                        <li>
                            <a href="{{ route('documents.index') }}" class="{{ Route::currentRouteName() == 'documents.index' ? 'active' : '' }}">
                                <i class="fa fa-table"></i>
                                <span> Documentos </span>
                            </a>
                        </li>
                    @endif
                @endif
                <li>
                    <a href="{{ route('prateleira.show') }}" class="{{ Route::currentRouteName() == 'prateleira.show' ? 'active' : '' }}">
                        <i class="fa fa-table"></i>
                        <span> Prateleiras </span>
                    </a>
                </li>
                @if (vPerm('relatorio', ['ver']) or Auth::user()->isFarmacia)
                <li class="submenu">
                    <a href="#">
                        <span class="menu-side">
                            <img src="{{ asset('prepharma/img/icons/menu-icon-15.svg') }}" alt>
                        </span>
                        <span>Relatorios </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul style="display: none;">
                        <li>
                            <a href="{{ route('nivel_alerta') }}"> Niveis de alerta </a>
                        </li>
                        <li>
                            <a href="{{ route('gerar_relatorio') }}"> Gerar Relatório </a>
                        </li>
                        <li>
                            <a href="{{ route('estoque._minimo', ['id' => 6]) }}"> Status Estoque </a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>
</div>
