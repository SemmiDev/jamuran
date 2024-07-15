<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name'); // Nama produk
            $table->decimal('price', 10, 2); // Harga
            $table->text('description')->nullable(); // Deskripsi
            $table->integer('stock'); // Stok
            $table->string('photo')->nullable(); // Foto
            $table->string('owner_name'); // Nama pemilik
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // id_kategori referensi ke tabel categories
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
