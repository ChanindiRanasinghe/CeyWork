<?php

namespace Tests\Feature;

use App\Models\User;
use App\Livewire\Offboarding\OffboardingDashboard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class OffboardingDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_admin_can_access_offboarding_hub(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        $this->actingAs($admin)
            ->get('/offboarding')
            ->assertStatus(200)
            ->assertSee('Offboarding');
    }

    public function test_can_select_offboarding_case(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(OffboardingDashboard::class)
            ->call('selectCase', 2)
            ->assertSet('selectedCaseId', 2);
    }

    public function test_can_toggle_offboarding_checklist_task(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(OffboardingDashboard::class)
            ->call('toggleChecklistItem', 1, 5)
            ->assertSet('casesData.1.checklist.4.completed', true);
    }

    public function test_modals_open_and_close(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(OffboardingDashboard::class)
            ->call('openExitInterviewModal')
            ->assertSet('showExitInterviewModal', true)
            ->call('closeExitInterviewModal')
            ->assertSet('showExitInterviewModal', false)
            ->call('openFinalPayslipModal')
            ->assertSet('showFinalPayslipModal', true)
            ->call('closeFinalPayslipModal')
            ->assertSet('showFinalPayslipModal', false);
    }
}

