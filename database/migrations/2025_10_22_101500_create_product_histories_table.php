<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('product_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();

            // Referências principais
            $table->uuid('product_id')->nullable()->index();
            $table->uuid('farmacia_id')->nullable()->index();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Tipo de acção realizada
            $table->enum('action', ['created', 'updated', 'deleted', 'restored', 'stock_in', 'stock_out', 'price_change', 'transfer', 'adjustment'])->index();

            // Alterações concretas (antes/depois)
            $table->json('changes')->nullable();

            // Payload / contexto completo do pedido (cópia leve)
            $table->json('payload')->nullable();

            // Informações extras
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent')->nullable();

            // Metadados livres para auditoria (ex: motivo, referência externa)
            $table->json('meta')->nullable();

            // Contadores de efeito
            $table->integer('quantity_delta')->nullable()->comment('Mudança na quantidade (positivo/negativo)');

            $table->timestampsTz();
            $table->softDeletesTz();

            // Índices para consultas comuns
            $table->index(['product_id', 'action']);
            $table->index(['farmacia_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('product_histories');
    }
};
