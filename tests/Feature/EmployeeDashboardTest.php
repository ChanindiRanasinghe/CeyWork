<?php

namespace Tests\Feature;

use App\Models\User;
use App\Livewire\Dashboard\EmployeeDashboard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class EmployeeDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_employee_can_access_self_service_dashboard(): void
    {
        $employee = User::where('email', 'kasun.p@ceywork.lk')->first();

        $this->actingAs($employee)
            ->get('/employee/dashboard')
            ->assertStatus(200)
            ->assertSee('Employee Dashboard');
    }

    public function test_employee_dashboard_modals_toggle(): void
    {
        $employee = User::where('email', 'kasun.p@ceywork.lk')->first();

        Livewire::actingAs($employee)
            ->test(EmployeeDashboard::class)
            ->call('openPayslipModal')
            ->assertSet('showPayslipModal', true)
            ->call('closePayslipModal')
            ->assertSet('showPayslipModal', false)
            ->call('openDocumentsModal')
            ->assertSet('showDocumentsModal', true)
            ->call('closeDocumentsModal')
            ->assertSet('showDocumentsModal', false)
            ->call('openSupportModal')
            ->assertSet('showSupportModal', true)
            ->call('closeSupportModal')
            ->assertSet('showSupportModal', false);
    }
}
