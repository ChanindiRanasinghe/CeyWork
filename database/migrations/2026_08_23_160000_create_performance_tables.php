<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kpis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->string('title');
            $table->string('department')->default('General');
            $table->string('status')->default('on-track'); // on-track, exceeded, at-risk
            $table->string('target');
            $table->string('actual');
            $table->integer('percentage')->default(0);
            $table->string('trend')->default('up'); // up, down, neutral
            $table->timestamps();
        });

        Schema::create('performance_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('reviewer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('period')->default('Q3 2026');
            $table->decimal('self_rating', 3, 1)->default(4.0);
            $table->decimal('manager_rating', 3, 1)->nullable();
            $table->string('status')->default('Completed'); // Draft, In Review, Pending Manager Review, Completed
            $table->text('feedback')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('performance_reviews');
        Schema::dropIfExists('kpis');
    }
};

