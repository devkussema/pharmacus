@extends('home.index')

@section('titulo', 'Fatura')

@section('conteudo')
    <div id="dadoPrincipal">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-block card-stretch card-height print rounded" id="conteudoPDF">
                    <div class="card-header d-flex justify-content-between bg-primary header-invoice">
                        <div class="iq-header-title">
                            <h4 class="card-title mb-0">Invoice#1234567</h4>
                        </div>
                        <div class="invoice-btn hide-on-print">
                            <button type="button" class="btn btn-primary-dark mr-2" onclick="window.print()">
                                <i class="las la-print"></i>
                                Print
                            </button>
                            <button type="button" class="btn btn-primary-dark" onclick="generatePDF('#conteudoPDF')">
                                <i class="las la-file-download"></i>
                                PDF
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <img src="../assets/images/logo.png" class="logo-invoice img-fluid mb-3">
                                <h5 class="mb-0">Hello, Barry Techs</h5>
                                <p>It is a long established fact that a reader will be distracted by the
                                    readable content of a page when looking at
                                    its layout. The point of using Lorem Ipsum is that it has a more-or-less
                                    normal distribution of letters, as
                                    opposed to using 'Content here, content here', making it look like readable
                                    English.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive-sm">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Order Date</th>
                                                <th scope="col">Order Status</th>
                                                <th scope="col">Order ID</th>
                                                <th scope="col">Billing Address</th>
                                                <th scope="col">Shipping Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Jan 17, 2016</td>
                                                <td><span class="badge badge-danger">Unpaid</span></td>
                                                <td>250028</td>
                                                <td>
                                                    <p class="mb-0">PO Box 16122 Collins Street West<br>Victoria
                                                        8007 Australia<br>
                                                        Phone: +123 456 7890<br>
                                                        Email: demo@Server360.com<br>
                                                        Web: www.Server360.com
                                                    </p>
                                                </td>
                                                <td>
                                                    <p class="mb-0">PO Box 16122 Collins Street West<br>Victoria
                                                        8007 Australia<br>
                                                        Phone: +123 456 7890<br>
                                                        Email: demo@Server360.com<br>
                                                        Web: www.Server360.com
                                                    </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 class="mb-3">Order Summary</h5>
                                <div class="table-responsive-sm">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center" scope="col">#</th>
                                                <th scope="col">Item</th>
                                                <th class="text-center" scope="col">Quantity</th>
                                                <th class="text-center" scope="col">Price</th>
                                                <th class="text-center" scope="col">Totals</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th class="text-center" scope="row">1</th>
                                                <td>
                                                    <h6 class="mb-0">Web Design</h6>
                                                    <p class="mb-0">Lorem Ipsum is simply dummy text of the
                                                        printing and typesetting industry.
                                                    </p>
                                                </td>
                                                <td class="text-center">5</td>
                                                <td class="text-center">$120.00</td>
                                                <td class="text-center"><b>$2,880.00</b></td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" scope="row">2</th>
                                                <td>
                                                    <h6 class="mb-0">Web Design</h6>
                                                    <p class="mb-0">Lorem Ipsum is simply dummy text of the
                                                        printing and typesetting industry.
                                                    </p>
                                                </td>
                                                <td class="text-center">5</td>
                                                <td class="text-center">$120.00</td>
                                                <td class="text-center"><b>$2,880.00</b></td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" scope="row">3</th>
                                                <td>
                                                    <h6 class="mb-0">Web Design</h6>
                                                    <p class="mb-0">Lorem Ipsum is simply dummy text of the
                                                        printing and typesetting industry.
                                                    </p>
                                                </td>
                                                <td class="text-center">5</td>
                                                <td class="text-center">$120.00</td>
                                                <td class="text-center"><b>$2,880.00</b></td>
                                            </tr>
                                            <tr>
                                                <th class="text-center" scope="row">4</th>
                                                <td>
                                                    <h6 class="mb-0">Web Design</h6>
                                                    <p class="mb-0">Lorem Ipsum is simply dummy text of the
                                                        printing and typesetting industry.
                                                    </p>
                                                </td>
                                                <td class="text-center">5</td>
                                                <td class="text-center">$120.00</td>
                                                <td class="text-center"><b>$2,880.00</b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <b class="text-danger">Notes:</b>
                                <p class="mb-0">It is a long established fact that a reader will be distracted
                                    by the readable content of a page
                                    when looking
                                    at its layout. The point of using Lorem Ipsum is that it has a more-or-less
                                    normal distribution of letters,
                                    as opposed to using 'Content here, content here', making it look like
                                    readable English.</p>
                            </div>
                        </div>
                        <div class="row mt-4 mb-3 hide-on-print">
                            <div class="offset-lg-8 col-lg-4">
                                <div class="or-detail rounded">
                                    <div class="p-3">
                                        <h5 class="mb-3">Order Details</h5>
                                        <div class="mb-2">
                                            <h6>Bank</h6>
                                            <p>Threadneedle St</p>
                                        </div>
                                        <div class="mb-2">
                                            <h6>Acc. No</h6>
                                            <p>12333456789</p>
                                        </div>
                                        <div class="mb-2">
                                            <h6>Due Date</h6>
                                            <p>12 August 2020</p>
                                        </div>
                                        <div class="mb-2">
                                            <h6>Sub Total</h6>
                                            <p>$4597.50</p>
                                        </div>
                                        <div>
                                            <h6>Discount</h6>
                                            <p>10%</p>
                                        </div>
                                    </div>
                                    <div class="ttl-amt py-2 px-3 d-flex justify-content-between align-items-center">
                                        <h6>Total</h6>
                                        <h3 class="text-primary font-weight-700">$4137.75</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function generatePDF(selector) {
            var table = document.querySelector(selector);

            // Cria um novo documento PDF
            const doc = new jsPDF();

            // Define a posição inicial para desenhar a tabela
            var yPos = 10;

            // Obtém todas as linhas da tabela
            var rows = table.getElementsByTagName('tr');

            // Itera sobre as linhas da tabela
            for (var i = 0; i < rows.length; i++) {
                var row = rows[i];

                // Obtém todas as células da linha
                var cells = row.getElementsByTagName('td');

                // Itera sobre as células da linha
                for (var j = 0; j < cells.length; j++) {
                    var cell = cells[j];

                    // Desenha o conteúdo da célula no documento PDF
                    doc.text(cell.textContent, 10, yPos);

                    // Move para a próxima linha
                    yPos += 10;
                }
            }

            // Salva o documento PDF
            doc.save('documento.pdf');
        }
    </script>
@endsection
