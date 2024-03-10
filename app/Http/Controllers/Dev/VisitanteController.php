<?php

namespace App\Http\Controllers\Dev;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitante;

class VisitanteController extends Controller
{
    public function index()
    {
        $visitantes = Visitante::orderBy('created_at', 'desc')->get();

        return view("dev.visitantes.show", compact('visitantes'));
    }
}
