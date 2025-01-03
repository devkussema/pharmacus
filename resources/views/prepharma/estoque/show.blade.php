@extends('layout.app')

@section('titulo', 'Estoque ' . $ah->nome)

@section('content')
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
                                                @if (isAdministrator() or vPerm('produtos', ['cadastrar']))
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
                                        <th>Prateleira</th>
                                        <th>Lote</th>
                                        <th>Qtd. Caixa</th>
                                        <th>Qtd. Unit.</th>
                                        <th>Inserido em</th>
                                        <th>Data Expiração</th>
                                        <th>Ação</th>
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
                        <h4 class="modal-title" id="tituloModal">Adicionar Cargo</h4>
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
    </div>
    <script>
        $(document).ready(function() {

            $('.solicitar-produto .js-example-basic-multiple').select2();

            // Inicializa a DataTable
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
                            return row.produto && row.produto.prateleira && row.produto.prateleira
                                .nome ?
                                getCaixa(row.produto.prateleira.nome) :
                                '--';
                        }
                    }, // Fornecedor
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
                    }, // Qtd. Unit. (interpretando que 'descritivo' contém essa info)
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
                    { // Última coluna com o dropdown de ações
                        "orderable": false, // Desabilita a ordenação nessa coluna
                        "data": null, // Não busca dados específicos, vamos manipular o HTML
                        "render": function(data, type, row, meta) {
                            // Adiciona o dropdown de ações se o usuário tiver permissão ou for farmácia
                            let actionHtml = `
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="modalDarBaixa(${row.produto.id}, '${getCaixa(row.produto.descritivo)}')">
                                            <i class="fa-solid fa-pen-to-square m-r-5"></i> Dar Baixa
                                        </a>
                                        <a class="dropdown-item" href="/estoque/editar/${row.produto.id}/{{ $ah->id }}">
                                            <i class="fa-solid fa-pen-to-square m-r-5"></i> Editar
                                        </a>
                                    </div>
                                </div>`;

                            return actionHtml;
                        }
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

        function modalDarBaixa(id_produto, descritivo) { //formBaixaEstoque
            $('#DarBaixa #formBaixaEstoque #id_produto').val(id_produto);
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
