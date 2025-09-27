<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    Farmacia, User, Grupo
};

class UsuarioController extends Controller
{
    /**
     * Lista a página de usuários ou retorna usuários filtrados via JSON para requisições AJAX.
     *
     * Inputs (opcionais):
     * - search: string para buscar por nome ou email
     * - grupo_id: id do grupo
     * - tipo: 'gerente' | 'usuario' | 'all'
     * - status: 1 | 0
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     * @author Augusto Kussema
     * @created 2025-09-27
     */
    public function index(Request $request)
    {
        $farmacias = Farmacia::all();
        $grupos = Grupo::all();

        // Se for uma requisição AJAX (ou espera JSON), retornar apenas os usuários filtrados em JSON
        if ($request->ajax() || $request->wantsJson()) {
            $query = User::with('grupo');

            if ($request->filled('search')) {
                $s = '%' . $request->input('search') . '%';
                $query->where(function ($q) use ($s) {
                    $q->where('nome', 'like', $s)
                        ->orWhere('email', 'like', $s);
                });
            }

            if ($request->filled('grupo_id')) {
                $query->where('grupo_id', $request->input('grupo_id'));
            }

            if ($request->filled('tipo') && $request->input('tipo') !== 'all') {
                if ($request->input('tipo') === 'gerente') {
                    $query->where('isFarmacia', 1);
                } elseif ($request->input('tipo') === 'usuario') {
                    $query->where('isFarmacia', 0);
                }
            }

            if ($request->filled('status')) {
                $st = intval($request->input('status'));
                $query->where('status', $st);
            }

            $users = $query->orderBy('nome')->get();

            $result = $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'nome' => $user->nome,
                    'email' => $user->email,
                    'grupo' => optional($user->grupo)->nome ?? null,
                    'isFarmacia' => (bool) $user->isFarmacia,
                    'status' => (bool) $user->status,
                    'telefone' => $user->telefone ?? null,
                    'foto_perfil' => $user->foto_perfil ? url('storage/' . $user->foto_perfil) : assetr('assets/images/default-avatar.png'),
                    'perfil_url' => route('u.perfil', ['username' => $user->username ?? $user->id]),
                ];
            });

            return response()->json(['users' => $result], 200);
        }

        // Requisição normal: renderizar a view com todos os usuários (fallback)
        $users = User::all();
        return view('usuario.show', compact('farmacias', 'users', 'grupos'));
    }

    public function perfil($username)
    {
        $u = User::where('username', $username)->first();

        if (!$u)
            return redirect()->back()->with('warning', 'Ocorreu um erro, usuário não encontrado!');

        return view('perfil.config', compact('u'));
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current-password' => 'required|string|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('home')->with('success', 'Senha alterada com sucesso!');
    }

    public function unblockUser(Request $request, $id)
    {
        $u = User::find($id);
        if (!$u) {
            if ($request->ajax())
                return response()->json(['message' => 'Ocorreu um erro e não pudemos processar o seu pedido'], 422);

            return redirect()->back()->with('error', 'Ocorreu um erro e não pudemos processar o seu pedido');
        }

        $u->update([
            'status' => 1
        ]);

        if ($request->ajax())
            return response()->json(['message' => 'Usuário desbloqueado'], 201);

        return redirect()->route('funcionarios')->with('success', 'Usuário desbloqueado');
    }

    public function blockUser(Request $request, $id)
    {
        $u = User::find($id);
        if (!$u) {
            if ($request->ajax())
                return response()->json(['message' => 'Ocorreu um erro e não pudemos processar o seu pedido'], 422);

            return redirect()->back()->with('error', 'Ocorreu um erro e não pudemos processar o seu pedido');
        }

        $u->update([
            'status' => 0
        ]);

        if ($request->ajax())
            return response()->json(['message' => 'Usuário bloqueado'], 201);

        return redirect()->back()->with('success', 'Usuário bloqueado');
    }

    public function addCargo(Request $request)
    {
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $usr = User::find($request->user_id);
        if ($usr) {
            $usr->update([
                'grupo_id' => $request->grupo_id
            ]);

            return response()->json(['message' => 'Cargo atribuido'], 200);
        }
        return response()->json(['message' => 'Ocorreu um erro, por favor atualize a página e tente novamente'], 404);
    }

    public function getUser($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json($user);
        }

        return response()->json(['message' => 'Ocorreu um erro, por favor recarregue a página e tente novamente'], 404);
    }
}
