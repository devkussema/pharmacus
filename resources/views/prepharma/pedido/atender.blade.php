@extends('layout.app')

@section('titulo', 'Atender Pedido')

@section('content')
    <div class="content">
        @include('partials.session')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="#" id="atenderPedido" action="{{ route('pedido.storeAtender', ['id' => $pedido->id]) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-heading">
                                        <h4>Atender pedido de <b>{{ $pedido->item->designacao }}</b></h4>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-xl-12">
                                    <div class="input-block local-forms">
                                        <label for="nome_requisitante_id">Nome Requisitante <span
                                                class="login-danger">*</span></label>
                                        <input id="nome_requisitante_id" class="form-control"
                                            value="{{ $pedido->user_a->nome }}" type="text" disabled>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-xl-12">
                                    <div class="invoice-add-table">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-nowrap  mb-0 no-footer add-table-items">
                                                <thead>
                                                    <tr>
                                                        <th>Medicamento e Material Gastável</th>
                                                        <th>Quantidade Disponivel</th>
                                                        <th>Quantidade Solicitada</th>
                                                        <th>Quantidade Disponibilizada</th>
                                                        <th>Lote, Código QR ou Barras</th>,
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="add-row">
                                                        <td>
                                                            <input type="hidden" name="item_id" class="form-control"
                                                                disabled>
                                                            <input type="text" name="designacao" class="form-control" disabled id="nome-item">
                                                        </td>
                                                        <td>
                                                            <input type="text" disabled name="max_item" value="{{ $pedido->item->saldo->qtd }}" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" disabled name="qtd_pedida" value="{{ $pedido->qtd_pedida }}" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="number" name="qtd_disponibilizada" class="form-control">
                                                            <input type="hidden" name="ref_id" value="{{ $pedido->id }}">
                                                        </td>
                                                        <td>
                                                            <input type="text" id="doc_num" name="doc_num"
                                                                class="form-control" onkeyup="getData()">
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                        <button id="btn-atenderPedido" type="submit" class="btn rounded-pill btn-primary" type="submit">Enviar</button>
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
        function getData() {
            var docNumValue = $('#doc_num').val();
            if (docNumValue != ""){
                $.ajax({
                    url: "/pedidos/info/" + docNumValue,
                    type: 'GET',
                    success: function(data) {
                        if (data) {
                            var novaLinha = $(".add-row:last");

                            novaLinha.find('input[name="item_id"]').val(data.id);
                            novaLinha.find('input#nome-item').val(data.designacao);
                        }else{
                            document.querySelector('input[name="item_id"]').value = "";
                            document.querySelector('input#nome-item').value = "";
                        }
                    },
                    error: function(xhr, status, error) {
                        document.querySelector('input[name="item_id"]').value = "";
                        document.querySelector('input#nome-item').value = "";
                    }
                });
            }
        }
        function setItem() {
            // Obter o valor do campo doc_num
            var docNumValue = $('#doc_num').val();
            $.ajax({
                url: '/pedidos/info/' + docNumValue,
                type: 'GET',
                success: function(data) {
                    // Verificar se os dados foram recebidos corretamente
                    if (data) {
                        // Encontrar a linha mais recente da tabela
                        var newRow = $('.add-row:last');

                        // Preencher os campos de entrada com os dados recebidos
                        newRow.find('input[name="item_id"]').val(data.designacao);
                        //newRow.find('input[name="qtd_disponibilizada"]').val(data.qtd_disponibilizada);

                        // Continuar o envio do formulário após obter os dados do produto
                        $('#atenderPedido').off('submit').submit();
                    } else {
                        // Exibir uma mensagem de erro se os dados não foram recebidos corretamente
                        //alert('Erro ao receber os dados.');
                        alertify.alert('Ocorreu um erro', 'Erro ao receber os dados.');
                    }
                },
                error: function(xhr, status, error) {
                    // Verificar se ocorreu um erro 404 (recurso não encontrado)
                    if (xhr.status == 404) {
                        alertify.alert('Pedido não encontrado.', 'Esse produto não existe');
                    } else {
                        // Exibir uma mensagem de erro padrão para outros erros
                        alertify.alert('Ocorreu um erro','Erro ao processar a solicitação.');
                    }
                }
            });
        }
        $('#atenderPedido').on('submit', function(e) {
            e.preventDefault();
            setItem();
        });
    </script>
@endsection
