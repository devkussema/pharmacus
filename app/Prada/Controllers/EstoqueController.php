<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use App\Models\{AreaHospitalar as AH, Estoque};

class EstoqueController extends Controller
{
    public function index()
    {
        $ah = AH::all();
        $estoque = Estoque::all();
        return view('estoque.show', compact('estoque', 'ah'));
    }
}
