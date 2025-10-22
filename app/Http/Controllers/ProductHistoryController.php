<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductHistory;

class ProductHistoryController extends Controller
{
    /**
     * Retorna histórico de um produto em JSON.
     * GET /api/product-history/{id}
     */
    public function index(Request $request, $id)
    {
        $hist = ProductHistory::with('user')
            ->where('product_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['data' => $hist], 200);
    }
}
