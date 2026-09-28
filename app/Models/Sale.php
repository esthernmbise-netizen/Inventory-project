<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    protected $fillable = [
        'product_id',
        'quantity',
        'selling_price',
        'buying_price',
        'date',
    ];

    protected $casts = [
        'selling_price' => 'decimal:2',
        'buying_price' => 'decimal:2',
        'quantity' => 'integer',
        'date' => 'date',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}