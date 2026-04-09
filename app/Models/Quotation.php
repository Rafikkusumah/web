<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quotation extends Model
{
    protected $fillable = [
        'quotation_number',
        'quotation_date',
        'valid_until',
        'salesperson',
        'company_name',
        'address',
        'city',
        'zip_code',
        'project_description',
        'subtotal',
        'use_vat',
        'vat_percentage',
        'vat_amount',
        'total',
        'notes',
        'terms',
    ];

    protected $casts = [
        'quotation_date' => 'date',
        'valid_until' => 'date',
        'use_vat' => 'boolean',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(QuotationItem::class);
    }
}
