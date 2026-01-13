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
        Schema::create('user_profile_details', function (Blueprint $table) {
            $table->id();
            // Userと紐づけ
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // プロフィール項目
            $table->string('phone')->nullable()->comment('電話番号');
            $table->string('company')->nullable()->comment('会社名');
            $table->string('address')->nullable()->comment('住所');
            $table->text('memo')->nullable()->comment('メモ');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profile_details');
    }
};
