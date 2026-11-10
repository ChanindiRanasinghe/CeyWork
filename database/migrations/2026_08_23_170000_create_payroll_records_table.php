<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payroll_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->string('month'); // e.g. 2026-08
            $table->decimal('basic_salary', 12, 2);
            $table->decimal('allowances', 12, 2)->default(0.00);
            $table->decimal('epf_employee', 12, 2); // 8%
            $table->decimal('epf_employer', 12, 2); // 12%
            $table->decimal('etf_employer', 12, 2); // 3%
            $table->decimal('net_salary', 12, 2);
            $table->enum('status', ['draft', 'processed', 'paid'])->default('processed');
            $table->date('payment_date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payroll_records');
    }
};

