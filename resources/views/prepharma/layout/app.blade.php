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
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('prepharma/img/white__logo2.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if (request()->cookie('pwa_app') === 'true')
        <title>@yield('titulo', 'Página Inicial')</title>
    @else
        <title>@yield('titulo', 'Página Inicial') - {{ getConfig('nome_site') ?? env('APP_NAME') }}</title>
    @endif

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('prepharma/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('prepharma/css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('prepharma/plugins/alertify/alertify.min.css') }}">

    <link rel="stylesheet" href="{{ asset('prepharma/plugins/datatables/datatables.min.css') }}">

    <link rel="stylesheet" type="text/css" href="https://static.pharmatina.com/prepharma/assets/css/style.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('prepharma/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('prepharma/plugins/datatables/datatables.min.js') }}"></script>
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

        /* Global Loading Overlay Premium */
        .global-loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.95) 0%, rgba(118, 75, 162, 0.95) 100%);
            display: none; /* ativada via .active */
            z-index: 99999;
            backdrop-filter: blur(10px);
            /* Centralização perfeita independentemente de scroll/tamanho */
            place-items: center;
        }

        .global-loading-overlay.active {
            display: grid;
        }

        .global-loader-content {
            text-align: center;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            min-width: 240px;
        }

        .global-loader-spinner {
            width: 80px;
            height: 80px;
            margin: 0 auto 2rem;
            position: relative;
        }

        .global-loader-spinner::before,
        .global-loader-spinner::after {
            content: '';
            position: absolute;
            border-radius: 50%;
        }

        .global-loader-spinner::before {
            width: 100%;
            height: 100%;
            border: 4px solid rgba(255, 255, 255, 0.2);
        }

        .global-loader-spinner::after {
            width: 100%;
            height: 100%;
            border: 4px solid transparent;
            border-top-color: white;
            border-right-color: white;
            animation: spin 1s cubic-bezier(0.68, -0.55, 0.265, 1.55) infinite;
        }

        .global-loader-pulse {
            width: 80px;
            height: 80px;
            margin: 0 auto 2rem;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            animation: pulse 2s ease-in-out infinite;
        }

        .global-loader-text {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .global-loader-subtext {
            font-size: 0.9375rem;
            opacity: 0.9;
        }

        .global-loader-dots {
            display: inline-flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .global-loader-dots span {
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
            animation: bounce 1.4s ease-in-out infinite;
        }

        .global-loader-dots span:nth-child(2) {
            animation-delay: 0.2s;
        }

        .global-loader-dots span:nth-child(3) {
            animation-delay: 0.4s;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.6;
            }
        }

        @keyframes bounce {
            0%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-15px);
            }
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

    @stack('styles')
</head>

