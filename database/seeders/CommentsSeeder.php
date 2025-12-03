<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('comments')->insert([
            [
                'work_id' => 1,
                'user_id' => 1,
                'body' => 'This really changed my perspective. Beautifully written.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'work_id' => 1,
                'user_id' => 1,
                'body' => 'Slowing down is something I’ve been struggling with, thank you for this.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'work_id' => 2,
                'user_id' => 1,
                'body' => 'Late-night coding sessions always hit different. Relatable!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'work_id' => 2,
                'user_id' => 1,
                'body' => 'I can feel the exhaustion and the passion in this piece.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
