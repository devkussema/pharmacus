<?php

namespace App\Http\Controllers\Mailer;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\Welcome;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Controlador Welcome
 *
 * Responsável pelo envio de e-mails de boas-vindas aos utilizadores.
 *
 * Autor: Augusto Kussema
 * Data: 01/10/2025
 */
class WelcomeController extends Controller
{
    /**
     * Envia e-mail de boas-vindas para um utilizador específico.
     *
     * @param Request $request
     * @param string $id UUID do utilizador
     * @return \Illuminate\Http\JsonResponse
     */
    public function enviarBoasVindas(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Utilizador não encontrado.'
            ], 404);
        }

        try {
            // Gera URL de confirmação (ajuste conforme sua lógica)
            $url = route('login'); // Pode ser ajustado para uma rota específica

            Mail::to($user->email)->send(new Welcome($user->nome, $url));

            /* return response()->json([
                'success' => true,
                'message' => 'E-mail de boas-vindas enviado com sucesso.'
            ], 200); */

            return redirect()->back()->with('success', 'E-mail de boas-vindas enviado com sucesso.');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao enviar e-mail: ' . $e->getMessage()
            ], 500);
        }
    }
}
