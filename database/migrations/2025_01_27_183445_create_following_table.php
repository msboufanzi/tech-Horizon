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
                $table->id(); // Auto-incrementing primary key
                $table->unsignedInteger('user_id'); // Foreign key for the user (matches users.id)
                $table->unsignedInteger('theme_id'); // Foreign key for the theme (matches themes.id)
                $table->timestamps(); // Created_at and updated_at columns

                // Define foreign key constraints
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('theme_id')->references('id')->on('themes')->onDelete('cascade');

                // Ensure a user can't follow the same theme more than once
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