<?php

declare(strict_types=1);

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
    public function up(): void
    {
        if (!Schema::hasTable('user_auth_logs')) {
        Schema::create('user_auth_logs', function ($table) {
            $table->uuid('id')->primary(); // UUID for unique identification
            $table->uuid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->string('ip_address', 45); // IPv4 or IPv6
            $table->text('user_agent'); // Browser/Device info
            $table->enum('action', ['login', 'logout', 'failed_login', 'password_reset', 'password_change']); // Auth actions
            $table->enum('status', ['success', 'failure']); // Action status
            $table->timestamps(); // created_at and updated_at
        });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('user_auth_logs');
    }
};
