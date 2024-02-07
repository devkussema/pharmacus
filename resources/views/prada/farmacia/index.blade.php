@extends('home.index')

<div id="titulo">
    Todos os produtos
</div>

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
            </div>
            <div class="col-lg-12">
                <div class="table-responsive rounded mb-3">
                    <table class="data-table table mb-0 tbl-server-info">
                        <thead class="bg-white text-uppercase">
                            <tr class="ligth ligth-data">
                                <th>
                                    <div class="checkbox d-inline-block">
                                        <input type="checkbox" class="checkbox-input" id="checkbox1">
                                        <label for="checkbox1" class="mb-0"></label>
                                    </div>
                                </th>
                                <th>Nome</th>
                                <th>Code</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Brand Name</th>
                                <th>Cost</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="ligth-body">
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
                                            Organic Cream
                                            <p class="mb-0"><small>This is test Product</small></p>
                                        </div>
                                    </div>
                                </td>
                                <td>CREM01</td>
                                <td>Beauty</td>
                                <td>$25.00</td>
                                <td>Lakme</td>
                                <td>$10.00</td>
                                <td>10.0</td>
                                <td>
                                    <div class="d-flex align-items-center list-action">
                                        <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top"
                                            title="" data-original-title="View" href="#"><i
                                                class="ri-eye-line mr-0"></i></a>
                                        <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top"
                                            title="" data-original-title="Edit" href="#"><i
                                                class="ri-pencil-line mr-0"></i></a>
                                        <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top"
                                            title="" data-original-title="Delete" href="#"><i
                                                class="ri-delete-bin-line mr-0"></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
