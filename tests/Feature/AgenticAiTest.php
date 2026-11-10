<?php

namespace Tests\Feature;

use App\Models\User;
use App\Livewire\Ai\AgenticCommandBar;
use App\Livewire\Recruitment\RecruitmentHub;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AgenticAiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_agentic_command_bar_processes_natural_language_queries(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(AgenticCommandBar::class)
            ->assertSet('isOpen', false)
            ->call('open')
            ->assertSet('isOpen', true)
            ->set('query', 'screen candidates')
            ->call('processAgentQuery')
            ->assertSet('aiResponse.type', 'screening')
            ->set('query', 'epf audit')
            ->call('processAgentQuery')
            ->assertSet('aiResponse.type', 'payroll')
            ->set('query', 'check leave balance')
            ->call('processAgentQuery')
            ->assertSet('aiResponse.type', 'attendance')
            ->set('query', 'employee performance review')
            ->call('processAgentQuery')
            ->assertSet('aiResponse.type', 'performance')
            ->set('query', 'training courses')
            ->call('processAgentQuery')
            ->assertSet('aiResponse.type', 'training')
            ->call('close')
            ->assertSet('isOpen', false);
    }

    public function test_recruitment_hub_runs_autonomous_ai_screener(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(RecruitmentHub::class)
            ->call('runAiScreenerAll')
            ->assertStatus(200);
    }
}
