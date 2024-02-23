<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo', 'Página Inicial') - Pharmacus</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/backende209.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
	<link rel="stylesheet" href={{ asset("src/css/manual.css") }}>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap4.min.css">
</head>

<body class=" color-light ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>

    <div class="wrapper">
        @include('partials.aside')
        @include('modals._addCargo')
        @include('partials.nav')

        <div class="modal fade" id="new-order" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="popup text-left">
                            <h4 class="mb-3">New Order</h4>
                            <div class="content create-workform bg-body">
                                <div class="pb-3">
                                    <label class="mb-2">Email</label>
                                    <input type="text" class="form-control" placeholder="Enter Name or Email">
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                        <div class="btn btn-primary mr-4" data-dismiss="modal">Cancel</div>
                                        <div class="btn btn-outline-primary" data-dismiss="modal">Create</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('modals._estoqueFarmaceutico')
        @include('modals._addFarmacia')
        @include('modals._addCategoria')

        <div class="content-page">
            <div class="container-fluid">
                <div id="addAqui">
                    @yield('conteudo')
                </div>
            </div>
        </div>
    </div>

    <!-- Wrapper End-->
    <footer class="iq-footer">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item"><a href="#">Politicas de Privacidade</a></li>
                                <li class="list-inline-item"><a href="#">Termos de Uso</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 text-right">
                            <span class="mr-1">
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>©
                            </span> <a href="#" class="">{{ env('APP_NAME') }}</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/helpers.js') }}" async></script>
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('assets/js/backend-bundle.min.js') }}"></script>

    <!-- Table Treeview JavaScript -->
    <script src="{{ asset('assets/js/table-treeview.js') }}"></script>

    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Chart Custom JavaScript -->
    <script async src="{{ asset('assets/js/chart-custom.js') }}"></script>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- app JavaScript -->
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap4.min.js"></script>
    <script>
        // Obtenha o contexto do canvas
        var ctx = document.getElementById('myChart').getContext('2d');

        // Defina as configurações padrão do gráfico
        var options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        precision: 0
                    }
                }]
            }
        };

        // Variável global para armazenar a referência ao gráfico
        var myChart;

        // Crie uma função para buscar e atualizar os dados do gráfico
        function updateGraphFarmacia() {
            // Faz a solicitação AJAX para obter os dados estatísticos por dia
            fetch('/farmacia/stat')
                .then(response => response.json())
                .then(data => {
                    // Atualiza os dados do gráfico
                    var newData = {
                        labels: Object.keys(data.area_hospitalar),
                        datasets: [{
                            label: 'Farmácia',
                            backgroundColor: 'rgb(255, 99, 132)',
                            borderColor: 'rgb(255, 99, 132)',
                            data: Object.values(data.farmacia)
                        }, {
                            label: 'Área Hospitalar',
                            backgroundColor: 'rgb(54, 162, 235)',
                            borderColor: 'rgb(54, 162, 235)',
                            data: Object.values(data.area_hospitalar)
                        }]
                    };

                    // Se o gráfico já foi criado, atualize os dados
                    if (typeof myChart !== 'undefined') {
                        myChart.data = newData;
                        myChart.update();
                    } else { // Se não, crie o gráfico
                        myChart = new Chart(ctx, {
                            type: 'bar',
                            data: newData,
                            options: options
                        });
                    }
                })
                .catch(error => console.error('Erro ao obter dados:', error));
        }

        // Chame a função para atualizar o gráfico ao carregar a página
        updateGraphFarmacia();

        // Defina um intervalo para atualizar o gráfico a cada minuto
        setInterval(updateGraphFarmacia, 5000);
    </script>
</body>

</html>