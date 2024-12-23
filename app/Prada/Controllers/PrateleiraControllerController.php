<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prateleira;

class PrateleiraControllerController extends Controller
{
    public function index()
    {
        return view("prateleira.show");
    }


    public function add()
    {
        return view("prateleira.add");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'status' => 'nullable|string|in:1,0'
        ]);

        $validated['status'] = 0;

        Prateleira::create($validated);

        return redirect()->back()->with('success', 'Prateleira adicionada com sucesso!');
    }

    public function destroy($id)
    {
        try {
            // Busca a prateleira pelo ID
            $prateleira = Prateleira::findOrFail($id);

            // Exclui a prateleira
            $prateleira->delete();

            // Retorna resposta de sucesso
            return response()->json(['message' => 'Prateleira excluída com sucesso!'], 200);
        } catch (\Exception $e) {
            // Tratamento de erro e retorno de mensagem
            return response()->json(['message' => 'Erro ao excluir a prateleira.'], 500);
        }
    }

    public function toggleStatus($id)
    {
        $prateleira = Prateleira::findOrFail($id);

        // Alterna entre 'ativo' e 'inativo'
        $prateleira->status = ($prateleira->status == 1) ? 0 : 1;

        // Salva a mudança no banco de dados
        $prateleira->save();

        return response()->json(['message' => 'Status da prateleira alterado com sucesso!']);
    }

    public function getPrateleiras(Request $request)
    {
        $farmacia_id = auth()->user()->isFarmacia->farmacia->id ?? auth()->user()->farmacia->farmacia->id;
        $prateleira = Prateleira::all();

        return response()->json(["data" => $prateleira]);
    }
}
