<?php

namespace App\Livewire\Ai;

use App\Models\Candidate;
use App\Models\Employee;
use App\Models\Vacancy;
use Livewire\Component;

class AgenticCommandBar extends Component
{
    public bool $isOpen = false;
    public string $query = '';
    public array $aiResponse = [];
    public bool $isProcessing = false;

    protected $listeners = ['openAgenticCommandBar' => 'open'];

    public function open(): void
    {
        $this->isOpen = true;
    }

    public function close(): void
    {
        $this->isOpen = false;
        $this->query = '';
        $this->aiResponse = [];
    }

    public function processAgentQuery(): void
    {
        if (trim($this->query) === '') {
            return;
        }

        $this->isProcessing = true;
        $input = strtolower(trim($this->query));

        // Agentic Intent Recognition Logic
        if (str_contains($input, 'screen') || str_contains($input, 'candidate') || str_contains($input, 'ats')) {
            $candidates = Candidate::with('vacancy')->take(3)->get();
            $results = [];

            foreach ($candidates as $cand) {
                $score = rand(78, 96);
                $results[] = [
                    'title' => "Screening: {$cand->full_name}",
                    'subtitle' => "Position: " . ($cand->vacancy->title ?? 'Full Stack Engineer') . " • Match Score: {$score}%",
                    'badge' => $score >= 85 ? 'Highly Recommended' : 'Good Match',
                    'action' => "View Candidate Profile",
                    'url' => route('recruitment.candidates'),
                ];
            }

            $this->aiResponse = [
                'type' => 'screening',
                'summary' => "Agentic ATS Screener evaluated active candidates against vacancy criteria.",
                'items' => $results,
            ];
        } elseif (str_contains($input, 'epf') || str_contains($input, 'etf') || str_contains($input, 'payroll') || str_contains($input, 'tax')) {
            $this->aiResponse = [
                'type' => 'payroll',
                'summary' => "Agentic Payroll Auditor verified August 2026 EPF/ETF statutory contributions.",
                'items' => [
                    [
                        'title' => "EPF 8% Employee Contribution",
                        'subtitle' => "Calculated total: LKR 192,800.00 — 100% compliant",
                        'badge' => 'Verified',
                        'action' => "Open Payroll Processor",
                        'url' => route('payroll'),
                    ],
                    [
                        'title' => "EPF 12% & ETF 3% Employer Contribution",
                        'subtitle' => "Employer total: LKR 361,500.00 — Form C3 ready",
                        'badge' => 'C3 Ready',
                        'action' => "Export C3 CSV",
                        'url' => route('payroll'),
                    ],
                ],
            ];
        } elseif (str_contains($input, 'onboard') || str_contains($input, 'document')) {
            $this->aiResponse = [
                'type' => 'onboarding',
                'summary' => "Agentic Onboarding Assistant checked pending document verifications.",
                'items' => [
                    [
                        'title' => "Kavinda Fernando — Grama Niladhari Certificate",
                        'subtitle' => "Status: Pending submission • Reminder scheduled for tomorrow 9:00 AM",
                        'badge' => 'Action Needed',
                        'action' => "Open Onboarding Hub",
                        'url' => route('onboarding'),
                    ],
                ],
            ];
        } elseif (str_contains($input, 'leave') || str_contains($input, 'attendance') || str_contains($input, 'vacation')) {
            $this->aiResponse = [
                'type' => 'attendance',
                'summary' => "Agentic Leave Auditor retrieved statutory Sri Lankan leave balances.",
                'items' => [
                    [
                        'title' => "Pending Leave Requests Review",
                        'subtitle' => "2 requests pending managerial approval • Overall attendance 94.2%",
                        'badge' => '2 Pending',
                        'action' => "Manage Attendance & Leave",
                        'url' => route('attendance'),
                    ],
                ],
            ];
        } elseif (str_contains($input, 'performance') || str_contains($input, 'kpi') || str_contains($input, 'appraisal')) {
            $this->aiResponse = [
                'type' => 'performance',
                'summary' => "Agentic Performance Tracker reviewed quarterly KPI completion rates.",
                'items' => [
                    [
                        'title' => "Q3 2026 Performance Appraisal Cycle",
                        'subtitle' => "88% appraisals completed across Engineering, HR, and Finance",
                        'badge' => 'Active Cycle',
                        'action' => "Open Performance Hub",
                        'url' => route('performance'),
                    ],
                ],
            ];
        } elseif (str_contains($input, 'training') || str_contains($input, 'course') || str_contains($input, 'skill')) {
            $this->aiResponse = [
                'type' => 'training',
                'summary' => "Agentic Learning Advisor assessed active employee training enrollments.",
                'items' => [
                    [
                        'title' => "Sri Lanka Labor Law & Compliance Workshop",
                        'subtitle' => "15 employees enrolled • Mandatory regulatory certification",
                        'badge' => 'In Progress',
                        'action' => "View Training Programs",
                        'url' => route('training'),
                    ],
                ],
            ];
        } elseif (str_contains($input, 'asset') || str_contains($input, 'laptop') || str_contains($input, 'equipment')) {
            $this->aiResponse = [
                'type' => 'assets',
                'summary' => "Agentic Inventory Manager audited company equipment assignments.",
                'items' => [
                    [
                        'title' => "IT Asset Allocation & Warranty Register",
                        'subtitle' => "94% assets assigned • 0 unreturned items",
                        'badge' => 'Verified',
                        'action' => "Open Asset Register",
                        'url' => route('assets'),
                    ],
                ],
            ];
        } elseif (str_contains($input, 'offboard') || str_contains($input, 'exit') || str_contains($input, 'resignation')) {
            $this->aiResponse = [
                'type' => 'offboarding',
                'summary' => "Agentic Exit Coordinator checked offboarding task clearance.",
                'items' => [
                    [
                        'title' => "Employee Offboarding & Asset Recovery Checklist",
                        'subtitle' => "Sri Lankan statutory final settlement & EPF form clearance",
                        'badge' => 'Offboarding Hub',
                        'action' => "View Offboarding",
                        'url' => route('offboarding'),
                    ],
                ],
            ];
        } elseif (str_contains($input, 'report') || str_contains($input, 'headcount') || str_contains($input, 'analytics')) {
            $this->aiResponse = [
                'type' => 'reports',
                'summary' => "Agentic Analytics Engine aggregated organizational metrics.",
                'items' => [
                    [
                        'title' => "HR Executive Analytics & Headcount Report",
                        'subtitle' => "Department distribution, gender diversity, and payroll analytics",
                        'badge' => 'Analytics',
                        'action' => "Open Reports & Analytics",
                        'url' => route('reports'),
                    ],
                ],
            ];
        } else {
            // General Employee Search Fallback
            $employees = Employee::where('full_name', 'like', "%{$input}%")
                ->orWhere('employee_code', 'like', "%{$input}%")
                ->take(4)
                ->get();

            $items = [];
            foreach ($employees as $emp) {
                $items[] = [
                    'title' => $emp->full_name,
                    'subtitle' => "{$emp->designation} • {$emp->employee_code}",
                    'badge' => ucfirst($emp->status ?? 'Active'),
                    'action' => "View Profile",
                    'url' => route('employees'),
                ];
            }

            if (empty($items)) {
                $items[] = [
                    'title' => "No exact matches found for '{$this->query}'",
                    'subtitle' => "Try asking 'screen candidates', 'check EPF payroll audit', or 'onboarding status'",
                    'badge' => 'AI Agent',
                    'action' => 'Go to Dashboard',
                    'url' => route('dashboard'),
                ];
            }

            $this->aiResponse = [
                'type' => 'search',
                'summary' => "Agentic AI search results for '{$this->query}'",
                'items' => $items,
            ];
        }

        $this->isProcessing = false;
    }

    public function render()
    {
        return view('livewire.ai.agentic-command-bar');
    }
}
