<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Training extends Model
{
    protected $fillable = [
        'title',
        'provider',
        'category',
        'duration',
        'deadline',
        'is_mandatory',
        'total_enrolled',
    ];

    protected $casts = [
        'is_mandatory' => 'boolean',
    ];

    public function enrollments(): HasMany
    {
        return $this->hasMany(TrainingEnrollment::class);
    }
}

