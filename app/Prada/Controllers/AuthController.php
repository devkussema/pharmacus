<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\{Auth, Mail, Hash, DB};
use App\Mail\{AtivarUsuario, SenhaAlterada, LinkRecuperarSenha};
use App\Models\{UsersToken as UT, GerenteFarmacia, Farmacia};
use App\Traits\GenerateTrait;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    use GenerateTrait;

    private string $theme;

    public function __construct()
    {
        $this->theme = "dark";
    }

    public function index()
    {
        $theme = $this->theme;
        $app_desc = "Inicie sessão e esteja a par de tudo na " . env('APP_NAME');
        $app_keywords = "entrar, pharmatina, pharmatina angola, google angola, pharmatino, farmatina, farmácia ao, farmacia angola, augusto kussema, kussema";

        return view('auth.v2.login', compact('theme', 'app_desc', 'app_keywords'));
    }

    public function devver() {
        return view('devver.show');
    }

    public function registar()
    {
        $app_desc = "Crie uma conta na " . env('APP_NAME') . " e esteja a para de tudo.";
        $app_keywords = "criar conta, pharmatina, augusto kussema, gestão farmacéutica angola, google ao";

        //return view('auth.contaCriada', compact('app_desc', 'app_keywords'));
        return view('auth.registar', compact('app_desc', 'app_keywords'));
    }

    public function recuperarSenha()
    {
        $theme = $this->theme;
        return view('auth.v2.recuperarSenha', compact('theme'));
    }

    public function alterar_senha(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => "Endereço de email incorreto.",
            'email.required' => "O email é obrigatório.",
            'email.email' => "Introduza um email válido."
        ]);

        // Se a validação passar, o e-mail existe na tabela de usuários
        // Agora, você pode gerar um token de redefinição de senha e enviar um e-mail com um link para redefinir a senha

        // Gerar um token de redefinição de senha
        /*$status = Password::sendResetLink(
            $request->only('email')
        );*/

        // Generate a new token
        $token = Str::random(60);

        // Insert the token into the password_resets table
        $db = DB::table('password_reset_tokens')->updateOrInsert([
            'email' => $request->email,
        ], [
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        $link = route('password.reset.link', ['token' => $token, 'email' => $request->email]);

        Mail::to($request->email)->send(new LinkRecuperarSenha($link));

        // Verificar o status para determinar a resposta adequada
        if ($db) {
            return redirect()->route('login')->with('info', "Enviamos por e-mail seu link de redefinição de senha.");
        } else {
            return redirect()->route('recuperar_senha')->withErrors(['email' => "Algo deu errado, atualize a página e tente novamente."]);
        }
    }

    public function password_reset(Request $request)
    {
        // Recuperar o token e o email da solicitação GET
        $token = $request->input('token');
        $email = $request->input('email');

        // Verificar se o token é válido consultando a tabela de resets de senha
        $reset = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->where('token', $token)
            ->first();

        if ($reset) {
            return view('auth.alterarSenha');
        } else {
            return redirect()->route('login')->with('error', 'Link inválido.');
        }
    }

    public function post_password_reset(Request $request) //password_reset
    {
        // Validação dos dados recebidos
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.required' => 'A nova senha é obrigatória.',
            'password.string' => 'A nova senha deve ser uma string.',
            'password.min' => 'A nova senha deve ter no mínimo :min caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
        ]);

        $email = $request->input('email');

        // Localizar o usuário com base no e-mail fornecido
        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->with('error', 'Endereço de e-mail não encontrado.');
        }

        // Redefinir a senha do usuário
        $user->password = Hash::make($request->password);
        $user->save();

        Mail::to($email)->send(new SenhaAlterada($email, $user->nome));

        // Retornar uma resposta adequada
        return redirect()->route('login')->with('success', 'Senha alterada com sucesso. Faça o login com sua nova senha.');
    }

    public function conta_criada()
    {
        $app_desc = "Crie uma conta na " . env('APP_NAME') . " e esteja a para de tudo.";
        $app_keywords = "criar conta, pharmatina, augusto kussema, gestão farmacéutica angola, google ao";

        return view('auth.contaCriada', compact('app_desc', 'app_keywords'));
    }

    public function login(Request $request)
    {
        $sessName = env('APP_NAME') . '_session';

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

        // Criar novo usuário
        $user = User::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = self::gerarToken($user, "Confirmação de email");

        $nomeUser = $request->nome;
        $email_to = $request->email;
        $url_ativacao = route('auth.confirmar_email', ['token' => $token->token]);

        Mail::to($email_to)->send(new AtivarUsuario($nomeUser, $url_ativacao, $email_to));

        // Se necessário, faça login automaticamente do usuário
        //auth()->login($user);

        // Redirecionar o usuário após o registro
        #return redirect()->route('home')->with('success', 'Conta criada com sucesso!');
        // if ($request->ajax()) {
        //     //return response()->json(['message' => 'Cadastro efetuado', 'success' => true],201);
        //     return redirect()->route('conta_criada')->with('email', $request->email);
        // }
        return redirect()->route('conta_criada')->with('email', $request->email);
    }

    public function confirmar_email_store(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required|min:6',
            'token_id' => 'required|exists:users_tokens,id'
        ], [
            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha deve no minimo :min caracteres',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $token = UT::find($request->token_id);
            $usr = Auth::user();

            $usr->update([
                'email_verified_at' => now()
            ]);

            $token->update([
                'last_used_at' => now()
            ]);

            Auth::logout();

            return redirect()->route('login')->with('success', "Agora só falta a administração rever a tua conta. Receberás um email quando a administração rever a tua conta.");
        }

        return redirect()->back()->with('error', "Senha inválida");
    }
    public function confirmar_email($to)
    {
        $token = UT::where('token', $to)->first();
        if (!$token)
            return redirect()->route('login')->with('error', 'Este link é inválido.');
        if ($token->last_used_at)
            return redirect()->route('login')->with('error', 'Este link é inválido.');

        $app_desc = "Crie uma conta na " . env('APP_NAME') . " e esteja a para de tudo.";
        $app_keywords = "criar conta, pharmatina, augusto kussema, gestão farmacéutica angola, google ao";

        return view('auth.confirmEmail', compact('app_desc', 'app_keywords', 'token'));
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
