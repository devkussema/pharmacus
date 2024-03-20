@if (session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
@if (session('info'))
    <div class="alert alert-info" role="alert">
        {{ session('info') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif
@if (session('warning'))
    <div class="alert alert-warning" role="alert">
        {{ session('warning') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (auth()->check() and @(auth()->user()->isFarmacia || auth()->user()->farmacia->fun_unica == "Tudo"))
    <div class="row">
        <div class="col-md-3">
            <div class="alert text-white bg-dark" role="alert">
                <div class="iq-alert-icon">
                    <i class="fa-solid fa-cubes-stacked fa-fade"></i>
                </div>
                <div class="iq-alert-text">Os dados do estoque máximo serão atualizados em breve.</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="alert text-white bg-primary" role="alert">
                <div class="iq-alert-icon">
                    <i class="fa-solid fa-cubes fa-fade"></i>
                </div>
                <div class="iq-alert-text">Os dados do estoque normal serão atualizados em breve</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="alert text-dark bg-light" role="alert">
                <div class="iq-alert-icon">
                    <i class="fa-solid fa-pills fa-beat-fade"></i>
                </div>
                <div class="iq-alert-text">Os dados do estoque mínimo serão atualizados em breve.</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="alert text-white bg-danger" role="alert">
                <div class="iq-alert-icon">
                    <i class="fa-regular fa-face-surprise fa-beat"></i>
                </div>
                <div class="iq-alert-text">Os dados do estoque crítico serão atualizados em breve</div>
            </div>
        </div>
    </div>
    <hr>
@endif
@if (nem('MANUTENCAO_LEVE') and auth()->check())
    <div class="alert alert-warning" role="alert">
        Alguns recursos podem estar indisponiveis pelo que estamos a trabalhar para melhorar
    </div>
@endif
