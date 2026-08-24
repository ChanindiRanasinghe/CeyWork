<?php

use App\Http\Middleware\AdminPortalMiddleware;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Auth\Login;
use App\Livewire\Dashboard\HRDashboard;
use App\Livewire\Employee\EmployeeList;
use App\Livewire\Payroll\PayrollProcessor;
use App\Livewire\Recruitment\CandidatePipeline;
use App\Livewire\Recruitment\VacancyManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', Login::class)->name('login');
Route::post('/logout', function () {
    auth()->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

// Main HR Portal Routes
Route::get('/dashboard', HRDashboard::class)->name('dashboard');
Route::get('/employees', EmployeeList::class)->name('employees');
use App\Livewire\Onboarding\OnboardingDashboard;
use App\Livewire\Recruitment\RecruitmentHub;

// Onboarding Module Route
Route::get('/onboarding', OnboardingDashboard::class)->name('onboarding');

// Recruitment & ATS Module Routes
Route::get('/recruitment', RecruitmentHub::class)->name('recruitment');
Route::get('/recruitment/vacancies', RecruitmentHub::class)->name('recruitment.vacancies');
Route::get('/recruitment/candidates', RecruitmentHub::class)->name('recruitment.candidates');
Route::get('/recruitment/interviews', RecruitmentHub::class)->name('recruitment.interviews');

// Admin Portal Protected Area (/admin)
Route::middleware([AdminPortalMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/companies', AdminDashboard::class)->name('admin.companies');
    Route::get('/roles', AdminDashboard::class)->name('admin.roles');
    Route::get('/users', AdminDashboard::class)->name('admin.users');
    Route::get('/departments', AdminDashboard::class)->name('admin.departments');
});

Route::view('/test', 'component-test');