<body>
    <!-- Global Loading Overlay Premium -->
    <div class="global-loading-overlay" id="globalLoadingOverlay">
        <div class="global-loader-content">
            <div class="global-loader-spinner"></div>
            <div class="global-loader-text">Carregando</div>
            <div class="global-loader-subtext">Por favor, aguarde...</div>
            <div class="global-loader-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <!-- Loader -->
    {{-- <div class="loader-wrapper">
        <div class="loader-container">
            <div class="loader-ring"></div>
            <div class="loader-ring"></div>
            <div class="loader-ring"></div>
            <img src="{{ asset('prepharma/img/white__logo2.png') }}" alt="Logo" class="loader-logo">
            <div class="loader-text">
                A carregar<span class="loader-dots"></span>
            </div>
        </div>
    </div> --}}

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

    {{-- <script src="https://static.pharmatina.com/prepharma/assets/js/jquery-3.7.1.min.js"></script> --}}

    <script src="https://static.pharmatina.com/prepharma/assets/js/bootstrap.bundle.min.js"></script>

    <script src="https://static.pharmatina.com/prepharma/assets/js/feather.min.js"></script>

    <script src="https://static.pharmatina.com/prepharma/assets/js/jquery.slimscroll.js"></script>

    <script src="https://static.pharmatina.com/prepharma/assets/js/select2.min.js"></script>

    {{-- <script src="https://static.pharmatina.com/prepharma/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="https://static.pharmatina.com/prepharma/assets/plugins/datatables/datatables.min.js"></script> --}}

    <script src="https://static.pharmatina.com/prepharma/assets/plugins/moment/moment.min.js') }}" type="605432894161cb71178d599f-text/javascript"></script>
    <script src="https://static.pharmatina.com/prepharma/assets/js/bootstrap-datetimepicker.min.js') }}" type="605432894161cb71178d599f-text/javascript"></script>

    <script src="https://static.pharmatina.com/prepharma/assets/js/jquery.waypoints.js"></script>
    <script src="https://static.pharmatina.com/prepharma/assets/js/jquery.counterup.min.js"></script>


    <script src="https://static.pharmatina.com/prepharma/assets/js/circle-progress.min.js"></script>

    <script src="https://static.pharmatina.com/prepharma/assets/js/app.js"></script>

    <script src="{{ asset('prepharma/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js') }}"
        data-cf-settings="be6558ccd95e077c3366a663-|49" defer></script>
    <script>
        // Loader Control
        // document.onreadystatechange = function() {
        //     if (document.readyState === "complete") {
        //         setTimeout(function() {
        //             const loader = document.querySelector('.loader-wrapper');
        //             loader.classList.add('fade-out');
        //         }, 800);
        //     }
        // };
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
                        /* setTimeout(function() {
                            if (!mouseMoved) {
                                audioPlayed = false; // Reinicia a variável se o cursor não se mover
                            }
                        }, 2000); */
                    }
                },
                error: function(xhr, status, error) {
                    console.log('Erro ao buscar pedidos:', error);
                }
            });
        }
        function startRequestingPedidos() {
            buscarPedidos(); // Chama a função uma vez ao carregar a página
            //setInterval(buscarPedidos, 5000); // Chama a função a cada 5 segundos (5000 milissegundos)
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
    <script>
        (function () {
            // Detecta a URL base usada pelo helper assetr() inspecionando o CSS principal
            var mainCss = document.querySelector("link[href*='assets/css/style.css']");
            var assetsBase = window.location.origin + '/';
            if (mainCss && mainCss.href) {
                try {
                    var parts = mainCss.href.split('/assets/');
                    if (parts.length > 0) assetsBase = parts[0] + '/assets/';
                } catch (e) {
                    assetsBase = window.location.origin + '/assets/';
                }
            }

            window.Pharmatina = window.Pharmatina || {};
            window.Pharmatina.assetsBase = assetsBase;
            /**
             * Constrói URL completa para um recurso usando a mesma base que assetr().
             * Exemplo: Pharmatina.asset('prepharma/img/logo.png')
             */
            window.Pharmatina.assetr = function (path) {
                if (!path) return assetsBase;
                // Remove possíveis barras duplicadas
                return assetsBase.replace(/\/+$/, '/') + path.replace(/^\/+/, '');
            };

            // Persistência do estado do sidebar
            var SIDEBAR_KEY = 'pharmatina_sidebar_collapsed';
            var BODY_CLASS = 'mini-sidebar'; // classe aplicada ao body para minimizar (ajuste se seu tema usar outra)

            function applySidebarState() {
                try {
                    var collapsed = localStorage.getItem(SIDEBAR_KEY) === '1';
                    if (collapsed) document.body.classList.add(BODY_CLASS);
                    else document.body.classList.remove(BODY_CLASS);
                } catch (e) {
                    // localStorage pode falhar em ambientes restritos
                }
            }

            function toggleSidebarState() {
                var isCollapsed = document.body.classList.toggle(BODY_CLASS);
                try {
                    localStorage.setItem(SIDEBAR_KEY, isCollapsed ? '1' : '0');
                } catch (e) {}
            }

            document.addEventListener('DOMContentLoaded', function () {
                applySidebarState();

                var toggleBtn = document.getElementById('toggle_btn');
                var mobileBtn = document.getElementById('mobile_btn');

                if (toggleBtn) toggleBtn.addEventListener('click', function (e) { e.preventDefault(); toggleSidebarState(); });
                if (mobileBtn) mobileBtn.addEventListener('click', function (e) { /* mobile opens overlay, keep toggle for persistence */ toggleSidebarState(); });
            });

            // Utilidade para trocar CSS dinamicamente (ex.: temas remotos)
            window.Pharmatina.switchCss = function (relativePath) {
                if (!mainCss) return false;
                mainCss.href = window.Pharmatina.assetr(relativePath);
                return true;
            };
        })();
    </script>
    @stack('scripts')
    <!-- Widget de atualização de estoque (canto inferior esquerdo) -->
    <style>
        .stock-update-widget {
            position: fixed;
            left: 16px;
            bottom: 16px;
            z-index: 2000;
            background: rgba(46,55,164,0.95);
            color: #fff;
            padding: 10px 14px;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.18);
            display: flex;
            gap: 10px;
            align-items: center;
            min-width: 220px;
            max-width: 360px;
            transform: translateY(20px) translateX(-10px) scale(0.98);
            opacity: 0;
            pointer-events: none;
            transition: transform .28s ease, opacity .28s ease;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        }
        .stock-update-widget.show {
            transform: translateY(0) translateX(0) scale(1);
            opacity: 1;
            pointer-events: auto;
        }
        .stock-update-widget .icon {
            font-size: 20px;
            width: 36px;
            height: 36px;
            display:flex;
            align-items:center;
            justify-content:center;
            border-radius: 8px;
            background: rgba(255,255,255,0.08);
        }
        .stock-update-widget .text {
            display: flex;
            flex-direction: column;
            font-size: 13px;
            line-height: 1.1;
        }
        .stock-update-widget .text .title { font-weight: 600; margin-bottom: 2px; }
        .stock-update-widget .text .msg { font-weight: 400; opacity: .95; font-size: 12px }
        /* pulse animation */
        .stock-update-widget .pulse {
            width: 36px; height: 36px; border-radius: 8px; position: relative;
        }
        .stock-update-widget .pulse::after {
            content: '';
            position: absolute; inset: 0; border-radius: 8px;
            box-shadow: 0 0 0 0 rgba(255,255,255,0.06);
            animation: pulse 1.6s infinite;
            opacity: .6;
        }
        @keyframes pulse {
            0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255,255,255,0.06); }
            70% { transform: scale(1.08); box-shadow: 0 0 0 8px rgba(255,255,255,0.00); }
            100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(255,255,255,0.00); }
        }
        /* small dismiss button */
        .stock-update-widget .close-btn { margin-left: auto; color: rgba(255,255,255,0.9); cursor: pointer; background: transparent; border: none; }
        .stock-update-widget .close-btn:hover { opacity: .9 }
    </style>

    <div id="stockUpdateWidget" class="stock-update-widget" aria-hidden="true" role="status" aria-live="polite">
        <div style="display:flex; gap:10px; align-items:center;">
            <div class="icon pulse"><i class="fa-solid fa-box-open fa-fw spinner-icon"></i></div>
            <div class="text">
                <div class="title">A atualizar estoque</div>
                <div class="msg" id="stockUpdateMsg">A iniciar atualização...</div>
            </div>
        </div>
        <div id="stockUpdateLogs" style="margin-top:8px; width:100%; max-height:120px; overflow:auto; font-size:12px; opacity:.95; color:rgba(255,255,255,0.95); margin-left:46px; display:none;">
            <!-- logs appended aqui via JS -->
        </div>
    </div>

    <script>
        (function () {
            var widget = document.getElementById('stockUpdateWidget');
            var msgEl = document.getElementById('stockUpdateMsg');
            var logsEl = document.getElementById('stockUpdateLogs');

            // mensagens cicláveis (padrão) para animação
            var rotatingMessages = [
                'Pode demorar devido à internet lenta. Aguarde...',
                'A processar registros de estoque — isso pode levar alguns minutos...',
                'Sincronizando alterações pendentes...',
                'Verificando consistência dos lotes e saldos...'
            ];
            var rotateIndex = 0;
            var rotateTimer = null;

            // API global para controlar o widget e logs
            window.Pharmatina = window.Pharmatina || {};
            window.Pharmatina.showStockUpdate = function (message, options) {
                if (message) msgEl.textContent = message;
                widget.classList.add('show');
                widget.setAttribute('aria-hidden', 'false');
                // mostra logs se tiver conteúdo
                if (logsEl.children.length > 0) logsEl.style.display = 'block';
                // iniciar rotação de mensagens
                startRotation();
            };
            window.Pharmatina.hideStockUpdate = function () {
                widget.classList.remove('show');
                widget.setAttribute('aria-hidden', 'true');
                stopRotation();
            };
            window.Pharmatina.setStockUpdateMessage = function (message) {
                msgEl.textContent = message || '';
            };
            window.Pharmatina.addStockLog = function (text) {
                if (!text) return;
                var line = document.createElement('div');
                line.textContent = (new Date()).toLocaleTimeString() + ' — ' + text;
                logsEl.appendChild(line);
                logsEl.style.display = 'block';
                // manter scroll no final
                logsEl.scrollTop = logsEl.scrollHeight;
            };
            window.Pharmatina.clearStockLogs = function () {
                logsEl.innerHTML = '';
                logsEl.style.display = 'none';
            };

            function startRotation() {
                stopRotation();
                rotateTimer = setInterval(function () {
                    rotateIndex = (rotateIndex + 1) % rotatingMessages.length;
                    // anima fade
                    msgEl.style.opacity = '0';
                    setTimeout(function () {
                        msgEl.textContent = rotatingMessages[rotateIndex];
                        msgEl.style.transition = 'opacity .35s ease';
                        msgEl.style.opacity = '1';
                    }, 300);
                }, 4000);
            }
            function stopRotation() {
                if (rotateTimer) { clearInterval(rotateTimer); rotateTimer = null; }
            }

            // Atalho global: Ctrl + Alt + X (apenas Ctrl, não Cmd) para mostrar/ocultar o widget
            document.addEventListener('keydown', function (e) {
                try {
                    var ctrl = e.ctrlKey && !e.metaKey; // garantir Ctrl, não Cmd
                    if (ctrl && e.altKey && (e.key === 'x' || e.key === 'X')) {
                        e.preventDefault();
                        if (widget.classList.contains('show')) {
                            window.Pharmatina.hideStockUpdate();
                        } else {
                            window.Pharmatina.showStockUpdate(rotatingMessages[rotateIndex]);
                            widget.classList.add('flash');
                            setTimeout(function () { widget.classList.remove('flash'); }, 800);
                        }
                    }
                } catch (err) { /* silencioso */ }
            });

            // efeito spinner: alterna classe para girar o icon
            var spinnerIcon = widget.querySelector('.spinner-icon');
            if (spinnerIcon) {
                spinnerIcon.style.transition = 'transform .8s linear';
                // girar continuamente quando visível
                var spinInterval = setInterval(function () {
                    if (widget.classList.contains('show')) {
                        spinnerIcon.style.transform = 'rotate(360deg)';
                        setTimeout(function () { spinnerIcon.style.transform = 'rotate(0deg)'; }, 800);
                    }
                }, 900);
            }

            // parar rotação quando navegar/fechar
            window.addEventListener('beforeunload', function () {
                stopRotation();
                // Mostrar loading overlay ao recarregar
                if (typeof showLoading === 'function') {
                    showLoading();
                }
            });

            // Detectar CMD/CTRL + R
            document.addEventListener('keydown', function(e) {
                if ((e.metaKey || e.ctrlKey) && e.key === 'r') {
                    if (typeof showLoading === 'function') {
                        showLoading();
                    }
                }
            });

            // expor variáveis de teste
            window.Pharmatina._stockRotate = rotatingMessages;
        })();
    </script>

    <script>
        /**
         * Funções Globais de Loading Overlay
         * @author Augusto Kussema
         * @date 18/11/2025
         */
        window.showGlobalLoading = function(message = 'Carregando', subtext = 'Por favor, aguarde...') {
            const overlay = document.getElementById('globalLoadingOverlay');
            if (overlay) {
                const textEl = overlay.querySelector('.global-loader-text');
                const subtextEl = overlay.querySelector('.global-loader-subtext');

                if (textEl) textEl.textContent = message;
                if (subtextEl) subtextEl.textContent = subtext;

                overlay.classList.add('active');
            }
        };

        window.hideGlobalLoading = function() {
            const overlay = document.getElementById('globalLoadingOverlay');
            if (overlay) {
                overlay.classList.remove('active');
            }
        };

        /**
         * Event Listeners para Recarregamento de Página
         * Detecta CMD+R (Mac) / CTRL+R (Windows) e beforeunload
         * @author Augusto Kussema
         * @date 19/11/2025
         */
        // Listener para beforeunload (quando a página está sendo descarregada)
        window.addEventListener('beforeunload', function() {
            showGlobalLoading('Recarregando', 'Aguarde enquanto a página é recarregada...');
        });

        // Listener para CMD/CTRL + R
        document.addEventListener('keydown', function(e) {
            // Detecta CMD (Mac) ou CTRL (Windows/Linux) + R
            if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'r') {
                showGlobalLoading('Recarregando', 'Aguarde enquanto a página é recarregada...');
            }
        });

        // Corrigir travamento ao voltar (bfcache) e garantir centralização sempre
        window.addEventListener('pageshow', function(event) {
            // Quando voltar do histórico (bfcache), hide overlay
            hideGlobalLoading();
        });

        document.addEventListener('visibilitychange', function() {
            if (document.visibilityState === 'visible') {
                hideGlobalLoading();
            }
        });

        // Garantir que o loading seja escondido quando a página carregar
        window.addEventListener('load', function() {
            // Pequeno delay para evitar flash
            setTimeout(function() {
                hideGlobalLoading();
            }, 300);
        });

        // Uso nos AJAX:
        // $(document).ajaxStart(function() { showGlobalLoading(); });
        // $(document).ajaxStop(function() { hideGlobalLoading(); });
    </script>
</body>

</html>
