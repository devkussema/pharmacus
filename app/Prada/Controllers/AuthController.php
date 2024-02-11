<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use App\Models\{UsersToken as UT};

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function registar()
    {
        return view('auth.registar');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
            'email_verified_at' => 'nullable',
            'token' => 'nullable'
        ],[
            'email.required' => 'O email é obrigatório',
            'email.exists' => "Email inválido",
            'password.required' => 'Informe a senha'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if ($request->email_verified_at && $request->token) {
                User::where('email', $request->email)->update([
                    'email_verified_at' => now(),
                    'status' => 1,
                ]);
                UT::where('token', $request->token)->update([
                    'last_used_at' => now()
                ]);
                if ($request->ajax()) {
                    return response()->json(['message' => 'Cadastro efetuado', 'success' => true],201);
                }
                return redirect()->route('home');
            }
            if (Auth::user()->status != 1) {
                Auth::logout();
                return redirect()->route('login')->with('error', 'A tua conta não está ativada');
            }
            if ($request->ajax()) {
                return response()->json(['message' => 'Cadastro efetuado', 'success' => true],201);
            }
            return redirect()->route('home');
        }

        if ($request->ajax()) {
            return response()->json(['msg' => 'Credenciais inválidas, tente novamente'],401);
        }
        return redirect()->back()->withInput()->withErrors(['email' => 'Credenciais inválidas']);
    }

    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser uma string.',
            'nome.max' => 'O campo nome não pode ter mais de 255 caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'email.string' => 'O campo email deve ser uma string.',
            'email.email' => 'O campo email deve ser um endereço de email válido.',
            'email.max' => 'O campo email não pode ter mais de 255 caracteres.',
            'email.unique' => 'Este endereço de email já está em uso.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.string' => 'O campo senha deve ser uma string.',
            'password.min' => 'O campo senha deve ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A confirmação de senha não corresponde.',
        ]);

        $nome = strtolower(trim($request->nome));

        // Substitui espaços por pontos no nome
        $username = str_replace(' ', '.', $nome);

        $uuid = Uuid::uuid4()->toString();

        // Criar novo usuário
        $user = User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'username' => $username,
        ]);

        // Se necessário, faça login automaticamente do usuário
        auth()->login($user);

        // Redirecionar o usuário após o registro
        #return redirect()->route('home')->with('success', 'Conta criada com sucesso!');
        if ($request->ajax()) {
            return response()->json(['message' => 'Cadastro efetuado', 'success' => true],201);
        }
        return redirect()->route('home')->with('success', 'Conta criada com sucesso!');
    }

    /**
     * Verifica se o usuário atual tem sessão ativa.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkSession()
    {
        $isLoggedIn = auth()->check();

        //return response()->json($isLoggedIn);
        if ($isLoggedIn)
            return response()->json(['status' => 1]);

            return response()->json(['status' => 0]);
    }
}
