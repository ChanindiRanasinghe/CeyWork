<div>
    <!-- Backdrop Overlay -->
    @if($isOpen)
        <div 
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 transition-opacity flex items-start justify-center pt-16 sm:pt-24 px-4"
            wire:keydown.escape.window="close"
        >
            <!-- Command Modal Box -->
            <div class="bg-white rounded-3xl shadow-2xl border border-slate-200/80 w-full max-w-2xl overflow-hidden animate-in fade-in zoom-in-95 duration-150">
                <!-- Top Input Bar -->
                <div class="p-4 border-b border-slate-100 flex items-center gap-3 bg-[#fdfbf4]">
                    <div class="w-10 h-10 rounded-2xl bg-[#b91c1c] text-white flex items-center justify-center font-black text-lg shrink-0 shadow-sm">
                        🤖
                    </div>
                    <input 
                        type="text" 
                        wire:model.live.debounce.300ms="query"
                        wire:keydown.enter="processAgentQuery"
                        placeholder="Ask CEYWork AI Agent (e.g. 'screen candidates', 'check EPF audit', 'onboarding status')..."
                        class="w-full text-sm font-semibold text-slate-900 placeholder:text-slate-400 bg-transparent border-none focus:outline-none focus:ring-0"
                        autofocus
                    />
                    <button 
                        type="button" 
                        wire:click="processAgentQuery"
                        class="px-4 py-2 bg-[#b91c1c] text-white text-xs font-bold rounded-xl hover:bg-[#a11818] transition shrink-0"
                    >
                        Run Agent
                    </button>
                    <button 
                        type="button" 
                        wire:click="close"
                        class="text-slate-400 hover:text-slate-700 font-extrabold text-sm px-2 py-1 rounded-lg"
                    >
                        ✕
                    </button>
                </div>

                <!-- Suggestions / AI Response Output -->
                <div class="p-5 max-h-96 overflow-y-auto space-y-4 bg-white">
                    @if($isProcessing)
                        <div class="py-8 text-center text-slate-400 font-bold text-xs flex items-center justify-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-[#b91c1c] animate-ping"></span>
                            <span>CEYWork Agentic AI is processing database intent...</span>
                        </div>
                    @elseif(!empty($aiResponse))
                        <div class="bg-slate-50 rounded-2xl p-3 border border-slate-200/60 text-xs font-bold text-slate-700 flex items-center justify-between">
                            <span>✨ {{ $aiResponse['summary'] }}</span>
                            <span class="text-[10px] uppercase tracking-wider text-[#b91c1c] bg-rose-50 px-2 py-0.5 rounded-md font-black">AI Agent</span>
                        </div>

                        <div class="space-y-2">
                            @foreach($aiResponse['items'] as $item)
                                <a 
                                    href="{{ $item['url'] }}" 
                                    wire:click="close"
                                    class="block bg-white p-4 rounded-2xl border border-slate-200/80 hover:border-[#b91c1c] shadow-xs hover:shadow-md transition group"
                                >
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="text-xs font-extrabold text-slate-900 group-hover:text-[#b91c1c] transition">
                                                {{ $item['title'] }}
                                            </h4>
                                            <p class="text-[11px] text-slate-500 font-medium mt-0.5">
                                                {{ $item['subtitle'] }}
                                            </p>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                {{ $item['badge'] }}
                                            </span>
                                            <span class="text-xs text-[#b91c1c] font-black group-hover:translate-x-1 transition">→</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @else
                        <!-- Pre-built Quick Prompts -->
                        <div>
                            <p class="text-[11px] font-bold tracking-wider text-slate-400 uppercase mb-3">Quick Agentic Prompts</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                <button 
                                    type="button" 
                                    wire:click="$set('query', 'screen candidates'); processAgentQuery()"
                                    class="text-left p-3 rounded-2xl bg-slate-50 hover:bg-rose-50 hover:border-rose-200 border border-slate-200/60 transition text-xs font-bold text-slate-800"
                                >
                                    🎯 <strong>Screen Candidates</strong>
                                    <p class="text-[10px] text-slate-500 font-normal mt-0.5">Evaluate active applicants against vacancies</p>
                                </button>

                                <button 
                                    type="button" 
                                    wire:click="$set('query', 'epf audit'); processAgentQuery()"
                                    class="text-left p-3 rounded-2xl bg-slate-50 hover:bg-emerald-50 hover:border-emerald-200 border border-slate-200/60 transition text-xs font-bold text-slate-800"
                                >
                                    🇱🇰 <strong>EPF/ETF Statutory Audit</strong>
                                    <p class="text-[10px] text-slate-500 font-normal mt-0.5">Verify 8%/12% EPF & 3% ETF compliance</p>
                                </button>

                                <button 
                                    type="button" 
                                    wire:click="$set('query', 'onboarding status'); processAgentQuery()"
                                    class="text-left p-3 rounded-2xl bg-slate-50 hover:bg-sky-50 hover:border-sky-200 border border-slate-200/60 transition text-xs font-bold text-slate-800"
                                >
                                    📄 <strong>Onboarding Document Audit</strong>
                                    <p class="text-[10px] text-slate-500 font-normal mt-0.5">Check pending new hire documentation</p>
                                </button>

                                <button 
                                    type="button" 
                                    wire:click="$set('query', 'Saman'); processAgentQuery()"
                                    class="text-left p-3 rounded-2xl bg-slate-50 hover:bg-purple-50 hover:border-purple-200 border border-slate-200/60 transition text-xs font-bold text-slate-800"
                                >
                                    👥 <strong>Find Employee Records</strong>
                                    <p class="text-[10px] text-slate-500 font-normal mt-0.5">Search employee profile by name or code</p>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Footer Hint Bar -->
                <div class="p-3 bg-slate-50 border-t border-slate-100 flex items-center justify-between text-[11px] font-bold text-slate-400">
                    <span>Press <kbd class="px-1.5 py-0.5 bg-white border border-slate-200 rounded font-mono text-[10px] text-slate-600">Esc</kbd> to exit</span>
                    <span class="text-[#b91c1c]">CEYWork Agentic Co-pilot v1.0</span>
                </div>
            </div>
        </div>
    @endif
</div>
