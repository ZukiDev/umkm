<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Address;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->string('store_name', 255); // Nama UMKM
            $table->string('description', 255); // Nama UMKM
            $table->string('owner_name', 255)->nullable(); // Nama pemilik
            $table->foreignIdFor(Address::class);
            $table->string('email')->unique()->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->string('business_type', 100)->nullable(); // Tipe Usaha
            $table->boolean('status')->default(true); // Status Operasional
            $table->string('logo', 2048)->nullable(); // URL Logo UMKM
            $table->foreignIdFor(User::class, 'created_by'); // FK ke Super Admin yang membuat UMKM
            $table->softDeletes(); // Soft Delete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stores');
    }
};
