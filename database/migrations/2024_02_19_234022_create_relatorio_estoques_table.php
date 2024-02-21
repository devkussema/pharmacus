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
        Schema::create('relatorio_estoque_alerta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nivel_alerta_id');
            $table->unsignedBigInteger('produto_estoque_id');
            $table->timestamps();

            // Define as chaves estrangeiras
            $table->foreign('nivel_alerta_id')->references('id')->on('niveis_alerta')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('produto_estoque_id')->references('id')->on('produto_estoques')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relatorio_estoque_alerta');
    }
};
