<?php

namespace App\Livewire\Onboarding;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OnboardingDashboard extends Component
{
    public string $activeTab = 'active_cases'; // 'active_cases', 'checklist'
    public int $selectedCandidateId = 1;

    // In-memory onboarding candidate state for interactive checklist toggles
    public array $candidatesData = [
        1 => [
            'id' => 1,
            'name' => 'Ravi Wickramasinghe',
            'initials' => 'RW',
            'department' => 'Engineering',
            'startDate' => 'Aug 26, 2026',
            'buddy' => 'Dinesh Cooray',
            'tasks' => [
                ['id' => 1, 'text' => 'Send welcome email & system access credentials', 'completed' => true, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 2, 'text' => 'Laptop provisioned and configured', 'completed' => true, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 3, 'text' => 'Workday, Slack & GitHub accounts created', 'completed' => true, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 4, 'text' => 'Submit NDA and employment contract', 'completed' => true, 'dept' => 'Legal', 'deptColor' => 'bg-rose-50 text-rose-700'],
                ['id' => 5, 'text' => 'Collect ID and bank details for payroll', 'completed' => true, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 6, 'text' => 'Benefits enrollment completed', 'completed' => true, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 7, 'text' => 'Office tour and team introductions', 'completed' => true, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 8, 'text' => '30-day goal setting with manager', 'completed' => false, 'dept' => 'Manager', 'deptColor' => 'bg-amber-50 text-amber-800'],
                ['id' => 9, 'text' => 'Complete compliance & GDPR training', 'completed' => false, 'dept' => 'Legal', 'deptColor' => 'bg-rose-50 text-rose-700'],
                ['id' => 10, 'text' => 'Submit equipment acknowledgement form', 'completed' => false, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 11, 'text' => 'First-week check-in survey submitted', 'completed' => false, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
            ],
        ],
        2 => [
            'id' => 2,
            'name' => 'Dilani Mendes',
            'initials' => 'DM',
            'department' => 'Marketing',
            'startDate' => 'Sep 1, 2026',
            'buddy' => 'Nuwan Jayasuriya',
            'tasks' => [
                ['id' => 1, 'text' => 'Send welcome email & system access credentials', 'completed' => true, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 2, 'text' => 'Laptop provisioned and configured', 'completed' => true, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 3, 'text' => 'Workday, Slack & GitHub accounts created', 'completed' => false, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 4, 'text' => 'Submit NDA and employment contract', 'completed' => false, 'dept' => 'Legal', 'deptColor' => 'bg-rose-50 text-rose-700'],
                ['id' => 5, 'text' => 'Collect ID and bank details for payroll', 'completed' => false, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 6, 'text' => 'Benefits enrollment completed', 'completed' => false, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 7, 'text' => 'Office tour and team introductions', 'completed' => false, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 8, 'text' => '30-day goal setting with manager', 'completed' => false, 'dept' => 'Manager', 'deptColor' => 'bg-amber-50 text-amber-800'],
                ['id' => 9, 'text' => 'Complete compliance & GDPR training', 'completed' => false, 'dept' => 'Legal', 'deptColor' => 'bg-rose-50 text-rose-700'],
                ['id' => 10, 'text' => 'Submit equipment acknowledgement form', 'completed' => false, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 11, 'text' => 'First-week check-in survey submitted', 'completed' => false, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
            ],
        ],
        3 => [
            'id' => 3,
            'name' => 'Pathum Bandara',
            'initials' => 'PB',
            'department' => 'Finance',
            'startDate' => 'Sep 8, 2026',
            'buddy' => 'TBD',
            'tasks' => [
                ['id' => 1, 'text' => 'Send welcome email & system access credentials', 'completed' => false, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 2, 'text' => 'Laptop provisioned and configured', 'completed' => false, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 3, 'text' => 'Workday, Slack & GitHub accounts created', 'completed' => false, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 4, 'text' => 'Submit NDA and employment contract', 'completed' => false, 'dept' => 'Legal', 'deptColor' => 'bg-rose-50 text-rose-700'],
                ['id' => 5, 'text' => 'Collect ID and bank details for payroll', 'completed' => false, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 6, 'text' => 'Benefits enrollment completed', 'completed' => false, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 7, 'text' => 'Office tour and team introductions', 'completed' => false, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 8, 'text' => '30-day goal setting with manager', 'completed' => false, 'dept' => 'Manager', 'deptColor' => 'bg-amber-50 text-amber-800'],
                ['id' => 9, 'text' => 'Complete compliance & GDPR training', 'completed' => false, 'dept' => 'Legal', 'deptColor' => 'bg-rose-50 text-rose-700'],
                ['id' => 10, 'text' => 'Submit equipment acknowledgement form', 'completed' => false, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 11, 'text' => 'First-week check-in survey submitted', 'completed' => false, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
            ],
        ],
    ];

    public function mount()
    {
        $user = Auth::user();
        if ($user && $user->hasRole('Employee') && !$user->isAdmin() && !$user->hasAnyRole(['HR Senior', 'HR Manager', 'HR Junior', 'System Administrator', 'Company Administrator'])) {
            session()->flash('warning', 'Access restricted. The Onboarding Dashboard is available to Admin, HR Senior, and HR Junior accounts only.');
            return redirect()->to('/dashboard');
        }
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function selectCandidate(int $id): void
    {
        $this->selectedCandidateId = $id;
    }

    public function toggleTask(int $candidateId, int $taskId): void
    {
        if (isset($this->candidatesData[$candidateId])) {
            foreach ($this->candidatesData[$candidateId]['tasks'] as &$task) {
                if ($task['id'] === $taskId) {
                    $task['completed'] = !$task['completed'];
                    break;
                }
            }
        }
    }

    public function render()
    {
        $user = Auth::user() ?? User::first();
        $selectedCandidate = $this->candidatesData[$this->selectedCandidateId] ?? $this->candidatesData[1];

        // Compute progress ratios & percentages dynamically
        $candidatesList = collect($this->candidatesData)->map(function ($cand) {
            $total = count($cand['tasks']);
            $completed = collect($cand['tasks'])->where('completed', true)->count();
            $percentage = $total > 0 ? round(($completed / $total) * 100) : 0;
            $cand['completedCount'] = $completed;
            $cand['totalCount'] = $total;
            $cand['percentage'] = $percentage;
            return $cand;
        })->values();

        $selectedCandidateFull = collect($candidatesList)->firstWhere('id', $this->selectedCandidateId);

        return view('livewire.onboarding.onboarding-dashboard', [
            'user' => $user,
            'candidatesList' => $candidatesList,
            'selectedCandidate' => $selectedCandidateFull,
        ])->layout('components.layout.app', [
            'title' => 'Onboarding - CEYWork'
        ]);
    }
}
