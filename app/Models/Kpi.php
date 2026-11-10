<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kpi extends Model
{
    protected $fillable = [
        'department_id',
        'title',
        'department',
        'status',
        'target',
        'actual',
        'percentage',
        'trend',
    ];

    public function departmentModel(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}

