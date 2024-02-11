<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                <i class="ri-menu-line wrapper-menu"></i>
                <a href="{{ route('home') }}" class="header-logo">
                    <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid rounded-normal" alt="logo">
                    <h5 class="logo-title ml-3">{{ env('APP_NAME', 'Pharmacus') }}</h5>

                </a>
            </div>
            <div class="iq-search-bar device-search">
                <form action="#" class="searchbox">
                    <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                    <input type="text" class="text search-input" placeholder="Search here...">
                </form>
            </div>
            <div class="d-flex align-items-center">
                {{-- Botão modo claro/escuro --}}
                <div class="change-mode">
                    <div class="custom-control custom-switch custom-switch-icon custom-control-inline">
                        <div class="custom-switch-inner">
                            <p class="mb-0"> </p>
                            <input type="checkbox" class="custom-control-input" id="dark-mode" data-active="true">
                            <label class="custom-control-label" for="dark-mode" data-mode="toggle">
                                <span class="switch-icon-left"><i class="a-left ri-moon-clear-line"></i></span>
                                <span class="switch-icon-right"><i class="a-right ri-sun-line"></i></span>
                            </label>
                        </div>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-label="Toggle navigation">
                    <i class="ri-menu-3-line"></i>
                </button>
                {{-- terminou aqui --}}

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-list align-items-center">
                        {{-- botão idioma --}}
                        {{--  --}}
                        <li class="nav-item nav-icon dropdown">
                            <a href="#" class="search-toggle dropdown-toggle btn border add-btn"
                                id="dropdownMenuButton02" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" id="flag-icons-ao"
                                    viewBox="0 0 640 480">
                                    <g fill-rule="evenodd" stroke-width="1pt">
                                        <path fill="red" d="M0 0h640v243.6H0z" />
                                        <path fill="#000001" d="M0 236.4h640V480H0z" />
                                    </g>
                                    <path fill="#ffec00" fill-rule="evenodd"
                                        d="M228.7 148.2c165.2 43.3 59 255.6-71.3 167.2l-8.8 13.6c76.7 54.6 152.6 10.6 174-46.4 22.2-58.8-7.6-141.5-92.6-150z" />
                                    <path fill="#ffec00" fill-rule="evenodd"
                                        d="m170 330.8 21.7 10.1-10.2 21.8-21.7-10.2zm149-99.5h24v24h-24zm-11.7-38.9 22.3-8.6 8.7 22.3-22.3 8.7zm-26-29.1 17.1-16.9 16.9 17-17 16.9zm-26.2-39.8 22.4 8.4-8.5 22.4-22.4-8.4zM316 270l22.3 8.9-9 22.2-22.2-8.9zm-69.9 70 22-9.3 9.5 22-22 9.4zm-39.5 2.8h24v24h-24zm41.3-116-20.3-15-20.3 14.6 8-23-20.3-15h24.5l8.5-22.6 7.8 22.7 24.7-.3-19.6 15.3z" />
                                    <path fill="#fe0" fill-rule="evenodd"
                                        d="M336 346.4c-1.2.4-6.2 12.4-9.7 18.2l3.7 1c13.6 4.8 20.4 9.2 26.2 17.5a7.9 7.9 0 0 0 10.2.7s2.8-1 6.4-5c3-4.5 2.2-8-1.4-11.1-11-8-22.9-14-35.4-21.3" />
                                    <path fill="#000001" fill-rule="evenodd"
                                        d="M365.3 372.8a4.3 4.3 0 1 1-8.7 0 4.3 4.3 0 0 1 8.6 0zm-21.4-13.6a4.3 4.3 0 1 1-8.7 0 4.3 4.3 0 0 1 8.7 0m10.9 7a4.3 4.3 0 1 1-8.7 0 4.3 4.3 0 0 1 8.7 0" />
                                    <path fill="#fe0" fill-rule="evenodd"
                                        d="M324.5 363.7c-42.6-24.3-87.3-50.5-130-74.8-18.7-11.7-19.6-33.4-7-49.9 1.2-2.3 2.8-1.8 3.4-.5 1.5 8 6 16.3 11.4 21.5A5288 5288 0 0 1 334 345.6c-3.4 5.8-6 12.3-9.5 18z" />
                                    <path fill="#ffec00" fill-rule="evenodd"
                                        d="m297.2 305.5 17.8 16-16 17.8-17.8-16z" />
                                    <path fill="none" stroke="#000" stroke-width="3"
                                        d="m331.5 348.8-125-75.5m109.6 58.1L274 304.1m18.2 42.7L249.3 322" />
                                </svg>
                            </a>
                            {{-- <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <div class="card shadow-none m-0">
                                    <div class="card-body p-3">
                                        <a class="iq-sub-card" href="#"><img
                                                src="../assets/images/small/flag-02.png" alt="img-flag"
                                                class="img-fluid mr-2">French</a>
                                        <a class="iq-sub-card" href="#"><img
                                                src="../assets/images/small/flag-03.png" alt="img-flag"
                                                class="img-fluid mr-2">Spanish</a>
                                        <a class="iq-sub-card" href="#"><img
                                                src="../assets/images/small/flag-04.png" alt="img-flag"
                                                class="img-fluid mr-2">Italian</a>
                                        <a class="iq-sub-card" href="#"><img
                                                src="../assets/images/small/flag-05.png" alt="img-flag"
                                                class="img-fluid mr-2">German</a>
                                        <a class="iq-sub-card" href="#"><img
                                                src="../assets/images/small/flag-06.png" alt="img-flag"
                                                class="img-fluid mr-2">Japanese</a>
                                    </div>
                                </div>
                            </div> --}}
                        </li>
                        {{-- termina btn idioma --}}

                        <li>
                            <a href="#" class="add-btn shadow-none d-block d-md-block"
                                data-toggle="modal" data-target="#addCategoria" title="Adicionar categoria">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20"
                                    height="20" fill="currentColor">
                                    <path
                                        d="M20.0834 15.1999L21.2855 15.9212C21.5223 16.0633 21.599 16.3704 21.457 16.6072C21.4147 16.6776 21.3559 16.7365 21.2855 16.7787L12.5145 22.0412C12.1979 22.2313 11.8022 22.2313 11.4856 22.0412L2.71463 16.7787C2.47784 16.6366 2.40106 16.3295 2.54313 16.0927C2.58536 16.0223 2.64425 15.9634 2.71463 15.9212L3.91672 15.1999L12.0001 20.0499L20.0834 15.1999ZM20.0834 10.4999L21.2855 11.2212C21.5223 11.3633 21.599 11.6704 21.457 11.9072C21.4147 11.9776 21.3559 12.0365 21.2855 12.0787L12.0001 17.6499L2.71463 12.0787C2.47784 11.9366 2.40106 11.6295 2.54313 11.3927C2.58536 11.3223 2.64425 11.2634 2.71463 11.2212L3.91672 10.4999L12.0001 15.3499L20.0834 10.4999ZM12.5145 1.30864L21.2855 6.5712C21.5223 6.71327 21.599 7.0204 21.457 7.25719C21.4147 7.32757 21.3559 7.38647 21.2855 7.42869L12.0001 12.9999L2.71463 7.42869C2.47784 7.28662 2.40106 6.97949 2.54313 6.7427C2.58536 6.67232 2.64425 6.61343 2.71463 6.5712L11.4856 1.30864C11.8022 1.11864 12.1979 1.11864 12.5145 1.30864ZM12.0001 3.33233L5.88735 6.99995L12.0001 10.6676L18.1128 6.99995L12.0001 3.33233Z">
                                    </path>
                                </svg>
                            </a>
                        </li>
                        @if (isAdministrator())
                            <li>
                                <a href="#" title="Adicionar farmácia"
                                    class="btn add-btn shadow-none d-block d-md-block" data-toggle="modal"
                                    data-target="#addFarmacia" title="Adicionar farmácia">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-plus-circle">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="8" x2="12" y2="16"></line>
                                        <line x1="8" y1="12" x2="16" y2="12"></line>
                                    </svg>
                                </a>
                            </li>
                        @endif
                        {{-- btn pesquisa mobile --}}
                        <li class="nav-item nav-icon search-content">
                            <a href="#" class="search-toggle rounded" id="dropdownSearch"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ri-search-line"></i>
                            </a>
                            <div class="iq-search-bar iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownSearch">
                                <form action="#" class="searchbox p-2">
                                    <div class="form-group mb-0 position-relative">
                                        <input type="text" class="text search-input font-size-12"
                                            placeholder="type here to search...">
                                        <a href="#" class="search-link"><i class="las la-search"></i></a>
                                    </div>
                                </form>
                            </div>
                        </li>
                        {{-- end btn pesquisa mobile --}}

                        {{-- start btm mensagem --}}
                        <li class="nav-item nav-icon dropdown">
                            <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton2"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail">
                                    <path
                                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                    </path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                                <span class="bg-primary"></span>
                            </a>
                            <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton2">
                                <div class="card shadow-none m-0">
                                    <div class="card-body p-0 ">
                                        <div class="cust-title p-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">All Messages</h5>
                                                <a class="badge badge-primary badge-card" href="#">3</a>
                                            </div>
                                        </div>
                                        <div class="px-3 pt-0 pb-0 sub-card">
                                            <a href="#" class="iq-sub-card">
                                                <div class="media align-items-center cust-card py-3 border-bottom">
                                                    <div class="">
                                                        <img class="avatar-50 rounded-small"
                                                            src="../assets/images/user/01.jpg" alt="01">
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-0">Emma Watson</h6>
                                                            <small class="text-dark"><b>12 : 47 pm</b></small>
                                                        </div>
                                                        <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="iq-sub-card">
                                                <div class="media align-items-center cust-card py-3 border-bottom">
                                                    <div class="">
                                                        <img class="avatar-50 rounded-small"
                                                            src="../assets/images/user/02.jpg" alt="02">
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-0">Ashlynn Franci</h6>
                                                            <small class="text-dark"><b>11 : 30 pm</b></small>
                                                        </div>
                                                        <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="iq-sub-card">
                                                <div class="media align-items-center cust-card py-3">
                                                    <div class="">
                                                        <img class="avatar-50 rounded-small"
                                                            src="../assets/images/user/03.jpg" alt="03">
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-0">Kianna Carder</h6>
                                                            <small class="text-dark"><b>11 : 21 pm</b></small>
                                                        </div>
                                                        <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <a class="right-ic btn btn-primary btn-block position-relative p-2"
                                            href="#" role="button">
                                            View All
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        {{-- end btn mensagem --}}

                        {{-- start notificações --}}
                        <li class="nav-item nav-icon dropdown">
                            <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                </svg>
                                <span class="bg-primary "></span>
                            </a>
                            <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="card shadow-none m-0">
                                    <div class="card-body p-0 ">
                                        <div class="cust-title p-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">Notifications</h5>
                                                <a class="badge badge-primary badge-card" href="#">3</a>
                                            </div>
                                        </div>
                                        <div class="px-3 pt-0 pb-0 sub-card">
                                            <a href="#" class="iq-sub-card">
                                                <div class="media align-items-center cust-card py-3 border-bottom">
                                                    <div class="">
                                                        <img class="avatar-50 rounded-small"
                                                            src="../assets/images/user/01.jpg" alt="01">
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-0">Emma Watson</h6>
                                                            <small class="text-dark"><b>12 : 47 pm</b></small>
                                                        </div>
                                                        <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="iq-sub-card">
                                                <div class="media align-items-center cust-card py-3 border-bottom">
                                                    <div class="">
                                                        <img class="avatar-50 rounded-small"
                                                            src="../assets/images/user/02.jpg" alt="02">
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-0">Ashlynn Franci</h6>
                                                            <small class="text-dark"><b>11 : 30 pm</b></small>
                                                        </div>
                                                        <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="iq-sub-card">
                                                <div class="media align-items-center cust-card py-3">
                                                    <div class="">
                                                        <img class="avatar-50 rounded-small"
                                                            src="../assets/images/user/03.jpg" alt="03">
                                                    </div>
                                                    <div class="media-body ml-3">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <h6 class="mb-0">Kianna Carder</h6>
                                                            <small class="text-dark"><b>11 : 21 pm</b></small>
                                                        </div>
                                                        <small class="mb-0">Lorem ipsum dolor sit amet</small>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <a class="right-ic btn btn-primary btn-block position-relative p-2"
                                            href="#" role="button">
                                            View All
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        {{-- end notificações --}}

                        {{-- start perfil --}}
                        <li class="nav-item nav-icon dropdown caption-content">
                            <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton4"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="../assets/images/user/1.png" class="img-fluid rounded" alt="user">
                            </a>
                            <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <div class="card shadow-none m-0">
                                    <div class="card-body p-0 text-center">
                                        <div class="media-body profile-detail text-center">
                                            <img src="../assets/images/page-img/profile-bg.jpg" alt="profile-bg"
                                                class="rounded-top img-fluid mb-4">
                                            <img src="../assets/images/user/1.png" alt="profile-img"
                                                class="rounded profile-img img-fluid avatar-70">
                                        </div>
                                        <form style="display: none" id="logout-form" action="{{ route('logout') }}"
                                            method="POST" style="display: none;">
                                            @csrf
                                            <button type="submit" id="btn-sair"></button>
                                        </form>
                                        <div class="p-3">
                                            <h5 class="mb-1">{{ auth()->user()->nome }}</h5>
                                            <p class="mb-0">Since 10 march, 2020</p>
                                            <div class="d-flex align-items-center justify-content-center mt-3">
                                                <a href="https://templates.iqonic.design/posdash/html/app/user-profile.html"
                                                    class="btn border mr-2">Profile</a>
                                                <label for="btn-sair" class="btn border">Sair</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        {{-- end perfil --}}
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
