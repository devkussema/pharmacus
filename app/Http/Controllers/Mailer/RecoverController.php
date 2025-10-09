<?php

namespace App\Http\Controllers\Mailer;

use App\Http\Controllers\Controller;
use App\Mail\Recover;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route as RouteFacade;
use Illuminate\Support\Facades\URL;

/**
 * Controlador Recover
 *
 * Responsável por reenviar e-mails de redefinição de senha.
 *
 * @author Augusto Kussema
 * @since 01/10/2025
 */
class RecoverController extends Controller
{
    /**
     * Reenvia e-mail de redefinição de senha para um utilizador específico.
     *
     * @param Request $request
     * @param string $id UUID do utilizador
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enviarEmailRedefinicao(Request $request, string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'Utilizador não encontrado.');
        }

        try {
            // URL de redefinição: usa rota nomeada se existir, senão fallback
            $url = RouteFacade::has('password.request')
                ? route('password.request')
                : url('/forgot-password');

            Mail::to($user->email)->send(new Recover($user->nome, $url));

            return redirect()->back()->with('success', 'E-mail de redefinição enviado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao enviar e-mail: ' . $e->getMessage());
        }
    }
}
