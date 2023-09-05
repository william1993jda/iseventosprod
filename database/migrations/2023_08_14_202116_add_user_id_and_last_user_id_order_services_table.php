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
        Schema::table('order_services', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->after('id')->constrained('users');
            $table->foreignId('last_user_id')->nullable()->after('user_id')->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_services', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['last_user_id']);
            $table->dropColumn(['user_id', 'last_user_id']);
        });
    }
};
