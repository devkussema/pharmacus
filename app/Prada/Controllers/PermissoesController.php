<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permissao;

class PermissoesController extends Controller
{
    public function store(Request $request)
    {
        /*$request->validate([
            'user_id' => 'required|exists:users,id',
        ],[
            'user_id.required' => "Algo deu errado, atualize a página e tente novamente.",
            'user_id.exists' => 'Algo deu errado, atualize a página e tente novamente.'
        ]);*/

        // Converta os dados JSON em um array associativo
        $dados['produtos'] = $request->produtos;
        $dados['area_hospitalar'] = $request->area_hospitalar;
        $dados['relatorio'] = $request->relatorio;

        $json = json_encode($dados);

        Permissao::create([
            'conteudo' => $json,
            'user_id' => $request->user_id,
        ]);

        // Retorne uma resposta de sucesso
        return response()->json(['message' => 'Permissões salvas com sucesso'], 200);

        //return response()->json(['message' => "As coisas deram certos", 'titulo' => "Perfeito"], 200);
    }
}
