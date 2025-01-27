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
        Schema::create('proposed_articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('image');
            $table->text('description');
            $table->text('content');
            $table->integer('position')->default(1);
            $table->unsignedInteger('theme_id');
            $table->unsignedInteger('author_id');
            $table->boolean('ispublic')->default(false);
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('theme_id')->references('id')->on('themes')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposed_articles');
    }
};
