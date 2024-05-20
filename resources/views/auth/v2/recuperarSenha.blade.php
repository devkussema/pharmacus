@extends('layout.v2.auth')

@section('titulo', 'Recuperar senha')

@section('content')
    <div class="col-md-8 d-flex flex-column align-items-center bg-dark">
        <div class="container my-auto py-5">
            <div class="row g-0">
                <div class="col-11 col-md-8 col-lg-7 col-xl-6 mx-auto">
                    <p class="text-2 text-light">Voltar para <a class="fw-500" href="{{ route('login') }}">Login</a></p>
                    <h3 class="text-white mb-4">Esqueceu sua senha?</h3>
                    <p class="text-white-50 mb-4">Digite o endereço de e-mail ou número de celular associado à sua conta.</p>
                    @include('auth.session')
                    <form class="form-dark" method="POST" action="{{ route('alterar_senha') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label text-light" for="emailAddressEmail"></label>
                            <input type="text" name="email" class="form-control" id="emailAddress" required placeholder="Digite o seu Email">
                        </div>
                        <button class="btn btn-primary mt-2" type="submit">Continuar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
