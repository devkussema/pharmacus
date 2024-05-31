@extends('layout.app')

@section('titulo', 'Solicitar Item')

@section('content')
    <div class="content">
        @include('partials.session')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('estoque.dar_baixa', ['area_de' => $area]) }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-heading">
                                        <h4>Solicitar Item</h4>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="input-block local-forms">
                                        <label for="nome_requisitante_id">Nome Requisitante <span
                                                class="login-danger">*</span></label>
                                        <input id="nome_requisitante_id" class="form-control"
                                            value="{{ Auth::user()->nome }}" type="text" disabled>
                                        <input type="hidden" name="id_user" hidden value="{{ Auth::user()->id }}">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-6">
                                    <div class="input-block local-forms">
                                        <label for="area_id_">Selecionar Área <span class="login-danger">*</span></label>
                                        <select class="js-example-basic-single form-control" id="area_id_"
                                            name="area_para">
                                            <option selected disabled>Selecionar Área Hospitalar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-xl-12">
                                    {{-- <div class="input-block local-forms">
                                        <label for="select-itens">Escolher Itens <span class="login-danger">*</span></label>
                                        <select id="select-itensa" class="js-example-basic-multiple form-control"
                                            name="itens[]" multiple="multiple">
                                        </select>
                                    </div> --}}
                                    <div class="invoice-add-table">
                                        <h4>Escolher Itens</h4>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-nowrap  mb-0 no-footer add-table-items">
                                                <thead>
                                                    <tr>
                                                        <th>Medicamento e Material Gastável</th>
                                                        <th>Gastos</th>
                                                        <th>Existência</th>
                                                        <th>Quantidade Pedida</th>
                                                        <th>Qualidade Disponibilizada</th>
                                                        <th>Data de Expiração</th>
                                                        <th>Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="add-row">
                                                        <td>
                                                            <select id="select-itens"
                                                                class="js-example-basic-single form-control"
                                                                name="itens[]">
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control">
                                                        </td>
                                                        <td class="add-remove text-end">
                                                            <a href="javascript:void(0);" class="btn-add-inp me-2">
                                                                <i class="fas fa-plus-circle"></i>
                                                            </a>
                                                            <a href="#" class="copy-btn me-2">
                                                                <i class="fas fa-copy"></i>
                                                            </a>
                                                            <a href="javascript:void(0);" class="remove-btn">
                                                                <i class="fa fa-trash-alt"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                        <button class="btn rounded-pill btn-primary" type="submit">Enviar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function generateUniqueId() {
                return 'select-' + Math.random().toString(36).substr(2, 9);
            }
            $(document).on("click", ".btn-add-inp", function() {
                var uniqueId = generateUniqueId();
                var newRow = '<tr class="add-row">' +
                    '<td>' +
                    '<select id="' + uniqueId +
                    '" class="js-example-basic-single form-control" name="itens[]"></select>' +
                    '</td>' +
                    '<td>' +
                    '<input type="text" class="form-control">' +
                    '</td>' +
                    '<td><input type="text" class="form-control"></td>' +
                    '<td><input type="text" class="form-control"></td>' +
                    '<td><input type="text" class="form-control"></td>' +
                    '<td><input type="text" class="form-control"></td>' +
                    '<td class="add-remove text-end">' +
                    '<a href="javascript:void(0);" class="btn-add-inp me-2"><i class="fas fa-plus-circle"></i></a> ' +
                    '<a href="#" class="copy-btn me-2"><i class="fas fa-copy"></i></a>' +
                    '<a href="javascript:void(0);" class="remove-btn"><i class="fa fa-trash-alt"></i></a>' +
                    '</td>' +
                    '</tr>';

                $(".add-table-items tbody").append(newRow);

                var newSelect = $("#" + uniqueId);
                newSelect.select2();

                var selectedArea = $('#area_id_').val();
                if (selectedArea) {
                    fetchAndPopulateSelect(selectedArea, newSelect);
                }

                return false;
            });
            $('.js-example-basic-multiple').select2({
                theme: "classic"
            });
            $('.js-example-basic-single').select2();
        });

        function fetchAndPopulateSelectArea(id_def) {
            $.ajax({
                url: '/api/get/areas_hospitalares/def/' + id_def,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Limpa as options existentes antes de adicionar novas
                    //$('#area_id_').empty();
                    // Itera sobre os itens e adiciona as options ao select
                    $.each(data, function(index, item) {
                        $('#area_id_').append($('<option>', {
                            value: item.area_hospitalar_id,
                            text: item.area_hospitalar.nome
                        }));
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao buscar itens:', error);
                }
            });
        }

        // Função para popular o select de itens
        function fetchAndPopulateSelect(id, targetSelect) {
            var endpoint = '/api/produtos/' + id;

            $.ajax({
                url: endpoint,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    targetSelect.empty();
                    var sortedData = data.data.sort(function(a, b) {
                        return a.produto.designacao.localeCompare(b.produto.designacao);
                    });
                    $.each(sortedData, function(index, item) {
                        targetSelect.append($('<option>', {
                            value: item.id,
                            text: item.produto.designacao
                        }));
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao buscar itens:', error);
                }
            });
        }

        $(document).ready(function() {
            var areaId = $('meta[name="area_id_"]').attr('content');
            // Chama a função para buscar os itens e popular o select
            fetchAndPopulateSelectArea(areaId);

            // Adiciona um ouvinte de evento para o evento de mudança no select
            $('#area_id_').on('change', function() {
                var selectedValue = $(this).val();
                fetchAndPopulateSelect(selectedValue, $('#select-itens'));
            });
        });
    </script>
@endsection
