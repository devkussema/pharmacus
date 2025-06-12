@extends('layout.v2.auth')

@section('content')
    @php global $theme; @endphp
    <div class="col-md-8 d-flex flex-column align-items-center bg-{{ isset($theme) ? $theme : 'dark'}}">
        <div class="container my-auto py-5">
            <div class="row g-0">
                <div class="col-11 col-md-8 col-lg-7 col-xl-6 mx-auto">
                    @if (getConfig('criar_conta'))
                        <p class="text-2 text-light">Não é um membro?
                            <a class="fw-500" href="#">Registro</a>
                        </p>
                    @endif
                    <h3 class="text-{{ isset($theme) ? $theme : 'white' }} mb-4">Faça login na sua conta {{ $theme }}</h3>
                    <div class="d-flex">
                        <button type="button" class="btn btn-primary btn-sm fw-400 rounded-3 shadow-none">
                            <span class="me-2">
                                <i class="fab fa-google"></i>
                            </span>
                            <span class="mx-3">Faça login com o Google</span>
                        </button>
                        <ul class="social-icons d-inline-block social-icons-rounded">
                            <li class="social-icons-apple mb-0">
                                <a onclick="wish()" class="bg-{{ isset($theme) ? $theme : 'light' }}-4" href="#"
                                    data-bs-toggle="tooltip" data-bs-original-title="Faça login com a Apple">
                                    <i class="fab fa-apple"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex align-items-center my-4">
                        <hr class="col-1 border-secondary">
                        <span class="mx-3 text-2 text-{{ isset($theme) ? $theme : 'white' }}-50">OU</span>
                        <hr class="flex-grow-1 border-secondary">
                    </div>
                    <form id="login-form" method="POST" action="{{ route('login') }}"
                        class="form-{{ isset($theme) == 'dark' ? 'light' : 'dark' }}">
                        @csrf
                        @include('auth.session')
                        <div class="mb-3">
                            <label class="form-label text-{{ isset($theme) ? $theme : 'white' }}"
                                for="emailAddress">Email</label>
                            <input name="email" type="email" class="form-control" id="emailAddress" required
                                placeholder="Digite seu e-mail">
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-{{ isset($theme) ? $theme : 'white' }}"
                                for="loginPassword">Senha</label>
                            <a style="text-decoration: none" class="float-end text-2"
                                href="{{ route('recuperar_senha') }}">Esqueceu sua senha?</a>
                            <input name="password" type="password" class="form-control" id="loginPassword" required
                                placeholder="Digite a senha">
                        </div>
                        <button class="btn btn-primary my-2" type="submit">Conecte-se</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
