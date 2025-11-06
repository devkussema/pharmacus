<?php

namespace Modules\Diretor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controller para gestão de registro de atividades e logs da farmácia hospitalar
 *
 * @author Augusto Kussema
 * @date 2025-11-06
 */
class RegistroAtividadesController extends Controller
{
    /**
     * Lista todas as atividades recentes (dispensações, entradas, movimentações)
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // TODO: Buscar atividades do banco de dados
        return view('diretor::pages.registro-atividades.index');
    }

    /**
     * Exibe detalhes de uma atividade específica
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // TODO: Buscar atividade específica do banco
        return view('diretor::pages.registro-atividades.show', compact('id'));
    }

    /**
     * Retorna lista paginada de atividades via AJAX
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function listar(Request $request)
    {
        try {
            $tipo = $request->input('tipo', '');
            $periodo = $request->input('periodo', 'hoje');
            $funcionario = $request->input('funcionario', '');
            $busca = $request->input('busca', '');
            $pagina = (int) $request->input('pagina', 1);
            $porPagina = 10;

            // TODO: Implementar query real com banco de dados
            // Dados mockup para demonstração
            $atividades = [
                [
                    'id' => 1,
                    'tipo' => 'dispensacao',
                    'titulo' => 'Dispensação de Medicamento',
                    'descricao' => '<strong>Paracetamol 500mg</strong> - 20 unidades dispensadas',
                    'hora' => '14:32',
                    'usuario' => 'Dr. João Silva',
                    'localizacao' => 'Enfermaria 3A',
                ],
                [
                    'id' => 2,
                    'tipo' => 'entrada',
                    'titulo' => 'Entrada de Estoque',
                    'descricao' => '<strong>Ibuprofeno 400mg</strong> - Lote LT2025-089, 500 unidades recebidas',
                    'hora' => '13:15',
                    'usuario' => 'Téc. Maria Santos',
                    'fornecedor' => 'PharmaCorp International',
                ],
                [
                    'id' => 3,
                    'tipo' => 'alerta',
                    'titulo' => 'Alerta de Nível Crítico',
                    'descricao' => '<strong>Amoxicilina 875mg</strong> atingiu nível crítico (8 unidades restantes)',
                    'hora' => '11:45',
                    'status' => 'critical',
                    'status_texto' => 'Reposição Urgente',
                ],
            ];

            return response()->json([
                'success' => true,
                'atividades' => $atividades,
                'temMais' => true,
                'paginaAtual' => $pagina,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar atividades: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Retorna resumo de estatísticas via AJAX
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function resumo()
    {
        try {
            // TODO: Buscar dados reais do banco
            $resumo = [
                'dispensacoes' => 156,
                'entradas' => 12,
                'transferencias' => 8,
                'alertas' => 3,
            ];

            return response()->json([
                'success' => true,
                'resumo' => $resumo,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar resumo: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Retorna lista de funcionários via AJAX
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function funcionarios()
    {
        try {
            // TODO: Buscar funcionários reais do banco
            $funcionarios = [
                ['id' => 1, 'nome' => 'Dr. João Silva'],
                ['id' => 2, 'nome' => 'Téc. Maria Santos'],
                ['id' => 3, 'nome' => 'Aux. Pedro Costa'],
            ];

            return response()->json([
                'success' => true,
                'funcionarios' => $funcionarios,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar funcionários: ' . $e->getMessage(),
            ], 500);
        }
    }
}
