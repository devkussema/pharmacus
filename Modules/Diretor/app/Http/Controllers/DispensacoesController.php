<?php

namespace Modules\Diretor\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controller para gestão de dispensações de medicamentos
 * 
 * @author Augusto Kussema
 * @date 2025-11-06
 */
class DispensacoesController extends Controller
{
    /**
     * Lista todas as dispensações realizadas
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // TODO: Buscar dispensações do banco de dados
        return view('diretor::pages.dispensacoes.index');
    }

    /**
     * Exibe detalhes de uma dispensação específica
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // TODO: Buscar dispensação específica do banco
        return view('diretor::pages.dispensacoes.show', compact('id'));
    }
}
