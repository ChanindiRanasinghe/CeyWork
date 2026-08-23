<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnboardingTask extends Model
{
    protected $fillable = [
        'candidate_id',
        'employee_id',
        'assigned_to',
        'task_name',
        'document_type',
        'due_date',
        'status',
        'verified_at',
    ];

    protected $casts = [
        'due_date' => 'date',
        'verified_at' => 'datetime',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
