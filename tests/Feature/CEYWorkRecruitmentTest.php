<?php

namespace Tests\Feature;

use App\Models\Candidate;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CEYWorkRecruitmentTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_authorized_user_can_access_vacancies_page(): void
    {
        $hrUser = User::where('email', 'amara.j@ceywork.lk')->first();

        $response = $this->actingAs($hrUser)->get('/recruitment/vacancies');
        $response->assertStatus(200);
    }

    public function test_authorized_user_can_access_candidates_pipeline(): void
    {
        $hrUser = User::where('email', 'amara.j@ceywork.lk')->first();

        $response = $this->actingAs($hrUser)->get('/recruitment/candidates');
        $response->assertStatus(200);
        $response->assertSee('Saman Silva');
    }
}
