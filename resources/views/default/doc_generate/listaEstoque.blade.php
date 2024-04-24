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
            text-align: center;
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
            <h4>FICHA DE CONTROLO DE MEDICAMENTOS</h4>
            <h4>DATA: {{ date('dd') }} / {{ date('mm') }}/ {{ date('yyyy') }}</h4>
        </div>

        <div class="tbl-container">
            <table>
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Designação</th>
                        <th>Dosagem</th>
                        <th>Quantidade</th>
                        <th>Área Hospitalar</th>
                        <th>Lote</th>
                        <th>Caducidade</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($niveis as $na)
                        <tr>
                            <td>{{ $i }}</td>
                            <td><b>{{ $na->produto->designacao }}</b></td>
                            <td><b>{{ $na->produto->dosagem }}</b></td>
                            @if ($na->produto->tipo == "Liquido")
                                <td>{{ getEmbalagem($na->produto->descritivo) }}</td>
                            @else
                                <td>{{ $na->produto->saldo->qtd }}</td>
                            @endif
                            <td>{{ $na->produto->estoque->area_hospitalar->nome }}</td>
                            <td>{{ $na->produto->num_lote }}</td>
                            <td>{{ calcMes($na->produto->data_expiracao) }}</td>
                        </tr>
                        @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
