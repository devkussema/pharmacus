<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    PedidoItem,
    AreaHospitalar,
    Estoque,
    ProdutoEstoque as PE
};

class PedidoController extends Controller
{
    public function index()
    {
        $area_id = session("id_area_");

        $pi = PedidoItem::with('user_a')->where('area_para', $area_id)->where('confirmado', 0)->get();

        return view('pedido.show', ['pedidos' => $pi]);
    }

    public function atender(Request $request, $id)
    {
        $pi = PedidoItem::find($id);

        return view('pedido.atender', ['pedido' => $pi]);
    }

    public function storeAtender(Request $request, $id)
    {
        $request->validate([
            'qtd_disponibilizada' => "required|numeric"
        ],[
            'qtd_disponibilizada.required' => "Deves informar a quantidade disponibilizada"
        ]);

        $ref = $request->input('ref_id');
        $qtd_dip = $request->input('qtd_disponibilizada');
        $doc_num = $request->input('doc_num');
        $pe = PE::where('num_documento', $doc_num)
            ->orWhere('num_lote', $doc_num)
            ->join('estoques', 'produto_estoques.id', '=', 'estoques.produto_estoque_id') // Join com a tabela 'estoques'
            ->where('estoques.area_hospitalar_id', $request->area_para)
            ->select('produto_estoques.*', 'estoques.area_hospitalar_id')
            ->with('saldo')
            ->first();

        if ($pe) {
            $pi = PedidoItem::find($ref);
            if ($pi) {
                $descritivo = $pe->descritivo;

                // Separar os valores pela letra 'x'
                $valores = explode('x', $descritivo);

                // Subtrair $qtd_dip do primeiro valor
                $novoPrimeiroValor = $valores[0] - $qtd_dip;

                // Criar dois novos descritivos
                $novoDescritivo1 = $novoPrimeiroValor . 'x' . $valores[1] . 'x' . $valores[2];
                $novoDescritivo2 = $qtd_dip . 'x' . $valores[1] . 'x' . $valores[2];

                // Calcular as quantidades totais
                $saldoQtd1 = $novoPrimeiroValor * $valores[1] * $valores[2];
                $saldoQtd2 = $qtd_dip * $valores[1] * $valores[2];

                $pe->update([
                    "descritivo" => $novoDescritivo1
                ]);
                $pe->saldo->update([
                    "qtd" => $saldoQtd1
                ]);

                $farmacia_id = $request->farmacia_id;

                $pen = PE::where('num_documento', $doc_num)
                    ->orWhere('num_lote', $doc_num)
                    ->join('estoques', 'produto_estoques.id', '=', 'estoques.produto_estoque_id') // Join com a tabela 'estoques'
                    ->where('estoques.area_hospitalar_id', $request->area_de)
                    ->select('produto_estoques.*', 'estoques.area_hospitalar_id')
                    ->with('saldo')
                    ->first();

                if (!$pen){
                    $dadosPE = [
                        'designacao' => $pe->designacao,
                        'dosagem' => ($pe->dosagem ? $pe->dosagem : ''),
                        'tipo' => $pe->tipo,
                        'descritivo' => $novoDescritivo2,
                        'forma' => $pe->forma,
                        'confirmado' => 1,
                        'origem_destino' => $pe->origem_destino,
                        'num_lote' => $pe->num_lote,
                        'data_expiracao' => $pe->data_expiracao,
                        'data_producao' => $pe->data_producao,
                        'num_documento' => $pe->num_documento,
                        'obs' => $pe->obs,
                        'qtd_embalagem' => ($pe->qtd_embalagem ? $pe->qtd_embalagem : null),
                        'grupo_farmaco_id' => $pe->grupo_farmaco_id
                    ];
                    $novo_pe = PE::create($dadosPE);
                    $se = \App\Models\SaldoEstoque::create([
                        'produto_estoque_id' => $novo_pe->id,
                        'qtd' => $saldoQtd2
                    ]);

                    $est = Estoque::create([
                        'produto_estoque_id' => $novo_pe->id,
                        'farmacia_id' => $farmacia_id,
                        'area_hospitalar_id' => $request->area_de
                    ]);
                }else{
                    $descritivo_ = $pen->descritivo;

                    $valores_ = explode('x', $descritivo_);

                    // Subtrair $qtd_dip do primeiro valor
                    $novoPrimeiroValor_ = $valores_[0] + getCaixa($novoDescritivo2);

                    // Criar dois novos descritivos
                    $novoDescritivo_ = $novoPrimeiroValor_ . 'x' . $valores_[1] . 'x' . $valores_[2];

                    // Calcular as quantidades totais
                    $saldoQtd1_ = $novoPrimeiroValor_ * $valores_[1] * $valores_[2];

                    $pen->update([
                        'descritivo' => $novoDescritivo_,
                    ]);
                    $pen->saldo->update([
                        'qtd' => $saldoQtd1_
                    ]);
                }

                $pi->update([
                    "user_para" => auth()->user()->id,
                    "confirmado" => 1,
                    "qtd_disponibilizada" => $qtd_dip,
                ]);

                return redirect()->back()->with('success', "Produto enviado");
            }
        }else{
            return redirect()->back()->with('error', 'Algo deu errado, tente novamente.');
        }
    }

    public function getPE(Request $request, $ref)
    {
        $get = PE::where('num_documento', $ref)->orWhere('num_lote', $ref)->first();

        if ($get){
            return $get;
        }else{
            return response()->json(["Este produto não existe!"], 404);
        }
    }
}
