<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('magazines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number')->unique();
            $table->string('title');
            $table->boolean('is_public')->default(false);
            $table->timestamps();
        });

        Schema::create('article_magazine', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('article_id');
            $table->unsignedInteger('magazine_id');
            $table->timestamps();

            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            $table->foreign('magazine_id')->references('id')->on('magazines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_magazine');
        Schema::dropIfExists('magazines');
    }
};