<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Roles & Permissions
        $this->call(RolePermissionSeeder::class);

        // 2. Seed Default Company
        $company = Company::create([
            'name' => 'CEYWork Enterprise (Pvt) Ltd',
            'code' => 'CEY-001',
            'tax_id' => 'PV-123456',
            'address' => 'No 45, Galle Road, Colombo 03, Sri Lanka',
            'phone' => '+94 11 234 5678',
            'email' => 'contact@ceywork.lk',
        ]);

        // 3. Seed Departments
        $hrDept = Department::create([
            'company_id' => $company->id,
            'name' => 'Human Resources',
            'code' => 'HR',
            'description' => 'Talent Management, Payroll & HR Ops',
        ]);

        $engDept = Department::create([
            'company_id' => $company->id,
            'name' => 'Engineering',
            'code' => 'ENG',
            'description' => 'Software & Product Engineering',
        ]);

        $finDept = Department::create([
            'company_id' => $company->id,
            'name' => 'Finance',
            'code' => 'FIN',
            'description' => 'Financial Planning, EPF/ETF & Accounting',
        ]);

        // 4. Seed Admin User & Employee File
        $adminUser = User::create([
            'name' => 'System Administrator',
            'email' => 'admin@ceywork.lk',
            'password' => Hash::make('password'),
            'company_id' => $company->id,
        ]);
        $adminUser->assignRole('System Administrator');

        Employee::create([
            'user_id' => $adminUser->id,
            'company_id' => $company->id,
            'department_id' => $hrDept->id,
            'employee_code' => 'EMP-0000',
            'office_id' => 'ACM-ADM-001',
            'first_name' => 'System',
            'last_name' => 'Administrator',
            'email' => 'admin@ceywork.lk',
            'designation' => 'System Admin',
            'joined_date' => '2023-01-01',
            'status' => 'active',
        ]);

        // 5. Seed HR Senior User & Employee File
        $hrUser = User::create([
            'name' => 'Amara Jayawardena',
            'email' => 'amara.j@ceywork.lk',
            'password' => Hash::make('password'),
            'company_id' => $company->id,
        ]);
        $hrUser->assignRole('HR Senior');
        $hrUser->assignRole('HR Manager');

        $hrManagerEmployee = Employee::create([
            'user_id' => $hrUser->id,
            'company_id' => $company->id,
            'department_id' => $hrDept->id,
            'employee_code' => 'EMP-0001',
            'office_id' => 'ACM-HRS-001',
            'first_name' => 'Amara',
            'last_name' => 'Jayawardena',
            'email' => 'amara.j@ceywork.lk',
            'phone' => '+94 77 123 4567',
            'nic_passport' => '199084501234',
            'designation' => 'Head of HR (Senior)',
            'branch' => 'Colombo HQ',
            'contract_type' => 'permanent',
            'joined_date' => '2023-01-15',
            'status' => 'active',
            'basic_salary' => 350000.00,
            'epf_number' => 'EPF-88901',
            'etf_number' => 'ETF-88901',
            'b_card_no' => 'BC-9901',
            'bank_name' => 'Commercial Bank',
            'bank_branch' => 'Kollupitiya',
            'bank_account_no' => '8004561230',
        ]);

        $hrDept->update(['manager_id' => $hrManagerEmployee->id]);

        // 5b. Seed HR Junior User & Employee File
        $hrJrUser = User::create([
            'name' => 'Nimali Fernando',
            'email' => 'nimali.f@ceywork.lk',
            'password' => Hash::make('password'),
            'company_id' => $company->id,
        ]);
        $hrJrUser->assignRole('HR Junior');

        Employee::create([
            'user_id' => $hrJrUser->id,
            'company_id' => $company->id,
            'department_id' => $hrDept->id,
            'employee_code' => 'EMP-0003',
            'office_id' => 'ACM-HRJ-001',
            'first_name' => 'Nimali',
            'last_name' => 'Fernando',
            'email' => 'nimali.f@ceywork.lk',
            'designation' => 'HR Assistant (Junior)',
            'joined_date' => '2024-01-10',
            'status' => 'active',
        ]);

        // 6. Seed Sample Engineering Employee
        $engUser = User::create([
            'name' => 'Kasun Perera',
            'email' => 'kasun.p@ceywork.lk',
            'password' => Hash::make('password'),
            'company_id' => $company->id,
        ]);
        $engUser->assignRole('Employee');

        Employee::create([
            'user_id' => $engUser->id,
            'company_id' => $company->id,
            'department_id' => $engDept->id,
            'reporting_manager_id' => $hrManagerEmployee->id,
            'employee_code' => 'EMP-0002',
            'office_id' => 'ACM-ENG-002',
            'first_name' => 'Kasun',
            'last_name' => 'Perera',
            'email' => 'kasun.p@ceywork.lk',
            'phone' => '+94 71 987 6543',
            'nic_passport' => '199412308765',
            'designation' => 'Senior Software Engineer',
            'branch' => 'Colombo HQ',
            'contract_type' => 'permanent',
            'joined_date' => '2024-03-01',
            'status' => 'active',
            'basic_salary' => 280000.00,
            'epf_number' => 'EPF-88902',
            'etf_number' => 'ETF-88902',
            'b_card_no' => 'BC-9902',
            'bank_name' => 'Sampath Bank',
            'bank_branch' => 'Bambalapitiya',
            'bank_account_no' => '00291003451',
        ]);

        // 6b. Seed Pending Unactivated Employee (For Account Activation Demo Flow)
        Employee::create([
            'user_id' => null, // Pending activation
            'company_id' => $company->id,
            'department_id' => $engDept->id,
            'employee_code' => 'EMP-011',
            'office_id' => 'ACM-ENG-011',
            'first_name' => 'Ravi',
            'last_name' => 'Sharma',
            'email' => 'ravi.sharma@acme.com',
            'phone' => '+94 77 000 1111',
            'designation' => 'Software Engineer',
            'joined_date' => '2026-08-01',
            'status' => 'active',
        ]);
        // 7. Seed Sample Vacancy & Candidates
        $vacancy = \App\Models\Vacancy::create([
            'company_id' => $company->id,
            'department_id' => $engDept->id,
            'hiring_manager_id' => $adminUser->id,
            'title' => 'Senior Full Stack Engineer',
            'description' => 'We are seeking an experienced Laravel & React/Livewire engineer.',
            'requirements' => '5+ years PHP/Laravel, Tailwind CSS, MySQL, REST APIs.',
            'openings_count' => 2,
            'employment_type' => 'full-time',
            'closing_date' => '2026-09-30',
            'status' => 'open',
        ]);

        \App\Models\Candidate::create([
            'vacancy_id' => $vacancy->id,
            'full_name' => 'Saman Silva',
            'email' => 'saman.silva@example.com',
            'phone' => '+94 77 555 1234',
            'nic_passport' => '199212345678',
            'source' => 'LinkedIn',
            'status' => 'shortlisted',
            'experience_summary' => '6 years Laravel backend engineer at Sri Lankan tech startup.',
        ]);

        \App\Models\Candidate::create([
            'vacancy_id' => $vacancy->id,
            'full_name' => 'Nipuni De Silva',
            'email' => 'nipuni.ds@example.com',
            'phone' => '+94 71 444 9876',
            'nic_passport' => '199587654321',
            'source' => 'XpressJobs',
            'status' => 'interview-scheduled',
            'experience_summary' => '4 years Full Stack Engineer with Livewire experience.',
        ]);
    }
}
