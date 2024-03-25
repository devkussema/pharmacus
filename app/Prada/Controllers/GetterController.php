<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;

class GetterController extends Controller
{
    public function getNoficacoes()
    {
        return response()->json(['message' => "Tens uma notificação", 'status' => null], 200);
    }
