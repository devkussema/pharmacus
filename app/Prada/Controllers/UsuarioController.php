<?php
declare(strict_types=1);

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\{
    Farmacia, User, Grupo
};

/**
 * Controlador de Usuários
 *
 * Responsável pela gestão de utilizadores do sistema Pharmacus.
 *
 * @author Augusto Kussema
 * @created 2025-09-27
 */
class UsuarioController extends Controller
{
    /**
     * Lista a página de usuários ou retorna usuários filtrados via JSON para requisições AJAX.
     *
     * Inputs (opcionais):
     * - search: string para buscar por nome ou email
     * - grupo_id: id do grupo
     * - tipo: 'gerente' | 'usuario' | 'all'
     * - status: 1 | 0
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     * @author Augusto Kussema
     * @created 2025-09-27
     */
    public function index(Request $request)
    {
        $farmacias = Farmacia::all();
        $grupos = Grupo::all();

        // Se for uma requisição AJAX (ou espera JSON), retornar apenas os usuários filtrados em JSON
        if ($request->ajax() || $request->wantsJson()) {
            $query = User::with('grupo');

            if ($request->filled('search')) {
                $s = '%' . $request->input('search') . '%';
                $query->where(function ($q) use ($s) {
                    $q->where('nome', 'like', $s)
                        ->orWhere('email', 'like', $s);
                });
            }

            if ($request->filled('grupo_id')) {
                $query->where('grupo_id', $request->input('grupo_id'));
            }

            if ($request->filled('tipo') && $request->input('tipo') !== 'all') {
                if ($request->input('tipo') === 'gerente') {
                    $query->where('isFarmacia', 1);
                } elseif ($request->input('tipo') === 'usuario') {
                    $query->where('isFarmacia', 0);
                }
            }

            if ($request->filled('status')) {
                $st = intval($request->input('status'));
                $query->where('status', $st);
            }

            $users = $query->orderBy('nome')->get();

            $result = $users->map(function ($user) {
                return [
                    'id' => $user->id,
                    'nome' => $user->nome,
                    'email' => $user->email,
                    'grupo' => optional($user->grupo)->nome ?? null,
                    'grupo_id' => $user->grupo_id,
                    'isFarmacia' => (bool) $user->isFarmacia,
                    'status' => (bool) $user->status,
                    'telefone' => $user->telefone ?? null,
                    'foto_perfil' => $user->foto_perfil ? url('storage/' . $user->foto_perfil) : assetr('assets/images/default-avatar.png'),
                    'perfil_url' => route('u.perfil', ['username' => $user->username ?? $user->id]),
                ];
            });

            return response()->json(['users' => $result], 200);
        }

        // Requisição normal: renderizar a view com todos os usuários (fallback)
        $users = User::all();
        return view('usuario.show', compact('farmacias', 'users', 'grupos'));
    }

