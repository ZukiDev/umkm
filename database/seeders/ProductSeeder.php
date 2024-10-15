<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Store;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Get the store ID of the first store for the user (you can modify this as needed)
        $storeId = Store::first()->id; // Adjust as necessary to get the right store
        $categoryId = Category::first()->id; // Adjust as necessary to get the right store

        // Create sample products
        Product::create([
            'store_id' => $storeId,
            'category_id' => $categoryId,
            'name' => 'Produk A',
            'description' => 'Deskripsi Produk A',
            'sku' => 'SKU001',
            'price' => 80000.00,
            'stock' => 200,
            'weight' => 1.5,
            'dimensions' => '10x10x10 cm',
            'brand' => 'Brand A',
            'status' => true,
            'images' => asset('assets/images/shop/items/s2.jpg'),
        ]);

        Product::create([
            'store_id' => $storeId,
            'category_id' => $categoryId,
            'name' => 'Produk B',
            'description' => 'Deskripsi Produk B',
            'sku' => 'SKU002',
            'price' => 150000.00,
            'stock' => 50,
            'weight' => 0.5,
            'dimensions' => '5x5x5 cm',
            'brand' => 'Brand B',
            'status' => true,
            'images' => asset('assets/images/shop/items/s2.jpg'),
        ]);

        Product::create([
            'store_id' => $storeId,
            'category_id' => $categoryId,
            'name' => 'Produk C',
            'description' => 'Deskripsi Produk C',
            'sku' => 'SKU003',
            'price' => 120000.00,
            'stock' => 100,
            'weight' => 0.75,
            'dimensions' => '8x8x8 cm',
            'brand' => 'Brand C',
            'status' => true,
            'images' => asset('assets/images/shop/items/s2.jpg'),
        ]);
    }
}
