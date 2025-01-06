<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", sans-serif;
            padding-bottom: 80px; /* Espaço extra para o rodapé fixo */
            margin: 0;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .container {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }

        .header img {
            display: block;
            margin: 0 auto;
            width: 50px;
            height: 50px;
        }

        .header h4 {
            margin: 5px 0;
        }

        .signature-right {
            position: absolute;
            top: 0;
            right: 20px;
            text-align: right;
            font-size: 14px;
            line-height: 1.5;
        }

        .signature-right .line {
            display: block;
            margin-top: 10px;
            border-top: 1px solid black;
            width: 200px;
        }

        .tbl-container {
            margin: 0 auto;
            width: 100%;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        th {
            background-color: #f2f2f2;
        }

        .group-header {
            background-color: #e0e0e0;
            font-weight: bold;
            text-align: left;
            padding: 8px;
        }

        /* Rodapé fixo */
        .footer {
            position: fixed;
            bottom: 0; /* Distância para o rodapé fixo */
            left: 0;
            right: 0;
            text-align: center;
            font-size: 14px;
            color: gray;
            padding: 10px 0;
            border-top: 1px solid #ddd;
            background-color: white;
        }

        .footer .line {
            margin-top: 10px;
            border-top: 1px solid black;
            display: inline-block;
            width: 200px;
        }

        .footer small {
            display: block;
            margin-top: 10px;
            font-size: 12px;
        }

        /* Rodapé fixo em todas as páginas */
        @media print {
            .print-footer {
                display: none;
            }

            .footer-signature {
                display: none;
            }

            /* Rodapé fixo em todas as páginas, mas com comportamento especial para a última página */
            body:last-child .print-footer {
                display: block;
                text-align: center;
                font-size: 12px;
                color: gray;
                padding: 10px 0;
                border-top: 1px solid #ddd;
                background-color: white;
            }

            /* Assinatura e dados adicionais apenas na última página */
            .footer-signature.last-page {
                display: block;
                text-align: center;
                padding-top: 10px;
                position: relative;
                padding-top: 20px;
                bottom: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- Header -->
        <div class="header">
            <img src="{{ asset('assets/images/insignia.png') }}" alt="República de Angola">
            <h4>REPÚBLICA DE ANGOLA</h4>
            <h4>HOSPITAL GERAL ESPECIALIZADO DE LUANDA</h4>
            <h4>FICHA DE CONTROLO DE MEDICAMENTOS</h4>
            <h4>SECÇÃO DA FARMÁCIA</h4>
            <h4>DATA: {{ date('d') }} / {{ date('m') }} / {{ date('Y') }}</h4>

            <div class="signature-right" style="text-align: center">
                Visto da Diretora Clínica<br>
                <span class="line"></span>
                = Dr.ª Rosa Camilo Andé = <br>
                Médica Obstetra
            </div>
        </div>

        <!-- Table -->
        <div class="tbl-container">
            <table>
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Designação</th>
                        <th>Dosagem</th>
                        <th>Expiração</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                        $currentForma = '';
                    @endphp
                    @foreach ($estoque->sortBy(function ($item) {
                        return [$item->produto->forma, $item->produto->designacao];
                    }) as $est)
                        @if ($est->produto->confirmado != 0)
                            @if ($currentForma != $est->produto->forma)
                                @php $currentForma = $est->produto->forma; @endphp
                                <tr>
                                    <td style="text-align: center; text-transform: capitalize" colspan="5"
                                        class="group-header">
                                        {{ strtoupper($currentForma) }}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td>{{ $i }}</td>
                                <td style="text-align: left">{{ $est->produto->designacao }}</td>
                                <td>{{ $est->produto->dosagem }}</td>
                                <td>{{ \Carbon\Carbon::parse($est->produto->data_expiracao)->format('d-m-Y') }}</td>
                                <td>{{ $est->produto->saldo->qtd }}</td>
                            </tr>
                            @php $i++; @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer footer-signature last-page">
            <div>O Chefe de Secção</div>
            <span class="line"></span>
            <div>{{ Auth::user()->nome }}</div>
        </div>

        <!-- Rodapé fixo -->
        <div class="print-footer" style="bottom: 60px">
            Documento processado por computador e não necessita de assinatura manual.
            Gerado pelo aplicativo <b>Pharmatina</b> para gestão de estoque e controle farmacêutico.
        </div>

    </div>
</body>

</html>
