<div class="space-y-6 bg-[#fdfbf4] min-h-screen p-2 sm:p-4">
    <!-- Top Header Bar: Onboarding -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Onboarding</h1>
            <p class="text-slate-500 text-xs sm:text-sm mt-1 font-medium">
                3 employees onboarding · 1 starting this week
            </p>
        </div>
    </div>

    <!-- Sub-Navigation Tabs (Active Cases, Checklist) -->
    <div class="border-b border-slate-200/80 flex items-center gap-8 text-sm font-bold pt-2">
        <button 
            type="button" 
            wire:click="setTab('active_cases')" 
            class="pb-3 border-b-2 transition cursor-pointer flex items-center gap-2 {{ $activeTab === 'active_cases' ? 'border-[#b91c1c] text-[#b91c1c]' : 'border-transparent text-slate-500 hover:text-slate-800' }}"
        >
            <span>Active Cases</span>
        </button>

        <button 
            type="button" 
            wire:click="setTab('checklist')" 
            class="pb-3 border-b-2 transition cursor-pointer flex items-center gap-2 {{ $activeTab === 'checklist' ? 'border-[#b91c1c] text-[#b91c1c]' : 'border-transparent text-slate-500 hover:text-slate-800' }}"
        >
            <span>Checklist</span>
        </button>
    </div>

    <!-- TAB 1: ACTIVE CASES VIEW -->
    @if($activeTab === 'active_cases')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($candidatesList as $cand)
                <div 
                    wire:click="selectCandidate({{ $cand['id'] }}); setTab('checklist');" 
                    class="bg-[#fcfbf7] rounded-3xl p-6 border border-slate-200/80 shadow-xs hover:shadow-md transition cursor-pointer flex flex-col justify-between group"
                >
                    <div>
                        <!-- Candidate Header -->
                        <div class="flex items-center gap-3.5 mb-6">
                            <div class="w-11 h-11 rounded-full bg-[#b91c1c] text-white font-black text-sm flex items-center justify-center shadow-xs shrink-0">
                                {{ $cand['initials'] }}
                            </div>
                            <div>
                                <h3 class="text-base font-extrabold text-slate-900 group-hover:text-[#b91c1c] transition">{{ $cand['name'] }}</h3>
                                <p class="text-xs text-slate-400 font-semibold mt-0.5">{{ $cand['department'] }}</p>
                            </div>
                        </div>

                        <!-- Progress Header -->
                        <div class="flex items-center justify-between text-xs font-bold mb-2">
                            <span class="text-slate-500 uppercase tracking-wider text-[11px]">Progress</span>
                            <span class="text-slate-700">{{ $cand['completedCount'] }}/{{ $cand['totalCount'] }} tasks</span>
                        </div>

                        <!-- Progress Bar -->
                        <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden mb-3">
                            <div 
                                class="h-full rounded-full transition-all duration-300 {{ $cand['percentage'] >= 50 ? 'bg-emerald-500' : ($cand['percentage'] > 0 ? 'bg-amber-500' : 'bg-slate-300') }}" 
                                style="width: {{ $cand['percentage'] }}%"
                            ></div>
                        </div>

                        <!-- Start Date & % Complete -->
                        <div class="flex items-center justify-between text-xs font-semibold mb-6">
                            <span class="text-slate-400">Start: {{ $cand['startDate'] }}</span>
                            <span class="{{ $cand['percentage'] >= 50 ? 'text-emerald-600 font-extrabold' : ($cand['percentage'] > 0 ? 'text-amber-600 font-extrabold' : 'text-slate-400 font-bold') }}">
                                {{ $cand['percentage'] }}%
                            </span>
                        </div>
                    </div>

                    <!-- Buddy Footnote -->
                    <div class="pt-4 border-t border-slate-100 text-xs text-slate-600 font-medium">
                        Buddy: <strong class="text-slate-900 font-bold">{{ $cand['buddy'] }}</strong>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- TAB 2: CHECKLIST VIEW (2-COLUMN LAYOUT) -->
    @if($activeTab === 'checklist')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            <!-- Left 1/3: Candidate Selector List -->
            <div class="space-y-3">
                @foreach($candidatesList as $cand)
                    <div 
                        wire:click="selectCandidate({{ $cand['id'] }})" 
                        class="p-4 rounded-2xl border transition cursor-pointer flex items-center justify-between shadow-xs {{ $selectedCandidate['id'] === $cand['id'] ? 'bg-[#eef2ff] border-indigo-300 ring-2 ring-indigo-200' : 'bg-[#fcfbf7] border-slate-200/80 hover:bg-slate-50' }}"
                    >
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-[#b91c1c] text-white font-bold text-xs flex items-center justify-center shadow-xs shrink-0">
                                {{ $cand['initials'] }}
                            </div>
                            <div>
                                <h4 class="text-xs font-extrabold text-slate-900">{{ $cand['name'] }}</h4>
                                <p class="text-[11px] text-slate-500 font-medium mt-0.5">
                                    {{ $cand['department'] }} · <span class="font-bold text-slate-700">{{ $cand['percentage'] }}% done</span>
                                </p>
                            </div>
                        </div>
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                @endforeach
            </div>

            <!-- Right 2/3: Interactive Task Checklist Panel -->
            <div class="lg:col-span-2 bg-[#fcfbf7] rounded-3xl p-6 lg:p-8 border border-slate-200/80 shadow-xs space-y-6">
                <!-- Checklist Header -->
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <h3 class="text-xl font-extrabold text-slate-900">Checklist — {{ $selectedCandidate['name'] }}</h3>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">
                            {{ $selectedCandidate['completedCount'] }} of {{ $selectedCandidate['totalCount'] }} tasks completed
                        </p>
                    </div>
                    <span class="text-2xl font-black text-[#b91c1c]">
                        {{ $selectedCandidate['percentage'] }}%
                    </span>
                </div>

                <!-- Interactive 11-Step Task Checklist -->
                <div class="space-y-3">
                    @foreach($selectedCandidate['tasks'] as $task)
                        <div 
                            wire:click="toggleTask({{ $selectedCandidate['id'] }}, {{ $task['id'] }})" 
                            class="p-4 rounded-2xl border transition cursor-pointer flex items-center justify-between gap-4 {{ $task['completed'] ? 'bg-emerald-50/80 border-emerald-200 text-emerald-950' : 'bg-white border-slate-200/80 text-slate-800 hover:border-slate-300' }}"
                        >
                            <div class="flex items-center gap-3.5 min-w-0">
                                <!-- Checkmark Icon -->
                                @if($task['completed'])
                                    <div class="w-5 h-5 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-xs">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </div>
                                @else
                                    <div class="w-5 h-5 rounded-full border-2 border-slate-300 shrink-0"></div>
                                @endif

                                <span class="text-xs font-bold leading-tight {{ $task['completed'] ? 'text-emerald-900 font-semibold' : 'text-slate-800' }}">
                                    {{ $task['text'] }}
                                </span>
                            </div>

                            <!-- Department Pill Badge -->
                            <span class="px-2.5 py-1 text-[10px] font-extrabold rounded-md shrink-0 uppercase tracking-wider {{ $task['deptColor'] }}">
                                {{ $task['dept'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
