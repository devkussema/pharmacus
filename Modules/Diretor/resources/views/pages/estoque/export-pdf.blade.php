<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Estoque - Pharmacus</title>
    <style>
        @media print {
            @page {
                size: A4 landscape;
                margin: 15mm;
            }
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 11pt;
            line-height: 1.4;
            color: #1f2937;
            background: white;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #2563eb;
        }
        
        .header h1 {
            color: #2563eb;
            font-size: 24pt;
            margin-bottom: 5px;
        }
        
        .header p {
            color: #6b7280;
            font-size: 10pt;
        }
        
        .meta-info {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            font-size: 9pt;
            color: #6b7280;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        th {
            background: #f3f4f6;
            color: #374151;
            font-weight: 600;
            text-align: left;
            padding: 12px 8px;
            border-bottom: 2px solid #e5e7eb;
            font-size: 10pt;
        }
        
        td {
            padding: 10px 8px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 10pt;
        }
        
        tr:hover {
            background: #f9fafb;
        }
        
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 8pt;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .status-badge.normal {
            background: rgba(34, 197, 94, 0.1);
            color: #059669;
        }
        
        .status-badge.warning {
            background: rgba(245, 158, 11, 0.1);
            color: #d97706;
        }
        
        .status-badge.critical {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }
        
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 8pt;
            color: #9ca3af;
        }
        
        .print-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #2563eb;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12pt;
            font-weight: 600;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .print-btn:hover {
            background: #1d4ed8;
        }
        
        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <button class="print-btn" onclick="window.print()">
        🖨️ Imprimir / Salvar PDF
    </button>
    
    <div class="header">
        <h1>📊 Relatório de Estoque</h1>
        <p>Pharmacus - Sistema de Gestão Farmacêutica Hospitalar</p>
    </div>
    
    <div class="meta-info">
        <div>
            <strong>Data de Emissão:</strong> {{ date('d/m/Y H:i') }}
        </div>
        <div>
            <strong>Total de Produtos:</strong> {{ count($produtos) }}
        </div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Medicamento</th>
                <th>Categoria</th>
                <th style="text-align: center;">Quantidade</th>
                <th>Lote</th>
                <th>Validade</th>
                <th>Fornecedor</th>
                <th style="text-align: center;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
                @php
                    $quantidade = $produto->quantidade ?? 0;
                    $status = 'normal';
                    $statusLabel = 'Normal';
                    
                    if ($quantidade <= 20) {
                        $status = 'critical';
                        $statusLabel = 'Crítico';
                    } elseif ($quantidade <= 50) {
                        $status = 'warning';
                        $statusLabel = 'Mínimo';
                    }
                @endphp
                <tr>
                    <td>
                        <strong>{{ $produto->designacao }}</strong>
                        @if($produto->dosagem)
                            <span style="color: #6b7280;"> {{ $produto->dosagem }}</span>
                        @endif
                    </td>
                    <td>{{ $produto->grupo_farmaco ? $produto->grupo_farmaco->nome : 'Sem Categoria' }}</td>
                    <td style="text-align: center;"><strong>{{ $quantidade }}</strong></td>
                    <td><code style="font-family: monospace; font-size: 9pt;">{{ $produto->num_lote ?? 'N/A' }}</code></td>
                    <td>{{ $produto->data_expiracao ? $produto->data_expiracao->format('d/m/Y') : 'N/A' }}</td>
                    <td>{{ $produto->fornecedor ?? 'N/A' }}</td>
                    <td style="text-align: center;">
                        <span class="status-badge {{ $status }}">{{ $statusLabel }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        <p>Documento gerado automaticamente pelo sistema Pharmacus</p>
        <p>© {{ date('Y') }} Pharmacus - Todos os direitos reservados</p>
    </div>
    
    <script>
        // Auto-print ao abrir (opcional - comentado para não forçar)
        // window.onload = () => window.print();
    </script>
</body>
</html>
