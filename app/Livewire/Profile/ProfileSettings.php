<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ProfileSettings extends Component
{
    public string $activeTab = 'personal'; // 'personal', 'security', 'notifications', 'preferences'

    // Personal Info Fields matching screenshot
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $location = '';
    public string $bio = '';

    // Security Fields
    public string $current_password = '';
    public string $new_password = '';
    public string $new_password_confirmation = '';

    // Notifications Toggles
    public bool $emailNotifications = true;
    public bool $leaveAlerts = true;
    public bool $payrollAlerts = true;

    // Preferences
    public string $language = 'English (US)';
    public string $currency = 'LKR (Rs.)';

    public ?string $successMessage = null;
    public ?string $lastUpdated = null;

    public function mount()
    {
        $user = Auth::user() ?? User::first();
        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;

            // Check if user has an associated Employee record
            $emp = $user->employee;
            if ($emp) {
                $this->phone = $emp->phone ?: '0754746372';
                $this->location = $emp->address ?: 'No.30, Colombo 07, Peris Road';
            } else {
                $this->phone = '0754746372';
                $this->location = 'No.30, Colombo 07, Peris Road';
            }

            $this->bio = 'HR Manager with 8+ years experience driving people strategy and organizational growth.';
        }
        $this->lastUpdated = 'Aug 22, 2026';
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
        $this->successMessage = null;
    }

    public function saveProfile(): void
    {
        $user = Auth::user() ?? User::first();

        $this->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:500',
        ]);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        if ($user->employee) {
            $user->employee->update([
                'first_name' => explode(' ', $this->name)[0] ?? $this->name,
                'last_name' => explode(' ', $this->name)[1] ?? '',
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->location,
            ]);
        }

        $this->lastUpdated = date('M d, Y');
        $this->successMessage = 'Profile information saved successfully!';
    }

    public function updatePassword(): void
    {
        $user = Auth::user() ?? User::first();

        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|same:new_password_confirmation',
        ]);

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'The current password provided is incorrect.');
            return;
        }

        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        $this->successMessage = 'Password updated successfully!';
    }

    public function render()
    {
        $user = Auth::user() ?? User::first();
        $initials = collect(explode(' ', $this->name))->map(fn($part) => strtoupper(substr($part, 0, 1)))->take(2)->join('');
        if (empty($initials)) { $initials = 'CR'; }

        $roleName = $user?->roles->first()?->name ?? ($user?->isAdmin() ? 'System Administrator' : 'HR Manager');

        return view('livewire.profile.profile-settings', [
            'user' => $user,
            'initials' => $initials,
            'roleName' => $roleName,
        ])->layout('components.layout.app', [
            'title' => 'Profile Settings - CEYWork'
        ]);
    }
}
