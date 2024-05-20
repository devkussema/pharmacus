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
                <li>
                    <a href="{{ route('a_h.index') }}" class="{{ Route::currentRouteName() == 'a_h.index' ? 'active' : '' }}">
                        <span class="menu-side">
                            <img src="{{ assetr('assets/img/icons/menu-icon-06.svg')}}" alt>
                        </span>
                        <span> Áreas Hospitalares </span>
                    </a>
                </li>
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
            </ul>
            <div class="logout-btn">
                <a href="{{ route('logout') }}">
                    <span class="menu-side">
                        <img src="{{ assetr('assets/img/icons/logout.svg')}}" alt>
                    </span>
                    <span>Sair</span>
                </a>
            </div>
        </div>
    </div>
</div>
