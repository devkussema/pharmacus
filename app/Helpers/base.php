<?php

use \App\Models\User;
use App\Models\Grupo;
use App\Models\Permissao;
use Illuminate\Support\Facades\DB;

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