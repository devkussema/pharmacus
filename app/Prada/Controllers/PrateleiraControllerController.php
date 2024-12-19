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
        // Validação dos dados recebidos
        $validatedData = $request->validate([
            'designacao' => 'required|string|max:255',
            // 'tipo' => 'required|in:descartável,medicamento,liquido',
            'descricao' => 'nullable|string',
        ]);

        // Criação do registro na tabela `prateleiras`
        $prateleira = Prateleira::create([
            'nome' => $validatedData['designacao'],
            // 'tipo' => $validatedData['tipo'],
            'descricao' => $validatedData['descricao'] ?? null,
        ]);

        // Retorno de resposta (redirecionar ou exibir mensagem)
        return redirect()->route('prateleira.show') // Substitua pela rota desejada
            ->with('success', 'Prateleira criada com sucesso!');
    }

    public function getPrateleiras(Request $request)
    {
        $farmacia_id = auth()->user()->isFarmacia->farmacia->id ?? auth()->user()->farmacia->farmacia->id;
        $prateleira = Prateleira::all();

        return response()->json(["data" => $prateleira]);
    }
}
