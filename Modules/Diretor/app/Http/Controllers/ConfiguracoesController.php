<?php

namespace Modules\Diretor\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controller para configurações do sistema
 * 
 * @author Augusto Kussema
 * @date 2025-11-06
 */
class ConfiguracoesController extends Controller
{
    /**
     * Exibe a página de configurações
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // TODO: Buscar configurações atuais
        return view('diretor::pages.configuracoes');
    }

    /**
     * Salva configurações
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // TODO: Implementar salvamento de configurações
        return redirect()->route('diretor.configuracoes')->with('success', 'Configurações salvas com sucesso');
    }
}
