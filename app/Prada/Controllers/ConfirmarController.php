<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};
use App\Models\{User, GerenteFarmacia, UsersToken as UT, Grupo, UserAreaHospitalar as UAH};

class ConfirmarController extends Controller
{
    public function funcionario($token)
    {
        $token = UT::where("token", $token)->first();
        if ($token) {
            return view('auth.registarFuncionario', compact('token'));
        }

        return redirect()->route('login')->with('error', "Este link é inválido ou já foi usado");
    }

    public function concluir(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
            'nome' => 'required',
            'email_verified_at' => 'nullable',
            'token' => 'nullable'
        ],[
            'email.required' => 'O email é obrigatório',
            'email.exists' => "Email inválido",
            'password.required' => 'Informe a senha'
        ]);

        if ($request->email_verified_at && $request->token) {
            User::where('email', $request->email)->update([
                'email_verified_at' => now(),
                'status' => 1,
                'nome' => $request->nome,
                'username' => $this->generateUsername($request->nome),
                'password' => Hash::make($request->password)
            ]);

            UT::where('token', $request->token)->update([
                'last_used_at' => now()
            ]);

            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];
            
            Auth::attempt($credentials);

            if ($request->ajax()) {
                return response()->json(['message' => 'Cadastro concluido', 'success' => true],201);
            }
            return redirect()->route('home');
        }

        if ($request->ajax()) {
            return response()->json(['message' => 'Algo deu errado', 'success' => false],403);
        }
        return redirect()->route('login')->with('error', 'Algo deu errado, por favor tente novamente.');
    }

    private function generateUsername($nome)
    {
        $nome = strtolower(trim($nome));
        return str_replace(' ', '.', $nome);
    }
}
