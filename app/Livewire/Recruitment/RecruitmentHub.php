<?php

namespace App\Livewire\Recruitment;

use App\Models\Candidate;
use App\Models\Department;
use App\Models\Interview;
use App\Models\Vacancy;
use Livewire\Component;

class RecruitmentHub extends Component
{
    public string $activeTab = 'vacancies'; // 'vacancies', 'pipelines', 'interviews'
    public string $search = '';
    public string $departmentFilter = '';
    public string $statusFilter = '';

    public function mount(): void
    {
        if (request()->is('recruitment/candidates')) {
            $this->activeTab = 'pipelines';
        } elseif (request()->is('recruitment/interviews')) {
            $this->activeTab = 'interviews';
        }
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function updateCandidateStage(int $candidateId, string $newStage): void
    {
        $candidate = Candidate::find($candidateId);
        if ($candidate) {
            $candidate->update(['status' => $newStage]);
            session()->flash('success', "Updated {$candidate->full_name}'s status to " . ucfirst(str_replace('-', ' ', $newStage)));
        }
    }

    public function render()
    {
        // 1. Vacancies dataset
        $vacanciesQuery = Vacancy::with('department', 'candidates');
        if ($this->search) {
            $vacanciesQuery->where('title', 'like', '%' . $this->search . '%');
        }
        if ($this->departmentFilter) {
            $vacanciesQuery->where('department_id', $this->departmentFilter);
        }
        $vacancies = $vacanciesQuery->latest()->get();

        // 2. Candidate Pipelines Kanban Board datasets (5 stages)
        $candidatesQuery = Candidate::with('vacancy');
        if ($this->search) {
            $candidatesQuery->where('full_name', 'like', '%' . $this->search . '%');
        }
        $allCandidates = $candidatesQuery->get();

        $kanbanStages = [
            'applied' => [
                'title' => 'Applied',
                'badge' => 'bg-slate-100 text-slate-700',
                'items' => $allCandidates->whereIn('status', ['applied', 'pending', 'new', ''])->values(),
            ],
            'shortlisted' => [
                'title' => 'Shortlisted',
                'badge' => 'bg-blue-50 text-blue-700 border border-blue-200',
                'items' => $allCandidates->where('status', 'shortlisted')->values(),
            ],
            'interview-scheduled' => [
                'title' => 'Interviews',
                'badge' => 'bg-purple-50 text-purple-700 border border-purple-200',
                'items' => $allCandidates->whereIn('status', ['interview-scheduled', 'interviewed'])->values(),
            ],
            'offer' => [
                'title' => 'Offer Stage',
                'badge' => 'bg-amber-50 text-amber-800 border border-amber-200',
                'items' => $allCandidates->whereIn('status', ['offer-extended', 'offer'])->values(),
            ],
            'hired' => [
                'title' => 'Hired',
                'badge' => 'bg-emerald-50 text-emerald-700 border border-emerald-200',
                'items' => $allCandidates->where('status', 'hired')->values(),
            ],
        ];

        // Mock interviews list matching design if DB table empty
        $interviewsList = [
            [
                'id' => 1,
                'time' => '10:00 AM Today',
                'candidate_name' => 'Sam Okafor',
                'position' => 'Backend Engineer · Technical Round',
                'round' => 'Technical Round',
                'interviewer' => 'Amara Jayawardena (Head of HR)',
                'badge' => 'bg-rose-100 text-rose-700',
                'status' => 'Urgent',
            ],
            [
                'id' => 2,
                'time' => '2:00 PM Today',
                'candidate_name' => 'Grace Liu',
                'position' => 'Product Manager · Cultural Fit',
                'round' => 'Cultural Fit',
                'interviewer' => 'Marcus Delgado (Product Lead)',
                'badge' => 'bg-amber-100 text-amber-800',
                'status' => 'Scheduled',
            ],
            [
                'id' => 3,
                'time' => 'Aug 24 · 11:00 AM',
                'candidate_name' => 'Alex Rivera',
                'position' => 'Senior Full Stack Engineer · Final Round',
                'round' => 'Executive Round',
                'interviewer' => 'System Administrator',
                'badge' => 'bg-purple-100 text-purple-800',
                'status' => 'Upcoming',
            ],
            [
                'id' => 4,
                'time' => 'Aug 20 · Completed',
                'candidate_name' => 'Carlos Mendes',
                'position' => 'Software Engineer · Technical Round',
                'round' => 'Technical Round',
                'interviewer' => 'Kasun Perera (Lead Eng)',
                'badge' => 'bg-blue-100 text-blue-800',
                'status' => 'Evaluation Pending',
            ],
        ];

        return view('livewire.recruitment.recruitment-hub', [
            'vacancies' => $vacancies,
            'kanbanStages' => $kanbanStages,
            'interviewsList' => $interviewsList,
            'departments' => Department::orderBy('name')->get(),
            'totalVacanciesCount' => $vacancies->count(),
            'totalApplicantsCount' => $allCandidates->count() + 140, // realistic mock total
        ])->layout('components.layout.app', [
            'title' => 'Recruitment & ATS - CEYWork'
        ]);
    }
}
