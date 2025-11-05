<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('diretor.index') }}">Diretor - Farmácia</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('diretor.index') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Relatórios</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Configurações</a></li>
            </ul>
        </div>
    </div>
</nav>
