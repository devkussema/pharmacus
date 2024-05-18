<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;

class AtividadeController extends Controller
{
    public function index()
    {
        return view('atividade.show');
    }
}
