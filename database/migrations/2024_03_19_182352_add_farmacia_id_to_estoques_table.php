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
        Schema::table('estoques', function (Blueprint $table) {
            // Adiciona o campo farmacia_id
            $table->char('farmacia_id')->nullable();

            // Adiciona a chave estrangeira
            $table->foreign('farmacia_id')->references('id')->on('farmacias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('estoques', function (Blueprint $table) {
            // Remove a chave estrangeira
            $table->dropForeign(['farmacia_id']);

            // Remove o campo farmacia_id
            $table->dropColumn('farmacia_id');
        });
    }
};
