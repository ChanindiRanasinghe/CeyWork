<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\User;
use App\Livewire\Admin\AdminDashboard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminPortalTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_admin_can_access_admin_portal(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        $this->actingAs($admin)
            ->get('/admin')
            ->assertStatus(200)
            ->assertSee('Settings');
    }

    public function test_admin_can_toggle_rbac_matrix_permission(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(AdminDashboard::class)
            ->call('togglePermission', 0, 'employee')
            ->assertSet('permissionMatrix.0.permissions.employee', false)
            ->assertSee('Revoked');
    }

    public function test_admin_can_create_new_department(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(AdminDashboard::class)
            ->set('newDeptName', 'Product & Design')
            ->set('newDeptCode', 'PRD')
            ->call('addDepartment')
            ->assertHasNoErrors()
            ->assertSee('New Department created successfully');

        $this->assertDatabaseHas('departments', [
            'name' => 'Product & Design',
            'code' => 'PRD',
        ]);
    }

    public function test_admin_dashboard_switches_tabs(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(AdminDashboard::class)
            ->call('setTab', 'departments')
            ->assertSet('activeTab', 'departments')
            ->call('setTab', 'users')
            ->assertSet('activeTab', 'users');
    }
}

