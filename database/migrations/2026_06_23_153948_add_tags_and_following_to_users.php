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
        // 1. 在現有的 users 表中新增 tags 欄位
        Schema::table('users', function (Blueprint $table) {
            // 使用 json 型態，並設定 nullable() 確保舊資料不會因為缺少此欄位而出錯
            $table->json('tags')->nullable();
        });

        // 2. 建立獨立的中介表來記錄 following (追蹤) 關係
        Schema::create('user_follows', function (Blueprint $table) {
            $table->id();
            
            // 這裡對應 users 表的 id 欄位
            $table->unsignedBigInteger('follower_id'); 
            $table->unsignedBigInteger('following_id');
            $table->timestamps();

            // 設定外鍵關聯 (當使用者被刪除時，連帶刪除追蹤紀錄)
            $table->foreign('follower_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('following_id')->references('id')->on('users')->onDelete('cascade');

            // 確保同一個人不會重複追蹤同一個對象
            $table->unique(['follower_id', 'following_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 復原機制
        Schema::dropIfExists('user_follows');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('tags');
        });
    }
};