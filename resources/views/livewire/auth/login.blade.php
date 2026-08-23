<div class="min-h-screen flex flex-col lg:flex-row font-sans">
    <!-- Left Hero Section (Teal Brand Panel) -->
    <div class="w-full lg:w-5/12 bg-[#00b4a2] p-8 lg:p-14 flex flex-col justify-between text-white min-h-[400px] lg:min-h-screen">
        <div>
            <!-- CEYWork Brand Logo -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#cc0000] flex items-center justify-center shadow-md">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
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
            <!-- Main Login Card -->
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
                                type="password" 
                                wire:model="password" 
                                placeholder="••••••••" 
                                class="w-full bg-[#f4f6f9] border border-slate-200 text-slate-900 text-sm rounded-xl pl-11 pr-11 py-3 focus:bg-white focus:ring-2 focus:ring-[#00b4a2] focus:border-transparent focus:outline-none transition" 
                            />
                            <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 cursor-pointer">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                        </div>
                        @error('password') <span class="text-red-600 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>

                    <!-- Sign In Submit Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-[#b91c1c] hover:bg-[#a11818] text-white font-bold text-sm py-3.5 px-4 rounded-xl shadow-md transition duration-200 active:scale-[0.99]"
                    >
                        Sign In
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
                <a href="#" class="px-3.5 py-2 bg-[#059669] hover:bg-[#047857] text-white text-xs font-bold rounded-xl whitespace-nowrap shadow-sm transition">
                    Activate Account
                </a>
            </div>
        </div>
    </div>
</div>
