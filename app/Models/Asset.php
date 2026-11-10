<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asset extends Model
{
    protected $fillable = [
        'company_id',
        'employee_id',
        'name',
        'code',
        'category',
        'serial_no',
        'condition',
        'assigned_date',
        'notes',
    ];

    protected $casts = [
        'assigned_date' => 'date',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}

