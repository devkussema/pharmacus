<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pedido_itens', function (Blueprint $table) {
            $table->decimal('gastos', 8, 2)->nullable()->after('item_id'); // Add "gastos" field
            $table->integer('existencia')->nullable()->after('gastos'); // Add "existencia" field
            $table->integer('qtd_pedida')->nullable()->after('existencia'); // Add "qtd_pedida" field
            $table->integer('qtd_disponibilizada')->nullable()->after('qtd_pedida');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedido_itens', function (Blueprint $table) {
            $table->dropColumn(['gastos', 'existencia', 'qtd_pedida', 'qtd_disponibilizada']);
        });
    }
};
