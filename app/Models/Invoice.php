<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    protected $fillable = [
        'invoice_number',
        'invoice_date',
        'due_date',
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
        'invoice_date' => 'date',
        'due_date' => 'date',
        'use_vat' => 'boolean',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }
}
