@extends('default.auth')

@section('titulo', 'Confirmar email')

@section('conteudo')
    <div class="row align-items-center justify-content-center height-self-center">
        <div class="col-lg-8">
            <div class="card auth-card">
                <div class="card-body p-0">
                    <div class="d-flex align-items-center auth-content">
                        <div class="col-lg-7 align-self-center">
                            <div class="p-3">
                                <h2 class="mb-2">Confirmar Email</h2>
                                <p>Digite a sua senha para confirmar o seu email.</p>
                                <form>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="floating-label form-group">
                                                <input class="floating-input form-control" type="email" placeholder=" ">
                                                <label>Email</label>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Reset</button>
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
@endsection
