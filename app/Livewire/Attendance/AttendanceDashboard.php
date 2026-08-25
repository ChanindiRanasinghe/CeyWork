<?php

namespace App\Livewire\Attendance;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AttendanceDashboard extends Component
{
    public string $activeTab = 'balances';
    public string $statusFilter = 'all';
    public string $searchQuery = '';
    public string $toastMessage = '';
    public bool $isManager = false;

    // Admin Edit Leave Balance Modal State
    public bool $showEditBalanceModal = false;
    public ?int $editingEmployeeId = null;
    public string $editingEmployeeName = '';
    public int $editAnnualRemaining = 0;
    public int $editCasualRemaining = 0;
    public int $editSickRemaining = 0;

    // Leave Balances for Sri Lankan Employees
    public array $employeeBalances = [
        [
            'id' => 1,
            'name' => 'Kasun Perera',
            'initials' => 'KP',
            'department' => 'Engineering',
            'designation' => 'Senior Software Engineer',
            'annualTotal' => 14,
            'annualTaken' => 5,
            'annualRemaining' => 9,
            'casualTotal' => 7,
            'casualTaken' => 3,
            'casualRemaining' => 4,
            'sickTotal' => 14,
            'sickTaken' => 2,
            'sickRemaining' => 12,
        ],
        [
            'id' => 2,
            'name' => 'Dilani Jayasinghe',
            'initials' => 'DJ',
            'department' => 'HR',
            'designation' => 'HR Executive',
            'annualTotal' => 14,
            'annualTaken' => 2,
            'annualRemaining' => 12,
            'casualTotal' => 7,
            'casualTaken' => 2,
            'casualRemaining' => 5,
            'sickTotal' => 14,
            'sickTaken' => 1,
            'sickRemaining' => 13,
        ],
        [
            'id' => 3,
            'name' => 'Tharindu Wickramasinghe',
            'initials' => 'TW',
            'department' => 'Operations',
            'designation' => 'Operations Lead',
            'annualTotal' => 14,
            'annualTaken' => 8,
            'annualRemaining' => 6,
            'casualTotal' => 7,
            'casualTaken' => 4,
            'casualRemaining' => 3,
            'sickTotal' => 14,
            'sickTaken' => 5,
            'sickRemaining' => 9,
        ],
        [
            'id' => 4,
            'name' => 'Nimmi Abeyrathne',
            'initials' => 'NA',
            'department' => 'Quality Assurance',
            'designation' => 'QA Specialist',
            'annualTotal' => 14,
            'annualTaken' => 1,
            'annualRemaining' => 13,
            'casualTotal' => 7,
            'casualTaken' => 1,
            'casualRemaining' => 6,
            'sickTotal' => 14,
            'sickTaken' => 0,
            'sickRemaining' => 14,
        ],
        [
            'id' => 5,
            'name' => 'Pathum Bandara',
            'initials' => 'PB',
            'department' => 'Finance',
            'designation' => 'Financial Accountant',
            'annualTotal' => 14,
            'annualTaken' => 6,
            'annualRemaining' => 8,
            'casualTotal' => 7,
            'casualTaken' => 5,
            'casualRemaining' => 2,
            'sickTotal' => 14,
            'sickTaken' => 3,
            'sickRemaining' => 11,
        ],
        [
            'id' => 6,
            'name' => 'Amara Jayawardena',
            'initials' => 'AJ',
            'department' => 'HR',
            'designation' => 'Head of HR',
            'annualTotal' => 14,
            'annualTaken' => 3,
            'annualRemaining' => 11,
            'casualTotal' => 7,
            'casualTaken' => 1,
            'casualRemaining' => 6,
            'sickTotal' => 14,
            'sickTaken' => 1,
            'sickRemaining' => 13,
        ],
    ];

