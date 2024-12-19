<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Terminal Artisan</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap">
    <style>
        body {
            font-family: 'Share Tech Mono', monospace;
            background: linear-gradient(135deg, #232526, #414345);
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            color: #00ff00;
        }

        #terminal-container {
            display: flex;
            width: 85%;
            max-width: 1300px;
            height: 90%;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 255, 0, 0.1);
            overflow: hidden;
            border: 2px solid #00ff00;
        }

        #terminal {
            width: 70%;
            background-color: #1e1e1e;
            padding: 20px;
            border-radius: 15px 0 0 15px;
            color: #00ff00;
            font-size: 16px;
            display: flex;
            flex-direction: column;
            box-shadow: inset 0 0 10px rgba(0, 255, 0, 0.2);
            height: 100%;
        }

        #terminal-output {
            flex-grow: 1;
            overflow-y: auto;
            padding: 15px;
            background-color: #1e1e1e;
            border-radius: 5px;
            margin-bottom: 15px;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        #terminal-input-container {
            display: flex;
            width: 100%;
            align-items: center;
        }

        #terminal-input {
            flex-grow: 1;
            padding: 15px;
            background-color: #333;
            color: #00ff00;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            outline: none;
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.2);
        }

        #execute-button, #clear-button {
            padding: 15px;
            background-color: #444;
            color: #00ff00;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            margin-left: 10px;
            transition: background-color 0.3s, transform 0.2s ease;
        }

        #execute-button:hover, #clear-button:hover {
            background-color: #555;
            transform: scale(1.05);
        }

        #commands-list {
            width: 30%;
            background-color: #222;
            color: #fff;
            padding: 20px;
            border-radius: 0 15px 15px 0;
            overflow-y: auto;
            height: 100%;
            border-left: 2px solid #00ff00;
            box-shadow: inset 0 0 10px rgba(0, 255, 0, 0.1);
        }

        #commands-list ul {
            list-style-type: none;
            padding: 0;
        }

        #commands-list li {
            padding: 8px 0;
            border-bottom: 1px solid #333;
            transition: background-color 0.3s, transform 0.2s ease;
        }

        #commands-list li:hover {
            background-color: #444;
            cursor: pointer;
            transform: scale(1.05);
        }

        pre {
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        h3 {
            font-size: 20px;
            text-align: center;
            color: #00ff00;
            margin-bottom: 15px;
            font-weight: bold;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        #terminal-output {
            animation: fadeIn 1s ease-out;
        }

        #terminal-input:focus {
            box-shadow: 0 0 15px rgba(0, 255, 0, 0.5);
        }
    </style>
</head>
<body>
    <div id="terminal-container">
        <!-- Terminal -->
        <div id="terminal">
            <div id="terminal-input-container">
                <input type="text" id="terminal-input" placeholder="Digite o comando..." />
                <button id="execute-button">Executar</button>
                <button id="clear-button">Limpar</button>
            </div>
            <div id="terminal-output"></div>
        </div>
        <!-- Lista de Comandos -->
        <div id="commands-list">
            <h3>Comandos Artisan</h3>
            <ul id="command-list-items"></ul>
        </div>
    </div>

    <script>
        const terminalInput = document.getElementById('terminal-input');
        const terminalOutput = document.getElementById('terminal-output');
        const commandListItems = document.getElementById('command-list-items');
        const executeButton = document.getElementById('execute-button');
        const clearButton = document.getElementById('clear-button');

        // Carregar lista de comandos Artisan do backend
        fetch('/get-artisan-commands')
            .then(response => response.json())
            .then(data => {
                const commands = data.commands;
                // Preenche a lista de comandos no painel da direita
                commands.forEach(command => {
                    const li = document.createElement('li');
                    li.textContent = command;
                    li.addEventListener('click', () => {
                        terminalInput.value = command;
                    });
                    commandListItems.appendChild(li);
                });
            })
            .catch(error => {
                console.error('Erro ao carregar os comandos:', error);
            });

        // Lógica de enviar comando
        function sendCommand() {
            const input = terminalInput.value;
            if (!input) return;

            // Exibe o comando que foi digitado
            terminalOutput.innerHTML += "<pre>Comando: " + input + "</pre>";

            // Se o comando for 'clear', limpa o terminal
            if (input.toLowerCase() === 'clear' || input.toLowerCase() === 'cls') {
                terminalOutput.innerHTML = '';  // Limpa a saída
                return;
            }

            fetch('/run-command', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ command: input })
            })
            .then(response => response.json())
            .then(data => {
                const output = data.output;
                // Exibe a saída do comando
                terminalOutput.innerHTML += "<pre>" + output + "</pre>";
                terminalOutput.scrollTop = terminalOutput.scrollHeight; // Garante que sempre role até o fim
            })
            .catch(error => {
                console.error('Erro ao executar o comando:', error);
            });

            terminalInput.value = ''; // Limpa o input
        }

        // Enviar comando quando pressionar Enter ou clicar no botão
        terminalInput.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                sendCommand();
            }
        });

        executeButton.addEventListener('click', sendCommand);

        // Limpar a tela quando o botão "Limpar" for pressionado
        clearButton.addEventListener('click', function () {
            terminalOutput.innerHTML = ''; // Limpa a saída do terminal
        });

        
    </script>
</body>
</html>
