<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

        return view('perfil.view', compact('u'));
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
