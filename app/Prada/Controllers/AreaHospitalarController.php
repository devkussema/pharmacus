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
        ], [
            'nome.required' => 'O nome é obrigatório',
            'nome.unique' => 'Esta área já está cadastrada no sistema'
        ]);

        AH::create($request->all());

        return response()->json(['message' => "{$request->nome} cadastrada com sucesso"], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|unique:areas_hospitalares,nome,' . $id,
            'descricao' => 'nullable'
        ], [
            'nome.required' => 'O nome é obrigatório',
            'nome.unique' => 'Esta área já está cadastrada no sistema'
        ]);

        $area_hospitalar = AH::findOrFail($id);
        $area_hospitalar->update($request->all());

        return response()->json(['message' => "{$area_hospitalar->nome} atualizada com sucesso"], 200);
    }

    public function destroy(Request $request, $id)
    {
        $area_hospitalar = AH::find($id);

        if (!$area_hospitalar) {
            return response()->json(['message' => 'Área hospitalar não encontrada'], 404);
        }

        $area_hospitalar->delete();

        if ($request->ajax())
            return response()->json(['message' => 'Área hospitalar excluída com sucesso']);
        return redirect()->route('a_h.index')->with('success', "{$area_hospitalar->nome} eliminada com sucesso");
    }


    public function getAll()
    {
        $all = AH::all();

        return response()->json($all);
    }

    public function getInfo($id)
    {
        $info = AH::find($id);

        if (!$info)
            return response()->json(['message' => "Selecione uma Área Hospitalar"], 401);

        return response()->json($info);
    }
}
