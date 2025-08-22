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
            1 => ['nome' => 'Crítico', 'meses' => 3],
            2 => ['nome' => 'Mínimo', 'meses' => 6],
            3 => ['nome' => 'Médio', 'meses' => 10],
            4 => ['nome' => 'Máximo', 'meses' => 12]
        ];

        // Inicializa contadores
        $contadores = array_fill(1, 4, 0);

        // Obtém produtos que ainda não expiraram e com data de expiração
        $produtos = PE::whereNotNull('data_expiracao')
            ->where('data_expiracao', '>', $hoje)
            ->get();

        // Processa produtos em lote
        $atualizacoes = [];
        foreach ($produtos as $produto) {
            $tempoExpiracao = Carbon::parse($produto->data_expiracao)->diffInMonths($hoje);

            // Determina o nível de alerta
            $nivelAlerta = null;
            foreach ($limites as $nivel => $info) {
                if ($tempoExpiracao <= $info['meses']) {
                    $nivelAlerta = $nivel;
                    $contadores[$nivel]++;
                    break;
                }
            }

            if ($nivelAlerta !== null) {
                $atualizacoes[] = [
                    'produto_id' => $produto->id,
                    'nivel_id' => $nivelAlerta
                ];
            }
        }

        // Atualiza relatórios em lote
        if (!empty($atualizacoes)) {
            foreach ($atualizacoes as $atualizacao) {
                REA::updateOrCreate(
                    ['produto_estoque_id' => $atualizacao['produto_id']],
                    ['nivel_alerta_id' => $atualizacao['nivel_id']]
                );
            }
        }

        // Gera relatório usando view ou componente blade
        $data = [
            'niveis' => $limites,
            'contadores' => $contadores,
            'total' => array_sum($contadores)
        ];

        return view('components.relatorio-alerta', $data)->render();
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
