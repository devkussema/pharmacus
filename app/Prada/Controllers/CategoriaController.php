<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'tipo' => 'required',
        ],[
            'nome.required' => 'O campo nome é obrigatório',
            'tipo.required' => 'O tipo da categoria é obrigatório'
        ]);

        Categoria::create($request->all());

        return response()->json(['message' => 'Categoria cadastrada com sucesso'], 201);
    }
}
