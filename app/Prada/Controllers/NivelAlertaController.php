<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use App\Models\{
    NivelAlerta as NA,
    RelatorioEstoqueAlerta as REA
};
use App\Traits\{AtividadeTrait, GenerateTrait};

class NivelAlertaController extends Controller
{
    use GenerateTrait;

    public function index()
    {
        $niveis = REA::all();
        self::calcNivelAlerta();
        return view('niveis_alerta.show', compact('niveis'));
    }
}
