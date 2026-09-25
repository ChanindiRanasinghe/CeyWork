<div class="space-y-6 bg-[#fdfbf4] min-h-screen p-3 sm:p-6">
    <!-- Top Header Bar -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Payroll</h1>
            <p class="text-slate-500 text-xs sm:text-sm mt-1 font-medium">
                August 2026 — Processing cycle active
            </p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1.5 bg-rose-50 text-rose-700 border border-rose-200 text-xs font-bold rounded-xl flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-rose-600 animate-pulse"></span>
                <span>Restricted Access (Admin & Senior HR Only)</span>
            </span>
        </div>
    </div>

    <!-- Alert / Message Banner -->
    @if (session()->has('message'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-900 rounded-2xl p-4 flex items-center justify-between text-xs sm:text-sm font-bold shadow-xs">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                <span>{{ session('message') }}</span>
            </div>
            <button wire:click="$set('processed', false)" class="text-emerald-700 hover:text-emerald-900 font-black">✕</button>
        </div>
    @endif

    <!-- Navigation Tabs -->
    <div class="border-b border-slate-200/80 flex items-center gap-8 text-sm font-bold">
        <button 
            type="button" 
            wire:click="setTab('overview')"
            class="pb-3 border-b-2 transition {{ $activeTab === 'overview' ? 'border-[#b91c1c] text-[#b91c1c]' : 'border-transparent text-slate-400 hover:text-slate-700' }}"
        >
            Overview
        </button>
        <button 
            type="button" 
            wire:click="setTab('payslips')"
            class="pb-3 border-b-2 transition {{ $activeTab === 'payslips' ? 'border-[#b91c1c] text-[#b91c1c]' : 'border-transparent text-slate-400 hover:text-slate-700' }}"
        >
            Payslips & Statutory Returns
        </button>
    </div>

    <!-- TAB 1: OVERVIEW -->
    @if($activeTab === 'overview')
        <!-- 4 KPI Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Card 1: Gross Payroll -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-rose-50 border border-rose-100 flex items-center justify-center text-[#b91c1c] shrink-0 font-black text-xl">
                    $
                </div>
                <div>
                    <p class="text-[11px] font-black tracking-wider text-slate-400 uppercase">GROSS PAYROLL</p>
                    <p class="text-2xl font-black text-slate-900 tracking-tight mt-0.5">Rs. 2.41M</p>
                    <p class="text-[11px] font-semibold text-emerald-600 flex items-center gap-1 mt-0.5">
                        <span>↗</span> <span>+1.7% vs last month</span>
                    </p>
                </div>
            </div>

            <!-- Card 2: Net Payroll -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 shrink-0 font-black text-xl">
                    💳
                </div>
                <div>
                    <p class="text-[11px] font-black tracking-wider text-slate-400 uppercase">NET PAYROLL</p>
                    <p class="text-2xl font-black text-slate-900 tracking-tight mt-0.5">Rs. 1.85M</p>
                    <p class="text-[11px] font-semibold text-emerald-600 flex items-center gap-1 mt-0.5">
                        <span>↗</span> <span>+1.5% vs last month</span>
                    </p>
                </div>
            </div>

            <!-- Card 3: Total Deductions -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-700 shrink-0 font-black text-xl">
                    ↘
                </div>
                <div>
                    <p class="text-[11px] font-black tracking-wider text-slate-400 uppercase">TOTAL DEDUCTIONS</p>
                    <p class="text-2xl font-black text-slate-900 tracking-tight mt-0.5">Rs. 563K</p>
                    <p class="text-[11px] font-semibold text-emerald-600 flex items-center gap-1 mt-0.5">
                        <span>↗</span> <span>+2.1% vs last month</span>
                    </p>
                </div>
            </div>

            <!-- Card 4: Employees Paid -->
            <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-sky-50 border border-sky-100 flex items-center justify-center text-sky-600 shrink-0 font-black text-xl">
                    👥
                </div>
                <div>
                    <p class="text-[11px] font-black tracking-wider text-slate-400 uppercase">EMPLOYEES PAID</p>
                    <p class="text-2xl font-black text-slate-900 tracking-tight mt-0.5">284</p>
                    <p class="text-[11px] font-semibold text-emerald-600 flex items-center gap-1 mt-0.5">
                        <span>↗</span> <span>+3 vs last month</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Payroll Trend Chart Card -->
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                <div>
                    <h3 class="text-lg font-extrabold text-slate-900">Payroll Trend</h3>
                    <p class="text-xs text-slate-400 font-medium">Gross vs. Net — LKR thousands</p>
                </div>
                <div class="flex items-center gap-4 text-xs font-bold">
                    <span class="flex items-center gap-1.5"><span class="w-3 h-0.5 bg-[#b91c1c] rounded-full"></span><span class="text-slate-600">Gross</span></span>
                    <span class="flex items-center gap-1.5"><span class="w-3 h-0.5 bg-[#10b981] rounded-full"></span><span class="text-slate-600">Net</span></span>
                </div>
            </div>

            <!-- Responsive Chart Container -->
            <div class="w-full">
                <div class="flex items-stretch gap-3 h-48 sm:h-56">
                    <!-- Left Y-Axis HTML Labels (Fixed typography, no stretching) -->
                    <div class="flex flex-col justify-between text-[11px] font-bold text-slate-400 shrink-0 text-right pr-1 py-1 w-10">
                        <span>2,600</span>
                        <span>1,950</span>
                        <span>1,300</span>
                        <span>650</span>
                        <span>0</span>
                    </div>

                    <!-- SVG Grid & Line Plot Area -->
                    <div class="flex-1 relative min-w-0">
                        <svg class="w-full h-full overflow-visible" viewBox="0 0 500 160" preserveAspectRatio="none">
                            <defs>
                                <linearGradient id="payrollNetGrad" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#10b981" stop-opacity="0.18" />
                                    <stop offset="100%" stop-color="#10b981" stop-opacity="0.01" />
                                </linearGradient>
                            </defs>

                            <!-- Horizontal Gridlines -->
                            <line x1="0" y1="10" x2="500" y2="10" stroke="#f1f5f9" stroke-width="1.5" stroke-dasharray="4 4" vector-effect="non-scaling-stroke" />
                            <line x1="0" y1="47.5" x2="500" y2="47.5" stroke="#f1f5f9" stroke-width="1.5" stroke-dasharray="4 4" vector-effect="non-scaling-stroke" />
                            <line x1="0" y1="85" x2="500" y2="85" stroke="#f1f5f9" stroke-width="1.5" stroke-dasharray="4 4" vector-effect="non-scaling-stroke" />
                            <line x1="0" y1="122.5" x2="500" y2="122.5" stroke="#f1f5f9" stroke-width="1.5" stroke-dasharray="4 4" vector-effect="non-scaling-stroke" />
                            <line x1="0" y1="155" x2="500" y2="155" stroke="#e2e8f0" stroke-width="1.5" vector-effect="non-scaling-stroke" />

                            <!-- Net Area Fill -->
                            <polygon points="15,55 110,50 205,46 300,42 395,38 485,35 485,155 15,155" fill="url(#payrollNetGrad)" />

                            <!-- Gross Line (Dashed Rose) -->
                            <polyline points="15,35 110,32 205,28 300,24 395,20 485,16" fill="none" stroke="#b91c1c" stroke-width="2.5" stroke-dasharray="6 4" stroke-linecap="round" vector-effect="non-scaling-stroke" />

                            <!-- Net Line (Solid Emerald) -->
                            <polyline points="15,55 110,50 205,46 300,42 395,38 485,35" fill="none" stroke="#10b981" stroke-width="3" stroke-linecap="round" vector-effect="non-scaling-stroke" />

                            <!-- Line Dots for Net -->
                            <circle cx="15" cy="55" r="4.5" fill="#10b981" stroke="#ffffff" stroke-width="1.5" vector-effect="non-scaling-stroke" />
                            <circle cx="110" cy="50" r="4.5" fill="#10b981" stroke="#ffffff" stroke-width="1.5" vector-effect="non-scaling-stroke" />
                            <circle cx="205" cy="46" r="4.5" fill="#10b981" stroke="#ffffff" stroke-width="1.5" vector-effect="non-scaling-stroke" />
                            <circle cx="300" cy="42" r="4.5" fill="#10b981" stroke="#ffffff" stroke-width="1.5" vector-effect="non-scaling-stroke" />
                            <circle cx="395" cy="38" r="4.5" fill="#10b981" stroke="#ffffff" stroke-width="1.5" vector-effect="non-scaling-stroke" />
                            <circle cx="485" cy="35" r="4.5" fill="#10b981" stroke="#ffffff" stroke-width="1.5" vector-effect="non-scaling-stroke" />
                        </svg>
                    </div>
                </div>

                <!-- X-Axis Labels Aligned with Data Dots -->
                <div class="flex justify-between pl-14 pr-2 text-xs text-slate-400 font-bold mt-2">
                    <span>Mar</span>
                    <span>Apr</span>
                    <span>May</span>
                    <span>Jun</span>
                    <span>Jul</span>
                    <span>Aug</span>
                </div>
            </div>
        </div>
    @endif

    <!-- TAB 2: PAYSLIPS & STATUTORY RETURNS -->
    @if($activeTab === 'payslips')
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-6">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 pb-4 border-b border-slate-100">
                <div>
                    <h3 class="text-lg font-extrabold text-slate-900">Sri Lankan Statutory Payroll Breakdown</h3>
                    <p class="text-xs text-slate-500 font-medium">EPF (8% Employee / 12% Employer) & ETF (3% Employer) monthly C3 Form statement</p>
                </div>
                <div class="flex items-center gap-2">
                    <input type="month" wire:model="selectedMonth" class="text-xs font-semibold border border-slate-200 rounded-xl px-3 py-2 bg-slate-50" />
                    <button wire:click="exportPayslipSummaryCsv" class="px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs rounded-xl transition flex items-center gap-1.5 shadow-xs">
                        📥 Export C3 CSV
                    </button>
                    <button wire:click="processPayroll" class="px-4 py-2 bg-[#b91c1c] hover:bg-[#a11818] text-white font-bold text-xs rounded-xl shadow-xs transition active:scale-95">
                        ⚡ Run Payroll Batch
                    </button>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-[11px] font-black tracking-wider text-slate-400 uppercase border-b border-slate-100 pb-3">
                            <th class="pb-3 px-3">EMPLOYEE</th>
                            <th class="pb-3 px-3">EPF / ETF NO.</th>
                            <th class="pb-3 px-3">BASIC SALARY</th>
                            <th class="pb-3 px-3">EPF 8% (EE)</th>
                            <th class="pb-3 px-3">EPF 12% (ER)</th>
                            <th class="pb-3 px-3">ETF 3% (ER)</th>
                            <th class="pb-3 px-3 text-right">NET SALARY</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs font-semibold text-slate-800">
                        @foreach($employees as $emp)
                            @php
                                $basic = $emp->basic_salary > 0 ? $emp->basic_salary : 250000;
                                $eeEpf = $basic * 0.08;
                                $erEpf = $basic * 0.12;
                                $erEtf = $basic * 0.03;
                                $net = $basic - $eeEpf;
                            @endphp
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-4 px-3 font-extrabold text-slate-900">
                                    {{ $emp->full_name }}
                                    <span class="block text-[10px] text-slate-400 font-mono">{{ $emp->employee_code }}</span>
                                </td>
                                <td class="py-4 px-3 text-slate-500 font-mono">
                                    {{ $emp->epf_number ?? 'EPF-88901' }} / {{ $emp->etf_number ?? 'ETF-88901' }}
                                </td>
                                <td class="py-4 px-3 font-bold text-slate-900">
                                    Rs. {{ number_format($basic, 2) }}
                                </td>
                                <td class="py-4 px-3 text-rose-600 font-bold">
                                    - Rs. {{ number_format($eeEpf, 2) }}
                                </td>
                                <td class="py-4 px-3 text-indigo-700 font-bold">
                                    Rs. {{ number_format($erEpf, 2) }}
                                </td>
                                <td class="py-4 px-3 text-teal-700 font-bold">
                                    Rs. {{ number_format($erEtf, 2) }}
                                </td>
                                <td class="py-4 px-3 text-right font-black text-emerald-700 text-sm">
                                    Rs. {{ number_format($net, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

</div>
