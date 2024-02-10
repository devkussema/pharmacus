<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AreaHospitalar as AH;

class AreaHospitalarController extends Controller
{
    public function index()
    {
        return view('area_hospitalar.show');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|unique:areas_hospitalares,nome',
            'descricao' => 'nullable'
        ],[
            'nome.required' => 'O nome é obrigatório',
            'nome.unique' => 'Esta área já está cadastrada no sistema'
        ]);

        AH::create($request->all());

        return response()->json(['message' => "{$request->nome} cadastrada com sucesso"], 201);
    }

    public function getAll()
    {
        $all = AH::all();

        return response()->json($all);
    }
}
