<?php

namespace App\Livewire\Auth;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    // Mode navigation: 'login', 'verify_identity', 'register'
    public string $mode = 'login';

    // Screen 1: Login Form
    public string $email = '';
    public string $password = '';
    public bool $remember = false;
    public bool $showPassword = false;

    // Screen 2: Verify Identity Form
    public string $companyEmail = '';
    public string $employeeId = '';
    public string $officeId = '';
    public ?int $verifiedEmployeeId = null;

    // Screen 3: Register Form
    public string $firstName = '';
    public string $lastName = '';
    public ?int $departmentId = null;
    public string $registerPassword = '';
    public string $registerPasswordConfirmation = '';
    public bool $showRegisterPassword = false;

    public function setMode(string $newMode): void
    {
        $this->mode = $newMode;
        $this->resetValidation();
    }

    public function togglePassword(): void
    {
        $this->showPassword = !$this->showPassword;
    }

    public function toggleRegisterPassword(): void
    {
        $this->showRegisterPassword = !$this->showRegisterPassword;
    }

    public function fillDemoCredentials(): void
    {
        $this->companyEmail = 'ravi.sharma@acme.com';
        $this->employeeId = 'EMP-011';
        $this->officeId = 'ACM-ENG-011';
        $this->resetValidation();
    }

    public function fillDemoRole(string $roleType): void
    {
        $this->mode = 'login';
        if ($roleType === 'admin') {
            $this->email = 'admin@ceywork.lk';
            $this->password = 'password';
        } elseif ($roleType === 'hr_senior') {
            $this->email = 'amara.j@ceywork.lk';
            $this->password = 'password';
        } elseif ($roleType === 'hr_junior') {
            $this->email = 'nimali.f@ceywork.lk';
            $this->password = 'password';
        } elseif ($roleType === 'employee') {
            $this->email = 'kasun.p@ceywork.lk';
            $this->password = 'password';
        }
        $this->resetValidation();
    }

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        $this->addError('email', 'The provided credentials do not match our records.');
    }

    public function verifyIdentity()
    {
        $this->validate([
            'companyEmail' => 'required|email',
            'employeeId' => 'required|string',
            'officeId' => 'required|string',
        ], [
            'companyEmail.required' => 'All fields are required.',
            'employeeId.required' => 'All fields are required.',
            'officeId.required' => 'All fields are required.',
        ]);

        // Find matching employee record by email, employee_code, and office_id (case insensitive)
        $employee = Employee::where(function ($q) {
            $q->whereRaw('LOWER(email) = ?', [strtolower(trim($this->companyEmail))])
              ->orWhereRaw('LOWER(email) = ?', [strtolower(str_replace('@acme.com', '@ceywork.lk', trim($this->companyEmail)))]);
        })
        ->whereRaw('LOWER(employee_code) = ?', [strtolower(trim($this->employeeId))])
        ->whereRaw('LOWER(office_id) = ?', [strtolower(trim($this->officeId))])
        ->first();

        if (!$employee) {
            $this->addError('verification_failed', 'All fields are required. We could not verify an employee record matching these details.');
            return;
        }

        if ($employee->user_id) {
            $this->addError('verification_failed', 'This employee account has already been activated. Please sign in.');
            return;
        }

        // Successfully verified! Pre-fill step 2 data
        $this->verifiedEmployeeId = $employee->id;
        $this->firstName = $employee->first_name;
        $this->lastName = $employee->last_name;
        $this->departmentId = $employee->department_id;
        $this->mode = 'register';
        $this->resetValidation();
    }

    public function register()
    {
        $this->validate([
            'firstName' => 'required|string|max:100',
            'lastName' => 'required|string|max:100',
            'departmentId' => 'required|exists:departments,id',
            'registerPassword' => 'required|string|min:8',
            'registerPasswordConfirmation' => 'required|same:registerPassword',
        ], [
            'registerPasswordConfirmation.same' => 'Passwords do not match.',
            'registerPassword.min' => 'Password must be at least 8 characters.',
        ]);

        $employee = Employee::find($this->verifiedEmployeeId);

        if (!$employee) {
            // Fallback if session state lost
            $employee = Employee::whereRaw('LOWER(email) = ?', [strtolower(trim($this->companyEmail))])->first();
        }

        $emailToUse = $employee ? $employee->email : $this->companyEmail;

        // Check if user already exists
        $existingUser = User::where('email', $emailToUse)->first();
        if ($existingUser) {
            $this->addError('registerPassword', 'An account with this email address already exists. Please sign in.');
            return;
        }

        // Create User account
        $user = User::create([
            'name' => trim($this->firstName . ' ' . $this->lastName),
            'email' => $emailToUse,
            'password' => Hash::make($this->registerPassword),
            'company_id' => $employee ? $employee->company_id : 1,
        ]);

        // Assign default role
        $user->assignRole('Employee');

        // Link Employee record
        if ($employee) {
            $employee->update([
                'user_id' => $user->id,
                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
                'department_id' => $this->departmentId,
            ]);
        }

        // Authenticate user & redirect
        Auth::login($user);
        session()->regenerate();

        return redirect()->intended('/dashboard');
    }

    public function render()
    {
        return view('livewire.auth.login', [
            'departments' => Department::orderBy('name')->get(),
        ])->layout('layouts.guest', [
            'title' => 'Sign In - CEYWork'
        ]);
    }
}

