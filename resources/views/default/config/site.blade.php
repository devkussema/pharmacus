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
                                <a class="nav-link active" id="site-tab-justify" data-toggle="tab" href="#site"
                                    role="tab" aria-controls="site" aria-selected="true">
                                    Site
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="home-tab-justify" data-toggle="tab" href="#permissoes"
                                    role="tab" aria-controls="permissoes" aria-selected="false">
                                    Permissões
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab-justify" data-toggle="tab" href="#profile-justify"
                                    role="tab" aria-controls="profile" aria-selected="false">
                                    Farmácia
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab-justify" data-toggle="tab" href="#contact-justify"
                                    role="tab" aria-controls="contact" aria-selected="false">
                                    CMD
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent-3">
                            <div class="tab-pane fade show active" id="site" role="tabpanel"
                                aria-labelledby="site-tab-justify">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-between">
                                                <div class="header-title">
                                                    <h4 class="card-title">Definições básicas</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate,
                                                    ex ac
                                                    venenatis mollis, diam
                                                    nibh finibus leo</p>
                                                <form method="POST" id="info_basica">
                                                    <div class="row">
                                                        <div class="col-lg-12 mb-2">
                                                            <input type="text" class="form-control" name="nome_site" value="{{ getConfig('nome_site') }}" placeholder="Nome do site">
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <textarea class="form-control" name="descricao_site" placeholder="Descrição do site">
                                                                {{ getConfig('descricao_site') }}
                                                            </textarea>
                                                            <button class="btn btn-outline-primary mt-2">Guardar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-lg-6">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-between">
                                                <div class="header-title">
                                                    <h4 class="card-title">Meta Tags</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate,
                                                    ex ac
                                                    venenatis mollis, diam
                                                    nibh finibus leo</p>
                                                <form method="POST" id="info_meta_tags">
                                                    <div class="row">
                                                        <div class="col-lg-12 mb-2">
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-primary"
                                                                        type="button">Autor</button>
                                                                </div>
                                                                <input type="text" class="form-control" name="meta_autor" value="{{ getConfig('meta_autor') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 mb-2">
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-primary"
                                                                        type="button">Keywords</button>
                                                                </div>
                                                                <input type="text" class="form-control" name="meta_keywords" value="{{ getConfig('meta_keywords') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 mb-2">
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-primary"type="button">Robots</button>
                                                                </div>
                                                                <input type="text" class="form-control" name="meta_robots" value="{{ getConfig('meta_robots') }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 mb-2">
                                                            <div class="input-group mb-4">
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-primary"
                                                                        type="button">Desc</button>
                                                                </div>
                                                                <textarea type="text" class="form-control" rows="2" name="meta_description">
                                                                    {{ getConfig('meta_description') }}
                                                                </textarea>
                                                            </div>
                                                                <button class="btn btn-outline-primary mt-2">Guardar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="permissoes" role="tabpanel"
                                aria-labelledby="permissoes-tab-justify">
                                <div class="row">
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="card">
                                            <div class="card-header d-flex justify-content-between">
                                                <div class="header-title">
                                                    <h4 class="card-title">Sistema</h4>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <form>
                                                    <div class="row">
                                                        <div class="col-lg-12 mb-2">
                                                            <div
                                                                class="custom-control custom-switch custom-switch-icon custom-control-inline">
                                                                <div class="custom-switch-inner d-flex align-items-center">
                                                                    <p class="me-2 mb-0">Permitir criar conta no sistema
                                                                    </p>
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="swicth_criar_conta" checked="">
                                                                    <label class="custom-control-label ml-4"
                                                                        for="swicth_criar_conta">
                                                                        <span class="switch-icon-left"><i
                                                                                class="fa fa-check"></i></span>
                                                                        <span class="switch-icon-right"><i
                                                                                class="fa fa-check"></i></span>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="custom-control custom-switch custom-switch-icon custom-control-inline">
                                                                <div class="custom-switch-inner d-flex align-items-center">
                                                                    <p class="me-2 mb-0">Permitir recuperar conta no
                                                                        sistema</p>
                                                                    <input type="checkbox" class="custom-control-input"
                                                                        id="swicth_recuperar_conta" checked="">
                                                                    <label class="custom-control-label ml-4"
                                                                        for="swicth_recuperar_conta">
                                                                        <span class="switch-icon-left"><i
                                                                                class="fa fa-check"></i></span>
                                                                        <span class="switch-icon-right"><i
                                                                                class="fa fa-check"></i></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile-justify" role="tabpanel"
                                aria-labelledby="profile-tab-justify">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                            <div class="tab-pane fade" id="contact-justify" role="tabpanel"
                                aria-labelledby="contact-tab-justify">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#info_meta_tags').submit(function(e) {
                e.preventDefault();

                // Serializa os dados do formulário
                var formData = $('#info_meta_tags').serializeArray();

                // Itera sobre os dados serializados
                $.each(formData, function(index, field) {
                    // Envia os dados para a função setConfig
                    setConfig(field.name, field.value);
                });
            });

            $('#info_basica').submit(function(e) {
                e.preventDefault();

                // Serializa os dados do formulário
                var formData = $('#info_basica').serializeArray();

                // Itera sobre os dados serializados
                $.each(formData, function(index, field) {
                    // Envia os dados para a função setConfig
                    setConfig(field.name, field.value);
                });
            });

            $('#swicth_criar_conta').change(function() {
                var isChecked = $(this).prop('checked'); // Verifica se o checkbox está marcado

                // Envia o estado do checkbox via AJAX para a rota especificada
                setConfig('criar_conta', isChecked);
            });

            $('#swicth_recuperar_conta').change(function() {
                var isChecked = $(this).prop('checked'); // Verifica se o checkbox está marcado swicth_recuperar_conta

                // Envia o estado do checkbox via AJAX para a rota especificada
                setConfig('recuperar_conta', isChecked);
            });
        });
    </script>
@endsection
