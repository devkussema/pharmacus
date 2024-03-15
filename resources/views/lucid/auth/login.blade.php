@extends('default.auth')

@section('content')
    <div class="card shadow p-lg-4">
        <div class="card-header">
            <p class="fs-5 mb-0">Entre na sua conta</p>
        </div>
        <div class="card-body">
            <form action="#">
                <div class="form-floating mb-1">
                    <input type="email" class="form-control" placeholder="name@example.com">
                    <label>Email</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" placeholder="Password">
                    <label>Senha</label>
                </div>
                <div class="form-check my-3">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Lembre-me
                    </label>
                </div>
                <button type="submit" class="btn btn-primary w-100 px-3 py-2">ENTRAR</button>
            </form>
            <div class="mt-3 pt-3 border-top">
                <p class="mb-1">
                    <a href="page-forgot-password.html">
                        <i class="fa fa-lock me-2"></i>
                        Esqueceu a senha?
                    </a>
                </p>
                <span>Não tens uma conta? <a href="page-register.html">Registar</a></span>
            </div>
        </div>
    </div>
@endsection
