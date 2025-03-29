<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('publication_user', function (Blueprint $table) {
            $table->id();
            // Ensure users table exists from auth setup
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Ensure publications table exists
            $table->foreignId('publication_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // Optional: prevent duplicate entries
            $table->unique(['user_id', 'publication_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publication_user');
    }
};