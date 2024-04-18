<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de Levantamento e Gasto de Medicamentos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
        }

        .tbl-container {
            margin-top: 20px;
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
            border-bottom: 1px solid #ddd;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        th {
            background-color: #f2f2f2;
        }

        .signatures {
      position: absolute;
      bottom: 20px;
      left: 0;
      right: 0;
      text-align: center;
    }

        .signature {
            width: 20%;
            /* Reduzir um pouco para acomodar espaço extra entre eles */
            display: inline-block;
            vertical-align: top;
            margin: 0 50px;
        }

        .signature-left {
            float: left;
            /* Alinhar à esquerda */
            text-align: center;
            /* Alinhar texto à esquerda */
        }

        .signature-right {
            float: right;
            /* Alinhar à direita */
            text-align: center;
            /* Alinhar texto à direita */
        }

        .clear {
            clear: both;
            /* Limpar floats */
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ asset('assets/images/insignia.png') }}" width="50" height="50" alt="República de Angola">
        <h4>República de Angola</h4>
        <h4>Hospital Geral Especializado de Luanda</h4>
        <h4>Ficha de Levantamento e Gasto de Medicamentos</h4>
        <h4>Secção .....................................................................................</h4>
        <h4>Data: __ /__/20__</h4>
    </div>

    <div class="tbl-container">
        <table>
            <thead>
                <tr>
                    <th>Nº</th>
                    <th>Medicamento e Material Gastável</th>
                    <th>Gastos</th>
                    <th>Existência</th>
                    <th>Quantidade Pedida</th>
                    <th>Quantidade Disponibilizada</th>
                    <th>Data de Expiração</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>3</td>
                    <td>Paracetamol</td>
                    <td>13</td>
                    <td>Nenhuma</td>
                    <td>4</td>
                    <td>2</td>
                    <td>4/01/2024</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Ampicilina</td>
                    <td>7</td>
                    <td>Nenhuma</td>
                    <td>2</td>
                    <td>8</td>
                    <td>6/01/2024</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="signatures">
        <div class="signature signature-left">
            <p><b>O Diretor</b></p>
            <p>_____________________</p>
        </div>
        <div class="signature signature-right">
            <p><b>O Diretor Gabinete</b></p>
            <p>_____________________</p>
        </div>
        <div class="clear"></div>
    </div>
</body>

</html>
