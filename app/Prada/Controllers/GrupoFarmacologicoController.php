<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use App\Models\{
    GrupoFarmacologico as GF
};

class GrupoFarmacologicoController extends Controller
{
    public function index()
    {
        $gfs = GF::orderBy('nome', 'ASC')->get();

        return view('grupo_farmacologico.list', compact('gfs'));
    }
}
