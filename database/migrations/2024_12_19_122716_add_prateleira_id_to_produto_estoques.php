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
            $table->foreignId('prateleira_id')->nullable()->constrained('prateleiras')->after('tipo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produto_estoques', function (Blueprint $table) {
            $table->dropColumn('prateleira_id');
        });
    }
};
