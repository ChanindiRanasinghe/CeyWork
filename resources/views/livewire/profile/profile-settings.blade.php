<div class="space-y-6 bg-[#fdfbf4] min-h-screen p-3 sm:p-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Profile Settings</h1>
            <p class="text-slate-500 text-xs sm:text-sm mt-1 font-medium">
                Manage your personal information, security, and preferences.
            </p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button 
                type="submit" 
                class="px-4 py-2 bg-white border border-slate-200 rounded-2xl shadow-xs text-xs font-bold text-slate-800 hover:bg-slate-50 transition flex items-center gap-2 cursor-pointer"
            >
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Sign Out</span>
            </button>
        </form>
    </div>

    <!-- User Hero Card -->
    <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex items-center gap-5">
        <!-- Avatar with Camera Badge -->
        <div class="relative shrink-0">
            <div class="w-16 h-16 rounded-2xl bg-[#b91c1c] text-white font-black text-xl flex items-center justify-center shadow-xs">
                {{ $initials }}
            </div>
            <button 
                type="button" 
                class="absolute -bottom-1 -right-1 w-6 h-6 rounded-full bg-white border border-slate-200 text-slate-600 flex items-center justify-center shadow-xs hover:bg-slate-50 transition cursor-pointer"
                title="Update Profile Photo"
            >
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>
        </div>

        <div>
            <h2 class="text-xl font-extrabold text-slate-900 leading-tight">{{ $name }}</h2>
            <p class="text-xs text-slate-400 font-medium leading-tight mt-0.5">{{ $email }}</p>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="border-b border-slate-200/80 flex items-center gap-8 pt-2 text-sm font-bold">
        <button 
            type="button" 
            wire:click="setTab('personal')"
            class="pb-3 border-b-2 transition {{ $activeTab === 'personal' ? 'border-[#b91c1c] text-[#b91c1c] font-extrabold' : 'border-transparent text-slate-500 hover:text-slate-800' }}"
        >
            Personal Info
        </button>
        <button 
            type="button" 
            wire:click="setTab('security')"
            class="pb-3 border-b-2 transition {{ $activeTab === 'security' ? 'border-[#b91c1c] text-[#b91c1c] font-extrabold' : 'border-transparent text-slate-500 hover:text-slate-800' }}"
        >
            Security
        </button>
        <button 
            type="button" 
            wire:click="setTab('notifications')"
            class="pb-3 border-b-2 transition {{ $activeTab === 'notifications' ? 'border-[#b91c1c] text-[#b91c1c] font-extrabold' : 'border-transparent text-slate-500 hover:text-slate-800' }}"
        >
            Notifications
        </button>
        <button 
            type="button" 
            wire:click="setTab('preferences')"
            class="pb-3 border-b-2 transition {{ $activeTab === 'preferences' ? 'border-[#b91c1c] text-[#b91c1c] font-extrabold' : 'border-transparent text-slate-500 hover:text-slate-800' }}"
        >
            Preferences
        </button>
    </div>

    <!-- Success Notification Banner -->
    @if($successMessage)
        <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center justify-between gap-3 text-xs font-extrabold text-emerald-900 shadow-xs">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                </svg>
                <span>{{ $successMessage }}</span>
            </div>
            <button wire:click="$set('successMessage', null)" class="text-emerald-500 hover:text-emerald-800 font-black text-sm">✕</button>
        </div>
    @endif

    <!-- TAB 1: Personal Info Form -->
    @if($activeTab === 'personal')
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <form wire:submit.prevent="saveProfile" class="space-y-6">
                <!-- 2-Column Grid for Fields -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- FULL NAME -->
                    <div>
                        <label class="block text-[11px] font-black tracking-wider text-slate-400 uppercase mb-2">FULL NAME</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                wire:model="name" 
                                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-xs font-bold rounded-2xl pl-10 pr-4 py-3 focus:bg-white focus:border-[#00b4a2] focus:outline-none transition"
                            />
                        </div>
                        @error('name') <span class="text-rose-600 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- EMAIL -->
                    <div>
                        <label class="block text-[11px] font-black tracking-wider text-slate-400 uppercase mb-2">EMAIL</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <input 
                                type="email" 
                                wire:model="email" 
                                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-xs font-bold rounded-2xl pl-10 pr-4 py-3 focus:bg-white focus:border-[#00b4a2] focus:outline-none transition"
                            />
                        </div>
                        @error('email') <span class="text-rose-600 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- PHONE -->
                    <div>
                        <label class="block text-[11px] font-black tracking-wider text-slate-400 uppercase mb-2">PHONE</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                wire:model="phone" 
                                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-xs font-bold rounded-2xl pl-10 pr-4 py-3 focus:bg-white focus:border-[#00b4a2] focus:outline-none transition"
                            />
                        </div>
                        @error('phone') <span class="text-rose-600 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- LOCATION -->
                    <div>
                        <label class="block text-[11px] font-black tracking-wider text-slate-400 uppercase mb-2">LOCATION</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                wire:model="location" 
                                class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-xs font-bold rounded-2xl pl-10 pr-4 py-3 focus:bg-white focus:border-[#00b4a2] focus:outline-none transition"
                            />
                        </div>
                        @error('location') <span class="text-rose-600 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- BIO -->
                <div>
                    <label class="block text-[11px] font-black tracking-wider text-slate-400 uppercase mb-2">BIO</label>
                    <textarea 
                        wire:model="bio" 
                        rows="3"
                        class="w-full bg-slate-50 border border-slate-200 text-slate-900 text-xs font-semibold rounded-2xl p-4 focus:bg-white focus:border-[#00b4a2] focus:outline-none transition"
                    ></textarea>
                </div>

                <!-- Footer Bar -->
                <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                    <p class="text-xs font-semibold text-slate-400">Last updated: {{ $lastUpdated }}</p>
                    <button 
                        type="submit" 
                        class="px-6 py-3 bg-[#b91c1c] hover:bg-[#a11818] text-white font-extrabold text-xs rounded-2xl shadow-xs transition cursor-pointer"
                    >
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    @endif

    <!-- TAB 2: Security Form -->
    @if($activeTab === 'security')
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <h3 class="text-base font-extrabold text-slate-900">Change Password</h3>
            <form wire:submit.prevent="updatePassword" class="space-y-4 max-w-md text-xs">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Current Password *</label>
                    <input 
                        type="password" 
                        wire:model="current_password" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                    />
                    @error('current_password') <span class="text-rose-600 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">New Password *</label>
                    <input 
                        type="password" 
                        wire:model="new_password" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                    />
                    @error('new_password') <span class="text-rose-600 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Confirm New Password *</label>
                    <input 
                        type="password" 
                        wire:model="new_password_confirmation" 
                        class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                    />
                </div>
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-[#b91c1c] hover:bg-[#a11818] text-white font-extrabold text-xs rounded-2xl shadow-xs transition cursor-pointer"
                >
                    Update Password
                </button>
            </form>
        </div>
    @endif

    <!-- TAB 3: Notifications -->
    @if($activeTab === 'notifications')
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <h3 class="text-base font-extrabold text-slate-900">Notification Preferences</h3>
            <div class="space-y-4 max-w-md text-xs font-semibold">
                <label class="flex items-center justify-between p-3 bg-slate-50 rounded-2xl border border-slate-200 cursor-pointer">
                    <span class="text-slate-800">Email Notifications for Workflows</span>
                    <input type="checkbox" wire:model="emailNotifications" class="w-4 h-4 text-[#b91c1c] rounded">
                </label>
                <label class="flex items-center justify-between p-3 bg-slate-50 rounded-2xl border border-slate-200 cursor-pointer">
                    <span class="text-slate-800">Leave Application Status Alerts</span>
                    <input type="checkbox" wire:model="leaveAlerts" class="w-4 h-4 text-[#b91c1c] rounded">
                </label>
                <label class="flex items-center justify-between p-3 bg-slate-50 rounded-2xl border border-slate-200 cursor-pointer">
                    <span class="text-slate-800">Monthly Payslip Ready Alerts</span>
                    <input type="checkbox" wire:model="payrollAlerts" class="w-4 h-4 text-[#b91c1c] rounded">
                </label>
            </div>
        </div>
    @endif

    <!-- TAB 4: Preferences -->
    @if($activeTab === 'preferences')
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
            <h3 class="text-base font-extrabold text-slate-900">System Preferences</h3>
            <div class="space-y-4 max-w-md text-xs">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Language</label>
                    <select wire:model="language" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-900">
                        <option value="English (US)">English (US)</option>
                        <option value="Sinhala (lki)">Sinhala (Sri Lanka)</option>
                        <option value="Tamil (ta)">Tamil (Sri Lanka)</option>
                    </select>
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Default Currency</label>
                    <select wire:model="currency" class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-900">
                        <option value="LKR (Rs.)">LKR (Sri Lankan Rupee)</option>
                        <option value="USD ($)">USD ($)</option>
                    </select>
                </div>
            </div>
        </div>
    @endif
</div>
