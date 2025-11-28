<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Atividade;
use App\Models\Fornecedor;
use App\Services\AtividadeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Validator, Log};

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
        $filtrosAplicados = [];

        if ($request->filled('nome')) {
            $query->buscar($request->nome);
            $filtrosAplicados['nome'] = $request->nome;
        }

        if ($request->filled('tipo')) {
            $query->porTipo($request->tipo);
            $filtrosAplicados['tipo'] = $request->tipo;
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
            $filtrosAplicados['status'] = $request->status;
        }

        if ($request->filled('avaliacao_min')) {
            $query->where('avaliacao', '>=', $request->avaliacao_min);
            $filtrosAplicados['avaliacao_min'] = $request->avaliacao_min;
        }

        // Ordenação e paginação
        $fornecedores = $query->orderBy('nome', 'asc')->get();

        // Nota: não registamos atividades de listagem para evitar ruído na timeline

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

        // Registar atividade de visualização (não bloqueia se falhar)
        try {
            AtividadeService::registarVisualizacao('Fornecedor', $fornecedor);
        } catch (\Exception $e) {
            Log::error('Erro ao registar atividade de visualização: ' . $e->getMessage());
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

        // Registar atividade de criação (não bloqueia se falhar)
        try {
            AtividadeService::registarCriacao('Fornecedor', $fornecedor);
        } catch (\Exception $e) {
            Log::error('Erro ao registar atividade de criação: ' . $e->getMessage());
        }

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

        // Capturar mudanças antes da atualização
        $dadosOriginais = $fornecedor->getOriginal();
        $dadosNovos = $request->all();
        $mudancas = [];

        foreach ($dadosNovos as $campo => $valorNovo) {
            $valorAntigo = $dadosOriginais[$campo] ?? null;
            if ($valorAntigo != $valorNovo) {
                $mudancas[$campo] = [
                    'antigo' => $valorAntigo,
                    'novo' => $valorNovo
                ];
            }
        }

        $fornecedor->update($request->all());

        // Registar atividade de atualização com as mudanças (não bloqueia se falhar)
        if (!empty($mudancas)) {
            try {
                AtividadeService::registarAtualizacao('Fornecedor', $fornecedor, $mudancas);
            } catch (\Exception $e) {
                Log::error('Erro ao registar atividade de atualização: ' . $e->getMessage());
            }
        }

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

        // Registar atividade de exclusão antes de deletar (não bloqueia se falhar)
        try {
            AtividadeService::registarExclusao('Fornecedor', $fornecedor);
        } catch (\Exception $e) {
            Log::error('Erro ao registar atividade de exclusão: ' . $e->getMessage());
        }

        $fornecedor->delete();

        return response()->json(['message' => 'Fornecedor excluído com sucesso']);
    }

    /**
     * Retorna o histórico de atividades de um fornecedor.
     *
     * @author Augusto Kussema
     * @created 2025-11-26
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function historico($id)
    {
        $fornecedor = Fornecedor::find($id);

        if (!$fornecedor) {
            return response()->json(['message' => 'Fornecedor não encontrado'], 404);
        }

        // Buscar atividades relacionadas a este fornecedor
        $atividades = Atividade::where('model_type', Fornecedor::class)
            ->where('model_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['data' => $atividades]);
    }
}
