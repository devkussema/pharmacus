<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use App\Models\{
    NivelAlerta as NA,
    RelatorioEstoqueAlerta as REA
};
use App\Traits\{AtividadeTrait, GenerateTrait};
use Illuminate\Http\Request;

use App\Models\ProdutoEstoque;
use App\Models\AreaHospitalar;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EstoqueExport;

class NivelAlertaController extends Controller
{
    use GenerateTrait;

    public function index()
    {
        $niveis = REA::all();
        self::calcNivelAlerta();
        return view('niveis_alerta.show', compact('niveis'));
    }

    public function gerarRelatorio(Request $request)
    {
        $area_hospitalar_id = 6;
//        $produtos = \App\Models\ProdutoEstoque::whereHas('estoque', function ($query) use ($area_hospitalar_id) {
//            $query->where('area_hospitalar_id', $area_hospitalar_id);
//        })
//            ->whereRaw("CAST(SUBSTRING_INDEX(descritivo, 'x', 1) AS UNSIGNED) <= ?", [$request->qtd_maxima_caixa])
//            ->select('id', 'designacao', 'descritivo')
//            ->with('estoque')
//            ->orderBy('designacao', 'asc')
//            ->get();

        $produtos = \App\Models\Estoque::with('produto')
            ->where('area_hospitalar_id', 6)
            ->whereHas('produto', function ($query) use ($request) {
                $query->whereRaw("CAST(SUBSTRING_INDEX(descritivo, 'x', 1) AS UNSIGNED) <= ?", 5);
            })
            ->get();

        //echo $product->count();

        //return view('niveis_alerta.gerarRelatorio');
        return view('doc_generate.relatorio', compact('produtos'));
    }

    public function gerarRelatorioPost(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'tipo_relatorio' => 'required|string',
            'area_hospitalar' => 'required|integer',
            'forma_farmaceutica' => 'nullable|string',
            'qtd_maxima_caixa' => 'nullable|integer|min:1',
            'tipo_documento' => 'required|string|in:pdf,word,excel',
            'invalidCheck' => 'accepted',  // Para garantir que o checkbox está marcado
        ]);

        echo "Ok"; exit;

        // Consulta de acordo com os filtros
        $produtosQuery = ProdutoEstoque::with('estoque')->where('estoque.area_hospitalar_id', $request->area_hospitalar);

        // Filtrar por forma farmacêutica se selecionada
        if ($request->forma_farmaceutica && $request->forma_farmaceutica !== 'tudo') {
            $produtosQuery->where('forma', $request->forma_farmaceutica);
        }

        // Filtrar pela quantidade máxima de caixas se fornecido
        if ($request->qtd_maxima_caixa) {
            $produtosQuery->whereRaw("CAST(SUBSTRING_INDEX(descritivo, 'x', 1) AS UNSIGNED) <= ?", [$request->qtd_maxima_caixa]);
        }

        // Obter os resultados
        $produtos = $produtosQuery->get();

        // Gerar o relatório conforme o tipo de documento escolhido
        /*if ($request->tipo_documento == 'pdf') {
            // Gerar PDF
            $pdf = Pdf::loadView('relatorios.estoque', compact('produtos'));
            return $pdf->download('relatorio_estoque.pdf');
        }

        if ($request->tipo_documento == 'excel') {
            // Gerar Excel
            return Excel::download(new EstoqueExport($produtos), 'relatorio_estoque.xlsx');
        }

        if ($request->tipo_documento == 'word') {
            // Gerar Word [Implementação futura]
            return response()->json(['message' => 'Relatório Word em breve']);
        } */

        //return redirect()->back()->with('error', 'Formato de documento inválido.');
        return view('doc_generate.relatorio', compact('produtos'));
    }
}
