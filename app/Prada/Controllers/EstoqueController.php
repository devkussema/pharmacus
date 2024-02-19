<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    AreaHospitalar as AH,
    Estoque,
    SaldoEstoque as SE,
    ProdutoEstoque as PE,
};
use Yajra\DataTables\DataTables;
use App\Traits\AtividadeTrait;

class EstoqueController extends Controller
{
    use AtividadeTrait;

    private $estoque = null;

    public function index()
    {
        $ah = AH::all();

        $estoque = Estoque::with('produto')->where('area_hospitalar_id', auth()->user()->area_hospitalar->area_hospitalar_id)->get();
        return view('estoque.show', compact('estoque', 'ah'));
    }

    public function ajaxEstoque()
    {
        $estoque = Estoque::with('produto.saldo', 'produto.grupo_farmaco')->get();

        return DataTables::of($estoque)
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" class="checkbox-input" id="checkbox'.$row->id.'">';
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
            'dosagem' => 'required',
            'forma' => 'required',
            'origem_destino' => 'required',
            'num_lote' => 'required',
            'data_expiracao' => 'required|date',
            'data_producao' => 'required|date',
            'num_documento' => 'nullable',
            'qtd_embalagem' => 'nullable|integer|min:1',
            'grupo_farmaco_id' => 'required|exists:grupo_farmacologicos,id',
            'obs' => 'nullable',
            'qtd' => 'required',
        ], [
            'designacao.required' => 'A designação é obrigatória.',
            'dosagem.required' => 'A dosagem é obrigatória.',
            'forma.required' => 'A forma é obrigatória.',
            'origem_destino.required' => 'A origem ou destino é obrigatório.',
            'num_lote.required' => 'O número do lote é obrigatório.',
            'data_expiracao.required' => 'A data de expiração é obrigatória.',
            'data_expiracao.date' => 'A data de expiração deve ser uma data válida.',
            'data_producao.required' => 'A data de produção é obrigatória.',
            'data_producao.date' => 'A data de produção deve ser uma data válida.',
            'num_documento.required' => 'O número do documento é obrigatório.',
            'qtd_embalagem.required' => 'A quantidade por embalagem é obrigatória.',
            'qtd_embalagem.integer' => 'A quantidade por embalagem deve ser um número inteiro.',
            'qtd_embalagem.min' => 'A quantidade por embalagem deve ser pelo menos 1.',
        ]);

        $dadosPE = [
            'designacao' => $request->designacao,
            'dosagem' => $request->dosagem,
            'forma' => $request->forma,
            'origem_destino' => $request->origem_destino,
            'num_lote' => $request->num_lote,
            'data_expiracao' => $request->data_expiracao,
            'data_producao' => $request->data_producao,
            'num_documento' => $request->num_documento,
            'obs' => $request->obs,
            'qtd_embalagem' => $request->qtd_embalagem,
            'grupo_farmaco_id' => $request->grupo_farmaco_id
        ];

        $pe = PE::create($dadosPE);

        SE::create([
            'produto_estoque_id' => $pe->id,
            'qtd' => $request->qtd
        ]);

        Estoque::create([
            'produto_estoque_id' => $pe->id,
            'area_hospitalar_id' => auth()->user()->area_hospitalar->area_hospitalar_id
        ]);

        self::startAtv("Adicionou cerca de {$request->qtd} {$request->forma} de {$request->designacao} para " . auth()->user()->area_hospitalar->area_hospitalar->nome);

        return response()->json(['message' => "{$request->designacao} adicionado!"]);
    }

    public function baixa(Request $request)
    {
        $request->validate([
            'produto_id' => "required|exists:produto_estoques,id",
            'area_hospitalar_id' => "required|exists:areas_hospitalares,id",
            'qtd' => "required|min:1",
        ]);

        $produto = PE::find($request->produto_id);
        $qtdBaixar = $request->qtd;
        $qt = ($produto->saldo->qtd - $qtdBaixar);

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
            $saldoAdd = intval($request->qtd); // Converte para um número inteiro
            $saldoAtual->update([
                'qtd' => $saldoAtual->qtd + $saldoAdd
            ]);

            $saldoA = $produto->saldo;

            #return response()->json(['message' => "Este produto já existe"], 401);
        }else{
            $novoProduto = PE::create($dataProduto);
            $saldO = SE::create([
                'produto_estoque_id' => $novoProduto->id,
                'qtd' => $qtdBaixar
            ]);

            $estoque = Estoque::create([
                'produto_estoque_id' => $novoProduto->id,
                'area_hospitalar_id' => $request->area_hospitalar_id
            ]);

        }
        $produto->saldo->update([
            'qtd' => $qt
        ]);


        #return response()->json(['message' => 'Baixa concluida'], 201);
    }
}
