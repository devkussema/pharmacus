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
        Schema::create('farmacias', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Define o campo id como UUID e chave primária
            $table->string('nome');
            $table->text('descricao')->nullable();
            $table->string('logo')->nullable(); // Nome do arquivo de logo da farmácia
            $table->string('endereco');
            $table->text('obs')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farmacias');
    }
};
