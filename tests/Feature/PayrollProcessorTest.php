<?php

namespace Tests\Feature;

use App\Models\User;
use App\Livewire\Payroll\PayrollProcessor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PayrollProcessorTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_admin_can_access_payroll_processor(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        $this->actingAs($admin)
            ->get('/payroll')
            ->assertStatus(200)
            ->assertSee('Payroll')
            ->assertSee('Overview')
            ->assertSee('Payslips');
    }

    public function test_non_payroll_user_is_redirected_from_payroll(): void
    {
        $employee = User::where('email', 'kasun.p@ceywork.lk')->first();

        $this->actingAs($employee)
            ->get('/payroll')
            ->assertRedirect('/dashboard');
    }

    public function test_payroll_batch_processing_and_csv_export(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(PayrollProcessor::class)
            ->call('setTab', 'payslips')
            ->assertSet('activeTab', 'payslips')
            ->call('processPayroll')
            ->assertSet('processed', true)
            ->call('exportPayslipSummaryCsv')
            ->assertFileDownloaded();
    }
}
