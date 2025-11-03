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
use Illuminate\Support\Facades\DB;
use App\Traits\{AtividadeTrait, GenerateTrait};
use Carbon\Carbon;
use App\Models\ProductHistory;

class EstoqueController extends Controller
{
    use AtividadeTrait, GenerateTrait;

    private $estoque = null;

    /**
     * Helper para retornar o usuário autenticado com tipagem para analisadores.
     *
     * @return \App\Models\User|null
     */
    protected function currentUser(): ?\App\Models\User
    {
        return \Illuminate\Support\Facades\Auth::user();
    }

    public function index()
    {
    /** @var \App\Models\User|null $user */
    $user = $this->currentUser();
        $ah = AH::all();
        $estoque = "";


            if (!$user->isFarmacia and ($user->area_hospitalar->area_hospitalar_id ?? false)) {
            $area_hospitalar_id = $user->area_hospitalar->area_hospitalar_id;
            $farmacia_id = $user->isFarmacia->farmacia->id ?? null;

            $estoque = Estoque::where('area_hospitalar_id', $area_hospitalar_id)
                ->orderBy('produto_estoque_id')
                ->get();

            self::calcNivelAlerta();
            $ah = $user->area_hospitalar->area_hospitalar;
            $area_id = $user->area_hospitalar->area_hospitalar->id;
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
            'quantidade' => 'required|integer|min:0',
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
            '*.nullable' => 'O campo :attribute é opcional.',
            'quantidade.integer' => 'A quantidade deve ser um número inteiro.',
            'quantidade.min' => 'A quantidade deve ser no mínimo 0.'
        ]);

        $estoque = PE::findOrFail($id);

        $original = $estoque->getAttributes();

