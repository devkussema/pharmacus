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
        $confirmBaixa = ConfirmarBaixa::where('area_hospitalar_para', $id_para)
            ->where('confirmado', 0)
            ->first();
        if (!$confirmBaixa) {
            return response()->json(['status' => null]);
        }

        return response()->json(['message' => "Tens uma notificação", 'titulo' => "Tens 1 notificações", 'status' => 1], 200);
    }
}
