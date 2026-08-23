<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Job Vacancies & ATS Management</h1>
            <p class="text-slate-500 text-sm">Create job requisitions, track candidate application pipelines, and manage screening.</p>
        </div>
        <button wire:click="$set('showModal', true)" class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white text-sm font-semibold px-4 py-2.5 rounded-lg shadow-sm">
            <span>+ Create New Vacancy</span>
        </button>
    </div>

    @if (session()->has('message'))
        <x-alert-banner dismissible>
            {{ session('message') }}
        </x-alert-banner>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($vacancies as $vac)
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm flex flex-col justify-between hover:border-teal-500/40 transition">
                <div class="space-y-3">
                    <div class="flex justify-between items-start">
                        <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-teal-50 text-teal-700 border border-teal-200">
                            {{ ucfirst($vac->employment_type) }}
                        </span>
                        <x-badge :status="$vac->status">{{ ucfirst($vac->status) }}</x-badge>
                    </div>
                    
                    <h2 class="text-lg font-bold text-slate-900">{{ $vac->title }}</h2>
                    <p class="text-xs text-slate-500 font-medium">Department: {{ $vac->department?->name ?? 'General' }} · Openings: {{ $vac->openings_count }}</p>
                    <p class="text-sm text-slate-600 line-clamp-2">{{ $vac->description }}</p>
                </div>

                <div class="pt-4 border-t border-slate-100 mt-4 flex items-center justify-between">
                    <span class="text-xs text-slate-500 font-medium">🎯 {{ $vac->candidates_count }} Applicants</span>
                    <a href="/recruitment/candidates?vacancy={{ $vac->id }}" class="text-xs font-bold text-teal-600 hover:text-teal-800">
                        View Pipeline →
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-3 p-12 bg-white rounded-2xl border border-slate-200 text-center text-slate-400">
                No active vacancies found. Click "+ Create New Vacancy" to publish a job requisition.
            </div>
        @endforelse
    </div>

    <!-- Create Vacancy Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-2xl max-w-xl w-full p-6 space-y-4 shadow-2xl border border-slate-200">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h2 class="text-lg font-bold text-slate-900">Create Job Vacancy</h2>
                    <button wire:click="$set('showModal', false)" class="text-slate-400 hover:text-slate-600">✕</button>
                </div>

                <form wire:submit.prevent="createVacancy" class="space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Job Title *</label>
                        <input type="text" wire:model="title" placeholder="e.g. Senior Full Stack Engineer" class="w-full text-sm border rounded-lg p-2.5">
                        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Department *</label>
                            <select wire:model="department_id" class="w-full text-sm border rounded-lg p-2.5">
                                <option value="">Select Department</option>
                                @foreach($departments as $dept)
                                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1">Openings Count *</label>
                            <input type="number" wire:model="openings_count" min="1" class="w-full text-sm border rounded-lg p-2.5">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Description *</label>
                        <textarea wire:model="description" rows="3" class="w-full text-sm border rounded-lg p-2.5" placeholder="Key responsibilities and overview..."></textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end gap-3 border-t border-slate-100 pt-3">
                        <button type="button" wire:click="$set('showModal', false)" class="px-4 py-2 text-sm text-slate-600">Cancel</button>
                        <button type="submit" class="px-4 py-2 text-sm bg-teal-600 hover:bg-teal-700 text-white rounded-lg font-semibold">Publish Vacancy</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
