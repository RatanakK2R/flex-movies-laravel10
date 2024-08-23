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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->constrained('movies')->onDelete('cascade'); // Link to the movies table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Link to the users table
            $table->text('text'); // Comment text
            $table->integer('likes')->default(0); // Number of likes
            $table->integer('dislikes')->default(0); // Number of dislikes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
