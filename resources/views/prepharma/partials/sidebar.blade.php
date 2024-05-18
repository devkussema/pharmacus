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
            </ul>
            <div class="logout-btn">
                <a href="login.html">
                    <span class="menu-side">
                        <img src="{{ assetr('assets/img/icons/logout.svg')}}" alt>
                    </span>
                    <span>Logout</span>
                </a>
            </div>
        </div>
    </div>
</div>
