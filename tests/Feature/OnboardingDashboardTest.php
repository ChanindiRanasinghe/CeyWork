<?php

namespace Tests\Feature;

use App\Models\User;
use App\Livewire\Onboarding\OnboardingDashboard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class OnboardingDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_management_roles_can_access_onboarding_dashboard(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();
        $hrSenior = User::where('email', 'amara.j@ceywork.lk')->first();
        $hrJunior = User::where('email', 'nimali.f@ceywork.lk')->first();

        $this->actingAs($admin)->get('/onboarding')->assertStatus(200)->assertSee('Onboarding');
        $this->actingAs($hrSenior)->get('/onboarding')->assertStatus(200)->assertSee('Onboarding');
        $this->actingAs($hrJunior)->get('/onboarding')->assertStatus(200)->assertSee('Onboarding');
    }

    public function test_regular_employee_is_restricted_from_onboarding_dashboard(): void
    {
        $employee = User::where('email', 'kasun.p@ceywork.lk')->first();

        $this->actingAs($employee)
            ->get('/onboarding')
            ->assertRedirect('/dashboard');
    }

    public function test_onboarding_interactive_checklist_toggling(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(OnboardingDashboard::class)
            ->assertSet('activeTab', 'active_cases')
            ->call('setTab', 'checklist')
            ->assertSet('activeTab', 'checklist')
            ->call('selectCandidate', 1)
            ->assertSet('selectedCandidateId', 1)
            ->call('toggleTask', 1, 8); // toggle task #8 for candidate #1
    }
}
