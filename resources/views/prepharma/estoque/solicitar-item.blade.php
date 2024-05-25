@extends('layout.app')

@section('titulo', 'Solicitar Item')

@section('content')
    <div class="content">
        @include('partials.session')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('estoque.dar_baixa') }}">
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
                                            name="area_id">
                                            <option selected disabled>Selecionar Área Hospitalar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-xl-12">
                                    <div class="input-block local-forms">
                                        <label for="select-itens">Escolher Itens <span class="login-danger">*</span></label>
                                        <select id="select-itens" class="js-example-basic-multiple form-control"
                                            name="itens[]" multiple="multiple">
                                        </select>
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
            $('.js-example-basic-multiple').select2({
                theme: "classic"
            });
            $('.js-example-basic-single').select2();
        });

        function fetchAndPopulateSelectArea() {
            $.ajax({
                url: '/api/get/areas_hospitalares',
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

        function fetchAndPopulateSelect(id) {
            var endpoint = '/api/produtos/' + id;

            $.ajax({
                url: endpoint,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var select = $('#select-itens'); // Seleciona o elemento select
                    // Limpa as options existentes antes de adicionar novas
                    select.empty();
                    // Ordena os itens alfabeticamente
                    var sortedData = data.data.sort(function(a, b) {
                        return a.produto.designacao.localeCompare(b.produto.designacao);
                    });
                    // Itera sobre os itens ordenados e adiciona as options ao select
                    $.each(sortedData, function(index, item) {
                        select.append($('<option>', {
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
            // Chama a função para buscar os itens e popular o select
            fetchAndPopulateSelectArea();

            // Adiciona um ouvinte de evento para o evento de mudança no select
            $('#area_id_').on('change', function() {
                var selectedValue = $(this).val();
                fetchAndPopulateSelect(selectedValue);
            });
        });
    </script>
@endsection
