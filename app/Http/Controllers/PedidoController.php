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
        $ref = $request->input('item_id');
        $qtd_dip = $request->input('qtd_disponibilizada');
        $pe = PE::where('num_documento', $ref)->orWhere('num_lote', $ref)->first();

        if ($pe) {
            $pi = PedidoItem::find($ref);
            $pi->user_para = auth()->user()->id;
            $pi->confirmado = 1;
            $pi->qtd_disponibilizada = $qtd_dip;
            $pi->save();
        }else{
            return redirect()->back()->with('error', 'Algo deu errado, tente novamente.');
        }

        return redirect()->back()->with('success', "Produto enviado");
    }

    public function getPE($ref)
    {
        $get = PE::where('num_documento', $ref)->orWhere('num_lote', $ref)->first();

        if ($get)
            return $get;

        return response()->json(["O produto não existe"], 404);
    }
}
