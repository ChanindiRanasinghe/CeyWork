<?php

namespace App\Livewire\Employee;

use App\Models\Department;
use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;

class EmployeeList extends Component
{
    use WithPagination;

    public string $search = '';
    public string $departmentFilter = '';
    public string $statusFilter = '';

    // Create Modal State
    public bool $showCreateModal = false;
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $phone = '';
    public string $employee_code = '';
    public string $nic_passport = '';
    public string $designation = '';
    public string $department_id = '';
    public string $basic_salary = '';
    public string $epf_number = '';
    public string $etf_number = '';
    public string $b_card_no = '';

    protected $rules = [
        'first_name' => 'required|string|max:100',
        'last_name' => 'required|string|max:100',
        'email' => 'required|email|unique:employees,email',
        'employee_code' => 'required|string|unique:employees,employee_code',
        'nic_passport' => 'nullable|string',
        'designation' => 'required|string',
        'department_id' => 'required|exists:departments,id',
        'basic_salary' => 'required|numeric|min:0',
        'epf_number' => 'nullable|string',
        'etf_number' => 'nullable|string',
        'b_card_no' => 'nullable|string',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function createEmployee()
    {
        $this->validate();

        Employee::create([
            'company_id' => auth()->user()->company_id ?? 1,
            'department_id' => $this->department_id,
            'employee_code' => $this->employee_code,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'nic_passport' => $this->nic_passport,
            'designation' => $this->designation,
            'contract_type' => 'permanent',
            'joined_date' => now()->toDateString(),
            'status' => 'active',
            'basic_salary' => $this->basic_salary,
            'epf_number' => $this->epf_number,
            'etf_number' => $this->etf_number,
            'b_card_no' => $this->b_card_no,
        ]);

        $this->reset(['first_name', 'last_name', 'email', 'phone', 'employee_code', 'nic_passport', 'designation', 'department_id', 'basic_salary', 'epf_number', 'etf_number', 'b_card_no', 'showCreateModal']);
        session()->flash('message', 'Employee record created successfully.');
    }

    public function render()
    {
        $query = Employee::with('department');

        if ($this->search !== '') {
            $query->where(function ($q) {
                $q->where('first_name', 'like', '%' . $this->search . '%')
                  ->orWhere('last_name', 'like', '%' . $this->search . '%')
                  ->orWhere('employee_code', 'like', '%' . $this->search . '%')
                  ->orWhere('nic_passport', 'like', '%' . $this->search . '%')
                  ->orWhere('designation', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->departmentFilter !== '') {
            $query->where('department_id', $this->departmentFilter);
        }

        if ($this->statusFilter !== '') {
            $query->where('status', $this->statusFilter);
        }

        $employees = $query->latest()->paginate(10);
        $departments = Department::all();

        return view('livewire.employee.employee-list', [
            'employees' => $employees,
            'departments' => $departments,
        ])->layout('components.layout.app', [
            'title' => 'Employee Directory - CEYWork'
        ]);
    }
}