        $estoque->fill([
            'designacao' => $request->input('designacao'),
            'tipo' => $request->input('tipo'),
            'dosagem' => $request->input('dosagem'),
            'quantidade' => $request->input('quantidade'),
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
                'qtd' => $request->input('quantidade')
            ]);
        } else {
            $estoque->saldo()->create([
                'qtd' => $request->input('quantidade')
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

    // Registrar atividade: listar campos que mudaram
        try {
            $changes = [];
            $new = $estoque->getAttributes();
            foreach ($new as $key => $value) {
                if (array_key_exists($key, $original) && $original[$key] != $value) {
                    $changes[] = $key;
                }
            }

                if (!empty($changes)) {
                // Mapeamento de nomes técnicos para rótulos amigáveis (Português)
                $fieldNames = [
                    'designacao' => 'Designação',
                    'tipo' => 'Tipo',
                    'dosagem' => 'Dosagem',
                    'descritivo' => 'Descritivo',
                    'num_lote' => 'Lote',
                    'num_documento' => 'Documento Nº',
                    'data_producao' => 'Data Produção',
                    'data_expiracao' => 'Data Expiração',
                    'data_recepcao' => 'Data Recepção',
                    'forma' => 'Forma',
                    'grupo_farmaco_id' => 'Grupo Farmacológico',
                    'origem_destino' => 'Origem / Destino',
                    'obs' => 'Observação',
                    'prateleira_id' => 'Prateleira',
                    'qtd_embalagem' => 'Quantidade por Embalagem',
                    // campos relacionados a relações/tabelas auxiliares
                    'saldo' => 'Saldo',
                    'prateleira' => 'Prateleira',
                    'updated_at' => 'Data de Actualização',
                    'created_at' => 'Data de Criação',
                ];

                $namedChanges = array_map(function ($key) use ($fieldNames) {
                    return $fieldNames[$key] ?? ucwords(str_replace('_', ' ', $key));
                }, $changes);

                $fields = implode(', ', $namedChanges);

                // Estrutura de changes com old/new
                $structuredChanges = [];
                foreach ($changes as $key) {
                    $structuredChanges[$key] = [
                        'old' => $original[$key] ?? null,
                        'new' => $new[$key] ?? null,
                    ];
                }

                $meta = [
                    'model_type' => PE::class,
                    'model_id' => $estoque->id,
                    'ip_address' => request()->ip(),
                    'route' => request()->path(),
                    'http_method' => request()->method(),
                    'level' => 'info',
                    'correlation_id' => request()->header('X-Request-Id') ?: null,
                ];

                self::startAtv("Editou produto {$estoque->designacao} - Campos alterados: {$fields}", $structuredChanges, $meta);
                // Observador do modelo irá registar o histórico (evita duplicação)
            } else {
                $meta = [
                    'model_type' => PE::class,
                    'model_id' => $estoque->id,
                    'ip_address' => request()->ip(),
                    'route' => request()->path(),
                    'http_method' => request()->method(),
                    'level' => 'info',
                ];
                self::startAtv("Acessou edição do produto {$estoque->designacao} sem alterações de dados", null, $meta);
            }
        } catch (\Throwable $e) {
            logger()->error('Falha ao registar atividade de edição de produto: ' . $e->getMessage());
        }

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
    $farmacia_id = $this->currentUser()->isFarmacia->farmacia->id ?? $this->currentUser()->farmacia->farmacia->id;

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
    $farmacia_id = $this->currentUser()->isFarmacia->farmacia->id ?? $this->currentUser()->farmacia->farmacia->id;
        $isPerm = vPerm('area_hospitalar', ['ver']);

        // Atualizar todas as entradas no campo 'forma' de 'produto_estoques'
        PE::whereRaw("LOWER(forma) = 'injeções'")->update([
            'forma' => 'Injectável',
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

        $myAreaId = @($this->currentUser()->area_hospitalar->area_hospitalar->id ?? null);
        if (!$isPerm and !$this->currentUser()->isFarmacia and ($myAreaId != $id)) {
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
        //$farmacia_id = $this->currentUser()->isFarmacia->farmacia->id ?? $this->currentUser()->farmacia->farmacia->id;
        $farmacia_id = "11a2d86a-c885-44e4-9162-14215ef75b95";
        $produtos = Estoque::where('area_hospitalar_id', $id)
            ->where('farmacia_id', $farmacia_id)
            ->with('produto.prateleira')
            ->with('produto.status_stock')
            ->with('produto.saldo')
            ->with(['produto' => function ($query) {
                $query->orderBy('designacao', 'ASC');
            }])
            ->get();

        return response()->json(["data" => $produtos]);
    }

    public function destroy(Request $request, $id)
    {
        // Busca o produto pelo ID
        $produto = PE::find($id);

        if (!$produto) {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }

        // Remover o produto — o observer ProdutoEstoqueObserver irá registar o evento 'deleted'
        $produto->delete();

        return response()->json(['message' => 'Produto excluído com sucesso']);
    }

    public function getListHome()
    {
        if (!$this->currentUser()->isFarmacia)
            return redirect()->route('home')->with('error', 'Não podes aceder esta página.');

        $all_areas = FAH::with('area_hospitalar')->where('farmacia_id', $this->currentUser()->isFarmacia->farmacia_id)->get();

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
            'prateleira_id' => 'nullable|exists:prateleiras,id',
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

        $meta = [
            'model_type' => PE::class,
            'model_id' => $pe->id,
            'ip_address' => request()->ip(),
            'route' => request()->path(),
            'http_method' => request()->method(),
            'level' => 'info',
            'snapshot_after' => $pe->toArray(),
        ];
    // Garante que gravamos um snapshot do recurso adicionado
    self::startAtv("Adicionou cerca de {$caixas} caixas equivalente {$request->qtd_total} unidades de {$request->designacao}", null, $meta);

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
            'texto' => ($this->currentUser()->nome ?? null) . " confirmou o estoque",
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
                'user_de' => $this->currentUser()->id ?? null,
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

    /**
     * Adiciona unidades a um produto existente via AJAX.
     * Agora usa campo `quantidade` diretamente em vez de calcular do descritivo.
     * Inputs esperados: produto_id, quantidade
     * Retorna JSON { message, quantidade }
     */
    public function adicionar(Request $request)
    {
    /** @var \App\Models\User|null $user */
    $user = $this->currentUser();
        // Validação dos campos esperados da modal
        $request->validate([
            'produto_id' => 'required|exists:produto_estoques,id',
            'quantidade' => 'required|integer|min:1',
            'num_lote' => 'nullable|string',
            'fornecedor' => 'nullable|string',
            'obs' => 'nullable|string',
            'area_hospitalar_id' => 'nullable|exists:areas_hospitalares,id',
        ]);

        // informações do produto original (para copiar metadados)
        $produtoOrig = PE::find($request->produto_id);
        if (!$produtoOrig) {
            return response()->json(['message' => 'Produto origem não encontrado'], 404);
        }

        $quantidade = intval($request->quantidade);

        // Determinar area hospitalar: preferir valor vindo do request, senão usar area do user;
        // se nenhuma estiver disponível, retornamos erro 422 para que frontend peça seleção.
        $area_id = $request->input('area_hospitalar_id');
        if (!$area_id) {
            $userAh = $user->area_hospitalar ?? null;
            if ($userAh && isset($userAh->area_hospitalar_id)) {
                $area_id = $userAh->area_hospitalar_id;
            } else {
                return response()->json(['message' => 'Área hospitalar não informada. Selecione a área antes de adicionar entrada.'], 422);
            }
        }

        // Monta os dados do novo ProdutoEstoque (copiando meta do original)
        $dadosPE = [
            'designacao' => $produtoOrig->designacao,
            'dosagem' => $produtoOrig->dosagem,
            'tipo' => $produtoOrig->tipo,
            'descritivo' => $produtoOrig->descritivo, // mantém descritivo original
            'quantidade' => $quantidade,
            'forma' => $produtoOrig->forma,
            'confirmado' => 1,
            'origem_destino' => $produtoOrig->origem_destino,
            'num_lote' => $request->num_lote ?? $produtoOrig->num_lote,
            'data_expiracao' => $produtoOrig->data_expiracao,
            'data_producao' => $produtoOrig->data_producao,
            'num_documento' => $produtoOrig->num_documento,
            'obs' => $request->obs ?? $produtoOrig->obs,
            'qtd_embalagem' => $produtoOrig->qtd_embalagem,
            'grupo_farmaco_id' => $produtoOrig->grupo_farmaco_id,
            'prateleira_id' => $produtoOrig->prateleira_id,
        ];

        // Criar novo ProdutoEstoque com o valor direto de quantidade
        DB::beginTransaction();
        try {
            $novoPE = PE::create($dadosPE);

            // Cria saldo com quantidade informada
            SE::create([
                'produto_estoque_id' => $novoPE->id,
                'qtd' => $quantidade
            ]);

            // Determinar farmacia/area do usuário atual (mesma lógica do store)
            $farmacia_id = '';
            if ($user->isFarmacia) {
                $farmacia_id = $user->isFarmacia->farmacia->id;
            } elseif ($user->farmacia) {
                $farmacia_id = $user->farmacia->farmacia_id;
            }

            // Cria registro na tabela Estoque associando a area/farmacia
            Estoque::create([
                'produto_estoque_id' => $novoPE->id,
                'farmacia_id' => $farmacia_id,
                'area_hospitalar_id' => $area_id
            ]);

            $meta = [
                'model_type' => PE::class,
                'model_id' => $novoPE->id,
                'ip_address' => request()->ip(),
                'route' => request()->path(),
                'http_method' => request()->method(),
                'level' => 'info',
                'snapshot_after' => $novoPE->toArray(),
            ];
            self::startAtv("Adicionou entrada de estoque ({$quantidade} unidades) para {$novoPE->designacao}", null, $meta);

            DB::commit();

            return response()->json([
                'message' => "{$quantidade} unidades registadas com sucesso",
                'quantidade' => $novoPE->quantidade
            ], 201);
        } catch (\Throwable $e) {
            DB::rollBack();
            logger()->error('Falha ao adicionar estoque: ' . $e->getMessage());
            return response()->json(['message' => 'Erro ao processar pedido'], 500);
        }
    }

    public function baixa(Request $request)
    {
    /** @var \App\Models\User|null $user */
    $user = $this->currentUser();
        $request->validate([
            'produto_id' => "required|exists:produto_estoques,id",
            'area_hospitalar_id' => "required|exists:areas_hospitalares,id",
            'quantidade' => "required|integer|min:1",
            'movement_date' => 'nullable|date',
        ], [
            'produto_id.required' => "Selecione um item na tabela",
            'area_hospitalar_id.required' => "Algo deu errado, por favor atualize a página e tente de novo",
            'quantidade.required' => "Informe uma quantidade"
        ]);

        $farmacia_id = "";
        if ($user->isFarmacia) {
            $farmacia_id = $user->isFarmacia->farmacia->id;
        } elseif ($user->farmacia) {
            $farmacia_id = $user->farmacia->farmacia_id;
        }

        $produto = PE::find($request->produto_id);
        $quantidadeBaixar = intval($request->quantidade);

        // Interpretar movement_date (opcional) vindo do formulário (datetime-local do browser)
        $movementDate = null;
        if ($request->filled('movement_date')) {
            try {
                $movementDate = Carbon::parse($request->input('movement_date'));
            } catch (\Throwable $e) {
                $movementDate = null;
            }
        }

        // Validar se tem quantidade suficiente no saldo
        $saldoProduto = $produto->saldo;
        $saldoAtual = $saldoProduto ? $saldoProduto->qtd : 0;

        if ($quantidadeBaixar > $saldoAtual) {
            if ($request->ajax()) {
                return response()->json(['message' => 'Quantidade insuficiente em estoque'], 400);
            }
            return redirect()->back()->with('error', 'Quantidade insuficiente em estoque');
        }

        $saldoRestante = $saldoAtual - $quantidadeBaixar;
        $area_hospitalar_id = $request->area_hospitalar_id;

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

        // Determinar se a área de destino guarda estoque (log_estoque)
        $farmacia_id = '';
        if ($user && $user->isFarmacia) {
            $farmacia_id = $user->isFarmacia->farmacia->id ?? '';
        } elseif ($user && $user->farmacia) {
            $farmacia_id = $user->farmacia->farmacia_id ?? '';
        }

        $destFAH = null;
        $persistDest = true; // por padrão, persiste
        if ($farmacia_id) {
            $destFAH = FAH::where('farmacia_id', $farmacia_id)
                ->where('area_hospitalar_id', $area_hospitalar_id)
                ->first();
            if ($destFAH && intval($destFAH->log_estoque) === 0) {
                $persistDest = false;
            }
        }

        if ($persistDest) {
            if ($isEstoque) {
                $saldoDestino = $isEstoque->produto->saldo;
                $saldoDestino->update([
                    'qtd' => $saldoDestino->qtd + $quantidadeBaixar
                ]);

                // Atualizar quantidade do produto destino
                $isEstoque->produto->update([
                    'quantidade' => $isEstoque->produto->quantidade + $quantidadeBaixar
                ]);

                // registrar histórico: entrada no estoque destino (stock_in)
                try {
                    ProductHistory::create([
                        'product_id' => $isEstoque->produto->id,
                        'farmacia_id' => $farmacia_id,
                        'user_id' => $user->id ?? null,
                        'action' => 'stock_in',
                        'changes' => null,
                        'payload' => ['from_product_id' => $produto->id, 'num_lote' => $isEstoque->produto->num_lote],
                        'ip_address' => request()->ip(),
                        'user_agent' => request()->header('User-Agent'),
                        'meta' => ['area_hospitalar_id' => $area_hospitalar_id],
                        'movement_date' => $movementDate,
                        'quantity_delta' => $quantidadeBaixar,
                    ]);
                } catch (\Throwable $e) {
                    logger()->error('Falha ao registar product_history stock_in: ' . $e->getMessage());
                }
            } else {
                $dataProduto['descritivo'] = $produto->descritivo; // mantém descritivo original
                $dataProduto['quantidade'] = $quantidadeBaixar;
                $novoProduto = PE::create($dataProduto);

                SE::create([
                    'produto_estoque_id' => $novoProduto->id,
                    'qtd' => $quantidadeBaixar
                ]);

                Estoque::create([
                    'produto_estoque_id' => $novoProduto->id,
                    'farmacia_id' => $farmacia_id,
                    'area_hospitalar_id' => $request->area_hospitalar_id
                ]);
            }
        } else {
            // A área de destino NÃO guarda estoque. Não persistimos entradas de estoque.
            // Registramos apenas um histórico que indica a tentativa de transferência sem persistência.
            try {
                ProductHistory::create([
                    'product_id' => null,
                    'farmacia_id' => $farmacia_id,
                    'user_id' => $user->id ?? null,
                    'action' => 'stock_in_attempt_no_persist',
                    'changes' => null,
                    'payload' => ['from_product_id' => $produto->id, 'num_lote' => $dataProduto['num_lote']],
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->header('User-Agent'),
                        'meta' => ['area_hospitalar_id' => $area_hospitalar_id, 'no_persist' => true],
                        'movement_date' => $movementDate,
                        'quantity_delta' => $quantidadeBaixar,
                ]);
            } catch (\Throwable $e) {
                logger()->error('Falha ao registar product_history (no persist): ' . $e->getMessage());
            }
        }

        // Atualizar produto origem: reduzir quantidade e saldo
        $produto->update([
            'quantidade' => $produto->quantidade - $quantidadeBaixar
        ]);

        $produto->saldo->update([
            'qtd' => $saldoRestante
        ]);

        // registrar histórico: saida do produto original (stock_out)
        try {
                ProductHistory::create([
                'product_id' => $produto->id,
                'farmacia_id' => $farmacia_id,
                'user_id' => $user->id ?? null,
                'action' => 'stock_out',
                'changes' => null,
                'payload' => ['to_area' => $area_hospitalar_id, 'num_lote' => $produto->num_lote],
                'ip_address' => request()->ip(),
                'user_agent' => request()->header('User-Agent'),
                'meta' => ['saldo_before' => $saldoAtual, 'saldo_after' => $saldoRestante],
                'movement_date' => $movementDate,
                'quantity_delta' => -1 * $quantidadeBaixar,
            ]);
        } catch (\Throwable $e) {
            logger()->error('Falha ao registar product_history stock_out: ' . $e->getMessage());
        }

        $ud = UAH::where('area_hospitalar_id', $area_hospitalar_id)
            ->where('farmacia_id', $farmacia_id)
            ->first();

        $meta = [
            'model_type' => PE::class,
            'model_id' => $produto->id,
            'ip_address' => request()->ip(),
            'route' => request()->path(),
            'http_method' => request()->method(),
            'level' => 'info',
            'snapshot_before' => $produto->toArray(),
        ];

        // Determinar nome da área de destino
        $destName = 'Área destinatária';
        try {
            // preferir UAH->area_hospitalar quando disponível
            if ($ud && isset($ud->area_hospitalar) && $ud->area_hospitalar) {
                $destName = $ud->area_hospitalar->nome ?? $destName;
            } else {
                $dest = AH::find($area_hospitalar_id);
                if ($dest && isset($dest->nome)) $destName = $dest->nome;
            }
        } catch (\Throwable $_) {
            // ignore
        }

        $udUserId = $ud->user_id ?? null;

        self::startAtv("Deu baixa de {$quantidadeBaixar} unidades de {$dataProduto['designacao']} para {$destName}", null, $meta);
        if ($udUserId) {
            self::setNotify("Confirmação de entrada de estoque", $udUserId);
        }

        $texto = ($this->currentUser()->nome ?? '') . " deu baixa de {$quantidadeBaixar} unidades de {$dataProduto['designacao']} para {$destName}";
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

    /**
     * Sincroniza o campo `quantidade` a partir do `descritivo` (ex: 2x10x5 => 100)
     *
     * @author Augusto Kussema
     * @date 2025-11-03 15:45 (Luanda time)
     *
     * Calcula o total multiplicando os valores do descritivo e grava em `quantidade`
     *
     * @param Request $request (produto_id required)
     * @return \Illuminate\Http\JsonResponse
     */
    public function sincronizar(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produto_estoques,id',
        ]);

        $produto = PE::find($request->produto_id);
        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        $descritivo = $produto->descritivo ?? '';
        $des = str_replace(['X', ' '], ['x', ''], trim($descritivo));
        $parts = array_filter(explode('x', $des), function($v) { return $v !== ''; });
        $values = array_map(function($v) { return intval(preg_replace('/[^0-9]/', '', $v)); }, array_values($parts));

        $total = 0;
        if (count($values) >= 3) {
            $total = intval($values[0]) * intval($values[1]) * intval($values[2]);
        } else {
            $total = 1;
            foreach ($values as $val) $total *= max(0, intval($val));
            if (count($values) === 0) $total = 0;
        }

        $produto->quantidade = $total;
        $produto->save();

        try {
            $meta = [
                'model_type' => PE::class,
                'model_id' => $produto->id,
                'ip_address' => request()->ip(),
                'route' => request()->path(),
                'http_method' => request()->method(),
                'level' => 'info',
                'snapshot_after' => $produto->toArray(),
            ];
            self::startAtv("Sincronizou quantidade do produto {$produto->designacao} para {$total}", null, $meta);
        } catch (\Throwable $_) {}

        return response()->json([
            'message' => 'Quantidade sincronizada',
            'produto_id' => $produto->id,
            'quantidade' => $produto->quantidade
        ], 200);
    }
}
