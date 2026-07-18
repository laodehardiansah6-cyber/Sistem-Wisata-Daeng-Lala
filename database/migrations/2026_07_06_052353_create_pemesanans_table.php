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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->string('id_pesanan')->unique(); // Format: ORD-20260611-0001
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('jenis', ['Makanan', 'Fasilitas']);
            $table->string('item_nama'); 
            $table->integer('jumlah');
            $table->integer('total_harga');
            $table->enum('status_pesanan', ['Pending', 'Sukses', 'Batal'])->default('Pending');
            $table->string('status_pembayaran')->default('Belum Bayar');
            $table->string('metode_pembayaran')->default('Transfer Bank');
            $table->string('bukti_transfer')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};