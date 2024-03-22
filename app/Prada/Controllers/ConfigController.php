<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Setting};

class ConfigController extends Controller
{
    public function index()
    {
        return view('config.site');
    }

    public function set_config(Request $request)
    {
        $request->validate([
            'chave' => 'required',
            'valor' => 'required'
        ],[
            'chave.required' => 'Informe uma chave',
            'valor.required' => 'Informe um valor'
        ]);

        $config = Setting::create($request->all());

        if ($request->ajax()) {
            return response()->json(['message' => 'Definições atualizadas'], 200);
        }
    }
}
