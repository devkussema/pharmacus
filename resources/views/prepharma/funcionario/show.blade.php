@extends('layout.app')

@section('titulo', 'Lista de Funcionários')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('gerente.funcionarios.index') }}">Funcionários </a></li>
                        <li class="breadcrumb-item"><i class="feather-chevron-right"></i></li>
                        <li class="breadcrumb-item active">Lista de Funcionários</li>
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
                                        <h3>Lista de Funcionários</h3>
                                        <div class="doctor-search-blk">
                                            {{-- <div class="add-group">
                                                <a href="add-leave.html" class="btn btn-primary add-pluss ms-2"><img
                                                        src="assets/img/icons/plus.svg" alt></a>
                                                <a href="javascript:;" class="btn btn-primary doctor-refresh ms-2"><img
                                                        src="assets/img/icons/re-fresh.svg" alt></a>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-auto text-end float-end ms-auto download-grp">
                                    <a href="javascript:;" class=" me-2"><img src="assets/img/icons/pdf-icon-01.svg"
                                            alt></a>
                                    <a href="javascript:;" class=" me-2"><img src="assets/img/icons/pdf-icon-02.svg"
                                            alt></a>
                                    <a href="javascript:;" class=" me-2"><img src="assets/img/icons/pdf-icon-03.svg"
                                            alt></a>
                                    <a href="javascript:;"><img src="assets/img/icons/pdf-icon-04.svg" alt></a>
                                </div> --}}
                            </div>
                        </div>

                        {{-- <div class="staff-search-table">
                            <form id="filtrosFuncionarios">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="input-block local-forms">
                                            <label>Nome Funcionário</label>
                                            <input class="form-control" type="text" id="filtro_nome" name="nome" placeholder="Digite o nome...">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="input-block local-forms">
                                            <label>Cargo</label>
                                            @php
                                                $cargos = \App\Models\Cargo::orderBy('nome')->get();
                                            @endphp
                                            <select class="form-control select" id="filtro_cargo" name="cargo_id">
                                                <option value="">Todos os cargos</option>
                                                @foreach($cargos as $cargo)
                                                    <option value="{{ $cargo->id }}">{{ $cargo->nome }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="input-block local-forms">
                                            <label>Estado Funcionário</label>
                                            <select class="form-control select" id="filtro_estado" name="estado">
                                                <option value="">Todos os estados</option>
                                                <option value="ativo">Ativo</option>
                                                <option value="inativo">Inativo</option>
                                                <option value="pendente">Pendente</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-xl-3">
                                        <div class="doctor-submit">
                                            <button type="submit" class="btn btn-primary submit-list-form me-2">
                                                <i class="fa fa-search me-1"></i> Pesquisar
                                            </button>
                                            <button type="button" class="btn btn-secondary" id="limparFiltros">
                                                <i class="fa fa-refresh me-1"></i> Limpar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div> --}}

                        <!-- Tabela com loading -->
                        <div class="table-responsive" id="tabelaFuncionarios">
                            <!-- Loading spinner -->
                            <div id="loadingSpinner" class="text-center py-4" style="display: none;">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">A carregar...</span>
                                </div>
                                <p class="mt-2">A carregar funcionários...</p>
                            </div>

                            <!-- Tabela -->
                            <table class="table border-0 custom-table comman-table mb-0" id="tabelaFuncionariosContent">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check check-tables">
                                                <input class="form-check-input" type="checkbox" id="selectAll">
                                            </div>
                                        </th>
                                        <th>Nome</th>
                                        <th>Cargo</th>
                                        <th>Área</th>
                                        <th>Telefone</th>
                                        <th>Estado</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody id="funcionariosList">
                                    @include('prepharma.funcionario.partials.funcionarios-table', ['usuarios' => $usuarios])
                                </tbody>
                            </table>

                            <!-- Mensagem quando não há resultados -->
                            <div id="noResults" class="text-center py-4" style="display: none;">
                                <i class="fa fa-search fa-3x text-muted mb-3"></i>
                                <h4 class="text-muted">Nenhum funcionário encontrado</h4>
                                <p class="text-muted">Tente ajustar os filtros de pesquisa</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
$(document).ready(function() {

    // Função para carregar funcionários via AJAX
    function carregarFuncionarios(filtros = {}) {
        $('#loadingSpinner').show();
        $('#tabelaFuncionariosContent').hide();
        $('#noResults').hide();

        $.ajax({
            url: '{{ route("gerente.funcionarios.filtrar") }}',
            method: 'GET',
            data: filtros,
            success: function(response) {
                $('#funcionariosList').html(response.html);

                if (response.count > 0) {
                    $('#tabelaFuncionariosContent').show();
                    $('#noResults').hide();
                } else {
                    $('#tabelaFuncionariosContent').hide();
                    $('#noResults').show();
                }

                // Atualizar contador se houver
                if ($('#contadorFuncionarios').length) {
                    $('#contadorFuncionarios').text(response.count + ' funcionário(s) encontrado(s)');
                }
            },
            error: function(xhr) {
                console.error('Erro ao carregar funcionários:', xhr);
                toastr.error('Erro ao carregar funcionários. Tente novamente.');
            },
            complete: function() {
                $('#loadingSpinner').hide();
            }
        });
    }

    // Filtro em tempo real
    $('#filtrosFuncionarios').on('submit', function(e) {
        e.preventDefault();

        const filtros = {
            nome: $('#filtro_nome').val(),
            cargo_id: $('#filtro_cargo').val(),
            estado: $('#filtro_estado').val()
        };

        carregarFuncionarios(filtros);
    });

    // Filtro automático ao digitar (debounce)
    let timeoutId;
    $('#filtro_nome').on('input', function() {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(function() {
            $('#filtrosFuncionarios').trigger('submit');
        }, 500); // 500ms de delay
    });

    // Filtro automático ao mudar select
    $('#filtro_cargo, #filtro_estado').on('change', function() {
        $('#filtrosFuncionarios').trigger('submit');
    });

    // Limpar filtros
    $('#limparFiltros').on('click', function() {
        $('#filtrosFuncionarios')[0].reset();
        carregarFuncionarios();
    });

    // Mudar status via AJAX
    $(document).on('click', '.change-status', function(e) {
        e.preventDefault();

        const userId = $(this).data('user');
        const novoStatus = $(this).data('status');

        $.ajax({
            url: '{{ route("gerente.funcionarios.status") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                user_id: userId,
                status: novoStatus
            },
            success: function(response) {
                toastr.success('Status atualizado com sucesso!');
                // Recarregar com filtros atuais
                $('#filtrosFuncionarios').trigger('submit');
            },
            error: function(xhr) {
                toastr.error('Erro ao atualizar status');
            }
        });
    });

    // Toggle de permissões via AJAX (SIMPLIFICADO)
    $(document).on('click', '.toggle-permission', function(e) {
        e.preventDefault();

        const userId = $(this).data('user');
        const permission = $(this).data('permission');
        const $button = $(this);

        // Desabilitar botão temporariamente
        $button.addClass('disabled');

        $.ajax({
            url: '{{ route("gerente.funcionarios.permissao") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                user_id: userId,
                permission: permission
            },
            success: function(response) {
                if (response.success) {
                    toastr.success(response.message);
                    // Recarregar dados para mostrar mudança
                    carregarFuncionarios();
                } else {
                    toastr.error(response.message || '❌ Erro desconhecido');
                }
            },
            error: function(xhr) {
                console.error('Erro ao alterar permissão:', xhr);
                toastr.error('❌ Erro ao alterar permissão');
            },
            complete: function() {
                $button.removeClass('disabled');
            }
        });
    });

    // Selecionar todos os checkboxes
    $('#selectAll').on('change', function() {
        $('.form-check-input[type="checkbox"]').not(this).prop('checked', this.checked);
    });

    // Eliminar funcionário via AJAX
    $(document).on('click', '.delete-user', function(e) {
        e.preventDefault();

        const userId = $(this).data('user');
        const nomeUser = $(this).data('nome');

        if (confirm(`Tem certeza que deseja eliminar ${nomeUser}?`)) {
            $.ajax({
                url: '{{ route("gerente.funcionarios.destroy", ":id") }}'.replace(':id', userId),
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    toastr.success('Funcionário eliminado com sucesso!');
                    $('#filtrosFuncionarios').trigger('submit');
                },
                error: function(xhr) {
                    toastr.error('Erro ao eliminar funcionário');
                }
            });
        }
    });

});
</script>

