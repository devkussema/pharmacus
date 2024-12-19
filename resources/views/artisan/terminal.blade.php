<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terminal Interativo - Kali Linux Style</title>
    <style>
        /* Configurações Globais */
        body {
            font-family: 'SF Mono', 'Courier New', Courier, monospace;
            background-color: #0A0A0A; /* Fundo preto */
            color: #00FF00; /* Texto verde */
            margin: 0;
            padding: 0;
        }

        /* Estilo do Terminal */
        #terminal {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background: #111; /* Fundo escuro */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.8); /* Sombra para dar destaque */
            color: #00FF00; /* Texto verde brilhante */
            font-size: 16px;
            font-family: 'SF Mono', 'Courier New', Courier, monospace;
            line-height: 1.5;
        }

        /* Logo do site no topo */
        #logo-container {
            text-align: center;
            margin-bottom: 20px;
        }

        #logo-container img {
            max-width: 200px;
            height: auto;
        }

        /* Saída do terminal */
        #terminal-output {
            white-space: pre-wrap;
            font-family: 'SF Mono', 'Courier New', Courier, monospace;
            color: #00FF00; /* Texto verde */
            background-color: #0A0A0A; /* Fundo preto */
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #444; /* Borda suave */
            margin-bottom: 20px;
            min-height: 100px;
        }

        /* Estilo para o campo de input do comando */
        #command-input {
            width: 100%;
            padding: 10px;
            font-family: 'SF Mono', 'Courier New', Courier, monospace;
            background: #111;
            color: #00FF00; /* Verde */
            border: none;
            border-radius: 5px;
            font-size: 16px;
            outline: none;
            box-sizing: border-box;
        }

        #command-input:focus {
            outline: none;
        }

        /* Estilo do Prompt */
        .prompt {
            color: #ff9900; /* Cor laranja para o prompt */
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div id="terminal">
        <!-- Logo do site no topo -->
        <div id="logo-container">
            <img src="{{ assetr('assets/img/white__logo2.png')}}" width="70" height="70" alt>
        </div>

        <!-- Área do terminal (onde os comandos e saídas são exibidos) -->
        <div id="terminal-output"></div>

        <!-- Campo para digitar comandos -->
        <div id="prompt" class="prompt">user@pharmacus:~$</div>
        <input id="command-input" type="text" placeholder="Digite o comando..." autofocus>
    </div>

    <script>
        function clearTerminal() {
            document.getElementById('terminal-output').innerHTML = '';
        }

        function processCommand(input) {
            if (input.toLowerCase() === 'clear') {
                clearTerminal(); // Limpa a tela do terminal
                return;
            }

            // Se não for o comando "clear", você pode processar outros comandos
            executeCommand(input);
        }

        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }

        function executeCommand(input) {
            fetch('/run-command', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': getCsrfToken()
                },
                body: JSON.stringify({ command: input })
            })
            .then(response => response.json())
            .then(data => {
                const output = data.output;
                // Adiciona a saída do comando na tela
                const terminalOutput = document.getElementById('terminal-output');
                terminalOutput.innerHTML += "<pre>" + output + "</pre>"; // Exibe a saída exatamente como está
                terminalOutput.scrollTop = terminalOutput.scrollHeight; // Auto scroll
            })
            .catch(error => {
                console.error('Erro ao executar o comando:', error);
            });
        }

        document.getElementById('command-input').addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                let input = e.target.value;
                processCommand(input);
                e.target.value = ''; // Limpa o campo de input
            }
        });
    </script>
</body>
</html>
