<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->string('payment_method');
            $table->decimal('total_amount', 15, 2);
            $table->text('notes')->nullable();
            // $table->enum('status', ['pending', 'processing', 'completed', 'cancelled', 'on_delivery'])->default('pending'); // DIHAPUS
            $table->time('jam_kedatangan')->nullable(); // TAMBAHKAN: Kolom untuk jam kedatangan (opsional)
            $table->text('order_details_text')->nullable();
            $table->boolean('whatsapp_message_sent')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};