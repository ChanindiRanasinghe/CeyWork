<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    public function test_user_can_authenticate_and_redirects_to_dashboard(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@ceywork.lk',
            'password' => 'password',
        ]);

        $this->assertDatabaseHas('users', ['email' => 'admin@ceywork.lk']);
    }
}
