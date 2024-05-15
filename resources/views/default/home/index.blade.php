<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <meta name="theme-color" content="#6777ef" />
    @if (isAH())
        <meta name="is_ah" content="{{ isAH(1) }}">
    @endif

    @if (isAHGerente())
        <meta name="is_ah_gerente" content="{{ isAHGerente() }}">
    @endif
    <link rel="apple-touch-icon" href="{{ assetr('assets/images/white__logo2.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    @if (request()->cookie('pwa_app') === 'true')
        <title>@yield('titulo', 'Página Inicial')</title>
    @else
        <title>@yield('titulo', 'Página Inicial') - {{ getConfig('nome_site') ?? env('APP_NAME') }}</title>
    @endif

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ assetr('assets/images/white__logo2.png') }}" />
    <link rel="stylesheet" href="{{ assetr('assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ assetr('assets/css/backende209.css?v=1.0.0') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ assetr('assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ assetr('assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet" href="{{ assetr('assets/css/toastr.min.css') }}">
    <link rel="stylesheet" href={{ assetr('src/css/manual.css') }}>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap4.min.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        /* Estilo para ocultar elementos durante a impressão */
        @media print {
            .hide-on-print {
                display: none;
            }
        }

        .loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            /* Inicialmente, o loader estará invisível */
            transition: opacity 0.5s;
        }

        .loader img {
            width: 48px;
            /* Defina o tamanho da imagem como uma porcentagem da largura da tela */
            animation: spin 2s linear infinite;
            /* Efeito de rotação */
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="color-light">
    <!-- loader Start -->
    <div class="loader" id="loaderish" style="display: none">
        <img src="{{ assetr('assets/images/white__logo2.png') }}" alt="Logotipo" class="logo">
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
                            <h4 class="mb-3">Novo pedido</h4>
                            <div class="content create-workform bg-body">
                                <div class="pb-3">
                                    <label class="mb-2">Email</label>
                                    <input type="text" class="form-control" placeholder="Enter Name or Email">
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                        <div class="btn btn-primary mr-4" data-dismiss="modal">Cancelar</div>
                                        <div class="btn btn-outline-primary" data-dismiss="modal">Criar</div>
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

    <script src="{{ asset('/sw2.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        if (window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true) {
            // O site está sendo executado como PWA
            document.cookie = "pwa_app=true";
        } else {
            // O site está sendo executado em um navegador
            document.cookie = "pwa_app=false";
        }
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        if ("serviceWorker" in navigator) {
            // Register a service worker hosted at the root of the
            // site using the default scope.
            navigator.serviceWorker.register("/sw2.js").then(
                (registration) => {
                    //console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    console.error(`Service worker registration failed: ${error}`);
                },
            );
        } else {
            console.error("Service workers are not supported.");
        }
        $(document).ready(function() {
            $('select.selectr2').select2();
        });
        // Função para detectar a combinação de teclas Ctrl + Shift + X
        document.addEventListener('keydown', function(event) {
            var isCtrlPressed = event.ctrlKey || event.metaKey; // Verifica se a tecla Ctrl está pressionada
            var isShiftPressed = event.shiftKey; // Verifica se a tecla Shift está pressionada
            var isXPressed = event.key === 'x' || event.keyCode === 88; // Verifica se a tecla X está pressionada

            // Se todas as teclas estiverem pressionadas, exibe o alerta
            if (isCtrlPressed && isShiftPressed && isXPressed) {
                // Exibe um alerta com botões Sim e Não
                var confirmed = confirm('Deseja limpar o cache do site?');

                // Se o usuário clicar em Sim, limpa o cache
                if (confirmed) {
                    clearCache();
                }
            }
        });
        // Função para limpar o cache
        function clearCache() {
            // Adicione aqui o código para limpar o cache do seu site
            // Por exemplo:
            localStorage.clear(); // Limpa o cache local
            sessionStorage.clear(); // Limpa o cache de sessão
            location.reload(); // Recarrega a página
        }
        document.querySelectorAll('a.link-loaderish').forEach(function(alink) {
            alink.addEventListener('click', function(event) {
                event.preventDefault(); // Impede o comportamento padrão do link

                // Obtém a URL do href do link clicado
                var url = alink.getAttribute('href');

                showLoader(800);

                setTimeout(function() {
                    window.location.href = alink
                        .href; // Redireciona para o link após o tempo de espera
                }, 2000);
                return false;
            });
        });

        // adrianopeligangalata@gmail.com
        // const alink = document.querySelector('a.link-loaderish');
        // alink.addEventListener('click', function(event) {
        //     event.preventDefault();

        //     showLoader();

        //     setTimeout(function() {
        //         window.location.href = alink.href; // Redireciona para o link após o tempo de espera
        //     }, 5000); // Tempo de espera em milissegundos (2 segundos neste exemplo)

        //     return false; // Impede o navegador de seguir o link padrão
        // });

        const link = document.querySelector('a');

        // Função para exibir o loader com efeito de fade-in
        function showLoader(tempo = 2000) {
            const loader = document.getElementById('loaderish');
            loader.style.display = 'block'; // Exibe o loader
            loader.style.opacity = '0';
            loader.style.display = 'flex';
            setTimeout(() => {
                loader.style.opacity = '1'; // Define a opacidade como 1 para exibir gradualmente
            }, tempo); // Tempo de espera para iniciar o efeito de fade
        }

        // Função para esconder o loader com efeito de fade-out
        function hideLoader() {
            const loader = document.getElementById('loaderish');
            loader.style.opacity = '0'; // Define a opacidade como 0 para esconder gradualmente
            setTimeout(() => {
                loader.style.display = 'none'; // Oculta o loader após o efeito de fade-out
            }, 2000); // Tempo de espera para concluir a transição
        }

        document.addEventListener('keydown', function(event) {
            // Verifica se a tecla SHIFT, ALT e C foram pressionadas ao mesmo tempo
            if (event.shiftKey && event.altKey && event.key === 'C') {
                // Faz uma solicitação AJAX para executar o comando migrate
                fetch('/execute-migrate')
                    .then(response => response.json())
                    .then(data => {
                        // Exibe a saída do comando migrate
                        toastr.info(data.output);
                    })
                    .catch(error => {
                        toastr.error('Erro ao executar o comando migrate:', error);
                    });
            }
        });

        function setConfig(chave, valor) {
            showLoader();
            $.ajax({
                url: "{{ route('config.set_config') }}",
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    chave: chave,
                    valor: valor
                },
                success: function(response) {
                    hideLoader();
                    // Sucesso
                    toastr.success(response.message);
                },
                error: function(xhr, status, error) {
                    hideLoader();
                    // Trata os erros de validação retornados pelo servidor
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = '';

                    // Percorre os erros e os concatena em uma única string
                    $.each(errors, function(key, value) {
                        errorMessage += value[0] + '<br>';
                    });

                    // Exibe a mensagem de erro com Toastr.js
                    toastr.error(errorMessage, 'Erro');
                }
            });
        }
    </script>

    <script src="{{ assetr('assets/js/notifications/base.js') }}"></script>
    <script src="{{ assetr('assets/js/dev/helpers.js') }}" async></script>
    <script src="{{ assetr('assets/js/dev/backend-bundle.min.js') }}"></script>
    <script src="{{ assetr('assets/js/dev/table-treeview.js') }}"></script>
    <script src="{{ assetr('assets/js/dev/customizer.js') }}"></script>
    <script async src="{{ assetr('assets/js/dev/chart-custom.js') }}"></script>
    <script src="{{ assetr('assets/js/dev/app.js') }}"></script>
    <script src="{{ assetr('assets/js/dev/toastr.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/fontawesome.min.js"
        integrity="sha512-22flhOyPNWzkYE2LbBCEX+m5tw5RBuw0AKCKURp96YgdoPWNtGrWuViceL0Ey0L/sHZyZXPT53ofUlAI6E+u+g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
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


        let contador = 1;
        document.getElementById('btn_repetir_lote').addEventListener('click', function() {
            // Get the existing element to clone
            const originalElement = document.getElementById('repetir_');

            // Clone the original element
            const cloneElement = originalElement.cloneNode(true);

            // Numeração automática dos inputs
            cloneElement.querySelectorAll('input').forEach(function(input, index) {
                const elementId = input.getAttribute('id');
                const inputName = input.getAttribute('name');
                input.setAttribute('id', `${elementId}_${contador}`);
                input.setAttribute('name', `${inputName}_${contador}`);
                input.setAttribute('onchange', `addQtdTotal('#${elementId}_${contador}')`);
                input.value = "";
            });
            contador++;

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
            const regex = /^(\d{1,2})x(\d{1,3})x(\d{1,5})$/; // Aumentamos para até 5 dígitos na terceira parte
            if (!regex.test(valor)) {
                // Retorna o último valor válido
                $(input).val(valor.slice(0, -1));
                return;
            }

            // Formata o valor
            $(input).val(valor.replace(/(\d{1,2})x(\d{1,3})x(\d{1,5})/, '$1x$2x$3'));

            // Multiplica os números
            const partes = valor.split('x').map(Number); // Converte cada parte para número
            const quantidadeTotal = partes.reduce((total, valor) => total * valor, 1); // Multiplica todas as partes

            $('#qtd_total_estoque').val(quantidadeTotal);
        }
    </script>
</body>

</html>
