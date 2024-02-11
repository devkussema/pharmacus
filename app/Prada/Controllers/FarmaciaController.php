<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Farmacia;

class FarmaciaController extends Controller
{
    public function index()
    {
        $farmacias = Farmacia::where('status', '1')->get();
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
            $logotipoPath = $request->file('logotipo')->store('public/logotipos');
            // Substitua 'public/' pelo caminho desejado (a partir de 'logotipos' em diante)
            $logotipoPath = str_replace('public/', '', $logotipoPath);
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

    public function update(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'logotipo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Exemplo de validação de arquivo de imagem
            'endereco' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'id' => 'required|exists:farmacias,id',
        ], [
            'nome.required' => 'O nome é obrigatório',
            'nome.unique' => 'Esta área já está cadastrada no sistema'
        ]);

        $farmacia = Farmacia::findOrFail($request->id);
        $farmacia->update($request->all());

        return response()->json(['message' => "{$farmacia->nome} atualizada com sucesso"], 200);
    }

    public function destroy(Request $request, $id)
    {
        $farmacia = Farmacia::find($id);

        if (!$farmacia) {
            return response()->json(['message' => 'Farmácia não encontrada'], 404);
        }
        $farmacia->status = 0;
        $farmacia->save();

        if ($request->ajax())
            return response()->json(['message' => 'Farmácia excluída com sucesso']);
        return redirect()->route('farmacia')->with('success', "{$farmacia->nome} eliminada com sucesso");
    }

    public function getAll($id)
    {
        if (!is_numeric($id))
            return false;

        $farmacia = Farmacia::find($id);
        if ($farmacia) {
            return response()->json($farmacia);
        }
    }

    public function getInfo($id)
    {
        $info = Farmacia::find($id);

        if (!$info)
            return response()->json(['message' => "Selecione uma Farmácia"], 401);

        return response()->json($info);
    }
}
