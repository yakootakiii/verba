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
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
            $table->timestamp('published_at')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });
        // Add tsvector column for PostgreSQL full-text search
        \DB::statement('ALTER TABLE works ADD COLUMN fts tsvector');
        // Add vector column for semantic search (pgvector)
        \DB::statement('ALTER TABLE works ADD COLUMN embedding vector(384)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
