<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EmployeeDashboard extends Component
{
    public bool $showPayslipModal = false;
    public bool $showDocumentsModal = false;
    public bool $showSupportModal = false;

    public function openPayslipModal(): void
    {
        $this->showPayslipModal = true;
    }

    public function closePayslipModal(): void
    {
        $this->showPayslipModal = false;
    }

    public function openDocumentsModal(): void
    {
        $this->showDocumentsModal = true;
    }

    public function closeDocumentsModal(): void
    {
        $this->showDocumentsModal = false;
    }

    public function openSupportModal(): void
    {
        $this->showSupportModal = true;
    }

    public function closeSupportModal(): void
    {
        $this->showSupportModal = false;
    }

    public function render()
    {
        $user = Auth::user() ?? User::first();

        // Sample data tailored for Kamal Peiris / Employee portal
        $employeeData = [
            'name' => $user?->name === 'System Administrator' ? 'Kamal Peiris' : ($user?->name ?? 'Kamal Peiris'),
            'initials' => 'KP',
            'designation' => 'Senior Software Engineer · Engineering',
            'leaveBalance' => '12d',
            'nextPayslip' => 'Aug 30',
            'kpiScore' => '4.8/5',
            'tenure' => '5.5 yrs',
        ];

        $upcomingEvents = [
            [
                'title' => 'Q3 Performance Review',
                'date' => 'Sep 15, 2026',
                'category' => 'Performance',
                'icon' => 'calendar',
            ],
            [
                'title' => 'GDPR Training Deadline',
                'date' => 'Sep 30, 2026',
                'category' => 'Training',
                'icon' => 'calendar',
            ],
            [
                'title' => 'Annual Leave Cutoff',
                'date' => 'Dec 31, 2026',
                'category' => 'Leave',
                'icon' => 'calendar',
            ],
        ];

        $trainingProgress = [
            ['title' => 'GDPR Compliance Fundamentals', 'percentage' => 81],
            ['title' => 'Advanced Leadership Skills', 'percentage' => 38],
            ['title' => 'Agile & Scrum Certification', 'percentage' => 84],
        ];

        return view('livewire.dashboard.employee-dashboard', [
            'user' => $user,
            'employee' => $employeeData,
            'upcomingEvents' => $upcomingEvents,
            'trainingProgress' => $trainingProgress,
        ])->layout('components.layout.app', [
            'title' => 'Employee Dashboard - CEYWork'
        ]);
    }
}
