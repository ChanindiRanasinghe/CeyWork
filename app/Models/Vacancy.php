<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $fillable = [
        'company_id',
        'department_id',
        'hiring_manager_id',
        'title',
        'description',
        'requirements',
        'openings_count',
        'employment_type',
        'closing_date',
        'status',
    ];

    protected $casts = [
        'closing_date' => 'date',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function hiringManager()
    {
        return $this->belongsTo(User::class, 'hiring_manager_id');
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}
