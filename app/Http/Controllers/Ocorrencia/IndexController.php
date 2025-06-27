<?php

namespace App\Http\Controllers\Ocorrencia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Exibe uma página do dashboard de preview.
     *
     * @param  string  $page O nome da página a ser exibida (padrão: 'index').
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function dashboardPage($page = 'index')
    {
        $viewPath = 'ocorrencia::dashboard.' . $page; // Constrói o caminho da view. Ex: preview::dashboard.settings

        if (view()->exists($viewPath)) {
            return view($viewPath);
        }
        abort(404); // Se a view não existir, retorna um erro 404
    }
}
