<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_phone',
        'payment_method',
        'total_amount',
        'notes',
        // 'status', // DIHAPUS
        'jam_kedatangan', // DITAMBAHKAN
        'order_details_text',
        'whatsapp_message_sent',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'whatsapp_message_sent' => 'boolean',
        'jam_kedatangan' => 'datetime:H:i', // Casting untuk jam kedatangan (opsional, tapi baik)
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}