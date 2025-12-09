<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1️⃣ Populate fts for existing rows
        DB::statement("
            UPDATE works
            SET fts = to_tsvector('english', coalesce(title, '') || ' ' || coalesce(content, ''))
        ");

        // 2️⃣ Create the trigger function
        DB::statement("
            CREATE OR REPLACE FUNCTION works_fts_trigger() RETURNS trigger AS $$
            BEGIN
                NEW.fts := to_tsvector('english', coalesce(NEW.title, '') || ' ' || coalesce(NEW.content, ''));
                RETURN NEW;
            END
            $$ LANGUAGE plpgsql;
        ");

        // 3️⃣ Attach the trigger to works table
        DB::statement("
            DROP TRIGGER IF EXISTS tsvectorupdate ON works;
        ");

        DB::statement("
            CREATE TRIGGER tsvectorupdate
            BEFORE INSERT OR UPDATE ON works
            FOR EACH ROW EXECUTE FUNCTION works_fts_trigger();
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP TRIGGER IF EXISTS tsvectorupdate ON works;");
        DB::statement("DROP FUNCTION IF EXISTS works_fts_trigger();");
    }
};
