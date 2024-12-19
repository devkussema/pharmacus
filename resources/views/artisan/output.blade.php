<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comando Artisan: {{ $command }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .output-container {
            margin-top: 20px;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #ddd;
            background-color: #f8f9fa;
        }
        .output-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .output-content {
            background-color: #1e1e1e;
            color: #fff;
            padding: 15px;
            border-radius: 5px;
            font-family: monospace;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
        .error-message {
            color: red;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Resultado do Comando Artisan: <span class="text-muted">{{ $command }}</span></h1>

        @if(isset($output))
            <div class="output-container">
                <div class="output-title">Saída do Comando:</div>
                <div class="output-content">{{ $output }}</div>
            </div>
        @else
            <div class="error-message mt-4">
                <strong>Erro:</strong> O comando não retornou uma saída válida.
            </div>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
