<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Remove `qtd_embalagem` and add `quantidade` (int, default 0).
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produto_estoques', function (Blueprint $table) {
            if (Schema::hasColumn('produto_estoques', 'qtd_embalagem')) {
                $table->dropColumn('qtd_embalagem');
            }

            if (!Schema::hasColumn('produto_estoques', 'quantidade')) {
                $table->integer('quantidade')->default(0)->after('obs');
            }
        });
    }

    /**
     * Reverse the migrations.
     * Recreate `qtd_embalagem` (nullable) and drop `quantidade`.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produto_estoques', function (Blueprint $table) {
            if (!Schema::hasColumn('produto_estoques', 'qtd_embalagem')) {
                $table->string('qtd_embalagem')->nullable()->after('obs');
            }

            if (Schema::hasColumn('produto_estoques', 'quantidade')) {
                $table->dropColumn('quantidade');
            }
        });
    }
};
