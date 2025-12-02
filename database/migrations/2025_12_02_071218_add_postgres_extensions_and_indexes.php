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
        // Enable pgvector extension
        \DB::statement('CREATE EXTENSION IF NOT EXISTS vector');
        // Create index on works.content
        \DB::statement('CREATE INDEX works_content_idx ON works USING gin (to_tsvector(\'english\', content));');
        // Create index on works.title
        \DB::statement('CREATE INDEX works_title_idx ON works USING gin (to_tsvector(\'english\', title));');
        // Create index on works.fts
        \DB::statement('CREATE INDEX works_fts_idx ON works USING gin (fts);');
        // Create index on works.embedding (vector column)
        \DB::statement('CREATE INDEX works_embedding_idx ON works USING ivfflat (embedding vector_cosine_ops);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
