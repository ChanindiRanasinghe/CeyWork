<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leave_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->integer('year')->default(2026);
            $table->integer('annual_total')->default(14);
            $table->integer('annual_taken')->default(0);
            $table->integer('casual_total')->default(7);
            $table->integer('casual_taken')->default(0);
            $table->integer('sick_total')->default(14);
            $table->integer('sick_taken')->default(0);
            $table->timestamps();
        });

        Schema::create('leave_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('leave_type'); // annual, casual, sick, maternity, unpaid
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('days_count')->default(1);
            $table->text('reason')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
        Schema::dropIfExists('leave_balances');
    }
};

