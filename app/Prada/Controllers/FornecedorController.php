<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;

class FornecedorController extends Controller
{
    public function index()
    {
        /**
         * Exibe a lista de fornecedores.
         *
         * @author Augusto Kussema
         * @created 2024-11-10
         * @return \Illuminate\Contracts\View\View
         */
        return view('prepharma.fornecedores.show');
    }
}
