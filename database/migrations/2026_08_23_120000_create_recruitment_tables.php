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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->cascadeOnDelete();
            $table->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('hiring_manager_id')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('requirements')->nullable();
            $table->integer('openings_count')->default(1);
            $table->enum('employment_type', ['full-time', 'part-time', 'contract', 'intern'])->default('full-time');
            $table->date('closing_date')->nullable();
            $table->enum('status', ['draft', 'open', 'closed', 'cancelled'])->default('open');
            $table->timestamps();
        });

        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vacancy_id')->constrained()->cascadeOnDelete();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('nic_passport')->nullable();
            $table->string('cv_path')->nullable();
            $table->enum('source', ['LinkedIn', 'XpressJobs', 'Company Website', 'Referral', 'Manual Entry', 'Other'])->default('Manual Entry');
            $table->enum('status', ['new', 'under-review', 'shortlisted', 'interview-scheduled', 'offered', 'hired', 'rejected'])->default('new');
            $table->text('experience_summary')->nullable();
            $table->timestamps();
        });

        Schema::create('screening_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();
            $table->foreignId('screened_by')->constrained('users')->cascadeOnDelete();
            $table->integer('criteria_score')->default(50);
            $table->enum('suitability', ['high', 'medium', 'low'])->default('medium');
            $table->enum('recommendation', ['shortlist', 'reject', 'interview'])->default('shortlist');
            $table->text('strengths')->nullable();
            $table->text('weaknesses')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();
            $table->foreignId('interviewer_id')->constrained('users')->cascadeOnDelete();
            $table->enum('interview_type', ['screening', 'technical', 'hr', 'managerial'])->default('technical');
            $table->dateTime('scheduled_at');
            $table->string('location_link')->nullable();
            $table->enum('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled');
            $table->text('feedback')->nullable();
            $table->integer('rating')->nullable(); // 1 to 5 stars
            $table->timestamps();
        });

        Schema::create('job_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->constrained()->cascadeOnDelete();
            $table->string('position_title');
            $table->decimal('basic_salary', 12, 2);
            $table->date('offered_joining_date');
            $table->enum('status', ['draft', 'sent', 'accepted', 'rejected', 'expired'])->default('draft');
            $table->timestamps();
        });

        Schema::create('onboarding_tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('candidate_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->string('task_name');
            $table->string('document_type')->nullable(); // e.g., 'NIC Copy', 'EPF B-Card'
            $table->date('due_date')->nullable();
            $table->enum('status', ['pending', 'in-progress', 'completed'])->default('pending');
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('onboarding_tasks');
        Schema::dropIfExists('job_offers');
        Schema::dropIfExists('interviews');
        Schema::dropIfExists('screening_records');
        Schema::dropIfExists('candidates');
        Schema::dropIfExists('vacancies');
    }
};
