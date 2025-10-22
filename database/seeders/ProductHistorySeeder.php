<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductHistory;
use App\Models\ProdutoEstoque;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * ProductHistorySeeder
 *
 * Autor: Augusto Kussema
 * Data: 2025-10-22
 */
class ProductHistorySeeder extends Seeder
{
    public function run()
    {
        // Gera 30 registos mistos para demonstração
        ProductHistory::factory()->count(30)->create();

        // Também cria alguns registos manuais realistas
    $product = ProdutoEstoque::first();
        $user = User::first();

        if ($product && $user) {
            ProductHistory::create([
                'product_id' => $product->id,
                'farmacia_id' => $product->farmacia_id ?? (string) Str::uuid(),
                'user_id' => $user->id,
                'action' => 'price_change',
                'changes' => [
                    'before' => ['price' => 120.00],
                    'after' => ['price' => 100.00],
                ],
                'payload' => ['reason' => 'Promoção local'],
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Seeder',
                'meta' => ['source' => 'seed'],
                'quantity_delta' => null,
            ]);

            ProductHistory::create([
                'product_id' => $product->id,
                'farmacia_id' => $product->farmacia_id ?? (string) Str::uuid(),
                'user_id' => $user->id,
                'action' => 'stock_out',
                'changes' => null,
                'payload' => ['reason' => 'Venda'],
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Seeder',
                'meta' => ['source' => 'seed'],
                'quantity_delta' => -5,
            ]);
        }
    }
}
