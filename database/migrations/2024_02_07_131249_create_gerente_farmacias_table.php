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
        Schema::create('gerente_farmacias', function (Blueprint $table) {
            $table->uuid('id')->primary(); // Define o campo id como UUID e chave primária
            //$table->uuid('user_id')->index(); // Define o campo user_id como UUID
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->string('cargo');
            $table->foreignUuid('farmacia_id')->constrained()->onDelete('cascade');
            $table->string('contato')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gerente_farmacias');
    }
};
