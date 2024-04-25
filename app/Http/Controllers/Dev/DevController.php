<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    NivelAlerta as NA,
    RelatorioEstoqueAlerta as REA
};

class DevController extends Controller
{
    public function levantamento()
    {
        return view('doc_generate.levantamentoEGato');
    }

    public function getFichaControlo($area=false)
    {
        $areaH = $area;
        $niveis = REA::all();

        return view('doc_generate.listaEstoque', compact('niveis', 'areaH'));
    }

    public function novo_doc()
    {
        return view('doc_generate.novoDoc');
    }
}
