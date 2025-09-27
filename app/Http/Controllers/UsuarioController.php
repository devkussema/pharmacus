<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Grupo;

/**
 * Controlador de Usuários
 *
 * Responsável pela gestão de utilizadores do sistema.
 *
 * Autor: Augusto Kussema
 * Data: 2025-09-27
 */
class UsuarioController extends Controller
{
	// ...existing code...

	/**
	 * Exibe o formulário de edição do usuário.
	 *
	 * @param User $user
	 * @return View
	 */
	public function edit(User $user): View
	{
		$grupos = Grupo::orderBy('nome')->get();

		return view('usuario.edit', compact('user', 'grupos'));
	}

	/**
	 * Atualiza um utilizador (funciona com AJAX e formulário tradicional).
	 *
	 * Valida: nome, email (único exceto o próprio), grupo_id opcional,
	 * status, telefone, foto de perfil e tipo de usuário.
	 *
	 * Autor: Augusto Kussema
	 * Data: 2025-09-27
	 *
	 * @param Request $request
	 * @param User $user
	 * @return JsonResponse|RedirectResponse
	 */
	public function update(Request $request, User $user): JsonResponse|RedirectResponse
	{
		$validated = $request->validate([
			'nome' => ['required', 'string', 'max:255'],
			'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
			'grupo_id' => ['nullable', 'exists:grupos,id'],
			'status' => ['nullable', 'boolean'],
			'telefone' => ['nullable', 'string', 'max:50'],
			'isFarmacia' => ['nullable', 'boolean'],
			'foto_perfil' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
		]);

		// Processar upload da foto de perfil
		if ($request->hasFile('foto_perfil')) {
			// Remover foto anterior se existir
			if ($user->foto_perfil) {
				Storage::disk('public')->delete($user->foto_perfil);
			}

			// Armazenar nova foto
			$validated['foto_perfil'] = $request->file('foto_perfil')->store('perfil', 'public');
		}

		// Normalizar campos booleanos
		$validated['status'] = $request->has('status') ? (bool) $request->input('status') : false;
		$validated['isFarmacia'] = $request->has('isFarmacia') ? (bool) $request->input('isFarmacia') : false;

		// Atualizar o usuário
		$user->fill($validated);
		$user->save();

		// Verificar se é uma requisição AJAX
		if ($request->expectsJson() || $request->ajax()) {
			$user->load('grupo');

			return response()->json([
				'success' => true,
				'message' => 'Usuário atualizado com sucesso.',
				'user' => [
					'id' => $user->id,
					'nome' => $user->nome,
					'email' => $user->email,
					'telefone' => $user->telefone,
					'grupo' => optional($user->grupo)->nome,
					'isFarmacia' => (bool) $user->isFarmacia,
					'status' => (bool) $user->status,
					'perfil_url' => $user->perfil_url,
					'foto_perfil' => $user->foto_perfil_url,
				]
			], 200);
		}

		// Resposta para formulário tradicional
		return redirect()
			->route('usuario')
			->with('success', 'Usuário atualizado com sucesso.');
	}

	// ...existing code...
}
