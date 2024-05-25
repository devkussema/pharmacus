@extends('layout.app')

@section('titulo', 'Áreas Hospitalares')

@section('content')
    <div class="content">
        @include('partials.session')
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Áreas Hospitalares</a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Ver todas</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table show-entire">
                    <div class="card-body">

                        <div class="page-table-header mb-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="doctor-table-blk">
                                        <h3>Todas Áreas Hospitalares</h3>
                                        <div class="doctor-search-blk">
                                            <div class="top-nav-search table-search-blk">
                                                <form>
                                                    <input type="text" id="search-table" class="form-control"
                                                        placeholder="Procure aqui">
                                                    <a class="btn">
                                                        <img src="{{ assetr('assets/img/icons/search-normal.svg') }}" alt>
                                                    </a>
                                                </form>
                                            </div>
                                            <div class="add-group">
                                                <a data-bs-toggle="modal" data-bs-target="#AddAH" href="javascript:void(0)"
                                                    class="btn btn-primary add-pluss ms-2">
                                                    <img src="{{ assetr('assets/img/icons/plus.svg') }}" alt>
                                                </a>
                                                <a href="javascript:;" class="btn btn-primary doctor-refresh ms-2"><img
                                                        src="{{ assetr('assets/img/icons/re-fresh.svg') }}" alt></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="javascript:;" class=" me-2"><img
                                            src="{{ assetr('assets/img/icons/pdf-icon-01.svg') }}" alt></a>
                                    <a href="javascript:;" class=" me-2"><img
                                            src="{{ assetr('assets/img/icons/pdf-icon-02.svg') }}" alt></a>
                                    <a href="javascript:;" class=" me-2"><img
                                            src="{{ assetr('assets/img/icons/pdf-icon-03.svg') }}" alt></a>
                                    <a href="javascript:;"><img src="{{ assetr('assets/img/icons/pdf-icon-04.svg') }}"
                                            alt></a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table border-0 custom-table comman-table datatable mb-0" id="table-content">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" value="something">
                                            </div>
                                        </th>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ah as $a)
                                        <tr>
                                            <td>
                                                <div class="checkbox d-inline-block">
                                                    <input type="checkbox" class="checkbox-input" id="checkbox2">
                                                    <label for="checkbox2" class="mb-0"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <a
                                                    href="{{ route('estoque.getEstoque', ['id' => $a->area_hospitalar->id]) }}">
                                                    {{ $a->area_hospitalar->nome }}
                                                </a>
                                            </td>
                                            <td>{{ $a->area_hospitalar->descricao }}</td>
                                            <td class="text-end">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-expanded="false"><i
                                                            class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        @if (isCargo('Gerente'))
                                                            <a class="dropdown-item" href="javascript:void(0)"
                                                                onclick="modalAddCargoAH('{{ $a->area_hospitalar->id }}')">
                                                                <i class="fa-solid fa-pen-to-square m-r-5"></i>
                                                                Adicionar Responsável
                                                            </a>
                                                        @endif
                                                        <a class="dropdown-item" href="javascript:void(0)"
                                                            onclick="modalEditarAH('{{ $a->area_hospitalar->id }}')">
                                                            <i class="fa-solid fa-pen-to-square m-r-5"></i>
                                                            Editar
                                                        </a>
                                                    </div>
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

        {{-- Modal para add área --}}
        <div class="modal fade" id="AddAH" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="tituloModal">Adicionar Cargo</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formAddAH" method="POST" action="{{ route('a_h.index.store') }}">
                            @csrf
                            <div class="pb-3">
                                <label class="mb-2">Nome *</label>
                                @php
                                $farmacia_ = auth()->user()->isFarmacia->farmacia ?? auth()->user()->farmacia->farmacia;
                                    if ($farmacia_) {
                                        // Se o usuário autenticado estiver associado a uma farmácia,
                                        // obtemos os IDs das áreas hospitalares dessa farmácia
                                        $areas_hospitalares_ids = $farmacia_->areas_hospitalares->pluck('area_hospitalar_id');
                                    }
                                    // Convertendo a coleção em um array se necessário
                                    $areas_hospitalares_ids_array = $areas_hospitalares_ids->all();
                                @endphp
                                <select name="area_id" style="width: 100%" class="js-example-basic-single select2">
                                    @foreach (\App\Models\AreaHospitalar::all() as $ahs)
                                        @if (!in_array($ahs->id, $areas_hospitalares_ids_array))
                                            <option value="{{ $ahs->id }}">{{ $ahs->nome }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <input type="hidden" name="farmacia_id"
                                    value="{{ $farmacia_->id }}">
                            </div>
                            {{-- <div class="pb-3">
                                <label class="mb-2">Descrição (opcional)</label>
                                <textarea class="form-control" placeholder="Descrição da área" name="descricao"></textarea>
                            </div> --}}
                            <div class="col-lg-12 mt-4">
                                <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                    <button class="btn rounded-pill btn-primary" type="submit">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal para add responsável --}}
        <div class="modal fade" id="AddCargoAH" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="tituloModal">Adicionar Área Hospitalar</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formAddCargoAH" method="POST" action="{{ route('a_h.addCargo') }}">
                            @csrf
                            <div class="pb-3">
                                <label class="mb-2" for="email_">Email *</label>
                                <input type="email" id="email_" class="form-control" placeholder=""
                                    name="email">
                                <input type="hidden" id="area_hospitalar_id" class="form-control" placeholder=""
                                    name="area_id">
                                <input type="hidden" value="{{ $farmacia_->id }}"
                                    class="form-control" placeholder="" name="farmacia_id">
                            </div>
                            <div class="pb-3">
                                <label class="mb-2" for="cargo_">Cargo *</label>
                                <select name="cargo_id" id="cargo_" class="form-control">
                                    @foreach (\App\Models\Cargo::all() as $cargo)
                                        <option value="{{ $cargo->id }}">{{ $cargo->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="pb-3">
                                <label class="mb-2" for="telefone_">Telefone *</label>
                                <input type="text" id="telefone_" class="form-control" placeholder=""
                                    name="contato">
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                    <button class="btn rounded-pill btn-primary" type="submit">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal para editar área h --}}
        <div class="modal fade" id="EditarAH" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="tituloModal">Editar Área Hospitalar</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditarAH" method="POST" action="#" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="pb-3">
                                <label class="mb-2">Nome *</label>
                                <input type="text" class="form-control" id="nome" placeholder="Nome da área"
                                    name="nome">

                            </div>
                            <div class="pb-3">
                                <label class="mb-2">Descrição (opcional)</label>
                                <textarea class="form-control" id="descricao" placeholder="Descrição da área" name="descricao"></textarea>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                    <button class="btn rounded-pill btn-primary" type="submit">Enviar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var table = document.getElementById('dt_areas_h').DataTable({
                searching: true,
                language: {
                    search: ''
                }
            });

            // Adicione o evento de digitação no input
            var areaDtInput = document.getElementById('area_dt');
            areaDtInput.addEventListener('keyup', function() {
                table.search(this.value).draw();
            });
        });

        function modalAddCargoAH(area_id) {
            $('#AddCargoAH h4#tituloModal').val(area_id);
            $('#AddCargoAH #area_hospitalar_id').val(area_id);
            $('#AddCargoAH').modal('show');
        }

        function modalEditarAH(id) {
            // RequisiÃ§Ã£o AJAX para buscar os dados da farmÃ¡cia
            $.ajax({
                url: 'api/get/area_hospitalar/' + id,
                type: 'GET',
                success: function(response) {
                    $('#formEditarAH').attr('action', 'areas_hospitalares/a_h/' + id);
                    $('h4#nome_area').val(response.nome);
                    $('#formEditarAH #nome').val(response.nome);
                    $('#formEditarAH #descricao').val(response.descricao);

                    // Exibir o modal
                    $('#EditarAH').modal('show');
                },
                error: function(xhr, status, error) {
                    // Tratar erros, se necessÃ¡rio
                    //console.error(xhr.responseText);
                    toastr.error("Erro ao obter dados da Ãrea Hospitalar", 'Erro');
                }
            });
        }
    </script>
@endsection
