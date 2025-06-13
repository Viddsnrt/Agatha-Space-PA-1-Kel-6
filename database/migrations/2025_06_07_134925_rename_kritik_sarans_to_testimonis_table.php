<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Ganti nama class jika Anda membuat file migrasi baru
return new class extends Migration // Nama class bisa tetap jika memodifikasi file lama
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // Ganti nama tabel menjadi 'testimonis' atau 'masukans' (lebih generik)
        Schema::create('testimonis', function (Blueprint $table) { // UBAH NAMA TABEL
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('no_hp')->nullable(); // Jadikan no_hp nullable jika opsional
            // Ubah enum untuk jenis
            $table->enum('jenis', ['testimoni', 'saran']); // UBAH ENUM
            $table->text('pesan');
            $table->string('gambar')->nullable();
            $table->boolean('tampilkan')->default(false); // Default testimoni/saran tidak langsung tampil
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('testimonis'); // UBAH NAMA TABEL
    }
};