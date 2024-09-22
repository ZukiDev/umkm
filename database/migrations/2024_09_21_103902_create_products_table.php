<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Store;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Store::class);
            $table->string('name', 255);
            $table->string('description', 255);
            $table->string('sku', 255)->unique(); // Kode unik produk
            $table->decimal('price', 10, 2);
            $table->integer('stock');
            $table->decimal('weight', 8, 2)->nullable(); // Berat
            $table->string('dimensions', 255)->nullable(); // Dimensi
            $table->string('brand', 255)->nullable(); // Merek
            $table->boolean('status')->default(true); // Status produk
            $table->string('images'); // URL gambar produk
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
