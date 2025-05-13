<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Jika order dihapus, itemnya juga
            $table->foreignId('menu_id')->nullable()->constrained('menus')->onDelete('set null'); // Jika menu dihapus, item tetap ada tapi menu_id null (atau bisa onDelete('restrict'))
            $table->string('menu_name'); // Nama menu saat pesanan
            $table->integer('quantity');
            $table->decimal('price_at_order', 15, 2); // Harga satuan saat pesanan
            $table->decimal('subtotal', 15, 2); // quantity * price_at_order
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};