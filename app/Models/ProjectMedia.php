<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectMedia extends Model
{
    protected $table = 'project_media';

    protected $fillable = [
        'project_id',
        'file_path',
        'file_type',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
