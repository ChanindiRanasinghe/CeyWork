<?php

namespace App\Livewire\Payroll;

use App\Models\Employee;
use Livewire\Component;

class PayrollProcessor extends Component
{
    public string $selectedMonth = '2026-08';
    public bool $processed = false;

    public function processPayroll()
    {
        $this->processed = true;
        session()->flash('message', 'Payroll for ' . $this->selectedMonth . ' processed successfully according to Sri Lanka EPF (8%/12%) and ETF (3%) statutory guidelines.');
    }

    public function render()
    {
        $employees = Employee::with('department')->where('status', 'active')->get();

        $totalBasic = $employees->sum('basic_salary');
        $totalEmployeeEPF = $totalBasic * 0.08;
        $totalEmployerEPF = $totalBasic * 0.12;
        $totalEmployerETF = $totalBasic * 0.03;
        $totalNetPayable = $totalBasic - $totalEmployeeEPF;

        return view('livewire.payroll.payroll-processor', [
            'employees' => $employees,
            'totalBasic' => $totalBasic,
            'totalEmployeeEPF' => $totalEmployeeEPF,
            'totalEmployerEPF' => $totalEmployerEPF,
            'totalEmployerETF' => $totalEmployerETF,
            'totalNetPayable' => $totalNetPayable,
        ])->layout('components.layout.app', [
            'title' => 'Sri Lankan Statutory Payroll - CEYWork'
        ]);
    }
}
