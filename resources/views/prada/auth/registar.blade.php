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
                                    <h2 class="mb-2">Sign Up</h2>
                                    <p>Create your POSDash account.</p>
                                    <form>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="floating-label form-group">
                                                    <input class="floating-input form-control" type="text" placeholder=" ">
                                                    <label>Full Name</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="floating-label form-group">
                                                    <input class="floating-input form-control" type="text" placeholder=" ">
                                                    <label>Last Name</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="floating-label form-group">
                                                    <input class="floating-input form-control" type="email" placeholder=" ">
                                                    <label>Email</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="floating-label form-group">
                                                    <input class="floating-input form-control" type="text" placeholder=" ">
                                                    <label>Phone No.</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="floating-label form-group">
                                                    <input class="floating-input form-control" type="password" placeholder=" ">
                                                    <label>Password</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="floating-label form-group">
                                                    <input class="floating-input form-control" type="password" placeholder=" ">
                                                    <label>Confirm Password</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                    <label class="custom-control-label" for="customCheck1">I agree with the terms of use</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Sign Up</button>
                                        <p class="mt-3">
                                            Already have an Account <a href="{{ route('login') }}" onclick="pager('{{ route('login') }}', event)" class="text-primary">Entrar</a>
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
