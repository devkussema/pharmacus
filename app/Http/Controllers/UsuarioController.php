<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;

/**
 * Class UsuarioController
 *
 * Controlador para operações de usuário (edição via modal, etc).
 *
 * @author Augusto Kussema
 * @date 2025-09-27
 */
class UsuarioController extends Controller
{
	// ...existing code...

	/**
	 * Atualiza um utilizador (sem alterar a senha).
	 *
	 * Valida: nome, email (único exceto o próprio), grupo_id opcional, status e telefone.
	 *
	 * Autor: Augusto Kussema
	 * Data: 2025-09-27
	 *
	 * @param Request $request
	 * @param User $user
	 * @return JsonResponse
	 */
	public function update(Request $request, User $user): JsonResponse
	{
		$validated = $request->validate([
			'nome' => ['required', 'string', 'max:255'],
			'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$user->id],
			'grupo_id' => ['nullable', 'integer'],
			'status' => ['nullable', 'in:0,1'],
			'telefone' => ['nullable', 'string', 'max:50'],
		]);

		// normaliza o status para boolean
		$validated['status'] = array_key_exists('status', $validated) ? (bool)$validated['status'] : false;

		$user->fill($validated);
		$user->save();

		$user->load('grupo');

		return response()->json([
			'success' => true,
			'user' => [
				'id' => $user->id,
				'nome' => $user->nome,
				'email' => $user->email,
				'telefone' => $user->telefone,
				'grupo' => optional($user->grupo)->nome,
				'isFarmacia' => (bool)$user->isFarmacia,
				'status' => (bool)$user->status,
				'perfil_url' => $user->perfil_url,
				'foto_perfil' => $user->foto_perfil_url,
			]
		], 200);
	}

	// ...existing code...
}
