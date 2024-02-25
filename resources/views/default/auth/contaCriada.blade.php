@extends('default.auth')

@section('titulo', 'Conta criada')

@section('conteudo')
    <div class="row align-items-center justify-content-center height-self-center">
        <div class="col-lg-8">
            <div class="card auth-card">
                <div class="card-body p-0">
                    <div class="d-flex align-items-center auth-content">
                        <div class="col-lg-7 align-self-center">
                            <div class="p-3">
                                <img src="{{ asset('assets/images/login/mail.png') }}" class="img-fluid" width="80" alt="">
                                <h2 class="mt-3 mb-0">Parabéns !</h2>
                                <p class="cnf-mail mb-1">
                                    Um email foi enviado para <code>{{ $email ?? session('email') }}</code>.
                                    Verifique se há um email da <b>{{ env('APP_NAME') }}</b> e clique no link
                                    incluído para ativar o email da sua conta.
                                </p>
                                <div class="d-inline-block w-100">
                                    <a href="{{ route('login') }}" class="btn btn-primary mt-3">Ir para o Login</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 content-right">
                            <img src="{{ asset('assets/images/login/01.png') }}" class="img-fluid image-right" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
