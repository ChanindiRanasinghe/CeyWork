<?php

namespace App\Livewire\Dashboard;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Livewire\Component;

class HRDashboard extends Component
{
    public function render()
    {
        $user = auth()->user() ?? User::first();
        
        $totalEmployees = Employee::count();
        $activeEmployees = Employee::where('status', 'active')->count();
        $onLeaveEmployees = Employee::where('status', 'on-leave')->count();
        $departmentsCount = Department::count();
        $employees = Employee::with('department')->latest()->take(5)->get();

        return view('livewire.dashboard.hr-dashboard', [
            'user' => $user,
            'totalEmployees' => $totalEmployees,
            'activeEmployees' => $activeEmployees,
            'onLeaveEmployees' => $onLeaveEmployees,
            'departmentsCount' => $departmentsCount,
            'recentEmployees' => $employees,
        ])->layout('components.layout.app', [
            'user' => $user,
            'title' => 'CEYWork HR Dashboard'
        ]);
    }
}
