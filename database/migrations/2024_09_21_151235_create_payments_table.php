<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Order;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained()->onDelete('cascade'); // Relasi ke tabel pesanan
            $table->string('payment_method', 255);   // Metode pembayaran
            $table->bigInteger('total_price');       // Total harga dari pesanan
            $table->bigInteger('total_payment');     // Total pembayaran yang dilakukan
            $table->integer('status')->default(0); // Status pembayaran (0: Pending, 1: Success, 2: Failed)
            $table->timestamp('payment_date')->nullable();     // Tanggal pembayaran
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
