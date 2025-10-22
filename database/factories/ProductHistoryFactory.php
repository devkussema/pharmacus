<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ProductHistory;
use App\Models\ProdutoEstoque;
use App\Models\User;

/**
 * ProductHistory factory
 *
 * Autor: Augusto Kussema
 * Data: 2025-10-22
 */
class ProductHistoryFactory extends Factory
{
    protected $model = ProductHistory::class;

    public function definition()
    {
        $actions = ProductHistory::ACTIONS;
        $action = $this->faker->randomElement($actions);

        $quantityDelta = null;
        if (in_array($action, ['stock_in', 'stock_out', 'adjustment'])) {
            $quantityDelta = $this->faker->numberBetween(-50, 200);
        }

        $changes = null;
        $payload = null;

        if ($action === 'price_change') {
            $changes = [
                'before' => ['price' => $this->faker->randomFloat(2, 1, 50)],
                'after' => ['price' => $this->faker->randomFloat(2, 1, 200)],
            ];
        }

        if ($action === 'updated') {
            $changes = [
                'before' => ['name' => $this->faker->word()],
                'after' => ['name' => $this->faker->word()],
            ];
        }

        if (in_array($action, ['created', 'deleted', 'restored'])) {
            $payload = ['snapshot' => ['name' => $this->faker->word(), 'price' => $this->faker->randomFloat(2, 1, 100)]];
        }

        return [
            'product_id' => ProdutoEstoque::factory(),
            'farmacia_id' => (string) Str::uuid(),
            'user_id' => User::factory(),
            'action' => $action,
            'changes' => $changes,
            'payload' => $payload,
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
            'meta' => ['note' => $this->faker->sentence()],
            'quantity_delta' => $quantityDelta,
        ];
    }
}
