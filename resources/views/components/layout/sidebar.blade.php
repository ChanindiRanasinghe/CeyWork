@props(['user' => null])

@php
$user = $user ?? auth()->user();
$userName = $user?->name ?? 'Sarah Reynolds';
$userRole = $user?->roles->first()?->name ?? ($user?->isAdmin() ? 'System Administrator' : 'HR Manager');
$userInitials = collect(explode(' ', $userName))->map(fn($part) => strtoupper(substr($part, 0, 1)))->take(2)->join('');
if (empty($userInitials)) { $userInitials = 'SR'; }
@endphp

<aside class="w-64 shrink-0 bg-[#00b4a2] min-h-screen flex flex-col justify-between p-5 text-white shadow-xl z-20">
    <div>
        <!-- Brand Logo Header -->
        <div class="flex items-center gap-3 px-2 mb-8">
            <img src="/images/logo.png" alt="CEYWork Logo" class="w-10 h-10 rounded-xl object-cover shadow-md border border-white/20 shrink-0" />
            <span class="text-xl font-bold tracking-tight text-white">CEYWork</span>
        </div>

        <!-- Navigation Sections -->
        <nav class="space-y-6">
            <!-- WORKSPACE -->
            <div>
                <p class="px-3 text-[11px] font-bold tracking-widest text-white/70 uppercase mb-2">WORKSPACE</p>
                <div class="space-y-1">
                    <a href="/dashboard" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-semibold text-sm transition {{ request()->is('dashboard') || request()->is('/') ? 'bg-[#b91c1c] text-white shadow-md' : 'text-white/90 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="/employees" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition {{ request()->is('employees*') ? 'bg-[#b91c1c] text-white shadow-md' : 'text-white/90 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span>Employees</span>
                    </a>
                </div>
            </div>

            <!-- TALENT -->
            <div>
                <p class="px-3 text-[11px] font-bold tracking-widest text-white/70 uppercase mb-2">TALENT</p>
                <div class="space-y-1">
                    <a href="/recruitment/vacancies" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition {{ request()->is('recruitment*') ? 'bg-[#b91c1c] text-white shadow-md' : 'text-white/90 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>Recruitment</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm text-white/90 hover:bg-white/10 hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        <span>Onboarding</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm text-white/90 hover:bg-white/10 hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Offboarding</span>
                    </a>
                </div>
            </div>

            <!-- OPERATIONS -->
            <div>
                <p class="px-3 text-[11px] font-bold tracking-widest text-white/70 uppercase mb-2">OPERATIONS</p>
                <div class="space-y-1">
                    <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm text-white/90 hover:bg-white/10 hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Attendance & Leave</span>
                    </a>
                    <a href="/payroll" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition {{ request()->is('payroll*') ? 'bg-[#b91c1c] text-white shadow-md' : 'text-white/90 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Payroll</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm text-white/90 hover:bg-white/10 hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        <span>Performance</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm text-white/90 hover:bg-white/10 hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span>Training</span>
                    </a>
                    <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm text-white/90 hover:bg-white/10 hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>Assets</span>
                    </a>
                </div>
            </div>

            <!-- ADMIN -->
            <div>
                <p class="px-3 text-[11px] font-bold tracking-widest text-white/70 uppercase mb-2">ADMIN</p>
                <div class="space-y-1">
                    <a href="#" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm text-white/90 hover:bg-white/10 hover:text-white transition">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span>Reports</span>
                    </a>
                    <a href="/admin" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl font-medium text-sm transition {{ request()->is('admin*') ? 'bg-[#b91c1c] text-white shadow-md' : 'text-white/90 hover:bg-white/10 hover:text-white' }}">
                        <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        </svg>
                        <span>Settings & RBAC</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>

    <!-- Bottom User Profile -->
    <div class="pt-4 border-t border-white/20 flex items-center justify-between">
        <div class="flex items-center gap-3 min-w-0">
            <div class="w-9 h-9 rounded-full bg-[#cc0000] text-white font-bold text-xs flex items-center justify-center shadow shrink-0">
                {{ $userInitials }}
            </div>
            <div class="min-w-0">
                <p class="text-white text-sm font-bold truncate leading-tight">{{ $userName }}</p>
                <p class="text-white/70 text-xs truncate leading-tight">{{ $userRole }}</p>
            </div>
        </div>
        <a href="#" class="text-white/70 hover:text-white transition p-1" title="Settings">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            </svg>
        </a>
    </div>
</aside>
