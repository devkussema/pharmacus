<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    User,GerenteFarmacia,Farmacia, UsersToken as UT
};

class AutenticarUserController extends Controller
{
    public function gerenteFarmacia(Request $request)
    {
        if ( !higienizarEmail($request->email) ){
            if ($request->ajax()) {
                return response()->json(['message' => "Informe um email válido"], 401);
            }
            return redirect()->back()->with('error', 'Informe um email válido');
        }

        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required',
            'email_verified_at' => 'required',
            'token' => 'required'
        ],[
            'email.required' => 'O email é obrigatório',
            'email.exists' => "Credenciais inválidas, tente novamente",
            'password.required' => 'Informe a senha'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            User::where('email', $request->email)->update([
                'email_verified_at' => now(),
                'status' => 1,
            ]);

            $gf = GerenteFarmacia::where('user_id', Auth::user()->id)->first();
            Farmacia::where('id', $gf->farmacia_id)->update(['status' => 1]);

            UT::where('token', $request->token)->update([
                'last_used_at' => now()
            ]);

            if ($request->ajax()) {
                return response()->json(['message' => 'Cadastro efetuado', 'success' => true],201);
            }

            return redirect()->route('home');
        }
    }
}
