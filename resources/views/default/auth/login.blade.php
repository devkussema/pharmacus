@extends('default.auth')

@section('titulo', 'Iniciar sessão')

@section('conteudo')
    <div id="wer">
        <div class="row align-items-center justify-content-center height-self-center">
            <div class="col-lg-8">
                <div class="card auth-card">
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center auth-content">
                            <div class="col-lg-7 align-self-center">
                                <div class="p-3">
                                    <h2 class="mb-2">Entrar</h2>
                                    <p>Entre para se conectar.</p>
                                    <form id="login-form" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        @include('partials.session')
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="floating-label form-group">
                                                    <input name="email" class="floating-input form-control" type="email">
                                                    <label>Email</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="floating-label form-group">
                                                    <input name="password" class="floating-input form-control"
                                                        type="password">
                                                    <label>Senha</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                    <label class="custom-control-label control-label-1"
                                                        for="customCheck1">Lembre-me</label>
                                                </div>
                                            </div>
                                            @if (getConfig('recuperar_conta'))
                                                <div class="col-lg-6">
                                                    <a href="{{ route('recuperar_senha') }}" class="text-primary float-right">Esqueceu a
                                                        senha?</a>
                                                </div>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary">Entrar</button>
                                        @if (getConfig('criar_conta'))
                                            <p class="mt-3">
                                                Criar conta <a href="{{ route('registar') }}"
                                                    onclick="pager('{{ route('registar') }}', event)" class="text-primary">Criar
                                                    conta</a>
                                            </p>
                                        @endif
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-5 content-right">
                                <img src="{{ pharma('assets/images/login/login_bg.png')}}" class="img-fluid image-right" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
