@extends('default.auth')

@section('titulo', 'Confirmar conta')

@section('conteudo')
    <div id="wer">
        <div class="row align-items-center justify-content-center height-self-center">
            <div class="col-lg-8">
                <div class="card auth-card">
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center auth-content">
                            <div class="col-lg-7 align-self-center">
                                <div class="p-3">
                                    <img src="{{ assetr('assets/images/user/1.png') }}" class="rounded avatar-80 mb-3"
                                        alt="">
                                    <h2 class="mb-2">Olá!</h2>
                                    <p>Conclua o cadastro e comece.</p>
                                    <form method="post" action="{{ route('confirmar.funcionario.concluir') }}">
                                        @csrf
                                        @include('partials.session')
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="floating-label form-group">
                                                    <input name="nome" class="floating-input form-control" type="text">
                                                    <label>Nome</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="floating-label form-group">
                                                    <input name="" value="{{ $token->user->area_hospitalar->cargo->nome }}" readonly class="floating-input form-control" type="text">
                                                    <label style="background-color: transparent" class="mb-2">Cargo</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="floating-label form-group">
                                                    <input name="" value="{{ $token->user->email }}" readonly class="floating-input form-control" type="text">
                                                    <label style="background-color: transparent" class="mb-2">Email</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="floating-label form-group">
                                                    <input name="email" value="{{ $token->user->email }}" type="hidden">
                                                    <input name="email_verified_at" value="{{ now() }}" type="hidden">
                                                    <input name="token" value="{{ $token->token }}" type="hidden">
                                                    <input name="password" class="floating-input form-control" type="password">
                                                    <label>Senha</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Entrar</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-5 content-right">
                                <img src="{{ assetr('assets/images/login/01.png')}}" class="img-fluid image-right" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
