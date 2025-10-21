<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>
                <li>
                    <a href="{{ route('cp.admin.index') }}">
                        <span class="menu-side">
                            <img src="{{ assetr('assets/img/icons/menu-icon-01.svg') }}" alt>
                        </span>
                        <span> Painel </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cp.users.index') }}">
                        <span class="menu-side">
                            <img src="{{ assetr('assets/img/icons/menu-icon-08.svg') }}" alt>
                        </span>
                        <span> Usuários </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('cp.area_hospitalar.index') }}">
                        <span class="menu-side">
                            <img src="{{ assetr('assets/img/icons/menu-icon-06.svg') }}" alt>
                        </span>
                        <span> Áreas Hospitalares </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
