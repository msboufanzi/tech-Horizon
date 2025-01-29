<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowingTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('following')) {
            Schema::create('following', function (Blueprint $table) {
                $table->id(); 
                $table->unsignedInteger('user_id'); 
                $table->unsignedInteger('theme_id'); 
                $table->timestamps(); 

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('theme_id')->references('id')->on('themes')->onDelete('cascade');
                
                $table->unique(['user_id', 'theme_id']);
            });
        }
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('following');
    }
}