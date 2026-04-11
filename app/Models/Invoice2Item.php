<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice2Item extends Model
{
    protected $table = 'invoice2_items';

    protected $fillable = [
        'invoice2_id',
        'item_name',
        'description',
        'unit_price',
        'quantity',
        'unit',
        'total',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'quantity' => 'integer',
        'total' => 'decimal:2',
    ];

    public function invoice2(): BelongsTo
    {
        return $this->belongsTo(Invoice2::class, 'invoice2_id');
    }
}
