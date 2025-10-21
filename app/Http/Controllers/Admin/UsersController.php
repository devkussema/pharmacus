<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
        // Validação com mensagens em português
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'nullable|in:super_admin,admin,user',
            'grupo_id' => 'nullable|exists:grupos,id',
            'telefone' => 'nullable|string|max:30',
            'telefone_sec' => 'nullable|string|max:30',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'nullable|string|max:30',
            'pode_cadastrar_produtos' => 'nullable|boolean',
            'observacoes' => 'nullable|string',
        ], [
            'nome.required' => 'O nome é obrigatório.',
            'nome.string' => 'O nome deve ser texto.',
            'nome.max' => 'O nome não pode exceder 255 caracteres.',

            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail deve ser um endereço válido.',
            'email.unique' => 'O e-mail já está em uso.',

            'password.required' => 'A palavra-passe é obrigatória.',
            'password.string' => 'A palavra-passe deve ser texto.',
            'password.min' => 'A palavra-passe deve ter pelo menos 8 caracteres.',
            'password.confirmed' => 'A confirmação da palavra-passe não coincide.',

            'role.in' => 'O papel selecionado é inválido. Opções: super_admin, admin, user.',

            'grupo_id.exists' => 'O grupo selecionado não existe.',

            'telefone.string' => 'O telefone deve ser texto.',
            'telefone.max' => 'O telefone não pode exceder 30 caracteres.',
            'telefone_sec.string' => 'O telefone secundário deve ser texto.',
            'telefone_sec.max' => 'O telefone secundário não pode exceder 30 caracteres.',

            'foto_perfil.image' => 'A foto de perfil deve ser uma imagem.',
            'foto_perfil.mimes' => 'Tipos permitidos para a foto de perfil: jpeg, png, jpg, gif, webp.',
            'foto_perfil.max' => 'A foto de perfil não pode exceder 2 MB.',
            'foto_perfil.uploaded' => 'Falha no upload da foto (tamanho excede o permitido pelo servidor ou erro na transferência).',

            'estado.string' => 'O estado deve ser texto.',
            'estado.max' => 'O estado não pode exceder 30 caracteres.',

            'pode_cadastrar_produtos.boolean' => 'Valor inválido para a opção de cadastrar produtos.',

            'observacoes.string' => 'As observações devem ser texto.',
        ]);

        // Normaliza boolean do checkbox
        $validated['pode_cadastrar_produtos'] = $request->has('pode_cadastrar_produtos') ? 1 : 0;

        // Trata upload da foto de perfil (se houver)
        if ($request->hasFile('foto_perfil')) {
            $file = $request->file('foto_perfil');
            if (!$file->isValid()) {
                $code = $file->getError();
                $msg = match ($code) {
                    UPLOAD_ERR_INI_SIZE => 'O ficheiro excede o limite do servidor (upload_max_filesize).',
                    UPLOAD_ERR_FORM_SIZE => 'O ficheiro excede o tamanho máximo permitido pelo formulário.',
                    UPLOAD_ERR_PARTIAL => 'Upload parcial. Por favor tente novamente.',
                    UPLOAD_ERR_NO_FILE => 'Nenhum ficheiro foi enviado.',
                    UPLOAD_ERR_NO_TMP_DIR => 'Pasta temporária em falta no servidor.',
                    UPLOAD_ERR_CANT_WRITE => 'Falha ao gravar o ficheiro no disco.',
                    UPLOAD_ERR_EXTENSION => 'Upload interrompido por extensão no servidor.',
                    default => 'Erro desconhecido no upload (código ' . $code . ').',
                };
                return back()->withErrors(['foto_perfil' => $msg])->withInput();
            }

            try {
                $path = $file->store('users', 'public');
                $validated['foto_perfil'] = $path;
            } catch (\Throwable $e) {
                return back()->withErrors(['foto_perfil' => 'Falha ao guardar a foto: ' . $e->getMessage()])->withInput();
            }
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

        // Validar campos editáveis
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'nullable|in:super_admin,admin,user',
            'grupo_id' => 'nullable|exists:grupos,id',
            'telefone' => 'nullable|string|max:30',
            'telefone_sec' => 'nullable|string|max:30',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'nullable|string|max:30',
            'pode_cadastrar_produtos' => 'nullable|boolean',
            'observacoes' => 'nullable|string',
        ]);

        // Normaliza checkbox
        $validated['pode_cadastrar_produtos'] = $request->has('pode_cadastrar_produtos') ? 1 : 0;

        // Trata upload da nova foto se existir
        if ($request->hasFile('foto_perfil')) {
            $file = $request->file('foto_perfil');
            if ($file->isValid()) {
                try {
                    // eliminar foto antiga se existir
                    if ($user->foto_perfil && Storage::disk('public')->exists($user->foto_perfil)) {
                        Storage::disk('public')->delete($user->foto_perfil);
                    }
                    $path = $file->store('users', 'public');
                    $validated['foto_perfil'] = $path;
                } catch (\Throwable $e) {
                    return back()->withErrors(['foto_perfil' => 'Falha ao guardar a foto: ' . $e->getMessage()])->withInput();
                }
            } else {
                return back()->withErrors(['foto_perfil' => 'Ficheiro inválido no upload.'])->withInput();
            }
        }

        // Hashear senha apenas se fornecida
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Atualizar apenas campos fillable
        $user->update(array_intersect_key($validated, array_flip((new User())->getFillable())));

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
