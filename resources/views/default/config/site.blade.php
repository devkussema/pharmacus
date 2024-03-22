@extends('home.index')

@section('titulo', 'Definições do site')

@section('conteudo')
    <div id="dadoPrincipal">
        @include('partials.session')
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                       <div class="header-title">
                          <h4 class="card-title">Definições do site</h4>
                       </div>
                    </div>
                    <div class="card-body">
                       <p>Faça toda a gestão do site a partir daqui</p>
                       <ul class="nav nav-tabs justify-content-center" id="myTab-2" role="tablist">
                          <li class="nav-item">
                             <a class="nav-link active" id="home-tab-justify" data-toggle="tab" href="#home-justify" role="tab" aria-controls="home" aria-selected="true">Home</a>
                          </li>
                          <li class="nav-item">
                             <a class="nav-link" id="profile-tab-justify" data-toggle="tab" href="#profile-justify" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
                          </li>
                          <li class="nav-item">
                             <a class="nav-link" id="contact-tab-justify" data-toggle="tab" href="#contact-justify" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                          </li>
                       </ul>
                       <div class="tab-content" id="myTabContent-3">
                          <div class="tab-pane fade show active" id="home-justify" role="tabpanel" aria-labelledby="home-tab-justify">
                             <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                          </div>
                          <div class="tab-pane fade" id="profile-justify" role="tabpanel" aria-labelledby="profile-tab-justify">
                             <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                          </div>
                          <div class="tab-pane fade" id="contact-justify" role="tabpanel" aria-labelledby="contact-tab-justify">
                             <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
            </div>
        </div>
    </div>
@endsection