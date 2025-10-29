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
        Schema::create('saldo_estoques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_estoque_id')->constrained('produto_estoques')->onDelete('cascade');
            $table->bigInteger('qtd');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saldo_estoques');
    }
};
