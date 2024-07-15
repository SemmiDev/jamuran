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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->text('address'); // Alamat
            $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade'); // Pembeli ID reference ke tabel users
            $table->integer('total_qty'); // Total quantity
            $table->decimal('total_price', 10, 2); // Total harga
            $table->enum('status', ['belum_membayar', 'sudah_membayar', 'verifikasi', 'dikirim', 'selesai']); // Status enum
            $table->mediumText('payment_proof')->nullable(); // Bukti transfer
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
