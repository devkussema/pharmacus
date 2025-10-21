<div class="header">
    <div class="header-left">
        <a href="{{ route('cp.admin.index') }}" class="logo">
            <img src="{{ assetr('assets/img/white__logo2.png') }}" width="35" height="35" alt> <span>Pharmatina</span>
        </a>
    </div>
    <a id="toggle_btn" href="javascript:void(0);">
        <img src="{{ assetr('assets/img/icons/bar-icon.svg') }}" alt></a>
    <a id="mobile_btn" class="mobile_btn float-start" href="#sidebar">
        <img src="{{ assetr('assets/img/icons/bar-icon.svg') }}" alt></a>
    {{-- <div class="top-nav-search mob-view">
        <form>
            <input type="text" class="form-control" placeholder="Search here">
            <a class="btn"><img src="assets/img/icons/search-normal.svg" alt></a>
        </form>
    </div> --}}
    <ul class="nav user-menu float-end">
        <li class="nav-item dropdown d-none d-md-block">
                    <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><img
                            src="{{ assetr('assets/img/icons/note-icon-01.svg')}}" alt><span class="pulse"></span> </a>
                </li>
        <li class="nav-item dropdown has-arrow user-profile-list">
            <a href="#" class="dropdown-toggle nav-link user-link" data-bs-toggle="dropdown">
                <div class="user-names">
                    <h5>{{ Auth::user()->nome }}</h5>
                    <span>Super Admin</span>
                </div>
                {{-- <span class="user-img">
                    <img src="{{ assetr('assets/img/user-06.jpg') }}" alt="Admin">
                </span> --}}
            </a>
            <div class="dropdown-menu">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <label class="dropdown-item" for="logout-btn" style="cursor: pointer">Sair</label>
                    <input type="submit" name="logout" id="logout-btn" hidden>
                </form>
            </div>
        </li>
        {{-- <li class="nav-item ">
            <a href="settings.html" class="hasnotifications nav-link"><img src="assets/img/icons/setting-icon-01.svg"
                    alt> </a>
        </li> --}}
    </ul>
    <div class="dropdown mobile-user-menu float-end">
        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i
                class="fa-solid fa-ellipsis-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="{{ route('logout') }}">Sair</a>
        </div>
    </div>
</div>
