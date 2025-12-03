<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class WorksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('works')->insert([
            [
                'title' => 'The Art of Slow Living',
                'content' => 'A reflection on slowing down in a fast-paced, digital-first world.',
                'author_id' => 1,
                'published_at' => now(),
                'slug' => Str::slug('The Art of Slow Living'),

                // PostgreSQL full-text search
                'fts' => DB::raw("
                    to_tsvector(
                        'english',
                        'The Art of Slow Living A reflection on slowing down in a fast-paced, digital-first world'
                    )
                "),

                // PgVector sample (10 dimensions for now - replace with 384 later)
                'embedding' => null,

                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'title' => 'Coding Through The Night',
                'content' => 'Thoughts and experiences while solving complex bugs late at night.',
                'author_id' => 1, // Same user
                'published_at' => now(),
                'slug' => Str::slug('Coding Through The Night'),

                'fts' => DB::raw("
                    to_tsvector(
                        'english',
                        'Coding Through The Night Thoughts and experiences while solving complex bugs late at night'
                    )
                "),

                'embedding' => null,

                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
