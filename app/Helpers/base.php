<?php

use \App\Models\User;
use App\Models\Grupo;
use App\Models\Permissao;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

if (!function_exists('calcTempo')) {
    function calcTempo($data) {
        // Converte a data para um objeto DateTime
        $data = new DateTime($data);

        // Obtém a data atual
        $dataAtual = new DateTime();

        // Calcula a diferença entre as duas datas
        $diferenca = $data->diff($dataAtual);

        // Obtém a diferença de anos, meses e dias
        $anos = $diferenca->y;
        $meses = $diferenca->m;
        $dias = $diferenca->d;

        // Formata a string de tempo decorrido
        $tempoDecorrido = '';
        if ($anos > 0) {
            $tempoDecorrido .= $anos . ' ano';
            if ($anos > 1) {
                $tempoDecorrido .= 's';
            }
            $tempoDecorrido .= ' ';
        }
        if ($meses > 0) {
            $tempoDecorrido .= $meses . ' mês';
            if ($meses > 1) {
                $tempoDecorrido .= 'es';
            }
            $tempoDecorrido .= ' ';
        }
        if ($dias > 0) {
            $tempoDecorrido .= $dias . ' dia';
            if ($dias > 1) {
                $tempoDecorrido .= 's';
            }
        }

        // Retorna o tempo decorrido
        return 'desde ' . $data->format('d \d\e F');
    }
}

if (!function_exists('isAdministrator')) {
    function isAdministrator()
    {
        // Verifica se o usuário está autenticado
        if (Auth::check()) {
            // Obtém o ID do usuário atual
            $userId = Auth::user()->id;

            // Verifica se o usuário pertence ao grupo "Administrador"
            return \App\Models\UserGroup::whereHas('grupo', function ($query) {
                $query->where('nome', 'Administrador');
            })->where('user_id', $userId)->exists();
        }

        return false;
    }
}

if (!function_exists('isPerm')) {
    function isPerm($permissaoChave, $permissoes)
    {
        // Converte a lista de permissões de JSON para um array PHP
        $permissoesArray = json_decode($permissoes, true);

        // Verifica se a chave da permissão existe no array de permissões
        return in_array($permissaoChave, $permissoesArray);
    }
}

if (!function_exists('getPerm')) {
    function getPerm($grupoIdOuNome)
    {
        // Verifica se o argumento é um ID de grupo ou nome de grupo
        if (is_numeric($grupoIdOuNome)) {
            // Se for um ID de grupo, busca o grupo pelo ID
            $grupo = Grupo::find($grupoIdOuNome);
        } else {
            // Se for um nome de grupo, busca o grupo pelo nome
            $grupo = Grupo::where('nome', $grupoIdOuNome)->first();
        }

        // Se o grupo não for encontrado, retorna null
        if (!$grupo) {
            return null;
        }

        // Obtém todas as permissões associadas ao grupo
        $permissoes = DB::table('grupo_permissoes')
            ->join('permissoes', 'grupo_permissoes.permissao_id', '=', 'permissoes.id')
            ->where('grupo_permissoes.grupo_id', $grupo->id)
            ->pluck('permissoes.conteudo');

        // Retorna as permissões em formato JSON
        return $permissoes->toJson();
    }
}

function isGerente()
{
    if (auth()->user()->gerente) {
        return true;
    }

    return false;
}
