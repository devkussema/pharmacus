<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    @php
        $id_area_ = auth()->user()->isFarmacia
            ? optional(\App\Models\AreaHospitalar::where('nome', 'Armazém I')->first())->id
            : optional(@auth()->user()->farmacia->area_hospitalar)->id ?? 0;
    @endphp
    <meta name="area_id_" content="{{ $id_area_ }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ assetr('assets/img/white__logo2.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (request()->cookie('pwa_app') === 'true')
        <title>@yield('titulo', 'Página Inicial')</title>
    @else
        <title>@yield('titulo', 'Página Inicial') - {{ getConfig('nome_site') ?? env('APP_NAME') }}</title>
    @endif

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <link rel="stylesheet" type="text/css" href="{{ assetr('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ assetr('assets/css/feather.css') }}">
    <link rel="stylesheet" href="{{ assetr('assets/plugins/alertify/alertify.min.css') }}">

    <link rel="stylesheet" href="{{ assetr('assets/plugins/datatables/datatables.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ assetr('assets/css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ assetr('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ assetr('assets/plugins/datatables/datatables.min.js') }}"></script>
    <style>
        /* Oculta a barra de pesquisa padrão do DataTables */
        .dataTables_wrapper .dataTables_filter {
            display: none;
        }

        /* Loader Styles */
        .loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: all 0.3s ease-out;
        }

        .loader-container {
            text-align: center;
            position: relative;
        }

        .loader-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            animation: float 3s ease-in-out infinite;
            filter: drop-shadow(0 5px 15px rgba(0,0,0,0.1));
        }

        .loader-ring {
            position: absolute;
            width: 100px;
            height: 100px;
            border: 4px solid transparent;
            border-radius: 50%;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .loader-ring:nth-child(1) {
            border-top-color: #2E37A4;
            animation: spin 1s linear infinite;
        }

        .loader-ring:nth-child(2) {
            border-right-color: #00d2ff;
            animation: spin 1s linear infinite reverse;
        }

        .loader-ring:nth-child(3) {
            width: 120px;
            height: 120px;
            top: -20px;
            border-bottom-color: #2E37A4;
            animation: spin 2s linear infinite;
        }

        .loader-text {
            color: #2E37A4;
            font-size: 18px;
            margin-top: 15px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            font-weight: 500;
            opacity: 0;
            animation: fadeInUp 0.5s ease forwards 0.5s;
        }

        .loader-dots::after {
            content: '.';
            animation: dots 1.5s steps(5, end) infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-10px);
            }
            100% {
                transform: translateY(0px);
            }
        }

        @keyframes spin {
            0% { transform: translateX(-50%) rotate(0deg); }
            100% { transform: translateX(-50%) rotate(360deg); }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes dots {
            0%, 20% { content: '.'; }
            40% { content: '..'; }
            60% { content: '...'; }
            80%, 100% { content: ''; }
        }

        .loader-wrapper.fade-out {
            opacity: 0;
            visibility: hidden;
        }

        .performance-warning {
            margin-top: 15px;
            padding: 10px 15px;
            background: #fff3e0;
            border-radius: 4px;
            display: none;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>

<body>
    <!-- Loader -->
    <div class="loader-wrapper">
        <div class="loader-container">
            <div class="loader-ring"></div>
            <div class="loader-ring"></div>
            <div class="loader-ring"></div>
            <img src="{{ assetr('assets/img/white__logo2.png') }}" alt="Logo" class="loader-logo">
            <div class="loader-text">
                A carregar<span class="loader-dots"></span>
            </div>
        </div>
    </div>

    <div class="main-wrapper">
        @include('partials.header')

        @include('partials.sidebar')

        <div class="page-wrapper">
            @yield('content')

            @include('partials.notification-box')
        </div>
    </div>

    <audio id="audioPlayer" style="display: none">
        <source src="{{ asset('assets/audio/sound_notify.mp3') }}" type="audio/mpeg">
        Seu navegador não suporta o elemento de áudio.
    </audio>
    <script src="{{ asset('/sw2.js') }}"></script>

    <script src="{{ assetr('assets/js/jquery-3.7.1.min.js')}}"></script>

    <script src="{{ assetr('assets/js/bootstrap.bundle.min.js')}}"></script>

    <script src="{{ assetr('assets/js/feather.min.js')}}"></script>

    <script src="{{ assetr('assets/js/jquery.slimscroll.js')}}"></script>

    <script src="{{ assetr('assets/js/select2.min.js')}}"></script>

    <script src="{{ assetr('assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ assetr('assets/plugins/datatables/datatables.min.js')}}"></script>

    <script src="{{ assetr('assets/js/jquery.waypoints.js')}}"></script>
    <script src="{{ assetr('assets/js/jquery.counterup.min.js')}}"></script>

    <script src="{{ assetr('assets/plugins/apexchart/apexcharts.min.js')}}"></script>
    {{-- <script src="{{ assetr('assets/plugins/apexchart/chart-data.js')}}"></script> --}}
    <script src="{{ assetr('plugins/charts/chart1.js')}}"></script>

    <script src="{{ assetr('assets/js/circle-progress.min.js')}}"></script>

    <script src="{{ assetr('assets/js/app.js')}}"></script>

    <script src="{{ assetr('assets/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}"
        data-cf-settings="be6558ccd95e077c3366a663-|49" defer></script>
    <script>
        // Loader Control
        document.onreadystatechange = function() {
            if (document.readyState === "complete") {
                setTimeout(function() {
                    const loader = document.querySelector('.loader-wrapper');
                    loader.classList.add('fade-out');
                }, 800);
            }
        };        function playAudio() {
            var audio = document.getElementById('audioPlayer');
            audio.play();
        }

        var audioPlayed = false;
        var alertActive = false;
        var mouseMoved = false;
        var userInteracted = false;
        function buscarPedidos() {
            if (alertActive) {
                return; // Não faz a solicitação se a modal estiver ativa
            }

            $.ajax({
                url: '/api/get/pedidos', // URL da rota no Laravel
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response > 0 && !audioPlayed) { // Acessando corretamente a contagem de pedidos
                        alertActive = false;
                        var msg1 = "Um pedido";
                        var msg2 = response+" pedidos";
                        if (response == 1) {
                            alertify.alert(msg1, 'Por favor, atenda-os.', function(){
                                alertActive = false;
                                window.location.href = '/pedidos';
                            });
                        }else if (response > 1) {
                            alertify.alert(msg2, 'Por favor, atenda-os.', function(){
                                alertActive = false;
                                window.location.href = '/pedidos';
                            });
                        }

                        playAudio();
                        audioPlayed = 0;

                        // Reinicia a variável audioPlayed após 2 segundos se o cursor não se mover
                        setTimeout(function() {
                            if (!mouseMoved) {
                                audioPlayed = false; // Reinicia a variável se o cursor não se mover
                            }
                        }, 2000);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Erro ao buscar pedidos:', error);
                }
            });
        }
        function startRequestingPedidos() {
            buscarPedidos(); // Chama a função uma vez ao carregar a página
            setInterval(buscarPedidos, 5000); // Chama a função a cada 5 segundos (5000 milissegundos)
        }
        @if (Route::currentRouteName() != "pedido" and Route::currentRouteName() != "pedido.atender")
            $(document).ready(function() {
                startRequestingPedidos();

                // Evento para detectar movimento do cursor
                $(document).mousemove(function() {
                    mouseMoved = true;
                });
            });
        @endif


        document.addEventListener('DOMContentLoaded', function() {
            // Verifica se a DataTable já foi inicializada
            if (!$.fn.DataTable.isDataTable('#table-content')) {
                // Inicializa a DataTable apenas se ainda não tiver sido inicializada
                var table = $('#table-content').DataTable({
                    // Configurações da DataTable
                    "language": {
                        "search": "Filtrar resultados:",
                        "zeroRecords": "Nenhum resultado encontrado",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                        "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
                        "infoFiltered": "(filtrado de _MAX_ entradas no total)",
                        "lengthMenu": "Mostrar _MENU_ entradas",
                        "paginate": {
                            "first": "Primeiro",
                            "last": "Último",
                            "next": "Próximo",
                            "previous": "Anterior"
                        }
                    }
                });

                // Aplica o filtro ao input de busca personalizado
                $('#search-table').on('keyup', function() {
                    // Obtém a instância da DataTable
                    var table = $('#table-content').DataTable();

                    // Aplica o filtro ao DataTable usando o valor do campo de pesquisa personalizado
                    table.search(this.value).draw();
                });
            }

            // Seleciona todos os elementos input com a classe "form-control"
            var inputs = document.querySelectorAll('.form-control');

            // Itera sobre cada elemento e aplica o estilo desejado
            inputs.forEach(function(input) {
                input.style.borderRadius = '5px'; // Define o raio da borda
                input.style.borderColor = '#2E37A4'; // Define a cor da borda
            });
        });

        function setDescritivo() {
            // Captura os valores dos inputs
            var caixa = document.getElementById('caixa').value;
            var caixinha = document.getElementById('caxinha').value;
            var unidade = document.getElementById('unidade').value;

            // Verifica se todos os campos estão preenchidos
            if (caixa && caixinha && unidade) {
                document.getElementById('qtd_total_estoque').disabled = false;
                // Concatena os valores com 'x' no meio
                var concatenatedValue = caixa + 'x' + caixinha + 'x' + unidade;

                // Concatena os valores com 'x' no meio
                var alertMessage = caixa + 'x' + caixinha + 'x' + unidade;

                // Multiplica os valores
                var product = Number(caixa) * Number(caixinha) * Number(unidade);

                // Adiciona o valor concatenado no input hidden 'descritivo'
                document.getElementById('descritivo').value = concatenatedValue;

                // Adiciona o resultado da multiplicação no input 'qtd_total_estoque'
                document.getElementById('qtd_total_estoque').value = product;
                document.getElementById('qtd_total_estoque').style.display = 'block';
            } else {
                alertify.alert('Ocorreu um erro', 'Por favor, preencha todos os campos.', function() {
                    alertify.success("Ok");
                });
            }
        };

        if ("serviceWorker" in navigator) {
            // Register a service worker hosted at the root of the
            // site using the default scope.
            navigator.serviceWorker.register("/sw1.js").then(
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
        document.addEventListener('DOMContentLoaded', function() {
            $('#tipo_produto_estoque').change(function() {
                if ($(this).val() === 'descartável') {
                    $('#item_descartavel').fadeIn();
                    $('#item_medicamento').fadeOut();
                } else {
                    $('#item_descartavel').fadeOut();
                    $('#item_medicamento').fadeIn();
                }
            });
        });

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

            $('#formProdutoEstoque #qtd_total_estoque').val(quantidadeTotal);
        }
    </script>
</body>

</html>
