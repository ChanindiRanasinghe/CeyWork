<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // System & Admin Permissions
        $permissions = [
            // Admin & Company Config
            'manage-system',
            'manage-companies',
            'manage-roles-permissions',
            'manage-departments',
            'manage-custom-fields',
            'manage-workflows',
            'view-audit-logs',

            // Recruitment & ATS
            'manage-vacancies',
            'manage-candidates',
            'screen-candidates',
            'schedule-interviews',
            'conduct-interviews',
            'manage-job-offers',
            'manage-onboarding',

            // Employee Records
            'view-all-employees',
            'create-employees',
            'edit-employees',
            'delete-employees',
            'manage-documents',

            // Attendance & Leave
            'manage-attendance',
            'submit-leave',
            'approve-leave',

            // Payroll (Sri Lanka Statutory EPF/ETF)
            'manage-payroll',
            'view-payslips',

            // Performance & Exit
            'manage-performance',
            'manage-offboarding',
            'view-hr-reports',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission], ['guard_name' => 'web']);
        }

        // Roles definition
        $rolesMap = [
            'System Administrator' => $permissions,
            'Company Administrator' => [
                'manage-companies', 'manage-roles-permissions', 'manage-departments', 
                'manage-custom-fields', 'manage-workflows', 'view-audit-logs', 'view-hr-reports'
            ],
            'HR Manager' => [
                'view-all-employees', 'create-employees', 'edit-employees', 'manage-vacancies',
                'manage-candidates', 'screen-candidates', 'manage-job-offers', 'manage-onboarding',
                'approve-leave', 'manage-attendance', 'manage-performance', 'manage-offboarding', 'view-hr-reports'
            ],
            'HR Senior' => [
                'view-all-employees', 'create-employees', 'edit-employees', 'manage-vacancies',
                'manage-candidates', 'screen-candidates', 'manage-job-offers', 'manage-onboarding',
                'approve-leave', 'manage-attendance', 'manage-performance', 'manage-offboarding', 'view-hr-reports'
            ],
            'HR Junior' => [
                'view-all-employees', 'screen-candidates', 'manage-onboarding', 'manage-attendance'
            ],
            'Department Manager' => [
                'view-all-employees', 'conduct-interviews', 'approve-leave', 'manage-performance'
            ],
            'Recruitment Officer' => [
                'manage-vacancies', 'manage-candidates', 'screen-candidates'
            ],
            'Interview Coordinator' => [
                'schedule-interviews', 'manage-candidates'
            ],
            'Interviewer' => [
                'conduct-interviews'
            ],
            'Onboarding Officer' => [
                'manage-job-offers', 'manage-onboarding', 'manage-documents'
            ],
            'Employee Records Officer' => [
                'view-all-employees', 'create-employees', 'edit-employees', 'manage-documents'
            ],
            'Payroll Officer' => [
                'manage-payroll', 'view-payslips', 'view-all-employees'
            ],
            'Attendance/Leave Officer' => [
                'manage-attendance', 'approve-leave'
            ],
            'Employee' => [
                'submit-leave', 'view-payslips'
            ],
        ];

        foreach ($rolesMap as $roleName => $assignedPermissions) {
            $role = Role::firstOrCreate(['name' => $roleName], ['guard_name' => 'web']);
            $role->syncPermissions($assignedPermissions);
        }
    }
}
