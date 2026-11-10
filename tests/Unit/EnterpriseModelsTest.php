<?php

namespace Tests\Unit;

use App\Models\Asset;
use App\Models\Company;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Kpi;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use App\Models\PayrollRecord;
use App\Models\PerformanceReview;
use App\Models\Training;
use App\Models\TrainingEnrollment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnterpriseModelsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_leave_balance_and_request_relationships(): void
    {
        $employee = Employee::first();
        $balance = LeaveBalance::where('employee_id', $employee->id)->first();

        $this->assertNotNull($balance);
        $this->assertEquals($employee->id, $balance->employee->id);
        $this->assertGreaterThanOrEqual(0, $balance->annual_remaining);
        $this->assertGreaterThanOrEqual(0, $balance->casual_remaining);
        $this->assertGreaterThanOrEqual(0, $balance->sick_remaining);

        $request = LeaveRequest::where('employee_id', $employee->id)->first();
        $this->assertNotNull($request);
        $this->assertEquals('pending', $request->status);
    }

    public function test_asset_creation_and_assignment(): void
    {
        $asset = Asset::where('code', 'AST-001')->first();
        $this->assertNotNull($asset);
        $this->assertEquals('Laptop', $asset->category);
        $this->assertNotNull($asset->employee);
        $this->assertNotNull($asset->company);
    }

    public function test_training_and_enrollment_relationship(): void
    {
        $training = Training::first();
        $this->assertNotNull($training);
        $this->assertTrue($training->is_mandatory);
        $this->assertNotEmpty($training->enrollments);
    }

    public function test_kpi_and_performance_review(): void
    {
        $kpi = Kpi::first();
        $this->assertNotNull($kpi);
        $this->assertEquals('on-track', $kpi->status);

        $review = PerformanceReview::first();
        $this->assertNotNull($review);
        $this->assertEquals(4.8, (float) $review->self_rating);
        $this->assertEquals('Completed', $review->status);
    }

    public function test_payroll_record_calculations(): void
    {
        $record = PayrollRecord::first();
        $this->assertNotNull($record);
        $this->assertEquals('2026-08', $record->month);
        $this->assertEquals(350000.00, (float) $record->basic_salary);
        $this->assertEquals(28000.00, (float) $record->epf_employee);
        $this->assertEquals(42000.00, (float) $record->epf_employer);
        $this->assertEquals(10500.00, (float) $record->etf_employer);
    }
}

