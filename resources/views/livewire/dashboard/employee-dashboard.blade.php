<div class="space-y-6 bg-[#fdfbf4] min-h-screen p-3 sm:p-6">
    <!-- Top Hero Card (Red Gradient Container) -->
    <div class="bg-gradient-to-r from-[#b91c1c] via-[#cc0000] to-[#dc2626] rounded-3xl p-6 sm:p-8 text-white shadow-md relative overflow-hidden">
        <!-- Subtle Background Decorative Circles -->
        <div class="absolute -right-10 -bottom-10 w-64 h-64 rounded-full bg-white/5 pointer-events-none"></div>
        <div class="absolute right-32 -top-10 w-48 h-48 rounded-full bg-white/5 pointer-events-none"></div>

        <div class="relative z-10">
            <!-- User Info Row -->
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-black/20 border-2 border-white/30 text-white font-black text-lg flex items-center justify-center shadow-inner shrink-0">
                    {{ $employee['initials'] }}
                </div>
                <div>
                    <p class="text-white/80 text-xs sm:text-sm font-medium">Welcome back,</p>
                    <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-white mt-0.5">
                        {{ $employee['name'] }}
                    </h1>
                    <p class="text-white/90 text-xs sm:text-sm font-semibold mt-0.5">
                        {{ $employee['designation'] }}
                    </p>
                </div>
            </div>

            <!-- Horizontal Divider -->
            <div class="border-t border-white/20 my-6"></div>

            <!-- 4 Quick Stat Badges -->
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-left">
                <div>
                    <p class="text-[11px] font-black tracking-wider text-white/70 uppercase">LEAVE BALANCE</p>
                    <p class="text-2xl font-black text-white tracking-tight mt-1">{{ $employee['leaveBalance'] }}</p>
                </div>
                <div>
                    <p class="text-[11px] font-black tracking-wider text-white/70 uppercase">NEXT PAYSLIP</p>
                    <p class="text-2xl font-black text-white tracking-tight mt-1">{{ $employee['nextPayslip'] }}</p>
                </div>
                <div>
                    <p class="text-[11px] font-black tracking-wider text-white/70 uppercase">KPI SCORE</p>
                    <p class="text-2xl font-black text-white tracking-tight mt-1">{{ $employee['kpiScore'] }}</p>
                </div>
                <div>
                    <p class="text-[11px] font-black tracking-wider text-white/70 uppercase">TENURE</p>
                    <p class="text-2xl font-black text-white tracking-tight mt-1">{{ $employee['tenure'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 4 Quick Action Cards (2x2 Grid) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <!-- Action 1: Request Leave -->
        <a 
            href="/attendance" 
            class="bg-white hover:bg-slate-50/90 rounded-2xl p-5 border border-slate-200/80 shadow-xs transition duration-200 flex items-center justify-between group"
        >
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-rose-50 border border-rose-100 flex items-center justify-center text-[#b91c1c] shrink-0 group-hover:scale-105 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-slate-900 group-hover:text-[#b91c1c] transition">Request Leave</h3>
                    <p class="text-xs text-slate-500 font-medium">12 days remaining</p>
                </div>
            </div>
            <span class="text-slate-300 group-hover:text-[#b91c1c] text-lg font-bold transition">›</span>
        </a>

        <!-- Action 2: View Payslips -->
        <button 
            type="button" 
            wire:click="openPayslipModal"
            class="bg-white hover:bg-slate-50/90 rounded-2xl p-5 border border-slate-200/80 shadow-xs transition duration-200 flex items-center justify-between text-left group"
        >
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 shrink-0 group-hover:scale-105 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-slate-900 group-hover:text-emerald-700 transition">View Payslips</h3>
                    <p class="text-xs text-slate-500 font-medium">Last issued: Aug 2026</p>
                </div>
            </div>
            <span class="text-slate-300 group-hover:text-emerald-700 text-lg font-bold transition">›</span>
        </button>

        <!-- Action 3: My Documents -->
        <button 
            type="button" 
            wire:click="openDocumentsModal"
            class="bg-white hover:bg-slate-50/90 rounded-2xl p-5 border border-slate-200/80 shadow-xs transition duration-200 flex items-center justify-between text-left group"
        >
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-700 shrink-0 group-hover:scale-105 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-slate-900 group-hover:text-amber-700 transition">My Documents</h3>
                    <p class="text-xs text-slate-500 font-medium">3 pending uploads</p>
                </div>
            </div>
            <span class="text-slate-300 group-hover:text-amber-700 text-lg font-bold transition">›</span>
        </button>

        <!-- Action 4: HR Service Desk -->
        <button 
            type="button" 
            wire:click="openSupportModal"
            class="bg-white hover:bg-slate-50/90 rounded-2xl p-5 border border-slate-200/80 shadow-xs transition duration-200 flex items-center justify-between text-left group"
        >
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-purple-50 border border-purple-100 flex items-center justify-center text-purple-600 shrink-0 group-hover:scale-105 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-base font-extrabold text-slate-900 group-hover:text-purple-700 transition">HR Service Desk</h3>
                    <p class="text-xs text-slate-500 font-medium">2 open tickets</p>
                </div>
            </div>
            <span class="text-slate-300 group-hover:text-purple-700 text-lg font-bold transition">›</span>
        </button>
    </div>

    <!-- Bottom Two-Column Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left Column: Upcoming Events -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-extrabold text-slate-900">Upcoming Events</h3>
            </div>

            <div class="space-y-3">
                @foreach($upcomingEvents as $event)
                    <div class="bg-slate-50/80 rounded-2xl p-4 border border-slate-200/60 flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3.5">
                            <div class="w-10 h-10 rounded-xl bg-rose-50 text-[#b91c1c] flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-extrabold text-slate-900">{{ $event['title'] }}</h4>
                                <p class="text-xs text-slate-500 font-medium mt-0.5">
                                    {{ $event['date'] }} · {{ $event['category'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Right Column: Training Progress -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-extrabold text-slate-900">Training Progress</h3>
                <span class="text-xs font-black text-rose-700 bg-rose-50 px-2.5 py-1 rounded-full border border-rose-200">
                    2 / 5 complete
                </span>
            </div>

            <div class="space-y-5 pt-2">
                @foreach($trainingProgress as $item)
                    <div class="space-y-1.5">
                        <div class="flex justify-between text-xs font-extrabold text-slate-900">
                            <span>{{ $item['title'] }}</span>
                            <span class="text-rose-700">{{ $item['percentage'] }}%</span>
                        </div>
                        <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                            <div 
                                class="h-full bg-[#b91c1c] rounded-full transition-all duration-300"
                                style="width: {{ $item['percentage'] }}%"
                            ></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Payslip Preview Modal -->
    @if($showPayslipModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-xs">
            <div class="bg-white rounded-3xl p-6 max-w-md w-full border border-slate-200 shadow-2xl space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 class="text-lg font-extrabold text-slate-900">My Payslip — August 2026</h3>
                    <button wire:click="closePayslipModal" class="text-slate-400 hover:text-slate-600 font-bold">✕</button>
                </div>
                <div class="space-y-2 text-xs divide-y divide-slate-100">
                    <div class="flex justify-between py-1.5"><span class="text-slate-500 font-semibold">Basic Salary:</span><span class="font-bold text-slate-900">Rs. 280,000.00</span></div>
                    <div class="flex justify-between py-1.5"><span class="text-slate-500 font-semibold">Employee EPF (8%):</span><span class="font-bold text-rose-600">- Rs. 22,400.00</span></div>
                    <div class="flex justify-between py-1.5"><span class="text-slate-500 font-semibold">Employer EPF (12%):</span><span class="font-bold text-slate-700">Rs. 33,600.00</span></div>
                    <div class="flex justify-between py-1.5"><span class="text-slate-500 font-semibold">Employer ETF (3%):</span><span class="font-bold text-slate-700">Rs. 8,400.00</span></div>
                    <div class="flex justify-between py-1.5 pt-2 border-t-2 border-slate-200"><span class="text-slate-900 font-extrabold text-sm">Net Salary:</span><span class="font-black text-sm text-emerald-700">Rs. 257,600.00</span></div>
                </div>
                <div class="flex justify-end gap-2 pt-3">
                    <button wire:click="closePayslipModal" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl">Close</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Documents Modal -->
    @if($showDocumentsModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-xs">
            <div class="bg-white rounded-3xl p-6 max-w-lg w-full border border-slate-200 shadow-2xl space-y-4 max-h-[90vh] overflow-y-auto">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <div>
                        <h3 class="text-lg font-extrabold text-slate-900">Onboarding Documents</h3>
                        <p class="text-xs text-slate-500 font-medium">Sri Lankan Statutory Onboarding Checklist</p>
                    </div>
                    <button wire:click="closeDocumentsModal" class="text-slate-400 hover:text-slate-600 font-bold">✕</button>
                </div>
                <div class="space-y-2.5 text-xs">
                    <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center justify-between">
                        <span class="font-bold text-emerald-950">1. Police Report (Police Clearance Certificate)</span>
                        <span class="text-emerald-800 font-extrabold bg-emerald-100 px-2 py-0.5 rounded-lg">Verified</span>
                    </div>
                    <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center justify-between">
                        <span class="font-bold text-emerald-950">2. Grama Niladhari Report (Grama Sevaka)</span>
                        <span class="text-emerald-800 font-extrabold bg-emerald-100 px-2 py-0.5 rounded-lg">Verified</span>
                    </div>
                    <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center justify-between">
                        <span class="font-bold text-emerald-950">3. School Leaving Certificate</span>
                        <span class="text-emerald-800 font-extrabold bg-emerald-100 px-2 py-0.5 rounded-lg">Verified</span>
                    </div>
                    <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center justify-between">
                        <span class="font-bold text-emerald-950">4. Character Certificate</span>
                        <span class="text-emerald-800 font-extrabold bg-emerald-100 px-2 py-0.5 rounded-lg">Verified</span>
                    </div>
                    <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-xl flex items-center justify-between">
                        <span class="font-bold text-emerald-950">5. NIC Copy (National Identity Card)</span>
                        <span class="text-emerald-800 font-extrabold bg-emerald-100 px-2 py-0.5 rounded-lg">Verified</span>
                    </div>
                    <div class="p-3 bg-amber-50 border border-amber-200 rounded-xl flex items-center justify-between">
                        <span class="font-bold text-amber-950">6. Service Letters (Previous Employers)</span>
                        <span class="text-amber-900 font-extrabold bg-amber-100 px-2 py-0.5 rounded-lg">Submitted</span>
                    </div>
                    <div class="p-3 bg-rose-50 border border-rose-200 rounded-xl flex items-center justify-between">
                        <span class="font-bold text-rose-950">7. A/L & O/L Educational Certificates</span>
                        <span class="text-rose-900 font-extrabold bg-rose-100 px-2 py-0.5 rounded-lg">Pending Upload</span>
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-3 border-t border-slate-100">
                    <button wire:click="closeDocumentsModal" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl">Close</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Support Desk Modal -->
    @if($showSupportModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-xs">
            <div class="bg-white rounded-3xl p-6 max-w-md w-full border border-slate-200 shadow-2xl space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 class="text-lg font-extrabold text-slate-900">HR Service Desk Tickets</h3>
                    <button wire:click="closeSupportModal" class="text-slate-400 hover:text-slate-600 font-bold">✕</button>
                </div>
                <div class="space-y-3 text-xs">
                    <div class="p-3 bg-slate-50 rounded-xl space-y-1">
                        <div class="flex justify-between font-bold text-slate-900">
                            <span>#TICK-8841: Leave balance adjustment query</span>
                            <span class="text-sky-700">In Progress</span>
                        </div>
                        <p class="text-slate-500 font-medium">Submitted on Aug 18, 2026</p>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl space-y-1">
                        <div class="flex justify-between font-bold text-slate-900">
                            <span>#TICK-8802: Medical insurance claim</span>
                            <span class="text-emerald-700">Resolved</span>
                        </div>
                        <p class="text-slate-500 font-medium">Submitted on Aug 10, 2026</p>
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-3">
                    <button wire:click="closeSupportModal" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl">Close</button>
                </div>
            </div>
        </div>
    @endif

</div>
