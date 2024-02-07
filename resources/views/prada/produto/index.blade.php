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
                <h4 class="mb-3">Product List</h4>
                <p class="mb-0">The product list effectively dictates product presentation and provides space<br> to list your products and offering in the most appealing way.</p>
            </div>
            <a href="page-add-product.html" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Add Product</a>
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
                    <th>Product</th>
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
                            <img src="../assets/images/table/product/01.jpg" class="img-fluid rounded avatar-50 mr-3" alt="image">
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
                            <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                               href="#"><i class="ri-eye-line mr-0"></i></a>
                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                               href="#"><i class="ri-pencil-line mr-0"></i></a>
                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                               href="#"><i class="ri-delete-bin-line mr-0"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="checkbox d-inline-block">
                            <input type="checkbox" class="checkbox-input" id="checkbox3">
                            <label for="checkbox3" class="mb-0"></label>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="../assets/images/table/product/02.jpg" class="img-fluid rounded avatar-50 mr-3" alt="image">
                            <div>
                                Rain Umbrella
                                <p class="mb-0"><small>This is test Product</small></p>
                            </div>
                        </div>
                    </td>
                    <td>UM01</td>
                    <td>Grocery</td>
                    <td>$30.00</td>
                    <td>Sun</td>
                    <td>$20.00</td>
                    <td>15.0</td>
                    <td>
                        <div class="d-flex align-items-center list-action">
                            <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                               href="#"><i class="ri-eye-line mr-0"></i></a>
                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                               href="#"><i class="ri-pencil-line mr-0"></i></a>
                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                               href="#"><i class="ri-delete-bin-line mr-0"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="checkbox d-inline-block">
                            <input type="checkbox" class="checkbox-input" id="checkbox4">
                            <label for="checkbox4" class="mb-0"></label>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="../assets/images/table/product/03.jpg" class="img-fluid rounded avatar-50 mr-3" alt="image">
                            <div>
                                Serum Bottle
                                <p class="mb-0"><small>This is test Product</small></p>
                            </div>
                        </div>
                    </td>
                    <td>SEM01</td>
                    <td>Beauty</td>
                    <td>$50.00</td>
                    <td>Blushing</td>
                    <td>$25.00</td>
                    <td>50.0</td>
                    <td>
                        <div class="d-flex align-items-center list-action">
                            <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                               href="#"><i class="ri-eye-line mr-0"></i></a>
                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                               href="#"><i class="ri-pencil-line mr-0"></i></a>
                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                               href="#"><i class="ri-delete-bin-line mr-0"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="checkbox d-inline-block">
                            <input type="checkbox" class="checkbox-input" id="checkbox5">
                            <label for="checkbox5" class="mb-0"></label>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="../assets/images/table/product/04.jpg" class="img-fluid rounded avatar-50 mr-3" alt="image">
                            <div>
                                Coffee Beans
                                <p class="mb-0"><small>This is test Product</small></p>
                            </div>
                        </div>
                    </td>
                    <td>COF01</td>
                    <td>Food</td>
                    <td>$32.00</td>
                    <td>Nescafe</td>
                    <td>$20.00</td>
                    <td>50.0</td>
                    <td>
                        <div class="d-flex align-items-center list-action">
                            <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                               href="#"><i class="ri-eye-line mr-0"></i></a>
                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                               href="#"><i class="ri-pencil-line mr-0"></i></a>
                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                               href="#"><i class="ri-delete-bin-line mr-0"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="checkbox d-inline-block">
                            <input type="checkbox" class="checkbox-input" id="checkbox6">
                            <label for="checkbox6" class="mb-0"></label>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="../assets/images/table/product/05.jpg" class="img-fluid rounded avatar-50 mr-3" alt="image">
                            <div>
                                Book Shelves
                                <p class="mb-0"><small>This is test Product</small></p>
                            </div>
                        </div>
                    </td>
                    <td>FUN01</td>
                    <td>Furniture</td>
                    <td>$30.00</td>
                    <td>Vintage</td>
                    <td>$30.00</td>
                    <td>25.0</td>
                    <td>
                        <div class="d-flex align-items-center list-action">
                            <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                               href="#"><i class="ri-eye-line mr-0"></i></a>
                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                               href="#"><i class="ri-pencil-line mr-0"></i></a>
                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                               href="#"><i class="ri-delete-bin-line mr-0"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="checkbox d-inline-block">
                            <input type="checkbox" class="checkbox-input" id="checkbox7">
                            <label for="checkbox7" class="mb-0"></label>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="../assets/images/table/product/06.jpg" class="img-fluid rounded avatar-50 mr-3" alt="image">
                            <div>
                                Dinner Set
                                <p class="mb-0"><small>This is test Product</small></p>
                            </div>
                        </div>
                    </td>
                    <td>DIS01</td>
                    <td>Grocery</td>
                    <td>$30.00</td>
                    <td>Rancher's</td>
                    <td>$20.00</td>
                    <td>50.0</td>
                    <td>
                        <div class="d-flex align-items-center list-action">
                            <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                               href="#"><i class="ri-eye-line mr-0"></i></a>
                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                               href="#"><i class="ri-pencil-line mr-0"></i></a>
                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                               href="#"><i class="ri-delete-bin-line mr-0"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="checkbox d-inline-block">
                            <input type="checkbox" class="checkbox-input" id="checkbox8">
                            <label for="checkbox8" class="mb-0"></label>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="../assets/images/table/product/07.jpg" class="img-fluid rounded avatar-50 mr-3" alt="image">
                            <div>
                                Nike Shoes
                                <p class="mb-0"><small>This is test Product</small></p>
                            </div>
                        </div>
                    </td>
                    <td>NIS01</td>
                    <td>Shoes</td>
                    <td>$78.00</td>
                    <td>Nike</td>
                    <td>$50.00</td>
                    <td>100.0</td>
                    <td>
                        <div class="d-flex align-items-center list-action">
                            <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                               href="#"><i class="ri-eye-line mr-0"></i></a>
                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                               href="#"><i class="ri-pencil-line mr-0"></i></a>
                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                               href="#"><i class="ri-delete-bin-line mr-0"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="checkbox d-inline-block">
                            <input type="checkbox" class="checkbox-input" id="checkbox9">
                            <label for="checkbox9" class="mb-0"></label>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="../assets/images/table/product/08.jpg" class="img-fluid rounded avatar-50 mr-3" alt="image">
                            <div>
                                Computer Glasses
                                <p class="mb-0"><small>This is test Product</small></p>
                            </div>
                        </div>
                    </td>
                    <td>COG01</td>
                    <td>Frames</td>
                    <td>$25.00</td>
                    <td>Ray-Ban</td>
                    <td>$20.00</td>
                    <td>30.0</td>
                    <td>
                        <div class="d-flex align-items-center list-action">
                            <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                               href="#"><i class="ri-eye-line mr-0"></i></a>
                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                               href="#"><i class="ri-pencil-line mr-0"></i></a>
                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                               href="#"><i class="ri-delete-bin-line mr-0"></i></a>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="checkbox d-inline-block">
                            <input type="checkbox" class="checkbox-input" id="checkbox10">
                            <label for="checkbox10" class="mb-0"></label>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="../assets/images/table/product/09.jpg" class="img-fluid rounded avatar-50 mr-3" alt="image">
                            <div>
                                Alloy Jewel Set
                                <p class="mb-0"><small>This is test Product</small></p>
                            </div>
                        </div>
                    </td>
                    <td>AJS01</td>
                    <td>Jewellery</td>
                    <td>$150.00</td>
                    <td>Jazzin</td>
                    <td>$50.00</td>
                    <td>200.0</td>
                    <td>
                        <div class="d-flex align-items-center list-action">
                            <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="View"
                               href="#"><i class="ri-eye-line mr-0"></i></a>
                            <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"
                               href="#"><i class="ri-pencil-line mr-0"></i></a>
                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                               href="#"><i class="ri-delete-bin-line mr-0"></i></a>
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
