<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Artisan Terminal</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <style>
        body {
            font-family: 'Fira Code', monospace;
            background: radial-gradient(circle, #1a202c, #111827);
            color: #ffffff;
            height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #terminal {
            width: 90%;
            max-width: 800px;
            background: linear-gradient(145deg, #2d3748, #1a202c);
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        #output {
            flex: 1;
            background: #1a202c;
            color: #a0aec0;
            padding: 15px;
            border-radius: 10px;
            font-size: 14px;
            overflow-y: auto;
            white-space: pre-wrap;
            border: 1px solid #4a5568;
            margin-bottom: 15px;
        }

        input[type="text"] {
            padding: 12px 15px;
            font-size: 16px;
            color: #ffffff;
            background: #2d3748;
            border: 1px solid #4a5568;
            border-radius: 10px;
            outline: none;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus {
            border-color: #63b3ed;
        }

        button {
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            background: #63b3ed;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button:hover {
            background: #4299e1;
        }

        .button-group {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 10px;
        }

        button.clear-button {
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            color: #ffffff;
            background: #e53e3e;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s;
        }

        button.clear-button:hover {
            background: #c53030;
        }

        h1 {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            color: #63b3ed;
            margin-bottom: 20px;
        }
    </style>
</head>

<body class="flex flex-col items-center justify-center min-h-screen">
    <h1 class="text-3xl font-bold mb-4 text-green-400">Artisan Command Terminal</h1>
    <div id="terminal">
        <h1>Laravel Artisan Terminal</h1>
        <div id="output">Welcome to the Laravel Artisan Terminal. 🚀\nType a command and hit Run!</div>
        <input type="text" id="command" placeholder="Enter Artisan Command" />
        <button id="runCommand">Run Command</button>
        <button id="clearOutput" class="clear-button">Clear</button>
    </div>
    <script>
        document.getElementById('runCommand').addEventListener('click', async () => {
            const command = document.getElementById('command').value.trim();
            if (!command) return alert('Please enter a command!');

            const output = document.getElementById('output');
            output.textContent += `\n> ${command}`;

            try {
                const response = await fetch('/artisan/run', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        command
                    })
                });
                const data = await response.json();
                output.textContent += `\n${data.output}\n`;
            } catch (error) {
                output.textContent += `\nError: Unable to execute command.\n`;
            }
        });

        // Nova função para limpar a tela
        document.getElementById('clearOutput').addEventListener('click', () => {
            document.getElementById('output').textContent =
                "Welcome to the Laravel Artisan Terminal. 🚀\nType a command and hit Run!";
        });
    </script>
</body>

</html>
