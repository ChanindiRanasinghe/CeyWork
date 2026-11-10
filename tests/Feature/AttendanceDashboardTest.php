<?php

namespace Tests\Feature;

use App\Models\User;
use App\Livewire\Attendance\AttendanceDashboard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AttendanceDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_admin_can_access_attendance_dashboard(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        $this->actingAs($admin)
            ->get('/attendance')
            ->assertStatus(200)
            ->assertSee('Leave Balances & Attendance');
    }

    public function test_manager_can_approve_leave_request(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(AttendanceDashboard::class)
            ->set('activeTab', 'requests')
            ->call('approveRequest', 1)
            ->assertSet('leaveRequests.1.status', 'approved')
            ->assertSee('approved successfully');
    }

    public function test_manager_can_reject_leave_request(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(AttendanceDashboard::class)
            ->set('activeTab', 'requests')
            ->call('rejectRequest', 1)
            ->assertSet('leaveRequests.1.status', 'rejected')
            ->assertSee('rejected');
    }

    public function test_manager_can_update_employee_leave_balances(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(AttendanceDashboard::class)
            ->set('editingEmployeeId', 1)
            ->set('editingEmployeeName', 'Kasun Perera')
            ->set('editAnnualRemaining', 12)
            ->set('editCasualRemaining', 5)
            ->set('editSickRemaining', 10)
            ->call('updateLeaveBalance')
            ->assertSee('Leave balances updated for Kasun Perera');
    }

    public function test_can_filter_attendance_by_status(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(AttendanceDashboard::class)
            ->call('setStatusFilter', 'pending')
            ->assertSet('statusFilter', 'pending');
    }
}

