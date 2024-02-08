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
                                    <img src="{{ asset('assets/images/user/1.png') }}" class="rounded avatar-80 mb-3"
                                        alt="">
                                    <h2 class="mb-2">Olá ! {{ $token->user->nome }}</h2>
                                    <p>Informe a sua senha para acessar a tua conta.</p>
                                    <form method="post" action="{{ route('entrar') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                @include('partials.session')
                                                <div class="floating-label form-group">
                                                    <input name="email" value="{{ $token->user->email }}" type="hidden">
                                                    <input name="email_verified_at" value="sim" type="hidden">
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
                                <img src="{{ asset('assets/images/login/01.png')}}" class="img-fluid image-right" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
