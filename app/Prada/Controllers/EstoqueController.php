<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    AreaHospitalar as AH,
    Estoque,
    ConfirmarBaixa,
    Farmacia,
    FarmaciaAreaHospitalar as FAH,
    SaldoEstoque as SE,
    ProdutoEstoque as PE,
    RelatorioEstoqueAlerta as REA,
    UserAreaHospitalar as UAH
};
use Yajra\DataTables\DataTables;
use App\Traits\{AtividadeTrait, GenerateTrait};
use Carbon\Carbon;

class EstoqueController extends Controller
{
    use AtividadeTrait, GenerateTrait;

    private $estoque = null;

    public function index()
    {
        $ah = AH::all();
        $estoque = "";

        if (!auth()->user()->isFarmacia and auth()->user()->area_hospitalar->area_hospitalar_id) {
            $area_hospitalar_id = auth()->user()->area_hospitalar->area_hospitalar_id;
            $farmacia_id = @auth()->user()->isFarmacia->farmacia->id;

            $estoque = Estoque::where('area_hospitalar_id', $area_hospitalar_id)
                ->orderBy('produto_estoque_id')
                ->get();

            self::calcNivelAlerta();
            $ah = auth()->user()->area_hospitalar->area_hospitalar;
            $area_id = auth()->user()->area_hospitalar->area_hospitalar->id;
            return view('estoque.show', compact('estoque', 'ah', 'area_id'));
        }

        return view('estoque.panel');
    }

    public function getEstoque(Request $request, $id)
    {
        $ah = AH::find($id);
        $area_id = $id;
        $non_ = true;
        if (!$ah)
            return redirect()->back()->with('warning', 'Algo deu errado e não podemos acessar esta página.');

        $area_hospitalar_id = $area_id;
        $farmacia_id = auth()->user()->isFarmacia->farmacia->id;

        $estoque = Estoque::where('area_hospitalar_id', $area_hospitalar_id)
            ->where('farmacia_id', auth()->user()->isFarmacia->farmacia->id)
            ->orderBy('produto_estoque_id')
            ->get();

        /*$estoque = Estoque::join('produto_estoques', 'estoques.produto_estoque_id', '=', 'produto_estoques.id')
            ->select('estoques.*')
            ->where('estoques.area_hospitalar_id', $id)
            ->orderBy('produto_estoques.designacao', 'asc')
            ->get();*/

        self::calcNivelAlerta();
        return view('estoque.show', compact('estoque', 'non_', 'area_id', 'ah'));
    }

    public function getListHome()
    {
        if (!auth()->user()->isFarmacia)
            return redirect()->route('home')->with('error', 'Não podes aceder esta página.');

        $all_areas = FAH::with('area_hospitalar')->where('farmacia_id', auth()->user()->isFarmacia->farmacia_id)->get();

        return view('estoque.panel', compact('all_areas'));
    }

