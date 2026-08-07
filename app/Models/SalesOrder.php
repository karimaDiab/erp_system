<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class SalesOrder extends Model
{
    use HasFactory;

    public const STATUSES = ['draft', 'confirmed', 'completed', 'cancelled'];

    protected $fillable = [
        'order_number',
        'customer_id',
        'order_date',
        'status',
        'total_amount',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'order_date' => 'date',
            'total_amount' => 'decimal:2',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $order) {
            if (empty($order->order_number)) {
                $order->order_number = 'SO-'.Str::padLeft((string) ((static::max('id') ?? 0) + 1), 5, '0');
            }
        });
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(SalesOrderItem::class);
    }
}
