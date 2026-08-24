<div class="min-h-screen flex flex-col lg:flex-row font-sans">
    <!-- Left Hero Section (Teal Brand Panel) -->
    <div class="w-full lg:w-5/12 bg-[#00b4a2] p-8 lg:p-14 flex flex-col justify-between text-white min-h-[400px] lg:min-h-screen">
        <div>
            <!-- CEYWork Brand Logo -->
            <div class="flex items-center gap-3">
                <img src="/images/logo.png" alt="CEYWork Logo" class="w-10 h-10 rounded-xl object-cover shadow-md border border-white/20" />
                <span class="text-xl font-bold tracking-tight text-white">CEYWork</span>
            </div>

            <!-- Hero Heading & Description -->
            <div class="mt-12 lg:mt-20 space-y-4">
                <h1 class="text-3xl lg:text-5xl font-bold leading-tight tracking-tight">
                    Your complete<br />people platform.
                </h1>
                <p class="text-white/90 text-sm lg:text-base leading-relaxed max-w-md">
                    Manage the full employee lifecycle — from recruitment to retirement — in one beautiful, unified workspace.
                </p>
            </div>
        </div>

        <!-- Feature Bullets -->
        <div class="mt-12 space-y-6">
            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center text-white shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-white">12 HR Modules</h3>
                    <p class="text-white/75 text-xs">Covering every people process</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center text-white shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-white">Role-Based Access</h3>
                    <p class="text-white/75 text-xs">7 roles, granular permissions</p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="w-11 h-11 rounded-2xl bg-white/10 backdrop-blur-md flex items-center justify-center text-white shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-sm text-white">Real-Time Analytics</h3>
                    <p class="text-white/75 text-xs">Dashboards built for decisions</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Section (Office Background with Floating Login Cards) -->
    <div class="w-full lg:w-7/12 relative bg-slate-900/10 flex flex-col justify-center items-center p-6 lg:p-12 min-h-screen bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1600&auto=format&fit=crop');">
        <!-- Translucent Backdrop Overlay -->
        <div class="absolute inset-0 bg-slate-900/30 backdrop-blur-[2px]"></div>

        <div class="relative z-10 w-full max-w-md space-y-4">

            @if($mode === 'verify_identity' || $mode === 'register')
                <!-- Stepper Navigation Bar -->
                <div class="w-full flex items-center justify-between px-1 text-xs">
                    <div class="flex items-center gap-2">
                        <!-- Step 1 Pill -->
                        <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full font-bold text-xs shadow-sm transition {{ $mode === 'verify_identity' ? 'bg-[#b91c1c] text-white' : 'bg-white/80 text-slate-700 backdrop-blur-md' }}">
                            <span class="w-4 h-4 rounded-full {{ $mode === 'verify_identity' ? 'bg-white text-[#b91c1c]' : 'bg-slate-300 text-slate-700' }} flex items-center justify-center text-[10px] font-black">1</span>
                            <span>Verify Identity</span>
                        </div>
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        <!-- Step 2 Pill -->
                        <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-full font-bold text-xs shadow-sm transition {{ $mode === 'register' ? 'bg-[#b91c1c] text-white' : 'bg-white/80 text-slate-700 backdrop-blur-md' }}">
                            <span class="w-4 h-4 rounded-full {{ $mode === 'register' ? 'bg-white text-[#b91c1c]' : 'bg-slate-300 text-slate-700' }} flex items-center justify-center text-[10px] font-black">2</span>
                            <span>Register</span>
                        </div>
                    </div>
                    <span class="text-slate-300 font-semibold text-[11px] drop-shadow-sm">
                        {{ $mode === 'verify_identity' ? 'Step 1 of 2' : 'Step 2 of 2' }}
                    </span>
                </div>
            @endif

            @if($mode === 'login')
                <!-- SCREEN 1: Main Login Card -->
                <div class="bg-[#fcfbf7] rounded-3xl p-8 lg:p-10 shadow-2xl border border-white/60">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Welcome back</h2>
                        <p class="text-slate-500 text-sm mt-1">Sign in to your CEYWork account.</p>
                    </div>

                    <form wire:submit.prevent="login" class="space-y-5">
                        <!-- Email Address -->
                        <div>
                            <label class="block text-xs font-bold tracking-wider uppercase text-slate-700 mb-2">EMAIL ADDRESS</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input 
                                    type="email" 
                                    wire:model="email" 
                                    placeholder="you@acme.com" 
                                    class="w-full bg-[#f4f6f9] border border-slate-200 text-slate-900 text-sm rounded-xl pl-11 pr-4 py-3 focus:bg-white focus:ring-2 focus:ring-[#00b4a2] focus:border-transparent focus:outline-none transition" 
                                />
                            </div>
                            @error('email') <span class="text-red-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label class="block text-xs font-bold tracking-wider uppercase text-slate-700">PASSWORD</label>
                                <a href="#" class="text-xs font-semibold text-[#cc0000] hover:underline">Forgot password?</a>
                            </div>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input 
                                    type="{{ $showPassword ? 'text' : 'password' }}" 
                                    wire:model="password" 
                                    placeholder="••••••••" 
                                    class="w-full bg-[#f4f6f9] border border-slate-200 text-slate-900 text-sm rounded-xl pl-11 pr-11 py-3 focus:bg-white focus:ring-2 focus:ring-[#00b4a2] focus:border-transparent focus:outline-none transition" 
                                />
                                <button type="button" wire:click="togglePassword" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password') <span class="text-red-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>

                        <!-- Sign In Submit Button -->
                        <button 
                            type="submit" 
                            class="w-full bg-[#b91c1c] hover:bg-[#a11818] text-white font-bold text-sm py-3.5 px-4 rounded-xl shadow-md transition duration-200 active:scale-[0.99] flex items-center justify-center gap-2"
                        >
                            <span>Sign In</span>
                        </button>
                    </form>
                </div>

                <!-- Secondary Activation Card -->
                <div class="bg-[#fcfbf7] rounded-2xl p-4 shadow-xl border border-white/60 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-200 flex items-center justify-center text-emerald-600 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-slate-900">First time using CEYWork?</h4>
                            <p class="text-[11px] text-slate-500">Your account must be created by HR before you can activate it.</p>
                        </div>
                    </div>
                    <button 
                        type="button" 
                        wire:click="setMode('verify_identity')" 
                        class="px-3.5 py-2 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl whitespace-nowrap shadow-sm transition"
                    >
                        Activate Account
                    </button>
                </div>

                <!-- Fast Role Login Bar (Quick testing for all 4 roles) -->
                <div class="bg-slate-900/60 backdrop-blur-md rounded-2xl p-3 border border-white/20 text-white space-y-2">
                    <p class="text-[11px] text-slate-300 font-semibold uppercase tracking-wider text-center">Quick Role Sign-In Test (All 4 User Types):</p>
                    <div class="grid grid-cols-2 gap-2 text-xs font-medium">
                        <button type="button" wire:click="fillDemoRole('admin')" class="px-2.5 py-1.5 bg-white/10 hover:bg-white/20 rounded-lg text-left transition flex items-center justify-between">
                            <span>1. Admin</span>
                            <span class="text-[10px] text-slate-400">admin@ceywork.lk</span>
                        </button>
                        <button type="button" wire:click="fillDemoRole('hr_senior')" class="px-2.5 py-1.5 bg-white/10 hover:bg-white/20 rounded-lg text-left transition flex items-center justify-between">
                            <span>2. HR Senior</span>
                            <span class="text-[10px] text-slate-400">amara.j@ceywork.lk</span>
                        </button>
                        <button type="button" wire:click="fillDemoRole('hr_junior')" class="px-2.5 py-1.5 bg-white/10 hover:bg-white/20 rounded-lg text-left transition flex items-center justify-between">
                            <span>3. HR Junior</span>
                            <span class="text-[10px] text-slate-400">nimali.f@ceywork.lk</span>
                        </button>
                        <button type="button" wire:click="fillDemoRole('employee')" class="px-2.5 py-1.5 bg-white/10 hover:bg-white/20 rounded-lg text-left transition flex items-center justify-between">
                            <span>4. Employee</span>
                            <span class="text-[10px] text-slate-400">kasun.p@ceywork.lk</span>
                        </button>
                    </div>
                </div>

            @elseif($mode === 'verify_identity')
                <!-- SCREEN 2: Verify Identity Card -->
                <div class="bg-[#fcfbf7] rounded-3xl p-8 lg:p-10 shadow-2xl border border-white/60">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-slate-900 tracking-tight">Verify Your Identity</h2>
                        <p class="text-slate-500 text-sm mt-1">Enter your details exactly as provided by HR.</p>
                    </div>

                    <form wire:submit.prevent="verifyIdentity" class="space-y-5">
                        <!-- Company Email -->
                        <div>
                            <label class="block text-xs font-bold tracking-wider uppercase text-slate-700 mb-2">COMPANY EMAIL</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <input 
                                    type="email" 
                                    wire:model="companyEmail" 
                                    placeholder="you@acme.com" 
                                    class="w-full bg-[#f4f6f9] border border-slate-200 text-slate-900 text-sm rounded-xl pl-11 pr-4 py-3 focus:bg-white focus:ring-2 focus:ring-[#00b4a2] focus:border-transparent focus:outline-none transition" 
                                />
                            </div>
                            @error('companyEmail') <span class="text-red-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>

                        <!-- Employee ID -->
                        <div>
                            <label class="block text-xs font-bold tracking-wider uppercase text-slate-700 mb-2">EMPLOYEE ID</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    wire:model="employeeId" 
                                    placeholder="e.g. EMP-011" 
                                    class="w-full bg-[#f4f6f9] border border-slate-200 text-slate-900 text-sm rounded-xl pl-11 pr-4 py-3 focus:bg-white focus:ring-2 focus:ring-[#00b4a2] focus:border-transparent focus:outline-none transition" 
                                />
                            </div>
                            @error('employeeId') <span class="text-red-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>

                        <!-- Office ID -->
                        <div>
                            <label class="block text-xs font-bold tracking-wider uppercase text-slate-700 mb-2 flex items-center gap-1">
                                <span>OFFICE ID</span>
                                <span class="text-[#b91c1c] font-semibold">— ON YOUR ACCESS CARD & CONTRACT</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    wire:model="officeId" 
                                    placeholder="e.g. ACM-ENG-011" 
                                    class="w-full bg-[#f4f6f9] border border-slate-200 text-slate-900 text-sm rounded-xl pl-11 pr-4 py-3 focus:bg-white focus:ring-2 focus:ring-[#00b4a2] focus:border-transparent focus:outline-none transition" 
                                />
                            </div>
                            @error('officeId') <span class="text-red-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>

                        <!-- Error Alert Box -->
                        @error('verification_failed')
                            <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-3 text-xs flex items-center gap-2">
                                <svg class="w-5 h-5 shrink-0 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-medium">{{ $message }}</span>
                            </div>
                        @enderror

                        <!-- Verify Identity Button -->
                        <button 
                            type="submit" 
                            class="w-full bg-[#b91c1c] hover:bg-[#a11818] text-white font-bold text-sm py-3.5 px-4 rounded-xl shadow-md transition duration-200 active:scale-[0.99] flex items-center justify-center gap-2"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <span>Verify Identity</span>
                        </button>

                        <!-- Demo Fill Banner -->
                        <div 
                            wire:click="fillDemoCredentials" 
                            class="bg-[#edf6fd] border border-blue-100 rounded-xl p-3 text-center cursor-pointer hover:bg-blue-100/60 transition group"
                        >
                            <p class="text-xs text-slate-700 font-medium">
                                <strong class="font-bold text-slate-900">Demo:</strong> 
                                <span class="group-hover:underline">Try EMP-011 · ACM-ENG-011 · ravi.sharma@acme.com</span>
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Back to Sign In Link -->
                <div class="text-center pt-2">
                    <button 
                        type="button" 
                        wire:click="setMode('login')" 
                        class="text-xs font-bold text-[#b91c1c] hover:underline flex items-center justify-center gap-1 mx-auto"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Back to Sign In</span>
                    </button>
                </div>

            @elseif($mode === 'register')
                <!-- SCREEN 3: Register Card -->
                <div class="bg-[#fcfbf7] rounded-3xl p-8 lg:p-10 shadow-2xl border border-white/60">
                    <form wire:submit.prevent="register" class="space-y-4">
                        <!-- First Name & Last Name -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold tracking-wider uppercase text-slate-700 mb-2">FIRST NAME</label>
                                <input 
                                    type="text" 
                                    wire:model="firstName" 
                                    placeholder="Jane" 
                                    class="w-full bg-[#f4f6f9] border border-slate-200 text-slate-900 text-sm rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-[#00b4a2] focus:border-transparent focus:outline-none transition" 
                                />
                                @error('firstName') <span class="text-red-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-bold tracking-wider uppercase text-slate-700 mb-2">LAST NAME</label>
                                <input 
                                    type="text" 
                                    wire:model="lastName" 
                                    placeholder="Smith" 
                                    class="w-full bg-[#f4f6f9] border border-slate-200 text-slate-900 text-sm rounded-xl px-4 py-3 focus:bg-white focus:ring-2 focus:ring-[#00b4a2] focus:border-transparent focus:outline-none transition" 
                                />
                                @error('lastName') <span class="text-red-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Department Dropdown -->
                        <div>
                            <label class="block text-xs font-bold tracking-wider uppercase text-slate-700 mb-2">DEPARTMENT</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V9a2 2 0 012-2h2a2 2 0 012 2v12m-6 0h6" />
                                    </svg>
                                </div>
                                <select 
                                    wire:model="departmentId" 
                                    class="w-full bg-[#f4f6f9] border border-slate-200 text-slate-900 text-sm rounded-xl pl-11 pr-8 py-3 focus:bg-white focus:ring-2 focus:ring-[#00b4a2] focus:border-transparent focus:outline-none transition appearance-none cursor-pointer"
                                >
                                    <option value="">Select Department</option>
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </div>
                            </div>
                            @error('departmentId') <span class="text-red-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="block text-xs font-bold tracking-wider uppercase text-slate-700 mb-2">PASSWORD</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input 
                                    type="{{ $showRegisterPassword ? 'text' : 'password' }}" 
                                    wire:model="registerPassword" 
                                    placeholder="Min. 8 characters" 
                                    class="w-full bg-[#f4f6f9] border border-slate-200 text-slate-900 text-sm rounded-xl pl-11 pr-11 py-3 focus:bg-white focus:ring-2 focus:ring-[#00b4a2] focus:border-transparent focus:outline-none transition" 
                                />
                                <button type="button" wire:click="toggleRegisterPassword" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                            @error('registerPassword') <span class="text-red-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="block text-xs font-bold tracking-wider uppercase text-slate-700 mb-2">CONFIRM PASSWORD</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                </div>
                                <input 
                                    type="{{ $showRegisterPassword ? 'text' : 'password' }}" 
                                    wire:model="registerPasswordConfirmation" 
                                    placeholder="Repeat password" 
                                    class="w-full bg-[#f4f6f9] border border-slate-200 text-slate-900 text-sm rounded-xl pl-11 pr-4 py-3 focus:bg-white focus:ring-2 focus:ring-[#00b4a2] focus:border-transparent focus:outline-none transition" 
                                />
                            </div>
                            @error('registerPasswordConfirmation') <span class="text-red-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                        </div>

                        <!-- Create Account Button -->
                        <button 
                            type="submit" 
                            class="w-full bg-[#b91c1c] hover:bg-[#a11818] text-white font-bold text-sm py-3.5 px-4 rounded-xl shadow-md transition duration-200 active:scale-[0.99]"
                        >
                            Create Account
                        </button>

                        <p class="text-[11px] text-slate-500 text-center pt-1">
                            By registering you agree to CEYWork's <a href="#" class="text-[#b91c1c] hover:underline font-medium">Terms of Service</a> and <a href="#" class="text-[#b91c1c] hover:underline font-medium">Privacy Policy</a>.
                        </p>
                    </form>
                </div>

                <!-- Back to Verify Identity Link -->
                <div class="text-center pt-2">
                    <button 
                        type="button" 
                        wire:click="setMode('verify_identity')" 
                        class="text-xs font-bold text-[#b91c1c] hover:underline flex items-center justify-center gap-1 mx-auto"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Back to Verify Identity</span>
                    </button>
                </div>
            @endif

        </div>
    </div>
</div>
