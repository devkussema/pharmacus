<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, GerenteFarmacia};

class GerenteFarmaciaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required',
            'farmacia_id' => 'required',
            'contato' => 'required'
        ],[
            'nome.required' => 'O nome do gerente é obrigatório',
            'email.required' => 'O email do gerente é obrigatório',
            'farmacia_id.required' => 'Por favor selecione uma farmácia',
            'contato.required' => 'Informe o telefone do gerente'
        ]);

        $passwd = $this->gerarSenhaAutomatica();

        $nome = strtolower(trim($request->nome));

        // Substitui espaços por pontos no nome
        $username = str_replace(' ', '.', $nome);

        $user = User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'username' => $username,
            'password' => $passwd
        ]);
        
        if ($user) {
            GerenteFarmacia::create([
                'user_id' => $user->id,
                'cargo' => 'Gerente',
                'farmacia_id' => $request->farmacia_id,
                'contato' => $request->contato
            ]);
            
            return response()->json(['message' => "Gerente adicionado a farmácia"], 201);
        } else {
            return response()->json(['message' => "Erro ao criar o usuário"], 500);
        }
    }

    public function gerarSenhaAutomatica() {
        // Gera um número aleatório de 100000 a 999999
        $senha = rand(100000, 999999);
        
        // Converte o número para uma string de 6 dígitos
        $senha = str_pad($senha, 6, '0', STR_PAD_LEFT);
        
        return $senha;
    }
}
