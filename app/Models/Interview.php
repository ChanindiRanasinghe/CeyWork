<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    protected $fillable = [
        'candidate_id',
        'interviewer_id',
        'interview_type',
        'scheduled_at',
        'location_link',
        'status',
        'feedback',
        'rating',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function interviewer()
    {
        return $this->belongsTo(User::class, 'interviewer_id');
    }
}
