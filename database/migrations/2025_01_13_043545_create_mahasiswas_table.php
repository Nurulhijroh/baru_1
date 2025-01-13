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
        Schema::create('mahasiswas', function (Blueprint $table) {
            // Mengubah 'nim' menjadi string untuk menangani angka yang lebih besar
            $table->string('nim')->unique(); // Menggunakan string agar NIM yang dimulai dengan 0 bisa dimasukkan
            $table->string('nama');
            $table->string('jurusan')->nullable(); // Membuat kolom 'jurusan' bisa kosong
            $table->timestamps(); // Menambahkan kolom 'created_at' dan 'updated_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};
