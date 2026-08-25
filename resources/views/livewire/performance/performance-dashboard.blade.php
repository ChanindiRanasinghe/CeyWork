<div class="space-y-6 bg-[#fdfbf4] min-h-screen p-3 sm:p-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Performance</h1>
            <p class="text-slate-500 text-xs sm:text-sm mt-1 font-medium">
                Q3 2026 · Review cycle starts Sep 1 · Full Admin Controls Enabled
            </p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1.5 bg-rose-50 text-rose-700 border border-rose-200 text-xs font-bold rounded-xl flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-[#b91c1c]"></span>
                <span>Visible to All Staff</span>
            </span>
        </div>
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
            <button wire:click="dismissSuccessMessage" class="text-emerald-500 hover:text-emerald-800 font-black text-sm">✕</button>
        </div>
    @endif

    <!-- Navigation Tabs: KPIs, Evaluations -->
    <div class="border-b border-slate-200/80 flex items-center gap-8 text-sm font-bold pt-2">
        <button 
            type="button" 
            wire:click="setTab('kpis')" 
            class="pb-3 border-b-2 transition cursor-pointer flex items-center gap-2 {{ $activeTab === 'kpis' ? 'border-[#b91c1c] text-[#b91c1c]' : 'border-transparent text-slate-500 hover:text-slate-800' }}"
        >
            <span>KPIs</span>
        </button>

        <button 
            type="button" 
            wire:click="setTab('evaluations')" 
            class="pb-3 border-b-2 transition cursor-pointer flex items-center gap-2 {{ $activeTab === 'evaluations' ? 'border-[#b91c1c] text-[#b91c1c]' : 'border-transparent text-slate-500 hover:text-slate-800' }}"
        >
            <span>Evaluations</span>
        </button>
    </div>

    <!-- TAB 1: KPIS VIEW (2-COLUMN GRID MATCHING SCREENSHOT) -->
    @if($activeTab === 'kpis')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($kpisData as $kpi)
                <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between space-y-4 relative group">
                    <div>
                        <!-- Header Row: Title, Dept & Status Badge -->
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <h3 class="text-base font-extrabold text-slate-900 leading-snug">{{ $kpi['title'] }}</h3>
                                <p class="text-xs text-slate-400 font-semibold mt-0.5">{{ $kpi['department'] }}</p>
                            </div>
                            
                            <div class="flex items-center gap-2">
                                @if($canEditPerformance)
                                    <button 
                                        type="button" 
                                        wire:click="openEditKpiModal({{ $kpi['id'] }})"
                                        class="px-2.5 py-1 text-xs font-bold rounded-xl transition bg-amber-50 hover:bg-amber-100 text-amber-900 border border-amber-200"
                                        title="Admin Edit KPI"
                                    >
                                        ✏️ Edit KPI
                                    </button>
                                @endif

                                <span class="px-2.5 py-1 text-[11px] font-extrabold rounded-full border shrink-0 {{ $kpi['statusClass'] }}">
                                    {{ $kpi['statusLabel'] }}
                                </span>
                            </div>
                        </div>

                        <!-- Metric Values Row: Actual / Target + Trend Arrow -->
                        <div class="flex items-end justify-between mt-5">
                            <div>
                                <div class="flex items-center gap-4 text-[11px] font-extrabold text-slate-400 uppercase tracking-wider mb-1">
                                    <span>ACTUAL</span>
                                    <span>TARGET</span>
                                </div>
                                <div class="flex items-baseline gap-2 font-black">
                                    <span class="text-3xl text-slate-900 tracking-tight">{{ $kpi['actual'] }}</span>
                                    <span class="text-3xl text-slate-300 tracking-tight">/ {{ $kpi['target'] }}</span>
                                </div>
                            </div>
                            
                            <!-- Trend Arrow -->
                            <div class="text-2xl font-black {{ $kpi['trendColor'] }} pb-1">
                                @if($kpi['trend'] === 'up')
                                    ↗
                                @else
                                    ↘
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Progress Bar & Target Footnote -->
                    <div class="space-y-1.5 pt-2">
                        <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                            <div 
                                class="h-full rounded-full transition-all duration-300 {{ $kpi['progressColor'] }}" 
                                style="width: {{ $kpi['percentage'] }}%"
                            ></div>
                        </div>
                        <div class="flex justify-end text-[11px] font-bold text-slate-400">
                            <span>{{ $kpi['targetFootnote'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- TAB 2: EVALUATIONS VIEW -->
    @if($activeTab === 'evaluations')
        <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 border-b border-slate-100 pb-4">
                <div>
                    <h3 class="text-xl font-extrabold text-slate-900">Quarterly Employee Evaluations</h3>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">
                        Q3 2026 performance appraisal status & self-evaluations
                    </p>
                </div>
                <span class="px-3 py-1 bg-emerald-50 text-emerald-800 border border-emerald-200 text-xs font-bold rounded-full">
                    Visible to All Staff
                </span>
            </div>

            <!-- Evaluations Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-[11px] font-extrabold text-slate-400 uppercase tracking-wider">
                            <th class="pb-3 px-3">Employee</th>
                            <th class="pb-3 px-3">Department</th>
                            <th class="pb-3 px-3">Period</th>
                            <th class="pb-3 px-3">Self Rating</th>
                            <th class="pb-3 px-3">Manager Rating</th>
                            <th class="pb-3 px-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700 font-medium">
                        @foreach($evaluationsData as $eval)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3.5 px-3">
                                    <div class="font-extrabold text-slate-900">{{ $eval['employee'] }}</div>
                                    <div class="text-[11px] text-slate-400 font-semibold">{{ $eval['role'] }}</div>
                                </td>
                                <td class="py-3.5 px-3 font-semibold text-slate-600">{{ $eval['department'] }}</td>
                                <td class="py-3.5 px-3 font-bold text-slate-800">{{ $eval['period'] }}</td>
                                <td class="py-3.5 px-3 font-bold text-slate-800">{{ $eval['selfRating'] }}</td>
                                <td class="py-3.5 px-3 font-bold text-slate-900">{{ $eval['managerRating'] }}</td>
                                <td class="py-3.5 px-3">
                                    <span class="px-2.5 py-1 text-[11px] font-extrabold rounded-full border {{ $eval['statusClass'] }}">
                                        {{ $eval['status'] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- ADMIN EDIT KPI MODAL -->
    @if($showEditKpiModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-xs">
            <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full border border-slate-200 shadow-2xl space-y-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <h3 class="text-xl font-extrabold text-slate-900">Edit KPI Metric (Admin)</h3>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">Modify performance metrics, target goals, and statuses</p>
                    </div>
                    <button wire:click="closeEditKpiModal" class="text-slate-400 hover:text-slate-600 font-bold text-lg">✕</button>
                </div>

                <form wire:submit.prevent="updateKpi" class="space-y-4 text-xs">
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">KPI Title *</label>
                        <input 
                            type="text" 
                            wire:model="editTitle" 
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                        />
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Department *</label>
                            <input 
                                type="text" 
                                wire:model="editDepartment" 
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                            />
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Status Badge *</label>
                            <select 
                                wire:model="editStatus" 
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                            >
                                <option value="on-track">on-track</option>
                                <option value="exceeded">exceeded</option>
                                <option value="at-risk">at-risk</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Actual Value *</label>
                            <input 
                                type="text" 
                                wire:model="editActual" 
                                placeholder="e.g. 87%" 
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                            />
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Target Value *</label>
                            <input 
                                type="text" 
                                wire:model="editTarget" 
                                placeholder="e.g. 90%" 
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                            />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">% of Target</label>
                            <input 
                                type="number" 
                                wire:model="editPercentage" 
                                placeholder="97" 
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                            />
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Trend Direction</label>
                            <select 
                                wire:model="editTrend" 
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                            >
                                <option value="up">Up (↗)</option>
                                <option value="down">Down (↘)</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                        <button 
                            type="button" 
                            wire:click="closeEditKpiModal" 
                            class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-5 py-2.5 bg-[#b91c1c] hover:bg-[#a11818] text-white font-extrabold text-xs rounded-xl shadow-xs transition"
                        >
                            Update KPI
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
