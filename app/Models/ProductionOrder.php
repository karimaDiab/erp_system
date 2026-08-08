<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ProductionOrder extends Model
{
    use HasFactory;

    public const STATUSES = ['planned', 'in_progress', 'completed', 'cancelled'];

    public const STOCK_AFFECTING_STATUSES = ['completed'];

    protected $fillable = [
        'order_number',
        'product_id',
        'quantity',
        'status',
        'start_date',
        'end_date',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $order) {
            if (empty($order->order_number)) {
                $order->order_number = 'PR-'.Str::padLeft((string) ((static::max('id') ?? 0) + 1), 5, '0');
            }
        });
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function materials(): HasMany
    {
        return $this->hasMany(ProductionOrderMaterial::class);
    }
}
