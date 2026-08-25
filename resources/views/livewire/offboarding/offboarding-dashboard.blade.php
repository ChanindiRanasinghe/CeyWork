<div class="space-y-6 bg-[#fdfbf4] min-h-screen p-3 sm:p-6">
    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Offboarding</h1>
            <p class="text-slate-500 text-xs sm:text-sm mt-1 font-medium">
                {{ count($casesList) }} active offboarding cases
            </p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1.5 bg-rose-50 text-rose-700 border border-rose-200 text-xs font-bold rounded-xl flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-rose-600 animate-pulse"></span>
                <span>Restricted Access (HR & Admin Only)</span>
            </span>
        </div>
    </div>

    <!-- Main Two-Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        
        <!-- Left Column: Active Offboarding Cases Cards (4 cols on desktop) -->
        <div class="lg:col-span-4 space-y-4">
            @foreach($casesList as $case)
                @php
                    $isSelected = $selectedCase && $selectedCase['id'] === $case['id'];
                @endphp
                <div 
                    wire:click="selectCase({{ $case['id'] }})"
                    class="cursor-pointer bg-white rounded-2xl p-5 border transition duration-200 shadow-xs relative hover:shadow-md {{ $isSelected ? 'border-[#00b4a2] ring-2 ring-[#00b4a2]/20' : 'border-slate-200/80 hover:border-slate-300' }}"
                >
                    <div class="flex items-start gap-3.5">
                        <!-- Employee Avatar Initials -->
                        <div class="w-11 h-11 rounded-full bg-slate-600 text-white font-bold text-sm flex items-center justify-center shadow-xs shrink-0 mt-0.5">
                            {{ $case['initials'] }}
                        </div>
                        
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-extrabold text-slate-900 truncate leading-snug">
                                {{ $case['name'] }}
                            </h3>
                            <p class="text-xs text-slate-400 font-semibold truncate">
                                {{ $case['department'] }} · {{ $case['reason'] }}
                            </p>

                            <div class="mt-3.5 space-y-2 text-xs">
                                <div class="flex justify-between items-center">
                                    <span class="text-slate-400 font-semibold">Last Day</span>
                                    <span class="font-extrabold text-rose-600">{{ $case['lastDay'] }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-slate-400 font-semibold">Stage</span>
                                    <span class="font-extrabold text-slate-700">{{ $case['stage'] }}</span>
                                </div>
                                <div class="flex justify-between items-center pt-1">
                                    <span class="text-slate-400 font-semibold">Clearance</span>
                                    <span class="font-black text-emerald-600">{{ $case['percentage'] }}%</span>
                                </div>

                                <!-- Dynamic Progress Bar -->
                                <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden mt-1">
                                    <div 
                                        class="h-full rounded-full transition-all duration-300 {{ $case['percentage'] >= 70 ? 'bg-emerald-500' : ($case['percentage'] >= 40 ? 'bg-amber-500' : 'bg-rose-500') }}"
                                        style="width: {{ $case['percentage'] }}%"
                                    ></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Right Column: Clearance Checklist & Actions (8 cols on desktop) -->
        <div class="lg:col-span-8">
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/80 shadow-xs space-y-6">
                
                <!-- Checklist Title -->
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <h2 class="text-xl font-black text-slate-900 tracking-tight">
                            Clearance Checklist — {{ $selectedCase['name'] }}
                        </h2>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">
                            Sri Lankan statutory compliance, EPF/ETF cessation, IT & financial clearance
                        </p>
                    </div>
                    <span class="px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-black rounded-full">
                        {{ $selectedCase['completedCount'] }}/{{ $selectedCase['totalCount'] }} Completed
                    </span>
                </div>

                <!-- Checklist Items -->
                <div class="space-y-3.5">
                    @foreach($selectedCase['checklist'] as $item)
                        @php
                            $isDone = $item['completed'];
                        @endphp
                        <div 
                            wire:click="toggleChecklistItem({{ $selectedCase['id'] }}, {{ $item['id'] }})"
                            class="cursor-pointer p-4 rounded-2xl border transition duration-150 flex items-center justify-between gap-4 {{ $isDone ? 'bg-emerald-50/60 border-emerald-200/80 text-emerald-900' : 'bg-slate-50/80 border-slate-200/80 text-slate-800 hover:bg-slate-100' }}"
                        >
                            <div class="flex items-center gap-3.5 min-w-0">
                                <!-- Checkbox Icon -->
                                <div class="w-6 h-6 rounded-full flex items-center justify-center shrink-0 transition {{ $isDone ? 'bg-emerald-600 text-white shadow-xs' : 'border-2 border-slate-300 bg-white' }}">
                                    @if($isDone)
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                        </svg>
                                    @endif
                                </div>

                                <div class="min-w-0">
                                    <p class="text-sm font-bold tracking-tight leading-snug {{ $isDone ? 'text-emerald-950 line-through opacity-80' : 'text-slate-900' }}">
                                        {{ $item['title'] }}
                                    </p>
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider {{ $isDone ? 'text-emerald-700' : 'text-slate-400' }}">
                                        {{ $item['category'] }}
                                    </span>
                                </div>
                            </div>

                            <div class="shrink-0 text-right">
                                @if($isDone)
                                    <span class="text-xs font-bold text-emerald-700 bg-emerald-100/80 px-2.5 py-1 rounded-lg">
                                        Cleared
                                    </span>
                                @else
                                    <span class="text-xs font-semibold text-slate-400 bg-white border border-slate-200 px-2.5 py-1 rounded-lg">
                                        Pending
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Action Buttons -->
                <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center gap-3">
                    <button 
                        type="button" 
                        wire:click="openExitInterviewModal"
                        class="w-full sm:w-1/2 py-3 px-5 bg-rose-50 hover:bg-rose-100 text-rose-600 border border-rose-200 font-extrabold text-sm rounded-2xl shadow-xs transition active:scale-98 flex items-center justify-center gap-2"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Schedule Exit Interview</span>
                    </button>

                    <button 
                        type="button" 
                        wire:click="openFinalPayslipModal"
                        class="w-full sm:w-1/2 py-3 px-5 bg-slate-100 hover:bg-slate-200 text-slate-800 border border-slate-200 font-extrabold text-sm rounded-2xl shadow-xs transition active:scale-98 flex items-center justify-center gap-2"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Generate Final Payslip & Gratuity</span>
                    </button>
                </div>
            </div>
        </div>

    </div>

    <!-- Exit Interview Modal -->
    @if($showExitInterviewModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-xs">
            <div class="bg-white rounded-3xl p-6 max-w-md w-full border border-slate-200 shadow-2xl space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 class="text-lg font-extrabold text-slate-900">Schedule Exit Interview</h3>
                    <button wire:click="closeExitInterviewModal" class="text-slate-400 hover:text-slate-600 font-bold">✕</button>
                </div>
                <p class="text-xs text-slate-600 font-medium">
                    Schedule HR exit interview with <strong>{{ $selectedCase['name'] }}</strong> before their last working day on {{ $selectedCase['lastDay'] }}.
                </p>
                <div class="space-y-3 text-xs">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Interviewer (HR Senior)</label>
                        <input type="text" value="Amara Jayawardena (Head of HR)" readonly class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2 text-slate-700 font-medium" />
                    </div>
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Date & Time</label>
                        <input type="datetime-local" value="2026-08-28T14:30" class="w-full border border-slate-200 rounded-xl px-3 py-2 text-slate-800 font-medium" />
                    </div>
                </div>
                <div class="flex justify-end gap-2 pt-3">
                    <button wire:click="closeExitInterviewModal" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl">Cancel</button>
                    <button wire:click="closeExitInterviewModal" class="px-4 py-2 bg-[#b91c1c] hover:bg-[#a11818] text-white font-bold text-xs rounded-xl shadow-xs">Confirm Schedule</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Final Payslip Modal -->
    @if($showFinalPayslipModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-xs">
            <div class="bg-white rounded-3xl p-6 max-w-lg w-full border border-slate-200 shadow-2xl space-y-4">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 class="text-lg font-extrabold text-slate-900">Final Settlement & Gratuity Payslip</h3>
                    <button wire:click="closeFinalPayslipModal" class="text-slate-400 hover:text-slate-600 font-bold">✕</button>
                </div>
                <div class="p-3 bg-emerald-50 border border-emerald-200 rounded-2xl text-xs text-emerald-900 font-medium">
                    Sri Lanka Payment of Gratuity Act No. 12 of 1983 & EPF/ETF C3 Statutory Calculation.
                </div>
                <div class="space-y-2 text-xs divide-y divide-slate-100">
                    <div class="flex justify-between py-1.5"><span class="text-slate-500 font-semibold">Employee Name:</span><span class="font-bold text-slate-900">{{ $selectedCase['name'] }}</span></div>
                    <div class="flex justify-between py-1.5"><span class="text-slate-500 font-semibold">Basic Salary + BRA:</span><span class="font-bold text-slate-900">Rs. 280,000.00</span></div>
                    <div class="flex justify-between py-1.5"><span class="text-slate-500 font-semibold">Gratuity Payment (5+ Yrs):</span><span class="font-bold text-emerald-700">Rs. 700,000.00</span></div>
                    <div class="flex justify-between py-1.5"><span class="text-slate-500 font-semibold">EPF (12% Employer + 8% Employee):</span><span class="font-bold text-slate-900">Rs. 56,000.00</span></div>
                    <div class="flex justify-between py-1.5"><span class="text-slate-500 font-semibold">ETF (3% Employer):</span><span class="font-bold text-slate-900">Rs. 8,400.00</span></div>
                    <div class="flex justify-between py-1.5 pt-2 border-t-2 border-slate-200"><span class="text-slate-800 font-extrabold text-sm">Net Payable Settlement:</span><span class="font-black text-sm text-[#b91c1c]">Rs. 1,036,000.00</span></div>
                </div>
                <div class="flex justify-end gap-2 pt-3">
                    <button wire:click="closeFinalPayslipModal" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl">Close</button>
                    <button wire:click="closeFinalPayslipModal" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl shadow-xs">Download PDF Statement</button>
                </div>
            </div>
        </div>
    @endif

</div>
