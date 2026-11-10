<?php

namespace Tests\Feature;

use App\Models\User;
use App\Livewire\Reports\ReportsAnalytics;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ReportsAnalyticsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_admin_can_access_reports_and_analytics(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        $this->actingAs($admin)
            ->get('/reports')
            ->assertStatus(200)
            ->assertSee('Reports & Analytics');
    }

    public function test_standard_employee_restricted_from_reports(): void
    {
        $employee = User::where('email', 'kasun.p@ceywork.lk')->first();

        $this->actingAs($employee)
            ->get('/reports')
            ->assertRedirect('/dashboard');
    }

    public function test_reports_component_renders_headcount_and_metrics(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(ReportsAnalytics::class)
            ->assertSee('Headcount by Department')
            ->assertSee('Eng')
            ->assertSee('HR');
    }
}

