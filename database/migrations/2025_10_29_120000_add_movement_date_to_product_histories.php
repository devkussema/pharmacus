<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('product_histories', 'movement_date')) {
            Schema::table('product_histories', function (Blueprint $table) {
                $table->timestamp('movement_date')->nullable()->after('meta');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('product_histories', 'movement_date')) {
            Schema::table('product_histories', function (Blueprint $table) {
                $table->dropColumn('movement_date');
            });
        }
    }
};
