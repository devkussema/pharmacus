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
        Schema::create('produto_estoques', function (Blueprint $table) {
            $table->id();
            $table->string('designacao');
            $table->string('dosagem');
            $table->string('forma');
            $table->integer('qtd_embalagem')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produto_estoques');
    }
};
