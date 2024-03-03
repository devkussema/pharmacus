<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;

class FuncionarioController extends Controller
{
    public function index()
    {
        //return view('funcionario.list');
        return view('fatura.show');
    }
}
