<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('farmacia_areas_hospitalares')) {
            Schema::table('farmacia_areas_hospitalares', function (Blueprint $table) {
                if (!Schema::hasColumn('farmacia_areas_hospitalares', 'log_estoque')) {
                    $table->tinyInteger('log_estoque')->default(0)->after('status')->comment('Registar log de estoque: 0|1');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('farmacia_areas_hospitalares')) {
            Schema::table('farmacia_areas_hospitalares', function (Blueprint $table) {
                if (Schema::hasColumn('farmacia_areas_hospitalares', 'log_estoque')) {
                    $table->dropColumn('log_estoque');
                }
            });
        }
    }
};
