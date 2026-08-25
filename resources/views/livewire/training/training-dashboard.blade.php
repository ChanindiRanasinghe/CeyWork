<div class="space-y-6 bg-[#fdfbf4] min-h-screen p-3 sm:p-6">
    <!-- Top Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Training</h1>
            <p class="text-slate-500 text-xs sm:text-sm mt-1 font-medium">
                {{ count($courses) }} active courses · {{ collect($courses)->where('mandatory', true)->count() }} mandatory for all staff
            </p>
        </div>

        <div class="flex items-center gap-3">
            @if($canAddTraining)
                <button 
                    type="button" 
                    wire:click="openCreateModal"
                    class="px-4 py-2.5 bg-[#b91c1c] hover:bg-[#a11818] text-white text-xs font-black rounded-2xl shadow-sm hover:shadow transition flex items-center gap-2 cursor-pointer"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>+ Add Training Session</span>
                </button>
            @endif

            <span class="px-3 py-1.5 bg-emerald-50 text-emerald-700 border border-emerald-200 text-xs font-bold rounded-xl flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-emerald-600"></span>
                <span>Visible to All Staff</span>
            </span>
        </div>
    </div>

    <!-- Success Flash Notification Banner -->
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

    <!-- Course Cards List -->
    <div class="space-y-4">
        @foreach($courses as $course)
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs hover:shadow-sm transition space-y-5">
                <!-- Top Row: Icon, Title, Mandatory Badge & Category -->
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <!-- Graduation Cap Icon -->
                        <div class="w-12 h-12 rounded-2xl bg-indigo-50/70 border border-indigo-100/80 flex items-center justify-center text-[#b91c1c] shrink-0">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6" />
                            </svg>
                        </div>

                        <!-- Course Title & Metadata -->
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <h3 class="text-base font-extrabold text-slate-900">{{ $course['title'] }}</h3>
                                @if($course['mandatory'])
                                    <span class="px-2.5 py-0.5 text-[10px] font-extrabold bg-rose-50 text-rose-600 border border-rose-200 rounded-full lowercase">
                                        mandatory
                                    </span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-400 font-semibold mt-1">
                                {{ $course['provider'] }} · {{ $course['duration'] }} · Deadline: {{ $course['deadline'] }}
                            </p>
                        </div>
                    </div>

                    <!-- Category Pill Badge, Edit Button & Enrollment Action -->
                    <div class="flex items-center gap-2.5 self-end sm:self-center">
                        @if($canAddTraining)
                            <button 
                                type="button" 
                                wire:click="openEditModal({{ $course['id'] }})"
                                class="px-3 py-1.5 text-xs font-bold rounded-xl transition bg-amber-50 hover:bg-amber-100 text-amber-900 border border-amber-200 flex items-center gap-1"
                                title="Admin Edit Course"
                            >
                                ✏️ Edit
                            </button>
                            <button 
                                type="button" 
                                wire:click="deleteCourse({{ $course['id'] }})"
                                class="px-2.5 py-1.5 text-xs font-bold rounded-xl transition bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200"
                                title="Admin Delete Course"
                            >
                                🗑️
                            </button>
                        @endif

                        <button 
                            type="button"
                            wire:click="toggleEnrollment({{ $course['id'] }})"
                            class="px-3 py-1.5 text-xs font-bold rounded-xl transition border {{ $course['userCompleted'] ? 'bg-emerald-100 text-emerald-800 border-emerald-300' : 'bg-slate-50 hover:bg-slate-100 text-slate-700 border-slate-200' }}"
                        >
                            {{ $course['userCompleted'] ? '✓ Completed' : 'Mark Complete' }}
                        </button>

                        <span class="px-3 py-1.5 text-xs font-bold text-slate-600 bg-slate-100 border border-slate-200/80 rounded-xl shrink-0">
                            {{ $course['category'] }}
                        </span>
                    </div>
                </div>

                <!-- Bottom Progress Bar & Numbers -->
                <div class="space-y-1.5 pt-1">
                    <div class="flex items-center justify-between text-xs font-bold">
                        <div class="w-full mr-4">
                            <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                                <div 
                                    class="h-full rounded-full transition-all duration-300 {{ $course['progressColor'] }}" 
                                    style="width: {{ $course['percentage'] }}%"
                                ></div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 shrink-0 font-extrabold text-slate-500">
                            <span class="text-slate-600">{{ $course['completedCount'] }}/{{ $course['totalEnrolled'] }}</span>
                            <span class="text-slate-400">{{ $course['percentage'] }}%</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- CREATE / EDIT TRAINING SESSION MODAL (Admin & HR Access) -->
    @if($showCreateModal || $showEditModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-xs">
            <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full border border-slate-200 shadow-2xl space-y-6">
                <!-- Modal Header -->
                <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                    <div>
                        <h3 class="text-xl font-extrabold text-slate-900">
                            {{ $showEditModal ? 'Edit Training Session (Admin)' : 'Add New Training Session' }}
                        </h3>
                        <p class="text-xs text-slate-500 font-medium mt-0.5">
                            {{ $showEditModal ? 'Modify course parameters and completion targets' : 'Publish a new course or training session for staff' }}
                        </p>
                    </div>
                    <button wire:click="closeCreateModal" class="text-slate-400 hover:text-slate-600 font-bold text-lg">✕</button>
                </div>

                <!-- Form Fields -->
                <form wire:submit.prevent="{{ $showEditModal ? 'updateTrainingSession' : 'createTrainingSession' }}" class="space-y-4 text-xs">
                    <!-- Title -->
                    <div>
                        <label class="block font-bold text-slate-700 mb-1">Course / Session Title *</label>
                        <input 
                            type="text" 
                            wire:model="newTitle" 
                            placeholder="e.g. Cybersecurity & Anti-Phishing Essentials" 
                            class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                        />
                        @error('newTitle') <span class="text-rose-600 text-[11px] font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Category & Provider Row -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Category *</label>
                            <select 
                                wire:model="newCategory" 
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                            >
                                <option value="Compliance">Compliance</option>
                                <option value="Leadership">Leadership</option>
                                <option value="Tech">Tech</option>
                                <option value="Finance">Finance</option>
                                <option value="Soft Skills">Soft Skills</option>
                                <option value="Safety">Safety & Security</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Platform / Provider *</label>
                            <input 
                                type="text" 
                                wire:model="newProvider" 
                                placeholder="e.g. Coursera, Internal, Udemy" 
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                            />
                        </div>
                    </div>

                    <!-- Duration & Deadline Row -->
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Duration *</label>
                            <input 
                                type="text" 
                                wire:model="newDuration" 
                                placeholder="e.g. 4h, 8h, 12h" 
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                            />
                        </div>
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Completion Deadline *</label>
                            <input 
                                type="text" 
                                wire:model="newDeadline" 
                                placeholder="e.g. Nov 30" 
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                            />
                        </div>
                    </div>

                    <!-- Target Enrolled Count & Mandatory Checkbox -->
                    <div class="grid grid-cols-2 gap-3 items-center pt-1">
                        <div>
                            <label class="block font-bold text-slate-700 mb-1">Total Enrolled Staff</label>
                            <input 
                                type="number" 
                                wire:model="newTotalEnrolled" 
                                placeholder="150" 
                                class="w-full px-3.5 py-2.5 bg-slate-50 border border-slate-200 rounded-xl font-medium text-slate-900 focus:bg-white focus:border-[#b91c1c] focus:outline-none"
                            />
                        </div>
                        <div class="pt-5">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input 
                                    type="checkbox" 
                                    wire:model="newMandatory" 
                                    class="w-4 h-4 rounded text-[#b91c1c] focus:ring-[#b91c1c]"
                                />
                                <span class="font-extrabold text-slate-800">Mandatory for all staff</span>
                            </label>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                        <button 
                            type="button" 
                            wire:click="closeCreateModal" 
                            class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold text-xs rounded-xl transition"
                        >
                            Cancel
                        </button>
                        <button 
                            type="submit" 
                            class="px-5 py-2.5 bg-[#b91c1c] hover:bg-[#a11818] text-white font-extrabold text-xs rounded-xl shadow-xs transition"
                        >
                            {{ $showEditModal ? 'Update Training Session' : 'Save Training Session' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
