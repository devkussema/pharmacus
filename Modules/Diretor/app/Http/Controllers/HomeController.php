<?php

namespace Modules\Diretor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProdutoEstoque;
use App\Models\GrupoFarmacologico;

class HomeController extends Controller
{
    /**
     * Exibe o dashboard do módulo Diretor (lista/principal).
     *
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function index()
    {
        return view('diretor::pages.dashboard');
    }

    /**
     * Busca global no sistema (AJAX).
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @author Augusto Kussema
     * @created 06-11-2025
     */
    public function buscaGlobal(Request $request)
    {
        try {
            $query = $request->get('q', '');
            
            if (strlen($query) < 2) {
                return response()->json([
                    'success' => false,
                    'message' => 'Query muito curta'
                ]);
            }
            
            // Buscar produtos
            $produtos = ProdutoEstoque::with('grupo_farmaco')
                ->whereHas('estoque')
                ->where(function($q) use ($query) {
                    $q->where('designacao', 'LIKE', "%{$query}%")
                      ->orWhere('num_lote', 'LIKE', "%{$query}%")
                      ->orWhere('descritivo', 'LIKE', "%{$query}%");
                })
                ->limit(5)
                ->get()
                ->map(function($p) {
                    return [
                        'id' => $p->id,
                        'designacao' => $p->designacao . ($p->dosagem ? ' ' . $p->dosagem : ''),
                        'categoria' => $p->grupo_farmaco ? $p->grupo_farmaco->nome : 'Sem Categoria',
                        'quantidade' => $p->quantidade ?? 0
                    ];
                });
            
            // Páginas do sistema que correspondem à busca
            $paginas = $this->buscarPaginas($query);
            
            return response()->json([
                'success' => true,
                'produtos' => $produtos,
                'paginas' => $paginas
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro na busca: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Busca páginas do sistema por nome/descrição.
     *
     * @param string $query
     * @return array
     * @author Augusto Kussema
     * @created 06-11-2025
     */
    private function buscarPaginas($query)
    {
        $query = strtolower($query);
        
        $todasPaginas = [
            [
                'nome' => 'Dashboard',
                'descricao' => 'Visão geral do sistema',
                'url' => route('diretor.index'),
                'icon' => 'fa-solid fa-chart-line',
                'keywords' => ['dashboard', 'inicio', 'home', 'visão']
            ],
            [
                'nome' => 'Estoque de Medicamentos',
                'descricao' => 'Gestão de inventário',
                'url' => route('diretor.estoque.index'),
                'icon' => 'fa-solid fa-boxes-stacked',
                'keywords' => ['estoque', 'medicamentos', 'inventario', 'produtos']
            ],
            [
                'nome' => 'Fornecedores',
                'descricao' => 'Gestão de fornecedores',
                'url' => route('diretor.fornecedores.index'),
                'icon' => 'fa-solid fa-truck',
                'keywords' => ['fornecedores', 'suppliers', 'parceiros']
            ],
            [
                'nome' => 'Equipe',
                'descricao' => 'Gestão de funcionários',
                'url' => route('diretor.equipe.index'),
                'icon' => 'fa-solid fa-users',
                'keywords' => ['equipe', 'funcionarios', 'staff', 'colaboradores']
            ],
            [
                'nome' => 'Registro de Atividades',
                'descricao' => 'Histórico de operações',
                'url' => route('diretor.registro-atividades.index'),
                'icon' => 'fa-solid fa-clock-rotate-left',
                'keywords' => ['registro', 'atividades', 'historico', 'logs']
            ],
            [
                'nome' => 'Dispensações',
                'descricao' => 'Controle de dispensações',
                'url' => route('diretor.dispensacoes.index'),
                'icon' => 'fa-solid fa-hand-holding-medical',
                'keywords' => ['dispensacoes', 'distribuicao', 'entrega']
            ],
            [
                'nome' => 'Alertas Críticos',
                'descricao' => 'Alertas do sistema',
                'url' => route('diretor.alertas.index'),
                'icon' => 'fa-solid fa-triangle-exclamation',
                'keywords' => ['alertas', 'avisos', 'notificacoes', 'criticos']
            ],
            [
                'nome' => 'Configurações',
                'descricao' => 'Configurações do sistema',
                'url' => route('diretor.configuracoes'),
                'icon' => 'fa-solid fa-gear',
                'keywords' => ['configuracoes', 'settings', 'opcoes']
            ],
        ];
        
        return collect($todasPaginas)->filter(function($pagina) use ($query) {
            $searchIn = strtolower($pagina['nome'] . ' ' . $pagina['descricao'] . ' ' . implode(' ', $pagina['keywords']));
            return str_contains($searchIn, $query);
        })->values()->take(3)->toArray();
    }

    /**
     * Mostra o formulário para criar um novo recurso.
     *
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function create()
    {
        return view('diretor::pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Exibe um recurso específico.
     *
     * @param mixed $id
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function show($id)
    {
        return view('diretor::pages.show', compact('id'));
    }

    /**
     * Mostra o formulário para editar o recurso.
     *
     * @param mixed $id
     * @author Augusto Kussema
     * @created 05-11-2025
     */
    public function edit($id)
    {
        return view('diretor::pages.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
