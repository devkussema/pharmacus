<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fornecedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FornecedorController extends Controller
{
    /**
     * Exibe a view principal de fornecedores.
     *
     * @author Augusto Kussema
     * @created 2025-11-26
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('prepharma.fornecedores.show');
    }

    /**
     * Lista fornecedores via AJAX (para DataTables).
     * Suporta filtros: nome, tipo, status, avaliacao_min.
     *
     * @author Augusto Kussema
     * @created 2025-11-26
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listar(Request $request)
    {
        $query = Fornecedor::query();

        // Filtros
        if ($request->filled('nome')) {
            $query->buscar($request->nome);
        }

        if ($request->filled('tipo')) {
            $query->porTipo($request->tipo);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('avaliacao_min')) {
            $query->where('avaliacao', '>=', $request->avaliacao_min);
        }

        // Ordenação e paginação
        $fornecedores = $query->orderBy('nome', 'asc')->get();

        return response()->json(['data' => $fornecedores]);
    }

    /**
     * Retorna detalhes de um fornecedor específico.
     *
     * @author Augusto Kussema
     * @created 2025-11-26
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $fornecedor = Fornecedor::find($id);

        if (!$fornecedor) {
            return response()->json(['message' => 'Fornecedor não encontrado'], 404);
        }

        return response()->json($fornecedor);
    }

    /**
     * Cria um novo fornecedor.
     *
     * @author Augusto Kussema
     * @created 2025-11-26
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'nif' => 'nullable|string|max:50|unique:fornecedores,nif',
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:50',
            'telemovel' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'endereco' => 'nullable|string|max:500',
            'cidade' => 'nullable|string|max:100',
            'provincia' => 'nullable|string|max:100',
            'tipo' => 'nullable|in:nacional,internacional',
            'status' => 'nullable|in:ativo,inativo,bloqueado',
        ], [
            'nome.required' => 'O nome do fornecedor é obrigatório',
            'nif.unique' => 'Este NIF já está cadastrado',
            'email.email' => 'Email inválido',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $fornecedor = Fornecedor::create($request->all());

        return response()->json([
            'message' => 'Fornecedor cadastrado com sucesso',
            'fornecedor' => $fornecedor
        ], 201);
    }

    /**
     * Atualiza um fornecedor existente.
     *
     * @author Augusto Kussema
     * @created 2025-11-26
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $fornecedor = Fornecedor::find($id);

        if (!$fornecedor) {
            return response()->json(['message' => 'Fornecedor não encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'nif' => 'nullable|string|max:50|unique:fornecedores,nif,' . $id,
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:50',
            'telemovel' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'endereco' => 'nullable|string|max:500',
            'cidade' => 'nullable|string|max:100',
            'provincia' => 'nullable|string|max:100',
            'tipo' => 'nullable|in:nacional,internacional',
            'status' => 'nullable|in:ativo,inativo,bloqueado',
        ], [
            'nome.required' => 'O nome do fornecedor é obrigatório',
            'nif.unique' => 'Este NIF já está cadastrado',
            'email.email' => 'Email inválido',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $fornecedor->update($request->all());

        return response()->json([
            'message' => 'Fornecedor atualizado com sucesso',
            'fornecedor' => $fornecedor
        ]);
    }

    /**
     * Exclui (soft delete) um fornecedor.
     *
     * @author Augusto Kussema
     * @created 2025-11-26
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $fornecedor = Fornecedor::find($id);

        if (!$fornecedor) {
            return response()->json(['message' => 'Fornecedor não encontrado'], 404);
        }

        $fornecedor->delete();

        return response()->json(['message' => 'Fornecedor excluído com sucesso']);
    }
}
