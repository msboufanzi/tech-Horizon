<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('magazines', function (Blueprint $table) {
            $table->id();
            $table->string('number')->unique();
            $table->string('title');
            $table->boolean('is_public')->default(false);
            $table->timestamps();
        });

        Schema::create('article_magazine', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained()->onDelete('cascade');
            $table->foreignId('magazine_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('article_magazine');
        Schema::dropIfExists('magazines');
    }
};

