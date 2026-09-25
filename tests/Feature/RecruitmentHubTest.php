<?php

namespace Tests\Feature;

use App\Models\User;
use App\Livewire\Recruitment\RecruitmentHub;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class RecruitmentHubTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_recruitment_hub_renders_all_routes_successfully(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        $this->actingAs($admin)
            ->get('/recruitment')
            ->assertStatus(200)
            ->assertSee('Recruitment')
            ->assertSee('Vacancies')
            ->assertSee('Candidate Pipelines')
            ->assertSee('Interview Schedule');

        $this->actingAs($admin)
            ->get('/recruitment/vacancies')
            ->assertStatus(200);

        $this->actingAs($admin)
            ->get('/recruitment/candidates')
            ->assertStatus(200);

        $this->actingAs($admin)
            ->get('/recruitment/interviews')
            ->assertStatus(200);
    }

    public function test_switching_recruitment_tabs(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(RecruitmentHub::class)
            ->assertSet('activeTab', 'vacancies')
            ->call('setTab', 'pipelines')
            ->assertSet('activeTab', 'pipelines')
            ->call('setTab', 'interviews')
            ->assertSet('activeTab', 'interviews');
    }
}
