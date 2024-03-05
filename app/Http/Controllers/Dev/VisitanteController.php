<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitante;

class VisitanteController extends Controller
{
    public function index()
    {
        $visitantes = Visitante::all();
        return view("dev.visitantes.show", compact('visitantes'));
    }
}
