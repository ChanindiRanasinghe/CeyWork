<div class="space-y-6 bg-[#fdfbf4] min-h-screen p-2 sm:p-4">
    <!-- Top Header Bar: Recruitment & ATS Hub -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Recruitment & ATS Hub</h1>
            <p class="text-slate-500 text-xs sm:text-sm mt-1 font-medium">
                Manage job vacancies, track candidate pipelines across stages, and schedule interviews.
            </p>
        </div>
        <button 
            type="button" 
            class="px-4 py-2.5 bg-[#b91c1c] hover:bg-[#a11818] text-white font-bold text-xs rounded-xl shadow-sm transition flex items-center justify-center gap-2 active:scale-95 shrink-0"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            <span>Post New Vacancy</span>
        </button>
    </div>

    <!-- 4 Top Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Card 1: Active Vacancies -->
        <div class="bg-[#fcfbf7] rounded-2xl p-5 border border-slate-200/80 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-red-50 border border-red-100 flex items-center justify-center text-[#b91c1c] shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 00-2-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">ACTIVE VACANCIES</p>
                <p class="text-2xl font-black text-slate-900 tracking-tight mt-0.5">{{ $totalVacanciesCount > 0 ? $totalVacanciesCount : 17 }}</p>
                <p class="text-[11px] font-semibold text-emerald-600 flex items-center gap-1 mt-0.5">
                    <span>↗</span> <span>+2 this month</span>
                </p>
            </div>
        </div>

        <!-- Card 2: Total Applicants -->
        <div class="bg-[#fcfbf7] rounded-2xl p-5 border border-slate-200/80 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-blue-50 border border-blue-100 flex items-center justify-center text-blue-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">TOTAL APPLICANTS</p>
                <p class="text-2xl font-black text-slate-900 tracking-tight mt-0.5">{{ $totalApplicantsCount }}</p>
                <p class="text-[11px] font-semibold text-emerald-600 flex items-center gap-1 mt-0.5">
                    <span>↗</span> <span>+18 this week</span>
                </p>
            </div>
        </div>

        <!-- Card 3: Interviews Today -->
        <div class="bg-[#fcfbf7] rounded-2xl p-5 border border-slate-200/80 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-purple-50 border border-purple-100 flex items-center justify-center text-purple-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">INTERVIEWS TODAY</p>
                <p class="text-2xl font-black text-slate-900 tracking-tight mt-0.5">4</p>
                <p class="text-[11px] font-semibold text-purple-600 flex items-center gap-1 mt-0.5">
                    <span>2 completed</span>
                </p>
            </div>
        </div>

        <!-- Card 4: Offers Accepted -->
        <div class="bg-[#fcfbf7] rounded-2xl p-5 border border-slate-200/80 shadow-xs flex items-center gap-4">
            <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-600 shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="text-[11px] font-bold tracking-wider text-slate-500 uppercase">OFFERS ACCEPTED</p>
                <p class="text-2xl font-black text-slate-900 tracking-tight mt-0.5">6</p>
                <p class="text-[11px] font-semibold text-emerald-600 flex items-center gap-1 mt-0.5">
                    <span>↗ 85% rate</span>
                </p>
            </div>
        </div>
    </div>

    <!-- Sub-Navigation Navigation Tabs (Vacancies, Pipelines, Interviews) -->
    <div class="bg-[#fcfbf7] rounded-2xl p-3 border border-slate-200/80 shadow-xs flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-xs font-bold">
            <!-- Vacancies Tab -->
            <button 
                type="button" 
                wire:click="setTab('vacancies')" 
                class="px-4 py-2.5 rounded-xl transition flex items-center gap-2 cursor-pointer {{ $activeTab === 'vacancies' ? 'bg-[#b91c1c] text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span>🎯 Vacancies</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-black {{ $activeTab === 'vacancies' ? 'bg-white text-[#b91c1c]' : 'bg-slate-200 text-slate-700' }}">
                    {{ $totalVacanciesCount > 0 ? $totalVacanciesCount : 17 }}
                </span>
            </button>

            <!-- Candidate Pipelines Tab -->
            <button 
                type="button" 
                wire:click="setTab('pipelines')" 
                class="px-4 py-2.5 rounded-xl transition flex items-center gap-2 cursor-pointer {{ $activeTab === 'pipelines' ? 'bg-[#b91c1c] text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                </svg>
                <span>📋 Candidate Pipelines</span>
            </button>

            <!-- Interview Schedule Tab -->
            <button 
                type="button" 
                wire:click="setTab('interviews')" 
                class="px-4 py-2.5 rounded-xl transition flex items-center gap-2 cursor-pointer {{ $activeTab === 'interviews' ? 'bg-[#b91c1c] text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>🗓 Interview Schedule</span>
            </button>
        </div>

        <!-- Search Input -->
        <div class="relative w-full sm:w-64">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            <input 
                type="text" 
                wire:model.live="search" 
                placeholder="Search candidates or vacancies..." 
                class="w-full bg-[#f4f6f9] border border-slate-200 text-slate-900 text-xs rounded-xl pl-9 pr-3 py-2 focus:bg-white focus:ring-2 focus:ring-[#00b4a2] focus:outline-none transition" 
            />
        </div>
    </div>

    <!-- Flash Notification Banner -->
    @if(session()->has('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl p-3 text-xs font-bold flex items-center justify-between">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- TAB 1: VACANCIES VIEW -->
    @if($activeTab === 'vacancies')
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($vacancies as $vac)
                <div class="bg-[#fcfbf7] rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-2.5 py-1 bg-slate-100 text-slate-700 text-[11px] font-bold rounded-lg uppercase tracking-wider">
                                {{ $vac->department->name ?? 'Engineering' }}
                            </span>
                            <span class="px-2.5 py-1 text-[11px] font-bold rounded-full border {{ $vac->status === 'open' ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-rose-50 text-[#b91c1c] border-rose-200' }}">
                                {{ ucfirst($vac->status) }}
                            </span>
                        </div>

                        <h3 class="text-base font-extrabold text-slate-900 leading-tight">{{ $vac->title }}</h3>
                        <p class="text-xs text-slate-500 font-medium line-clamp-2 mt-1">{{ $vac->description }}</p>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 space-y-3">
                        <div class="flex items-center justify-between text-xs font-semibold text-slate-600">
                            <span class="flex items-center gap-1.5">
                                👥 <strong>{{ $vac->candidates->count() > 0 ? $vac->candidates->count() : 48 }}</strong> Applicants
                            </span>
                            <span class="flex items-center gap-1.5">
                                🎯 <strong>{{ $vac->openings_count }}</strong> Openings
                            </span>
                        </div>

                        <div class="flex items-center gap-2">
                            <button 
                                type="button" 
                                wire:click="setTab('pipelines')" 
                                class="flex-1 py-2 bg-[#b91c1c] hover:bg-[#a11818] text-white text-xs font-bold rounded-xl transition text-center shadow-xs"
                            >
                                View Pipeline
                            </button>
                            <button 
                                type="button" 
                                class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold rounded-xl transition"
                            >
                                Details
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Default Sample Vacancies Cards if database is empty -->
                <div class="bg-[#fcfbf7] rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-2.5 py-1 bg-slate-100 text-slate-700 text-[11px] font-bold rounded-lg uppercase tracking-wider">Engineering</span>
                            <span class="px-2.5 py-1 text-[11px] font-bold rounded-full bg-rose-50 text-[#b91c1c] border border-rose-200">Urgent</span>
                        </div>
                        <h3 class="text-base font-extrabold text-slate-900">Senior Full Stack Engineer</h3>
                        <p class="text-xs text-slate-500 font-medium mt-1">Lead development of core Laravel & Livewire HR modules.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 space-y-3">
                        <div class="flex items-center justify-between text-xs font-semibold text-slate-600">
                            <span>👥 <strong>48</strong> Applicants</span>
                            <span>🎯 <strong>2</strong> Openings</span>
                        </div>
                        <button type="button" wire:click="setTab('pipelines')" class="w-full py-2 bg-[#b91c1c] text-white text-xs font-bold rounded-xl shadow-xs">View Pipeline</button>
                    </div>
                </div>

                <div class="bg-[#fcfbf7] rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-2.5 py-1 bg-slate-100 text-slate-700 text-[11px] font-bold rounded-lg uppercase tracking-wider">Finance</span>
                            <span class="px-2.5 py-1 text-[11px] font-bold rounded-full bg-rose-50 text-[#b91c1c] border border-rose-200">Urgent</span>
                        </div>
                        <h3 class="text-base font-extrabold text-slate-900">Finance Controller</h3>
                        <p class="text-xs text-slate-500 font-medium mt-1">Manage Sri Lanka EPF/ETF statutory compliance and audit reporting.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 space-y-3">
                        <div class="flex items-center justify-between text-xs font-semibold text-slate-600">
                            <span>👥 <strong>24</strong> Applicants</span>
                            <span>🎯 <strong>1</strong> Opening</span>
                        </div>
                        <button type="button" wire:click="setTab('pipelines')" class="w-full py-2 bg-[#b91c1c] text-white text-xs font-bold rounded-xl shadow-xs">View Pipeline</button>
                    </div>
                </div>

                <div class="bg-[#fcfbf7] rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-2.5 py-1 bg-slate-100 text-slate-700 text-[11px] font-bold rounded-lg uppercase tracking-wider">Product</span>
                            <span class="px-2.5 py-1 text-[11px] font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">Open</span>
                        </div>
                        <h3 class="text-base font-extrabold text-slate-900">Product Manager</h3>
                        <p class="text-xs text-slate-500 font-medium mt-1">Lead product roadmap and design systems for enterprise clients.</p>
                    </div>
                    <div class="mt-6 pt-4 border-t border-slate-100 space-y-3">
                        <div class="flex items-center justify-between text-xs font-semibold text-slate-600">
                            <span>👥 <strong>31</strong> Applicants</span>
                            <span>🎯 <strong>1</strong> Opening</span>
                        </div>
                        <button type="button" wire:click="setTab('pipelines')" class="w-full py-2 bg-[#b91c1c] text-white text-xs font-bold rounded-xl shadow-xs">View Pipeline</button>
                    </div>
                </div>
            @endforelse
        </div>
    @endif

    <!-- TAB 2: CANDIDATE PIPELINES (KANBAN BOARD) -->
    @if($activeTab === 'pipelines')
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 overflow-x-auto pb-4">
            @foreach($kanbanStages as $stageKey => $stage)
                <div class="bg-[#f8f6f0] rounded-3xl p-4 border border-slate-200/70 shrink-0 min-w-[240px] flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4 px-1">
                            <h4 class="text-xs font-black tracking-wider text-slate-900 uppercase">{{ $stage['title'] }}</h4>
                            <span class="px-2 py-0.5 text-[11px] font-bold rounded-full {{ $stage['badge'] }}">
                                {{ count($stage['items']) }}
                            </span>
                        </div>

                        <div class="space-y-3">
                            @forelse($stage['items'] as $cand)
                                <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-xs hover:border-[#b91c1c] transition group">
                                    <div class="flex items-start justify-between">
                                        <div>
                                            <h5 class="text-xs font-bold text-slate-900 group-hover:text-[#b91c1c] transition">{{ $cand->full_name }}</h5>
                                            <p class="text-[11px] text-slate-500 font-medium mt-0.5">{{ $cand->vacancy->title ?? 'Software Engineer' }}</p>
                                        </div>
                                        <span class="text-xs text-amber-500 font-bold">★ 4.8</span>
                                    </div>
                                    
                                    <p class="text-[10px] text-slate-400 font-semibold mt-3 pt-2 border-t border-slate-100 flex items-center justify-between">
                                        <span>Applied {{ $cand->created_at ? $cand->created_at->diffForHumans() : '2 days ago' }}</span>
                                    </p>

                                    <!-- Quick Stage Movement Trigger -->
                                    <div class="mt-2.5 flex items-center gap-1 text-[10px] font-bold">
                                        @if($stageKey !== 'hired')
                                            <button 
                                                type="button" 
                                                wire:click="updateCandidateStage({{ $cand->id }}, '{{ $stageKey === 'applied' ? 'shortlisted' : ($stageKey === 'shortlisted' ? 'interview-scheduled' : ($stageKey === 'interview-scheduled' ? 'offer' : 'hired')) }}')" 
                                                class="w-full py-1.5 bg-slate-100 hover:bg-[#b91c1c] hover:text-white text-slate-700 rounded-lg transition text-center"
                                            >
                                                Advance Stage →
                                            </button>
                                        @else
                                            <span class="w-full py-1 text-emerald-700 bg-emerald-50 text-center rounded-lg font-bold">✓ Hired</span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="p-4 text-center border border-dashed border-slate-300 rounded-2xl">
                                    <p class="text-xs text-slate-400 font-medium">No candidates in this stage</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- TAB 3: INTERVIEW SCHEDULE -->
    @if($activeTab === 'interviews')
        <div class="bg-[#fcfbf7] rounded-3xl p-6 border border-slate-200/80 shadow-xs space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-base font-extrabold text-slate-900">Scheduled Interviews</h3>
                <button type="button" class="px-3.5 py-2 bg-[#b91c1c] text-white font-bold text-xs rounded-xl shadow-xs hover:bg-[#a11818] transition">
                    + Schedule New Interview
                </button>
            </div>

            <div class="space-y-3">
                @foreach($interviewsList as $interview)
                    <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:border-slate-300 transition">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-purple-50 border border-purple-100 text-purple-700 flex flex-col items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="text-sm font-extrabold text-slate-900">{{ $interview['candidate_name'] }}</h4>
                                    <span class="px-2 py-0.5 text-[10px] font-bold rounded-full {{ $interview['badge'] }}">
                                        {{ $interview['status'] }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500 font-semibold mt-0.5">{{ $interview['position'] }}</p>
                                <p class="text-[11px] text-slate-400 font-medium mt-1">
                                    Interviewer: <strong class="text-slate-700">{{ $interview['interviewer'] }}</strong>
                                </p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 shrink-0">
                            <div class="text-right">
                                <p class="text-xs font-bold text-slate-900">{{ $interview['time'] }}</p>
                                <p class="text-[11px] text-purple-700 font-semibold">{{ $interview['round'] }}</p>
                            </div>
                            <button type="button" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-800 text-xs font-bold rounded-xl transition">
                                Details
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
