<?php

namespace Modules\Diretor\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controller para gestão de perfil do diretor
 * 
 * @author Augusto Kussema
 * @date 2025-11-06
 */
class PerfilController extends Controller
{
    /**
     * Exibe o perfil do diretor
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // TODO: Buscar dados do usuário logado
        return view('diretor::pages.perfil');
    }

    /**
     * Atualiza dados do perfil
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        // TODO: Implementar atualização de perfil
        return redirect()->route('diretor.perfil')->with('success', 'Perfil atualizado com sucesso');
    }
}
