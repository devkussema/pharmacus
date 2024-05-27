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
            // Adiciona a nova coluna item_id e define a chave estrangeira
            $table->unsignedBigInteger('item_id')->after('confirmado');
            $table->foreign('item_id')->references('id')->on('produto_estoques')->onDelete('cascade');

            // Remove a coluna itens
            $table->dropColumn('itens');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedido_itens', function (Blueprint $table) {
            // Adiciona novamente a coluna itens
            $table->text('itens');

            // Remove a coluna item_id e a chave estrangeira
            $table->dropForeign(['item_id']);
            $table->dropColumn('item_id');
        });
    }
};
