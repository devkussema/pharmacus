<table border="1">
    <tr>
        @foreach($niveis as $nivel)
            <th>{{ $nivel['nome'] }}</th>
        @endforeach
    </tr>
    <tr>
        @foreach($contadores as $contagem)
            <td>{{ $contagem }}</td>
        @endforeach
    </tr>
</table>

<p>Cerca de {{ $total }} produtos atingiram níveis de alerta.</p>
