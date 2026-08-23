<?php

namespace App\Livewire\Admin;

use App\Models\Company;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        $companiesCount = Company::count();
        $usersCount = User::count();
        $rolesCount = Role::count();
        $departmentsCount = Department::count();
        $roles = Role::withCount('permissions')->get();

        return view('livewire.admin.admin-dashboard', [
            'companiesCount' => $companiesCount,
            'usersCount' => $usersCount,
            'rolesCount' => $rolesCount,
            'departmentsCount' => $departmentsCount,
            'roles' => $roles,
        ])->layout('layouts.admin');
    }
}
