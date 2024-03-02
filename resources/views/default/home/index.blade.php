<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="theme-color" content="#6777ef" />
    <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <title>@yield('titulo', 'Página Inicial') - {{ env('APP_NAME') }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/black__logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/backende209.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href={{ asset('src/css/manual.css') }}>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap4.min.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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

    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if ("serviceWorker" in navigator) {
            // Register a service worker hosted at the root of the
            // site using the default scope.
            navigator.serviceWorker.register("/sw.js").then(
                (registration) => {
                    console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    console.error(`Service worker registration failed: ${error}`);
                },
            );
        } else {
            console.error("Service workers are not supported.");
        }
    </script>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <!-- app JavaScript -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js"></script>

    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('select.select2').select2();
        });
        $(document).ready(function() {
            $('#repeater-form').repeater({
                show: function() {
                    $(this).slideDown();
                },
                hide: function(deleteElement) {
                    if (confirm('Are you sure you want to delete this item?')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
        });

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


        let counter = 1;
        document.getElementById('btn_repetir_lote').addEventListener('click', function() {
            // Get the existing element to clone
            const originalElement = document.getElementById('repetir_');

            // Clone the original element
            const cloneElement = originalElement.cloneNode(true);

            // Numeração automática dos inputs
            cloneElement.querySelectorAll('input').forEach(function(input, index) {
                const elementId = input.getAttribute('id');
                const inputName = input.getAttribute('name');
                input.setAttribute('id', `${elementId}_${counter}`);
                input.setAttribute('name', `${inputName}_${counter}`);
                input.setAttribute('onchange', `addQtdTotal('#${elementId}_${counter}')`);
                input.value = "";
            });
            counter++;

            // Adicionar botão de eliminar
            const btnEliminar = document.createElement('button');
            btnEliminar.classList.add('btn', 'btn-danger', 'ml-2');
            btnEliminar.textContent = 'Eliminar';
            btnEliminar.addEventListener('click', function() {
                this.parentNode.parentNode.removeChild(this.parentNode);
            });
            cloneElement.appendChild(btnEliminar);

            // Append the cloned element to the parent of the original element
            originalElement.parentNode.insertBefore(cloneElement, originalElement.nextSibling);
        });

        const inputDescritivo = document.getElementById('descritivo');
        const inputQuantidadeTotal = document.getElementById('qtd_total_estoque');

        function addQtdTotal(input) {
            var valor = $(input).val();

            // Valida o valor usando uma expressão regular
            const regex = /^([0-9]{1,2})x([0-9]{1,3})x([0-9]{1,4})$/;
            if (!regex.test(valor)) {
                // Retorna o último valor válido
                $(this).val(valor.slice(0, -1));
                return;
            }

            // Formata o valor
            $(this).val(valor.replace(/([0-9]{1,2})x([0-9]{1,3})x([0-9]{1,4})/, '$1x$2x$3'));

            // Multiplica os números
            const caixas = parseInt(valor.split('x')[0]);
            const caixinhas = parseInt(valor.split('x')[1]);
            const unidades = parseInt(valor.split('x')[2]);
            const quantidadeTotal = caixas * caixinhas * unidades;

            $('#qtd_total_estoque').val(quantidadeTotal);
        }
    </script>
</body>

</html>
