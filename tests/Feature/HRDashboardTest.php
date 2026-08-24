<?php

namespace Tests\Feature;

use App\Models\User;
use App\Livewire\Dashboard\HRDashboard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class HRDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_admin_can_access_hr_dashboard(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        $this->actingAs($admin)
            ->get('/dashboard')
            ->assertStatus(200)
            ->assertSee('Overview')
            ->assertSee('Headcount Trend')
            ->assertSee('Department Breakdown');
    }

    public function test_hr_senior_can_access_hr_dashboard(): void
    {
        $hrSenior = User::where('email', 'amara.j@ceywork.lk')->first();

        $this->actingAs($hrSenior)
            ->get('/dashboard')
            ->assertStatus(200)
            ->assertSee('Overview');
    }

    public function test_hr_junior_can_access_hr_dashboard(): void
    {
        $hrJunior = User::where('email', 'nimali.f@ceywork.lk')->first();

        $this->actingAs($hrJunior)
            ->get('/dashboard')
            ->assertStatus(200)
            ->assertSee('Overview');
    }

    public function test_other_employee_is_restricted_from_hr_dashboard(): void
    {
        $employee = User::where('email', 'kasun.p@ceywork.lk')->first();

        $this->actingAs($employee)
            ->get('/dashboard')
            ->assertRedirect('/login');
    }

    public function test_notifications_drawer_toggle_and_tab_filters(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(HRDashboard::class)
            ->assertSet('showNotificationsDrawer', false)
            ->call('toggleNotifications')
            ->assertSet('showNotificationsDrawer', true)
            ->call('setNotificationTab', 'interviews')
            ->assertSet('activeNotificationTab', 'interviews')
            ->call('closeNotifications')
            ->assertSet('showNotificationsDrawer', false);
    }
}
