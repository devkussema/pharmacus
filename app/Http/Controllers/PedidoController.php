<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{
    PedidoItem,
    AreaHospitalar,
    ProdutoEstoque as PE
};

class PedidoController extends Controller
{
    public function index()
    {
        if (@auth()->user()->isFarmacia) {
            $area_idr = AreaHospitalar::where('nome', 'Armazém I')->first();
            $area_id = $area_idr->id;
        } elseif (@auth()->user()->farmacia) {
            $area_id = auth()->user()->farmacia->area_hospitalar_id;
        }

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
        ]);
        $ref = $request->input('ref_id');
        $qtd_dip = $request->input('qtd_disponibilizada');
        $doc_num = $request->input('doc_num');
        $pe = PE::where('num_documento', $doc_num)->orWhere('num_lote', $doc_num)->first();

        if ($pe) {
            $pi = PedidoItem::find($ref);
            if ($pi) {
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

    public function getPE($ref)
    {
        $get = PE::where('num_documento', $ref)->orWhere('num_lote', $ref)->first();

        if ($get)
            return $get;

        return response()->json(["O produto não existe"], 404);
    }
}
