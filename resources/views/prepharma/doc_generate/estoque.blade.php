<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque </title>
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
            <h4>DATA: {{ date('d') }} / {{ date('m') }} / {{ date('Y') }}</h4>
        </div>

        <div class="tbl-container">
            <table>
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Designação</th>
                        <th>Dosagem</th>
                        <th>Forma</th>
                        <th>Fornecedor</th>
                        <th>Lote</th>
                        <th>Grupo</th>
                        <th>Qtd. Caixa</th>
                        <th>Qtd. Unit.</th>
                        <th>Inserido em</th>
                        <th>Data Expiração</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @foreach ($estoque->sortBy(function ($item) {
                        return $item->produto->designacao;
                    }) as $est)
                        @if ($est->produto->confirmado != 0)
                            <tr>
                                <td>
                                    {{ $i }}
                                </td>
                                <td><b>{{ $est->produto->designacao }}</b></td>
                                <td>{{ $est->produto->dosagem }}</td>
                                <td>{{ $est->produto->forma }}</td>
                                <td>{{ $est->produto->origem_destino }}</td>
                                <td>{{ $est->produto->num_lote }}</td>
                                <td><b>{{ $est->produto->grupo_farmaco->nome }}</b></td>
                                <td>{{ getCaixa($est->produto->descritivo) }}</td>
                                <td>{{ $est->produto->saldo->qtd }}</td>
                                <td>{{ formatarData($est->produto->created_at) }}</td>
                                <td>{{ $est->produto->data_expiracao }}</td>
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endif
                        @php $i++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
