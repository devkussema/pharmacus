<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;

class NivelAlertaController extends Controller
{
    public function index()
    {
        return view('niveis_alerta.show');
    }
}
