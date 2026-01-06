<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\{
    AreaHospitalar as AH,
    Atividade,
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
use Illuminate\Support\Facades\Log;
use App\Traits\{AtividadeTrait, GenerateTrait};
use Carbon\Carbon;
use App\Models\ProductHistory;
use App\Observers\ProdutoEstoqueObserver;
use App\Services\AtividadeService;

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

        // Guardar informações antes de eliminar
        $designacao = $produto->designacao;
        $lote = $produto->num_lote;
        $quantidade = $produto->quantidade;

        // Registrar atividade antes de eliminar
        try {
            $meta = [
                'model_type' => PE::class,
                'model_id' => $produto->id,
                'ip_address' => request()->ip(),
                'route' => request()->path(),
                'http_method' => request()->method(),
                'level' => 'warning',
                'snapshot_before' => $produto->toArray(),
            ];
            self::startAtv(
                "Eliminou produto '{$designacao}' (Lote: {$lote}, Qtd: {$quantidade}) do estoque",
                null,
                $meta
            );
        } catch (\Throwable $_) {}

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
        $request->validate([
            'designacao' => 'required',
            'dosagem' => 'nullable',
            'forma' => 'required',
            'tipo' => 'required',
            'farmacia_id' => 'required',
            'quantidade' => 'required|integer|min:1',
            // agora area_id referencia FarmaciaAreaHospitalar
            'area_id' => 'required|exists:farmacia_areas_hospitalares,id',
            'fornecedor_id' => 'required|exists:fornecedores,id',
            'num_lote' => 'nullable',
            'data_producao' => 'nullable|date',
            'data_expiracao' => 'required|date',
            'data_recepcao' => 'nullable|date',
            'num_documento' => 'nullable',
            'qtd_embalagem' => 'nullable|integer|min:1',
            'grupo_farmaco_id' => 'required|exists:grupo_farmacologicos,id',
            'obs' => 'nullable',
            'prateleira_id' => 'nullable|exists:prateleiras,id',
        ], [
            'designacao.required' => 'A designação é obrigatória.',
            'farmacia_id.required' => 'Algo correu mal, atualize a página e tente novamente.',
            'dosagem.required' => 'A dosagem é obrigatória.',
            'quantidade.required' => 'A quantidade é obrigatória.',
            'quantidade.integer' => 'A quantidade deve ser um número inteiro.',
            'quantidade.min' => 'A quantidade deve ser maior que zero.',
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

        $quantidade = $request->input('quantidade');
        $farmacia_id = $request->farmacia_id;

        if ($request->tipo == 'medicamento' and !$request->dosagem)
            return response()->json(['message' => "Um medicamento deve ter uma dosagem"], 401);

        $dadosPE = [
            'designacao' => $request->designacao,
            'dosagem' => ($request->dosagem ? $request->dosagem : ''),
            'tipo' => $request->tipo,
            'quantidade' => $quantidade,
            'forma' => $request->forma,
            'confirmado' => 1,
            'fornecedor_id' => $request->fornecedor_id,
            'origem_destino' => $request->fornecedor_id ? \App\Models\Fornecedor::find($request->fornecedor_id)?->nome : null,
            'num_lote' => $request->num_lote,
            'data_expiracao' => $request->data_expiracao,
            'data_producao' => $request->data_producao,
            'data_recepcao' => $request->data_recepcao,
            'num_documento' => $request->num_documento,
            'obs' => $request->obs,
            'qtd_embalagem' => ($request->qtd_embalagem ? $request->qtd_embalagem : null),
            'grupo_farmaco_id' => $request->grupo_farmaco_id,
            'prateleira_id' => $request->prateleira_id,
        ];

        $tipo = $request->tipo;
        $pe = PE::create($dadosPE);

        SE::create([
            'produto_estoque_id' => $pe->id,
            'qtd' => $quantidade
        ]);

        // Resolver area_hospitalar a partir do ID de FarmaciaAreaHospitalar
        try {
            $fah = \App\Models\FarmaciaAreaHospitalar::with('area_hospitalar')->findOrFail($request->area_id);
        } catch (\Throwable $e) {
            return $request->ajax()
                ? response()->json(['message' => 'Área inválida'], 422)
                : back()->withErrors(['area_id' => 'Área inválida']);
        }

        Estoque::create([
            'produto_estoque_id' => $pe->id,
            'farmacia_id' => $farmacia_id,
            'area_hospitalar_id' => $fah->area_hospitalar_id
        ]);

        // Registrar atividade
        try {
            $fornecedor = \App\Models\Fornecedor::find($request->fornecedor_id);
            $fornecedorNome = $fornecedor ? $fornecedor->nome : 'Fornecedor não identificado';

            $meta = [
                'model_type' => PE::class,
                'model_id' => $pe->id,
                'ip_address' => request()->ip(),
                'route' => request()->path(),
                'http_method' => request()->method(),
                'level' => 'success',
                'snapshot_after' => $pe->toArray(),
                'fornecedor_id' => $request->fornecedor_id,
                'fornecedor_nome' => $fornecedorNome,
            ];
            self::startAtv(
                "Cadastrou novo produto '{$pe->designacao}' (Lote: {$pe->num_lote}) com quantidade {$quantidade} no estoque. Fornecedor: {$fornecedorNome} forneceu {$quantidade} unidades de {$pe->designacao}",
                null,
                $meta
            );
        } catch (\Throwable $_) {}

        $caixas = getCaixa($request->descritivo ?? "{$quantidade}x1x1");

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
        return redirect()->route("estoque.cadastrar", ['area_id' => $fah->area_hospitalar_id])->with("success", "{$caixas} caixas de {$request->designacao} adicionadas.");
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
        try {
            // Validar dados
            $request->validate([
                'designacao' => 'required|string|max:255',
                'tipo' => 'required|in:descartável,medicamento,liquido',
                'dosagem' => 'nullable|string|max:100',
                'forma' => 'required|string',
                'quantidade' => 'required|integer|min:0',
                'num_lote' => 'nullable|string|max:100',
                'num_documento' => 'nullable|string|max:100',
                'data_producao' => 'nullable|date',
                'data_expiracao' => 'required|date',
                'data_recepcao' => 'nullable|date',
                'grupo_farmaco_id' => 'required|exists:grupo_farmacologicos,id',
                'fornecedor_id' => ['required', function($attribute, $value, $fail) {
                    if ($value !== 'revisao-estoque' && !\App\Models\Fornecedor::where('id', $value)->exists()) {
                        $fail('O fornecedor selecionado é inválido.');
                    }
                }],
                'prateleira_id' => 'nullable|exists:prateleiras,id',
                'obs' => 'nullable|string',
            ], [
                'designacao.required' => 'A designação é obrigatória',
                'tipo.required' => 'O tipo é obrigatório',
                'forma.required' => 'A forma farmacêutica é obrigatória',
                'quantidade.required' => 'A quantidade é obrigatória',
                'quantidade.min' => 'A quantidade deve ser no mínimo 0',
                'data_expiracao.required' => 'A data de expiração é obrigatória',
                'grupo_farmaco_id.required' => 'O grupo farmacológico é obrigatório',
                'fornecedor_id.required' => 'O fornecedor é obrigatório',
            ]);

            $produto = PE::findOrFail($id);
            $oldData = $produto->toArray();

            // Atualizar campos
            $produto->designacao = $request->designacao;
            $produto->tipo = $request->tipo;
            $produto->dosagem = $request->dosagem;
            $produto->forma = $request->forma;
            $produto->quantidade = $request->quantidade;
            $produto->num_lote = $request->num_lote;
            $produto->num_documento = $request->num_documento;
            $produto->data_producao = $request->data_producao;
            $produto->data_expiracao = $request->data_expiracao;
            $produto->data_recepcao = $request->data_recepcao;
            $produto->grupo_farmaco_id = $request->grupo_farmaco_id;

            // Tratar fornecedor especial "Revisão Estoque"
            if ($request->fornecedor_id === 'revisao-estoque') {
                $produto->fornecedor_id = null;
                $produto->origem_destino = 'Revisão Estoque';
            } else {
                $produto->fornecedor_id = $request->fornecedor_id;
                $produto->origem_destino = $request->fornecedor_id ? \App\Models\Fornecedor::find($request->fornecedor_id)?->nome : null;
            }

            $produto->prateleira_id = $request->prateleira_id;
            $produto->obs = $request->obs;

            if ($produto->isDirty()) {
                $produto->save();

                // Atualizar saldo
                $saldo = SE::where('produto_estoque_id', $id)->first();
                if ($saldo) {
                    $saldo->qtd = $request->quantidade;
                    $saldo->save();
                }

                // Registrar atividade
                try {
                    $changes = $produto->getChanges();
                    $structuredChanges = [];

                    foreach ($changes as $field => $newValue) {
                        if (isset($oldData[$field])) {
                            $structuredChanges[] = [
                                'field' => $field,
                                'old' => $oldData[$field],
                                'new' => $newValue
                            ];
                        }
                    }

                    if (!empty($structuredChanges)) {
                        // Verificar se o fornecedor foi alterado
                        $fornecedorInfo = '';
                        if (isset($changes['fornecedor_id'])) {
                            $fornecedor = \App\Models\Fornecedor::find($changes['fornecedor_id']);
                            if ($fornecedor) {
                                $fornecedorInfo = " Fornecedor alterado para: {$fornecedor->nome}.";
                            }
                        } elseif (isset($produto->fornecedor_id)) {
                            $fornecedor = \App\Models\Fornecedor::find($produto->fornecedor_id);
                            if ($fornecedor) {
                                $fornecedorInfo = " Fornecedor: {$fornecedor->nome}.";
                            }
                        }

                        Atividade::create([
                            'user_id' => $this->currentUser()->id ?? null,
                            'farmacia_id' => ($this->currentUser()->isFarmacia->farmacia->id ?? $this->currentUser()->farmacia->farmacia->id ?? null),
                            'area_hospitalar_id' => $produto->area_para,
                            'produto_estoque_id' => $id,
                            'accao' => 'editou produto',
                            'descricao' => 'Produto ' . $produto->designacao . ' atualizado.' . $fornecedorInfo,
                            'detalhes' => json_encode($structuredChanges)
                        ]);
                    }
                } catch (\Exception $e) {
                    \Log::error('Erro ao registrar atividade: ' . $e->getMessage());
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Produto atualizado com sucesso!'
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Nenhuma alteração detectada'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro de validação',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Erro ao atualizar produto: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar produto: ' . $e->getMessage()
            ], 500);
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

    /**
     * Transferir produto individual entre áreas (via AJAX)
     * Usado pelo offcanvas de dar baixa
     *
     * @author Augusto Kussema
     * @date 18/11/2025
     */
    public function baixa(Request $request)
    {
        $request->validate([
            'produto_id' => 'required|exists:produto_estoques,id',
            'area_hospitalar_id' => 'required|exists:areas_hospitalares,id',
            'quantidade' => 'required|integer|min:1',
            'user_id' => 'nullable|exists:users,id',
            'movement_date' => 'nullable|date',
        ], [
            'produto_id.required' => 'Produto não especificado',
            'produto_id.exists' => 'Produto não encontrado',
            'area_hospitalar_id.required' => 'Selecione a área de destino',
            'area_hospitalar_id.exists' => 'Área de destino inválida',
            'quantidade.required' => 'Informe a quantidade',
            'quantidade.integer' => 'A quantidade deve ser um número inteiro',
            'quantidade.min' => 'A quantidade deve ser maior que zero',
        ]);

        $produto = PE::findOrFail($request->produto_id);
        $quantidadeBaixar = intval($request->quantidade);
        $area_hospitalar_id = $request->area_hospitalar_id;

        // Validar quantidade disponível
        $saldoAtual = $produto->saldo->qtd ?? 0;
        if ($quantidadeBaixar > $saldoAtual) {
            return response()->json([
                'message' => "Quantidade insuficiente. Disponível: {$saldoAtual} unidades"
            ], 422);
        }

        $saldoRestante = $saldoAtual - $quantidadeBaixar;
        $user = $this->currentUser();
        $movementDate = $request->movement_date ? \Carbon\Carbon::parse($request->movement_date) : now();

        // Determinar farmacia
        $farmacia_id = null;
        if ($user->isFarmacia) {
            $farmacia_id = $user->isFarmacia->farmacia->id;
        } elseif ($user->farmacia) {
            $farmacia_id = $user->farmacia->farmacia_id;
        }

        DB::beginTransaction();
        try {
            // Dados do produto para destino
            $dataProduto = [
                'designacao' => $produto->designacao,
                'dosagem' => $produto->dosagem,
                'tipo' => $produto->tipo,
                'forma' => $produto->forma,
                'confirmado' => 1,
                'origem_destino' => $produto->origem_destino,
                'num_lote' => $produto->num_lote,
                'data_expiracao' => $produto->data_expiracao,
                'data_producao' => $produto->data_producao,
                'num_documento' => $produto->num_documento,
                'obs' => $produto->obs,
                'qtd_embalagem' => $produto->qtd_embalagem,
                'grupo_farmaco_id' => $produto->grupo_farmaco_id,
                'prateleira_id' => $produto->prateleira_id,
            ];

            // Verificar se área de destino armazena estoque
            $ud = UAH::where('area_hospitalar_id', $area_hospitalar_id)
                ->where('farmacia_id', $farmacia_id)
                ->first();

            if ($ud && $ud->guarda_estoque) {
                // Verificar se já existe produto igual na área destino
                $produtoExistente = PE::where('designacao', $produto->designacao)
                    ->where('num_lote', $produto->num_lote)
                    ->whereHas('estoque', function($q) use ($area_hospitalar_id) {
                        $q->where('area_hospitalar_id', $area_hospitalar_id);
                    })
                    ->first();

                if ($produtoExistente) {
                    // Suprimir 'updated' do observer para esta operação
                    ProdutoEstoqueObserver::markOrigin($produtoExistente->id, 'baixa');
                    // Adicionar à quantidade existente
                    $produtoExistente->quantidade += $quantidadeBaixar;
                    $produtoExistente->save();

                    $produtoExistente->saldo->update([
                        'qtd' => $produtoExistente->saldo->qtd + $quantidadeBaixar
                    ]);

                    // Registrar entrada no histórico
                    ProductHistory::create([
                        'product_id' => $produtoExistente->id,
                        'farmacia_id' => $farmacia_id,
                        'user_id' => $user->id ?? null,
                        'action' => 'stock_in',
                        'changes' => null,
                        'payload' => ['from_product_id' => $produto->id, 'num_lote' => $produto->num_lote],
                        'ip_address' => request()->ip(),
                        'user_agent' => request()->header('User-Agent'),
                        'meta' => ['area_hospitalar_id' => $area_hospitalar_id],
                        'movement_date' => $movementDate,
                        'quantity_delta' => $quantidadeBaixar,
                    ]);
                } else {
                    // Criar novo produto na área destino
                    $dataProduto['quantidade'] = $quantidadeBaixar;
                    $novoProduto = PE::create($dataProduto);

                    SE::create([
                        'produto_estoque_id' => $novoProduto->id,
                        'qtd' => $quantidadeBaixar
                    ]);

                    Estoque::create([
                        'produto_estoque_id' => $novoProduto->id,
                        'farmacia_id' => $farmacia_id,
                        'area_hospitalar_id' => $area_hospitalar_id
                    ]);

                    // Registrar entrada no histórico
                    ProductHistory::create([
                        'product_id' => $novoProduto->id,
                        'farmacia_id' => $farmacia_id,
                        'user_id' => $user->id ?? null,
                        'action' => 'stock_in',
                        'changes' => null,
                        'payload' => ['from_product_id' => $produto->id, 'num_lote' => $produto->num_lote],
                        'ip_address' => request()->ip(),
                        'user_agent' => request()->header('User-Agent'),
                        'meta' => ['area_hospitalar_id' => $area_hospitalar_id],
                        'movement_date' => $movementDate,
                        'quantity_delta' => $quantidadeBaixar,
                    ]);
                }
            }

            // Atualizar produto origem: reduzir quantidade
            ProdutoEstoqueObserver::markOrigin($produto->id, 'baixa');
            $produto->update(['quantidade' => $produto->quantidade - $quantidadeBaixar]);
            $produto->saldo->update(['qtd' => $saldoRestante]);

            // Registrar saída no histórico
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

            // Registrar atividade
            $meta = [
                'model_type' => PE::class,
                'model_id' => $produto->id,
                'ip_address' => request()->ip(),
                'route' => request()->path(),
                'http_method' => request()->method(),
                'level' => 'info',
                'movement_date' => $movementDate->format('d/m/Y H:i'),
            ];

            $areaDestino = \App\Models\AreaHospitalar::find($area_hospitalar_id);
            $dataMovimentoFormatada = \Carbon\Carbon::parse($movementDate)->format('d/m/Y');
            self::startAtv(
                "Transferiu {$quantidadeBaixar} unidades de '{$produto->designacao}' (Lote: {$produto->num_lote}) para {$areaDestino->nome} em {$dataMovimentoFormatada}",
                null,
                $meta
            );

            DB::commit();

            return response()->json([
                'message' => "Transferência realizada com sucesso! {$quantidadeBaixar} unidades transferidas."
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            logger()->error('Erro ao dar baixa: ' . $e->getMessage());
            return response()->json([
                'message' => 'Erro ao processar transferência: ' . $e->getMessage()
            ], 500);
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
     * Atualiza quantidade, lote, fornecedor e observações do produto existente.
     * Inputs esperados: produto_id, quantidade, num_lote, fornecedor, obs
     * Retorna JSON { message, quantidade }
     *
     * @author Augusto Kussema
     * @date 2025-11-11
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
            'fornecedor_id' => 'nullable|exists:fornecedores,id',
            'obs' => 'nullable|string',
        ]);

        // Buscar o produto existente
        $produto = PE::find($request->produto_id);
        if (!$produto) {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }

        $quantidadeAdicionar = intval($request->quantidade);
        $quantidadeAnterior = $produto->quantidade;
        $novaQuantidade = $quantidadeAnterior + $quantidadeAdicionar;

        DB::beginTransaction();
        try {
            // Guardar valores antigos para o histórico
            $oldValues = [
                'quantidade' => $produto->quantidade,
                'num_lote' => $produto->num_lote,
                'obs' => $produto->obs,
            ];

            // Marcar origem para suprimir 'updated' duplicado no observer
            ProdutoEstoqueObserver::markOrigin($produto->id, 'stock_in');

            // Atualizar o produto existente
            $produto->quantidade = $novaQuantidade;

            // Atualizar lote se fornecido
            if ($request->filled('num_lote')) {
                $produto->num_lote = $request->num_lote;
            }

            // Nota: fornecedor NÃO é campo da tabela produto_estoques.
            // Usamos apenas para fins de log/auditoria no histórico.

            // Atualizar observações se fornecido
            if ($request->filled('obs')) {
                $produto->obs = $request->obs;
            }

            $produto->save();

            // Atualizar o saldo
            if ($produto->saldo) {
                $produto->saldo->update([
                    'qtd' => $novaQuantidade
                ]);
            } else {
                SE::create([
                    'produto_estoque_id' => $produto->id,
                    'qtd' => $novaQuantidade
                ]);
            }

            // Preparar changes para o histórico
            $changes = [];
            foreach ($oldValues as $key => $oldValue) {
                $newValue = $produto->$key;
                if ($oldValue != $newValue) {
                    $changes[$key] = [
                        'old' => $oldValue,
                        'new' => $newValue
                    ];
                }
            }

            // Determinar farmacia do usuário atual
            $farmacia_id = '';
            if ($user->isFarmacia) {
                $farmacia_id = $user->isFarmacia->farmacia->id;
            } elseif ($user->farmacia) {
                $farmacia_id = $user->farmacia->farmacia_id;
            }

            // Registrar no histórico como stock_in
            try {
                ProductHistory::create([
                    'product_id' => $produto->id,
                    'farmacia_id' => $farmacia_id,
                    'user_id' => $user->id ?? null,
                    'action' => 'stock_in',
                    'changes' => $changes,
                    'payload' => [
                        'quantidade_anterior' => $quantidadeAnterior,
                        'quantidade_adicionada' => $quantidadeAdicionar,
                        'quantidade_nova' => $novaQuantidade,
                        'num_lote' => $produto->num_lote,
                        'supplier_name' => $request->fornecedor,
                    ],
                    'ip_address' => request()->ip(),
                    'user_agent' => request()->header('User-Agent'),
                    'meta' => [
                        'model_type' => PE::class,
                        'route' => request()->path(),
                        'http_method' => request()->method(),
                        'supplier_id' => $request->fornecedor_id,
                    ],
                    'quantity_delta' => $quantidadeAdicionar,
                    'movement_date' => now(),
                ]);
            } catch (\Throwable $e) {
                logger()->error('Falha ao registar histórico de produto: ' . $e->getMessage());
            }

            // Registrar atividade
            $meta = [
                'model_type' => PE::class,
                'model_id' => $produto->id,
                'ip_address' => request()->ip(),
                'route' => request()->path(),
                'http_method' => request()->method(),
                'level' => 'info',
                'snapshot_after' => $produto->toArray(),
            ];
            $via = $request->filled('fornecedor') ? (" via " . $request->fornecedor) : '';
            self::startAtv("Adicionou {$quantidadeAdicionar} unidades ao estoque de {$produto->designacao}{$via} (total: {$novaQuantidade})", $changes, $meta);

            // Atividade no contexto do Fornecedor (se fornecido)
            try {
                if ($request->filled('fornecedor_id')) {
                    AtividadeService::registar(
                        "Forneceu {$quantidadeAdicionar} de {$produto->designacao}",
                        [
                            'action' => 'supply',
                            'model_type' => \App\Models\Fornecedor::class,
                            'model_id' => $request->fornecedor_id,
                            'level' => 'info',
                            'snapshot_after' => [
                                'produto' => $produto->designacao,
                                'num_lote' => $produto->num_lote,
                                'quantidade' => $quantidadeAdicionar
                            ],
                        ]
                    );
                }
            } catch (\Throwable $_) {}

            DB::commit();

            return response()->json([
                'message' => "{$quantidadeAdicionar} unidades adicionadas com sucesso. Total: {$novaQuantidade}",
                'quantidade' => $produto->quantidade,
                'quantidade_adicionada' => $quantidadeAdicionar,
                'success' => true
            ], 200);

        } catch (\Throwable $e) {
            DB::rollBack();
            logger()->error('Falha ao adicionar estoque: ' . $e->getMessage());
            return response()->json([
                'message' => 'Erro ao processar pedido: ' . $e->getMessage(),
                'success' => false
            ], 500);
        }
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

        // Atualizar ou criar saldo
        if ($produto->saldo) {
            $produto->saldo->update(['qtd' => $total]);
        } else {
            SE::create([
                'produto_estoque_id' => $produto->id,
                'qtd' => $total
            ]);
        }

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

    /**
     * Sincroniza todos os produtos em lote
     *
     * Busca todos os produtos com quantidade=0 e descritivo válido,
     * sincroniza em lote e retorna progresso
     *
     * @author Augusto Kussema
     * @date 2025-11-04 10:15 (Luanda time)
     *
     * @param Request $request (opcional: area_id para filtrar por área)
     * @return \Illuminate\Http\JsonResponse
     */
    public function sincronizarTodos(Request $request)
    {
        try {
            $query = PE::where('quantidade', 0)
                ->whereNotNull('descritivo')
                ->where('descritivo', '!=', '')
                ->where('descritivo', '!=', '0')
                ->where('descritivo', '!=', 'N/A');

            // Filtrar por área se fornecido
            if ($request->has('area_id') && $request->area_id) {
                $query->where('area_id', $request->area_id);
            }

            $produtos = $query->get();

            if ($produtos->isEmpty()) {
                return response()->json([
                    'message' => 'Nenhum produto encontrado para sincronizar',
                    'total' => 0,
                    'sincronizados' => 0,
                ], 200);
            }

            $sincronizados = 0;
            $erros = 0;

            foreach ($produtos as $produto) {
                try {
                    $descritivo = $produto->descritivo ?? '';
                    $des = str_replace(['X', ' '], ['x', ''], trim($descritivo));
                    $parts = array_filter(explode('x', $des), function($v) { return $v !== ''; });
                    $values = array_map(function($v) {
                        return intval(preg_replace('/[^0-9]/', '', $v));
                    }, array_values($parts));

                    $total = 0;
                    if (count($values) >= 3) {
                        $total = intval($values[0]) * intval($values[1]) * intval($values[2]);
                    } else {
                        $total = 1;
                        foreach ($values as $val) {
                            $total *= max(0, intval($val));
                        }
                        if (count($values) === 0) {
                            $total = 0;
                        }
                    }

                    if ($total > 0) {
                        $produto->quantidade = $total;
                        $produto->save();

                        // Atualizar saldo se existir
                        if ($produto->saldo) {
                            $produto->saldo->update(['qtd' => $total]);
                        } else {
                            SE::create([
                                'produto_estoque_id' => $produto->id,
                                'qtd' => $total
                            ]);
                        }

                        $sincronizados++;
                    }
                } catch (\Throwable $e) {
                    $erros++;
                    Log::error("Erro ao sincronizar produto {$produto->id}: " . $e->getMessage());
                }
            }

            // Registrar atividade geral
            try {
                $meta = [
                    'model_type' => PE::class,
                    'ip_address' => request()->ip(),
                    'route' => request()->path(),
                    'http_method' => request()->method(),
                    'level' => 'info',
                    'total_produtos' => $produtos->count(),
                    'sincronizados' => $sincronizados,
                    'erros' => $erros,
                ];
                self::startAtv("Sincronização em lote: {$sincronizados} de {$produtos->count()} produtos", null, $meta);
            } catch (\Throwable $_) {}

            return response()->json([
                'message' => 'Sincronização concluída',
                'total' => $produtos->count(),
                'sincronizados' => $sincronizados,
                'erros' => $erros,
            ], 200);

        } catch (\Throwable $e) {
            Log::error("Erro na sincronização em lote: " . $e->getMessage());
            return response()->json([
                'message' => 'Erro ao sincronizar produtos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Retorna detalhes completos de um produto do estoque
     *
     * @param int $id ID do produto
     * @return \Illuminate\Http\JsonResponse
     * @author Augusto Kussema
     * @date 2025-01-15
     */
    public function getDetalhes(int $id)
    {
        try {
            $produto = PE::with([
                'grupo_farmaco',
                'estoque.area_hospitalar',
                'prateleira',
                'fornecedor',
                'status_stock',
                'saldo'
            ])->find($id);

            if (!$produto) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produto não encontrado'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'produto' => $produto
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar detalhes do produto',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Atualizar produto via AJAX (para offcanvas)
     *
     * @author Augusto Kussema
     * @date 08 Dez 2025 11:45 (Luanda)
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateViaAjax(Request $request, $id)
    {
        try {
            // Validar dados
            $request->validate([
                'designacao' => 'required|string|max:255',
                'tipo' => 'required|in:descartável,medicamento,liquido',
                'dosagem' => 'nullable|string|max:100',
                'forma' => 'required|string',
                'quantidade' => 'required|integer|min:0',
                'num_lote' => 'nullable|string|max:100',
                'num_documento' => 'nullable|string|max:100',
                'data_producao' => 'nullable|date',
                'data_expiracao' => 'required|date',
                'data_recepcao' => 'nullable|date',
                'grupo_farmaco_id' => 'required|exists:grupo_farmacologicos,id',
                'fornecedor_id' => 'required|exists:fornecedores,id',
                'prateleira_id' => 'nullable|exists:prateleiras,id',
                'obs' => 'nullable|string',
            ], [
                'designacao.required' => 'A designação é obrigatória',
                'tipo.required' => 'O tipo é obrigatório',
                'forma.required' => 'A forma farmacêutica é obrigatória',
                'quantidade.required' => 'A quantidade é obrigatória',
                'quantidade.min' => 'A quantidade deve ser no mínimo 0',
                'data_expiracao.required' => 'A data de expiração é obrigatória',
                'grupo_farmaco_id.required' => 'O grupo farmacológico é obrigatório',
                'fornecedor_id.required' => 'O fornecedor é obrigatório',
            ]);

            $produto = PE::findOrFail($id);
            $oldData = $produto->toArray();

            // Atualizar campos
            $produto->designacao = $request->designacao;
            $produto->tipo = $request->tipo;
            $produto->dosagem = $request->dosagem;
            $produto->forma = $request->forma;
            $produto->quantidade = $request->quantidade;
            $produto->num_lote = $request->num_lote;
            $produto->num_documento = $request->num_documento;
            $produto->data_producao = $request->data_producao;
            $produto->data_expiracao = $request->data_expiracao;
            $produto->data_recepcao = $request->data_recepcao;
            $produto->grupo_farmaco_id = $request->grupo_farmaco_id;
            $produto->fornecedor_id = $request->fornecedor_id;
            $produto->origem_destino = $request->fornecedor_id ? \App\Models\Fornecedor::find($request->fornecedor_id)?->nome : null;
            $produto->prateleira_id = $request->prateleira_id;
            $produto->obs = $request->obs;

            if ($produto->isDirty()) {
                $produto->save();

                // Atualizar saldo
                $saldo = SE::where('produto_estoque_id', $id)->first();
                if ($saldo) {
                    $saldo->qtd = $request->quantidade;
                    $saldo->save();
                }

                // Registrar atividade
                try {
                    $changes = $produto->getChanges();
                    $structuredChanges = [];

                    foreach ($changes as $field => $newValue) {
                        if (isset($oldData[$field])) {
                            $structuredChanges[] = [
                                'field' => $field,
                                'old' => $oldData[$field],
                                'new' => $newValue
                            ];
                        }
                    }

                    $meta = [
                        'model_type' => PE::class,
                        'model_id' => $produto->id,
                        'ip_address' => request()->ip(),
                        'route' => request()->path(),
                        'http_method' => request()->method(),
                        'level' => 'success',
                        'snapshot_before' => $oldData,
                        'snapshot_after' => $produto->toArray(),
                    ];

                    $fields = implode(', ', array_keys($changes));
                    self::startAtv("Editou produto {$produto->designacao} via AJAX - Campos: {$fields}", $structuredChanges, $meta);
                } catch (\Throwable $e) {
                    logger()->error('Falha ao registar atividade de edição via AJAX: ' . $e->getMessage());
                }

                return response()->json([
                    'success' => true,
                    'message' => 'Produto atualizado com sucesso!'
                ], 200);
            }

            return response()->json([
                'success' => true,
                'message' => 'Nenhuma alteração foi feita'
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro de validação',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            logger()->error('Erro ao atualizar produto via AJAX: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Erro ao atualizar produto: ' . $e->getMessage()
            ], 500);
        }
    }
}
