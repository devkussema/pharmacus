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
                                <h2 class="mb-2">Sign In</h2>
                                <p>Login to stay connected.</p>
                                <form>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="floating-label form-group">
                                                <input class="floating-input form-control" type="email" placeholder=" ">
                                                <label>Email</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="floating-label form-group">
                                                <input class="floating-input form-control" type="password" placeholder=" ">
                                                <label>Password</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                <label class="custom-control-label control-label-1" for="customCheck1">Remember Me</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <a href="auth-recoverpw.html" class="text-primary float-right">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Sign In</button>
                                    <p class="mt-3">
                                        Create an Account <a href="{{ route('registar') }}" onclick="pager('{{ route('registar') }}', event)" class="text-primary">Criar conta</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-5 content-right">
                            <img src="../assets/images/login/01.png" class="img-fluid image-right" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
