<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">Inicio</li>
                <li>
                    <a href="{{ route('home') }}" class="{{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
                        <span class="menu-side">
                            <img src="{{ assetr('assets/img/icons/menu-icon-01.svg')}}" alt>
                        </span>
                        <span> Dashboard </span>
                    </a>
                </li>
                @if (isAdministrator())
                    <li>
                        <a href="{{ route('farmacia') }}" class="{{ Route::currentRouteName() == 'farmacia' ? 'active' : '' }}">
                            <span class="menu-side">
                                <img src="{{ assetr('assets/img/icons/menu-icon-06.svg')}}" alt>
                            </span>
                            <span> Farmácias </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('usuario') }}" class="{{ Route::currentRouteName() == 'usuario' ? 'active' : '' }}">
                            <span class="menu-side">
                                <img src="{{ assetr('assets/img/icons/menu-icon-06.svg')}}" alt>
                            </span>
                            <span> Farmácias </span>
                        </a>
                    </li>
                @endif
                @if (@Auth::user()->isFarmacia or vPerm('area_hospitalar', ['ver']))
                    <li>
                        <a href="{{ route('a_h.index') }}" class="{{ Route::currentRouteName() == 'a_h.index' ? 'active' : '' }}">
                            <span class="menu-side">
                                <img src="{{ assetr('assets/img/icons/menu-icon-06.svg')}}" alt>
                            </span>
                            <span> Áreas Hospitalares </span>
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{ route('stock.dashboard') }}" class="{{ Route::currentRouteName() == 'stock.dashboard' ? 'active' : '' }}">
                            <span class="menu-side">
                                <img src="{{ assetr('assets/img/icons/menu-icon-06.svg')}}" alt>
                            </span> 
                            <span>Estoque </span>
                        </a>
                    </li> --}}
                @endif
                @if (Auth::user()->area_hospitalar || Auth::user()->isFarmacia)
                    <li>
                        <a href="{{ route('atividade.show') }}" class="{{ Route::currentRouteName() == 'atividade.show' ? 'active' : '' }}">
                            <i class="fa fa-edit"></i>
                            <span> Atividades </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('grupos_farmacologicos.index') }}" class="{{ Route::currentRouteName() == 'grupos_farmacologicos.index' ? 'active' : '' }}">
                            <i class="fa fa-table"></i>
                            <span> G. Fármacos </span>
                        </a>
                    </li>
                @endif
                <li>
                    <a href="{{ route('prateleira.show') }}" class="{{ Route::currentRouteName() == 'prateleira.show' ? 'active' : '' }}">
                        <i class="fa fa-table"></i>
                        <span> Prateleiras </span>
                    </a>
                </li>
{{--                <li>--}}
{{--                    <a href="{{ route('alert.show') }}" class="{{ Route::currentRouteName() == 'alert.show' ? 'active' : '' }}">--}}
{{--                        <i class="fa fa-bullhorn"></i>--}}
{{--                        <span> Alertas </span>--}}
{{--                    </a>--}}
{{--                </li>--}}
                @if (vPerm('relatorio', ['ver']) or Auth::user()->isFarmacia)
                <li class="submenu">
                    <a href="#">
                        <span class="menu-side">
                            <img src="{{ assetr('assets/img/icons/menu-icon-15.svg') }}" alt>
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
                    </ul>
                </li>
                @endif
            </ul>
            {{-- <div class="logout-btn">
                <a href="{{ route('logout') }}">
                    <span class="menu-side">
                        <img src="{{ assetr('assets/img/icons/logout.svg')}}" alt>
                    </span>
                    <span>Sair</span>
                </a>
            </div> --}}
        </div>
    </div>
</div>
