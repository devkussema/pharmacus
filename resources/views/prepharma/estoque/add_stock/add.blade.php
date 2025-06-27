@extends('layout.app')

@section('titulo', 'Adicionar Qtd Estoque')

@section('content')
    <div class="content">
        @include('partials.session')
        <div class="row">
            @if (Auth::user()->username == 'adriano.lata')
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
                                            <label for="area_id_">Selecionar Área <span
                                                    class="login-danger">*</span></label>
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
                                                <table
                                                    class="table table-striped table-nowrap  mb-0 no-footer add-table-items">
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
                                                                <a href="javascript:void(0);" class="remove-btn"
                                                                    style="display: none;">
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
                <div class="card card-table show-entire">
                    <div class="card-body">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-3" style="margin-top:-10px; justify-content: flex-end;">
                            <div class="d-flex flex-wrap align-items-center gap-2" style="background:transparent;">
                                <input id="global-search" type="text" class="form-control form-control-sm rounded-pill" style="max-width:200px; min-width:140px;" placeholder="Buscar...">
                                <button id="btn-export-excel" class="btn btn-success btn-sm rounded-pill d-flex align-items-center gap-1" type="button"><i class="fas fa-file-excel"></i></button>
                                <button id="btn-export-pdf" class="btn btn-danger btn-sm rounded-pill d-flex align-items-center gap-1" type="button"><i class="fas fa-file-pdf"></i></button>
                                <button id="btn-print-table" class="btn btn-secondary btn-sm rounded-pill d-flex align-items-center gap-1" type="button"><i class="fas fa-print"></i></button>
                                <button id="btn-refresh-table" class="btn btn-outline-primary btn-sm rounded-pill d-flex align-items-center gap-1" type="button"><i class="fas fa-sync-alt"></i> Atualizar</button>
                            </div>
                        </div>
                        <div class="table-responsive position-relative" id="table-produto-container">
                            <div id="table-loader-overlay"
                                style="display:none; position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.7); z-index:10; display:flex; align-items:center; justify-content:center;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Carregando...</span>
                                </div>
                            </div>
                            <table class="table border-0 custom-table comman-table datatable mb-0 table-produto align-middle"
                                id="table-c">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" style="width:36px;"><input type="checkbox" id="select-all-rows">
                                        </th>
                                        <th data-bs-toggle="tooltip" title="Nome do medicamento/material.">Designação <i
                                                class="fas fa-info-circle text-muted"></i></th>
                                        <th data-bs-toggle="tooltip" title="Dosagem do produto.">Dosagem <i
                                                class="fas fa-info-circle text-muted"></i></th>
                                        <th data-bs-toggle="tooltip" title="Situação do estoque em tempo real.">Estado Atual <i
                                                class="fas fa-info-circle text-muted"></i></th>
                                        <th data-bs-toggle="tooltip" title="Quantidade disponível no estoque.">Qtd. Restante <i
                                                class="fas fa-info-circle text-muted"></i></th>
                                        <th data-bs-toggle="tooltip" title="Limite crítico para alerta.">Crítico <i
                                                class="fas fa-info-circle text-danger"></i></th>
                                        <th data-bs-toggle="tooltip" title="Limite mínimo para alerta.">Mínimo <i
                                                class="fas fa-info-circle text-warning"></i></th>
                                        <th data-bs-toggle="tooltip" title="Data de expiração do lote.">Data Expiração <i
                                                class="fas fa-info-circle text-muted"></i></th>
                                        <th>Ações</th>
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
    <div class="modal fade" id="modal-editar-estados" tabindex="-1" aria-labelledby="modal-editar-estados-label"
        aria-hidden="true">
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
                        <button type="submit" class="btn btn-primary" id="btn-save-estados">
                            Salvar
                            <span class="loader" style="display:none; margin-left: 10px;">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        #custom-context-menu {
            display: none;
            position: absolute;
            z-index: 9999;
            min-width: 180px;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
            padding: 0.5rem 0;
            font-size: 15px;
        }

        #custom-context-menu .context-item {
            padding: 8px 18px;
            cursor: pointer;
            color: #333;
            transition: background 0.2s;
            user-select: none;
        }

        #custom-context-menu .context-item:hover {
            background: #f1f5fa;
            color: #0d6efd;
        }

        .row-selected { background: #e3f2fd !important; transition: background 0.4s; }
        .highlight-edit { animation: highlightFade 2s; background: #ffe082 !important; }
        @keyframes highlightFade {
            0% { background: #ffe082; }
            100% { background: #fff; }
        }

        .card.bg-light { background: #f8fafc !important; border-radius: 1.2rem !important; }
        #global-search:focus { border-color: #0d6efd; box-shadow: 0 0 0 0.1rem #0d6efd33; }
        #btn-export-excel, #btn-export-pdf, #btn-print-table, #btn-refresh-table { transition: background 0.2s, color 0.2s, box-shadow 0.2s; }
        #btn-export-excel:hover { background: #198754 !important; color: #fff !important; }
        #btn-export-pdf:hover { background: #dc3545 !important; color: #fff !important; }
        #btn-print-table:hover { background: #6c757d !important; color: #fff !important; }
        #btn-refresh-table:hover { background: #0d6efd !important; color: #fff !important; }
        .table-produto tbody tr { transition: background 0.2s; cursor: pointer; }
        .table-produto tbody tr:hover, .table-produto tbody tr.row-selected { background: #e3f2fd !important; }
        .table-produto .badge { font-size: 0.95em; border-radius: 1rem; padding: 0.4em 1.1em; font-weight: 500; }
        .table-produto .bg-danger { background: #ff5252 !important; color: #fff; }
        .table-produto .bg-warning { background: #ffd600 !important; color: #333; }
        .table-produto .bg-info { background: #40c4ff !important; color: #fff; }
        .table-produto .bg-success { background: #00e676 !important; color: #fff; }
        .table-produto .bg-dark { background: #263238 !important; color: #fff; }
    </style>
    <div id="custom-context-menu">
        <div class="context-item" id="context-editar">Editar</div>
        <div class="context-item" id="context-atualizar">Atualizar Estoque</div>
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
                    {
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return '<input type="checkbox" class="row-select">';
                        },
                        "orderable": false,
                        "searchable": false
                    },
                    { "data": "produto.designacao", defaultContent: '--' },
                    { "data": "produto.dosagem", defaultContent: '--' },
                    {
                        "data": function(row) {
                            let saldo = row.produto?.saldo?.qtd ?? 0;
                            if (saldo <= 0) return '<span class="badge bg-dark">Estoque 0</span>';
                            if (saldo <= row.critico) return '<span class="badge bg-danger">Crítico</span>';
                            if (saldo <= row.minimo) return '<span class="badge bg-warning">Mínimo</span>';
                            if (saldo <= row.medio) return '<span class="badge bg-info">Médio</span>';
                            return '<span class="badge bg-success">Estável</span>';
                        }
                    },
                    { "data": "produto.saldo.qtd", defaultContent: '--' },
                    { "data": "critico", defaultContent: '--' },
                    { "data": "minimo", defaultContent: '--' },
                    { "data": row => row.produto?.data_expiracao ? formatDate(row.produto.data_expiracao) : '--' },
                    {
                        "data": function(row, type, set, meta) {
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
                if (processing) {
                    $('#table-loader-overlay').fadeIn(150);
                } else {
                    $('#table-loader-overlay').fadeOut(150);
                }
            });

            function showTableError(msg) {
                var colspan = $('#table-c thead th').length;
                $('#table-c tbody').html('<tr><td colspan="' + colspan + '" class="text-center text-danger">' +
                    msg + '</td></tr>');
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

            // Menu de contexto personalizado (deve estar dentro do ready e após o DataTable)
            let contextRowId = null;
            $('#table-c tbody').on('contextmenu', 'tr', function(e) {
                e.preventDefault();
                let rowData = table.row(this).data();
                if (!rowData) return;
                contextRowId = rowData.id;

                // Calcula posição exata do cursor considerando scroll
                let mouseX = e.clientX;
                let mouseY = e.clientY;

                // Garante que o menu aparece exatamente onde está o cursor
                $('#custom-context-menu')
                    .css({
                        top: mouseY + 'px',
                        left: mouseX + 'px',
                        position: 'fixed',
                        display: 'block'
                    })
                    .fadeIn(120);
            });
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#custom-context-menu').length) {
                    $('#custom-context-menu').fadeOut(80);
                }
            });
            $('#context-editar').on('click', function() {
                if (!contextRowId) return;
                let rowData = table.rows().data().toArray().find(r => r.id == contextRowId);
                if (!rowData) return;
                $('#edit-row-id').val(rowData.id);
                $('#edit-critico').val(rowData.critico);
                $('#edit-minimo').val(rowData.minimo);
                $('#edit-medio').val(rowData.medio);
                $('#edit-maximo').val(rowData.maximo);
                $('#edit-item-nome').val(rowData.produto?.designacao ?? '');
                $('#modal-editar-estados').modal('show');
                $('#custom-context-menu').fadeOut(80);
            });
            $('#context-atualizar').on('click', function() {
                table.ajax.reload();
                $('#custom-context-menu').fadeOut(80);
            });
            $(window).on('scroll', function() {
                $('#custom-context-menu').fadeOut(80);
            });

            // Atalhos de teclado
            $(document).on('keydown', function(e) {
                if (e.key === 'F2') {
                    let selected = $('.row-selected').first();
                    if (selected.length) {
                        selected.trigger('contextmenu', [{ pageX: selected.offset().left, pageY: selected.offset().top+30 }]);
                        setTimeout(() => $('#context-editar').click(), 100);
                    }
                }
                if (e.key === 'F5') {
                    e.preventDefault();
                    $('#btn-refresh-table').click();
                }
                if (e.ctrlKey && e.key === 'a') {
                    e.preventDefault();
                    $('#select-all-rows').prop('checked', true).trigger('change');
                }
            });

            // Busca global
            $('#global-search').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Tooltips Bootstrap
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Seleção em massa
            $('#select-all-rows').on('change', function() {
                let checked = $(this).is(':checked');
                $('#table-c tbody tr').each(function() {
                    $(this).toggleClass('row-selected', checked);
                    $(this).find('input[type=checkbox].row-select').prop('checked', checked);
                });
            });
            $('#table-c tbody').on('click', 'tr', function(e) {
                if (!$(e.target).is('input[type=checkbox]')) {
                    $(this).toggleClass('row-selected');
                    $(this).find('input[type=checkbox].row-select').prop('checked', $(this).hasClass('row-selected'));
                }
            });
            $('#table-c tbody').on('change', 'input[type=checkbox].row-select', function() {
                $(this).closest('tr').toggleClass('row-selected', $(this).is(':checked'));
            });

            // Exportação Excel/PDF/Imprimir
            $('#btn-export-excel').on('click', function() {
                window.print(); // Placeholder, pode integrar SheetJS ou DataTables export
            });
            $('#btn-export-pdf').on('click', function() {
                window.print(); // Placeholder, pode integrar jsPDF
            });
            $('#btn-print-table').on('click', function() {
                window.print();
            });

            // Notificação em tempo real (polling simples)
            setInterval(function() {
                table.ajax.reload(null, false);
            }, 60000); // 1 min

            // Highlight na linha editada
            $(document).on('submit', '#form-editar-estados', function() {
                setTimeout(function() {
                    let id = $('#edit-row-id').val();
                    let row = $('#table-c tbody tr').filter(function() {
                        return table.row(this).data()?.id == id;
                    });
                    row.addClass('highlight-edit');
                    setTimeout(() => row.removeClass('highlight-edit'), 2000);
                }, 800);
            });

            // Confirmação visual para ações críticas
            $(document).on('click', '.btn-editar-estados', function(e) {
                if (parseInt($(this).data('critico')) === 0) {
                    if (!confirm('Você está editando um valor crítico (0). Tem certeza?')) {
                        e.preventDefault();
                        return false;
                    }
                }
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
                                text: item.produto.designacao + " [" + item.produto
                                    .dosagem + "]" + " - " + item.produto.forma
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
            var id = $('#edit-row-id').val();
            var critico = $('#edit-critico').val();
            var minimo = $('#edit-minimo').val();
            var medio = $('#edit-medio').val();
            var maximo = $('#edit-maximo').val();
            var $btn = $('#btn-save-estados');
            $btn.prop('disabled', true);
            $('#modal-editar-estados .modal-footer .loader').show();
            $.ajax({
                url: '/api/status_produto/update/' + id,
                type: 'POST',
                data: {
                    critico: critico,
                    minimo: minimo,
                    medio: medio,
                    maximo: maximo,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(resp) {
                    $('#modal-editar-estados').modal('hide');
                    $btn.prop('disabled', false);
                    $('#modal-editar-estados .modal-footer .loader').hide();
                    if (resp.success) {
                        showToast('Estados atualizados com sucesso!', 'success');
                        table.ajax.reload(null, false);
                    } else {
                        showToast(resp.message || 'Erro ao atualizar.', 'error');
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false);
                    $('#modal-editar-estados .modal-footer .loader').hide();
                    let msg = 'Erro ao atualizar: ' + (xhr.responseJSON?.message || xhr.statusText);
                    showToast(msg, 'error');
                }
            });
        });

        // Função para mostrar toast/alerta
        function showToast(msg, type) {
            let color = type === 'success' ? 'bg-success' : 'bg-danger';
            let toast = $(
                `<div class="toast align-items-center text-white ${color} border-0 show" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
                <div class="d-flex">
                    <div class="toast-body">${msg}</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>`
            );
            $('body').append(toast);
            setTimeout(() => {
                toast.fadeOut(400, function() {
                    $(this).remove();
                });
            }, 3500);
        }
    </script>
@endsection
