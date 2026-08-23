<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScreeningRecord extends Model
{
    protected $fillable = [
        'candidate_id',
        'screened_by',
        'criteria_score',
        'suitability',
        'recommendation',
        'strengths',
        'weaknesses',
        'notes',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function screenedBy()
    {
        return $this->belongsTo(User::class, 'screened_by');
    }
}
