@extends('default.auth')

@section('titulo', 'Alterar senha')

@section('conteudo')
    <div id="wer">
        <div class="row align-items-center justify-content-center height-self-center">
            <div class="col-lg-8">
               <div class="card auth-card">
                  <div class="card-body p-0">
                     <div class="d-flex align-items-center auth-content">
                        <div class="col-lg-7 align-self-center">
                           <div class="p-3">
                              <h2 class="mb-2">Alterar senha</h2>
                              @include('partials.session')
                              <form method="POST" action="{{ route('post.password.reset') }}">
                                @csrf
                                 <div class="row">
                                    <div class="col-lg-12">
                                        <input type="hidden" name="email" value="{{ $_GET['email'] }}">
                                       <div class="floating-label form-group">
                                          <input class="floating-input form-control" name="password" type="password" placeholder=" ">
                                          <label>Nova senha</label>
                                       </div>
                                       <div class="floating-label form-group">
                                          <input class="floating-input form-control" name="password_confirmation" type="password" placeholder=" ">
                                          <label>Confirmar senha</label>
                                       </div>
                                    </div>
                                 </div>
                                 <button type="submit" class="btn btn-primary">Redefinir</button>
                              </form>
                           </div>
                        </div>
                        <div class="col-lg-5 content-right">
                           <img src="{{ pharma('assets/images/login/01.png')}}" class="img-fluid image-right" alt="">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
    </div>
@endsection