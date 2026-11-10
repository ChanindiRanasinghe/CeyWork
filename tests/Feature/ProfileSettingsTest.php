<?php

namespace Tests\Feature;

use App\Models\User;
use App\Livewire\Profile\ProfileSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileSettingsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_user_can_access_profile_settings(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        $this->actingAs($admin)
            ->get('/profile')
            ->assertStatus(200)
            ->assertSee('Settings');
    }

    public function test_user_can_update_personal_info(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(ProfileSettings::class)
            ->set('name', 'Senior Admin Administrator')
            ->set('phone', '+94 77 111 2233')
            ->call('saveProfile')
            ->assertHasNoErrors()
            ->assertSee('Profile information saved successfully');

        $this->assertDatabaseHas('users', [
            'id' => $admin->id,
            'name' => 'Senior Admin Administrator',
        ]);
    }

    public function test_user_can_update_password(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(ProfileSettings::class)
            ->call('setTab', 'security')
            ->set('current_password', 'password')
            ->set('new_password', 'NewSecurePassword123!')
            ->set('new_password_confirmation', 'NewSecurePassword123!')
            ->call('updatePassword')
            ->assertHasNoErrors()
            ->assertSee('Password updated successfully');

        $admin->refresh();
        $this->assertTrue(Hash::check('NewSecurePassword123!', $admin->password));
    }

    public function test_user_can_update_notifications(): void
    {
        $admin = User::where('email', 'admin@ceywork.lk')->first();

        Livewire::actingAs($admin)
            ->test(ProfileSettings::class)
            ->call('setTab', 'notifications')
            ->set('emailNotifications', false)
            ->assertSet('emailNotifications', false);
    }
}

