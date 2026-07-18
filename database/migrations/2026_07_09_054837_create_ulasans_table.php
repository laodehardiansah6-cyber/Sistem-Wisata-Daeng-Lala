<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ulasans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Siapa yang mereview
            
            // Kita pakai string dan integer untuk mendeteksi item apa yang direview
            $table->enum('jenis', ['Makanan', 'Fasilitas']); // Review untuk makanan atau fasilitas?
            $table->unsignedBigInteger('item_id'); // ID dari makanan atau fasilitas tersebut
            
            $table->integer('rating'); // Bintang 1 sampai 5
            $table->text('komentar')->nullable(); // Isi ulasan/komentarnya
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ulasans');
    }
};
