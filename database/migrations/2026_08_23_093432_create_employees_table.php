<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('company_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('reporting_manager_id')->nullable()->references('id')->on('employees')->nullOnDelete();
            
            // Primary Identity
            $table->string('employee_code')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('nic_passport')->nullable(); // Sri Lankan NIC or Passport
            $table->date('dob')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->default('male');
            
            // Employment Information
            $table->string('designation');
            $table->string('branch')->default('Head Office');
            $table->string('cost_center')->nullable();
            $table->string('grade')->nullable();
            $table->enum('contract_type', ['permanent', 'probation', 'contract', 'intern'])->default('probation');
            $table->date('joined_date');
            $table->enum('status', ['active', 'on-leave', 'suspended', 'terminated'])->default('active');
            
            // Compensation & Sri Lankan Statutory Fields
            $table->decimal('basic_salary', 12, 2)->default(0.00);
            $table->string('epf_number')->nullable(); // EPF (Employee Provident Fund)
            $table->string('etf_number')->nullable(); // ETF (Employee Trust Fund)
            $table->string('b_card_no')->nullable();  // Sri Lanka B Card
            
            // Banking Information
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('bank_account_no')->nullable();
            
            // Emergency Contact
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            
            // Custom Fields (Flexible JSON schema)
            $table->json('custom_fields')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
