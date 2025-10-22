@extends('layout.app')

@section('titulo', 'Estoque ' . $ah->nome)

@section('content')
    <style>
        .action-row {
            background-color: #f8f9fa;
        }

        /* Coloca os botões alinhados à esquerda com espaçamento consistente */
        .action-buttons {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 8px;
            padding: 10px;
        }

        .action-buttons button {
            margin: 0;
        }
    </style>
    <div class="content">
        @include('partials.session')
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

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table show-entire">
                    <div class="card-body">
                        <div class="page-table-header mb-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="doctor-table-blk">
                                        <h3>Estoque {{ $ah->nome }}</h3>
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
                                            <div class="add-group">
                                                @if (isAdministrator() or auth()->user()->pode_cadastrar_produtos)
                                                    <button
                                                        onclick="location.href = '{{ route('estoque.cadastrar', ['area_id' => $ah->id]) }}'"
                                                        class="btn btn-rounded btn-outline-primary ms-2">
                                                        <img src="{{ assetr('assets/img/icons/plus.svg') }}" alt>
                                                        Adicionar Produto
                                                    </button>
                                                @endif
                                                <button
                                                    onclick="location.href = '{{ route('estoque.solicitar', ['id' => $ah->id]) }}';"
                                                    class="btn btn-rounded btn-outline-success ms-2">
                                                    <i class="fa fa-box"></i>
                                                    Solicitar
                                                </button>
                                                <button
                                                    onclick="location.href = '{{ route('estoque._minimo', ['id' => $ah->id]) }}';"
                                                    class="btn btn-rounded btn-outline-success ms-2">
                                                    <i class="fa fa-box"></i>
                                                    Adicionar Estoque Minimo
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    @include('estoque.modalAddProduto')
                                </div>
                                <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="{{ route('print.view', ['estoque_id' => $ah->id]) }}" id="imprimir-pagina"
                                        target="_blank" class=" me-2">
                                        <img src="{{ assetr('assets/img/icons/pdf-icon-01.svg') }}" alt>
                                    </a>
                                    {{-- <a href="javascript:;" class=" me-2"><img
                                            src="{{ assetr('assets/img/icons/pdf-icon-02.svg') }}" alt></a>
                                    <a href="javascript:;" class=" me-2"><img
                                            src="{{ assetr('assets/img/icons/pdf-icon-03.svg') }}" alt></a>
                                    <a href="javascript:;" id="alert"><img
                                            src="{{ assetr('assets/img/icons/pdf-icon-04.svg') }}" alt></a> --}}
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table border-0 custom-table comman-table datatable mb-0 table-produto"
                                id="table-c">
                                <thead>
                                    <tr>
                                        <th>Designação</th>
                                        <th>Dosagem</th>
                                        <th>Forma</th>
                                        <th>Status</th>
                                        <th>Prateleira</th>
                                        <th>Lote</th>
                                        <th>Qtd. Caixa</th>
                                        <th>Qtd. Unit.</th>
                                        <th>Inserido em</th>
                                        <th>Data Expiração</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal para dar baixa --}}
        <div class="modal fade" id="DarBaixa" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="tituloModal">Dar baixa</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formBaixaEstoque" action="{{ route('estoque.baixa') }}" method="POST">
                            @csrf
                            @php
                                $area_h_id = @$area_id;
                                $farmacia_id = @auth()->user()->isFarmacia->farmacia_id
                                    ? auth()->user()->isFarmacia->farmacia_id
                                    : @auth()->user()->area_hospitalar->area_hospitalar->farmacia_id;
                            @endphp
                            <div class="form-group pb-3">
                                <label for="qtd_">Designação</label>
                                <input type="text" name="designacao" class="form-control" id="designacao"
                                    min="1">
                            </div>
                            <div class="form-group pb-3">
                                <label for="endereco">Área *</label>
                                <input type="hidden" name="user_id" id="user_id">
                                <select name="area_hospitalar_id" id="" class="form-control">
                                    @foreach (\App\Models\FarmaciaAreaHospitalar::where('farmacia_id', $farmacia_id)->get() as $ahw)
                                        @if ($ahw->area_hospitalar->id != $area_h_id)
                                            <option value="{{ $ahw->area_hospitalar->id }}">
                                                {{ $ahw->area_hospitalar->nome }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group pb-3">
                                <label for="qtd_">Total de Caixas</label>
                                <input type="text" name="descritivo" class="form-control" id="descritivo_"
                                    min="1">
                            </div>

                            <div class="form-group pb-3">
                                <input type="hidden" name="produto_id" id="id_produto">
                                <label for="qtd_">Quantidade a transferir</label>
                                <input type="number" name="qtd" class="form-control" id="qtd_"
                                    placeholder="Quantidade a transferir" min="1"
                                    max="{{ @getCaixa($est->produto->descritivo) }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal de Confirmação -->
        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteLabel">Confirmar Exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        Tem certeza que deseja excluir este produto?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Confirmar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function() {

            $('.solicitar-produto .js-example-basic-multiple').select2();

            var table = $('#table-c').DataTable({
                ajax: {
                    "url": "/api/produtos/{{ $ah->id }}",
                    "dataSrc": 'data'
                },
                "columns": [{
                        "data": "produto.designacao"
                    },
                    {
                        "data": "produto.dosagem"
                    },
                    {
                        "data": "produto.forma"
                    },
                    {
                        "data": function(row) {
                            let saldo = row.produto?.saldo?.qtd ?? 0;
                            let statusStock = row.produto?.status_stock; // Pode ser null

                            if (statusStock) {
                                if (saldo <= (statusStock.critico <= 0))
                                    return '<span class="badge bg-dark">Estoque 0</span>';
                                if (saldo <= (statusStock.critico ?? -1))
                                    return '<span class="badge bg-danger">Crítico</span>';
                                if (saldo <= (statusStock.minimo ?? -1))
                                    return '<span class="badge bg-warning">Mínimo</span>';
                                if (saldo <= (statusStock.medio ?? -1))
                                    return '<span class="badge bg-info">Médio</span>';
                                if (saldo <= (statusStock.maximo ?? -1))
                                    return '<span class="badge bg-success">Máximo</span>';
                                if (saldo >= (statusStock.maximo ?? -1))
                                    return '<span class="badge bg-success">Estável</span>';
                            }

                            return '<span class="badge bg-secondary">Não Atribuido</span>';
                        }
                    },
                    {
                        "data": function(row) {
                            return row.produto?.prateleira?.nome ? getCaixa(row.produto.prateleira
                                .nome) : '--';
                        }
                    }, // Prateleira
                    {
                        "data": "produto.num_lote"
                    }, // Lote
                    {
                        "data": function(row) {
                            return getCaixa(row.produto.descritivo);
                        }
                    }, // Qtd. Caixa
                    {
                        "data": "produto.saldo.qtd"
                    }, // Qtd. Unit.
                    {
                        "data": function(row) {
                            return formatDate(row.created_at);
                        }
                    }, // Inserido em
                    {
                        "data": function(row) {
                            return formatDate(row.produto.data_expiracao);
                        }
                    }, // Data Expiração
                    {
                        "data": null,
                        "defaultContent": ""
                    } // Coluna vazia para ações
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
                }
            });

            // Função para adicionar linha extra manualmente após carregar os dados
            $('#table-c tbody').on('click', 'tr', function() {
                var row = $(this);
                var data = table.row(row).data(); // Pega os dados da linha clicada

                // Se a linha de ações já existir, remover
                if (row.next().hasClass('action-row')) {
                    row.next().remove();
                    return;
                }

                // Fecha qualquer outra linha de ação aberta
                $('.action-row').remove();

                // Criar e inserir nova linha de ação
                var actionRow = `
                    <tr class="action-row">
                        <td colspan="11">
                            <div class="action-buttons">
                                <button class="btn btn-success btn-add" data-id="${data.produto.id}" data-descritivo="${data.produto.descritivo}" title="Adicionar" aria-label="Adicionar">
                                    <i class="fa fa-plus me-1" aria-hidden="true"></i> Adicionar
                                </button>
                                <button class="btn btn-primary btn-editar" data-id="${data.produto.id}" title="Editar" aria-label="Editar">
                                    <i class="fa fa-edit me-1" aria-hidden="true"></i> Editar
                                </button>
                                <button class="btn btn-outline-info btn-historico" data-id="${data.produto.id}" title="Ver Histórico" aria-label="Histórico">
                                    <i class="fa fa-history me-1"></i> Histórico
                                </button>
                                <button class="btn btn-warning btn-dar-baixa" data-id="${data.produto.id}" data-designacao="${data.produto.designacao}" data-qtd="${getCaixa(data.produto.descritivo)}" title="Dar Baixa" aria-label="Dar Baixa">
                                    <i class="fa fa-arrow-down me-1" aria-hidden="true"></i> Dar Baixa
                                </button>
                                <button class="btn btn-danger btn-eliminar-item" data-id="${data.produto.id}" title="Eliminar" aria-label="Eliminar">
                                    <i class="fa fa-trash me-1" aria-hidden="true"></i> Eliminar
                                </button>
                            </div>
                        </td>
                    </tr>`;

                row.after(actionRow);
            });

            // Abrir offcanvas de histórico ao clicar no botão
            $(document).on('click', '.btn-historico', function() {
                var produtoId = $(this).data('id');
                var offcanvasEl = document.getElementById('offcanvasRight');
                var offcanvas = new bootstrap.Offcanvas(offcanvasEl);

                // limpar conteúdo anterior
                document.getElementById('history_timeline').innerHTML = '';
                document.getElementById('history_empty').style.display = 'none';
                document.getElementById('offcanvasRightSubtitle').innerText = 'Carregando histórico...';

                // Para já apenas populamos com layout de loading; se existir endpoint, podemos buscar
                fetch(`/api/product-history/${produtoId}`).then(function(resp) {
                    if (!resp.ok) throw new Error('no-data');
                    return resp.json();
                }).then(function(json) {
                    var list = json.data || json;
                    if (!list || list.length === 0) {
                        document.getElementById('history_empty').style.display = 'block';
                        document.getElementById('offcanvasRightSubtitle').innerText = 'Sem registos';
                    } else {
                        document.getElementById('offcanvasRightSubtitle').innerText = list.length + ' registos';
                        list.forEach(function(item) {
                            var el = document.createElement('div');
                            el.className = 'd-flex mb-3';
                            var qty = item.quantity_delta ? (item.quantity_delta > 0 ? '+'+item.quantity_delta : item.quantity_delta) : '';
                            el.innerHTML = `
                                <div class="me-3">
                                    <span class="badge bg-secondary rounded-circle" style="width:38px; height:38px; display:flex; align-items:center; justify-content:center;">H</span>
                                </div>
                                <div class="flex-fill">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <strong class="history-action">${item.action}</strong>
                                            <div class="text-muted small history-meta">por ${item.user ? item.user.name : 'Sistema'} — ${item.created_at}</div>
                                        </div>
                                        <div class="text-end small text-muted history-qty">${qty}</div>
                                    </div>
                                    <div class="history-message mt-1">${item.payload && item.payload.num_lote ? 'Lote: <strong>'+item.payload.num_lote+'</strong>' : ''}</div>
                                </div>`;
                            document.getElementById('history_timeline').appendChild(el);
                        });
                    }
                }).catch(function() {
                    document.getElementById('history_empty').style.display = 'block';
                    document.getElementById('offcanvasRightSubtitle').innerText = 'Erro ao carregar';
                }).finally(function() {
                    offcanvas.show();
                });
            });

            // Evento para abrir a modal de confirmação ao clicar em "Eliminar"
            $(document).on('click', '.btn-eliminar-item', function() {
                var produtoId = $(this).data('id');

                // Configura a modal antes de exibir
                $('#confirmDeleteModal').modal('show');
                $('#confirmDeleteBtn').data('id', produtoId);
            });

            // Evento para confirmar e enviar a solicitação de exclusão
            $('#confirmDeleteBtn').on('click', function() {
                var produtoId = $(this).data('id');

                $.ajax({
                    url: '/api/produtos_/' + produtoId, // Substitua pela sua URL de API
                    type: 'DELETE',
                    success: function(response) {
                        $('#confirmDeleteModal').modal('hide'); // Fecha a modal
                        table.ajax.reload(); // Recarrega a tabela
                    },
                    error: function(xhr) {
                        console.error("Erro ao excluir: ${produtoId}", xhr.responseText);
                        alert("Erro ao excluir o produto. ${produtoId}");
                    }
                });
            });

            // Função para Editar Produto
            $(document).on('click', '.btn-editar', function() {
                var id = $(this).data('id');
                window.location.href = `/estoque/editar/${id}/{{ $ah->id }}`;
            });

            // Função para Dar Baixa
            $(document).on('click', '.btn-dar-baixa', function() {
                var id = $(this).data('id');
                var qtd = $(this).data('qtd');
                var designacao = $(this).data('designacao');
                modalDarBaixa(id, qtd, designacao); // Chama a função que já existia no código anterior
            });

            // Função para Excluir Produto
            $(document).on('click', '.btn-excluir', function() {
                var id = $(this).data('id');
                if (confirm("Tem certeza que deseja excluir este produto?")) {
                    $.ajax({
                        url: `/api/produtos/excluir/${id}`,
                        type: 'DELETE',
                        success: function(response) {
                            alert("Produto excluído com sucesso!");
                            table.ajax.reload(); // Recarrega a tabela
                        },
                        error: function(xhr) {
                            alert("Erro ao excluir o produto.");
                        }
                    });
                }
            });

            $('form#form_search').on('submit', function(e) {
                e.preventDefault();
            });
            $('#search-table').on('keyup', function() {
                // Obtém a instância da DataTable
                var table = $('#table-c').DataTable();

                // Aplica o filtro ao DataTable usando o valor do campo de pesquisa personalizado
                table.search(this.value).draw();
            });

            // Função para atualizar a DataTable periodicamente
            function updateTable() {
                table.ajax.reload(null, false); // Atualiza a tabela sem reiniciar a paginação
            }

            // Atualiza a tabela a cada 30 segundos (30000 milissegundos)
            setInterval(updateTable, 30000); // Altere o tempo conforme necessário

            function getCaixa(string) {
                var valores = string.split('x');
                var valor = valores[0].replace(/^0+/, ''); // Remove os zeros à esquerda

                return valor;
            }

            function formatDate(dateString) {
                var date = new Date(dateString);
                var day = String(date.getDate()).padStart(2, '0');
                var month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based
                var year = date.getFullYear();
                return `${day}-${month}-${year}`;
            }

            function getUnit(string) {
                var partes = string.split('x');
                return partes[partes.length - 1];
            }
        });

        // --- Modal sofisticada para Adicionar Estoque (caixa, caixinha, unidade, lote, fornecedor, obs) ---
        (function insertAddModal() {
            if (!document.getElementById('modalAdicionarEstoque')) {
                var modalHtml = `
                <div class="modal fade" id="modalAdicionarEstoque" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Adicionar Estoque - Preencher detalhes</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formAdicionarEstoque" class="row g-3">
                                    <input type="hidden" name="produto_id" id="add_produto_id">

                                    <div class="col-md-4">
                                        <label class="form-label">Caixas</label>
                                        <input type="number" min="0" class="form-control" id="add_caixa" name="caixa" value="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Caixinhas</label>
                                        <input type="number" min="0" class="form-control" id="add_caixinha" name="caixinha" value="0">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Unidades</label>
                                        <input type="number" min="0" class="form-control" id="add_unidade" name="unidade" value="0">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Total (unidades)</label>
                                        <input type="text" readonly class="form-control" id="add_total" value="0">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label">Lote</label>
                                        <input type="text" class="form-control" id="add_lote" name="num_lote">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Fornecedor</label>
                                        <input type="text" class="form-control" id="add_fornecedor" name="fornecedor">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Observações</label>
                                        <textarea class="form-control" id="add_obs" name="obs" rows="3"></textarea>
                                    </div>

                                    <div class="col-12">
                                        <div id="add_feedback" class="mb-2" style="display:none;"></div>
                                    </div>
                                    <div class="col-12 text-end">
                                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success" id="add_submit_btn">
                                            <span id="add_submit_text">Adicionar</span>
                                            <span id="add_submit_spinner" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true" style="display:none;"></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>`;

                document.body.insertAdjacentHTML('beforeend', modalHtml);

                // listeners para recalcular total automaticamente

                // tornar a função disponível globalmente para uso fora do IIFE
                window.calcTotal = function() {
                    var caixa = parseInt(document.getElementById('add_caixa').value || 0, 10);
                    var caixinha = parseInt(document.getElementById('add_caixinha').value || 0, 10);
                    var unidade = parseInt(document.getElementById('add_unidade').value || 0, 10);

                    // A equação correta: caixa * caixinha * unidade
                    var total = (caixa || 0) * (caixinha || 0) * (unidade || 0);
                    document.getElementById('add_total').value = total;
                };

                ['add_caixa', 'add_caixinha', 'add_unidade'].forEach(function(id) {
                    document.addEventListener('input', function(ev) {
                        if (ev.target && ev.target.id === id) window.calcTotal();
                    });
                });
            }
        })();

        // Abrir modal ao clicar em Adicionar
        document.addEventListener('click', function(e) {
            var target = e.target.closest('.btn-add');
            if (!target) return;
            var produtoId = target.getAttribute('data-id');
            var descritivo = target.getAttribute('data-descritivo') || '';
            document.getElementById('add_produto_id').value = produtoId;

            // resetar campos
            ['add_caixa','add_caixinha','add_unidade','add_total','add_lote','add_fornecedor','add_obs'].forEach(function(id) {
                var el = document.getElementById(id);
                if (!el) return;
                if (el.tagName === 'INPUT' || el.tagName === 'TEXTAREA') el.value = el.id === 'add_total' ? '0' : '';
            });

            // preencher caixinha e unidade com valores existentes no DB (descritivo)
            if (descritivo) {
                var parts = descritivo.split('x');
                var caixaVal = parts[0] ? parts[0].replace(/^0+/, '') : '';
                var caixinhaVal = parts[1] ? parts[1].replace(/^0+/, '') : '';
                var unidadeVal = parts[2] ? parts[2].replace(/^0+/, '') : '';

                if (document.getElementById('add_caixinha')) document.getElementById('add_caixinha').value = caixinhaVal || 0;
                if (document.getElementById('add_unidade')) document.getElementById('add_unidade').value = unidadeVal || 0;
                // opcional: preenche caixa com 0 para que usuário escolha quantidade a adicionar
                if (document.getElementById('add_caixa')) document.getElementById('add_caixa').value = 0;

                // recalcula total com os valores predefinidos
                if (window.calcTotal) window.calcTotal();
            }

            var modal = new bootstrap.Modal(document.getElementById('modalAdicionarEstoque'));
            modal.show();
        });

        // Envio via AJAX (melhor UX: spinner, disable inputs, feedback inline)
        document.addEventListener('submit', function(e) {
            if (e.target && e.target.id === 'formAdicionarEstoque') {
                e.preventDefault();
                var form = e.target;
                var fd = new FormData(form);

                var caixa = parseInt(document.getElementById('add_caixa').value || 0, 10);
                var caixinha = parseInt(document.getElementById('add_caixinha').value || 0, 10);
                var unidade = parseInt(document.getElementById('add_unidade').value || 0, 10);
                fd.set('descritivo', caixa + 'x' + caixinha + 'x' + unidade);
                var total = parseInt(document.getElementById('add_total').value || 0, 10);
                fd.set('units', total);

                // incluir area_hospitalar_id no payload se estiver disponível na página
                try {
                    var areaInput = document.createElement('input');
                    areaInput.type = 'hidden';
                    areaInput.name = 'area_hospitalar_id';
                    areaInput.value = '{{ $area_id ?? '' }}';
                    fd.append(areaInput.name, areaInput.value);
                } catch (e) {
                    // continue sem area
                }

                // Bloquear envio se total for 0
                if (total <= 0) {
                    feedbackEl.style.display = 'block';
                    feedbackEl.className = 'alert alert-danger';
                    feedbackEl.innerText = 'O total deve ser maior que zero antes de submeter.';
                    Array.from(form.querySelectorAll('input, textarea, button')).forEach(function(i) { i.disabled = false; });
                    btnSpinner.style.display = 'none';
                    return;
                }

                var btn = document.getElementById('add_submit_btn');
                var btnText = document.getElementById('add_submit_text');
                var btnSpinner = document.getElementById('add_submit_spinner');
                var feedbackEl = document.getElementById('add_feedback');

                // disable inputs
                Array.from(form.querySelectorAll('input, textarea, button')).forEach(function(i) { i.disabled = true; });
                btnSpinner.style.display = 'inline-block';
                feedbackEl.style.display = 'none';
                feedbackEl.innerHTML = '';

                fetch('{{ route('estoque.adicionar') }}', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: fd
                }).then(function(response) {
                    if (!response.ok) return response.json().then(function(j) { throw j; });
                    return response.json();
                }).then(function(data) {
                    // sucesso
                    feedbackEl.className = 'alert alert-success';
                    feedbackEl.innerText = data.message || 'Adicionado com sucesso';
                    feedbackEl.style.display = 'block';

                    // atualizar tabela
                    try { $('#table-c').DataTable().ajax.reload(null, false); } catch (err) {}

                    // fechar modal após pequeno delay para o usuário ver feedback
                    setTimeout(function() {
                        var modalEl = document.getElementById('modalAdicionarEstoque');
                        var modal = bootstrap.Modal.getInstance(modalEl);
                        if (modal) modal.hide();
                        // restore inputs
                        Array.from(form.querySelectorAll('input, textarea, button')).forEach(function(i) { i.disabled = false; });
                        btnSpinner.style.display = 'none';
                    }, 700);
                }).catch(function(err) {
                    feedbackEl.style.display = 'block';
                    feedbackEl.className = 'alert alert-danger';

                    if (err && err.errors) {
                        var msgs = [];
                        for (var k in err.errors) {
                            if (err.errors.hasOwnProperty(k)) msgs.push(err.errors[k][0]);
                        }
                        feedbackEl.innerHTML = msgs.join('<br>');
                    } else if (err && err.message) {
                        feedbackEl.innerText = err.message;
                    } else {
                        feedbackEl.innerText = 'Erro inesperado';
                    }

                    // restore inputs
                    Array.from(form.querySelectorAll('input, textarea, button')).forEach(function(i) { i.disabled = false; });
                    btnSpinner.style.display = 'none';
                });
            }
        });

        document.getElementById('imprimir-pagina').addEventListener('click', function(e) {
            e.preventDefault(); // Evita que o link seja seguido imediatamente

            // Redireciona para a página específica em uma nova aba
            var novaAba = window.open(this.href, '_blank');

            // Espera até que a página seja completamente carregada na nova aba
            novaAba.onload = function() {
                // Imprime a página
                novaAba.print();
            };
        });

        function modalDarBaixa(id_produto, descritivo, designacao) { //formBaixaEstoque
            $('#DarBaixa #formBaixaEstoque #id_produto').val(id_produto);
            $('#DarBaixa #formBaixaEstoque #designacao').val(designacao);
            $('#DarBaixa #formBaixaEstoque #designacao').prop("disabled", true);
            $('#DarBaixa #formBaixaEstoque #descritivo_').val(descritivo);
            $('#DarBaixa #formBaixaEstoque #descritivo_').prop("disabled", true);
            $('#DarBaixa').modal('show');
        }

        document.querySelector('form#formProdutoEstoque').addEventListener('submit', function(e) {
            e.preventDefault(); // Evita o comportamento padrão do formulário
            //showLoader();

            // Obtém os dados do formulário
            var formData = new FormData(this);

            // Envia a requisição AJAX
            fetch(this.getAttribute('action'), {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // hideLoader();
                    if (data.message) {
                        alertify.alert("Produto inserido com sucesso!", data.message, function() {
                            alertify.success("Ok");
                        });
                        // alert(data.message);

                        // Limpa o formulário
                        document.querySelector('#formProdutoEstoque').reset();

                        // Oculta o modal
                        document.querySelector('#modalAddProdutoEstoque').classList.remove('show');
                        document.querySelector('#modalAddProduto').style.display = 'none';
                    } else {
                        // Trata caso a resposta não contenha a mensagem esperada
                        alertify.alert("Erro", "Resposta inesperada do servidor!", function() {
                            alertify.success("Ok");
                        });
                        // alert("Resposta inesperada do servidor");
                    }
                })
                .catch(error => {
                    // hideLoader();
                    // Trata os erros de validação retornados pelo servidor
                    if (error.response && error.response.json) {
                        error.response.json().then(data => {
                            var errors = data.errors;
                            var errorMessage = '';

                            if (errors) {
                                // Percorre os erros e os concatena em uma única string
                                for (var key in errors) {
                                    if (errors.hasOwnProperty(key)) {
                                        errorMessage += errors[key][0] + '<br>';
                                    }
                                }
                            } else if (data.error) {
                                errorMessage = data.error;
                            } else {
                                errorMessage = data.message;
                            }
                            alertify.alert("Erro", errorMessage, function() {
                                alertify.success("Ok");
                            });
                            // alert(errorMessage);
                        });
                    } else {
                        alertify.alert("Erro", "Ocorreu um erro inesperado", function() {
                            alertify.success("Ok");
                        });
                        // alert('Ocorreu um erro inesperado');
                    }
                });
        });
    </script>
@endsection

@include('prepharma.estoque._productHistory')
