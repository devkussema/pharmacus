<div class="header">
    <div class="header-left" style="display:flex;align-items:center;gap:.75rem;">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('prepharma/img/white__logo2.png')}}" width="35" height="35" alt> <span>Pharmatina</span>
        </a>
    </div>
    <a id="toggle_btn" href="javascript:void(0);"><img src="{{ asset('prepharma/img/icons/bar-icon.svg')}}" alt></a>
    <a id="mobile_btn" class="mobile_btn float-start" href="#sidebar"><img src="{{ asset('prepharma/img/icons/bar-icon.svg')}}" alt></a>
    <div class="top-nav-search mob-view">
        {{-- <form>
            <input type="text" class="form-control" placeholder="Procurar aqui...">
            <a class="btn"><img src="{{ asset('prepharma/img/icons/search-normal.svg')}}" alt></a>
        </form> --}}
    </div>
    <ul class="nav user-menu float-end">
        {{-- <li class="nav-item dropdown d-none d-md-block">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <img src="{{ asset('prepharma/img/icons/note-icon-02.svg')}}" alt>
                <span class="pulse"></span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span>Notificações</span>
                </div>
                <div class="drop-scroll">
                    <ul class="notification-list">
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media">
                                    <span class="avatar">
                                        <img alt="John Doe" src="{{ asset('prepharma/img/user.jpg')}}" class="img-fluid">
                                    </span>
                                    <div class="media-body">
                                        <p class="noti-details"><span class="noti-title">John Doe</span> added
                                            new task <span class="noti-title">Patient appointment booking</span>
                                        </p>
                                        <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media">
                                    <span class="avatar">V</span>
                                    <div class="media-body">
                                        <p class="noti-details"><span class="noti-title">Tarah Shropshire</span>
                                            changed the task name <span class="noti-title">Appointment booking
                                                with payment gateway</span></p>
                                        <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media">
                                    <span class="avatar">L</span>
                                    <div class="media-body">
                                        <p class="noti-details"><span class="noti-title">Misty Tison</span>
                                            added <span class="noti-title">Domenic Houston</span> and <span
                                                class="noti-title">Claire Mapes</span> to project <span
                                                class="noti-title">Doctor available module</span></p>
                                        <p class="noti-time"><span class="notification-time">8 mins ago</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media">
                                    <span class="avatar">G</span>
                                    <div class="media-body">
                                        <p class="noti-details"><span class="noti-title">Rolland Webber</span>
                                            completed task <span class="noti-title">Patient and Doctor video
                                                conferencing</span></p>
                                        <p class="noti-time"><span class="notification-time">12 mins ago</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="media">
                                    <span class="avatar">V</span>
                                    <div class="media-body">
                                        <p class="noti-details"><span class="noti-title">Bernardo Galaviz</span>
                                            added new task <span class="noti-title">Private chat module</span>
                                        </p>
                                        <p class="noti-time"><span class="notification-time">2 days ago</span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="activities.html">Ver todas Notificações</a>
                </div>
            </div>
        </li> --}}
        {{-- <li class="nav-item dropdown d-none d-md-block">
            <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><img
                    src="{{ asset('prepharma/img/icons/note-icon-01.svg')}}" alt><span class="pulse"></span> </a>
        </li> --}}
        <li class="nav-item dropdown has-arrow user-profile-list">
            <a href="javascript:void(0)" class="dropdown-toggle nav-link user-link" data-bs-toggle="dropdown">
                <div class="user-names" style="display:flex;align-items:center;gap:.5rem;">
                    <h5 style="margin:0;">{{ Auth::user()->nome }}</h5>
                    <span>Admin</span>
                </div>
                <span class="user-img">
                    <img src="{{ asset('prepharma/img/user.jpg')}}" alt="Admin">
                </span>
            </a>
            <div class="dropdown-menu">
                {{-- <a class="dropdown-item" href="{{ route('u.perfil', ['username' => Auth::user()->username]) }}">Meu Perfil</a> --}}
                {{-- <a class="dropdown-item" href="javascript:void(0)">Editar Perfil</a> --}}
                {{-- <a class="dropdown-item" href="javascript:void(0)">Definições</a> --}}
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <label class="dropdown-item" for="logout-btn" style="cursor: pointer">Sair</label>
                    <input type="submit" name="logout" id="logout-btn" hidden>
                </form>
            </div>
        </li>
        {{-- <li class="nav-item ">
            <a href="settings.html" class="hasnotifications nav-link">
                <img src="{{ asset('prepharma/img/icons/setting-icon-01.svg')}}" alt>
            </a>
        </li> --}}
    </ul>
    <div class="dropdown mobile-user-menu float-end">
        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i
                class="fa-solid fa-ellipsis-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-end">
            <a class="dropdown-item" href="{{ route('u.perfil', ['username' => Auth::user()->username]) }}">Meu Perfil</a>
            <a class="dropdown-item" href="{{ route('logout') }}">Sair</a>
        </div>
    </div>
</div>

@push('scripts')
<script>
    (function () {
        const STORAGE_KEY = 'pharmatina_fullscreen';
        const btn = document.getElementById('btn_fullscreen');
        const icon = document.getElementById('fullscreen_icon');

        function isFullScreen() {
            return !!(document.fullscreenElement || document.webkitFullscreenElement || document.mozFullScreenElement || document.msFullscreenElement);
        }

        function updateIcon() {
            if (isFullScreen()) {
                icon.classList.remove('fa-expand');
                icon.classList.add('fa-compress');
            } else {
                icon.classList.remove('fa-compress');
                icon.classList.add('fa-expand');
            }
        }

        function enterFullScreen() {
            const el = document.documentElement;
            if (el.requestFullscreen) return el.requestFullscreen();
            if (el.webkitRequestFullscreen) return el.webkitRequestFullscreen();
            if (el.mozRequestFullScreen) return el.mozRequestFullScreen();
            if (el.msRequestFullscreen) return el.msRequestFullscreen();
            return Promise.resolve();
        }

        function exitFullScreen() {
            if (document.exitFullscreen) return document.exitFullscreen();
            if (document.webkitExitFullscreen) return document.webkitExitFullscreen();
            if (document.mozCancelFullScreen) return document.mozCancelFullScreen();
            if (document.msExitFullscreen) return document.msExitFullscreen();
            return Promise.resolve();
        }

        function toggleFullScreen() {
            if (isFullScreen()) {
                exitFullScreen();
                localStorage.setItem(STORAGE_KEY, '0');
            } else {
                enterFullScreen();
                localStorage.setItem(STORAGE_KEY, '1');
            }
        }

        // Restaura estado ao carregar
        document.addEventListener('DOMContentLoaded', function () {
            try {
                const pref = localStorage.getItem(STORAGE_KEY);
                if (pref === '1' && !isFullScreen()) {
                    enterFullScreen().catch(() => {});
                }
                updateIcon();
            } catch (e) {
                // localStorage pode falhar em contexts restritos
            }
        });

        // Atualiza ícone quando o estado de fullscreen mudar
        ['fullscreenchange','webkitfullscreenchange','mozfullscreenchange','MSFullscreenChange'].forEach(evt => {
            document.addEventListener(evt, updateIcon);
        });

        if (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                toggleFullScreen();
            });
        }
    })();
</script>
@endpush
