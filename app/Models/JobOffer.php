<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    protected $fillable = [
        'candidate_id',
        'position_title',
        'basic_salary',
        'offered_joining_date',
        'status',
    ];

    protected $casts = [
        'offered_joining_date' => 'date',
        'basic_salary' => 'decimal:2',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
