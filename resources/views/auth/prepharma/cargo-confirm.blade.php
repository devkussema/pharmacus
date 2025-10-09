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
                    <h2>Olá</h2>
                    <h6>Conclua o cadastro e comece.</h6>
                    @include('partials.session')
                    <form action="{{ route('confirmar.funcionario.concluir') }}" method="POST">
                        @csrf
                        <div class="input-block">
                            <label>Nome <span class="login-danger">*</span></label>
                            <input class="form-control" type="text" name="nome">
                        </div>
                        <div class="input-block">
                            <label>Cargo <span class="login-danger">*</span></label>
                            <input class="form-control" type="text" readonly value="{{ $token->user->area_hospitalar->cargo->nome }}">
                        </div>
                        <div class="input-block">
                            <label>Email <span class="login-danger">*</span></label>
                            <input class="form-control" type="text" value="{{ $token->user->email }}" readonly>
                        </div>
                        <div class="input-block">
                            <input name="email" value="{{ $token->user->email }}" type="hidden">
                            <input name="email_verified_at" value="{{ now() }}" type="hidden">
                            <input name="token" value="{{ $token->token }}" type="hidden">


                            <label>Senha <span class="login-danger">*</span></label>
                            <input class="form-control" type="password" name="password">
                        </div>
                        <div class="input-block login-btn">
                            <button class="btn btn-primary btn-block" type="submit">Alterar
                                Senha</button>
                        </div>
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
