<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{
    public function index()
    {
        return view('usuario.show');
    }
}
