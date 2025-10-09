@extends('prepharma_auth::layout.app')

@section('titulo', 'Confirmar Email')

@section('content')
<div class="col-lg-6 login-wrap-bg">
    <div class="login-wrapper">
        <div class="loginbox">
            <div class="login-right">
                <div class="login-right-wrap">
                    <div class="account-logo">
                        <a href="{{ route('login') }}"><img src="{{ asset('prepharma/img/login-logo.png') }}" alt></a>
                    </div>
                    <h2>Confirmar Email</h2>
                    <p>Digite a sua senha para confirmar o seu email.</p>
                    @include('partials.session')
                    <form action="{{ route('auth.confirmar_email_store') }}" method="POST">
                        @csrf
                        <div class="input-block">
                            <label>Email<span class="login-danger">*</span></label>
                            <input class="form-control" name="email" readonly type="email" value="{{ $token->user->email }}">
                        </div>
                        <div class="input-block">
                            <label>Senha<span class="login-danger">*</span></label>
                            <input class="form-control" type="password" name="password">
                        </div>
                        <div class="input-block login-btn">
                            <button class="btn btn-primary btn-block" type="submit">Confirmar Email</button>
                        </div>
                        <input type="hidden" value="{{ $token->id }}" name="token_id">
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

