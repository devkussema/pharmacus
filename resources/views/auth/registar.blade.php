@extends('default.auth')

@section('titulo', 'Criar conta')

@section('conteudo')
    <div id="wer">
        <div class="row align-items-center justify-content-center height-self-center">
            <div class="col-lg-8">
                <div class="card auth-card">
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center auth-content">
                            <div class="col-lg-7 align-self-center">
                                <div class="p-3">
                                    <h2 class="mb-2">Criar conta</h2>
                                    <p>Crie a tua conta <b>{{ env('APP_NAME') }}</b>.</p>
                                    <form id="cadastrarQ" method="POST" action="{{ route('registar.store') }}">
                                        @include('partials.session')
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="floating-label form-group">
                                                    <input name="nome" class="floating-input form-control" type="text" value="{{ old('nome') }}">
                                                    <label>Nome</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="floating-label form-group">
                                                    <input name="email" class="floating-input form-control" type="email" value="{{ old('email') }}">
                                                    <label>Email</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="floating-label form-group">
                                                    <input name="password" class="floating-input form-control" type="password" placeholder=" ">
                                                    <label>Senha</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="floating-label form-group">
                                                    <input name="password_confirmation" class="floating-input form-control" type="password" placeholder=" ">
                                                    <label>Confirmar Senha</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                    <label class="custom-control-label" for="customCheck1">Aceito os termos de utilização</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Criar conta</button>
                                        <p class="mt-3">
                                            Já tens uma conta <a href="{{ route('login') }}" onclick="pager('{{ route('login') }}', event)" class="text-primary">Entrar</a>
                                        </p>
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
