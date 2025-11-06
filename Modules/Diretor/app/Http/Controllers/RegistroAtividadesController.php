<?php

namespace Modules\Diretor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controller para gestão de registro de atividades e logs da farmácia hospitalar
 * 
 * @author Augusto Kussema
 * @date 2025-11-06
 */
class RegistroAtividadesController extends Controller
{
    /**
     * Lista todas as atividades recentes (dispensações, entradas, movimentações)
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // TODO: Buscar atividades do banco de dados
        return view('diretor::pages.registro-atividades.index');
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
        return view('diretor::pages.registro-atividades.show', compact('id'));
    }
}
