<?php

namespace App\Livewire\Recruitment;

use App\Models\Department;
use App\Models\Vacancy;
use Livewire\Component;

class VacancyManager extends Component
{
    public bool $showModal = false;

    public string $title = '';
    public string $department_id = '';
    public string $openings_count = '1';
    public string $employment_type = 'full-time';
    public string $closing_date = '';
    public string $description = '';
    public string $requirements = '';

    protected $rules = [
        'title' => 'required|string|max:150',
        'department_id' => 'required|exists:departments,id',
        'openings_count' => 'required|integer|min:1',
        'employment_type' => 'required|in:full-time,part-time,contract,intern',
        'description' => 'required|string',
    ];

    public function createVacancy()
    {
        $this->validate();

        Vacancy::create([
            'company_id' => auth()->user()->company_id ?? 1,
            'department_id' => $this->department_id,
            'hiring_manager_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description,
            'requirements' => $this->requirements,
            'openings_count' => $this->openings_count,
            'employment_type' => $this->employment_type,
            'closing_date' => $this->closing_date ?: null,
            'status' => 'open',
        ]);

        $this->reset(['title', 'department_id', 'openings_count', 'description', 'requirements', 'closing_date', 'showModal']);
        session()->flash('message', 'Job Vacancy published successfully.');
    }

    public function render()
    {
        $vacancies = Vacancy::with(['department', 'candidates'])->withCount('candidates')->latest()->get();
        $departments = Department::all();

        return view('livewire.recruitment.vacancy-manager', [
            'vacancies' => $vacancies,
            'departments' => $departments,
        ])->layout('components.layout.app', [
            'title' => 'Job Vacancies - CEYWork ATS'
        ]);
    }
}
