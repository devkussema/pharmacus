<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farmacia;

class FarmaciaController extends Controller
{
    public function index()
    {
        $farmacias = Farmacia::all();
        return view('farmacia.index', compact('farmacias'));
    }

    public function get(string $id)
    {
        $get = Farmacia::find($id);
        if ($get) {
            return response()->json($get);
        }

        return response()->json(['message'=> 'Erro ao obter informações da farmácia, tente novamente'],403);
    }

    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'logotipo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Exemplo de validação de arquivo de imagem
            'endereco' => 'required|string|max:255',
            'descricao' => 'nullable|string',
        ]);

        // Processamento do arquivo de logotipo, se fornecido
        if ($request->hasFile('logotipo')) {
            $logotipoPath = $request->file('logotipo')->store('logotipos');
        } else {
            $logotipoPath = null;
        }

        // Criação de uma nova instância de Farmacia com os dados validados
        $farmacia = new Farmacia();
        $farmacia->nome = $request->nome;
        $farmacia->logo = $logotipoPath;
        $farmacia->endereco = $request->endereco;
        $farmacia->descricao = $request->descricao;
        $farmacia->save();

        // Retorno de uma resposta JSON de sucesso
        return response()->json(['message' => 'Farmácia cadastrada com sucesso'], 201);
    }
}
