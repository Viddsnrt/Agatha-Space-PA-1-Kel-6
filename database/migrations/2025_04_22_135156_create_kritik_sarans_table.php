<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('kritik_sarans', function (Blueprint $table) {
            $table->id(); // Kolom id auto-increment
            $table->string('nama');
            $table->string('email');
            $table->string('no_hp');
            $table->enum('jenis', ['kritik', 'saran']);
            $table->text('pesan'); // Kolom pesan isi dari kritik/saran
            $table->string('gambar')->nullable();
            $table->boolean('tampilkan')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kritik_sarans');
    }
};
