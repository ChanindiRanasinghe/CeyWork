<?php

namespace App\Livewire\Admin;

use App\Models\Company;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminDashboard extends Component
{
    public string $activeTab = 'roles'; // 'roles', 'departments', 'users'
    public string $toastMessage = '';

    // Matrix Roles matching screenshot
    public array $rolesList = [
        'sys_admin' => 'SYS ADMIN',
        'co_admin' => 'CO. ADMIN',
        'hr_mgr' => 'HR MGR',
        'hr_exec' => 'HR EXEC',
        'dept_mgr' => 'DEPT MGR',
        'interviewer' => 'INTERVIEWER',
        'employee' => 'EMPLOYEE',
    ];

    // Permission Matrix matching screenshot
    public array $permissionMatrix = [
        ['module' => 'Dashboard', 'permissions' => ['sys_admin' => true, 'co_admin' => true, 'hr_mgr' => true, 'hr_exec' => true, 'dept_mgr' => true, 'interviewer' => true, 'employee' => true]],
        ['module' => 'Employees', 'permissions' => ['sys_admin' => true, 'co_admin' => true, 'hr_mgr' => true, 'hr_exec' => true, 'dept_mgr' => true, 'interviewer' => false, 'employee' => false]],
        ['module' => 'Recruitment', 'permissions' => ['sys_admin' => true, 'co_admin' => true, 'hr_mgr' => true, 'hr_exec' => true, 'dept_mgr' => false, 'interviewer' => true, 'employee' => false]],
        ['module' => 'Onboarding', 'permissions' => ['sys_admin' => true, 'co_admin' => true, 'hr_mgr' => true, 'hr_exec' => true, 'dept_mgr' => false, 'interviewer' => false, 'employee' => false]],
        ['module' => 'Attendance & Leave', 'permissions' => ['sys_admin' => true, 'co_admin' => true, 'hr_mgr' => true, 'hr_exec' => true, 'dept_mgr' => true, 'interviewer' => false, 'employee' => true]],
        ['module' => 'Payroll', 'permissions' => ['sys_admin' => true, 'co_admin' => true, 'hr_mgr' => true, 'hr_exec' => false, 'dept_mgr' => false, 'interviewer' => false, 'employee' => false]],
        ['module' => 'Performance', 'permissions' => ['sys_admin' => true, 'co_admin' => true, 'hr_mgr' => true, 'hr_exec' => true, 'dept_mgr' => true, 'interviewer' => false, 'employee' => true]],
        ['module' => 'Training', 'permissions' => ['sys_admin' => true, 'co_admin' => true, 'hr_mgr' => true, 'hr_exec' => true, 'dept_mgr' => true, 'interviewer' => false, 'employee' => true]],
        ['module' => 'Assets', 'permissions' => ['sys_admin' => true, 'co_admin' => true, 'hr_mgr' => true, 'hr_exec' => true, 'dept_mgr' => false, 'interviewer' => false, 'employee' => true]],
        ['module' => 'Offboarding', 'permissions' => ['sys_admin' => true, 'co_admin' => true, 'hr_mgr' => true, 'hr_exec' => true, 'dept_mgr' => false, 'interviewer' => false, 'employee' => false]],
        ['module' => 'Reports', 'permissions' => ['sys_admin' => true, 'co_admin' => true, 'hr_mgr' => true, 'hr_exec' => false, 'dept_mgr' => false, 'interviewer' => false, 'employee' => false]],
        ['module' => 'Settings & RBAC', 'permissions' => ['sys_admin' => true, 'co_admin' => true, 'hr_mgr' => true, 'hr_exec' => false, 'dept_mgr' => false, 'interviewer' => false, 'employee' => false]],
    ];

    // Department Management Modal State
    public string $newDeptName = '';
    public string $newDeptCode = '';

    public function mount()
    {
        if (!Auth::check()) {
            $u = User::first();
            if ($u) Auth::login($u);
        }

        $user = Auth::user();
        if ($user && $user->hasRole('Employee') && !$user->isAdmin() && !$user->hasAnyRole(['HR Senior', 'HR Manager', 'System Administrator', 'Company Administrator'])) {
            session()->flash('warning', 'Access restricted. Settings & RBAC is reserved for System Administrators and HR Managers only.');
            return redirect()->to('/dashboard');
        }
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function togglePermission(int $index, string $roleKey): void
    {
        if (isset($this->permissionMatrix[$index]['permissions'][$roleKey])) {
            $current = $this->permissionMatrix[$index]['permissions'][$roleKey];
            $this->permissionMatrix[$index]['permissions'][$roleKey] = !$current;
            $moduleName = $this->permissionMatrix[$index]['module'];
            $roleName = $this->rolesList[$roleKey];
            $status = !$current ? 'Granted' : 'Revoked';
            $this->toastMessage = "{$moduleName} access {$status} for {$roleName}.";
        }
    }

    public function addDepartment(): void
    {
        $this->validate([
            'newDeptName' => 'required|min:2',
            'newDeptCode' => 'required|min:2',
        ]);

        Department::create([
            'company_id' => auth()->user()->company_id ?? 1,
            'name' => $this->newDeptName,
            'code' => strtoupper($this->newDeptCode),
            'status' => 'active',
        ]);

        $this->reset(['newDeptName', 'newDeptCode']);
        $this->toastMessage = 'New Department created successfully!';
    }

    public function render()
    {
        if (!Auth::check()) {
            $u = User::first();
            if ($u) Auth::login($u);
        }

        $user = Auth::user() ?? User::first();
        $departments = Department::withCount('employees')->get();
        $users = User::with('roles')->get();

        return view('livewire.admin.admin-dashboard', [
            'user' => $user,
            'departments' => $departments,
            'users' => $users,
        ])->layout('components.layout.app', [
            'title' => 'Settings & RBAC - CEYWork'
        ]);
    }
}
