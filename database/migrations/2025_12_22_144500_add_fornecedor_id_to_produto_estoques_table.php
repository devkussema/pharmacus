<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration para adicionar coluna fornecedor_id à tabela produto_estoques
 *
 * @author Augusto Kussema
 * @date 22 Dez 2025 14:45 (Luanda)
 * @description Adiciona relação entre produto_estoques e fornecedores
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('produto_estoques', function (Blueprint $table) {
            // Adicionar coluna fornecedor_id após origem_destino
            $table->uuid('fornecedor_id')->nullable()->after('origem_destino');

            // Criar foreign key
            $table->foreign('fornecedor_id')
                  ->references('id')
                  ->on('fornecedores')
                  ->onDelete('set null')
                  ->onUpdate('cascade');

            // Índice para melhor performance
            $table->index('fornecedor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produto_estoques', function (Blueprint $table) {
            // Remover foreign key primeiro
            $table->dropForeign(['fornecedor_id']);

            // Remover coluna
            $table->dropColumn('fornecedor_id');
        });
    }
};
