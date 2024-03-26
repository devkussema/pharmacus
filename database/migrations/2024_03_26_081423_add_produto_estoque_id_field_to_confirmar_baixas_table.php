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
        Schema::table('confirmar_baixas', function (Blueprint $table) {
            $table->unsignedBigInteger('produto_estoque_id')->after('texto');
            $table->foreign('produto_estoque_id')->references('id')->on('produto_estoques')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('confirmar_baixas', function (Blueprint $table) {
            $table->dropForeign(['produto_estoque_id']);
            $table->dropColumn('produto_estoque_id');
        });
    }
};
