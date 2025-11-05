<nav class="navbar navbar-expand-lg fixed-top app-header">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('diretor.index') }}"><i class="fa-solid fa-capsules me-2 text-primary"></i>Diretor - Farmácia</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <form class="d-flex ms-3 me-auto" role="search">
                <input class="form-control form-control-sm me-2" type="search" placeholder="Pesquisar..." aria-label="Pesquisar">
                <button class="btn btn-sm btn-outline-secondary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>

            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-2 d-none d-lg-block">
                    <button class="btn btn-sm btn-outline-secondary" onclick="toggleDiretorTheme()" title="Alternar tema">
                        <i class="fa-solid fa-moon"></i>
                    </button>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name=Diretor&background=6ee7b7&color=fff&size=32" class="rounded-circle me-2" alt="user">
                        <span class="d-none d-sm-inline">Diretor</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user me-2"></i>Perfil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-gear me-2"></i>Definições</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#"><i class="fa-solid fa-right-from-bracket me-2"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
