<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\User;
use App\Livewire\Auth\Login;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_login_screen_renders_with_custom_ui(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Your complete');
        $response->assertSee('people platform.');
        $response->assertSee('Welcome back');
    }

    public function test_all_four_user_roles_can_login(): void
    {
        // 1. Admin
        Livewire::test(Login::class)
            ->set('email', 'admin@ceywork.lk')
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect('/dashboard');

        // 2. HR Senior
        Livewire::test(Login::class)
            ->set('email', 'amara.j@ceywork.lk')
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect('/dashboard');

        // 3. HR Junior
        Livewire::test(Login::class)
            ->set('email', 'nimali.f@ceywork.lk')
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect('/dashboard');

        // 4. Employee
        Livewire::test(Login::class)
            ->set('email', 'kasun.p@ceywork.lk')
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect('/dashboard');
    }

    public function test_identity_verification_and_registration_flow(): void
    {
        // Step 1: Verify Identity with pending EMP-011
        Livewire::test(Login::class)
            ->set('mode', 'verify_identity')
            ->set('companyEmail', 'ravi.sharma@acme.com')
            ->set('employeeId', 'EMP-011')
            ->set('officeId', 'ACM-ENG-011')
            ->call('verifyIdentity')
            ->assertSet('mode', 'register')
            ->assertSet('firstName', 'Ravi')
            ->assertSet('lastName', 'Sharma');

        // Step 2: Register account
        Livewire::test(Login::class)
            ->set('mode', 'register')
            ->set('companyEmail', 'ravi.sharma@acme.com')
            ->set('verifiedEmployeeId', Employee::where('employee_code', 'EMP-011')->first()->id)
            ->set('firstName', 'Ravi')
            ->set('lastName', 'Sharma')
            ->set('departmentId', 1)
            ->set('registerPassword', 'newpassword123')
            ->set('registerPasswordConfirmation', 'newpassword123')
            ->call('register')
            ->assertRedirect('/dashboard');

        $this->assertDatabaseHas('users', ['email' => 'ravi.sharma@acme.com']);
    }
}
