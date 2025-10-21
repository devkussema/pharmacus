<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $query = $request->input('q');
        $usersQuery = User::query();
        if (!empty($query)) {
            $usersQuery->where(function ($q) use ($query) {
                $q->where('nome', 'like', "%{$query}%")
                  ->orWhere('email', 'like', "%{$query}%")
                  ->orWhere('telefone', 'like', "%{$query}%");
            });
        }

        $users = $usersQuery->paginate(25)->appends($request->only('q'));

        // If the request is AJAX, return only the rendered rows to update the table body
        if ($request->ajax()) {
            $rows = view('admin::users._rows', compact('users'))->render();
            $pagination = view('admin::users._pagination', compact('users'))->render();
            return response()->json(['html' => $rows, 'pagination' => $pagination]);
        }

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
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'nullable|in:super_admin,admin,user',
            'grupo_id' => 'nullable|exists:grupos,id',
            'telefone' => 'nullable|string|max:30',
            'telefone_sec' => 'nullable|string|max:30',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'estado' => 'nullable|string|max:30',
            'pode_cadastrar_produtos' => 'nullable|boolean',
            'observacoes' => 'nullable|string',
        ]);

        // Normaliza boolean do checkbox
        $validated['pode_cadastrar_produtos'] = $request->has('pode_cadastrar_produtos') ? 1 : 0;

        // Trata upload da foto de perfil (se houver)
        if ($request->hasFile('foto_perfil')) {
            $path = $request->file('foto_perfil')->store('users', 'public');
            $validated['foto_perfil'] = $path;
        }

        // Hashear password
        $validated['password'] = bcrypt($validated['password']);

        // Criar o utilizador apenas com campos fillable
        $user = User::create(array_intersect_key($validated, array_flip((new User())->getFillable())));

        return redirect()->route('cp.users.index')->with('success', 'Utilizador criado com sucesso.');
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

    return redirect()->route('cp.users.index')->with('success', 'Utilizador actualizado com sucesso.');
    }

    /**
     * Remove um utilizador.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    return redirect()->route('cp.users.index')->with('success', 'Utilizador removido.');
    }
}
