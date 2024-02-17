<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{AreaHospitalar as AH, Estoque, SaldoEstoque as SE, ProdutoEstoque as PE};

class EstoqueController extends Controller
{
    private $estoque = null;

    public function index()
    {
        $ah = AH::all();

        $estoque = Estoque::with('produto')->get();
        return view('estoque.show', compact('estoque', 'ah'));
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

        return response()->json(['message' => "{$request->designacao} adicionado!"]);
    }
}
