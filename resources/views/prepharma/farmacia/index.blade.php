@extends('prepharma.layout.app')

@section('titulo', 'Farmácias')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('a_h.index') }}">Áreas Hospitalares</a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Ver todas</li>
                    </ul>
                </div>
            </div>
        </div>
        @include('partials.session')

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table show-entire">
                    <div class="card-body">
                        <div class="page-table-header mb-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="doctor-table-blk">
                                        <h3>Farmácias</h3>
                                        <div class="doctor-search-blk mt-2">
                                            <div class="top-nav-search table-search-blk">
                                                <form id="form_search" method="POST">
                                                    <input type="text" id="search-table"
                                                        class="form-control outline-success" placeholder="Procure aqui">
                                                    <a class="btn">
                                                        <img src="{{ assetr('assets/img/icons/search-normal.svg') }}" alt>
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @include('estoque.modalAddProduto')
                            </div>
                            <div class="col-auto text-end float-end ms-auto download-grp">
                                <a href="#" id="imprimir-pagina" target="_blank" class=" me-2">
                                    <img src="{{ assetr('assets/img/icons/pdf-icon-01.svg') }}" alt>
                                </a>
                                <a href="javascript:;" class=" me-2"><img
                                        src="{{ assetr('assets/img/icons/pdf-icon-02.svg') }}" alt></a>
                                <a href="javascript:;" class=" me-2"><img
                                        src="{{ assetr('assets/img/icons/pdf-icon-03.svg') }}" alt></a>
                                <a href="javascript:;" id="alert"><img
                                        src="{{ assetr('assets/img/icons/pdf-icon-04.svg') }}" alt></a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table border-0 custom-table comman-table datatable mb-0 table-prateleiras"
                            id="table-p">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Código</th>
                                    <th>Status</th>
                                    <th>Gerente</th>
                                    <th>Categoria</th>
                                    <th>Endereço</th>
                                    <th>OBS</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody class="ligth-body">
                                @foreach ($farmacias as $farmacia)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    {{ $farmacia->nome }}
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $farmacia->codigo }}</td>
                                        <td>
                                            @if ($farmacia->status)
                                                Ativa
                                            @else
                                                Inativa
                                            @endif
                                        </td>
                                        <td>
                                            @if (!$farmacia->gerente)
                                                Não definido
                                            @else
                                                {{ $farmacia->gerente->user->nome }}
                                            @endif
                                        </td>
                                        <td>{{ @$farmacia->categoria->nome }}</td>
                                        <td>{{ $farmacia->endereco }}</td>
                                        <td>{{ $farmacia->obs }}</td>
                                        <td>
                                            <div class="d-flex align-items-center list-action">
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-primary rounded-circle d-inline-flex align-items-center justify-content-center me-2"
                                                    style="width:36px; height:36px; padding:0;"
                                                    onclick="visualizarFarmacia({{ $farmacia->id }})" data-toggle="tooltip"
                                                    data-bs-toggle="tooltip" title="Ver {{ $farmacia->nome }}"
                                                    aria-label="Ver {{ $farmacia->nome }}">
                                                    <i class="ri-eye-line"></i>
                                                    <span class="visually-hidden">Ver</span>
                                                </button>

                                                <button type="button"
                                                    class="btn btn-sm btn-success rounded-circle d-inline-flex align-items-center justify-content-center me-2"
                                                    style="width:36px; height:36px; padding:0;"
                                                    onclick="getDataFarma('{{ route('farmacia.get', ['id' => $farmacia->id]) }}')"
                                                    data-toggle="tooltip" data-bs-toggle="tooltip"
                                                    title="Editar {{ $farmacia->nome }}"
                                                    aria-label="Editar {{ $farmacia->nome }}">
                                                    <i class="ri-pencil-line"></i>
                                                    <span class="visually-hidden">Editar</span>
                                                </button>

                                                <button type="button"
                                                    class="btn btn-sm btn-info rounded-circle d-inline-flex align-items-center justify-content-center me-2"
                                                    style="width:36px; height:36px; padding:0;"
                                                    onclick="preencherModalComFarmacia('{{ route('farmacia.get', ['id' => $farmacia->id]) }}')"
                                                    data-toggle="tooltip" data-bs-toggle="tooltip"
                                                    title="Detalhes {{ $farmacia->nome }}"
                                                    aria-label="Detalhes {{ $farmacia->nome }}">
                                                    <i class="ri-bubble-chart-line"></i>
                                                    <span class="visually-hidden">Detalhes</span>
                                                </button>

                                                <button type="button"
                                                    class="btn btn-sm btn-danger rounded-circle d-inline-flex align-items-center justify-content-center"
                                                    style="width:36px; height:36px; padding:0;"
                                                    onclick="modalEliminarFarmacia('{{ $farmacia->id }}')"
                                                    data-toggle="tooltip" data-bs-toggle="tooltip"
                                                    title="Eliminar {{ $farmacia->nome }}"
                                                    aria-label="Eliminar {{ $farmacia->nome }}">
                                                    <i class="ri-delete-bin-line"></i>
                                                    <span class="visually-hidden">Eliminar</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    @include('prepharma.modals._viewFarmacia')
    @include('prepharma.modals._addGerenteFarmacia')
    @include('prepharma.modals._editarFarmacia')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Page loaded, scripts ready');
        });

        function visualizarFarmacia(id) {
            console.log('Clicou para ver farmácia ID:', id);

            var url = '/farmacia/get/' + id;
            console.log('URL da requisição:', url);

            jQuery.get(url)
                .done(function(data) {
                    console.log('Dados recebidos:', data);

                    // Preencher logo
                    var logoSrc = "{{ assetr('assets/img/icons/pharmacy-default.svg') }}";
                    if (data.logo) {
                        logoSrc = "{{ url('storage') }}/" + data.logo;
                    }
                    jQuery('#modalViewFarmacia #view_logo').attr('src', logoSrc);

                    // Preencher dados básicos
                    jQuery('#modalViewFarmacia #view_nome').text(data.nome || 'Sem nome');
                    jQuery('#modalViewFarmacia #view_codigo').text(data.codigo || 'Sem código');

                    // Status com badge
                    var statusHtml = data.status ?
                        '<span class="badge bg-success">Ativa</span>' :
                        '<span class="badge bg-danger">Inativa</span>';
                    jQuery('#modalViewFarmacia #view_status').html(statusHtml);

                    // Gerente
                    var gerenteText = '-';
                    if (data.gerente && data.gerente.user) {
                        gerenteText = data.gerente.user.nome;
                    }
                    jQuery('#modalViewFarmacia #view_gerente').text(gerenteText);

                    // Categoria
                    jQuery('#modalViewFarmacia #view_categoria').text(data.categoria ? data.categoria.nome : '-');

                    // Outros campos
                    jQuery('#modalViewFarmacia #view_endereco').text(data.endereco || '-');
                    jQuery('#modalViewFarmacia #view_obs').text(data.obs || '-');
                    jQuery('#modalViewFarmacia #view_descricao').text(data.descricao || '-');

                    // Botão editar
                    jQuery('#modalViewFarmacia #view_editar_btn').attr('href', '/farmacia/' + id + '/edit');

                    // Mostrar modal
                    jQuery('#modalViewFarmacia').modal('show');
                })
                .fail(function(xhr, status, error) {
                    console.error('Erro na requisição:', {
                        status: status,
                        error: error,
                        responseText: xhr.responseText
                    });
                    alert('Erro ao obter dados da farmácia: ' + error);
                });
        }

        function preencherModalComFarmacia(url) {
            jQuery.get(url)
                .done(function(data) {
                    jQuery('#farmacia_id').val(data.id);
                    jQuery('#nome_farmacia').val(data.nome);
                    jQuery('#addGerenteFarmacia').modal('show');
                })
                .fail(function() {
                    alert('Erro ao carregar dados para gerente');
                });
        }

        function modalEliminarFarmacia(id) {
            jQuery('#deleteFormFarmacia').attr('action', '/farmacia/apagar/' + id);
            jQuery('#texto-aviso').text('Tem certeza que deseja eliminar esta farmácia?');
            jQuery('#modalEliminarFarmacia').modal('show');
        }

        function getDataFarma(url) {
            jQuery.get(url)
                .done(function(data) {
                    jQuery('#id_farmacia').val(data.id);
                    jQuery('#nome_farmacia').val(data.nome);
                    jQuery('#endereco').val(data.endereco);
                    jQuery('#descricao').val(data.descricao);
                    jQuery('#modalEditarFarmacia').modal('show');
                })
                .fail(function() {
                    alert('Erro ao carregar dados para edição');
                });
        }
    </script>

@endsection
