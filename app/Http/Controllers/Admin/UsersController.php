<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

/**
 * Controller resource para gerir Users no painel Admin.
 *
 * autor: Augusto Kussema
 * Data: 2025-10-21 09:45 (Luanda)
 */
class UsersController extends Controller
{
    /**
     * Lista todos os utilizadores.
     */
    public function index(Request $request)
    {
        $users = User::paginate(25);
        return view('admin::users.index', compact('users'));
    }

    /**
     * Mostra formulário para criar um novo utilizador.
     */
    public function create()
    {
        return view('admin::users.create');
    }

    /**
     * Guarda novo utilizador.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'nullable|in:super_admin,admin,user',
        ]);

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        return redirect()->route('admin.users.index')->with('success', 'Utilizador criado com sucesso.');
    }

    /**
     * Mostra os detalhes de um utilizador.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin::users.show', compact('user'));
    }

    /**
     * Mostra formulário para editar um utilizador.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin::users.edit', compact('user'));
    }

    /**
     * Actualiza um utilizador existente.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'nullable|in:super_admin,admin,user',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Utilizador actualizado com sucesso.');
    }

    /**
     * Remove um utilizador.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Utilizador removido.');
    }
}
