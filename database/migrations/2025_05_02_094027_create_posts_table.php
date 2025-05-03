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
    Schema::create('posts', function (Blueprint $table) {
        $table->id(); // 投稿ID
        $table->string('title'); // タイトル（短いテキスト）
        $table->text('body');    // 本文（長文OK）
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 投稿者のID
        $table->timestamps();    // created_at と updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
