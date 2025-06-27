@extends('layout.app')

@section('titulo', 'Adicionar Qtd Estoque')

@section('content')
<div class="content">
    @include('partials.session')
    <div class="row">
        @if (Auth::user()->username == "adriano.lata")
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('estoque._store_stock', ['id' => $area]) }}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-heading">
                                        <h4>Configurar Item</h4>
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
                                                        <th>Crítico</th>
                                                        <th>Mínimo</th>
                                                        <th>Médio</th>
                                                        <th>Máximo</th>
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
                                                            <input type="number" name="critico" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="number" name="minimo" class="form-control">
                                                        </td>
                                                        <td>
                                                        <input type="number" name="medio" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="number" name="maximo" class="form-control">
                                                        </td>
                                                        <td class="add-remove text-end">
                                                            <a href="javascript:void(0);" class="btn-add-inp me-2">
                                                                <i class="fas fa-plus-circle"></i>
                                                            </a>
                                                            <a href="javascript:void(0);" class="remove-btn" style="display: none;">
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
        @endif
        <div class="col-sm-12">
            <div class="d-flex justify-content-end align-items-center mb-2" style="position:relative;z-index:2;">
                <button id="btn-refresh-table" class="btn btn-outline-primary btn-sm" type="button">
                    <i class="fas fa-sync-alt"></i> Atualizar
                </button>
            </div>
            <div class="card card-table show-entire">
                <div class="card-body">
                    <div class="table-responsive position-relative" id="table-produto-container">
                        <div id="table-loader-overlay" style="display:none; position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.7); z-index:10; display:flex; align-items:center; justify-content:center;">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Carregando...</span>
                            </div>
                        </div>
                        <table class="table border-0 custom-table comman-table datatable mb-0 table-produto"
                            id="table-c">
                            <thead>
                                <tr>
                                    <th>Designação</th>
                                    <th>Dosagem</th>
                                    <th>Estado Atual</th>
                                    <th>Qtd. Restante</th>
                                    <th>Crítico</th>
                                    <th>Mínimo</th>
                                    <th>Data Expiração</th>
                                    <th>Ações</th> <!-- NOVO -->
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal de Edição dos Estados -->
<div class="modal fade" id="modal-editar-estados" tabindex="-1" aria-labelledby="modal-editar-estados-label" aria-hidden="true">
  <div class="modal-dialog">
    <form id="form-editar-estados">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-editar-estados-label">Editar Estados do Estoque</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="edit-row-id">
          <div class="mb-3">
            <label for="edit-item-nome" class="form-label">Item</label>
            <input type="text" class="form-control" id="edit-item-nome" name="item_nome" disabled>
          </div>
          <div class="mb-3">
            <label for="edit-critico" class="form-label">Crítico</label>
            <input type="number" class="form-control" id="edit-critico" name="critico" required>
          </div>
          <div class="mb-3">
            <label for="edit-minimo" class="form-label">Mínimo</label>
            <input type="number" class="form-control" id="edit-minimo" name="minimo" required>
          </div>
          <div class="mb-3">
            <label for="edit-medio" class="form-label">Médio</label>
            <input type="number" class="form-control" id="edit-medio" name="medio" required>
          </div>
          <div class="mb-3">
            <label for="edit-maximo" class="form-label">Máximo</label>
            <input type="number" class="form-control" id="edit-maximo" name="maximo" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
    // Torna generateUniqueId global
    function generateUniqueId() {
        return 'select-' + Math.random().toString(36).substr(2, 9);
    }

    $(document).ready(function() {
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
                '<td class="add-remove text-end">' +
                '<a href="javascript:void(0);" class="btn-add-inp me-2"><i class="fas fa-plus-circle"></i></a> ' +
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

        var table = $('#table-c').DataTable({
            ajax: {
                "url": "/api/status_produto/6",
                "data": function(d) {
                    d.status = $('#filtro-status').val();
                },
                "dataSrc": function(json) {
                    if (!json || typeof json !== 'object') {
                        showTableError('Erro: resposta inesperada do servidor.');
                        return [];
                    }
                    if (json.data === undefined) {
                        showTableError('Erro: dados não encontrados.');
                        return [];
                    }
                    return json.data;
                },
                "error": function(xhr, status, error) {
                    showTableError('Erro ao carregar dados: ' + (xhr.responseText || error || status));
                }
            },
            "columns": [
                { "data": row => row.produto?.designacao ?? '--' }, // Designação
                { "data": row => row.produto?.dosagem ?? '--' }, // Dosagem
                {
                    "data": row => {
                        let saldo = row.produto?.saldo?.qtd ?? 0;
                        if (saldo <= 0) return '<span class="badge bg-dark">Estoque 0</span>';
                        if (saldo <= row.critico) return '<span class="badge bg-danger">Crítico</span>';
                        if (saldo <= row.minimo) return '<span class="badge bg-warning">Mínimo</span>';
                        if (saldo <= row.medio) return '<span class="badge bg-info">Médio</span>';
                        return '<span class="badge bg-success">Estável</span>';
                    }
                }, // Estado Atual
                { "data": row => row.produto?.saldo?.qtd ?? '--' }, // Qtd. Restante
                { "data": row => row.critico ?? '--' }, // Crítico
                { "data": row => row.minimo ?? '--' }, // Mínimo
                { "data": row => row.produto?.data_expiracao ? formatDate(row.produto.data_expiracao) : '--' }, // Data Expiração
                {
                    "data": function(row, type, set, meta) {
                        // Inclui o nome do item como data-item-nome
                        return `
                            <div class="dropdown">
                                <button class="btn btn-link btn-sm text-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#" class="dropdown-item btn-editar-estados"
                                            data-row-id="${row.id}"
                                            data-critico="${row.critico ?? ''}"
                                            data-minimo="${row.minimo ?? ''}"
                                            data-medio="${row.medio ?? ''}"
                                            data-maximo="${row.maximo ?? ''}"
                                            data-item-nome="${row.produto?.designacao ?? ''}">
                                            Editar
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        `;
                    },
                    "orderable": false,
                    "searchable": false
                }
            ],
            "language": {
                "search": "Filtrar resultados:",
                "zeroRecords": "Nenhum resultado encontrado",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
                "infoFiltered": "(filtrado de _MAX_ entradas no total)",
                "lengthMenu": "Mostrar _MENU_ entradas",
                "paginate": {
                    "first": "Primeiro",
                    "last": "Último",
                    "next": "Próximo",
                    "previous": "Anterior"
                }
            },
            "preXhr": function() {
                $('#table-loader-overlay').fadeIn(150);
                clearTableError();
            },
            "xhr": function() {
                $('#table-loader-overlay').fadeOut(150);
            },
        });

        // Loader overlay: sempre some ao finalizar carregamento, erro ou sucesso
        $('#table-c').on('processing.dt', function(e, settings, processing) {
            if(processing) {
                $('#table-loader-overlay').fadeIn(150);
            } else {
                $('#table-loader-overlay').fadeOut(150);
            }
        });

        function showTableError(msg) {
            var colspan = $('#table-c thead th').length;
            $('#table-c tbody').html('<tr><td colspan="'+colspan+'" class="text-center text-danger">'+msg+'</td></tr>');
            $('#table-loader-overlay').fadeOut(150);
        }
        function clearTableError() {
            $('#table-c tbody .text-danger').remove();
        }

        // Botão para atualizar a tabela
        $('#btn-refresh-table').on('click', function() {
            table.ajax.reload();
        });

        // Quando o usuário mudar o filtro, recarregar os dados
        $('#filtro-status').on('change', function() {
            let status = $(this).val();
            //console.log("Enviando status para API:", status); // Confirme se o valor está correto
            table.ajax.reload();
        });
    });

    function formatDate(dateString) {
        var date = new Date(dateString);
        var day = String(date.getDate()).padStart(2, '0');
        var month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based
        var year = date.getFullYear();
        return `${day}-${month}-${year}`;
    }

    function fetchAndPopulateSelectArea(id_def) {
        $.ajax({
            url: '/api/get/areas_hospitalares/def/' + id_def,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#area_id_').empty(); // Limpa as opções anteriores

                // Filtra apenas a área "Armazém I"
                let areaSelecionada = data.find(item => item.area_hospitalar.nome === "Armazém I");

                if (areaSelecionada) {
                    $('#area_id_').append($('<option>', {
                        value: areaSelecionada.area_hospitalar_id,
                        text: areaSelecionada.area_hospitalar.nome,
                        selected: true
                    }));

                    // Criar um input hidden para garantir o envio no formulário
                    if (!$('#area_id_hidden').length) {
                        $('<input>').attr({
                            type: 'hidden',
                            id: 'area_id_hidden',
                            name: 'area_para',
                            value: areaSelecionada.area_hospitalar_id
                        }).appendTo('form'); // Adiciona dentro do form
                    } else {
                        $('#area_id_hidden').val(areaSelecionada.area_hospitalar_id);
                    }

                    // Dispara o evento change para simular a seleção automática
                    $('#area_id_').trigger('change');

                    // Desativa o select para evitar alterações
                    $('#area_id_').prop('disabled', true);

                    // Simula a ação após a seleção
                    var newSelect = $("#" + generateUniqueId());
                    newSelect.select2();

                    fetchAndPopulateSelect(areaSelecionada.area_hospitalar_id, newSelect);
                } else {
                    $('#area_id_').append('<option disabled selected>Nenhuma área encontrada</option>');
                }
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
                    // Verifica se item.produto.status_stock.produto_id existe
                    if (!item.produto.status_stock?.produto_id) {
                        targetSelect.append($('<option>', {
                            value: item.id,
                            text: item.produto.designacao + " [" + item.produto.dosagem + "]" + " - " + item.produto.forma
                        }));
                    }
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

    // Evento para abrir modal ao clicar em editar
    $(document).on('click', '.btn-editar-estados', function(e) {
        e.preventDefault();
        $('#edit-row-id').val($(this).data('row-id'));
        $('#edit-critico').val($(this).data('critico'));
        $('#edit-minimo').val($(this).data('minimo'));
        $('#edit-medio').val($(this).data('medio'));
        $('#edit-maximo').val($(this).data('maximo'));
        $('#edit-item-nome').val($(this).data('item-nome'));
        $('#modal-editar-estados').modal('show');
    });

    // Evento submit do form do modal
    $('#form-editar-estados').on('submit', function(e) {
        e.preventDefault();
        let rowId = $('#edit-row-id').val();
        let critico = $('#edit-critico').val();
        let minimo = $('#edit-minimo').val();
        let medio = $('#edit-medio').val();
        let maximo = $('#edit-maximo').val();
        // Atualiza localmente na tabela (você pode adaptar para AJAX)
        let rowIdx = table.rows().eq(0).filter(function(idx) {
            return table.row(idx).data().id == rowId;
        });
        if(rowIdx.length){
            let data = table.row(rowIdx[0]).data();
            data.critico = critico;
            data.minimo = minimo;
            data.medio = medio;
            data.maximo = maximo;
            table.row(rowIdx[0]).data(data).draw(false);
        }
        $('#modal-editar-estados').modal('hide');
    });
</script>
@endsection
