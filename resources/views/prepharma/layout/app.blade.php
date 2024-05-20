<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ assetr('assets/img/white__logo2.png') }}">

    @if (request()->cookie('pwa_app') === 'true')
        <title>@yield('titulo', 'Página Inicial')</title>
    @else
        <title>@yield('titulo', 'Página Inicial') - {{ getConfig('nome_site') ?? env('APP_NAME') }}</title>
    @endif

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ assetr('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <link rel="stylesheet" href="{{ assetr('assets/plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetr('assets/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ assetr('assets/css/feather.css') }}">
    <link rel="stylesheet" href="{{ assetr('assets/plugins/alertify/alertify.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ assetr('assets/css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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


    <script src="{{ asset('/sw2.js') }}"></script>

    <script src="{{ assetr('assets/js/bootstrap.bundle.min.js') }}" type="be6558ccd95e077c3366a663-text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.8.1/feather.js" type="be6558ccd95e077c3366a663-text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="{{ assetr('assets/js/jquery.slimscroll.js')}}" type="be6558ccd95e077c3366a663-text/javascript"></script>

    <script src="{{ assetr('assets/plugins/select2/js/select2.min.js')}}" type="9137142106e3c9dc1463738a-text/javascript"></script>
    <script src="{{ assetr('assets/plugins/select2/js/custom-select.js')}}" type="9137142106e3c9dc1463738a-text/javascript"></script>


    <script src="{{ assetr('assets/plugins/datatables/jquery.dataTables.min.js')}}" type="be6558ccd95e077c3366a663-text/javascript"></script>
    <script src="{{ assetr('assets/plugins/datatables/datatables.min.js')}}" type="be6558ccd95e077c3366a663-text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js"></script>
    <script src="{{ assetr('assets/plugins/alertify/custom-alertify.min.js')}}" type="b8abefe4dfcd6d5a94855793-text/javascript"></script>

    <script src="{{ assetr('assets/js/app.js')}}" type="be6558ccd95e077c3366a663-text/javascript"></script>
    <script src="{{ assetr('assets/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}"
        data-cf-settings="be6558ccd95e077c3366a663-|49" defer></script>
    <script>
        function setDescritivo() {
            // Captura os valores dos inputs
            var caixa = document.getElementById('caixa').value;
            var caixinha = document.getElementById('caxinha').value;
            var unidade = document.getElementById('unidade').value;

            // Verifica se todos os campos estão preenchidos
            if (caixa && caixinha && unidade) {
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
