<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permissao;

class PermissoesController extends Controller
{
    public function store(Request $request)
    {
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

        return redirect()->back()->with('success', 'Permissões atualizadas');
    }
}