    public array $leaveRequests = [
        1 => [
            'id' => 1,
            'name' => 'Kasun Perera',
            'initials' => 'KP',
            'department' => 'Engineering',
            'type' => 'Annual Leave',
            'period' => 'Aug 28 – Sep 1',
            'days' => 5,
            'status' => 'pending',
            'reason' => 'Family vacation to Nuwara Eliya',
            'appliedDate' => '2026-08-20',
        ],
        2 => [
            'id' => 2,
            'name' => 'Dilani Jayasinghe',
            'initials' => 'DJ',
            'department' => 'HR',
            'type' => 'Casual Leave',
            'period' => 'Aug 23 – Aug 24',
            'days' => 2,
            'status' => 'approved',
            'reason' => 'Personal urgent matter',
            'appliedDate' => '2026-08-19',
        ],
        3 => [
            'id' => 3,
            'name' => 'Tharindu Wickramasinghe',
            'initials' => 'TW',
            'department' => 'Operations',
            'type' => 'Sick Leave',
            'period' => 'Sep 10 – Sep 14',
            'days' => 5,
            'status' => 'pending',
            'reason' => 'Medical treatment & doctor advised rest',
            'appliedDate' => '2026-08-24',
        ],
        4 => [
            'id' => 4,
            'name' => 'Nimmi Abeyrathne',
            'initials' => 'NA',
            'department' => 'Quality Assurance',
            'type' => 'Maternity Leave',
            'period' => 'Aug 15 – Nov 15',
            'days' => 84,
            'status' => 'approved',
            'reason' => 'Maternity leave under Sri Lanka Shop & Office Act',
            'appliedDate' => '2026-08-01',
        ],
        5 => [
            'id' => 5,
            'name' => 'Pathum Bandara',
            'initials' => 'PB',
            'department' => 'Finance',
            'type' => 'Casual Leave',
            'period' => 'Aug 26 – Aug 26',
            'days' => 1,
            'status' => 'rejected',
            'reason' => 'Personal work',
            'appliedDate' => '2026-08-22',
        ],
        6 => [
            'id' => 6,
            'name' => 'Nuwan Cooray',
            'initials' => 'NC',
            'department' => 'UI/UX Design',
            'type' => 'Annual Leave',
            'period' => 'Sep 2 – Sep 5',
            'days' => 4,
            'status' => 'pending',
            'reason' => 'Annual leave entitlement usage',
            'appliedDate' => '2026-08-21',
        ],
    ];

    public array $dailyAttendance = [
        ['name' => 'Amara Jayawardena', 'dept' => 'HR', 'checkIn' => '08:25 AM', 'checkOut' => '05:30 PM', 'status' => 'On Time', 'workMode' => 'Office HQ'],
        ['name' => 'Kasun Perera', 'dept' => 'Engineering', 'checkIn' => '08:45 AM', 'checkOut' => '05:45 PM', 'status' => 'On Time', 'workMode' => 'Remote / WFH'],
        ['name' => 'Dilani Jayasinghe', 'dept' => 'HR', 'checkIn' => '09:12 AM', 'checkOut' => '06:00 PM', 'status' => 'Late (12 mins)', 'workMode' => 'Office HQ'],
        ['name' => 'Tharindu Wickramasinghe', 'dept' => 'Operations', 'checkIn' => '08:15 AM', 'checkOut' => '05:15 PM', 'status' => 'On Time', 'workMode' => 'Office HQ'],
        ['name' => 'Nimmi Abeyrathne', 'dept' => 'QA', 'checkIn' => '—', 'checkOut' => '—', 'status' => 'On Leave', 'workMode' => 'Maternity Leave'],
        ['name' => 'Pathum Bandara', 'dept' => 'Finance', 'checkIn' => '08:30 AM', 'checkOut' => '05:30 PM', 'status' => 'On Time', 'workMode' => 'Office HQ'],
    ];

    public function mount()
    {
        $user = Auth::user();
        if ($user && ($user->isAdmin() || $user->hasPermissionTo('manage-attendance') || $user->hasPermissionTo('approve-leave') || $user->hasAnyRole(['HR Senior', 'HR Manager', 'HR Junior', 'Department Manager', 'System Administrator', 'Company Administrator', 'Attendance/Leave Officer']))) {
            $this->isManager = true;
        } else {
            $this->isManager = false;
        }

        $this->activeTab = 'balances';
    }

