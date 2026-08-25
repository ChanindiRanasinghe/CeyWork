<div class="space-y-6 bg-[#fdfbf4] min-h-screen p-2 sm:p-4">
    <!-- Top Header Bar: Overview & Quick Action -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Overview</h1>
            <p class="text-slate-500 text-xs sm:text-sm mt-1 font-medium">
                Friday, 22 August 2026 — 5 items need your attention today.
            </p>
        </div>
        <button 
            type="button" 
            class="px-4 py-2.5 bg-[#b91c1c] hover:bg-[#a11818] text-white font-bold text-xs rounded-xl shadow-sm transition flex items-center justify-center gap-2 active:scale-95 shrink-0"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Quick Action</span>
        </button>
    </div>

    @if(!$alertBannerDismissed)
        <!-- Dismissible Amber Warning Banner -->
        <div class="bg-[#fffbeb] border border-[#fde68a] text-[#92400e] rounded-2xl p-3.5 sm:p-4 flex items-center justify-between text-xs sm:text-sm font-medium shadow-xs gap-4">
            <div class="flex items-center gap-2.5">
                <div class="w-5 h-5 rounded-full bg-[#fef3c7] text-[#b45309] flex items-center justify-center font-bold text-xs shrink-0">
                    !
                </div>
                <span>
                    <strong class="font-bold text-[#b45309]">3 leave requests pending approval</strong> · Payroll run due Aug 25 · 2 KPIs at risk this quarter
                </span>
            </div>
            <button 
                type="button" 
                wire:click="dismissAlertBanner" 
                class="text-xs font-semibold text-slate-500 hover:text-slate-800 hover:underline shrink-0"
            >
                Dismiss
            </button>
        </div>
    @endif

    <!-- 4 KPI Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Card 1: Total Employees -->
        <div class="bg-[#fcfbf7] rounded-2xl p-5 border border-slate-200/80 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-red-50 border border-red-100 flex items-center justify-center text-[#b91c1c] shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">TOTAL EMPLOYEES</p>
                <p class="text-2xl font-black text-slate-900 tracking-tight mt-0.5">284</p>
                <p class="text-[11px] font-semibold text-emerald-600 flex items-center gap-1 mt-0.5">
                    <span>↗</span> <span>+3 vs last month</span>
                </p>
            </div>
        </div>

        <!-- Card 2: Open Positions -->
        <div class="bg-[#fcfbf7] rounded-2xl p-5 border border-slate-200/80 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-700 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">OPEN POSITIONS</p>
                <p class="text-2xl font-black text-slate-900 tracking-tight mt-0.5">17</p>
                <p class="text-[11px] font-semibold text-emerald-600 flex items-center gap-1 mt-0.5">
                    <span>↗</span> <span>+2 vs last month</span>
                </p>
            </div>
        </div>

        <!-- Card 3: Pending Leaves -->
        <div class="bg-[#fcfbf7] rounded-2xl p-5 border border-slate-200/80 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-rose-50 border border-rose-100 flex items-center justify-center text-rose-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">PENDING LEAVES</p>
                <p class="text-2xl font-black text-slate-900 tracking-tight mt-0.5">8</p>
                <p class="text-[11px] font-semibold text-rose-600 flex items-center gap-1 mt-0.5">
                    <span>↘</span> <span>-1 vs last month</span>
                </p>
            </div>
        </div>

        <!-- Card 4: Monthly Payroll -->
        <div class="bg-[#fcfbf7] rounded-2xl p-5 border border-slate-200/80 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">MONTHLY PAYROLL</p>
                <p class="text-2xl font-black text-slate-900 tracking-tight mt-0.5">Rs. 2.41M</p>
                <p class="text-[11px] font-semibold text-emerald-600 flex items-center gap-1 mt-0.5">
                    <span>↗</span> <span>+1.7% vs last month</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Charts & Department Breakdown Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left 2/3: Headcount Trend Chart -->
        <div class="lg:col-span-2 bg-[#fcfbf7] rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-base font-bold text-slate-900">Headcount Trend</h3>
                    <p class="text-xs text-slate-400 font-medium">Past 6 months</p>
                </div>
                <span class="px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold rounded-full">
                    +23 YTD
                </span>
            </div>

            <!-- Responsive Line Chart Container -->
            <div class="w-full">
                <div class="flex items-stretch gap-3 h-48 sm:h-56">
                    <!-- Left Y-Axis HTML Labels -->
                    <div class="flex flex-col justify-between text-[11px] font-bold text-slate-400 shrink-0 text-right pr-1 py-1 w-8">
                        <span>295</span>
                        <span>280</span>
                        <span>265</span>
                        <span>250</span>
                    </div>

                    <!-- SVG Chart Area -->
                    <div class="flex-1 relative min-w-0">
                        <svg class="w-full h-full overflow-visible" viewBox="0 0 500 160" preserveAspectRatio="none">
                            <defs>
                                <linearGradient id="headcountGrad" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#b91c1c" stop-opacity="0.22" />
                                    <stop offset="100%" stop-color="#b91c1c" stop-opacity="0.0" />
                                </linearGradient>
                            </defs>

                            <!-- Horizontal Gridlines -->
                            <line x1="0" y1="10" x2="500" y2="10" stroke="#f1f5f9" stroke-width="1.5" stroke-dasharray="4 4" vector-effect="non-scaling-stroke" />
                            <line x1="0" y1="58" x2="500" y2="58" stroke="#f1f5f9" stroke-width="1.5" stroke-dasharray="4 4" vector-effect="non-scaling-stroke" />
                            <line x1="0" y1="106" x2="500" y2="106" stroke="#f1f5f9" stroke-width="1.5" stroke-dasharray="4 4" vector-effect="non-scaling-stroke" />
                            <line x1="0" y1="155" x2="500" y2="155" stroke="#e2e8f0" stroke-width="1.5" vector-effect="non-scaling-stroke" />

                            <!-- Area Fill -->
                            <polygon points="15,115 110,100 205,82 300,55 395,40 485,25 485,155 15,155" fill="url(#headcountGrad)" />

                            <!-- Red Line -->
                            <polyline points="15,115 110,100 205,82 300,55 395,40 485,25" fill="none" stroke="#b91c1c" stroke-width="3" stroke-linecap="round" vector-effect="non-scaling-stroke" />

                            <!-- Line Points -->
                            <circle cx="15" cy="115" r="4.5" fill="#b91c1c" stroke="#ffffff" stroke-width="1.5" vector-effect="non-scaling-stroke" />
                            <circle cx="110" cy="100" r="4.5" fill="#b91c1c" stroke="#ffffff" stroke-width="1.5" vector-effect="non-scaling-stroke" />
                            <circle cx="205" cy="82" r="4.5" fill="#b91c1c" stroke="#ffffff" stroke-width="1.5" vector-effect="non-scaling-stroke" />
                            <circle cx="300" cy="55" r="4.5" fill="#b91c1c" stroke="#ffffff" stroke-width="1.5" vector-effect="non-scaling-stroke" />
                            <circle cx="395" cy="40" r="4.5" fill="#b91c1c" stroke="#ffffff" stroke-width="1.5" vector-effect="non-scaling-stroke" />
                            <circle cx="485" cy="25" r="4.5" fill="#b91c1c" stroke="#ffffff" stroke-width="1.5" vector-effect="non-scaling-stroke" />
                        </svg>
                    </div>
                </div>

                <!-- Month X Labels Aligned -->
                <div class="flex justify-between pl-12 pr-2 text-xs text-slate-400 font-bold mt-2">
                    <span>Mar</span>
                    <span>Apr</span>
                    <span>May</span>
                    <span>Jun</span>
                    <span>Jul</span>
                    <span>Aug</span>
                </div>
            </div>
        </div>

        <!-- Right 1/3: Department Breakdown -->
        <div class="bg-[#fcfbf7] rounded-3xl p-6 border border-slate-200/80 shadow-xs">
            <h3 class="text-base font-bold text-slate-900 mb-4">Department Breakdown</h3>
            
            <div class="space-y-3.5">
                @foreach($departmentsData as $dept)
                    <div>
                        <div class="flex justify-between text-xs font-bold text-slate-800 mb-1">
                            <span>{{ $dept['name'] }}</span>
                            <span class="text-slate-600">{{ $dept['count'] }}</span>
                        </div>
                        <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                            <div class="{{ $dept['color'] }} h-full rounded-full" style="width: {{ min(100, ($dept['count'] / 90) * 100) }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Bottom Row: Pending Tasks & Recent Hires -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left Column: Pending Tasks -->
        <div class="bg-[#fcfbf7] rounded-3xl p-6 border border-slate-200/80 shadow-xs">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-slate-900">Pending Tasks</h3>
                <span class="px-2.5 py-0.5 bg-rose-50 text-[#b91c1c] border border-rose-200 text-xs font-bold rounded-full">
                    5 open
                </span>
            </div>

            <div class="space-y-3.5">
                @foreach($pendingTasks as $task)
                    <div class="flex items-center justify-between text-xs py-2 border-b border-slate-100 last:border-0">
                        <div class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full bg-[#b91c1c] shrink-0"></span>
                            <span class="font-bold text-slate-800">{{ $task['title'] }}</span>
                        </div>
                        <span class="text-slate-500 font-semibold shrink-0 ml-2">{{ $task['due'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Right Column: Recent Hires -->
        <div class="bg-[#fcfbf7] rounded-3xl p-6 border border-slate-200/80 shadow-xs">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-slate-900">Recent Hires</h3>
                <a href="/employees" class="text-xs font-bold text-[#b91c1c] hover:underline">View all</a>
            </div>

            <div class="space-y-3.5">
                @foreach($recentHires as $hire)
                    <div class="flex items-center justify-between py-1.5 border-b border-slate-100 last:border-0">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full {{ $hire['color'] }} text-white font-bold text-xs flex items-center justify-center shadow-xs shrink-0">
                                {{ $hire['initials'] }}
                            </div>
                            <div>
                                <p class="text-xs font-bold text-slate-900">{{ $hire['name'] }}</p>
                                <p class="text-[11px] text-slate-500 font-medium">{{ $hire['role'] }}</p>
                            </div>
                        </div>
                        <div class="text-right shrink-0">
                            <p class="text-[11px] text-slate-400 font-semibold mb-1">{{ $hire['date'] }}</p>
                            <span class="px-2 py-0.5 text-[10px] font-bold rounded-full border {{ $hire['statusBg'] }}">
                                {{ $hire['status'] }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- ========================================================================= -->
    <!-- SCREEN 2: ALERTS & REMINDERS SLIDE-OVER DRAWER -->
    <!-- ========================================================================= -->
    @if($showNotificationsDrawer)
        <div class="fixed inset-0 z-50 overflow-hidden" aria-labelledby="slide-over-title" role="dialog" aria-modal="true">
            <!-- Background backdrop overlay -->
            <div 
                wire:click="closeNotifications" 
                class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs transition-opacity" 
                aria-hidden="true"
            ></div>

            <div class="fixed inset-y-0 right-0 max-w-full flex pl-10">
                <div class="w-screen max-w-md bg-[#fdfbf4] border-l border-slate-200/90 shadow-2xl flex flex-col justify-between">
                    
                    <!-- Drawer Header -->
                    <div class="p-6 border-b border-slate-200/80 bg-white">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-pink-100 text-[#b91c1c] flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-lg font-bold text-slate-900">Alerts & Reminders</h2>
                                    <p class="text-xs text-slate-500 font-medium">9 unread · 12 total</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <button type="button" class="text-xs font-bold text-[#b91c1c] hover:underline">
                                    Mark all read
                                </button>
                                <button 
                                    type="button" 
                                    wire:click="closeNotifications" 
                                    class="text-slate-400 hover:text-slate-600 p-1 rounded-lg hover:bg-slate-100 transition"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Tab Filter Buttons -->
                        <div class="flex items-center gap-2 pt-2 text-xs font-bold border-t border-slate-100">
                            <button 
                                type="button" 
                                wire:click="setNotificationTab('all')" 
                                class="px-3 py-1.5 rounded-full transition flex items-center gap-1.5 {{ $activeNotificationTab === 'all' ? 'bg-[#b91c1c] text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                            >
                                <span>All</span>
                                <span class="w-4 h-4 rounded-full bg-rose-200 text-[#b91c1c] text-[10px] font-black flex items-center justify-center">9</span>
                            </button>

                            <button 
                                type="button" 
                                wire:click="setNotificationTab('interviews')" 
                                class="px-3 py-1.5 rounded-full transition flex items-center gap-1.5 {{ $activeNotificationTab === 'interviews' ? 'bg-[#b91c1c] text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                            >
                                <span>Interviews</span>
                                <span class="w-4 h-4 rounded-full bg-rose-200 text-[#b91c1c] text-[10px] font-black flex items-center justify-center">4</span>
                            </button>

                            <button 
                                type="button" 
                                wire:click="setNotificationTab('onboarding')" 
                                class="px-3 py-1.5 rounded-full transition flex items-center gap-1.5 {{ $activeNotificationTab === 'onboarding' ? 'bg-[#b91c1c] text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                            >
                                <span>Onboarding</span>
                                <span class="w-4 h-4 rounded-full bg-pink-200 text-[#b91c1c] text-[10px] font-black flex items-center justify-center">1</span>
                            </button>

                            <button 
                                type="button" 
                                wire:click="setNotificationTab('offboarding')" 
                                class="px-3 py-1.5 rounded-full transition flex items-center gap-1.5 {{ $activeNotificationTab === 'offboarding' ? 'bg-[#b91c1c] text-white' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}"
                            >
                                <span>Offboarding</span>
                                <span class="w-4 h-4 rounded-full bg-rose-200 text-[#b91c1c] text-[10px] font-black flex items-center justify-center">2</span>
                            </button>
                        </div>
                    </div>

                    <!-- Drawer Content List -->
                    <div class="flex-1 overflow-y-auto p-6 space-y-6">
                        
                        <!-- Section 1: CRITICAL & URGENT -->
                        <div>
                            <p class="text-[11px] font-black tracking-widest text-rose-700 uppercase mb-3">CRITICAL & URGENT</p>
                            <div class="space-y-3">
                                @foreach($notifications as $item)
                                    @if($item['category'] === 'critical' && ($activeNotificationTab === 'all' || $activeNotificationTab === $item['type']))
                                        <div class="bg-white rounded-2xl p-4 border border-rose-100 shadow-xs relative hover:border-rose-300 transition">
                                            <span class="w-2.5 h-2.5 rounded-full bg-rose-600 absolute top-3.5 right-3.5"></span>
                                            <div class="flex items-start gap-3">
                                                <div class="w-9 h-9 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center shrink-0 mt-0.5">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                <div class="pr-4">
                                                    <h4 class="text-xs font-bold text-slate-900">{{ $item['title'] }}</h4>
                                                    <p class="text-[11px] text-slate-500 font-medium mt-0.5">{{ $item['subtitle'] }}</p>
                                                    <div class="flex items-center justify-between mt-3 pt-2 border-t border-slate-100">
                                                        <span class="text-[10px] text-slate-400 font-semibold">{{ $item['time'] }}</span>
                                                        <span class="px-2 py-0.5 text-[10px] font-bold rounded-full {{ $item['level'] === 'Critical' ? 'bg-rose-100 text-rose-700' : 'bg-amber-100 text-amber-800' }}">
                                                            {{ $item['level'] }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Section 2: NEEDS ATTENTION -->
                        <div>
                            <p class="text-[11px] font-black tracking-widest text-blue-700 uppercase mb-3">NEEDS ATTENTION</p>
                            <div class="space-y-3">
                                @foreach($notifications as $item)
                                    @if($item['category'] === 'attention' && ($activeNotificationTab === 'all' || $activeNotificationTab === $item['type']))
                                        <div class="bg-white rounded-2xl p-4 border border-blue-100 shadow-xs relative hover:border-blue-300 transition">
                                            <span class="w-2.5 h-2.5 rounded-full bg-blue-500 absolute top-3.5 right-3.5"></span>
                                            <div class="flex items-start gap-3">
                                                <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0 mt-0.5">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                                <div class="pr-4">
                                                    <h4 class="text-xs font-bold text-slate-900">{{ $item['title'] }}</h4>
                                                    <p class="text-[11px] text-slate-500 font-medium mt-0.5">{{ $item['subtitle'] }}</p>
                                                    <div class="flex items-center justify-between mt-3 pt-2 border-t border-slate-100">
                                                        <span class="text-[10px] text-slate-400 font-semibold">{{ $item['time'] }}</span>
                                                        <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-blue-100 text-blue-700">
                                                            {{ $item['level'] }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <!-- Section 3: FOR YOUR AWARENESS -->
                        <div>
                            <p class="text-[11px] font-black tracking-widest text-slate-400 uppercase mb-3">FOR YOUR AWARENESS</p>
                            <div class="space-y-3">
                                @foreach($notifications as $item)
                                    @if($item['category'] === 'awareness' && ($activeNotificationTab === 'all' || $activeNotificationTab === $item['type']))
                                        <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-xs relative hover:border-slate-300 transition">
                                            <div class="flex items-start gap-3">
                                                <div class="w-9 h-9 rounded-xl bg-slate-100 text-slate-500 flex items-center justify-center shrink-0 mt-0.5">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                </div>
                                                <div class="pr-4">
                                                    <h4 class="text-xs font-bold text-slate-900">{{ $item['title'] }}</h4>
                                                    <p class="text-[11px] text-slate-500 font-medium mt-0.5">{{ $item['subtitle'] }}</p>
                                                    <div class="flex items-center justify-between mt-3 pt-2 border-t border-slate-100">
                                                        <span class="text-[10px] text-slate-400 font-semibold">{{ $item['time'] }}</span>
                                                        <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-slate-100 text-slate-600">
                                                            {{ $item['level'] }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                    </div>

                    <!-- Drawer Footer -->
                    <div class="p-4 border-t border-slate-200/80 bg-white text-center">
                        <p class="text-[11px] text-slate-400 font-medium">
                            Alerts refresh every 15 minutes. Click any alert to mark as read.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    @endif
</div>
