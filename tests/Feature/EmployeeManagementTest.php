<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use App\Livewire\Employee\EmployeeList;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EmployeeManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_admin_can_access_employee_directory(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        $this->actingAs($admin)
            ->get('/employees')
            ->assertStatus(200)
            ->assertSee('Employee Directory');
    }

    public function test_can_search_employees_by_name_or_code(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(EmployeeList::class)
            ->set('search', 'Amara')
            ->assertSee('Amara')
            ->set('search', 'NONEXISTENT_CODE_999')
            ->assertDontSee('Amara');
    }

    public function test_can_filter_employees_by_department(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();
        $hrDept = Department::where('code', 'HR')->first();

        Livewire::actingAs($admin)
            ->test(EmployeeList::class)
            ->set('departmentFilter', (string) $hrDept->id)
            ->assertSee('Amara');
    }

    public function test_can_create_new_employee_with_sri_lankan_statutory_fields(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();
        $hrDept = Department::where('code', 'HR')->first();

        Livewire::actingAs($admin)
            ->test(EmployeeList::class)
            ->set('first_name', 'Chathura')
            ->set('last_name', 'Wickramasinghe')
            ->set('email', 'chathura.w@ceywork.lk')
            ->set('phone', '+94 77 987 6543')
            ->set('employee_code', 'EMP-0099')
            ->set('nic_passport', '199512345678')
            ->set('designation', 'Senior HR Consultant')
            ->set('department_id', (string) $hrDept->id)
            ->set('basic_salary', '250000.00')
            ->set('epf_number', 'EPF-998877')
            ->set('etf_number', 'ETF-998877')
            ->set('b_card_no', 'BC-112233')
            ->call('createEmployee')
            ->assertHasNoErrors()
            ->assertSee('Employee record created successfully.');

        $this->assertDatabaseHas('employees', [
            'email' => 'chathura.w@ceywork.lk',
            'employee_code' => 'EMP-0099',
            'epf_number' => 'EPF-998877',
            'b_card_no' => 'BC-112233',
        ]);
    }

    public function test_can_edit_and_update_employee_record(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();
        $employee = Employee::where('email', 'amara.j@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(EmployeeList::class)
            ->call('openEditModal', $employee->id)
            ->assertSet('editingEmployeeId', $employee->id)
            ->assertSet('first_name', 'Amara')
            ->set('designation', 'Director of People & Culture')
            ->call('updateEmployee')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'designation' => 'Director of People & Culture',
        ]);
    }

    public function test_can_delete_employee_record(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();
        $employee = Employee::where('email', 'amara.j@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(EmployeeList::class)
            ->call('deleteEmployee', $employee->id);

        $this->assertSoftDeleted('employees', [
            'id' => $employee->id,
        ]);
    }
}

