<div class="space-y-6 bg-[#fdfbf4] min-h-screen p-3 sm:p-6">
    <!-- Top Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Reports & Analytics</h1>
            <p class="text-slate-500 text-xs sm:text-sm mt-1 font-medium">
                August 2026 · All departments
            </p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1.5 bg-rose-50 text-rose-700 border border-rose-200 text-xs font-bold rounded-xl flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-[#b91c1c]"></span>
                <span>Admin Restricted Access</span>
            </span>
        </div>
    </div>

    <!-- Top 4 KPI Metric Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Card 1: AVG TENURE -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-rose-50 border border-rose-100 flex items-center justify-center text-rose-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-black tracking-wider text-slate-400 uppercase">AVG TENURE</p>
                <p class="text-2xl font-black text-slate-900 tracking-tight mt-0.5">{{ $metrics['avgTenure'] }}</p>
            </div>
        </div>

        <!-- Card 2: TURNOVER RATE -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-700 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-black tracking-wider text-slate-400 uppercase">TURNOVER RATE</p>
                <div class="flex items-baseline gap-2 mt-0.5">
                    <span class="text-2xl font-black text-slate-900 tracking-tight">{{ $metrics['turnoverRate'] }}</span>
                </div>
                <p class="text-[11px] font-bold text-rose-600 mt-0.5 flex items-center gap-1">
                    <span>↘</span> {{ $metrics['turnoverTrend'] }}
                </p>
            </div>
        </div>

        <!-- Card 3: TIME-TO-HIRE -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-sky-50 border border-sky-100 flex items-center justify-center text-sky-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-black tracking-wider text-slate-400 uppercase">TIME-TO-HIRE</p>
                <p class="text-2xl font-black text-slate-900 tracking-tight mt-0.5">{{ $metrics['timeToHire'] }}</p>
            </div>
        </div>

        <!-- Card 4: ENG. SCORE -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-black tracking-wider text-slate-400 uppercase">ENG. SCORE</p>
                <div class="flex items-baseline gap-2 mt-0.5">
                    <span class="text-2xl font-black text-slate-900 tracking-tight">{{ $metrics['engScore'] }}</span>
                </div>
                <p class="text-[11px] font-bold text-emerald-600 mt-0.5 flex items-center gap-1">
                    <span>↗</span> {{ $metrics['engTrend'] }}
                </p>
            </div>
        </div>
    </div>

    <!-- Middle Row: 2 Main Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left 2/3: Headcount Growth (SVG Line Chart) -->
        <div class="lg:col-span-2 bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-base font-extrabold text-slate-900">Headcount Growth</h3>
                    <p class="text-xs text-slate-400 font-semibold mt-0.5">Last 6 months</p>
                </div>
            </div>

            <!-- Responsive SVG Line Chart -->
            <div class="w-full">
                <div class="flex items-stretch gap-3 h-52 sm:h-60">
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
                                <linearGradient id="reportsHeadcountGrad" x1="0" y1="0" x2="0" y2="1">
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
                            <polygon points="15,115 110,100 205,82 300,55 395,40 485,25 485,155 15,155" fill="url(#reportsHeadcountGrad)" />

                            <!-- Red Line -->
                            <polyline points="15,115 110,100 205,82 300,55 395,40 485,25" fill="none" stroke="#b91c1c" stroke-width="3" stroke-linecap="round" vector-effect="non-scaling-stroke" />

                            <!-- Line Data Points -->
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

        <!-- Right 1/3: Headcount by Department (Micro Donut Circle & Detailed Legend) -->
        <div class="bg-white rounded-3xl p-5 sm:p-6 border border-slate-200/80 shadow-xs space-y-4 flex flex-col justify-between">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <div>
                    <h3 class="text-base font-extrabold text-slate-900">Headcount by Department</h3>
                    <p class="text-[11px] text-slate-400 font-semibold mt-0.5">{{ $totalHeadcount }} Total Active Staff</p>
                </div>
                <!-- Small Circle Donut Graphic -->
                <div class="relative w-14 h-14 shrink-0">
                    <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="38" fill="none" stroke="#e2e8f0" stroke-width="20" />
                        <circle cx="50" cy="50" r="38" fill="none" stroke="#b91c1c" stroke-width="20" stroke-dasharray="75 238" stroke-dashoffset="0" />
                        <circle cx="50" cy="50" r="38" fill="none" stroke="#d97706" stroke-width="20" stroke-dasharray="45 238" stroke-dashoffset="-75" />
                        <circle cx="50" cy="50" r="38" fill="none" stroke="#10b981" stroke-width="20" stroke-dasharray="43 238" stroke-dashoffset="-120" />
                        <circle cx="50" cy="50" r="38" fill="none" stroke="#f59e0b" stroke-width="20" stroke-dasharray="26 238" stroke-dashoffset="-163" />
                        <circle cx="50" cy="50" r="38" fill="none" stroke="#ec4899" stroke-width="20" stroke-dasharray="23 238" stroke-dashoffset="-189" />
                        <circle cx="50" cy="50" r="38" fill="none" stroke="#8b5cf6" stroke-width="20" stroke-dasharray="16 238" stroke-dashoffset="-212" />
                        <circle cx="50" cy="50" r="38" fill="none" stroke="#06b6d4" stroke-width="20" stroke-dasharray="10 238" stroke-dashoffset="-228" />
                    </svg>
                </div>
            </div>

            <!-- Detailed Department Breakdown List -->
            <div class="space-y-2 text-xs pt-1">
                @foreach($departmentBreakdown as $dept)
                    <div class="flex items-center justify-between font-bold py-1 border-b border-slate-50 last:border-0">
                        <div class="flex items-center gap-2 min-w-0">
                            <span class="w-2.5 h-2.5 rounded-full shrink-0" style="background-color: {{ $dept['color'] }}"></span>
                            <span class="text-slate-800 font-extrabold text-xs leading-none">{{ $dept['name'] }}</span>
                        </div>
                        <div class="flex items-center gap-2 shrink-0">
                            <span class="text-slate-900 font-black text-xs">{{ $dept['count'] }} staff</span>
                            <span class="px-2 py-0.5 text-[10px] font-black rounded-lg bg-slate-100 text-slate-600 border border-slate-200">
                                {{ $dept['pct'] }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Bottom Row: 2 Bar Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left: This Week's Attendance Rate -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
            <h3 class="text-base font-extrabold text-slate-900">This Week's Attendance Rate</h3>

            <div class="pt-4 pb-2">
                <div class="h-44 flex items-end justify-between gap-3 px-4 border-b border-slate-100">
                    @foreach($weeklyAttendance as $att)
                        <div class="flex-1 flex flex-col items-center gap-2 group">
                            <span class="text-[11px] font-bold text-emerald-700 group-hover:scale-110 transition">{{ $att['rate'] }}%</span>
                            <div 
                                class="w-full bg-[#10b981] rounded-t-xl transition-all duration-300 group-hover:bg-emerald-600" 
                                style="height: {{ max(10, ($att['rate'] - 75) * 4) }}%"
                            ></div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-between px-4 text-xs font-bold text-slate-400 mt-2">
                    @foreach($weeklyAttendance as $att)
                        <span class="flex-1 text-center">{{ $att['day'] }}</span>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right: Leave Type Breakdown — Aug 2026 -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
            <h3 class="text-base font-extrabold text-slate-900">Leave Type Breakdown — Aug 2026</h3>

            <div class="pt-4 pb-2">
                <div class="h-44 flex items-end justify-between gap-4 px-4 border-b border-slate-100">
                    @foreach($leaveTypeBreakdown as $leave)
                        <div class="flex-1 flex flex-col items-center gap-2 group">
                            <span class="text-[11px] font-bold text-rose-700 group-hover:scale-110 transition">{{ $leave['days'] }}d</span>
                            <div 
                                class="w-full bg-[#b91c1c] rounded-t-xl transition-all duration-300 group-hover:bg-[#a11818]" 
                                style="height: {{ max(15, ($leave['days'] / 160) * 100) }}%"
                            ></div>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-between px-4 text-xs font-bold text-slate-400 mt-2">
                    @foreach($leaveTypeBreakdown as $leave)
                        <span class="flex-1 text-center">{{ $leave['type'] }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
