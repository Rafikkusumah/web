<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'company_name',
        'location',
        'description',
        'cover_image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function media(): HasMany
    {
        return $this->hasMany(ProjectMedia::class);
    }
}
