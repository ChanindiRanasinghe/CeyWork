<?php

namespace App\Livewire\Reports;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReportsAnalytics extends Component
{
    public function mount()
    {
        $user = Auth::user();
        if ($user && $user->hasRole('Employee') && !$user->isAdmin() && !$user->hasAnyRole(['HR Senior', 'HR Manager', 'HR Junior', 'System Administrator', 'Company Administrator'])) {
            session()->flash('warning', 'Access restricted. Reports & Analytics are accessible to Administrators and HR Management only.');
            return redirect()->to('/dashboard');
        }
    }

    public function render()
    {
        $user = Auth::user() ?? User::first();

        // KPI metrics matching screenshot
        $metrics = [
            'avgTenure' => '3.2y',
            'turnoverRate' => '8.4%',
            'turnoverTrend' => '-1.2% vs last month',
            'timeToHire' => '38d',
            'engScore' => '76%',
            'engTrend' => '+3% vs last month',
        ];

        // Department Breakdown dataset with counts and percentages
        $departmentBreakdown = [
            ['name' => 'Eng', 'fullName' => 'Engineering', 'count' => 89, 'pct' => '31%', 'color' => '#b91c1c'],
            ['name' => 'Sales', 'fullName' => 'Sales & Business', 'count' => 54, 'pct' => '19%', 'color' => '#d97706'],
            ['name' => 'Ops', 'fullName' => 'Operations', 'count' => 51, 'pct' => '18%', 'color' => '#10b981'],
            ['name' => 'Product', 'fullName' => 'Product Design', 'count' => 31, 'pct' => '11%', 'color' => '#f59e0b'],
            ['name' => 'Mktg', 'fullName' => 'Marketing', 'count' => 28, 'pct' => '10%', 'color' => '#ec4899'],
            ['name' => 'Finance', 'fullName' => 'Finance & Legal', 'count' => 19, 'pct' => '7%', 'color' => '#8b5cf6'],
            ['name' => 'HR', 'fullName' => 'Human Resources', 'count' => 12, 'pct' => '4%', 'color' => '#06b6d4'],
        ];

        $totalHeadcount = array_sum(array_column($departmentBreakdown, 'count'));

        // Weekly attendance rate data
        $weeklyAttendance = [
            ['day' => 'Mon', 'rate' => 94],
            ['day' => 'Tue', 'rate' => 96],
            ['day' => 'Wed', 'rate' => 92],
            ['day' => 'Thu', 'rate' => 97],
            ['day' => 'Fri', 'rate' => 88],
        ];

        // Leave type breakdown data
        $leaveTypeBreakdown = [
            ['type' => 'Annual', 'days' => 148],
            ['type' => 'Sick', 'days' => 38],
            ['type' => 'Maternity', 'days' => 84],
            ['type' => 'Personal', 'days' => 22],
        ];

        return view('livewire.reports.reports-analytics', [
            'user' => $user,
            'metrics' => $metrics,
            'departmentBreakdown' => $departmentBreakdown,
            'totalHeadcount' => $totalHeadcount,
            'weeklyAttendance' => $weeklyAttendance,
            'leaveTypeBreakdown' => $leaveTypeBreakdown,
        ])->layout('components.layout.app', [
            'title' => 'Reports & Analytics - CEYWork'
        ]);
    }
}
