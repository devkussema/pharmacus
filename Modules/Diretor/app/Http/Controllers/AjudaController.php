<?php

namespace Modules\Diretor\app\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 * Controller para página de ajuda e documentação
 * 
 * @author Augusto Kussema
 * @date 2025-11-06
 */
class AjudaController extends Controller
{
    /**
     * Exibe a página de ajuda
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('diretor::pages.ajuda');
    }
}
