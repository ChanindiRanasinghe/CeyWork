<div class="space-y-6 bg-[#fdfbf4] min-h-screen p-3 sm:p-6">
    <!-- Top Header Bar: Onboarding -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Onboarding & Verification</h1>
            <p class="text-slate-500 text-xs sm:text-sm mt-1 font-medium">
                3 Sri Lankan employees onboarding · Document verification active
            </p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold rounded-xl flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                <span>Sri Lanka Statutory HR Verification</span>
            </span>
        </div>
    </div>

    <!-- Sub-Navigation Tabs (Active Cases, Checklist, Documents Verification) -->
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
            <span>Tasks Checklist</span>
        </button>

        <button 
            type="button" 
            wire:click="setTab('documents')" 
            class="pb-3 border-b-2 transition cursor-pointer flex items-center gap-2 {{ $activeTab === 'documents' ? 'border-[#b91c1c] text-[#b91c1c]' : 'border-transparent text-slate-500 hover:text-slate-800' }}"
        >
            <span>Required Sri Lankan Documents</span>
        </button>
    </div>

    <!-- TAB 1: ACTIVE CASES VIEW -->
    @if($activeTab === 'active_cases')
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($candidatesList as $cand)
                <div 
                    wire:click="selectCandidate({{ $cand['id'] }}); setTab('documents');" 
                    class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs hover:shadow-md transition cursor-pointer flex flex-col justify-between group"
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
                            <span class="text-slate-500 uppercase tracking-wider text-[11px]">Tasks Completion</span>
                            <span class="text-slate-700">{{ $cand['completedCount'] }}/{{ $cand['totalCount'] }} tasks</span>
                        </div>

                        <!-- Progress Bar -->
                        <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden mb-3">
                            <div 
                                class="h-full rounded-full transition-all duration-300 {{ $cand['percentage'] >= 50 ? 'bg-emerald-500' : ($cand['percentage'] > 0 ? 'bg-amber-500' : 'bg-slate-300') }}" 
                                style="width: {{ $cand['percentage'] }}%"
                            ></div>
                        </div>

                        <!-- Document Status Summary -->
                        <div class="mt-4 p-3 bg-slate-50 rounded-2xl border border-slate-100 space-y-1 text-xs">
                            <div class="flex justify-between font-bold text-slate-700">
                                <span>Required Documents</span>
                                <span class="text-emerald-700">7 Mandatory</span>
                            </div>
                            <p class="text-[11px] text-slate-400 font-medium">Police report, Grama Niladhari, NIC, Certificates</p>
                        </div>
                    </div>

                    <!-- Buddy Footnote -->
                    <div class="pt-4 border-t border-slate-100 text-xs text-slate-600 font-medium mt-6">
                        Buddy: <strong class="text-slate-900 font-bold">{{ $cand['buddy'] }}</strong>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- TAB 2: CHECKLIST VIEW -->
    @if($activeTab === 'checklist')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            <!-- Left 1/3: Candidate Selector -->
            <div class="space-y-3">
                @foreach($candidatesList as $cand)
                    <div 
                        wire:click="selectCandidate({{ $cand['id'] }})" 
                        class="p-4 rounded-2xl border transition cursor-pointer flex items-center justify-between shadow-xs {{ $selectedCandidate['id'] === $cand['id'] ? 'bg-rose-50/70 border-rose-200 ring-2 ring-rose-200/50' : 'bg-white border-slate-200/80 hover:bg-slate-50' }}"
                    >
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-[#b91c1c] text-white font-black text-xs flex items-center justify-center shadow-xs shrink-0">
                                {{ $cand['initials'] }}
                            </div>
                            <div>
                                <h4 class="text-xs font-extrabold text-slate-900">{{ $cand['name'] }}</h4>
                                <p class="text-[11px] text-slate-500 font-medium mt-0.5">
                                    {{ $cand['department'] }} · <span class="font-bold text-slate-700">{{ $cand['percentage'] }}% done</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Right 2/3: Tasks Panel -->
            <div class="lg:col-span-2 bg-white rounded-3xl p-6 lg:p-8 border border-slate-200/80 shadow-xs space-y-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <h3 class="text-xl font-extrabold text-slate-900">Onboarding Tasks — {{ $selectedCandidate['name'] }}</h3>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">
                            {{ $selectedCandidate['completedCount'] }} of {{ $selectedCandidate['totalCount'] }} tasks completed
                        </p>
                    </div>
                    <span class="text-2xl font-black text-[#b91c1c]">
                        {{ $selectedCandidate['percentage'] }}%
                    </span>
                </div>

                <div class="space-y-3">
                    @foreach($selectedCandidate['tasks'] as $task)
                        <div 
                            wire:click="toggleTask({{ $selectedCandidate['id'] }}, {{ $task['id'] }})" 
                            class="p-4 rounded-2xl border transition cursor-pointer flex items-center justify-between gap-4 {{ $task['completed'] ? 'bg-emerald-50/80 border-emerald-200 text-emerald-950' : 'bg-slate-50/80 border-slate-200/80 text-slate-800 hover:border-slate-300' }}"
                        >
                            <div class="flex items-center gap-3.5 min-w-0">
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

                            <span class="px-2.5 py-1 text-[10px] font-extrabold rounded-md shrink-0 uppercase tracking-wider {{ $task['deptColor'] }}">
                                {{ $task['dept'] }}
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- TAB 3: REQUIRED SRI LANKAN DOCUMENTS VERIFICATION -->
    @if($activeTab === 'documents')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
            <!-- Left 1/3: Candidate Selector -->
            <div class="space-y-3">
                @foreach($candidatesList as $cand)
                    <div 
                        wire:click="selectCandidate({{ $cand['id'] }})" 
                        class="p-4 rounded-2xl border transition cursor-pointer flex items-center justify-between shadow-xs {{ $selectedCandidate['id'] === $cand['id'] ? 'bg-rose-50/70 border-rose-200 ring-2 ring-rose-200/50' : 'bg-white border-slate-200/80 hover:bg-slate-50' }}"
                    >
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-[#b91c1c] text-white font-black text-xs flex items-center justify-center shadow-xs shrink-0">
                                {{ $cand['initials'] }}
                            </div>
                            <div>
                                <h4 class="text-xs font-extrabold text-slate-900">{{ $cand['name'] }}</h4>
                                <p class="text-[11px] text-slate-500 font-medium mt-0.5">
                                    {{ $cand['department'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Right 2/3: 7 Sri Lankan Mandatory Onboarding Documents -->
            <div class="lg:col-span-2 bg-white rounded-3xl p-6 lg:p-8 border border-slate-200/80 shadow-xs space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-slate-100 pb-4 gap-2">
                    <div>
                        <h3 class="text-xl font-extrabold text-slate-900">Sri Lankan Statutory Onboarding Documents</h3>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">
                            Required candidate documentation for <strong>{{ $selectedCandidate['name'] }}</strong>
                        </p>
                    </div>
                    <span class="px-3 py-1 bg-amber-50 text-amber-800 border border-amber-200 text-xs font-bold rounded-full shrink-0">
                        7 Mandatory Documents
                    </span>
                </div>

                <div class="space-y-3.5">
                    @foreach($selectedCandidate['documents'] as $doc)
                        @php
                            $isVerified = $doc['status'] === 'Verified';
                            $isSubmitted = $doc['status'] === 'Submitted';
                        @endphp
                        <div class="p-4 rounded-2xl border transition flex items-center justify-between gap-4 {{ $isVerified ? 'bg-emerald-50/70 border-emerald-200' : ($isSubmitted ? 'bg-amber-50/70 border-amber-200' : 'bg-slate-50/80 border-slate-200/80') }}">
                            <div class="flex items-center gap-3.5 min-w-0">
                                <div class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 {{ $isVerified ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-600' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xs font-black text-slate-900 leading-snug">{{ $doc['name'] }}</h4>
                                    <div class="flex items-center gap-2 mt-0.5 text-[11px]">
                                        <span class="font-semibold text-slate-400">Statutory Requirement</span>
                                        @if($doc['required'])
                                            <span class="text-rose-600 font-bold">• Mandatory</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 shrink-0">
                                <span class="px-3 py-1 text-xs font-bold rounded-xl border {{ $isVerified ? 'bg-emerald-100 text-emerald-800 border-emerald-300' : ($isSubmitted ? 'bg-amber-100 text-amber-900 border-amber-300' : 'bg-slate-100 text-slate-600 border-slate-200') }}">
                                    {{ $doc['status'] }}
                                </span>

                                <button 
                                    type="button" 
                                    wire:click="toggleDocStatus({{ $selectedCandidate['id'] }}, {{ $doc['id'] }})"
                                    class="px-3 py-1.5 text-xs font-extrabold rounded-xl transition border {{ $isVerified ? 'bg-slate-100 hover:bg-slate-200 text-slate-700 border-slate-200' : 'bg-emerald-600 hover:bg-emerald-700 text-white border-emerald-600 shadow-2xs' }}"
                                >
                                    {{ $isVerified ? 'Mark Pending' : 'Verify Document' }}
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
