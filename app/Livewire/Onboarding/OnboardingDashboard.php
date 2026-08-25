<?php

namespace App\Livewire\Onboarding;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OnboardingDashboard extends Component
{
    public string $activeTab = 'active_cases'; // 'active_cases', 'checklist', 'documents'
    public int $selectedCandidateId = 1;

    // In-memory onboarding candidate state with Sri Lankan statutory document verification
    public array $candidatesData = [
        1 => [
            'id' => 1,
            'name' => 'Ravi Wickramasinghe',
            'initials' => 'RW',
            'department' => 'Engineering',
            'startDate' => 'Aug 26, 2026',
            'buddy' => 'Dinesh Cooray',
            'documents' => [
                ['id' => 1, 'name' => 'Police Report (Police Clearance Certificate)', 'status' => 'Verified', 'required' => true],
                ['id' => 2, 'name' => 'Grama Niladhari Report (Grama Sevaka Certificate)', 'status' => 'Verified', 'required' => true],
                ['id' => 3, 'name' => 'School Leaving Certificate', 'status' => 'Verified', 'required' => true],
                ['id' => 4, 'name' => 'Character Certificate', 'status' => 'Verified', 'required' => true],
                ['id' => 5, 'name' => 'NIC Copy (National Identity Card / Passport)', 'status' => 'Verified', 'required' => true],
                ['id' => 6, 'name' => 'Service Letters (Previous Employers)', 'status' => 'Verified', 'required' => false],
                ['id' => 7, 'name' => 'G.C.E. A/L & O/L Educational Certificates', 'status' => 'Pending Verification', 'required' => true],
            ],
            'tasks' => [
                ['id' => 1, 'text' => 'Verify NIC Copy & National Identity Card', 'completed' => true, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 2, 'text' => 'Collect Police Report (Clearance Certificate)', 'completed' => true, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 3, 'text' => 'Collect Grama Niladhari (Grama Sevaka) Certificate', 'completed' => true, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 4, 'text' => 'Verify School Leaving Certificate & Character Certificate', 'completed' => true, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 5, 'text' => 'Verify G.C.E. A/L & O/L Educational Certificates', 'completed' => false, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 6, 'text' => 'Collect Service Letters from previous employers', 'completed' => true, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 7, 'text' => 'Send welcome email & system access credentials', 'completed' => true, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 8, 'text' => 'Laptop provisioned and configured', 'completed' => true, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 9, 'text' => 'Workday, Slack & GitHub accounts created', 'completed' => true, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 10, 'text' => 'Submit NDA and employment contract', 'completed' => true, 'dept' => 'Legal', 'deptColor' => 'bg-rose-50 text-rose-700'],
                ['id' => 11, 'text' => '30-day goal setting with manager', 'completed' => false, 'dept' => 'Manager', 'deptColor' => 'bg-amber-50 text-amber-800'],
            ],
        ],
        2 => [
            'id' => 2,
            'name' => 'Dilani Mendes',
            'initials' => 'DM',
            'department' => 'Marketing',
            'startDate' => 'Sep 1, 2026',
            'buddy' => 'Nuwan Jayasuriya',
            'documents' => [
                ['id' => 1, 'name' => 'Police Report (Police Clearance Certificate)', 'status' => 'Pending Upload', 'required' => true],
                ['id' => 2, 'name' => 'Grama Niladhari Report (Grama Sevaka Certificate)', 'status' => 'Verified', 'required' => true],
                ['id' => 3, 'name' => 'School Leaving Certificate', 'status' => 'Verified', 'required' => true],
                ['id' => 4, 'name' => 'Character Certificate', 'status' => 'Verified', 'required' => true],
                ['id' => 5, 'name' => 'NIC Copy (National Identity Card / Passport)', 'status' => 'Verified', 'required' => true],
                ['id' => 6, 'name' => 'Service Letters (Previous Employers)', 'status' => 'Submitted', 'required' => false],
                ['id' => 7, 'name' => 'G.C.E. A/L & O/L Educational Certificates', 'status' => 'Verified', 'required' => true],
            ],
            'tasks' => [
                ['id' => 1, 'text' => 'Verify NIC Copy & National Identity Card', 'completed' => true, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 2, 'text' => 'Collect Police Report (Clearance Certificate)', 'completed' => false, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 3, 'text' => 'Collect Grama Niladhari (Grama Sevaka) Certificate', 'completed' => true, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 4, 'text' => 'Verify School Leaving Certificate & Character Certificate', 'completed' => true, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 5, 'text' => 'Verify G.C.E. A/L & O/L Educational Certificates', 'completed' => true, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 6, 'text' => 'Collect Service Letters from previous employers', 'completed' => false, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 7, 'text' => 'Send welcome email & system access credentials', 'completed' => true, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 8, 'text' => 'Laptop provisioned and configured', 'completed' => true, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 9, 'text' => 'Workday, Slack & GitHub accounts created', 'completed' => false, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 10, 'text' => 'Submit NDA and employment contract', 'completed' => false, 'dept' => 'Legal', 'deptColor' => 'bg-rose-50 text-rose-700'],
                ['id' => 11, 'text' => '30-day goal setting with manager', 'completed' => false, 'dept' => 'Manager', 'deptColor' => 'bg-amber-50 text-amber-800'],
            ],
        ],
        3 => [
            'id' => 3,
            'name' => 'Pathum Bandara',
            'initials' => 'PB',
            'department' => 'Finance',
            'startDate' => 'Sep 8, 2026',
            'buddy' => 'TBD',
            'documents' => [
                ['id' => 1, 'name' => 'Police Report (Police Clearance Certificate)', 'status' => 'Pending Upload', 'required' => true],
                ['id' => 2, 'name' => 'Grama Niladhari Report (Grama Sevaka Certificate)', 'status' => 'Pending Upload', 'required' => true],
                ['id' => 3, 'name' => 'School Leaving Certificate', 'status' => 'Submitted', 'required' => true],
                ['id' => 4, 'name' => 'Character Certificate', 'status' => 'Submitted', 'required' => true],
                ['id' => 5, 'name' => 'NIC Copy (National Identity Card / Passport)', 'status' => 'Verified', 'required' => true],
                ['id' => 6, 'name' => 'Service Letters (Previous Employers)', 'status' => 'Submitted', 'required' => false],
                ['id' => 7, 'name' => 'G.C.E. A/L & O/L Educational Certificates', 'status' => 'Submitted', 'required' => true],
            ],
            'tasks' => [
                ['id' => 1, 'text' => 'Verify NIC Copy & National Identity Card', 'completed' => true, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 2, 'text' => 'Collect Police Report (Clearance Certificate)', 'completed' => false, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 3, 'text' => 'Collect Grama Niladhari (Grama Sevaka) Certificate', 'completed' => false, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 4, 'text' => 'Verify School Leaving Certificate & Character Certificate', 'completed' => false, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 5, 'text' => 'Verify G.C.E. A/L & O/L Educational Certificates', 'completed' => false, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 6, 'text' => 'Collect Service Letters from previous employers', 'completed' => false, 'dept' => 'HR', 'deptColor' => 'bg-purple-50 text-purple-700'],
                ['id' => 7, 'text' => 'Send welcome email & system access credentials', 'completed' => false, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 8, 'text' => 'Laptop provisioned and configured', 'completed' => false, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 9, 'text' => 'Workday, Slack & GitHub accounts created', 'completed' => false, 'dept' => 'IT', 'deptColor' => 'bg-blue-50 text-blue-700'],
                ['id' => 10, 'text' => 'Submit NDA and employment contract', 'completed' => false, 'dept' => 'Legal', 'deptColor' => 'bg-rose-50 text-rose-700'],
                ['id' => 11, 'text' => '30-day goal setting with manager', 'completed' => false, 'dept' => 'Manager', 'deptColor' => 'bg-amber-50 text-amber-800'],
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

    public function toggleDocStatus(int $candidateId, int $docId): void
    {
        if (isset($this->candidatesData[$candidateId]['documents'])) {
            foreach ($this->candidatesData[$candidateId]['documents'] as &$doc) {
                if ($doc['id'] === $docId) {
                    $doc['status'] = $doc['status'] === 'Verified' ? 'Pending Upload' : 'Verified';
                    break;
                }
            }
        }
    }

    public function render()
    {
        $user = Auth::user() ?? User::first();
        $selectedCandidate = $this->candidatesData[$this->selectedCandidateId] ?? $this->candidatesData[1];

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
            'title' => 'Sri Lankan Onboarding & Document Verification - CEYWork'
        ]);
    }
}
