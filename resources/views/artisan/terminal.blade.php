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

        /* Terminal principal */
        #terminal {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            padding: 10px;
        }

        #terminal-output {
            flex-grow: 1;
            overflow-y: auto;
            padding: 10px;
            background: #000;
            border: 1px solid #333;
            margin-bottom: 10px;
        }

        #terminal-input-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        #terminal-input {
            flex-grow: 1;
            padding: 5px;
            font-size: 14px;
            background: #252525;
            color: #00ff00;
            border: 1px solid #333;
        }

        #execute-button,
        #clear-button {
            padding: 5px;
            background-color: #444;
            color: #00ff00;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            margin-left: 10px;
            transition: background-color 0.3s, transform 0.2s ease;
        }

        #execute-button:hover,
        #clear-button:hover {
            background-color: #555;
            transform: scale(1.05);
        }

        /* Lista de comandos */
        #commands-list {
            width: 20%;
            background: #252525;
            padding: 10px;
            border-right: 1px solid #333;
            overflow-y: auto;
        }

        #commands-list h3 {
            color: #fff;
            margin-bottom: 10px;
        }

        #commands-list ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #commands-list li {
            padding: 5px 0;
            color: #ccc;
            cursor: pointer;
        }

        #commands-list li:hover {
            color: #00ff00;
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

        #command-type {
            background: #252525;
            color: #00ff00;
            border: 1px solid #333;
            padding: 5px;
        }

        button {
            background: #333;
            color: #00ff00;
            border: 1px solid #00ff00;
            padding: 5px 10px;
            cursor: pointer;
        }

        button:hover {
            background: #444;
        }
    </style>
</head>

<body>
    <div id="terminal-container">
        <!-- Terminal -->
        <div id="terminal">
            <div id="terminal-input-container">
                <select id="command-type">
                    <option value="artisan">Artisan</option>
                    <option value="composer">Composer</option>
                    <option value="terminal">Terminal</option>
                </select>
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
        function escapeHTML(str) {
            // Função para escapar caracteres especiais no HTML
            return str
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;')
                .replace(/'/g, '&#039;');
        }

        function sendCommand() {
            const terminalInput = document.getElementById('terminal-input');
            const commandType = document.getElementById('command-type').value; // Tipo de comando
            const command = terminalInput.value.trim(); // Comando digitado

            // Mapeamento de endpoints por tipo de comando
            const endpointMap = {
                artisan: '/run-command',
                composer: '/run-composer',
                terminal: '/run-terminal',
            };

            if (!command) return; // Não faz nada se o comando estiver vazio

            // Exibe o comando digitado no terminal
            const terminalOutput = document.getElementById('terminal-output');
            terminalOutput.innerHTML += `<pre><strong>${escapeHTML(commandType)}:</strong> ${escapeHTML(command)}</pre>`;

            // Determina o endpoint baseado no tipo de comando
            const endpoint = endpointMap[commandType];

            // Cria o comando completo com base no tipo de comando
            let fullCommand;
            if (commandType === 'artisan') {
                fullCommand = `php artisan ${command}`;
            } else if (commandType === 'composer') {
                fullCommand = `composer ${command}`;
            } else if (commandType === 'terminal') {
                fullCommand = command; // No terminal, o comando é passado diretamente
            }

            // Faz a requisição para o backend
            fetch(endpoint, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                    body: JSON.stringify({
                        command: fullCommand
                    }),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const reader = response.body.getReader();
                    const decoder = new TextDecoder();
                    let done = false;

                    const stream = async () => {
                        while (!done) {
                            const {
                                value,
                                done: readerDone
                            } = await reader.read();
                            done = readerDone;

                            // Decodifica e exibe a saída no terminal
                            const str = decoder.decode(value, {
                                stream: true
                            });
                            terminalOutput.innerHTML += `<pre>${escapeHTML(str)}</pre>`;
                            terminalOutput.scrollTop = terminalOutput
                            .scrollHeight; // Rola para o final do terminal
                        }
                    };

                    stream();
                })
                .catch(error => {
                    console.error('Erro ao executar o comando:', error);
                    terminalOutput.innerHTML +=
                        `<pre style="color: red;">Erro ao executar o comando: ${escapeHTML(error.message)}</pre>`;
                });

            terminalInput.value = ''; // Limpa o campo de entrada
        }




        // Enviar comando quando pressionar Enter ou clicar no botão
        terminalInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                sendCommand();
            }
        });

        executeButton.addEventListener('click', sendCommand);

        // Limpar a tela quando o botão "Limpar" for pressionado
        clearButton.addEventListener('click', function() {
            terminalOutput.innerHTML = ''; // Limpa a saída do terminal
        });
    </script>
</body>

</html>
