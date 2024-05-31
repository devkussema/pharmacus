@extends('layout.app')

@section('titulo', 'Atender Pedido')

@section('content')
    <div class="content">
        @include('partials.session')
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="#" id="atenderPedido">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-heading">
                                        <h4>Atender pedido de {{ $pedido->user_a->nome }}</h4>
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
                                        <h4>Escolher Itens</h4>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-nowrap  mb-0 no-footer add-table-items">
                                                <thead>
                                                    <tr>
                                                        <th>Medicamento e Material Gastável</th>
                                                        <th>Quantidade Disponibilizada</th>
                                                        <th>Lote, Código QR ou Barras</th>
                                                        <th>Ações</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="add-row">
                                                        <td>
                                                            <input type="text" name="itens[]" id="item-0" class="form-control" disabled>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="qtd_disonibilizada" class="form-control">
                                                        </td>
                                                        <td>
                                                            <input type="text" id="doc_num" name="doc_num" class="form-control">
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
        $('#atenderPedido').on('submit', function(e){
            e.preventDefault();
        });
    </script>
@endsection
