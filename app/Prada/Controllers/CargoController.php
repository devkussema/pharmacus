<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cargo;

class CargoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|unique:cargos,nome',
            'descricao' => 'nullable',
        ],[
            'nome.required' => "O nome é obrigatório",
            'nome.unique' => "Este cargo já existe"
        ]);

        $cargo = Cargo::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
        ]);

        return response()->json(['message' => "{$request->nome} adicionado"], 201);
    }
}
