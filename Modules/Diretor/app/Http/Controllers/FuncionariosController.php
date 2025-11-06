<?php

namespace Modules\Diretor\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controller para gestão de funcionários da farmácia hospitalar
 * 
 * @author Augusto Kussema
 * @date 2025-11-05
 */
class FuncionariosController extends Controller
{
    /**
     * Lista todos os funcionários (farmacêuticos, técnicos, auxiliares)
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // TODO: Buscar funcionários do banco de dados
        return view('diretor::pages.funcionarios.index');
    }

    /**
     * Exibe detalhes de um funcionário específico
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // TODO: Buscar funcionário específico do banco
        return view('diretor::pages.funcionarios.show', compact('id'));
    }
}
