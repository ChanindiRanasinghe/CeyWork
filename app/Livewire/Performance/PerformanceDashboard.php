<?php

namespace App\Livewire\Performance;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PerformanceDashboard extends Component
{
    public string $activeTab = 'kpis'; // 'kpis', 'evaluations'

    public array $kpisData = [];
    public array $evaluationsData = [];

    // Admin Edit KPI Modal State
    public bool $showEditKpiModal = false;
    public ?int $editingKpiId = null;
    public string $editTitle = '';
    public string $editDepartment = 'Sales';
    public string $editStatus = 'on-track';
    public string $editActual = '87%';
    public string $editTarget = '90%';
    public int $editPercentage = 97;
    public string $editTrend = 'up';
    public ?string $successMessage = null;

    public function mount()
    {
        $this->kpisData = [
            [
                'id' => 1,
                'title' => 'Customer Satisfaction',
                'department' => 'Sales',
                'status' => 'on-track',
                'statusLabel' => 'on-track',
                'statusClass' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                'actual' => '87%',
                'target' => '90%',
                'percentage' => 97,
                'progressColor' => 'bg-[#b91c1c]',
                'targetFootnote' => '97% of target',
                'trend' => 'up',
                'trendColor' => 'text-emerald-600',
            ],
            [
                'id' => 2,
                'title' => 'Code Review Turnaround',
                'department' => 'Engineering',
                'status' => 'exceeded',
                'statusLabel' => 'exceeded',
                'statusClass' => 'bg-sky-50 text-sky-700 border-sky-200',
                'actual' => '18hrs',
                'target' => '24hrs',
                'percentage' => 100,
                'progressColor' => 'bg-emerald-500',
                'targetFootnote' => '100% of target',
                'trend' => 'up',
                'trendColor' => 'text-emerald-600',
            ],
            [
                'id' => 3,
                'title' => 'Monthly Recurring Rev',
                'department' => 'Sales',
                'status' => 'at-risk',
                'statusLabel' => 'at-risk',
                'statusClass' => 'bg-rose-50 text-rose-700 border-rose-200',
                'actual' => '143K',
                'target' => '200K',
                'percentage' => 72,
                'progressColor' => 'bg-rose-500',
                'targetFootnote' => '72% of target',
                'trend' => 'down',
                'trendColor' => 'text-rose-600',
            ],
            [
                'id' => 4,
                'title' => 'Production Bug Rate',
                'department' => 'Engineering',
                'status' => 'exceeded',
                'statusLabel' => 'exceeded',
                'statusClass' => 'bg-sky-50 text-sky-700 border-sky-200',
                'actual' => '0.8%',
                'target' => '1.5%',
                'percentage' => 100,
                'progressColor' => 'bg-emerald-500',
                'targetFootnote' => '100% of target',
                'trend' => 'up',
                'trendColor' => 'text-emerald-600',
            ],
            [
                'id' => 5,
                'title' => 'Employee Engagement',
                'department' => 'HR',
                'status' => 'on-track',
                'statusLabel' => 'on-track',
                'statusClass' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                'actual' => '76%',
                'target' => '78%',
                'percentage' => 97,
                'progressColor' => 'bg-[#b91c1c]',
                'targetFootnote' => '97% of target',
                'trend' => 'up',
                'trendColor' => 'text-emerald-600',
            ],
            [
                'id' => 6,
                'title' => 'Time-to-Hire',
                'department' => 'HR',
                'status' => 'at-risk',
                'statusLabel' => 'at-risk',
                'statusClass' => 'bg-rose-50 text-rose-700 border-rose-200',
                'actual' => '38d',
                'target' => '30d',
                'percentage' => 100,
                'progressColor' => 'bg-rose-500',
                'targetFootnote' => '100% of target',
                'trend' => 'down',
                'trendColor' => 'text-rose-600',
            ],
        ];

        $this->evaluationsData = [
            [
                'id' => 1,
                'employee' => 'Kamal Peiris',
                'role' => 'Senior Software Engineer',
                'department' => 'Engineering',
                'period' => 'Q3 2026',
                'selfRating' => '4.8 / 5.0',
                'managerRating' => '4.9 / 5.0',
                'status' => 'Completed',
                'statusClass' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            ],
            [
                'id' => 2,
                'employee' => 'Dilani Jayasinghe',
                'role' => 'Senior HR Specialist',
                'department' => 'HR',
                'period' => 'Q3 2026',
                'selfRating' => '4.6 / 5.0',
                'managerRating' => '4.7 / 5.0',
                'status' => 'Completed',
                'statusClass' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            ],
            [
                'id' => 3,
                'employee' => 'Kavinda Perera',
                'role' => 'Marketing Specialist',
                'department' => 'Marketing',
                'period' => 'Q3 2026',
                'selfRating' => '4.2 / 5.0',
                'managerRating' => '4.0 / 5.0',
                'status' => 'In Review',
                'statusClass' => 'bg-amber-50 text-amber-800 border-amber-200',
            ],
            [
                'id' => 4,
                'employee' => 'Ruwan Fernando',
                'role' => 'Financial Analyst',
                'department' => 'Finance',
                'period' => 'Q3 2026',
                'selfRating' => '4.5 / 5.0',
                'managerRating' => 'Pending',
                'status' => 'Pending Manager Review',
                'statusClass' => 'bg-sky-50 text-sky-700 border-sky-200',
            ],
        ];
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function openEditKpiModal(int $kpiId): void
    {
        foreach ($this->kpisData as $kpi) {
            if ($kpi['id'] === $kpiId) {
                $this->editingKpiId = $kpiId;
                $this->editTitle = $kpi['title'];
                $this->editDepartment = $kpi['department'];
                $this->editStatus = $kpi['status'];
                $this->editActual = $kpi['actual'];
                $this->editTarget = $kpi['target'];
                $this->editPercentage = $kpi['percentage'];
                $this->editTrend = $kpi['trend'];
                $this->showEditKpiModal = true;
                break;
            }
        }
    }

    public function closeEditKpiModal(): void
    {
        $this->showEditKpiModal = false;
    }

    public function updateKpi(): void
    {
        $this->validate([
            'editTitle' => 'required|min:3|max:100',
            'editActual' => 'required',
            'editTarget' => 'required',
        ]);

        foreach ($this->kpisData as &$kpi) {
            if ($kpi['id'] === $this->editingKpiId) {
                $kpi['title'] = $this->editTitle;
                $kpi['department'] = $this->editDepartment;
                $kpi['status'] = $this->editStatus;
                $kpi['statusLabel'] = $this->editStatus;
                $kpi['actual'] = $this->editActual;
                $kpi['target'] = $this->editTarget;
                $kpi['percentage'] = $this->editPercentage;
                $kpi['trend'] = $this->editTrend;
                $kpi['targetFootnote'] = $this->editPercentage . '% of target';

                if ($this->editStatus === 'on-track') {
                    $kpi['statusClass'] = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                    $kpi['progressColor'] = 'bg-[#b91c1c]';
                    $kpi['trendColor'] = 'text-emerald-600';
                } elseif ($this->editStatus === 'exceeded') {
                    $kpi['statusClass'] = 'bg-sky-50 text-sky-700 border-sky-200';
                    $kpi['progressColor'] = 'bg-emerald-500';
                    $kpi['trendColor'] = 'text-emerald-600';
                } else {
                    $kpi['statusClass'] = 'bg-rose-50 text-rose-700 border-rose-200';
                    $kpi['progressColor'] = 'bg-rose-500';
                    $kpi['trendColor'] = 'text-rose-600';
                }
                break;
            }
        }

        $this->successMessage = 'KPI "' . $this->editTitle . '" updated successfully by Admin!';
        $this->showEditKpiModal = false;
    }

    public function dismissSuccessMessage(): void
    {
        $this->successMessage = null;
    }

    public function render()
    {
        $user = Auth::user() ?? User::first();
        $canEditPerformance = $user && ($user->isAdmin() || $user->hasAnyRole(['System Administrator', 'Company Administrator', 'HR Senior', 'HR Manager']));

        return view('livewire.performance.performance-dashboard', [
            'user' => $user,
            'kpisData' => $this->kpisData,
            'evaluationsData' => $this->evaluationsData,
            'canEditPerformance' => $canEditPerformance,
        ])->layout('components.layout.app', [
            'title' => 'Performance Management - CEYWork'
        ]);
    }
}
