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
    public function index()
    {
        $farmacias = Farmacia::all();
        $users = User::all();
        $grupos = Grupo::all();
        return view('usuario.show', compact('farmacias', 'users', 'grupos'));
    }

    public function perfil($username)
    {
        $u = User::where('username', $username)->first();

        if (!$u)
            return redirect()->back()->with('warning', 'Ocorreu um erro, usuário não encontrado!');

        return view('perfil.timeline', compact('u'));
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
