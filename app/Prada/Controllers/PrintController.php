<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    AreaHospitalar, Estoque,
    NivelAlerta as NA,
    RelatorioEstoqueAlerta as REA
};

class PrintController extends Controller
{
    public function index()
    {
        $niveis = REA::all();

        return view('doc_generate.listaEstoque', compact('niveis'));
    }

    public function view(Request $request, $estoque_id)
    {
        $area_hospitalar = AreaHospitalar::find($estoque_id);

        if (!$area_hospitalar)
            return redirect()->back()->with('warning', 'Algo deu errado e não podemos acessar esta página.');

        $area_hospitalar_id = $estoque_id;
        $farmacia_id = (auth()->user()->isFarmacia->farmacia->id ?? auth()->user()->farmacia->farmacia->id);

        $estoque = Estoque::where('area_hospitalar_id', $area_hospitalar_id)
            ->where('farmacia_id', $farmacia_id)
            ->with(['produto' => function ($query) {
                $query->orderBy('designacao', 'ASC');
            }])
            ->get();

        return view('doc_generate.estoque', compact('estoque'));
    }
}
