<div class="iq-sidebar sidebar-default ">
    <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="header-logo">
            <img src="{{ assetr('assets/images/white__logo2.png') }}" class="img-fluid rounded-normal" alt="logo">
            <h5 class="logo-title ml-3">{{ getConfig('nome_site') ?? env('APP_NAME', 'Pharmacus') }}</h5>
        </a>
        <div class="iq-menu-bt-sidebar ml-0">
            <i class="ri-menu-2-line wrapper-menu"></i>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                @if (isAdministrator())
                    <li class="">
                        <a href="#farmacias" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                fill="currentColor">
                                <path
                                    d="M8 20V14H16V20H19V4H5V20H8ZM10 20H14V16H10V20ZM21 20H23V22H1V20H3V3C3 2.44772 3.44772 2 4 2H20C20.5523 2 21 2.44772 21 3V20ZM11 8V6H13V8H15V10H13V12H11V10H9V8H11Z">
                                </path>
                            </svg>
                            <span class="ml-4">Farmácias</span>
                            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="10 15 15 20 20 15"></polyline>
                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg>
                        </a>
                        <ul id="farmacias" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="">
                                <a href="{{ route('farmacia') }}" class="link-loaderish">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18"
                                        height="18" fill="rgba(52,51,51,1)" class="mr-4">
                                        <path
                                            d="M4.99989 13.9999L4.99976 5L6.99976 4.99997L6.99986 11.9999L17.1717 12L13.222 8.05024L14.6362 6.63603L21.0001 13L14.6362 19.364L13.222 17.9497L17.1717 14L4.99989 13.9999Z">
                                        </path>
                                    </svg>
                                    <span>Listar</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="">
                        <a href="#usuarios" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                fill="currentColor">
                                <path
                                    d="M20 22H18V20C18 18.3431 16.6569 17 15 17H9C7.34315 17 6 18.3431 6 20V22H4V20C4 17.2386 6.23858 15 9 15H15C17.7614 15 20 17.2386 20 20V22ZM12 13C8.68629 13 6 10.3137 6 7C6 3.68629 8.68629 1 12 1C15.3137 1 18 3.68629 18 7C18 10.3137 15.3137 13 12 13ZM12 11C14.2091 11 16 9.20914 16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7C8 9.20914 9.79086 11 12 11Z">
                                </path>
                            </svg>
                            <span class="ml-4">Usuários</span>
                            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="10 15 15 20 20 15"></polyline>
                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg>
                        </a>
                        <ul id="usuarios" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="">
                                <a href="{{ route('usuario') }}" class="link-loaderish">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18"
                                        height="18" fill="rgba(52,51,51,1)" class="mr-4">
                                        <path
                                            d="M4.99989 13.9999L4.99976 5L6.99976 4.99997L6.99986 11.9999L17.1717 12L13.222 8.05024L14.6362 6.63603L21.0001 13L14.6362 19.364L13.222 17.9497L17.1717 14L4.99989 13.9999Z">
                                        </path>
                                    </svg>
                                    <span>Listar</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (Auth::user()->area_hospitalar || Auth::user()->isFarmacia)
                    <li class="">
                        <a href="#estoque_farmaceutico" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                fill="currentColor">
                                <path
                                    d="M6.50488 2H17.5049C17.8196 2 18.116 2.14819 18.3049 2.4L21.0049 6V21C21.0049 21.5523 20.5572 22 20.0049 22H4.00488C3.4526 22 3.00488 21.5523 3.00488 21V6L5.70488 2.4C5.89374 2.14819 6.19013 2 6.50488 2ZM19.0049 8H5.00488V20H19.0049V8ZM18.5049 6L17.0049 4H7.00488L5.50488 6H18.5049ZM9.00488 10V12C9.00488 13.6569 10.348 15 12.0049 15C13.6617 15 15.0049 13.6569 15.0049 12V10H17.0049V12C17.0049 14.7614 14.7663 17 12.0049 17C9.24346 17 7.00488 14.7614 7.00488 12V10H9.00488Z">
                                </path>
                            </svg>
                            <span class="ml-4">Estoque</span>
                            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="10 15 15 20 20 15"></polyline>
                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg>
                        </a>
                        <ul id="estoque_farmaceutico" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="">
                                @if (Auth::user()->isFarmacia)
                                    <a href="{{ route('estoque.gerente') }}" class="link-loaderish">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18"
                                            height="18" fill="rgba(52,51,51,1)">
                                            <path
                                                d="M4.99989 13.9999L4.99976 5L6.99976 4.99997L6.99986 11.9999L17.1717 12L13.222 8.05024L14.6362 6.63603L21.0001 13L14.6362 19.364L13.222 17.9497L17.1717 14L4.99989 13.9999Z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">Listar</span>
                                    </a>
                                @else
                                    <a href="{{ route('estoque') }}" class="link-loaderish">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18"
                                            height="18" fill="rgba(52,51,51,1)">
                                            <path
                                                d="M4.99989 13.9999L4.99976 5L6.99976 4.99997L6.99986 11.9999L17.1717 12L13.222 8.05024L14.6362 6.63603L21.0001 13L14.6362 19.364L13.222 17.9497L17.1717 14L4.99989 13.9999Z">
                                            </path>
                                        </svg>
                                        <span class="ml-4">Listar</span>
                                    </a>
                                @endif
                            </li>
                        </ul>
                    </li>
                @endif
                @if (@Auth::user()->isFarmacia or vPerm('area_hospitalar', ['ver']))
                    <li class="">
                        <a href="#areas_hospitalares" class="collapsed" data-toggle="collapse"
                            aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M21 19H23V21H1V19H3V4C3 3.44772 3.44772 3 4 3H14C14.5523 3 15 3.44772 15 4V19H17V9H20C20.5523 9 21 9.44772 21 10V19ZM7 11V13H11V11H7ZM7 7V9H11V7H7Z">
                                </path>
                            </svg>
                            <span class="ml-4">Áreas Hospitalares</span>
                            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="10 15 15 20 20 15"></polyline>
                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg>
                        </a>
                        <ul id="areas_hospitalares" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="">
                                <a href="{{ route('a_h.index') }}" class="link-loaderish">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18"
                                        height="18" fill="rgba(52,51,51,1)">
                                        <path
                                            d="M4.99989 13.9999L4.99976 5L6.99976 4.99997L6.99986 11.9999L17.1717 12L13.222 8.05024L14.6362 6.63603L21.0001 13L14.6362 19.364L13.222 17.9497L17.1717 14L4.99989 13.9999Z">
                                        </path>
                                    </svg>
                                    <span class="ml-4">Listar</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (@Auth::user()->isFarmacia || vPerm('funcionarios', ['ver']))
                    <li class="">
                        <a href="#ah_funcionarios" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.15"
                                    d="M12 11C13.6569 11 15 9.65685 15 8C15 6.34315 13.6569 5 12 5C10.3431 5 9 6.34315 9 8C9 9.65685 10.3431 11 12 11Z"
                                    fill="none" />
                                <path
                                    d="M3 19H1V18C1 16.1362 2.27477 14.5701 4 14.126M6 10.8293C4.83481 10.4175 4 9.30621 4 7.99999C4 6.69378 4.83481 5.58254 6 5.1707M21 19H23V18C23 16.1362 21.7252 14.5701 20 14.126M18 5.1707C19.1652 5.58254 20 6.69378 20 7.99999C20 9.30621 19.1652 10.4175 18 10.8293M10 14H14C16.2091 14 18 15.7909 18 18V19H6V18C6 15.7909 7.79086 14 10 14ZM15 8C15 9.65685 13.6569 11 12 11C10.3431 11 9 9.65685 9 8C9 6.34315 10.3431 5 12 5C13.6569 5 15 6.34315 15 8Z"
                                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <span class="ml-4">Funcionários</span>
                            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="10 15 15 20 20 15"></polyline>
                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg>
                        </a>
                        <ul id="ah_funcionarios" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="">
                                <a href="{{ route('funcionarios') }}" class="link-loaderish">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18"
                                        height="18" fill="rgba(52,51,51,1)">
                                        <path
                                            d="M4.99989 13.9999L4.99976 5L6.99976 4.99997L6.99986 11.9999L17.1717 12L13.222 8.05024L14.6362 6.63603L21.0001 13L14.6362 19.364L13.222 17.9497L17.1717 14L4.99989 13.9999Z">
                                        </path>
                                    </svg>
                                    <span class="ml-4">Lista</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- <li class=" ">
                    <a href="#categoria" class="collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg class="svg-icon" id="p-dash3" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg>
                        <span class="ml-4">Categorias</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="10 15 15 20 20 15"></polyline>
                            <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                    </a>
                    <ul id="categoria" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class="">
                            <a href="{{ route('categoria') }}" id="aside-linke">
                                <i class="las la-minus"></i><span>Lista</span>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                @if (Auth::user()->isFarmacia || vPerm('grupos_farmacologicos', ['ver']))
                    <li class="">
                        <a href="#grupos_farmacologicos" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                fill="currentColor">
                                <path
                                    d="M6.50488 2H17.5049C17.8196 2 18.116 2.14819 18.3049 2.4L21.0049 6V21C21.0049 21.5523 20.5572 22 20.0049 22H4.00488C3.4526 22 3.00488 21.5523 3.00488 21V6L5.70488 2.4C5.89374 2.14819 6.19013 2 6.50488 2ZM19.0049 8H5.00488V20H19.0049V8ZM18.5049 6L17.0049 4H7.00488L5.50488 6H18.5049ZM9.00488 10V12C9.00488 13.6569 10.348 15 12.0049 15C13.6617 15 15.0049 13.6569 15.0049 12V10H17.0049V12C17.0049 14.7614 14.7663 17 12.0049 17C9.24346 17 7.00488 14.7614 7.00488 12V10H9.00488Z">
                                </path>
                            </svg>
                            <span class="ml-4">G. Farmacológicos</span>
                            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="10 15 15 20 20 15"></polyline>
                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg>
                        </a>
                        <ul id="grupos_farmacologicos" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="">
                                <a href="{{ route('grupos_farmacologicos.index') }}" class="link-loaderish">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18"
                                        height="18" fill="rgba(52,51,51,1)">
                                        <path
                                            d="M4.99989 13.9999L4.99976 5L6.99976 4.99997L6.99986 11.9999L17.1717 12L13.222 8.05024L14.6362 6.63603L21.0001 13L14.6362 19.364L13.222 17.9497L17.1717 14L4.99989 13.9999Z">
                                        </path>
                                    </svg>
                                    <span class="ml-4">Listar</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if (vPerm('relatorio', ['ver']) or Auth::user()->isFarmacia)
                    <li class="">
                        <a href="#sale" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <svg class="svg-icon" id="p-dash4" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path>
                                <path d="M22 12A10 10 0 0 0 12 2v10z"></path>
                            </svg>
                            <span class="ml-4">Relatórios</span>
                            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="10 15 15 20 20 15"></polyline>
                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg>
                        </a>
                        <ul id="sale" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="">
                                <a href="{{ route('nivel_alerta') }}" class="link-loaderish">
                                    <i class="las la-minus"></i><span>Niveis de Alerta</span>
                                </a>
                            </li>
                        </ul>
                    </li>
               @endif
                @if (isAdministrator())
                    <li class="">
                        <a href="#desenvolvedor" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="ri-terminal-box-fill"></i>
                            <span class="ml-4">Desenvolvedor</span>
                            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="10 15 15 20 20 15"></polyline>
                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg>
                        </a>
                        <ul id="desenvolvedor" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="">
                                <a href="{{ route('dev.visitante') }}" class="link-loaderish">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18"
                                        height="18" fill="rgba(52,51,51,1)" class="mr-4">
                                        <path
                                            d="M4.99989 13.9999L4.99976 5L6.99976 4.99997L6.99986 11.9999L17.1717 12L13.222 8.05024L14.6362 6.63603L21.0001 13L14.6362 19.364L13.222 17.9497L17.1717 14L4.99989 13.9999Z">
                                        </path>
                                    </svg>
                                    <span>Visitantes</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="">
                        <a href="#config_site" class="collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="ri-settings-4-fill"></i>
                            <span class="ml-4">Definições</span>
                            <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polyline points="10 15 15 20 20 15"></polyline>
                                <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                            </svg>
                        </a>
                        <ul id="config_site" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                            <li class="">
                                <a href="{{ route('config.site') }}" class="link-loaderish">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18"
                                        height="18" fill="rgba(52,51,51,1)" class="mr-4">
                                        <path
                                            d="M4.99989 13.9999L4.99976 5L6.99976 4.99997L6.99986 11.9999L17.1717 12L13.222 8.05024L14.6362 6.63603L21.0001 13L14.6362 19.364L13.222 17.9497L17.1717 14L4.99989 13.9999Z">
                                        </path>
                                    </svg>
                                    <span>Site</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
        {{-- <div id="sidebar-bottom" class="position-relative sidebar-bottom">
            <div class="card border-none">
                <div class="card-body p-0">
                    <div class="sidebarbottom-content">
                        <div class="image"><img src="{{ assetr('assets/images/layouts/side-bkg.png') }}"
                                class="img-fluid" alt="side-bkg"></div>
                        <h6 class="mt-4 px-4 body-title">Get More Feature by Upgrading</h6>
                        <button type="button" class="btn sidebar-bottom-btn mt-4">Go Premium</button>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="p-3"></div>
    </div>
</div>