    public function openEditBalanceModal(int $empId): void
    {
        foreach ($this->employeeBalances as $emp) {
            if ($emp['id'] === $empId) {
                $this->editingEmployeeId = $empId;
                $this->editingEmployeeName = $emp['name'];
                $this->editAnnualRemaining = $emp['annualRemaining'];
                $this->editCasualRemaining = $emp['casualRemaining'];
                $this->editSickRemaining = $emp['sickRemaining'];
                $this->showEditBalanceModal = true;
                break;
            }
        }
    }

    public function closeEditBalanceModal(): void
    {
        $this->showEditBalanceModal = false;
    }

    public function updateLeaveBalance(): void
    {
        foreach ($this->employeeBalances as &$emp) {
            if ($emp['id'] === $this->editingEmployeeId) {
                $emp['annualRemaining'] = $this->editAnnualRemaining;
                $emp['annualTaken'] = max(0, $emp['annualTotal'] - $this->editAnnualRemaining);
                $emp['casualRemaining'] = $this->editCasualRemaining;
                $emp['casualTaken'] = max(0, $emp['casualTotal'] - $this->editCasualRemaining);
                $emp['sickRemaining'] = $this->editSickRemaining;
                $emp['sickTaken'] = max(0, $emp['sickTotal'] - $this->editSickRemaining);
                break;
            }
        }

        $this->toastMessage = 'Leave balances updated for ' . $this->editingEmployeeName . ' by Admin.';
        $this->showEditBalanceModal = false;
    }

    public function setTab(string $tab): void
    {
        if (in_array($tab, ['requests', 'attendance']) && !$this->isManager) {
            return;
        }
        $this->activeTab = $tab;
    }

    public function setStatusFilter(string $filter): void
    {
        $this->statusFilter = $filter;
    }

    public function approveRequest(int $id): void
    {
        if (!$this->isManager) return;

        if (isset($this->leaveRequests[$id])) {
            $this->leaveRequests[$id]['status'] = 'approved';
            $this->toastMessage = 'Leave request for ' . $this->leaveRequests[$id]['name'] . ' approved successfully!';
        }
    }

    public function rejectRequest(int $id): void
    {
        if (!$this->isManager) return;

        if (isset($this->leaveRequests[$id])) {
            $this->leaveRequests[$id]['status'] = 'rejected';
            $this->toastMessage = 'Leave request for ' . $this->leaveRequests[$id]['name'] . ' rejected.';
        }
    }

    public function render()
    {
        $user = Auth::user() ?? User::first();

        $allRequests = collect($this->leaveRequests);
        $pendingCount = $allRequests->where('status', 'pending')->count();
        $approvedCount = $allRequests->where('status', 'approved')->count();
        $onLeaveTodayCount = 6;
        $attendanceRate = '94.2%';

        $filteredRequests = $allRequests->filter(function ($item) {
            if ($this->statusFilter === 'all') return true;
            return $item['status'] === $this->statusFilter;
        })->values();

        $filteredBalances = collect($this->employeeBalances)->filter(function ($emp) {
            if (empty($this->searchQuery)) return true;
            return str_contains(strtolower($emp['name']), strtolower($this->searchQuery)) ||
                   str_contains(strtolower($emp['department']), strtolower($this->searchQuery));
        })->values();

        return view('livewire.attendance.attendance-dashboard', [
            'user' => $user,
            'pendingCount' => $pendingCount,
            'approvedCount' => $approvedCount,
            'onLeaveTodayCount' => $onLeaveTodayCount,
            'attendanceRate' => $attendanceRate,
            'requestsList' => $filteredRequests,
            'balancesList' => $filteredBalances,
        ])->layout('components.layout.app', [
            'title' => 'Leave Balances & Attendance - CEYWork'
        ]);
    }
}
