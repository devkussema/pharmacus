@extends('prepharma_auth::layout.app')

@section('titulo', 'Alterar Senha')

@section('content')
<div class="col-lg-6 login-wrap-bg">
    <div class="login-wrapper">
        <div class="loginbox">
            <div class="login-right">
                <div class="login-right-wrap">
                    <div class="account-logo">
                        <a href="{{ route('login') }}"><img src="{{ asset('prepharma/img/login-logo.png') }}" alt></a>
                    </div>
                    <h2>Alterar Senha</h2>
                    @include('partials.session')
                    <form action="{{ route('post.password.reset') }}" method="POST">
                        @csrf
                        <div class="input-block">
                            <label>Nova Senha <span class="login-danger">*</span></label>
                            <input class="form-control" type="password" name="password">
                        </div>
                        <div class="input-block">
                            <label>Confirmar senha <span class="login-danger">*</span></label>
                            <input class="form-control" type="password" name="password_confirmation">
                        </div>
                        <div class="input-block login-btn">
                            <button class="btn btn-primary btn-block" type="submit">Alterar
                                Senha</button>
                        </div>
                        <input type="hidden" name="email" value="{{ $_GET['email'] }}">
                    </form>

                    <div class="next-sign">
                        <p class="account-subtitle">Voltar para <a href="{{ route('login') }}">Login</a></p>

                        <div class="social-login">
                            <a href="javascript:;"><img src="{{ asset('prepharma/img/icons/login-icon-01.svg') }}"
                                    alt></a>
                            <a href="javascript:;"><img src="{{ asset('prepharma/img/icons/login-icon-02.svg') }}"
                                    alt></a>
                            <a href="javascript:;"><img src="{{ asset('prepharma/img/icons/login-icon-03.svg') }}"
                                    alt></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection