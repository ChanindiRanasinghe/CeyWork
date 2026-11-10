<?php

namespace Tests\Feature;

use App\Models\User;
use App\Livewire\Assets\AssetManagement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AssetManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_admin_can_access_asset_register(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        $this->actingAs($admin)
            ->get('/assets')
            ->assertStatus(200)
            ->assertSee('Asset Management');
    }

    public function test_admin_can_create_new_asset(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(AssetManagement::class)
            ->call('openCreateModal')
            ->assertSet('showCreateModal', true)
            ->set('name', 'Dell XPS 15')
            ->set('code', 'AST-009')
            ->set('category', 'Laptop')
            ->set('serial_no', 'XPS15-SLK-9988')
            ->set('assigned_to', 'Kasun Perera')
            ->call('createAsset')
            ->assertHasNoErrors()
            ->assertSee('registered successfully');
    }

    public function test_admin_can_update_asset(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(AssetManagement::class)
            ->call('openEditModal', 1)
            ->assertSet('showEditModal', true)
            ->set('name', 'MacBook Pro 16" M3 Max')
            ->call('updateAsset')
            ->assertHasNoErrors()
            ->assertSee('updated successfully');
    }

    public function test_admin_can_delete_asset(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(AssetManagement::class)
            ->call('deleteAsset', 1)
            ->assertSee('Asset deleted successfully!');
    }

    public function test_standard_employee_restricted_from_asset_management(): void
    {
        $employee = User::where('email', 'kasun.p@ceywork.lk')->first();

        $this->actingAs($employee)
            ->get('/assets')
            ->assertRedirect('/dashboard');
    }
}

