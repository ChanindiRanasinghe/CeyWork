<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveBalance extends Model
{
    protected $fillable = [
        'employee_id',
        'year',
        'annual_total',
        'annual_taken',
        'casual_total',
        'casual_taken',
        'sick_total',
        'sick_taken',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function getAnnualRemainingAttribute(): int
    {
        return max(0, $this->annual_total - $this->annual_taken);
    }

    public function getCasualRemainingAttribute(): int
    {
        return max(0, $this->casual_total - $this->casual_taken);
    }

    public function getSickRemainingAttribute(): int
    {
        return max(0, $this->sick_total - $this->sick_taken);
    }
}

