<?php

namespace Modules\Diretor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controlador para gestão de fornecedores do módulo Diretor.
 *
 * @author Augusto Kussema
 * @created 05-11-2025
 */
class FornecedoresController extends Controller
{
    /**
     * Exibe a listagem dos fornecedores.
     *
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function index()
    {
        return view('diretor::pages.fornecedores.index');
    }

    /**
     * Mostra o formulário para criar um novo fornecedor.
     *
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function create()
    {
        return view('diretor::pages.fornecedores.create');
    }

    /**
     * Armazena um novo fornecedor.
     *
     * @param Request $request
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function store(Request $request)
    {
        // TODO: Implementar lógica de armazenamento
        return redirect()->route('diretor.fornecedores.index')
            ->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    /**
     * Exibe um fornecedor específico.
     *
     * @param mixed $id
     * @author Augusto Kussema
     * @created 05-11-2025
     * @updated 08-12-2025 11:47 (Luanda) - Adicionado histórico completo de fornecimentos
     */
    public function show($id)
    {
        $fornecedor = \App\Models\Fornecedor::with([
            'produtos' => function($query) {
                $query->orderBy('created_at', 'desc')->limit(50);
            },
            'produtos.grupo_farmaco',
            'produtos.prateleira'
        ])->findOrFail($id);

        // Buscar atividades relacionadas ao fornecedor
        $atividades = \App\Models\Atividade::where('descricao', 'like', '%fornecedor%')
            ->where('descricao', 'like', '%' . $fornecedor->nome . '%')
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        // Estatísticas do fornecedor
        $totalProdutos = $fornecedor->produtos()->count();
        $totalUnidades = $fornecedor->produtos()->sum('quantidade');
        $produtosRecentes = $fornecedor->produtos()
            ->with('grupo_farmaco')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Histórico formatado para exibição
        $historico = $fornecedor->produtos()->orderBy('created_at', 'desc')->get()->map(function($produto) {
            return [
                'id' => $produto->id,
                'data' => $produto->created_at->format('d M Y'),
                'descricao' => "Forneceu {$produto->quantidade} unidades de {$produto->designacao}",
                'produto' => $produto->designacao,
                'quantidade' => $produto->quantidade,
                'lote' => $produto->num_lote,
                'data_expiracao' => $produto->data_expiracao ? \Carbon\Carbon::parse($produto->data_expiracao)->format('d/m/Y') : '-',
                'status' => 'entregue'
            ];
        });

        return view('diretor::pages.fornecedores.show', compact(
            'fornecedor',
            'totalProdutos',
            'totalUnidades',
            'produtosRecentes',
            'historico',
            'atividades',
            'id'
        ));
    }

    /**
     * Mostra o formulário para editar um fornecedor.
     *
     * @param mixed $id
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function edit($id)
    {
        return view('diretor::pages.fornecedores.edit', compact('id'));
    }

    /**
     * Atualiza um fornecedor específico.
     *
     * @param Request $request
     * @param mixed $id
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function update(Request $request, $id)
    {
        // TODO: Implementar lógica de atualização
        return redirect()->route('diretor.fornecedores.index')
            ->with('success', 'Fornecedor atualizado com sucesso!');
    }

    /**
     * Remove um fornecedor específico.
     *
     * @param mixed $id
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function destroy($id)
    {
        // TODO: Implementar lógica de remoção
        return redirect()->route('diretor.fornecedores.index')
            ->with('success', 'Fornecedor removido com sucesso!');
    }
}
