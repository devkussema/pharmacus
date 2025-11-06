<?php

namespace Modules\Diretor\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controller para gestão de equipe da farmácia hospitalar
 * 
 * @author Augusto Kussema
 * @date 2025-11-06
 */
class EquipeController extends Controller
{
    /**
     * Lista todos os membros da equipe (farmacêuticos, técnicos, auxiliares)
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // TODO: Buscar equipe do banco de dados
        return view('diretor::pages.equipe.index');
    }

    /**
     * Exibe detalhes de um membro da equipe
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // TODO: Buscar membro da equipe do banco
        return view('diretor::pages.equipe.show', compact('id'));
    }
}
