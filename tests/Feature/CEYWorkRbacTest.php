<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CEYWorkRbacTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_admin_portal_requires_admin_role(): void
    {
        $employeeUser = User::where('email', 'kasun.p@ceywork.lk')->first();
        
        $response = $this->actingAs($employeeUser)->get('/admin');
        $response->assertStatus(403);
    }

    public function test_admin_can_access_admin_portal(): void
    {
        $adminUser = User::where('email', 'admin@ceywork.lk')->first();
        
        $response = $this->actingAs($adminUser)->get('/admin');
        $response->assertStatus(200);
    }

    public function test_dashboard_is_accessible_by_authenticated_user(): void
    {
        $adminUser = User::where('email', 'admin@ceywork.lk')->first();
        
        $response = $this->actingAs($adminUser)->get('/dashboard');
        $response->assertStatus(200);
    }
}
