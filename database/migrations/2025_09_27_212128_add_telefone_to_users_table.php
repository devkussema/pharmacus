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
        if (!Schema::hasColumn('users', 'telefone')) {
            Schema::table('users', function (Blueprint $table) {
            $table->string('telefone')->nullable()->after('email');
            });
        }

        // Verifica e insere registo na tabela migrations se não existir
        $migrationName = '2025_09_27_212128_add_telefone_to_users_table';

        if (Schema::hasTable('migrations')) {
            $exists = \Illuminate\Support\Facades\DB::table('migrations')
                ->where('migration', $migrationName)
                ->exists();

            if (!$exists) {
                $batch = (int) (\Illuminate\Support\Facades\DB::table('migrations')->max('batch') ?? 0) + 1;

                \Illuminate\Support\Facades\DB::table('migrations')->insert([
                    'migration' => $migrationName,
                    'batch' => $batch,
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('telefone');
        });
    }
};
