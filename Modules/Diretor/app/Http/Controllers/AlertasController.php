<?php

namespace Modules\Diretor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controller para gestão de alertas críticos da farmácia
 * 
 * @author Augusto Kussema
 * @date 2025-11-06
 */
class AlertasController extends Controller
{
    /**
     * Lista todos os alertas críticos (estoque baixo, validade próxima, etc)
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // TODO: Buscar alertas do banco de dados
        return view('diretor::pages.alertas.index');
    }

    /**
     * Exibe detalhes de um alerta específico
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // TODO: Buscar alerta específico do banco
        return view('diretor::pages.alertas.show', compact('id'));
    }
}
