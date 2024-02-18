<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;
use Carbon\Carbon;
use App\Mail\ConfirmarGerente;
use Ramsey\Uuid\Uuid;
use App\Models\{User, GerenteFarmacia, UsersToken as UT, Grupo};

class GerenteFarmaciaController extends Controller
{
    public function confirmar($token)
    {
        $token = UT::where("token", $token)->first();
        if ($token) {
            return view('auth.gerenteConfirmar', compact('token'));
        }
        return "Token inexistente!";
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'email' => 'required|unique:users,email',
            'farmacia_id' => 'required',
            'contato' => 'required|unique:gerente_farmacias,contato'
        ], [
            'nome.required' => 'O nome do gerente é obrigatório',
            'email.required' => 'O email do gerente é obrigatório',
            'farmacia_id.required' => 'Por favor selecione uma farmácia',
            'contato.required' => 'Informe o telefone do gerente'
        ]);

        $passwd = $this->gerarSenhaAutomatica();

        $nome = strtolower(trim($request->nome));

        $grupo = Grupo::where('nome', 'Gerente')->first();
        if (!$grupo)
            $grupo = null;

        // Substitui espaços por pontos no nome
        $username = str_replace(' ', '.', $nome);

        $user = User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'username' => $username,
            'grupo_id' => $grupo->id,
            'password' => Hash::make($passwd)
        ]);

        if ($user) {
            GerenteFarmacia::create([
                'user_id' => $user->id,
                'cargo' => 'Gerente',
                'farmacia_id' => $request->farmacia_id,
                'contato' => $request->contato
            ]);

            $token = $this->gerarToken($user);
            $url = route('gestor.token', ['token' => $token->token]);

            $destinatario = $request->email;
            Mail::to($destinatario)->send(new ConfirmarGerente($request->nome, $url, $passwd));

            return response()->json(['message' => "Gerente adicionado a farmácia"], 201);
        } else {
            return response()->json(['message' => "Erro ao criar o usuário"], 500);
        }
    }

    public function gerarSenhaAutomatica()
    {
        // Gera um número aleatório de 100000 a 999999
        $senha = rand(100000, 999999);

        // Converte o número para uma string de 6 dígitos
        $senha = str_pad($senha, 6, '0', STR_PAD_LEFT);

        return $senha;
    }

    public function gerarToken($user)
    {
        $token = UT::create([
            'user_id' => $user->id,
            'nome' => 'Confirmação de conta de gerente da farmácia',
            'token' => Uuid::uuid4()->toString()
        ]);

        return $token;
    }
}
