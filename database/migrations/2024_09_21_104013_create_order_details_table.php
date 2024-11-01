<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Product;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->string('code_order',255);
            $table->foreignIdFor(Product::class);
            $table->integer('quantity'); // Jumlah produk
            $table->bigInteger('price'); // Harga produk saat dimasukkan ke keranjang
            $table->bigInteger('total'); // Total harga (quantity * price)
            $table->softDeletes(); // Soft delete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
