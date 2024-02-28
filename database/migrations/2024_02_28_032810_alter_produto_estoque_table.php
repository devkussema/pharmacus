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
            // Torne o campo 'dosagem' nulo
            $table->string('dosagem')->nullable()->change();
            $table->string('tipo')->default('medicamento')->after('designacao');
            $table->string('descritivo')->nullable()->after('tipo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produto_estoques', function (Blueprint $table) {
            // Reverta a alteração, tornando o campo 'dosagem' não nulo
            $table->string('dosagem')->nullable(false)->change();
            $table->dropColumn('tipo');
            $table->dropColumn('descritivo');
        });
    }
};
