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
        Schema::table('produto_estoques', function (Blueprint $table) {
            $table->string('origem_destino')->nullable()->after('forma');
            $table->string('num_lote')->nullable()->after('origem_destino');
            $table->date('data_expiracao')->after('num_lote');
            $table->date('data_producao')->after('data_expiracao');
            $table->string('num_documento')->nullable()->after('data_producao');
            $table->text('obs')->nullable()->after('qtd_embalagem');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produtos_estoques', function (Blueprint $table) {
            //
        });
    }
};
