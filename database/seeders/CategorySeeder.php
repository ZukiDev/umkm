<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'title' => 'Technology',
                'slug' => Str::slug('Technology'),
                'icon' => 'https://example.com/icons/technology.png',
            ],
            [
                'title' => 'Education',
                'slug' => Str::slug('Education'),
                'icon' => 'https://example.com/icons/education.png',
            ],
            [
                'title' => 'Health',
                'slug' => Str::slug('Health'),
                'icon' => 'https://example.com/icons/health.png',
            ],
            [
                'title' => 'Business',
                'slug' => Str::slug('Business'),
                'icon' => 'https://example.com/icons/business.png',
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
