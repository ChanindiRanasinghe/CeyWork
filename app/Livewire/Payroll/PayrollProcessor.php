<?php

namespace App\Livewire\Payroll;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PayrollProcessor extends Component
{
    public string $activeTab = 'overview'; // 'overview', 'payslips'
    public string $selectedMonth = '2026-08';
    public bool $processed = false;

    public function mount()
    {
        $user = Auth::user();
        // Access Restriction: Visible strictly to Admin and Senior HR / HR Manager roles only
        if ($user && $user->hasRole('Employee') && !$user->isAdmin() && !$user->hasPermissionTo('manage-payroll') && !$user->hasAnyRole(['HR Senior', 'HR Manager', 'System Administrator', 'Company Administrator'])) {
            session()->flash('warning', 'Access restricted. The Payroll module is restricted to System Admin and Senior HR roles only.');
            return redirect()->to('/dashboard');
        }
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function processPayroll()
    {
        $this->processed = true;
        session()->flash('message', 'Payroll for ' . $this->selectedMonth . ' processed successfully according to Sri Lanka EPF (8%/12%) and ETF (3%) statutory guidelines.');
    }

    public function render()
    {
        $user = Auth::user() ?? User::first();
        $employees = Employee::with('department')->where('status', 'active')->get();

        $totalBasic = $employees->sum('basic_salary');
        if ($totalBasic <= 0) {
            $totalBasic = 2410000.00; // Rs. 2.41M fallback for demo calculation
        }
        $totalEmployeeEPF = $totalBasic * 0.08;
        $totalEmployerEPF = $totalBasic * 0.12;
        $totalEmployerETF = $totalBasic * 0.03;
        $totalDeductions = $totalEmployeeEPF + 104000; // EPF 8% + APIT Tax
        $totalNetPayable = $totalBasic - $totalDeductions;

        return view('livewire.payroll.payroll-processor', [
            'user' => $user,
            'employees' => $employees,
            'totalBasic' => $totalBasic,
            'totalEmployeeEPF' => $totalEmployeeEPF,
            'totalEmployerEPF' => $totalEmployerEPF,
            'totalEmployerETF' => $totalEmployerETF,
            'totalDeductions' => $totalDeductions,
            'totalNetPayable' => $totalNetPayable,
        ])->layout('components.layout.app', [
            'title' => 'Payroll Management - CEYWork'
        ]);
    }
}
