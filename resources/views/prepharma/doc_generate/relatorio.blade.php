<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de Levantamento e Gasto de Medicamentos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .tbl-container {
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            /* Centraliza o texto */
            border-bottom: 1px solid #ddd;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        th {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: auto;
            text-align: center;
            padding: 20px 0;
        }

        .signature {
            display: inline-block;
            vertical-align: top;
            margin: 0 10px;
            /* Adiciona margens para separação */
            text-align: center;
            /* Centraliza o texto */
        }

        .signature-left {
            float: left;
            /* Alinhar à esquerda */
        }

        .signature-right {
            float: right;
            /* Alinhar à direita */
        }

        .clear {
            clear: both;
            /* Limpar floats */
        }
    </style>
</head>

<body>
<div class="container">

    <div class="header">
        <img src="{{ asset('assets/images/insignia.png') }}" width="50" height="50" alt="República de Angola">
        <h4>REPÚBLICA DE ANGOLA</h4>
        <h4>HOSPITAL GERAL ESPECIALIZADO DE LUANDA</h4>
        <h4>FICHA DE LEVANTAMENTO E GASTO DE MEDICAMENTOS</h4>
        <h4>SECÇÃO: FARMÁCIA</h4>
        <h4>DATA: 25 / 01/ 2025</h4>
    </div>

    <div class="tbl-container">
        <table>
            <thead>
            <tr>
                <th>Nº</th>
                <th>Medicamento e Material Gastável</th>
                <th>Quantidade</th>
            </tr>
            </thead>
            <tbody>
            @php $i = 1; @endphp
            @foreach ($produtos->sortBy('produto.designacao') as $pe)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $pe->produto->designacao }}</td>
                    <td>{{ getCaixa($pe->produto->descritivo) }}</td>
                </tr>
                @php $i++; @endphp
            @endforeach
            </tbody>
        </table>
    </div>

{{--    <div class="footer">--}}
{{--        <div class="signature signature-left">--}}
{{--            <p>CHEFE DE SECÇÃO</p>--}}
{{--            <p>_____________________</p>--}}
{{--        </div>--}}
{{--        <div class="signature signature-right">--}}
{{--            <p>DESPACHADO POR</p>--}}
{{--            <p>_____________________</p>--}}
{{--        </div>--}}
{{--        <div class="clear"></div>--}}
{{--    </div>--}}
</div>
</body>

</html>
