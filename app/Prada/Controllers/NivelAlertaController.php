<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use App\Models\{
    NivelAlerta as NA,
    RelatorioEstoqueAlerta as REA
};

class NivelAlertaController extends Controller
{
    public function index()
    {
        $niveis = REA::all();
        return view('niveis_alerta.show', compact('niveis'));
    }
}
