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
                'title' => 'Teknologi',
                'slug' => Str::slug('teknologi'),
                'icon' => 'storage/asset/images/shop/items/s7.jpg',
            ],
            [
                'title' => 'Kesehatan',
                'slug' => Str::slug('kesehatan'),
                'icon' => 'storage/asset/images/shop/items/s16.jpg',
            ],
            [
                'title' => 'Bisnis',
                'slug' => Str::slug('bisnis'),
                'icon' => 'storage/asset/images/shop/items/s10.jpg',
            ],
            [
                'title' => 'Kuliner',
                'slug' => Str::slug('kuliner'),
                'icon' => 'storage/asset/images/shop/items/s13.jpg',
            ],
            [
                'title' => 'Fashion',
                'slug' => Str::slug('fashion'),
                'icon' => 'storage/asset/images/shop/items/s1.jpg',
            ],
            [
                'title' => 'Hobi',
                'slug' => Str::slug('hobi'),
                'icon' => 'storage/asset/images/shop/items/s3.jpg',
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
