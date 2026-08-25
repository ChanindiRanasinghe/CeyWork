<?php

namespace App\Livewire\Offboarding;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class OffboardingDashboard extends Component
{
    public int $selectedCaseId = 1;
    public bool $showExitInterviewModal = false;
    public bool $showFinalPayslipModal = false;
    public string $toastMessage = '';

    // Offboarding cases tailored with Sri Lankan employees & statutory requirements
    public array $casesData = [
        1 => [
            'id' => 1,
            'name' => 'Kavinda Perera',
            'initials' => 'KP',
            'department' => 'Sales',
            'reason' => 'Resignation',
            'lastDay' => 'Aug 31, 2026',
            'stage' => 'Asset Return',
            'checklist' => [
                ['id' => 1, 'title' => 'IT equipment & laptop returned', 'completed' => true, 'category' => 'IT'],
                ['id' => 2, 'title' => 'IT access & email revoked', 'completed' => true, 'category' => 'IT'],
                ['id' => 3, 'title' => 'EPF Form K & ETF Cessation notice submitted', 'completed' => true, 'category' => 'HR & Legal'],
                ['id' => 4, 'title' => 'Exit interview completed', 'completed' => true, 'category' => 'HR'],
                ['id' => 5, 'title' => 'Payment of Gratuity Act (1983) calculation', 'completed' => false, 'category' => 'Payroll'],
                ['id' => 6, 'title' => 'Finance & No-Dues clearance certificate issued', 'completed' => false, 'category' => 'Finance'],
                ['id' => 7, 'title' => 'Service certificate & B-Card released', 'completed' => false, 'category' => 'HR'],
            ],
        ],
        2 => [
            'id' => 2,
            'name' => 'Dilani Jayasinghe',
            'initials' => 'DJ',
            'department' => 'Operations',
            'reason' => 'End of Contract',
            'lastDay' => 'Sep 15, 2026',
            'stage' => 'Documentation',
            'checklist' => [
                ['id' => 1, 'title' => 'IT equipment & laptop returned', 'completed' => true, 'category' => 'IT'],
                ['id' => 2, 'title' => 'IT access & email revoked', 'completed' => false, 'category' => 'IT'],
                ['id' => 3, 'title' => 'EPF Form K & ETF Cessation notice submitted', 'completed' => false, 'category' => 'HR & Legal'],
                ['id' => 4, 'title' => 'Exit interview completed', 'completed' => false, 'category' => 'HR'],
                ['id' => 5, 'title' => 'Payment of Gratuity Act (1983) calculation', 'completed' => false, 'category' => 'Payroll'],
                ['id' => 6, 'title' => 'Finance & No-Dues clearance certificate issued', 'completed' => false, 'category' => 'Finance'],
                ['id' => 7, 'title' => 'Service certificate & B-Card released', 'completed' => false, 'category' => 'HR'],
            ],
        ],
        3 => [
            'id' => 3,
            'name' => 'Ruwan Fernando',
            'initials' => 'RF',
            'department' => 'Finance',
            'reason' => 'Retirement',
            'lastDay' => 'Sep 30, 2026',
            'stage' => 'EPF/ETF & Gratuity Clearance',
            'checklist' => [
                ['id' => 1, 'title' => 'IT equipment & laptop returned', 'completed' => true, 'category' => 'IT'],
                ['id' => 2, 'title' => 'IT access & email revoked', 'completed' => true, 'category' => 'IT'],
                ['id' => 3, 'title' => 'EPF Form K & ETF Cessation notice submitted', 'completed' => true, 'category' => 'HR & Legal'],
                ['id' => 4, 'title' => 'Exit interview completed', 'completed' => true, 'category' => 'HR'],
                ['id' => 5, 'title' => 'Payment of Gratuity Act (1983) calculation', 'completed' => true, 'category' => 'Payroll'],
                ['id' => 6, 'title' => 'Finance & No-Dues clearance certificate issued', 'completed' => false, 'category' => 'Finance'],
                ['id' => 7, 'title' => 'Service certificate & B-Card released', 'completed' => false, 'category' => 'HR'],
            ],
        ],
    ];

    public function mount()
    {
        $user = Auth::user();
        // Access Control: Restrict to HR & Admin personnel only. Regular employees cannot view offboarding.
        if ($user && $user->hasRole('Employee') && !$user->isAdmin() && !$user->hasPermissionTo('manage-offboarding') && !$user->hasAnyRole(['HR Senior', 'HR Manager', 'HR Junior', 'System Administrator', 'Company Administrator'])) {
            session()->flash('warning', 'Access restricted. The Offboarding page is visible only to authorized HR & Management personnel.');
            return redirect()->to('/dashboard');
        }
    }

    public function selectCase(int $id): void
    {
        $this->selectedCaseId = $id;
    }

    public function toggleChecklistItem(int $caseId, int $itemId): void
    {
        if (isset($this->casesData[$caseId])) {
            foreach ($this->casesData[$caseId]['checklist'] as &$item) {
                if ($item['id'] === $itemId) {
                    $item['completed'] = !$item['completed'];
                    break;
                }
            }
        }
    }

    public function openExitInterviewModal(): void
    {
        $this->showExitInterviewModal = true;
    }

    public function closeExitInterviewModal(): void
    {
        $this->showExitInterviewModal = false;
    }

    public function openFinalPayslipModal(): void
    {
        $this->showFinalPayslipModal = true;
    }

    public function closeFinalPayslipModal(): void
    {
        $this->showFinalPayslipModal = false;
    }

    public function render()
    {
        $user = Auth::user() ?? User::first();

        // Calculate clearance percentages dynamically for each case
        $casesList = collect($this->casesData)->map(function ($case) {
            $total = count($case['checklist']);
            $completed = collect($case['checklist'])->where('completed', true)->count();
            $percentage = $total > 0 ? round(($completed / $total) * 100) : 0;
            $case['completedCount'] = $completed;
            $case['totalCount'] = $total;
            $case['percentage'] = $percentage;
            return $case;
        })->values();

        $selectedCase = collect($casesList)->firstWhere('id', $this->selectedCaseId);

        return view('livewire.offboarding.offboarding-dashboard', [
            'user' => $user,
            'casesList' => $casesList,
            'selectedCase' => $selectedCase,
        ])->layout('components.layout.app', [
            'title' => 'Offboarding - CEYWork'
        ]);
    }
}
