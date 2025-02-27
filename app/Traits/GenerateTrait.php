<?php

namespace App\Traits;

use App\Models\UsersToken as UT;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use App\Models\{
    ProdutoEstoque as PE,
    RelatorioEstoqueAlerta as REA,
    Notificacao,
    AreaHospitalar,
    ConfirmarBaixa as CB
};

trait GenerateTrait
{
    public function confirmarBaixaAlert($texto, $area_hospitalar_para, $produto_id) {
        $ah = (auth()->user()->isFarmacia ? AreaHospitalar::where('nome', 'Armazém I')->first()->id : auth()->user()->area_hospitalar->area_hospitalar_id);
        $cb = CB::create([
            'area_hospitalar_de' => $ah,
            'area_hospitalar_para' => $area_hospitalar_para,
            'texto' => $texto,
            'produto_estoque_id' => $produto_id,
        ]);

        return true;
    }
    public static function setNotify($titulo, $user_para, $descricao=null)
    {
        Notificacao::create([
            'titulo' => $titulo,
            'user_de' => auth()->user()->id,
            'user_para' => $user_para,
            'visto' => 0,
            'descricao' => $descricao
        ]);

        return true;
    }

    public static function calcNivelAlerta()
    {
        $hoje = Carbon::now();

        // Define os limites de tempo para cada nível de alerta (em meses)
        $limites = [
            1 => 3, // ID 1 para o nível Critico
            2 => 6, // ID 2 para o nível Minimo
            3 => 10, // ID 3 para o nível Medio
            4 => 12, // ID 4 para o nível Maximo
        ];

        // Obtém todos os produtos
        $produtos = PE::all();

        // Contadores para os níveis de alerta
        $contadores = [
            1 => 3, // ID 1 para o nível Critico
            2 => 6, // ID 2 para o nível Minimo
            3 => 10, // ID 3 para o nível Medio
            4 => 12, // ID 4 para o nível Maximo 
        ];

        // Percorre os produtos
        foreach ($produtos as $produto) {
            // Calcula o tempo de expiração do produto em meses
            $tempoExpiracao = Carbon::parse($produto->data_expiracao)->diffInMonths($hoje);

            // Determina o nível de alerta do produto com base no tempo de expiração
            $nivelAlerta = null;
            foreach ($limites as $nivel => $limite) {
                // Se o tempo de expiração for menor ou igual ao limite, define o nível de alerta
                if ($tempoExpiracao <= $limite) {
                    $nivelAlerta = $nivel;
                    break; // Interrompe o loop assim que encontrar o primeiro nível adequado
                }
            }

            // Se o nível de alerta for encontrado
            if ($nivelAlerta !== null) {
                // Atualiza o contador para o nível de alerta atual
                $contadores[$nivelAlerta]++;

                // Verifica se o produto já está na tabela relatorio_estoque_alerta
                $relatorio = REA::where('produto_estoque_id', $produto->id)->first();

                // Obtém a chave do nível de alerta com base no nome do nível
                $nivelAlertaId = array_search($nivelAlerta, array_keys($limites));
                $nivelAlertaId += 1;
                // Atualiza ou cadastra o relatório conforme necessário
                if ($relatorio) {
                    // O produto já está na tabela, então atualiza o nível atual
                    $relatorio->update(['nivel_alerta_id' => $nivelAlertaId]);
                } else {
                    // O produto não está na tabela, então cadastra um novo relatório
                    REA::create([
                        'produto_estoque_id' => $produto->id,
                        'nivel_alerta_id' => $nivelAlertaId
                    ]);
                }
            }
        }

        // Monta o relatório como uma tabela
        $relatorio = '<table border="1">';
        $relatorio .= '<tr><th>Critico</th><th>Minimo</th><th>Medio</th><th>Maximo</th></tr>';
        $relatorio .= '<tr>';
        foreach ($contadores as $nivel => $contagem) {
            $relatorio .= '<td>' . $contagem . '</td>';
        }
        $relatorio .= '</tr>';
        $relatorio .= '</table>';

        // Resumo básico
        $totalProdutos = array_sum($contadores);
        $resumo = "Cerca de $totalProdutos produtos atingiram níveis de alerta.";

        // Adiciona o resumo ao relatório
        $relatorio .= '<p>' . $resumo . '</p>';

        return $relatorio;
    }

    public static function gerarSenhaAutomatica()
    {
        // Gera um número aleatório de 100000 a 999999
        $senha = rand(100000, 999999);

        // Converte o número para uma string de 6 dígitos
        $senha = str_pad($senha, 6, '0', STR_PAD_LEFT);

        return $senha;
    }

    public static function gerarToken($user, $nome=null)
    {
        $nomeT = "";
        if ($nome==null) { $nomeT = "Token para uso geral"; }else{ $nomeT = $nome; }

        $token = UT::create([
            'user_id' => $user->id,
            'nome' => $nomeT,
            'token' => Uuid::uuid4()->toString()
        ]);

        return $token;
    }
}
