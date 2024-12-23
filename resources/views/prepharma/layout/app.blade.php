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
    </style>
</head>

<body>
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

    <script src="{{ assetr('assets/js/bootstrap.bundle.min.js') }}" type="be6558ccd95e077c3366a663-text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.8.1/feather.js" type="be6558ccd95e077c3366a663-text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{ assetr('assets/js/jquery.slimscroll.js')}}" type="be6558ccd95e077c3366a663-text/javascript"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>
    <script src="{{ assetr('assets/plugins/alertify/custom-alertify.min.js')}}" type="b8abefe4dfcd6d5a94855793-text/javascript"></script>

    <script src="{{ assetr('assets/js/app.js')}}" type="be6558ccd95e077c3366a663-text/javascript"></script>
    <script src="{{ assetr('assets/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}"
        data-cf-settings="be6558ccd95e077c3366a663-|49" defer></script>
    <script>
        function playAudio() {
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
