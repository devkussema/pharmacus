<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use App\Models\{
    ConfirmarBaixa
};

class GetterController extends Controller
{
    public function getNoficacoes($id_para)
    {
        $confirmBaixas = ConfirmarBaixa::where('area_hospitalar_para', $id_para)
            ->where('confirmado', 0)
            ->take(2) // Limita a busca para no máximo dois registros
            ->get();

        if (!$confirmBaixas)
            return response()->json(['status' => null], 404);

        if ($confirmBaixas->isEmpty()) {
            return response()->json(['status' => null], 404);
        }

        $response = [];

        foreach ($confirmBaixas as $confirmBaixa) {
            $response[] = [
                'chave' => $confirmBaixa->produto_estoque->id,
                'message' => $confirmBaixa->texto, // Mensagem genérica
                'titulo' => $confirmBaixa->produto_estoque->designacao, // Título genérico
                'created_at' => $confirmBaixa->created_at,
                'status' => 1
            ];
        }

        return response()->json($response, 200);
    }
}
