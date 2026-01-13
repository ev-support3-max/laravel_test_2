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
        Schema::table('users', function (Blueprint $table) {
            // 権限の設定
            $table->string('role')
                  ->default('user')
                  ->comment('user:利用者, shop:店舗, admin:管理者')
                  ->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // roleカラムの削除
            $table->dropColumn('role');
        });
    }
};
