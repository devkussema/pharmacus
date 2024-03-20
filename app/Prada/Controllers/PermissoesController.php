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
        $dados['cargo'] = $request->cargo;

        $json = json_encode($dados);

        $usr = $request->user_id;

        $isPerm = Permissao::where('user_id', $usr)->first();

        if (!$isPerm) {
            Permissao::create([
                'conteudo' => $json,
                'user_id' => $request->user_id,
            ]);
        }else{
            $isPerm->update([
                'conteudo' => $json
            ]);
        }

        // Retorne uma resposta de sucesso
        //return response()->json(['message' => 'Permissões salvas com sucesso', 'titulo' => "Concluido"], 200);
        return redirect()->back()->with('success', 'Permissões atualizadas');
        //return response()->json(['message' => "As coisas deram certos", 'titulo' => "Perfeito"], 200);
    }
}
