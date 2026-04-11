<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice2Stage extends Model
{
    protected $table = 'invoice2_stages';

    protected $fillable = [
        'invoice2_id',
        'stage_name',
        'stage_percentage',
        'stage_amount',
        'stage_due_date',
        'stage_status',
        'stage_notes',
    ];

    protected $casts = [
        'stage_percentage' => 'decimal:2',
        'stage_amount' => 'decimal:2',
        'stage_due_date' => 'date',
    ];

    public function invoice2(): BelongsTo
    {
        return $this->belongsTo(Invoice2::class, 'invoice2_id');
    }
}
