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

        // Permissões atribuídas directamente ao utilizador (model_has_permissions)
        $directPermissions = $user->getDirectPermissions()->pluck('name')->toArray();

        // Permissões obtidas via roles atribuídas ao utilizador
        $roles = $user->roles()->with('permissions')->get();
        $rolePermissions = [];
        $permissionRolesMap = [];
        foreach ($roles as $role) {
            foreach ($role->permissions as $p) {
                $rolePermissions[$p->name] = true;
                $permissionRolesMap[$p->name][] = $role->name;
            }
        }

        // Todas as permissões efectivas do user (direct + via roles)
        $effectivePermissions = array_values(array_unique(array_merge($directPermissions, array_keys($rolePermissions))));

        // Usar view()->file para evitar problemas de resolução de namespace em tempo de análise.
        return view()->file(app_path('Views/users/edit-permissions.blade.php'), compact('user', 'permissions', 'directPermissions', 'rolePermissions', 'permissionRolesMap', 'effectivePermissions'));
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
