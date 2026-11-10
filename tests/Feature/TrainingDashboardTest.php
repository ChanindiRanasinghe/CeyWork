<?php

namespace Tests\Feature;

use App\Models\User;
use App\Livewire\Training\TrainingDashboard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TrainingDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_user_can_access_training_dashboard(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        $this->actingAs($admin)
            ->get('/training')
            ->assertStatus(200)
            ->assertSee('Training');
    }

    public function test_user_can_toggle_training_enrollment(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(TrainingDashboard::class)
            ->call('toggleEnrollment', 1)
            ->assertSet('courses.0.userCompleted', true);
    }

    public function test_admin_can_create_new_training_program(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(TrainingDashboard::class)
            ->call('openCreateModal')
            ->assertSet('showCreateModal', true)
            ->set('newTitle', 'Sri Lankan Labor Law Compliance 2026')
            ->set('newProvider', 'CEYWork Academy')
            ->set('newDuration', '6h')
            ->set('newDeadline', 'Dec 15')
            ->set('newCategory', 'Legal & Compliance')
            ->set('newMandatory', true)
            ->call('createTrainingSession')
            ->assertHasNoErrors()
            ->assertSee('created successfully');
    }
}

