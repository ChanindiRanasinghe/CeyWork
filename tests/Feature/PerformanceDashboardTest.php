<?php

namespace Tests\Feature;

use App\Models\User;
use App\Livewire\Performance\PerformanceDashboard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PerformanceDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_user_can_access_performance_dashboard(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        $this->actingAs($admin)
            ->get('/performance')
            ->assertStatus(200)
            ->assertSee('Performance Management');
    }

    public function test_can_switch_tabs_to_evaluations(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(PerformanceDashboard::class)
            ->call('setTab', 'evaluations')
            ->assertSet('activeTab', 'evaluations');
    }

    public function test_admin_can_update_kpi_target(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(PerformanceDashboard::class)
            ->call('openEditKpiModal', 1)
            ->assertSet('showEditKpiModal', true)
            ->set('editTarget', '95%')
            ->set('editActual', '92%')
            ->call('updateKpi')
            ->assertHasNoErrors()
            ->assertSee('updated successfully');
    }
}

