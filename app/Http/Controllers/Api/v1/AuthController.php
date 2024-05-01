<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GenerateTrait;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use GenerateTrait;

    public function login(Request $request)
    {
        if (!higienizarEmail($request->email)) {
            if ($request->ajax()) {
                return response()->json(['message' => "Informe um email válido"], 401);
            }
            return redirect()->back()->with('error', 'Informe um email válido');
        }

        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ], [
            'email.required' => 'O email é obrigatório',
            'email.exists' => "Credenciais inválidas, tente novamente",
            'password.required' => 'Informe a senha'
        ]);


        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->status == 0) {
                Auth::logout();
                if ($request->ajax()) {
                    return response()->json(['message' => 'A tua conta não está ativada'], 422);
                }
                return redirect()->route('login')->with('error', 'A tua conta não está ativada');
            }

            if ($request->ajax()) {
                return response()->json(['message' => 'Cadastro efetuado', 'success' => true], 201);
            }
            return redirect()->route('home');
        }

        if ($request->ajax()) {
            return response()->json(['message' => 'Credenciais inválidas, tente novamente'], 422);
        }
        return redirect()->back()->withInput()->withErrors(['message' => 'Credenciais inválidas, tente novamente'], 422);
    }

    public function entrar(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            $token = $request->user()->createToken('login.luze');
            //return response()->json('Autorizado', 200);
            return response()->json([
                'mensagem' => 'Autorizado',
                'token' => $token->plainTextToken, // Extrai o token JWT do objeto Token
            ], 200, [
                'Authorization' => 'Bearer ' . $token->accessToken // Define o header 'Authorization'
            ]);
        }

        return response()->json('Não Autorizado', 401);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        # $user->tokens()->delete(); // elimina todos os tokens
        $request->user()->currentAccessToken()->delete();

        // Remova o token do cliente (envie resposta sem o token)
        #@Auth::logout(); // Esqueça a sessão (opcional)
        #return redirect()->route('login');
        return response()->json('Logout realizado com sucesso', 200);
    }
}
