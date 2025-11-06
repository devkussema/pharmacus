<?php

namespace Modules\Diretor\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controller para gestão de atividades e logs da farmácia hospitalar
 * 
 * @author Augusto Kussema
 * @date 2025-11-05
 */
class AtividadesController extends Controller
{
    /**
     * Lista todas as atividades recentes (dispensações, entradas, movimentações)
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // TODO: Buscar atividades do banco de dados
        return view('diretor::pages.atividades.index');
    }

    /**
     * Exibe detalhes de uma atividade específica
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // TODO: Buscar atividade específica do banco
        return view('diretor::pages.atividades.show', compact('id'));
    }
}
