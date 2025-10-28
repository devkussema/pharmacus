<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class UsersPermissionsController extends Controller
{
    /**
     * Mostrar formulário simples para editar permissões de um utilizador.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        // Carrega todas as permissões existentes e nome das permissões atribuídas ao utilizador
        $permissions = Permission::orderBy('name')->get();
        $userPermissions = $user->getPermissionNames()->toArray();

        return view('admin::users.edit-permissions', compact('user', 'permissions', 'userPermissions'));
    }

    /**
     * Actualizar permissões do utilizador (sincroniza). Espera um array 'permissions' com nomes.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'permissions' => 'nullable|array',
            'permissions.*' => 'string',
        ]);

        $perms = $validated['permissions'] ?? [];

        // Sincroniza permissões (Spatie)
        $user->syncPermissions($perms);

        return redirect()->route('cp.users.show', $user->id)->with('success', 'Permissões actualizadas com sucesso.');
    }
}