    /**
     * Exibe o formulário de edição de um usuário.
     *
     * Input:
     * - id: identificador do usuário
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     *
     * @author Augusto Kussema
     * @created 2025-09-27
     */
    public function edit(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => 'Usuário não encontrado'], 404);
            }

            return redirect()->back()->with('warning', 'Usuário não encontrado!');
        }

        $farmacias = Farmacia::all();
        $grupos = Grupo::all();

        return view('usuario.edit', compact('user', 'farmacias', 'grupos'));
    }

    public function perfil($username)
    {
        $u = User::where('username', $username)->first();

        if (!$u)
            return redirect()->back()->with('warning', 'Ocorreu um erro, usuário não encontrado!');

        return view('perfil.config', compact('u'));
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current-password' => 'required|string|current_password',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('home')->with('success', 'Senha alterada com sucesso!');
    }

    public function unblockUser(Request $request, $id)
    {
        $u = User::find($id);
        if (!$u) {
            if ($request->ajax())
                return response()->json(['message' => 'Ocorreu um erro e não pudemos processar o seu pedido'], 422);

            return redirect()->back()->with('error', 'Ocorreu um erro e não pudemos processar o seu pedido');
        }

        $u->update([
            'status' => 1
        ]);

        if ($request->ajax())
            return response()->json(['message' => 'Usuário desbloqueado'], 201);

        return redirect()->route('funcionarios')->with('success', 'Usuário desbloqueado');
    }

    public function blockUser(Request $request, $id)
    {
        $u = User::find($id);
        if (!$u) {
            if ($request->ajax())
                return response()->json(['message' => 'Ocorreu um erro e não pudemos processar o seu pedido'], 422);

            return redirect()->back()->with('error', 'Ocorreu um erro e não pudemos processar o seu pedido');
        }

        $u->update([
            'status' => 0
        ]);

        if ($request->ajax())
            return response()->json(['message' => 'Usuário bloqueado'], 201);

        return redirect()->back()->with('success', 'Usuário bloqueado');
    }

    public function addCargo(Request $request)
    {
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'user_id' => 'required|exists:users,id'
        ]);

        $usr = User::find($request->user_id);
        if ($usr) {
            $usr->update([
                'grupo_id' => $request->grupo_id
            ]);

            return response()->json(['message' => 'Cargo atribuido'], 200);
        }
        return response()->json(['message' => 'Ocorreu um erro, por favor atualize a página e tente novamente'], 404);
    }

    public function getUser($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json($user);
        }

        return response()->json(['message' => 'Ocorreu um erro, por favor recarregue a página e tente novamente'], 404);
    }

    /**
     * Atualiza as informações de um utilizador.
     *
     * Valida e atualiza: nome, email (único exceto o próprio), grupo_id opcional,
     * status, telefone, foto de perfil e tipo de usuário (isFarmacia).
     * Não altera a senha neste método.
     *
     * @param Request $request
     * @param string $id - UUID do usuário
     * @return JsonResponse|RedirectResponse
     *
     * @author Augusto Kussema
     * @created 2025-09-27
     */
    public function update(Request $request, string $id): JsonResponse|RedirectResponse
    {
        $user = User::find($id);

        if (!$user) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => 'Usuário não encontrado'], 404);
            }
            return redirect()->back()->with('error', 'Usuário não encontrado!');
        }

        // Validação dos dados de entrada
        $validated = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'grupo_id' => ['nullable', 'exists:grupos,id'],
            'status' => ['nullable', 'in:0,1'],
            'telefone' => ['nullable', 'string', 'max:50'],
            'isFarmacia' => ['nullable', 'boolean'],
            'foto_perfil' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ], [
            'nome.required' => 'O nome é obrigatório.',
            'nome.max' => 'O nome não pode ter mais de 255 caracteres.',
            'grupo_id.exists' => 'O grupo selecionado não existe.',
            'status.in' => 'O status deve ser Ativo ou Inativo.',
            'telefone.max' => 'O telefone não pode ter mais de 50 caracteres.',
            'foto_perfil.image' => 'O arquivo deve ser uma imagem.',
            'foto_perfil.mimes' => 'A foto deve ser nos formatos: JPG, PNG, GIF.',
            'foto_perfil.max' => 'A foto não pode ser maior que 2MB.',
        ]);

        // Processar upload da foto de perfil
        if ($request->hasFile('foto_perfil')) {
            // Remover foto anterior se existir
            if ($user->foto_perfil && Storage::disk('public')->exists($user->foto_perfil)) {
                Storage::disk('public')->delete($user->foto_perfil);
            }

            // Armazenar nova foto
            $validated['foto_perfil'] = $request->file('foto_perfil')->store('perfil', 'public');
        }

        // Normalizar campos booleanos conforme padrão do sistema
        if ($request->has('status')) {
            $validated['status'] = $request->input('status') === '1' ? 1 : 0;
        }
        $validated['isFarmacia'] = $request->has('isFarmacia') ? (bool) $request->input('isFarmacia') : false;

        // Atualizar o usuário
        $user->fill($validated);
        $user->save();

        // Verificar se é uma requisição AJAX (para modal)
        if ($request->ajax() || $request->wantsJson()) {
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
                    'perfil_url' => route('u.perfil', ['username' => $user->username ?? $user->id]),
                    'foto_perfil' => $user->foto_perfil ? url('storage/' . $user->foto_perfil) : assetr('assets/images/default-avatar.png'),
                ]
            ], 200);
        }

        // Resposta para formulário tradicional
        return redirect()
            ->route('usuario')
            ->with('success', 'Usuário atualizado com sucesso.');
    }
}
