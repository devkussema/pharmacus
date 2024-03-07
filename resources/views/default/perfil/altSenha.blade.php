@extends('home.index')

@section('titulo', 'Adicionar funcionário')

@section('conteudo')
    <div id="dadoPrincipal">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Alterar senha</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="d-flex nav nav-pills mb-3 text-center profile-tab" id="profile-pills-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link show active" data-toggle="pill"
                                    href="#config2"
                                    role="tab" aria-selected="false">Segurança</a>
                            </li>
                        </ul>
                        <div class="new-user-info">
                            <div class="tab-content">
                                <div id="config2" class="tab-pane fade show active">
                                    <div class="row">
                                        <form method="post" action="{{ route('u.altSenha') }}" class="col-md-12">
                                            @csrf
                                            <div class="form-group col-md-12">
                                                <label for="uname">Senha atual:</label>
                                                <input disabled type="password" class="form-control" id="uname" name="current-password">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="pass">Nova senha:</label>
                                                <input disabled type="password" class="form-control" id="pass" name="password">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="rpass">Repetir senha:</label>
                                                <input disabled type="password" class="form-control" id="rpass" name="confirm-password">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <button disabled type="submit" class="btn btn-primary">Alterar senha</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
