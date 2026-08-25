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

use App\Livewire\Dashboard\EmployeeDashboard;
use App\Livewire\Onboarding\OnboardingDashboard;
use App\Livewire\Offboarding\OffboardingDashboard;
use App\Livewire\Attendance\AttendanceDashboard;
use App\Livewire\Recruitment\RecruitmentHub;

// Main HR Portal & Employee Self-Service Dashboard Routes
Route::get('/dashboard', function() {
    $user = auth()->user();
    if ($user && $user->hasRole('Employee') && !$user->isAdmin() && !$user->hasAnyRole(['HR Senior', 'HR Manager', 'HR Junior', 'System Administrator', 'Company Administrator'])) {
        return redirect()->route('employee.dashboard');
    }
    return app(HRDashboard::class)();
})->name('dashboard');

Route::get('/employee/dashboard', EmployeeDashboard::class)->name('employee.dashboard');
Route::get('/employees', EmployeeList::class)->name('employees');

// Onboarding Module Route
Route::get('/onboarding', OnboardingDashboard::class)->name('onboarding');

// Offboarding Module Route (Restricted to HR & Management)
Route::get('/offboarding', OffboardingDashboard::class)->name('offboarding');

// Attendance & Leave Management Route (Restricted to HR & Management)
Route::get('/attendance', AttendanceDashboard::class)->name('attendance');

use App\Livewire\Performance\PerformanceDashboard;
use App\Livewire\Training\TrainingDashboard;
use App\Livewire\Assets\AssetManagement;
use App\Livewire\Reports\ReportsAnalytics;
use App\Livewire\Profile\ProfileSettings;

// Profile Settings Route (Accessible to Everyone)
Route::get('/profile', ProfileSettings::class)->name('profile');

// Payroll Management Route (Restricted to System Admin & Senior HR)
Route::get('/payroll', PayrollProcessor::class)->name('payroll');

// Performance Module Route (Visible to Everyone)
Route::get('/performance', PerformanceDashboard::class)->name('performance');

// Training Module Route (Visible to Everyone)
Route::get('/training', TrainingDashboard::class)->name('training');

// Asset Management Route (Restricted to Admin & Management Only)
Route::get('/assets', AssetManagement::class)->name('assets');

// Reports & Analytics Route (Restricted to Admin & Management Only)
Route::get('/reports', ReportsAnalytics::class)->name('reports');

// Recruitment & ATS Module Routes
Route::get('/recruitment', RecruitmentHub::class)->name('recruitment');
Route::get('/recruitment/vacancies', RecruitmentHub::class)->name('recruitment.vacancies');
Route::get('/recruitment/candidates', RecruitmentHub::class)->name('recruitment.candidates');
Route::get('/recruitment/interviews', RecruitmentHub::class)->name('recruitment.interviews');

// Admin Portal Area (/admin - Restricted to Admins & HR Managers)
Route::get('/admin', AdminDashboard::class)->name('admin.dashboard');
Route::get('/admin/companies', AdminDashboard::class)->name('admin.companies');
Route::get('/admin/roles', AdminDashboard::class)->name('admin.roles');
Route::get('/admin/users', AdminDashboard::class)->name('admin.users');
Route::get('/admin/departments', AdminDashboard::class)->name('admin.departments');

Route::view('/test', 'component-test');