    public function ajaxEstoque()
    {
        $estoque = Estoque::with('produto.saldo', 'produto.grupo_farmaco')->get();

        return DataTables::of($estoque)
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" class="checkbox-input" id="checkbox' . $row->id . '">';
            })
            ->addColumn('acoes', function ($row) {
                // Adicione aqui o HTML para as ações
                return '<div class="d-flex align-items-center list-action">
                            <!-- Suas ações aqui -->
                        </div>';
            })
            ->rawColumns(['checkbox', 'acoes'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $request->validate([
            'designacao' => 'required',
            'dosagem' => 'nullable',
            'forma' => 'required',
            'tipo' => 'required',
            'farmacia_id' => 'required',
            'descritivo' => 'required',
            'qtd_total' => 'required',
            'origem_destino' => 'required',
            'num_lote' => 'required|unique:produto_estoques,num_lote',
            'data_producao' => 'required|date|before:today', // Verifica se a data de produção é anterior à data atual
            'data_expiracao' => 'required|date|after_or_equal:' . now()->addMonths(4), // Verifica se a data de expiração é pelo menos 10 meses após a data atual
            'num_documento' => 'required|unique:produto_estoques,num_documento',
            'qtd_embalagem' => 'nullable|integer|min:1',
            'grupo_farmaco_id' => 'required|exists:grupo_farmacologicos,id',
            'obs' => 'nullable',
            'qtd' => 'integer|nullable',
        ], [
            'designacao.required' => 'A designação é obrigatória.',
            'farmacia_id.required' => 'Algo correu mal, atualize a página e tente novamente.',
            'dosagem.required' => 'A dosagem é obrigatória.',
            'forma.required' => 'A forma é obrigatória.',
            'tipo.required' => 'Selecione um tipo.',
            'origem_destino.required' => 'A origem ou destino é obrigatório.',
            'num_lote.required' => 'O número do lote é obrigatório.',
            'data_expiracao.required' => 'A data de caducidade é obrigatória.',
            'data_expiracao.date' => 'A data de caducidade deve ser uma data válida.',
            'data_producao.required' => 'A data de produção é obrigatória.',
            'data_producao.date' => 'A data de produção deve ser uma data válida.',
            'data_producao.before' => 'A data de produção deve ser anterior à data atual.',
            'data_expiracao.after_or_equal' => 'A data de caducidade deve ser pelo menos 4 meses após a data atual.',
            'num_documento.required' => 'O número do documento é obrigatório.',
            'num_documento.unique' => 'Já existe um item com este número de produto.',
            'qtd_total.required' => 'Preencha o descritivo.',
            'qtd_embalagem.required' => 'A quantidade por embalagem é obrigatória.',
            'qtd_embalagem.integer' => 'A quantidade por embalagem deve ser um número inteiro.',
            'qtd_embalagem.min' => 'A quantidade por embalagem deve ser pelo menos 1.',
        ]);

        $farmacia_id = $request->farmacia_id;

        if ($request->tipo == 'medicamento' and !$request->dosagem)
            return response()->json(['message' => "Um medicamento deve ter uma dosagem"], 401);

        $dadosPE = [
            'designacao' => $request->designacao,
            'dosagem' => ($request->dosagem ? $request->dosagem : ''),
            'tipo' => $request->tipo,
            'descritivo' => $request->descritivo,
            'forma' => $request->forma,
            'confirmado' => 1,
            'origem_destino' => $request->origem_destino,
            'num_lote' => $request->num_lote,
            'data_expiracao' => $request->data_expiracao,
            'data_producao' => $request->data_producao,
            'num_documento' => $request->num_documento,
            'obs' => $request->obs,
            'qtd_embalagem' => ($request->qtd_embalagem ? $request->qtd_embalagem : null),
            'grupo_farmaco_id' => $request->grupo_farmaco_id
        ];

        $tipo = $request->tipo;
        $pe = PE::create($dadosPE);
        $qtd = $request->qtd_total;

        SE::create([
            'produto_estoque_id' => $pe->id,
            'qtd' => $qtd
        ]);

        Estoque::create([
            'produto_estoque_id' => $pe->id,
            'farmacia_id' => $farmacia_id,
            'area_hospitalar_id' => $request->area_id
        ]);

        $caixas = getCaixa($request->descritivo);

        self::startAtv("Adicionou cerca de {$caixas} caixas equivalente {$request->qtd_total} unidades de {$request->designacao}");

        return response()->json(['message' => "{$request->designacao} adicionado!"]);
    }

    public function confirmarProduto($id_produto, $id_area) {
        $pe = PE::find($id_produto);
        if (!$pe) {
            return redirect()->back()->with('error', "Algo deu errado");
        }

        $cb = ConfirmarBaixa::where('produto_estoque_id', $id_produto)
            ->where('area_hospitalar_para', $id_area)
            ->first();

        if (!$cb)
            return redirect()->back()->with('error', 'Ocorreu um erro');

        $cb->update([
            'confirmado' => 1
        ]);

        $pe->update([
            'confirmado' => 1,
        ]);

        $qw = ConfirmarBaixa::create([
            'area_hospitalar_de' => $id_area,
            'area_hospitalar_para' => $cb->area_hospitalar_de,
            'texto' => auth()->user()->nome. " confirmou o estoque",
            'produto_estoque_id' => $id_produto
        ]);

        return redirect()->back()->with('info', 'Estoque confirmado');
    }

    public function getProduto($id)
    {
        $prod = PE::with('saldo')->where('id', $id)->first();

        return $prod;
    }

    public function editarProduto(Request $request, $id)
    {
        $prod = PE::find($id);

        if (!$prod) {
            if ($request->ajax()) {
                return response()->json(['message' => "Desculpe, parece que esse produto não existe!"]);
            }

            return redirect()->back()->with('error', "Desculpe, parece que esse produto não existe!");
        }
    }

    public function aa()
    {
        // Texto a ser traduzido
        $texto = "Texto para tradução, sobrinho";

        // Idioma de destino
        $idioma_destino = "en"; // Por exemplo, "en" para inglês

        // URL da API do Google Translate
        $url = "https://translate.google.com/m?sl=auto&tl=$idioma_destino&ie=UTF-8&prev=_m&q=" . urlencode($texto);

        // Faz a requisição HTTP GET
        $traducao_html = file_get_contents($url);

        // Analisa o HTML para extrair a tradução
        $padrao = '/<div class="result-container">(.*?)<\/div>/s';
        preg_match($padrao, $traducao_html, $traducao);

        // var_dump($traducao_html);
        if (isset($traducao[1])) {
            // Imprime a tradução
            echo "Tradução: " . htmlspecialchars_decode($traducao[1]);
        } else {
            echo "Erro ao traduzir o texto.";
        }
    }

    public function baixa(Request $request)
    {
        $request->validate([
            'produto_id' => "required|exists:produto_estoques,id",
            'area_hospitalar_id' => "required|exists:areas_hospitalares,id",
            'qtd' => "required|min:1",
        ], [
            'produto_id.required' => "Selecione um item na tabela",
            'area_hospitalar_id.required' => "Algo deu errado, por favor atualize a página e tente de novo",
            'qtd.required' => "Informe uma quatidade"
        ]);

        $farmacia_id = "";
        if (@auth()->user()->isFarmacia){
            $farmacia_id = auth()->user()->isFarmacia->farmacia->id;
        }elseif(@auth()->user()->farmacia) {
            $farmacia_id = auth()->user()->farmacia->farmacia_id;
        }

        $produto = PE::find($request->produto_id);
        $descritivo = $produto->descritivo;
        $qtdBaixar = $request->qtd;

        $produtoMasDescr = downCaixa($descritivo, $qtdBaixar);

        if ($produtoMasDescr == 0) {
            return response()->json(['message' => "Não restará nada depois desta operação."], 400);
        }

        $newDescritivo = newCaixa($descritivo, $qtdBaixar);
        $newQtdUnit = getCaixaUnit($newDescritivo);
        $antigoQtdUnit = getCaixaUnit($descritivo);

        $saldoRestante = $antigoQtdUnit - $newQtdUnit;

        $qt = $newQtdUnit;

        $area_hospitalar_id = $request->area_hospitalar_id;

        if (!($qt >= 0)) {
            if ($request->ajax()) {
                return response()->json(['message' => 'Deves informar uma quantidade igual ou inferior da existente'], 401);
            }
            return redirect()->back()->with('error', 'Deves informar uma quantidade igual ou inferior da existente');
        }

        $dataProduto = [
            'designacao' => $produto->designacao,
            'dosagem' => $produto->dosagem,
            'forma' => $produto->forma,
            'origem_destino' => $produto->origem_destino,
            'num_lote' => $produto->num_lote,
            'confirmado' => 0,
            'data_expiracao' => $produto->data_expiracao,
            'data_producao' => $produto->data_producao,
            'num_documento' => $produto->num_documento,
            'obs' => $produto->obs,
            'qtd_embalagem' => $produto->qtd_embalagem,
            'grupo_farmaco_id' => $produto->grupo_farmaco_id
        ];

        $isEstoque = Estoque::whereHas('produto', function ($query) use ($dataProduto, $area_hospitalar_id) {
            $query->where('num_lote', $dataProduto['num_lote'])
                ->where('num_documento', $dataProduto['num_documento']);
            })
            ->where('area_hospitalar_id', $area_hospitalar_id)
            ->first();

        if ($isEstoque) {
            $saldoAtual = $isEstoque->produto->saldo;
            $saldoAdd = $newQtdUnit;
            $saldoAtual->update([
                'qtd' => $saldoAtual->qtd + $saldoAdd
            ]);

            $saldoA = $produto->saldo;
        } else {
            $dataProduto['descritivo'] = $newDescritivo;
            $novoProduto = PE::create($dataProduto);
            $saldO = SE::create([
                'produto_estoque_id' => $novoProduto->id,
                'qtd' => $newQtdUnit
            ]);

            $estoque = Estoque::create([
                'produto_estoque_id' => $novoProduto->id,
                'farmacia_id' => $farmacia_id,
                'area_hospitalar_id' => $request->area_hospitalar_id
            ]);
        }
        $produto->update([
            'descritivo' => $produtoMasDescr
        ]);

        $produto->saldo->update([
            'qtd' => $saldoRestante
        ]);

        $ud = UAH::where('area_hospitalar_id', $area_hospitalar_id)
            ->where('farmacia_id', $farmacia_id)
            ->first();

        $caixas = getCaixa($newDescritivo);
        $unit = getCaixaUnit($newDescritivo);

        self::startAtv("Deu baixa de {$caixas} caixas, o equivalente a {$unit} unidades para {$ud->area_hospitalar->nome}");
        self::setNotify("Confirmação de entrada de estoque", $ud->user_id);
        $texto = auth()->user()->nome." deu baixa de {$caixas} caixas de {$request->designacao} equivalente a {$unit} unidades";
        self::confirmarBaixaAlert($texto, $area_hospitalar_id, $produto->id);

        return response()->json(['message' => 'Baixa concluida, a aguardar confirmação.'], 201);
    }

    public function calcularNivelAlerta()
    {
        $hoje = Carbon::now();

        // Define os limites de tempo para cada nível de alerta (em meses)
        $limites = [
            1 => 3, // ID 1 para o nível Critico
            2 => 6, // ID 2 para o nível Minimo
            3 => 10, // ID 3 para o nível Medio
            4 => 12, // ID 4 para o nível Maximo
        ];

        // Obtém todos os produtos
        $produtos = PE::all();

        // Contadores para os níveis de alerta
        $contadores = [
            1 => 3, // ID 1 para o nível Critico
            2 => 6, // ID 2 para o nível Minimo
            3 => 10, // ID 3 para o nível Medio
            4 => 12, // ID 4 para o nível Maximo
        ];

        // Percorre os produtos
        foreach ($produtos as $produto) {
            // Calcula o tempo de expiração do produto em meses
            $tempoExpiracao = Carbon::parse($produto->data_expiracao)->diffInMonths($hoje);

            // Determina o nível de alerta do produto com base no tempo de expiração
            $nivelAlerta = null;
            foreach ($limites as $nivel => $limite) {
                // Se o tempo de expiração for menor ou igual ao limite, define o nível de alerta
                if ($tempoExpiracao <= $limite) {
                    $nivelAlerta = $nivel;
                    break; // Interrompe o loop assim que encontrar o primeiro nível adequado
                }
            }

            // Se o nível de alerta for encontrado
            if ($nivelAlerta !== null) {
                // Atualiza o contador para o nível de alerta atual
                $contadores[$nivelAlerta]++;

                // Verifica se o produto já está na tabela relatorio_estoque_alerta
                $relatorio = REA::where('produto_estoque_id', $produto->id)->first();

                // Obtém a chave do nível de alerta com base no nome do nível
                $nivelAlertaId = array_search($nivelAlerta, array_keys($limites));
                $nivelAlertaId += 1;
                // Atualiza ou cadastra o relatório conforme necessário
                if ($relatorio) {
                    // O produto já está na tabela, então atualiza o nível atual
                    $relatorio->update(['nivel_alerta_id' => $nivelAlertaId]);
                } else {
                    // O produto não está na tabela, então cadastra um novo relatório
                    REA::create([
                        'produto_estoque_id' => $produto->id,
                        'nivel_alerta_id' => $nivelAlertaId
                    ]);
                }
            }
        }

        // Monta o relatório como uma tabela
        $relatorio = '<table border="1">';
        $relatorio .= '<tr><th>Critico</th><th>Minimo</th><th>Medio</th><th>Maximo</th></tr>';
        $relatorio .= '<tr>';
        foreach ($contadores as $nivel => $contagem) {
            $relatorio .= '<td>' . $contagem . '</td>';
        }
        $relatorio .= '</tr>';
        $relatorio .= '</table>';

        // Resumo básico
        $totalProdutos = array_sum($contadores);
        $resumo = "Cerca de $totalProdutos produtos atingiram níveis de alerta.";

        // Adiciona o resumo ao relatório
        $relatorio .= '<p>' . $resumo . '</p>';

        return $relatorio;
    }
}
