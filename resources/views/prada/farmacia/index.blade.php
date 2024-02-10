@extends('home.index')

@section('titulo', 'Fármacias')

@section('conteudo')
    <div id="dadoPrincipal">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="mb-3">Lista de Farmácias</h4>
                        <p class="mb-0">
                            Farmácias são vitais para a oferta de produtos e serviços de saúde, garantindo<br>
                            uma apresentação atrativa e informativa para os clientes.
                        </p>
                    </div>
                    <a href="page-add-product.html" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Add
                        Product</a>
                </div>
                @include('partials.session')
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table id="datatable" class="table data-table table-striped">
                        <thead>
                            <tr class="ligth ligth-data">
                                <th>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox1">
                                        <label for="checkbox1" class="mb-0"></label>
                                    </div>
                                </th>
                                <th>Nome</th>
                                <th>Código</th>
                                <th>Categoria</th>
                                <th>Endereço</th>
                                <th>OBS</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
                            @foreach ($farmacias as $farmacia)
                                <tr>
                                    <td>
                                        <div class="checkbox d-inline-block">
                                            <input type="checkbox" class="checkbox-input" id="checkbox2">
                                            <label for="checkbox2" class="mb-0"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="../assets/images/table/product/01.jpg"
                                                class="img-fluid rounded avatar-50 mr-3" alt="image">
                                            <div>
                                                {{ $farmacia->nome }}
                                                <p class="mb-0"><small>{{ $farmacia->id }}</small></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $farmacia->codigo }}</td>
                                    <td>{{ @$farmacia->categoria->nome }}</td>
                                    <td>{{ $farmacia->endereco }}</td>
                                    <td>{{ $farmacia->obs }}</td>
                                    <td>
                                        <div class="d-flex align-items-center list-action">
                                            <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top"
                                                title="" data-original-title="View" href="#"><i
                                                    class="ri-eye-line mr-0"></i></a>
                                            <button class="btn badge bg-success mr-2" onclick="getDataFarma('{{ route('farmacia.get', ['id' => $farmacia->id]) }}')" data-toggle="tooltip" data-placement="top"
                                                title="" data-original-title="Editar">
                                                <i class="ri-pencil-line mr-0"></i></button>
                                            <a class="badge bg-info mr-2" href="#" onclick="preencherModalComFarmacia('{{ route('farmacia.get', ['id' => $farmacia->id]) }}')">
                                                <i class="ri-bubble-chart-line"></i>
                                            </a>
                                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top"
                                                title="" data-original-title="Delete" href="#"><i
                                                    class="ri-delete-bin-line mr-0"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('modals._addGerenteFarmacia')
@endsection
