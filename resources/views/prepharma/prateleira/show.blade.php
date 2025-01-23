@extends('layout.app')

@section('titulo', 'Prateleiras')

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
                                        <h3>Prateleiras</h3>
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
                                                    <button onclick="location.href = '{{ route('prateleira.add') }}'"
                                                        class="btn btn-rounded btn-outline-primary ms-2">
                                                        <img src="{{ assetr('assets/img/icons/plus.svg') }}" alt>
                                                        Adicionar Produto
                                                    </button>
                                                @endif
                                                <button onclick="location.href = '#';"
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
                                        <th>Status</th>
                                        <th>Descrição</th>
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

        <script>
            $(document).ready(function() {
                // Inicializa a DataTable
                var table = $('#table-p').DataTable({
                    ajax: {
                        "url": "/prateleira/get/all", // URL para buscar os dados
                        "dataSrc": "data" // Especifica que os dados estão na chave 'data'
                    },
                    "columns": [{
                            "data": "nome" // Coluna Nome
                        },
                        {
                            "data": "status",
                            "render": function(data, type, row) {
                                return data == 1 ? 'Ativo' : 'Inativo';
                            }
                        },
                        {
                            "data": "descricao", // Coluna Descrição
                            "defaultContent": "-" // Substitui valores nulos ou indefinidos por "-"
                        },
                        {
                            "orderable": false, // Desabilita ordenação nessa coluna
                            "data": null,
                            "render": function(data, type, row, meta) {
                                // Renderiza ações na última coluna
                                let actionHtml = `
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="editarPrateleira(${row.id})">
                                        <i class="fa-solid fa-pen-to-square m-r-5"></i> Editar
                                    </a>
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="toggleStatus(${row.id})">
                                        <i class="fa-solid fa-trash m-r-5"></i> Alterar Status
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

                // Atualiza a tabela automaticamente a cada 2 minutos (120.000 ms)
                setInterval(function() {
                    table.ajax.reload(null, false); // Recarrega os dados sem reiniciar a tabela
                }, 120000);

                // Funções para ações nos botões
                window.editarPrateleira = function(id) {
                    alert(`Editar prateleira com ID: ${id}`);
                    // Adicione lógica para editar
                };

                // Função para confirmar e excluir prateleira
                window.deletarPrateleira = function(id) {
                    if (confirm("Tem certeza que deseja excluir esta prateleira?")) {
                        // Se confirmado, faz a requisição para o backend
                        $.ajax({
                            url: `/prateleira/delete/${id}`,
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                alert(response.message); // Mensagem de sucesso do backend
                                $('#table-p').DataTable().ajax.reload(); // Atualiza a tabela
                            },
                            error: function(xhr) {
                                alert(
                                    "Erro ao tentar excluir a prateleira. Tente novamente."
                                    ); // Tratamento de erro
                            }
                        });
                    }
                };

            });
            function toggleStatus(id) {
                if (confirm("Você tem certeza que deseja alterar o status desta prateleira?")) {
                    $.ajax({
                        url: '/prateleira/toggle-status/' + id,
                        type: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            alert(response.message); // Exibe a mensagem de sucesso
                            $('#table-p').DataTable().ajax.reload(); // Atualiza a tabela
                        },
                        error: function(error) {
                            alert('Erro ao alterar o status. Tente novamente.');
                        }
                    });
                }
            }
        </script>
    @endsection
