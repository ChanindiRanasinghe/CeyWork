<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'vacancy_id',
        'full_name',
        'email',
        'phone',
        'nic_passport',
        'cv_path',
        'source',
        'status',
        'experience_summary',
    ];

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }

    public function screeningRecords()
    {
        return $this->hasMany(ScreeningRecord::class);
    }

    public function interviews()
    {
        return $this->hasMany(Interview::class);
    }

    public function jobOffers()
    {
        return $this->hasMany(JobOffer::class);
    }

    public function onboardingTasks()
    {
        return $this->hasMany(OnboardingTask::class);
    }
}
