<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\{
    AreaHospitalar as AH,
    Estoque,
    PedidoItem,
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

    public function edit(Request $request, $id, $returnIDr)
    {
        $pe = PE::find($id);
        $returnID = $returnIDr;
        return view('estoque.edit', compact('pe', 'returnID'));
    }

    public function update(Request $request, $id, $returnID)
    {
        // Validar os dados do formulário
        $request->validate([
            'area_id' => 'required',
            'designacao' => 'required',
            'tipo' => 'required',
            'dosagem' => 'nullable',
            'caixa' => 'required',
            'caxinha' => 'required',
            'unidade' => 'required',
            'num_lote' => 'required',
            'num_documento' => 'nullable',
            'data_producao' => 'nullable',
            'data_expiracao' => 'required',
            'forma' => 'required',
            'grupo_farmaco_id' => 'required',
            'origem_destino' => 'nullable',
            'prateleira_id' => 'required'
        ], [
            '*.required' => 'O campo :attribute é obrigatório.',
            '*.nullable' => 'O campo :attribute é opcional.'
        ]);

        $estoque = PE::findOrFail($id);

        $estoque->fill([
            'designacao' => $request->input('designacao'),
            'tipo' => $request->input('tipo'),
            'dosagem' => $request->input('dosagem'),
            'descritivo' => "{$request->input('caixa')}x{$request->input('caxinha')}x{$request->input('unidade')}",
            'num_lote' => $request->input('num_lote'),
            'num_documento' => $request->input('num_documento'),
            'data_producao' => $request->input('data_producao'),
            'data_expiracao' => $request->input('data_expiracao'),
            'data_recepcao' => $request->input('data_recepcao'),
            'forma' => $request->input('forma'),
            'grupo_farmaco_id' => $request->input('grupo_farmaco_id'),
            'origem_destino' => $request->input('origem_destino'),
            'obs' => $request->input('obs'),
            'prateleira_id' => $request->input('prateleira_id'),
        ]);

        if ($estoque->saldo) {
            $estoque->saldo->update([
                'qtd' => $request->input('qtd_total')
            ]);
        } else {
            $estoque->saldo()->create([
                'qtd' => $request->input('qtd_total')
            ]);
        }

        if ($estoque->estoque) {
            $estoque->estoque->update([
                'area_hospitalar_id' => $request->input('area_id')
            ]);
        } else {
            $estoque->estoque()->create([
                'area_hospitalar_id' => $request->input('area_id')
            ]);
        }
        $estoque->save();

        // Redirecionar de volta com uma mensagem de sucesso
        return redirect()->route('estoque.getEstoque', ['id' => $returnID])->with('success', 'Produto de estoque atualizado com sucesso.');
    }

    public function solicitar(Request $request, $area_id)
    {
        return view('estoque.solicitar-item', ['area' => $area_id]);
    }

    public function cadastrar(Request $request, $area_id)
    {
        return view('estoque.adicionar-item', ['area' => $area_id]);
    }

    public function myEstoque(Request $request, $id)
    {
        $farmacia_id = auth()->user()->isFarmacia->farmacia->id ?? auth()->user()->farmacia->farmacia->id;

        $ah = FAH::with('area_hospitalar')
            ->where('area_hospitalar_id', $id)
            ->where('farmacia_id', $farmacia_id)
            ->get();

        if (!$ah) {
            return redirect()->route('home')->with('warning', 'Algo deu errado e não podemos acessar esta página.');
        }

        $estoque = Estoque::where('area_hospitalar_id', $id)
            ->where('farmacia_id', $farmacia_id)
            ->with(['produto' => function ($query) {
                $query->orderBy('designacao', 'ASC');
            }])
            ->get();

        self::calcNivelAlerta();

        return view('estoque.show', [
            'estoque' => $estoque,
            'non_' => true,
            'area_id' => $id,
            'ah' => $ah[0]['area_hospitalar'],
            'isAdm' => $id
        ]);
    }

    public function getEstoque(Request $request, $id)
    {
        $farmacia_id = auth()->user()->isFarmacia->farmacia->id ?? auth()->user()->farmacia->farmacia->id;
        $isPerm = vPerm('area_hospitalar', ['ver']);

        // Atualizar todas as entradas no campo 'forma' de 'produto_estoques'
        PE::whereRaw("LOWER(forma) = 'xarope'")->update([
            'forma' => 'Xaropes',
        ]);

        $ah = FAH::with('area_hospitalar')
            ->where('area_hospitalar_id', $id)
            ->where('farmacia_id', $farmacia_id)
            ->get();

        if (!$ah) {
            return redirect()->route('home')->with('warning', 'Algo deu errado e não podemos acessar esta página.');
        }

        $estoque = Estoque::where('area_hospitalar_id', $id)
            ->where('farmacia_id', $farmacia_id)
            ->with(['produto' => function ($query) {
                $query->orderBy('designacao', 'ASC');
            }])
            ->get();

        // PE::where('forma', 'Pasta')
        //     ->update(['forma' => 'Outros']);

        self::calcNivelAlerta();

        $myAreaId = @auth()->user()->area_hospitalar->area_hospitalar->id;
        if (!$isPerm and !auth()->user()->isFarmacia and ($myAreaId != $id)) {
            return redirect()->route('estoque.myEstoque', ['id' => $myAreaId])->with('danger', 'Não tens permissão para aceder a página pretendida');
        }

        return view('estoque.show', [
            'estoque' => $estoque,
            'non_' => true,
            'area_id' => $id,
            'ah' => @$ah[0]['area_hospitalar'],
            'isAdm' => $id
        ]);
    }

    public function apiEstoque(Request $request, $id)
    {
        $farmacia_id = auth()->user()->isFarmacia->farmacia->id ?? auth()->user()->farmacia->farmacia->id;
        $produtos = Estoque::where('area_hospitalar_id', $id)
            ->where('farmacia_id', $farmacia_id)
            ->with('produto.prateleira')
            ->with('produto.saldo')
            ->with(['produto' => function ($query) {
                $query->orderBy('designacao', 'ASC');
            }])
            ->get();

        return response()->json(["data" => $produtos]);
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
        //dd($request); exit;
        $request->validate([
            'designacao' => 'required',
            'dosagem' => 'nullable',
            'forma' => 'required',
            'tipo' => 'required',
            'farmacia_id' => 'required',
            'caixa' => 'required',
            'caxinha' => 'required',
            'unidade' => 'required',
            'qtd_total' => 'nullable',
            'origem_destino' => 'nullable',
            'num_lote' => 'required',
            'data_producao' => 'nullable|date|before:today', // Verifica se a data de produção é anterior à data atual
            'data_expiracao' => 'required|date|after_or_equal:' . now()->addMonths(4), // Verifica se a data de expiração é pelo menos 10 meses após a data atual
            'data_recepcao' => 'nullable|date|before:today',
            'num_documento' => 'nullable',
            'qtd_embalagem' => 'nullable|integer|min:1',
            'grupo_farmaco_id' => 'required|exists:grupo_farmacologicos,id',
            'obs' => 'nullable',
            'qtd' => 'integer|nullable',
            'prateleira_id' => 'required|exists:prateleiras,id',
        ], [
            'designacao.required' => 'A designação é obrigatória.',
            'farmacia_id.required' => 'Algo correu mal, atualize a página e tente novamente.',
            'dosagem.required' => 'A dosagem é obrigatória.',
            'descritivo.required' => 'Informe as quantidades das Caixas, Caixinhas e Unidades.',
            'forma.required' => 'A forma é obrigatória.',
            'tipo.required' => 'Selecione um tipo.',
            'origem_destino.required' => 'A origem ou destino é obrigatório.',
            'num_lote.required' => 'O número do lote é obrigatório.',
            'data_expiracao.required' => 'A data de caducidade é obrigatória.',
            'data_expiracao.date' => 'A data de caducidade deve ser uma data válida.',
            'data_producao.required' => 'A data de produção é obrigatória.',
            'data_producao.date' => 'A data de produção deve ser uma data válida.',
            'data_producao.before' => 'A data de produção deve ser anterior à data atual.',

            'data_recepcao.required' => 'A data de recepção é obrigatória.',
            'data_recepcao.date' => 'A data de recepção deve ser uma data válida.',
            'data_recepcao.before' => 'A data de recepção deve ser anterior à data atual.',

            'data_expiracao.after_or_equal' => 'A data de caducidade deve ser pelo menos 4 meses após a data atual.',
            'num_documento.required' => 'O número do documento é obrigatório.',
            'num_documento.unique' => 'Já existe um item com este número de produto.',
            'qtd_embalagem.required' => 'A quantidade por embalagem é obrigatória.',
            'qtd_embalagem.integer' => 'A quantidade por embalagem deve ser um número inteiro.',
            'qtd_embalagem.min' => 'A quantidade por embalagem deve ser pelo menos 1.',
        ]);

        $caixa = $request->input('caixa');
        $caxinha = $request->input('caxinha');
        $unidade = $request->input('unidade');

        $descritivo_ = $caixa."x".$caxinha."x".$unidade;
        $descritivo = $request->input('descritivo') ?? $descritivo_;

        $farmacia_id = $request->farmacia_id;

        if ($request->tipo == 'medicamento' and !$request->dosagem)
            return response()->json(['message' => "Um medicamento deve ter uma dosagem"], 401);

        $dadosPE = [
            'designacao' => $request->designacao,
            'dosagem' => ($request->dosagem ? $request->dosagem : ''),
            'tipo' => $request->tipo,
            'descritivo' => $descritivo,
            'forma' => $request->forma,
            'confirmado' => 1,
            'origem_destino' => $request->origem_destino,
            'num_lote' => $request->num_lote,
            'data_expiracao' => $request->data_expiracao,
            'data_producao' => $request->data_producao,
            'num_documento' => $request->num_documento,
            'obs' => $request->obs,
            'qtd_embalagem' => ($request->qtd_embalagem ? $request->qtd_embalagem : null),
            'grupo_farmaco_id' => $request->grupo_farmaco_id,
            'prateleira_id' => $request->prateleira_id,
        ];

        $tipo = $request->tipo;
        $pe = PE::create($dadosPE);
        if (!$request->qtd_total) {
            $qtd = intval($caixa) * intval($caxinha) * intval($unidade);
        }else{
            $qtd = $request->qtd_total;
        }

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

        if ($request->ajax())
            return response()->json(['message' => "{$request->designacao} adicionado!"]);
        return redirect()->route("estoque.cadastrar", ['area_id' => $request->area_id])->with("success", "{$caixas} caixas de {$request->designacao} adicionadas.");
    }

    public function confirmarProduto($id_produto, $id_area)
    {
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
            'texto' => auth()->user()->nome . " confirmou o estoque",
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

    public function dar_baixa(Request $request, $area_de)
    {
        $request->validate([
            'itens' => 'required|array|min:1',
            'area_para' => 'required',
            'gastos' => 'nullable',
            'existencia' => 'nullable',
            'qtd_pedida' => 'required',
            'qtd_disponibilizada' => 'nullable',
            'id_user' => 'required|exists:users,id',
        ], [
            'itens.required' => 'Nenhum item selecionado, selecione pelo menos um item',
            'itens.array' => 'Os itens devem estar em formato de array',
            'itens.min' => 'Selecione pelo menos um item',
            'area_para.required' => 'Nenhuma área selecionada, selecione pelo menos uma área',
            'gastos.numeric' => 'O campo "Gastos" deve ser um número',
            'existencia.integer' => 'O campo "Existência" deve ser um número inteiro',
            'qtd_pedida.required' => 'O campo "Quantidade Pedida" é obrigatório',
            'qtd_pedida.integer' => 'O campo "Quantidade Pedida" deve ser um número inteiro',
            'qtd_disponibilizada.integer' => 'O campo "Quantidade Disponibilizada" deve ser um número inteiro',
            'id_user.required' => 'Algo deu errado, atualize a página e tente novamente',
            'id_user.exists' => 'Algo deu errado, atualize a página e tente novamente',
        ]);

        $itensSelecionados = $request->input('itens');

        foreach ($itensSelecionados as $item_id) {
            PedidoItem::create([
                'item_id' => $item_id,
                'user_de' => auth()->user()->id,
                'area_de' => $area_de,
                'area_para' => $request->input('area_para'),
                'confirmado' => 1,
                'gastos' => $request->input('gastos'),
                'existencia' => $request->input('existencia'),
                'qtd_pedida' => $request->input('qtd_pedida'),
                'qtd_disponibilizada' => $request->input('qtd_disponibilizada'),
            ]);
        }

        return redirect()->route('estoque.solicitar', ['id' => $area_de])->with('success', 'Solicitação enviada, quando atendida receberás uma notificação.');
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
        if (@auth()->user()->isFarmacia) {
            $farmacia_id = auth()->user()->isFarmacia->farmacia->id;
        } elseif (@auth()->user()->farmacia) {
            $farmacia_id = auth()->user()->farmacia->farmacia_id;
        }

        $produto = PE::find($request->produto_id);
        $descritivo = $produto->descritivo;
        $qtdBaixar = $request->qtd;

        $produtoMasDescr = downCaixa($descritivo, $qtdBaixar);

        // if ($produtoMasDescr == 0) {
        //     $message = "Não restará nada depois desta operação.";

        //     if (request()->wantsJson()) {
        //         return response()->json(['message' => $message], 400);
        //     } else {
        //         return back()->withErrors(['message' => $message]);
        //     }
        // }


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

        self::startAtv("Deu baixa de {$caixas} caixas, o equivalente a {$unit} unidades de {$dataProduto['designacao']} para {$ud->area_hospitalar->nome}");
        self::setNotify("Confirmação de entrada de estoque", $ud->user_id);
        $texto = auth()->user()->nome . " deu baixa de {$caixas} caixas de {$dataProduto['designacao']} equivalente a {$unit} unidades";
        //self::confirmarBaixaAlert($texto, $area_hospitalar_id, $produto->id);

        // return response()->json(['message' => 'Baixa concluida, a aguardar confirmação.'], 201);
        return redirect()->back()->with('success', 'Baixa concluida.');
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
